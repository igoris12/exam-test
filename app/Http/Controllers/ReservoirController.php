<?php

namespace App\Http\Controllers;

use App\Models\reservoir;
use Illuminate\Http\Request;
use Validator;

class ReservoirController extends Controller
{
    const RESULTS_IN_PAGE = 3;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $reservoirs = Reservoir::orderBy('area', 'desc')->paginate(self::RESULTS_IN_PAGE)->withQueryString();
        return view('reservoir.index', ['reservoirs' => $reservoirs]);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('reservoir.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {   
        $validator = Validator::make($request->all(),
            [
                'reservoir_title' => ['required', 'min:2', 'max:200'],
                'reservoir_area' => ['required', 'integer', 'min:1'],
                'reservoir_about' => ['required'],

            ]

            );
            if ($validator->fails()) {
                $request->flash();
                return redirect()->back()->withErrors($validator);
            }

        $reservoir = new Reservoir;
        $reservoir->title = $request->reservoir_title;
        $reservoir->area = $request->reservoir_area;
        $reservoir->about = $request->reservoir_about;

        $reservoir->save();
        return redirect()->route('reservoir.index')->with('success_message', 'New Reservoir added successful.');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\reservoir  $reservoir
     * @return \Illuminate\Http\Response
     */
    public function show(reservoir $reservoir)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\reservoir  $reservoir
     * @return \Illuminate\Http\Response
     */
    public function edit(reservoir $reservoir)
    {
        return view('reservoir.edit', ['reservoir' => $reservoir]);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\reservoir  $reservoir
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, reservoir $reservoir)
    {

         $validator = Validator::make($request->all(),
            [
                'reservoir_title' => ['required', 'min:2', 'max:200'],
                'reservoir_area' => ['required', 'integer', 'min:1'],
                'reservoir_about' => ['required'],

            ]

            );
            if ($validator->fails()) {
                $request->flash();
                return redirect()->back()->withErrors($validator);
            }

        $reservoir->title = $request->reservoir_title;
        $reservoir->area = $request->reservoir_area;
        $reservoir->about = $request->reservoir_about;

        $reservoir->save();
        return redirect()->route('reservoir.index')->with('success_message', 'Update was successful.');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\reservoir  $reservoir
     * @return \Illuminate\Http\Response
     */
    public function destroy(reservoir $reservoir)
    {
        if($reservoir->getMember->count()){
       return redirect()->route('reservoir.index')->with('info_message', 'Reservoir cant be deleted.');


       }
       $reservoir->delete();
       return redirect()->route('reservoir.index')->with('success_message', 'Delete was successful.');
;

    }
    
}
