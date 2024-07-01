<template>
    <div ref="editor" class="editor"></div>
</template>
<script>
import Quill from "quill";
import "quill/dist/quill.core.css";
import "quill/dist/quill.bubble.css";
import "quill/dist/quill.snow.css";
import ImageResize from 'quill-image-resize-module-react';
Quill.register('modules/imageResize', ImageResize);

export default {
    props: ['placeholder'],
    data() {
        return {
            editor: null,
        };
    },
    mounted() {
        var _this = this;

        this.editor = new Quill(this.$refs.editor, {
            modules: {
                toolbar: [
                    [{ 'font': [] }],
                    [{ 'header': [1, 2, 3, 4, 5, 6, false] }],
                    ['bold', 'italic', 'underline', 'strike'],        // toggled buttons
                    [{ 'color': [] }, { 'background': [] }],          // dropdown with defaults from theme
                    [{ 'script': 'sub' }, { 'script': 'super' }],      // superscript/subscript
                    [{ 'header': '1' }, { 'header': '2' }],           // custom button values
                    [{ 'list': 'ordered' }, { 'list': 'bullet' }],
                    [{ 'indent': '-1' }, { 'indent': '+1' }],          // outdent/indent
                    [{ 'direction': 'rtl' }],                         // text direction
                    [{ 'align': [] }],
                    ['blockquote', 'code-block'],
                    ['link', 'image', 'video'],
                    ['clean']                                         // remove formatting button
                ],
                imageResize: {
                    parchment: Quill.import('parchment'),
                    modules: ['Resize', 'DisplaySize']
                }
            },
            placeholder: 'Compose an epic...',
            theme: 'snow', // or 'bubble'
        });
        this.editor.root.innerHTML = this.placeholder ?? "";
        this.editor.on("text-change", function () {
            return _this.update();
        });
    },

    methods: {
        update: function update() {
            document.querySelector("#floatingTextarea").value = this.editor.root.innerHTML;
            this.$emit(
                "update:modelValue",
                this.editor.getText() ? this.editor.root.innerHTML : ""
            );
        },
    },
};
</script>
<style>
.editor {
    height: 100%;
}
</style>