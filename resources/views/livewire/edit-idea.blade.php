<div
    x-cloak
    x-data="{ isOpen: false }"
    x-show=isOpen
    @keydown.escape.window="isOpen = false"
    @custom-show-edit-modal.window="
        isOpen = true
        $nextTick(() => $refs.title.focus())
    "
    x-init="
            Livewire.on('ideaUpdated', () => {
                isOpen = false
            })
        "
    class="fixed z-10 inset-0 overflow-y-auto"
    aria-labelledby="modal-title"
    role="dialog"
    aria-modal="true">
    <div class="flex items-end justify-center min-h-screen">
        <div
            x-show.transition.opacity="isOpen"
            class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity"
            aria-hidden="true">
        </div>

      <!-- This element is to trick the browser into centering the modal contents. -->
      <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>

      <div
        x-show.transition.origin.bottom.duration.300ms="isOpen"
        class="modal bg-white rounded-tl-lg rounded-tr-lg overflow-hidden transform transition-all py-4 sm:max-w-lg sm:w-full">
        <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
            <div class="absolute top-0 right-0 pt-4 pr-4">
                <button
                    @click="isOpen = false"
                    class="text-gray-400 hover:text-gray-500">
                    <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
            <h3 class="text-center text-lg font-medium text-gray-900">Edit Idea</h3>
            <p class="text-xs text-center leading-5 text-gray-500 px-6 mt-4">You have one hour to edit the idea from the time of creation</p>
            <form wire:submit.prevent="updateIdea" action="" method="POST" class="space-y-4 px-4 py-6">
                <div>
                    <input type="text" x-ref="title" class="w-full bg-gray-100 text-sm rounded-xl placeholder-gray-900 border-none" wire:model.defer="title" placeholder="Your Idea" required>
                    @error('title')
                        <p class="text-red text-xxs mt-1">{{ $message }}</p>
                    @enderror
                </div>
                <div>
                    <select name="category_add" id="category_add" class="bg-gray-100 w-full rounded-xl px-4 py-2 border-none text-sm" wire:model.defer="category">
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}" id="">{{ $category->name }}</option>
                        @endforeach
                    </select>
                    @error('category')
                        <p class="text-red text-xxs mt-1">{{ $message }}</p>
                    @enderror
                </div>
                <div>
                    <textarea name="idea" id="idea" cols="30" rows="4" class="w-full bg-gray-100 rounded-xl placeholder-gray-900 px-4 py-2 border-none text-sm" placeholder="Describe your idea" wire:model.defer="description" required></textarea>
                    @error('description')
                        <p class="text-red text-xxs mt-1">{{ $message }}</p>
                    @enderror
                </div>
                <div class="flex items-center justify-between space-x-3">
                    <button type="button" class="flex items-center justify-center w-1/2 h-11 text-xs bg-gray-200 font-semibold rounded-xl border border-gray-200 hover:border-gray-400 transition duration-150 ease-in px-6 py-3">
                        <svg class="text-gray-600 w-4 transform -rotate-45" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.172 7l-6.586 6.586a2 2 0 102.828 2.828l6.414-6.586a4 4 0 00-5.656-5.656l-6.415 6.585a6 6 0 108.486 8.486L20.5 13" />
                        </svg>
                        <span class="ml-1">Attach</span>
                    </button>
                    <button type="submit" class="bg-blue flex items-center justify-center w-1/2 h-11 text-xs bg-gray-200 font-semibold rounded-xl border border-blue hover:bg-blue-hover transition duration-150 ease-in px-6 py-3 text-white">
                        <span>Update</span>
                    </button>
                </div>
            </form>

        </div>
      </div>
    </div>
  </div>

