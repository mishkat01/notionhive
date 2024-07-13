<ul>
    @foreach ($children as $child)
        <li>
            {{ $child->CategoryName }} ({{ $child->TotalItems }} items)
            @if (!empty($child->children))
                @include('categories.tree_child', ['children' => $child->children])
            @endif
        </li>
    @endforeach
</ul>
