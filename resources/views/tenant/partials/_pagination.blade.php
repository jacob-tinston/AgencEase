<div class="mt-5">
    <div class="card lg:flex">
        <nav class="flex flex-wrap gap-2 p-5">
            <a href="{{ $collection->first_page_url }}" class="btn btn_primary">First</a>

            @for($i = 1; $i <= $collection->last_page; $i++)
                @if ($i == $collection->current_page)
                    <a href="?page={{ $i }}" class="btn btn_primary">{{ $i }}</a>
                @else
                    <a href="?page={{ $i }}" class="btn btn_outlined btn_primary">{{ $i }}</a>
                @endif
            @endfor

            <a href="{{ $collection->last_page_url }}" class="btn btn_secondary">Last</a>
        </nav>

        <div class="flex items-center ltr:ml-auto rtl:mr-auto p-5 border-t lg:border-t-0 border-divider whitespace-nowrap">
            Displaying {{ $collection->from }}-{{ $collection->to }} of {{ $collection->total }} items
        </div>

        <div class="flex items-center gap-2 p-5 border-t lg:border-t-0 lg:ltr:border-l lg:rtl:border-r border-divider">
            <span>Show</span>
            <div class="dropdown">
                <button class="btn btn_outlined btn_secondary" data-toggle="dropdown-menu" aria-expanded="false">
                    {{ auth()->user()->per_page }}
                    <span class="ltr:ml-3 rtl:mr-3 la la-caret-down text-xl leading-none"></span>
                </button>
                <div class="dropdown-menu">
                    <a href="{{ route('users.per-page', ['id' => auth()->user()->id, 'per_page' => 5]) }}">5</a>
                    <a href="{{ route('users.per-page', ['id' => auth()->user()->id, 'per_page' => 15]) }}">15</a>
                    <a href="{{ route('users.per-page', ['id' => auth()->user()->id, 'per_page' => 25]) }}">25</a>
                    <a href="{{ route('users.per-page', ['id' => auth()->user()->id, 'per_page' => 50]) }}">50</a>
                </div>
            </div>
            <span>items</span>
        </div>
    </div>
</div>
