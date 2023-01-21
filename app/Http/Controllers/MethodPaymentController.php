<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreMethodPaymentRequest;
use App\Http\Requests\UpdateMethodPaymentRequest;
use App\Models\MethodPayment;

class MethodPaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
     * @param  \App\Http\Requests\StoreMethodPaymentRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreMethodPaymentRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\MethodPayment  $methodPayment
     * @return \Illuminate\Http\Response
     */
    public function show(MethodPayment $methodPayment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\MethodPayment  $methodPayment
     * @return \Illuminate\Http\Response
     */
    public function edit(MethodPayment $methodPayment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateMethodPaymentRequest  $request
     * @param  \App\Models\MethodPayment  $methodPayment
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateMethodPaymentRequest $request, MethodPayment $methodPayment)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\MethodPayment  $methodPayment
     * @return \Illuminate\Http\Response
     */
    public function destroy(MethodPayment $methodPayment)
    {
        //
    }
}
