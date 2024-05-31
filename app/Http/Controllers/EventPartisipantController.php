<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;
use App\Models\EventPartisipant;
use App\Services\EventParticipantService;

class EventPartisipantController extends Controller
{
    private EventParticipantService $service;

    public function __construct(EventParticipantService $service) {
        $this->service = $service;
    }
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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Event $event)
    {
        if($this->service->handleCreate($event, auth()->user()->id) == 'limit') {
            return redirect()->back()->with('error','Kuota peserta sudah penuh');
        }
        return redirect()->back()->with("success", "Berhasil mengikuti event");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\EventPartisipant  $eventPartisipant
     * @return \Illuminate\Http\Response
     */
    public function show(EventPartisipant $eventPartisipant)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\EventPartisipant  $eventPartisipant
     * @return \Illuminate\Http\Response
     */
    public function edit(EventPartisipant $eventPartisipant)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\EventPartisipant  $eventPartisipant
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, EventPartisipant $eventPartisipant)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\EventPartisipant  $eventPartisipant
     * @return \Illuminate\Http\Response
     */
    public function destroy(EventPartisipant $eventPartisipant)
    {
        //
    }
}
