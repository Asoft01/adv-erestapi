<?php

namespace App\Http\Controllers\Category;

use App\Category;
use App\Http\Controllers\ApiController;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CategorySellerController extends ApiController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Category $category)
    {
        // There is possibility there exists several products with the same seller in this category, hence we use the unique and values to rebuild the index of this collection
        $sellers = $category->products()
                  ->with('seller')
                  ->get()
                  ->pluck('seller')
                  ->unique()
                  ->values();

        return $this->showAll($sellers);

    }
}
