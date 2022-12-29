<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreAgentPaymentRequest;
use App\Http\Requests\UpdateAgentPaymentRequest;
use App\Models\AgentPayment;

class AgentPaymentController extends Controller
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
     * @param  \App\Http\Requests\StoreAgentPaymentRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreAgentPaymentRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\AgentPayment  $agentPayment
     * @return \Illuminate\Http\Response
     */
    public function show(AgentPayment $agentPayment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\AgentPayment  $agentPayment
     * @return \Illuminate\Http\Response
     */
    public function edit(AgentPayment $agentPayment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateAgentPaymentRequest  $request
     * @param  \App\Models\AgentPayment  $agentPayment
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateAgentPaymentRequest $request, AgentPayment $agentPayment)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\AgentPayment  $agentPayment
     * @return \Illuminate\Http\Response
     */
    public function destroy(AgentPayment $agentPayment)
    {
        //
    }
}
