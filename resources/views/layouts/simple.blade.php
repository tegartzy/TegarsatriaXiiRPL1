@if ($paginator->hasPages())
    <ul class="pagination">
        @foreach ($paginator->items() as $item)
            <li class="page-item {{ $item['url'] ? '' : 'disabled' }}">
                <a class="page-link" href="{{ $item['url'] }}">{{ $item['text'] }}</a>
            </li>
        @endforeach
    </ul>
@endif