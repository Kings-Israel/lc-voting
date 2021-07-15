<div
        class="relative"
        x-data="{ isOpen: false }"
        x-init="
            window.livewire.on('statusUpdated', () => {
                isOpen = false
            })
        "
    >
    <button type="button" @click="isOpen = !isOpen" class="flex items-center justify-center w-36 h-11 text-sm bg-gray-200 font-semibold rounded-xl border border-gray-200 hover:border-gray-400 transition duration-150 ease-in px-6 py-3 mt-2 md:mt-0">
        <span>Set Status</span>
        <svg class="h-4 w-4 ml-2" viewBox="0 0 20 20" fill="currentColor">
            <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
          </svg>
    </button>
    <div
        x-cloak
        x-show.transition.origin.top.left.duration.150ms="isOpen"
        @click.away="isOpen = false"
        @keydown.escape.window = "isOpen = false"
        class="absolute z-20 w-64 md:w-76 text-left font-semibold rounded-xl text-sm bg-white shadow-dialog mt-2">
        <form wire:submit.prevent="setStatus" action="" class="space-y-4 px-4 py-6">
            <div class="space-y-2">
                <div>
                    <label for="" class="inline-flex items-center"></label>
                    <input wire:model="status" type="radio" class="bg-gray-200 text-gray border-none" name="status" value="1">
                    <span class="ml-2">Open</span>
                </div>
                <div>
                    <label for="" class="inline-flex items-center"></label>
                    <input wire:model="status" type="radio" name="status" class="bg-gray-200 text-purple border-none" value="2">
                    <span class="ml-2">Considering</span>
                </div>
                <div>
                    <label for="" class="inline-flex items-center"></label>
                    <input wire:model="status" type="radio" name="status" class="bg-gray-200 text-green border-none" value="3">
                    <span class="ml-2">Implemented</span>
                </div>
                <div>
                    <label for="" class="inline-flex items-center"></label>
                    <input wire:model="status" type="radio" name="status" class="bg-gray-200 text-yellow border-none" value="4">
                    <span class="ml-2">In Progess</span>
                </div>
                <div>
                    <label for="" class="inline-flex items-center"></label>
                    <input wire:model="status" type="radio" name="status" class="bg-gray-200 text-red border-none" value="5">
                    <span class="ml-2">Closed</span>
                </div>
            </div>

            <div>
                <textarea name="update_comment" id="" cols="30" rows="3" class="w-full text-sm bg-gray-100 rounded-xl placeholder-gray-900 border-none px-4 py-2" placeholder="Add an update comment (optional)"></textarea>
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

            <div>
                <label for="" class="font-normal inline-flex items-center">
                    <input type="checkbox" name="notify_voters" id="" class="bg-gray-200 rounded" checked="">
                    <span class="ml-1">Notify All Voters</span>
                </label>
            </div>
        </form>
    </div>
</div>
