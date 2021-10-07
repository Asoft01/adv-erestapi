<?php

namespace App\Http\Controllers\Buyer;

use App\Buyer;
use App\Http\Controllers\ApiController;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class BuyerProductController extends ApiController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Buyer $buyer)
    {
        // There is an error because of the collection, we can obtain the product from collection, then you call the method instead of the relationship
        // $products = $buyer->transactions->product;

        /////////////// First Result ///////////////////
        // $products = $buyer->transactions()->with('product')
        //            ->get();

        ////////////// Second Method to fetch the product itself ///////////////////
        // N.B First Search through the products and 
        /////////////// $buyer->transactions()->with('product')->get() is used to pull out the transactions and product only 
        $products = $buyer->transactions()->with('product')
                   ->get()
                   ->pluck('product');
        return $this->showAll($products);
    }
}
