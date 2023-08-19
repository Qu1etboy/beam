<div class="border rounded-lg w-full">
  <template x-if="isLoaded()">
      <!-- Menu -->
      <div class="flex items-center gap-5 p-3 bg-gray-100">
        <button
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
        <button
          type="button"
          @click="toggleHeading({ level: 1 })"
          :class="isActive('heading', { level: 1 }, updatedAt) ? 'text-purple-600' : '' "
        >
          <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-heading-1"><path d="M4 12h8"/><path d="M4 18V6"/><path d="M12 18V6"/><path d="m17 12 3-2v8"/></svg>
          <span class="sr-only">H1</span>
        </button>
        <button
          type="button"
          @click="toggleHeading({ level: 2 })"
          :class="isActive('heading', { level: 2 }, updatedAt) ? 'text-purple-600' : '' "
        >
          <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-heading-2"><path d="M4 12h8"/><path d="M4 18V6"/><path d="M12 18V6"/><path d="M21 18h-4c0-4 4-3 4-6 0-1.5-2-2.5-4-1"/></svg>
          <span class="sr-only">H2</span>
        </button>
        <button
          type="button"
          @click="toggleHeading({ level: 3 })"
          :class="isActive('heading', { level: 3 }, updatedAt) ? 'text-purple-600' : '' "
        >
          <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-heading-3"><path d="M4 12h8"/><path d="M4 18V6"/><path d="M12 18V6"/><path d="M17.5 10.5c1.7-1 3.5 0 3.5 1.5a2 2 0 0 1-2 2"/><path d="M17 17.5c2 1.5 4 .3 4-1.5a2 2 0 0 0-2-2"/></svg>
          <span class="sr-only">H3</span>
        </button>
        <button
          type="button"
          @click="toggleBold()"
          :class="isActive('bold', updatedAt) ? 'text-purple-600' : '' "
        >
          <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-bold"><path d="M14 12a4 4 0 0 0 0-8H6v8"/><path d="M15 20a4 4 0 0 0 0-8H6v8Z"/></svg>
          <span class="sr-only">Bold</span>
        </button>
        <button
          type="button"
          @click="toggleItalic()"
          :class="isActive('italic', updatedAt) ? 'text-purple-600' : '' "
        >
          <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-italic"><line x1="19" x2="10" y1="4" y2="4"/><line x1="14" x2="5" y1="20" y2="20"/><line x1="15" x2="9" y1="4" y2="20"/></svg>
          <span class="sr-only">Italic</span>
        </button>
        <button
          type="button"
          @click="toggleCodeBlock()"
          :class="isActive('codeBlock', updatedAt) ? 'text-purple-600' : '' "
        >
          <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-code"><polyline points="16 18 22 12 16 6"/><polyline points="8 6 2 12 8 18"/></svg>
          <span class="sr-only">Code block</span>
        </button>
         <button
          type="button"
          @click="toggleBlockquote()"
          :class="isActive('blockquote', updatedAt) ? 'text-purple-600' : '' "
        >
          <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-quote"><path d="M3 21c3 0 7-1 7-8V5c0-1.25-.756-2.017-2-2H4c-1.25 0-2 .75-2 1.972V11c0 1.25.75 2 2 2 1 0 1 0 1 1v1c0 1-1 2-2 2s-1 .008-1 1.031V20c0 1 0 1 1 1z"/><path d="M15 21c3 0 7-1 7-8V5c0-1.25-.757-2.017-2-2h-4c-1.25 0-2 .75-2 1.972V11c0 1.25.75 2 2 2h.75c0 2.25.25 4-2.75 4v3c0 1 0 1 1 1z"/></svg>
          <span class="sr-only">Blockquote</span>
        </button>
        <button
          type="button"
          @click="toggleBulletList()"
          :class="isActive('bulletList', updatedAt) ? 'text-purple-600' : '' "
        >
          <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-list"><line x1="8" x2="21" y1="6" y2="6"/><line x1="8" x2="21" y1="12" y2="12"/><line x1="8" x2="21" y1="18" y2="18"/><line x1="3" x2="3.01" y1="6" y2="6"/><line x1="3" x2="3.01" y1="12" y2="12"/><line x1="3" x2="3.01" y1="18" y2="18"/></svg>
          <span class="sr-only">Bullet list</span>
        </button>
        <button
          type="button"
          @click="toggleOrderedList()"
          :class="isActive('orderedList', updatedAt) ? 'text-purple-600' : '' "
        >
          <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-list-ordered"><line x1="10" x2="21" y1="6" y2="6"/><line x1="10" x2="21" y1="12" y2="12"/><line x1="10" x2="21" y1="18" y2="18"/><path d="M4 6h1v4"/><path d="M4 10h2"/><path d="M6 18H4c0-1 2-2 2-3s-1-1.5-2-1"/></svg>
          <span class="sr-only">Ordered list</span>
        </button>
        <button
          type="button"
          @click="textAlign('left')"
          :class="isActive({ textAlign: 'left' }, updatedAt) ? 'text-purple-600' : '' "
        >
          <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-align-left"><line x1="21" x2="3" y1="6" y2="6"/><line x1="15" x2="3" y1="12" y2="12"/><line x1="17" x2="3" y1="18" y2="18"/></svg>
          <span class="sr-only">Left</span>
        </button>
        <button
          type="button"
          @click="textAlign('center')"
          :class="isActive({ textAlign: 'center' }, updatedAt) ? 'text-purple-600' : '' "
        >
          <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-align-center"><line x1="21" x2="3" y1="6" y2="6"/><line x1="17" x2="7" y1="12" y2="12"/><line x1="19" x2="5" y1="18" y2="18"/></svg>
          <span class="sr-only">Center</span>
        </button>
        <button
          type="button"
          @click="textAlign('right')"
          :class="isActive({ textAlign: 'right' }, updatedAt) ? 'text-purple-600' : '' "
        >
          <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-align-right"><line x1="21" x2="3" y1="6" y2="6"/><line x1="21" x2="9" y1="12" y2="12"/><line x1="21" x2="7" y1="18" y2="18"/></svg>
          <span class="sr-only">Right</span>
        </button>
      </div>
  </template>

  <div x-ref="element" class="prose p-3 flex max-w-none rounded-b-lg focus-within:ring-1 focus-within:ring-purple-700"></div>
</div>