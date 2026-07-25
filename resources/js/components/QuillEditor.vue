<template>
    <div ref="editor" class="editor"></div>
</template>

<script>
import Quill from "quill";
import "quill/dist/quill.snow.css";
import ImageResize from 'quill-image-resize-module-react';
import hljs from 'highlight.js';
import php from 'highlight.js/lib/languages/php';

import "highlight.js/styles/atom-one-dark.css";

hljs.registerLanguage('php', php);
Quill.register('modules/imageResize', ImageResize);

export default {
    props: ['placeholder'],
    data() {
        return {
            editor: null,
        };
    },
    mounted() {
        this.editor = new Quill(this.$refs.editor, {
            modules: {
                keyboard: {
                    bindings: {
                        indentWithTab: {
                            key: 'Tab',
                            shiftKey: false,
                            handler(range) {
                                const tab = '\u2003\u2003\u2003\u2003';
                                if (range.length) {
                                    this.quill.deleteText(range.index, range.length, 'user');
                                }
                                this.quill.insertText(range.index, tab, 'user');
                                this.quill.setSelection(range.index + tab.length, 0, 'silent');
                                return false;
                            }
                        },
                        outdentWithTab: {
                            key: 'Tab',
                            shiftKey: true,
                            handler(range) {
                                const tab = '\u2003\u2003\u2003\u2003';
                                const start = Math.max(0, range.index - tab.length);
                                const before = this.quill.getText(start, tab.length);
                                if (before === tab) {
                                    this.quill.deleteText(start, tab.length, 'user');
                                    this.quill.setSelection(start, 0, 'silent');
                                }
                                return false;
                            }
                        }
                    }
                },
                toolbar: [
                    [{ 'font': [] }],
                    [{ 'header': [1, 2, 3, 4, 5, 6, false] }],
                    ['bold', 'italic', 'underline', 'strike'],
                    [{ 'color': [] }, { 'background': [] }],
                    [{ 'script': 'sub' }, { 'script': 'super' }],
                    [{ 'header': '1' }, { 'header': '2' }],
                    [{ 'list': 'ordered' }, { 'list': 'bullet' }],
                    [{ 'indent': '-1' }, { 'indent': '+1' }],
                    [{ 'direction': 'rtl' }],
                    [{ 'align': [] }],
                    ['blockquote', 'code-block'],
                    ['link', 'image', 'video'],
                    ['clean']
                ],
                syntax: { hljs },
                imageResize: {
                    modules: ['Resize', 'DisplaySize']
                }
            },
            placeholder: 'Compose an epic...',
            theme: 'snow',
        });

        const initialContent = (this.placeholder ?? '').trim();
        if (initialContent) {
            this.editor.clipboard.dangerouslyPasteHTML(initialContent, 'silent');
        } else {
            this.editor.setContents([{ insert: '\n' }], 'silent');
            this.editor.removeFormat(0, this.editor.getLength(), 'silent');
            this.editor.setSelection(0, 0, 'silent');
        }

        this.editor.root.setAttribute(
            'aria-description',
            'Press Tab to insert spacing at the cursor. Press Shift and Tab to remove the preceding tab spacing.'
        );
        this.editor.root.addEventListener('paste', this.pasteAsPlainText);
        this.editor.on("text-change", this.update);
        this.editor.history.clear();
        this.update();
    },

    methods: {
        pasteAsPlainText(event) {
            const text = event.clipboardData?.getData('text/plain');
            if (typeof text !== 'string') {
                return;
            }

            event.preventDefault();
            const range = this.editor.getSelection(true);
            const normalized = text.replace(/\r\n?/g, '\n');

            if (range.length) {
                this.editor.deleteText(range.index, range.length, 'user');
            }
            this.editor.insertText(range.index, normalized, 'user');
            this.editor.setSelection(range.index + normalized.length, 0, 'silent');
        },

        update() {
            const content = this.editor.root.innerHTML;
            document.querySelector("#floatingTextarea").value = content;
            this.$emit(
                "update:modelValue",
                this.editor.getText().trim() || this.editor.root.querySelector('img, iframe')
                    ? content
                    : ""
            );
        },
    },
    beforeUnmount() {
        this.editor?.root.removeEventListener('paste', this.pasteAsPlainText);
    },
};
</script>

<style>
.editor {
    min-height: 0;
}

.editor .ql-editor {
    min-height: 500px;
    padding: 1.25rem;
    line-height: 1.6;
    font-family: inherit;
    font-size: 1rem;
}

.editor .ql-editor p,
.editor .ql-editor ol,
.editor .ql-editor ul,
.editor .ql-editor blockquote,
.editor .ql-editor pre {
    margin: 0 0 1rem;
}

.editor .ql-editor p:last-child,
.editor .ql-editor ol:last-child,
.editor .ql-editor ul:last-child,
.editor .ql-editor blockquote:last-child,
.editor .ql-editor pre:last-child {
    margin-bottom: 0;
}
</style>
