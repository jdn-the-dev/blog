<template>
    <div ref="editor" class="editor"></div>
</template>

<script>
import { markRaw } from 'vue';
import Quill from "quill";
import "quill/dist/quill.snow.css";
import ImageResize from 'quill-image-resize-module-react';
Quill.register('modules/imageResize', ImageResize);

export default {
    data() {
        return {
            editor: null,
        };
    },
    mounted() {
        this.editor = markRaw(new Quill(this.$refs.editor, {
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
                imageResize: {
                    modules: ['Resize', 'DisplaySize']
                }
            },
            placeholder: 'Compose an epic...',
            theme: 'snow',
        }));

        const initialContent = (document.querySelector('#floatingTextarea')?.value ?? '').trim();
        if (initialContent) {
            this.editor.clipboard.dangerouslyPasteHTML(initialContent, 'silent');
        } else {
            this.editor.setContents([{ insert: '\n' }], 'silent');
            this.editor.removeFormat(0, this.editor.getLength(), 'silent');
        }
        this.editor.setSelection(null, 'silent');
        window.getSelection()?.removeAllRanges();

        this.editor.root.setAttribute(
            'aria-description',
            'Press Tab to insert spacing at the cursor. Press Shift and Tab to remove the preceding tab spacing.'
        );
        this.editor.on("text-change", this.update);
        this.editor.history.clear();
        this.update();
    },

    methods: {
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
