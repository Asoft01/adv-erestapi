<?php

namespace App\Http\Controllers\Seller;

use App\Category;
use App\Http\Controllers\ApiController;
use App\Seller;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SellerCategoryController extends ApiController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Seller $seller)
    {
        //////////// There could exist any product without the categories so there should be a whereHas //////////////////
        $categories = $seller->products()
                    ->whereHas('categories')
                    ->with('categories')
                    ->get()
                    ->pluck('categories')
                    ->collapse()
                    ->unique('id')
                    ->values();
        return $this->showAll($categories);
    }
}
