@extends('layouts.base')

@section('body')
    <main>
        <div class="w-full lg:h-screen">
            <div class="lg:ml-[275px]">
                <div class="top-0">
                    @include('layouts.subviews.organizer-navbar', ['organizer' => $organizer])
                </div>

                <div id="sidebar" class="hidden lg:block lg:fixed top-0 left-0 lg:w-[275px]">
                    @include('layouts.subviews.sidebar')
                </div>
                
                <div class="p-4">
                    @yield('content')
                </div>
            </div>

            @if ($errors->any())
                <div
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2000)"
                    class="flex items-center justify-between fixed top-0 w-full z-50 bg-red-500 px-20 py-6 text-white"
                >
                    {{ __('Your input is incorrect. Please verify and try again.') }}
                    <button @click="show = false">
                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-x"><path d="M18 6 6 18"/><path d="m6 6 12 12"/></svg>
                    </button>
                </div>
            @endif
        </div>
    </main>

    <script>
        function toggleMenu() {
            const menu = document.getElementById('sidebar');
            if (menu.classList.contains('hidden')) {
                menu.classList.remove('hidden')
            } else {
                menu.classList.add('hidden')
            }
        }

        function multiselect(config) {
            return {
            items: config.items ?? [],

            allItems: null,

            selectedItems: config.selectedItems || [],

            search: config.search ?? "",

            searchPlaceholder: config.searchPlaceholder ?? "Type here...",

            expanded: config.expanded ?? false,

            emptyText: config.emptyText ?? "No items found...",

            allowDuplicates: config.allowDuplicates ?? false,

            size: config.size ?? 4,

            itemHeight: config.itemHeight ?? 40,

            maxItemChars: config.maxItemChars ?? 50,

            maxTagChars: config.maxTagChars ?? 25,

            activeIndex: -1,

            onInit() {
                // Set the allItems array since we want to filter later on and keep the original (items) array as reference
                this.allItems = [...this.items];

                this.$watch("filteredItems", (newValues, oldValues) => {
                // Reset the activeIndex whenever the filteredItems array changes
                if (newValues.length !== oldValues.length) this.activeIndex = -1;
                });

                this.$watch("selectedItems", (newValues, oldValues) => {
                if (this.allowDuplicates) return;

                // Remove already selected items from the items (allItems) array (if allowDuplicates is false)
                this.allItems = this.items.filter((item, idx, all) =>
                    newValues.every((n) => n.value !== item.value)
                );
                });

                // Scroll to active element whenever activeIndex changes (if expanded is true and we have a value)
                this.$watch("activeIndex", (newValue, oldValue) => {
                if (
                    this.activeIndex == -1 ||
                    !this.filteredItems[this.activeIndex] ||
                    !this.expanded
                )
                    return;

                this.scrollToActiveElement();
                });

            },

            handleBlur(e) {
                // If the current active element (relatedTarget) is a child element of the component itself, return
                // Note: The current active element must have a tabindex attribute set in order to appear as a relatedTarget
                if (this.$el.contains(e.relatedTarget)) {
                return;
                }

                this.reset();
            },

            reset() {
                // 1) Clear the search value
                this.search = "";

                // 2) Close the list
                this.expanded = false;

                // 3) Reset the active index
                this.activeIndex = -1;
            },

            handleItemClick(item) {
                // 1) Add the item
                this.selectedItems.push(item);

                // 2) Reset the search input
                this.search = "";

                // 3) Keep the focus on the search input
                this.$refs.searchInput.focus();
            },

            selectNextItem() {
                if (!this.filteredItems.length) return;

                // Array count starts at 0, so we abstract 1
                if (this.filteredItems.length - 1 == this.activeIndex) {
                return (this.activeIndex = 0);
                }

                this.activeIndex++;
            },

            selectPrevItem() {
                if (!this.filteredItems.length) return;

                if (this.activeIndex == 0 || this.activeIndex == -1)
                return (this.activeIndex = this.filteredItems.length - 1);

                this.activeIndex--;
            },

            addActiveItem() {
                if (!this.filteredItems[this.activeIndex]) return;

                this.selectedItems.push(this.filteredItems[this.activeIndex]);

                this.search = "";
            },

            scrollToActiveElement() {
                // Remove the first two child elements since they are <template> tags
                const availableListElements = [...this.$refs.listBox.children].slice(
                2,
                -1
                );

                // Scroll to active <li> element
                availableListElements[this.activeIndex].scrollIntoView({
                block: "end",
                });
            },

            removeElementByIdx(itemIdx) {
                this.selectedItems.splice(itemIdx, 1);

                // Focus the input element to keep the blur functionlity
                // otherwise @focusout on the root element will not be triggered
                if (!this.selectedItems.length) this.$refs.searchInput.focus();
            },

            shortenedLabel(label, maxChars) {
                return !maxChars || label.length <= maxChars
                ? label
                : `${label.substr(0, maxChars)}...`;
            },

            get filteredItems() {
                return this.allItems.filter((item) =>
                item.label.toLowerCase().includes(this.search?.toLowerCase())
                );
            },

            get listBoxStyle() {
                // We add 2 since there is border that takes space
                return {
                maxHeight: `${this.size * this.itemHeight + 2}px`,
                };
            },
            };
        } 


    </script>

    
@endsection
