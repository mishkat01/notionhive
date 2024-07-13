<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CategoryController extends Controller
{
    public function showCategoriesWithItems()
    {
        $categories = DB::table('category')
            ->leftJoin('Item_category_relations', 'category.Id', '=', 'Item_category_relations.categoryId')
            ->select('category.Name as CategoryName', DB::raw('COUNT(Item_category_relations.ItemNumber) as TotalItems'))
            ->groupBy('category.Name')
            ->orderBy('TotalItems', 'DESC')
            ->get();

        return view('categories.index', ['categories' => $categories]);
    }

    public function showCategoryTreeWithItems()
    {
        $categories = DB::table('category')
            ->leftJoin('Item_category_relations', 'category.Id', '=', 'Item_category_relations.categoryId')
            ->leftJoin('catetory_relations', 'category.Id', '=', 'catetory_relations.categoryId')
            ->select('category.Id', 'category.Name as CategoryName', 'catetory_relations.ParentcategoryId', DB::raw('COUNT(Item_category_relations.ItemNumber) as TotalItems'))
            ->groupBy('category.Id', 'category.Name', 'catetory_relations.ParentcategoryId')
            ->get();

        $tree = $this->buildTree($categories);

        return view('categories.tree', ['tree' => $tree]);
    }

    private function buildTree($categories, $parentId = null)
    {
        $branch = array();
        foreach ($categories as $category) {
            if ($category->ParentcategoryId == $parentId) {
                $children = $this->buildTree($categories, $category->Id);
                if ($children) {
                    $category->children = $children;
                    $category->TotalItems += array_sum(array_column($children, 'TotalItems'));
                }
                $branch[] = $category;
            }
        }
        return $branch;
    }
}
