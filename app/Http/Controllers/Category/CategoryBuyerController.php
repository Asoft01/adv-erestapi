<?php

namespace App\Http\Controllers\Category;

use App\Category;
use App\Http\Controllers\ApiController;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CategoryBuyerController extends ApiController
{
    public function __construct()
    {
        parent::__construct();
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Category $category)
    {
        $buyers = $category->products()
                  ->whereHas('transactions')
                  ->with('transactions.buyer')
                  ->get()
                  ->pluck('transactions')
                  ->collapse()
                  ->pluck('buyer')
                  ->unique('id')
                  ->values();
        return $this->showAll($buyers);
    }
}
