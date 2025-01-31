<template>
    <div ref="editor" class="editor ql-editor"></div>
</template>

<script>
import Quill from "quill";
import "quill/dist/quill.core.css";
import "quill/dist/quill.bubble.css";
import "quill/dist/quill.snow.css";
import ImageResize from 'quill-image-resize-module-react';
import hljs from 'highlight.js';
import "highlight.js/styles/github.css"; // Choose any preferred theme
import javascript from 'highlight.js/lib/languages/javascript';

// Then register the languages you need
hljs.registerLanguage('javascript', javascript);
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

        this.editor.root.innerHTML = this.placeholder ?? "";
        this.editor.on("text-change", this.update);
    },

    methods: {
        update() {
            let content = this.editor.root.innerHTML;
            // Convert Quill's div-based code block to <pre><code> to preserve tabs and spaces
            content = content.replace(
                /<div class="ql-code-block">([\s\S]*?)<\/div>/g,
                (match, code) => {
                    return `<pre><code>${this.encodeSpaces(code)}</code></pre>`;
                }
            );
            let new_content = this.replaceSpacesInQlCodeBlocks(content);
            document.querySelector("#floatingTextarea").value = new_content;
            this.$emit(
                "update:modelValue",
                this.editor.getText() ? content : ""
            );
        },

        encodeSpaces(text) {
            // Encode spaces and tabs for proper storage in the database
            return text
                .replace(/^ +/gm, match => '&nbsp;'.repeat(match.length)) // Encode leading spaces
                .replace(/\t/g, '&nbsp;&nbsp;&nbsp;&nbsp;') // Replace tabs with 4 spaces
                .replace(/</g, "&lt;")
                .replace(/>/g, "&gt;");
        },
        replaceSpacesInQlCodeBlocks(htmlContent) {
            // Replace regular spaces within .ql-code-block content with &nbsp;
            return htmlContent.replace(
                /<div class="ql-code-block"[^>]*>([\s\S]*?)<\/div>/g,
                (match, codeLine) => {
                // Replace each space character with &nbsp;
                const modifiedContent = codeLine.replace(/(?<!<[^>]*) /g, '&nbsp;');
                return `<div class="ql-code-block">${modifiedContent}</div>`;
                }
            );
        }
    },
};
</script>

<style>
.editor {
    min-height: 500px;
}
</style>
