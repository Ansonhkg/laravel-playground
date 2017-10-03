<?php

namespace App\Http\Controllers\Kaizen;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use GuzzleHttp\Client as Client;

class KaizenController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $client = new Client;
        $response = $client->get('https://gym.kaizenlancaster.co.uk/api2/slots/');
        $data = $response->getBody();
        $data = (Object) json_decode($data, true);
        $results = $data->results;

        // $slots = [[0],[1],[2],[3],[4],[5],[6]];
        $slots[0] = [];
        $slots[1] = [];
        $slots[2] = [];
        $slots[3] = [];
        $slots[4] = [];
        $slots[5] = [];
        $slots[6] = [];
    
        foreach($results as $key => $slot){
            array_push($slots[$slot['weekday']], $slot);
        }

        // asort($slots[1]);
        
        return view('kaizen.index')->with('slots', $slots);
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
