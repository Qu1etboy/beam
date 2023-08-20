import "./bootstrap";

import Alpine from "alpinejs";
import { Editor } from "@tiptap/core";
import StarterKit from "@tiptap/starter-kit";
import TextAlign from "@tiptap/extension-text-align";
import TextStyle from "@tiptap/extension-text-style";
import { Color } from "@tiptap/extension-color";
import Image from "@tiptap/extension-image";
import Link from "@tiptap/extension-link";
import Youtube from "@tiptap/extension-youtube";
import FontFamily from "@tiptap/extension-font-family";
import Underline from "@tiptap/extension-underline";

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
                        TextStyle,
                        Color,
                        Image,
                        Link.configure({
                            openOnClick: false,
                        }),
                        Youtube,
                        FontFamily,
                        Underline,
                    ],
                    content: content,
                    onCreate({ editor }) {
                        document.getElementById(id).value = editor.getHTML();
                        _this.updatedAt = Date.now();
                    },
                    onUpdate({ editor }) {
                        document.getElementById(id).value = editor.getHTML();
                        _this.updatedAt = Date.now();
                    },
                    onSelectionUpdate({ editor }) {
                        // Update selected font at caret position
                        document.getElementById("select-font").value =
                            editor.getAttributes("textStyle").fontFamily ??
                            "Figtree";

                        document.getElementById("select-color").value =
                            editor.getAttributes("textStyle").color ?? "black";

                        // Update selected typography at caret position
                        const heading = editor.getAttributes("heading");

                        if (Object.keys(heading).length > 0) {
                            document.getElementById("select-typography").value =
                                heading.level;
                        } else {
                            document.getElementById("select-typography").value =
                                "0";
                        }

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
            toggleUnderline() {
                editor.chain().focus().toggleUnderline().run();
            },
            toggleStrike() {
                editor.chain().focus().toggleStrike().run();
            },
            undo() {
                editor.chain().focus().undo().run();
            },
            redo() {
                editor.chain().focus().redo().run();
            },
            setColor(color) {
                editor.chain().focus().setColor(color).run();
            },
            addImage() {
                const url = window.prompt("Image Url");

                if (url) {
                    editor.chain().focus().setImage({ src: url }).run();
                }
            },
            setLink() {
                const previousUrl = editor.getAttributes("link").href;
                const url = window.prompt("URL", previousUrl);

                // cancelled
                if (url === null) {
                    return;
                }

                // empty
                if (url === "") {
                    editor
                        .chain()
                        .focus()
                        .extendMarkRange("link")
                        .unsetLink()
                        .run();

                    return;
                }

                // update link
                editor
                    .chain()
                    .focus()
                    .extendMarkRange("link")
                    .setLink({ href: url })
                    .run();
            },
            addVideo() {
                const url = prompt("Enter YouTube URL");

                editor.commands.setYoutubeVideo({
                    src: url,
                    width: Math.max(320, parseInt(this.width, 10)) || 640,
                    height: Math.max(180, parseInt(this.height, 10)) || 480,
                });
            },
            setFont(fontFamily) {
                editor.chain().focus().setFontFamily(fontFamily).run();
            },
            setTextStyle(opts) {
                if (opts.level === 0) {
                    return editor.commands.setParagraph();
                }
                this.toggleHeading(opts);
            },
        };
    });
});

window.Alpine = Alpine;

Alpine.start();
