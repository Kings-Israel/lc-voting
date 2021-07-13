<div>
    <nav class="hidden md:flex items-center text-gray-400 justify-between text-xs">
        <ul class="flex uppercase font-semibold space-x-10 border-b-4 pb-3">
            <li><a wire:click.prevent="setStatus('All')" href="" class="border-b-4 pb-3 hover:border-blue @if($status === 'All') border-blue text-gray-900 @endif">All Ideas (67)</a></li>
            <li><a wire:click.prevent="setStatus('Considering')" href="" class="transition diration-150 ease-in border-b-4 pb-3 hover:border-blue @if($status === 'Considering') border-blue text-gray-900 @endif">Considering (7)</a></li>
            <li><a wire:click.prevent="setStatus('In Progress')" href="" class="transition duration-150 ease-in border-b-4 pb-3 hover:border-blue @if($status === 'In Progress') border-blue text-gray-900 @endif">In Progress (9)</a></li>
        </ul>

        <ul class="flex uppercase font-semibold space-x-10 border-b-4 pb-3">
            <li><a  wire:click.prevent="setStatus('Implemented')" href="" class="transition duration-150 ease-in border-b-4 pb-3 hover:border-blue @if($status === 'Implemented') border-blue text-gray-900 @endif">Implemented (10)</a></li>
            <li><a  wire:click.prevent="setStatus('Closed')" href="" class="transition duration-150 ease-in border-b-4 pb-3 hover:border-blue @if($status === 'Closed') border-blue text-gray-900 @endif">Closed (8)</a></li>
        </ul>
    </nav>
</div>
