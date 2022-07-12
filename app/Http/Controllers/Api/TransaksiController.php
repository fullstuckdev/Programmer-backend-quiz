<?php

namespace App\Http\Controllers\Api;

use App\Models\Transaksi;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\TransaksiResource;
use Illuminate\Support\Facades\Validator;

class TransaksiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      return new TransaksiResource(Transaksi::all());   
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
            //set validation
        $validator = Validator::make($request->all(), [
            'product_id'   => 'required',
            'payment_id' => 'required',
            'customer_addreas_id' => 'required'
        ]);

        //response error validation
        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        //save to database
        $post = Transaksi::create([
            'product_id'   => $request->product_id,
            'payment_id' => $request->payment_id,
            'customer_addreas_id' => $request->customer_addreas_id
        ]);

        return new TransaksiResource($post);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Transaksi $post)
    {
    return new TransaksiResource($post);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Transaksi $post)
    {
        //set validation
        $validator = Validator::make($request->all(), [
            'product_id'   => 'required',
            'payment_id' => 'required',
            'customer_addreas_id' => 'required'
        ]);

        //response error validation
        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        //update to database
        $post->update([
            'product_id'   => $request->product_id,
            'payment_id' => $request->payment_id,
            'customer_addreas_id' => $request->customer_addreas_id
        ]);

        return new TransaksiResource($post);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Transaksi $post)
    {
      $post->delete();
        
        return new TransaksiResource($post);
    }
}
