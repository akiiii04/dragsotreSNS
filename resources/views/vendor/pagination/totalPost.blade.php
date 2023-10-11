@if ($paginator->hasPages())
    <div class="hidden sm:flex-1 sm:flex sm:items-center">    
        <div>
            <p class="text-sm text-gray-700 leading-5">
                <span class="font-medium">{{ $paginator->total() }}</span>
                {!! __('件のうち') !!}
                @if ($paginator->firstItem())
                    <span class="font-medium">{{ $paginator->firstItem() }}</span>
                    {!! __('件目から') !!}
                    <span class="font-medium">{{ $paginator->lastItem() }}</span>
                @else
                    {{ $paginator->count() }}
                @endif
                {!! __('件目を表示中') !!}
            </p>
        </div>
    </div>
@endif