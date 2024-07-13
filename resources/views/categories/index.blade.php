<!DOCTYPE html>
<html>
<head>
    <title>Categories</title>
</head>
<body>
    <h1>Categories with Total Items</h1>
    <table>
        <tr>
            <th>Category Name</th>
            <th>Total Items</th>
        </tr>
        @foreach ($categories as $category)
            <tr>
                <td>{{ $category->CategoryName }}</td>
                <td>{{ $category->TotalItems }}</td>
            </tr>
        @endforeach
    </table>
</body>
</html>
