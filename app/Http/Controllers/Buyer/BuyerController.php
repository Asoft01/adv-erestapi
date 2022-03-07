<?php

namespace App\Http\Controllers\Buyer;

use App\Buyer;
use App\Http\Controllers\ApiController;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

// class BuyerController extends Controller
// {
    class BuyerController extends ApiController
    {
        public function __construct()
        {
            parent::__construct();
            $this->middleware('scope:read-general')->only('index');
            $this->middleware('can:view, buyer')->only('show');

        }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $buyers = Buyer::has('transactions')->get();
        // return response()->json(['data' => $buyers], 200);
        return $this->showAll($buyers);
    }

    // public function show($id)
    // {
    //     $buyer = Buyer::has('transactions')->findOrFail($id);

    //     // return response()->json(['data' => $buyer], 200);
    //     return $this->showOne($buyer);
    // }

    public function show(Buyer $buyer)
    {
        // $buyer = Buyer::has('transactions')->findOrFail($id);

        // return response()->json(['data' => $buyer], 200);
        return $this->showOne($buyer);
    }
}
