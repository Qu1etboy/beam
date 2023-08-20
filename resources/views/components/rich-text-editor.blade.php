<div class="border rounded-lg w-full">
  <template x-if="isLoaded()">
      <!-- Menu -->
      <div class="flex flex-wrap items-center gap-5 p-3 bg-gray-100">
        {{-- <button
          type="button"
          @click="undo()"
          :disabled="!editor.can().chain().focus().undo().run()"
        >
          <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-undo"><path d="M3 7v6h6"/><path d="M21 17a9 9 0 0 0-9-9 9 9 0 0 0-6 2.3L3 13"/></svg>
          <span class="sr-only">undo</span>
        </button>
        <button
          type="button"
          @click="redo()"
          :disabled="!editor.can().chain().focus().redo().run()"
        >
          <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-redo"><path d="M21 7v6h-6"/><path d="M3 17a9 9 0 0 1 9-9 9 9 0 0 1 6 2.3l3 2.7"/></svg>
          <span class="sr-only">redo</span>
        </button>

        <div class="border-l border-1 border-gray-300 h-[25px]"></div> --}}

        <input
          type="color"
          id="select-color"
          class="w-6 appearance-none bg-transparent rounded-lg border-none"
          @input="setColor($event.target.value)"
          {{-- :value="getEditor().getAttributes('textStyle').color" --}}
        >

        <div class="border-l border-1 border-gray-300 h-[25px]"></div>

        <select
          id="select-font"
          class="border-gray-300 rounded-lg py-2 text-sm focus:outline-none focus:ring-purple-700 bg-gray-50"
          @input="setFont($event.target.value)"
        >
          <option value="Figtree" selected>Sans Serif</option>
          <option value="Inter">Inter</option>
          <option value="Comic Sans MS, Comic Sans">Comic Sans</option>
          <option value="serif">Serif</option>
          <option value="monospace">Monospace</option>
          <option value="cursive">Cursive</option>
        </select>


        <div class="border-l border-1 border-gray-300 h-[25px]"></div>

        <select
          id="select-typography"
          class="border-gray-300 rounded-lg py-2 text-sm focus:outline-none focus:ring-purple-700 bg-gray-50"
          @input="setTextStyle({ level: +$event.target.value })"
          {{-- :value="getEditor().getAttributes('textStyle').heading" --}}
        >
          <option value="0" selected>Paragraph</option>
          <option value="1">Heading 1</option>
          <option value="2">Heading 2</option>
          <option value="3">Heading 3</option>
          <option value="4">Heading 4</option>
          <option value="5">Heading 5</option>
          <option value="6">Heading 6</option>
        </select>

        <div class="border-l border-1 border-gray-300 h-[25px]"></div>

        <button
          type="button"
          @click="toggleBold()"
          :class="isActive('bold', updatedAt) ? 'text-purple-600' : '' "
        >
          <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-bold"><path d="M14 12a4 4 0 0 0 0-8H6v8"/><path d="M15 20a4 4 0 0 0 0-8H6v8Z"/></svg>
          <span class="sr-only">Bold</span>
        </button>
        <button
          type="button"
          @click="toggleItalic()"
          :class="isActive('italic', updatedAt) ? 'text-purple-600' : '' "
        >
          <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-italic"><line x1="19" x2="10" y1="4" y2="4"/><line x1="14" x2="5" y1="20" y2="20"/><line x1="15" x2="9" y1="4" y2="20"/></svg>
          <span class="sr-only">Italic</span>
        </button>
        <button
          type="button"
          @click="toggleUnderline()"
          :class="isActive('underline', updatedAt) ? 'text-purple-600' : '' "
        >
          <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-underline"><path d="M6 4v6a6 6 0 0 0 12 0V4"/><line x1="4" x2="20" y1="20" y2="20"/></svg>
          <span class="sr-only">Underline</span>
        </button>
        <button
          type="button"
          @click="toggleStrike()"
          :class="isActive('strike', updatedAt) ? 'text-purple-600' : '' "
        >
          <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-strikethrough"><path d="M16 4H9a3 3 0 0 0-2.83 4"/><path d="M14 12a4 4 0 0 1 0 8H6"/><line x1="4" x2="20" y1="12" y2="12"/></svg>
          <span class="sr-only">Strike</span>
        </button>

        <button
          type="button"
          @click="toggleCodeBlock()"
          :class="isActive('codeBlock', updatedAt) ? 'text-purple-600' : '' "
        >
          <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-code"><polyline points="16 18 22 12 16 6"/><polyline points="8 6 2 12 8 18"/></svg>
          <span class="sr-only">Code block</span>
        </button>
         <button
          type="button"
          @click="toggleBlockquote()"
          :class="isActive('blockquote', updatedAt) ? 'text-purple-600' : '' "
        >
          <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-quote"><path d="M3 21c3 0 7-1 7-8V5c0-1.25-.756-2.017-2-2H4c-1.25 0-2 .75-2 1.972V11c0 1.25.75 2 2 2 1 0 1 0 1 1v1c0 1-1 2-2 2s-1 .008-1 1.031V20c0 1 0 1 1 1z"/><path d="M15 21c3 0 7-1 7-8V5c0-1.25-.757-2.017-2-2h-4c-1.25 0-2 .75-2 1.972V11c0 1.25.75 2 2 2h.75c0 2.25.25 4-2.75 4v3c0 1 0 1 1 1z"/></svg>
          <span class="sr-only">Blockquote</span>
        </button>

        <div class="border-l border-1 border-gray-300 h-[25px]"></div>

        <button
          type="button"
          @click="toggleBulletList()"
          :class="isActive('bulletList', updatedAt) ? 'text-purple-600' : '' "
        >
          <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-list"><line x1="8" x2="21" y1="6" y2="6"/><line x1="8" x2="21" y1="12" y2="12"/><line x1="8" x2="21" y1="18" y2="18"/><line x1="3" x2="3.01" y1="6" y2="6"/><line x1="3" x2="3.01" y1="12" y2="12"/><line x1="3" x2="3.01" y1="18" y2="18"/></svg>
          <span class="sr-only">Bullet list</span>
        </button>
        <button
          type="button"
          @click="toggleOrderedList()"
          :class="isActive('orderedList', updatedAt) ? 'text-purple-600' : '' "
        >
          <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-list-ordered"><line x1="10" x2="21" y1="6" y2="6"/><line x1="10" x2="21" y1="12" y2="12"/><line x1="10" x2="21" y1="18" y2="18"/><path d="M4 6h1v4"/><path d="M4 10h2"/><path d="M6 18H4c0-1 2-2 2-3s-1-1.5-2-1"/></svg>
          <span class="sr-only">Ordered list</span>
        </button>

        <div class="border-l border-1 border-gray-300 h-[25px]"></div>

        <button
          type="button"
          @click="textAlign('left')"
          :class="isActive({ textAlign: 'left' }, updatedAt) ? 'text-purple-600' : '' "
        >
          <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-align-left"><line x1="21" x2="3" y1="6" y2="6"/><line x1="15" x2="3" y1="12" y2="12"/><line x1="17" x2="3" y1="18" y2="18"/></svg>
          <span class="sr-only">Left</span>
        </button>
        <button
          type="button"
          @click="textAlign('center')"
          :class="isActive({ textAlign: 'center' }, updatedAt) ? 'text-purple-600' : '' "
        >
          <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-align-center"><line x1="21" x2="3" y1="6" y2="6"/><line x1="17" x2="7" y1="12" y2="12"/><line x1="19" x2="5" y1="18" y2="18"/></svg>
          <span class="sr-only">Center</span>
        </button>
        <button
          type="button"
          @click="textAlign('right')"
          :class="isActive({ textAlign: 'right' }, updatedAt) ? 'text-purple-600' : '' "
        >
          <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-align-right"><line x1="21" x2="3" y1="6" y2="6"/><line x1="21" x2="9" y1="12" y2="12"/><line x1="21" x2="7" y1="18" y2="18"/></svg>
          <span class="sr-only">Right</span>
        </button>

        <div class="border-l border-1 border-gray-300 h-[25px]"></div>

        <button
          type="button"
          @click="setLink()"
        >
          <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-link"><path d="M10 13a5 5 0 0 0 7.54.54l3-3a5 5 0 0 0-7.07-7.07l-1.72 1.71"/><path d="M14 11a5 5 0 0 0-7.54-.54l-3 3a5 5 0 0 0 7.07 7.07l1.71-1.71"/></svg>
          <span class="sr-only">Link</span>
        </button>
        <button
          type="button"
          @click="addImage()"
        >
          <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-image"><rect width="18" height="18" x="3" y="3" rx="2" ry="2"/><circle cx="9" cy="9" r="2"/><path d="m21 15-3.086-3.086a2 2 0 0 0-2.828 0L6 21"/></svg>
          <span class="sr-only">Image</span>
        </button>
        <button
          type="button"
          @click="addVideo()"
        >
          <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-video"><path d="m22 8-6 4 6 4V8Z"/><rect width="14" height="12" x="2" y="6" rx="2" ry="2"/></svg>
          <span class="sr-only">Video</span>
        </button>
      </div>
  </template>

  <div x-ref="element" class="prose p-3 flex max-w-none rounded-b-lg focus-within:ring-1 focus-within:ring-purple-700"></div>
</div>