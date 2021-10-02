<?php

namespace App\Http\Controllers\Seller;

use App\Http\Controllers\ApiController;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Seller;

// class SellerController extends Controller
// {
    class SellerController extends ApiController
    {
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sellers = Seller::has('products')->get();
        // return response()->json(['data' => $sellers], 200);
        return $this->showAll($sellers);
    }

    // public function show($id)
    // {
    //     $seller = Seller::has('products')->findorFail($id);
    //     // return response()->json(['data'=> $seller], 200);
    //     return $this->showOne($seller);
    // }

    public function show(Seller $seller)
    {
        return $this->showOne($seller);
    }

}
