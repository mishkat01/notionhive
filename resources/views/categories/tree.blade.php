<!DOCTYPE html>
<html>
<head>
    <title>Category Tree</title>
</head>
<body>
    <h1>Category Tree with Total Items</h1>
    <ul>
        @foreach ($tree as $category)
            <li>
                {{ $category->CategoryName }} ({{ $category->TotalItems }} items)
                @if (!empty($category->children))
                    @include('categories.tree_child', ['children' => $category->children])
                @endif
            </li>
        @endforeach
    </ul>
</body>
</html>
