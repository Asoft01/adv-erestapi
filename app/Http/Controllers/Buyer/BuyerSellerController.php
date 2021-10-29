<?php

namespace App\Http\Controllers\Buyer;

use App\Buyer;
use App\Http\Controllers\ApiController;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class BuyerSellerController extends ApiController
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
    public function index(Buyer $buyer)
    {
        // $sellers = $buyer->transactions()->with('product.seller')
        // ->get();

        // Unique is used to remove the repeated sellers. values is used to remove an empty object too
        
         $sellers = $buyer->transactions()->with('product.seller')
                    ->get()
                    // ->pluck('seller') /*********This returns an empty results because the seller is inside the product element just like "product":{"seller": {"id": 1, name:"Adele".....}} *************/
                    ->pluck('product.seller')
                    ->unique('id')
                    ->values();
                
        return $this->showAll($sellers);
    }
}
