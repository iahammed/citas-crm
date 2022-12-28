<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePaymentsStudentRequest;
use App\Http\Requests\UpdatePaymentsStudentRequest;
use App\Models\PaymentsStudent;

class PaymentsStudentController extends Controller
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
     * @param  \App\Http\Requests\StorePaymentsStudentRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePaymentsStudentRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\PaymentsStudent  $paymentsStudent
     * @return \Illuminate\Http\Response
     */
    public function show(PaymentsStudent $paymentsStudent)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\PaymentsStudent  $paymentsStudent
     * @return \Illuminate\Http\Response
     */
    public function edit(PaymentsStudent $paymentsStudent)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdatePaymentsStudentRequest  $request
     * @param  \App\Models\PaymentsStudent  $paymentsStudent
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePaymentsStudentRequest $request, PaymentsStudent $paymentsStudent)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\PaymentsStudent  $paymentsStudent
     * @return \Illuminate\Http\Response
     */
    public function destroy(PaymentsStudent $paymentsStudent)
    {
        //
    }
}
