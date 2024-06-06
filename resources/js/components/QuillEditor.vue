<template>
    <div ref="editor" class="editor"></div>
</template>
<script>
import Quill from "quill";
import "quill/dist/quill.core.css";
import "quill/dist/quill.bubble.css";
import "quill/dist/quill.snow.css";

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
                    [{ header: [1, 2, false] }],
                    ['bold', 'italic', 'underline'],
                    ['image', 'code-block'],
                ],
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
    height: 300px;
}
</style>