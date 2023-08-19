import "./bootstrap";

import Alpine from "alpinejs";
import { Editor } from "@tiptap/core";
import StarterKit from "@tiptap/starter-kit";
import TextAlign from "@tiptap/extension-text-align";

document.addEventListener("alpine:init", () => {
    Alpine.data("editor", (content, id) => {
        let editor;

        return {
            id,
            updatedAt: Date.now(), // force Alpine to rerender on selection change
            init() {
                const _this = this;

                editor = new Editor({
                    element: this.$refs.element,
                    extensions: [
                        StarterKit,
                        TextAlign.configure({
                            types: ["heading", "paragraph"],
                        }),
                    ],
                    content: content,
                    onCreate({ editor }) {
                        _this.updatedAt = Date.now();
                    },
                    onUpdate({ editor }) {
                        document.getElementById(id).value = editor.getHTML();
                        _this.updatedAt = Date.now();
                    },
                    onSelectionUpdate({ editor }) {
                        _this.updatedAt = Date.now();
                    },
                });
            },
            getEditor() {
                return editor;
            },
            isLoaded() {
                return editor;
            },
            isActive(type, opts = {}) {
                return editor.isActive(type, opts);
            },
            toggleHeading(opts) {
                editor.chain().toggleHeading(opts).focus().run();
            },
            toggleBold() {
                editor.chain().toggleBold().focus().run();
            },
            toggleItalic() {
                editor.chain().toggleItalic().focus().run();
            },
            textAlign(position) {
                editor.chain().focus().setTextAlign(position).run();
            },
            toggleBulletList() {
                editor.chain().focus().toggleBulletList().run();
            },
            toggleOrderedList() {
                editor.chain().focus().toggleOrderedList().run();
            },
            toggleCodeBlock() {
                editor.chain().focus().toggleCodeBlock().run();
            },
            toggleBlockquote() {
                editor.chain().focus().toggleBlockquote().run();
            },
            undo() {
                editor.chain().focus().undo().run();
            },
            redo() {
                editor.chain().focus().redo().run();
            },
        };
    });
});

window.Alpine = Alpine;

Alpine.start();
