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
    
    // The ApiController is the base controller where the secured middleware resides 
    public function __construct()
    {
        parent::__construct();
        $this->middleware('scope:read-general')->only('show');
    }
    
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
