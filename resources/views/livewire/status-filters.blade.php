<div>
    <nav class="hidden md:flex items-center text-gray-400 justify-between text-xs">
        <ul class="flex uppercase font-semibold space-x-10 border-b-4 pb-3">
            <li><a wire:click.prevent="setStatus('All')" href="" class="border-b-4 pb-3 hover:border-blue @if($status === 'All') border-blue text-gray-900 @endif">All Ideas ({{ $statusCount['all_statuses'] }})</a></li>
            <li><a wire:click.prevent="setStatus('Considering')" href="" class="transition diration-150 ease-in border-b-4 pb-3 hover:border-blue @if($status === 'Considering') border-blue text-gray-900 @endif">Considering ({{ $statusCount['considering'] }})</a></li>
            <li><a wire:click.prevent="setStatus('In Progress')" href="" class="transition duration-150 ease-in border-b-4 pb-3 hover:border-blue @if($status === 'In Progress') border-blue text-gray-900 @endif">In Progress ({{ $statusCount['in_progress'] }})</a></li>
        </ul>

        <ul class="flex uppercase font-semibold space-x-10 border-b-4 pb-3">
            <li><a  wire:click.prevent="setStatus('Implemented')" href="" class="transition duration-150 ease-in border-b-4 pb-3 hover:border-blue @if($status === 'Implemented') border-blue text-gray-900 @endif">Implemented ({{ $statusCount['implemented'] }})</a></li>
            <li><a  wire:click.prevent="setStatus('Closed')" href="" class="transition duration-150 ease-in border-b-4 pb-3 hover:border-blue @if($status === 'Closed') border-blue text-gray-900 @endif">Closed ({{ $statusCount['closed'] }})</a></li>
        </ul>
    </nav>
</div>
