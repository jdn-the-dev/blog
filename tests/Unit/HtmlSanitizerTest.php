<?php

namespace Tests\Unit;

use App\Services\HtmlSanitizer;
use PHPUnit\Framework\TestCase;

class HtmlSanitizerTest extends TestCase
{
    public function test_it_keeps_rich_content_and_removes_executable_markup(): void
    {
        $html = '<h2 onclick="alert(1)">Heading</h2>'
            .'<script>alert(1)</script>'
            .'<a href="javascript:alert(1)" target="_blank">bad</a>'
            .'<a href="https://example.com" target="_blank">good</a>'
            .'<pre><code class="language-php">&lt;?php echo 1;</code></pre>';

        $clean = (new HtmlSanitizer)->sanitize($html);

        $this->assertStringContainsString('<h2>Heading</h2>', $clean);
        $this->assertStringNotContainsString('script', $clean);
        $this->assertStringNotContainsString('onclick', $clean);
        $this->assertStringNotContainsString('javascript:', $clean);
        $this->assertStringContainsString('rel="noopener noreferrer"', $clean);
        $this->assertStringContainsString('class="language-php"', $clean);
    }

    public function test_it_rejects_dangerous_image_sources(): void
    {
        $clean = (new HtmlSanitizer)->sanitize(
            '<img src="data:text/html;base64,PHNjcmlwdD4="><img src="/images/safe.jpg">'
        );

        $this->assertStringNotContainsString('data:text/html', $clean);
        $this->assertStringContainsString('src="/images/safe.jpg"', $clean);
    }

    public function test_it_preserves_quill_formatting_safely(): void
    {
        $html = '<h1>Title</h1><p style="color: #ff0000; background-image: url(javascript:alert(1)); text-align: center">'
            .'Centered <sup>2</sup></p>'
            .'<ol><li data-list="bullet"><span class="ql-ui" contenteditable="false"></span>Item</li></ol>'
            .'<img src="/image.jpg" style="width: 55%; position: fixed">'
            .'<iframe class="ql-video" src="https://www.youtube.com/embed/abc"></iframe>';

        $clean = (new HtmlSanitizer)->sanitize($html);

        $this->assertStringContainsString('<h1>Title</h1>', $clean);
        $this->assertStringContainsString('color: #ff0000', $clean);
        $this->assertStringContainsString('text-align: center', $clean);
        $this->assertStringNotContainsString('background-image', $clean);
        $this->assertStringContainsString('data-list="bullet"', $clean);
        $this->assertStringContainsString('class="ql-ui"', $clean);
        $this->assertStringContainsString('width: 55%', $clean);
        $this->assertStringNotContainsString('position:', $clean);
        $this->assertStringContainsString('class="ql-video"', $clean);
        $this->assertStringContainsString('sandbox=', $clean);
    }

    public function test_it_removes_untrusted_video_embeds(): void
    {
        $clean = (new HtmlSanitizer)->sanitize(
            '<iframe src="https://evil.example/video"></iframe><p>Safe</p>'
        );

        $this->assertStringNotContainsString('iframe', $clean);
        $this->assertStringContainsString('<p>Safe</p>', $clean);
    }

    public function test_it_preserves_intentional_spacing_and_block_indentation(): void
    {
        $clean = (new HtmlSanitizer)->sanitize(
            '<p>&nbsp;&nbsp;First line wraps normally</p>'
            .'<p class="ql-indent-2">&nbsp;Indented paragraph</p>'
            .'<pre><code>&nbsp;&nbsp;code indentation</code></pre>'
        );

        $this->assertMatchesRegularExpression('/<p>(?:\x{00A0}|&nbsp;){2}First line wraps normally<\/p>/u', $clean);
        $this->assertMatchesRegularExpression('/<p class="ql-indent-2">(?:\x{00A0}|&nbsp;)Indented paragraph<\/p>/u', $clean);
        $this->assertMatchesRegularExpression('/<code>(?:\x{00A0}|&nbsp;){2}code indentation<\/code>/u', $clean);
    }

    public function test_it_preserves_visible_inline_tab_spacing(): void
    {
        $clean = (new HtmlSanitizer)->sanitize("<p>\u{2003}\u{2003}\u{2003}\u{2003}One line</p>");

        $this->assertStringContainsString("\u{2003}\u{2003}\u{2003}\u{2003}One line", $clean);
    }

    public function test_it_normalizes_quill_code_blocks_and_removes_escaped_highlight_markup(): void
    {
        $html = '<div class="ql-code-block-container">'
            .'<select class="ql-ui"><option>Python</option></select>'
            .'<div class="ql-code-block" data-language="python">'
            .'&lt;span class="ql-token hljs-keyword"&gt;print&lt;/span&gt;("hello")'
            .'</div><div class="ql-code-block" data-language="python">next_line()</div>'
            .'</div>';

        $clean = (new HtmlSanitizer)->sanitize($html);

        $this->assertStringContainsString('<pre><code class="language-python">print("hello")'."\n".'next_line()</code></pre>', $clean);
        $this->assertStringNotContainsString('ql-code-block', $clean);
        $this->assertStringNotContainsString('&lt;span', $clean);
        $this->assertStringNotContainsString('<select', $clean);
    }

    public function test_it_repairs_legacy_quill_code_saved_as_multiple_pre_elements(): void
    {
        $html = '<div class="ql-code-block-container">'
            .'<option value="plain">Plain</option><option value="python">Python</option>'
            .'<pre><code class="language-python">&lt;span class="ql-token hljs-keyword"&gt;print&lt;/span&gt;("hello")</code></pre>'
            .'<pre><code class="language-python">&lt;br&gt;</code></pre>'
            .'<pre><code class="language-python">next_line()</code></pre>'
            .'</div>';

        $clean = (new HtmlSanitizer)->sanitize($html);

        $this->assertStringContainsString('<pre><code class="language-python">print("hello")'."\n\n".'next_line()</code></pre>', $clean);
        $this->assertStringNotContainsString('Plain', $clean);
        $this->assertStringNotContainsString('&lt;span', $clean);
        $this->assertSame(1, substr_count($clean, '<pre>'));
    }
}
