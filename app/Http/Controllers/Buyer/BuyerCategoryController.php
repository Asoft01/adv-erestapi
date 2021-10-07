<?php

namespace App\Http\Controllers\Buyer;

use App\Buyer;
use App\Http\Controllers\ApiController;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class BuyerCategoryController extends ApiController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Buyer $buyer)
    {
        // Collapse is used to create a unique list of the collection inside collection
        // $categories = $buyer->transactions()->with('product.categories')->get()->pluck('product.categories');
        // $categories = $buyer->transactions()
        //              ->with('product.categories')
        //              ->get()
        //              ->pluck('product.categories')

        // unique is used to for unique categories coz there may b repeated categories
        $categories = $buyer->transactions()
                      ->with('product.categories')
                      ->get()
                      ->pluck('product.categories')
                     ->collapse()
                     ->unique('id')
                     ->values();
        return $this->showAll($categories);
        // $sellers = $buyer->transactions()->with('product.seller')

    }
}
