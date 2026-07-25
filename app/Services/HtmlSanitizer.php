<?php

namespace App\Services;

use DOMDocument;
use DOMElement;
use DOMNode;

class HtmlSanitizer
{
    private const ALLOWED_TAGS = [
        'p', 'br', 'strong', 'b', 'em', 'i', 'u', 's', 'blockquote',
        'pre', 'code', 'h1', 'h2', 'h3', 'h4', 'h5', 'h6', 'ul', 'ol',
        'li', 'a', 'img', 'iframe', 'figure', 'figcaption', 'span', 'div',
        'sub', 'sup',
    ];

    private const GLOBAL_ATTRIBUTES = ['class', 'style', 'dir'];

    private const TAG_ATTRIBUTES = [
        'a' => ['href', 'title', 'target', 'rel'],
        'img' => ['src', 'alt', 'title', 'width', 'height'],
        'code' => ['data-language'],
        'div' => ['data-language'],
        'li' => ['data-list'],
        'span' => ['contenteditable'],
        'iframe' => ['src', 'title', 'width', 'height', 'allowfullscreen', 'frameborder'],
    ];

    private const SAFE_STYLE_PROPERTIES = [
        'background-color', 'color', 'font-family', 'font-size',
        'text-align', 'width', 'height',
    ];

    public function sanitize(?string $html): string
    {
        if (blank($html)) {
            return '';
        }

        $document = new DOMDocument('1.0', 'UTF-8');
        $previous = libxml_use_internal_errors(true);
        $document->loadHTML(
            '<?xml encoding="UTF-8"><div id="post-root">'.$html.'</div>',
            LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD
        );
        libxml_clear_errors();
        libxml_use_internal_errors($previous);

        $root = $document->getElementById('post-root');
        if (! $root) {
            return '';
        }

        $this->normalizeQuillCodeBlocks($root, $document);
        $this->cleanChildren($root);

        $clean = '';
        foreach ($root->childNodes as $child) {
            $clean .= $document->saveHTML($child);
        }

        return trim($clean);
    }

    private function normalizeQuillCodeBlocks(DOMElement $root, DOMDocument $document): void
    {
        $containers = [];
        foreach ($root->getElementsByTagName('div') as $div) {
            if (in_array('ql-code-block-container', preg_split('/\s+/', $div->getAttribute('class')), true)) {
                $containers[] = $div;
            }
        }

        foreach ($containers as $container) {
            $lines = [];
            $language = '';

            foreach (iterator_to_array($container->childNodes) as $child) {
                if (! $child instanceof DOMElement) {
                    continue;
                }

                $classes = preg_split('/\s+/', $child->getAttribute('class'));
                if (in_array('ql-code-block', $classes, true)) {
                    if ($language === '') {
                        $language = strtolower(trim($child->getAttribute('data-language')));
                    }
                    $lines[] = $this->plainCodeText($child->textContent);
                    continue;
                }

                if (strtolower($child->tagName) === 'pre') {
                    $code = null;
                    foreach ($child->childNodes as $preChild) {
                        if ($preChild instanceof DOMElement && strtolower($preChild->tagName) === 'code') {
                            $code = $preChild;
                            break;
                        }
                    }
                    if (! $code) {
                        continue;
                    }
                    if ($language === '' && preg_match('/(?:^|\s)language-([a-z0-9_+-]+)/i', $code->getAttribute('class'), $match)) {
                        $language = strtolower($match[1]);
                    }
                    $lines[] = $this->plainCodeText($code->textContent);
                }
            }

            if ($lines === []) {
                continue;
            }

            $pre = $document->createElement('pre');
            $code = $document->createElement('code');
            if ($language !== '' && preg_match('/^[a-z0-9_+-]+$/', $language)) {
                $code->setAttribute('class', 'language-'.$language);
            }
            $code->appendChild($document->createTextNode(implode("\n", $lines)));
            $pre->appendChild($code);
            $container->parentNode?->replaceChild($pre, $container);
        }
    }

    private function plainCodeText(string $line): string
    {
        if (! str_contains($line, '<')) {
            return $line;
        }

        if (preg_match('/^\s*<br\s*\/?>\s*$/i', $line)) {
            return '';
        }

        $line = preg_replace('/<br\s*\/?>/i', "\n", $line);

        return strip_tags(html_entity_decode($line, ENT_QUOTES | ENT_HTML5, 'UTF-8'));
    }

    private function cleanChildren(DOMNode $parent): void
    {
        foreach (iterator_to_array($parent->childNodes) as $node) {
            if ($node->nodeType === XML_COMMENT_NODE) {
                $parent->removeChild($node);
                continue;
            }

            if (! $node instanceof DOMElement) {
                continue;
            }

            $tag = strtolower($node->tagName);
            if (! in_array($tag, self::ALLOWED_TAGS, true)) {
                if (in_array($tag, ['script', 'style', 'object', 'embed', 'svg', 'math'], true)) {
                    $parent->removeChild($node);
                } else {
                    while ($node->firstChild) {
                        $parent->insertBefore($node->firstChild, $node);
                    }
                    $parent->removeChild($node);
                }
                continue;
            }

            $allowed = array_merge(self::GLOBAL_ATTRIBUTES, self::TAG_ATTRIBUTES[$tag] ?? []);
            foreach (iterator_to_array($node->attributes) as $attribute) {
                $name = strtolower($attribute->name);
                if (! in_array($name, $allowed, true)) {
                    $node->removeAttribute($attribute->name);
                }
            }

            if ($node->hasAttribute('class')) {
                $classes = array_filter(
                    preg_split('/\s+/', $node->getAttribute('class')),
                    fn (string $class) => preg_match('/^(ql-|language-)[a-z0-9_-]+$/i', $class)
                );
                empty($classes)
                    ? $node->removeAttribute('class')
                    : $node->setAttribute('class', implode(' ', $classes));
            }

            if ($node->hasAttribute('dir') && ! in_array(strtolower($node->getAttribute('dir')), ['ltr', 'rtl', 'auto'], true)) {
                $node->removeAttribute('dir');
            }
            if ($node->hasAttribute('style')) {
                $style = $this->safeStyle($node->getAttribute('style'));
                $style === '' ? $node->removeAttribute('style') : $node->setAttribute('style', $style);
            }
            if ($node->hasAttribute('href') && ! $this->safeUrl($node->getAttribute('href'), false)) {
                $node->removeAttribute('href');
            }
            if ($tag === 'iframe') {
                if (! $this->safeEmbedUrl($node->getAttribute('src'))) {
                    $parent->removeChild($node);
                    continue;
                }
                $node->setAttribute('sandbox', 'allow-scripts allow-same-origin allow-presentation');
                $node->setAttribute('referrerpolicy', 'strict-origin-when-cross-origin');
                $node->setAttribute('loading', 'lazy');
                $node->setAttribute('title', $node->getAttribute('title') ?: 'Embedded video');
            } elseif ($node->hasAttribute('src') && ! $this->safeUrl($node->getAttribute('src'), true)) {
                $node->removeAttribute('src');
            }
            if ($tag === 'a' && $node->getAttribute('target') === '_blank') {
                $node->setAttribute('rel', 'noopener noreferrer');
            }

            $this->cleanChildren($node);
        }
    }

    private function safeStyle(string $style): string
    {
        $safe = [];
        foreach (explode(';', $style) as $declaration) {
            if (! str_contains($declaration, ':')) {
                continue;
            }
            [$property, $value] = array_map('trim', explode(':', $declaration, 2));
            $property = strtolower($property);
            if (! in_array($property, self::SAFE_STYLE_PROPERTIES, true)) {
                continue;
            }
            if ($value === '' || preg_match('/(?:url|expression|@import|javascript|behavior|binding)\s*\(?/i', $value)) {
                continue;
            }
            if (in_array($property, ['width', 'height'], true) && ! preg_match('/^(?:auto|\d+(?:\.\d+)?(?:px|%|em|rem|vw|vh))$/i', $value)) {
                continue;
            }
            if ($property === 'text-align' && ! in_array(strtolower($value), ['left', 'right', 'center', 'justify'], true)) {
                continue;
            }
            if ($property === 'font-size' && ! preg_match('/^(?:\d+(?:\.\d+)?(?:px|em|rem|%)|small|medium|large|x-large)$/i', $value)) {
                continue;
            }
            if (in_array($property, ['color', 'background-color'], true)
                && ! preg_match('/^(?:#[0-9a-f]{3,8}|rgba?\([\d\s,.%]+\)|hsla?\([\d\s,.%]+\)|[a-z]+)$/i', $value)) {
                continue;
            }
            if ($property === 'font-family' && ! preg_match('/^[a-z0-9 ,\'"-]+$/i', $value)) {
                continue;
            }
            $safe[] = $property.': '.$value;
        }

        return implode('; ', $safe);
    }

    private function safeEmbedUrl(string $url): bool
    {
        if (! $this->safeUrl($url, false)) {
            return false;
        }

        $host = strtolower((string) parse_url($url, PHP_URL_HOST));

        return in_array($host, [
            'www.youtube.com', 'youtube.com', 'www.youtube-nocookie.com',
            'player.vimeo.com',
        ], true);
    }

    private function safeUrl(string $url, bool $allowImageData): bool
    {
        $url = trim(html_entity_decode($url, ENT_QUOTES | ENT_HTML5, 'UTF-8'));
        if ($url === '' || str_starts_with($url, '/') || str_starts_with($url, '#')) {
            return true;
        }
        if ($allowImageData && preg_match('/^data:image\/(?:png|gif|jpe?g|webp);base64,/i', $url)) {
            return true;
        }

        return in_array(strtolower((string) parse_url($url, PHP_URL_SCHEME)), ['http', 'https', 'mailto'], true);
    }
}
