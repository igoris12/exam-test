<?php

namespace App\Http\Controllers;

use App\Models\member;
use Illuminate\Http\Request;
use App\Models\reservoir;
use Validator;



class MemberController extends Controller
{
    
    const RESULTS_IN_PAGE = 3;

    public function __construct()
    {
        $this->middleware('auth');
    }

    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {   
        if ($request->filter && 'reservoir' == $request->filter) { 
             $members = Member::where('reservoir_id', $request->reservoir_id)->paginate(self::RESULTS_IN_PAGE)->withQueryString();
        }else {
            $members = Member::orderBy('surname')->paginate(self::RESULTS_IN_PAGE)->withQueryString();
        }
        
        
        
        
        
        $reservoirs = Reservoir::orderBy('title')->get();
        
        return view('member.index', ['members' => $members,
         'reservoirs' => $reservoirs,
        'reservoir_id' => $request->reservoir_id ?? '0']);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $reservoirs = Reservoir::orderBy('title')->get();
        return view('member.create', ['reservoirs' => $reservoirs]);

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $experience = $request->member_experience;

         $validator = Validator::make($request->all(),
            [
                'member_name' => ['required', 'min:3', 'max:100'],
                'member_surname' => ['required', 'min:3', 'max:150'],
                'member_live' => ['required', 'min:3', 'max:50'],
                'member_experience' => ['required', 'integer', 'min:1'],
                'member_registered' => ['required', 'integer', 'min:1', "max:$experience" ],
                'reservoir_id' => ['required' ,'integer', 'min:1'],


            ]

            );
            if ($validator->fails()) {
                $request->flash();
                return redirect()->back()->withErrors($validator);
            }


        $member = new Member;
        $member->name = $request->member_name;
        $member->surname = $request->member_surname;
        $member->live = $request->member_live;
        $member->experience = $request->member_experience;
        $member->registered = $request->member_registered;
        $member->reservoir_id = $request->reservoir_id;

        $member->save();
       return redirect()->route('member.index');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\member  $member
     * @return \Illuminate\Http\Response
     */
    public function show(member $member)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\member  $member
     * @return \Illuminate\Http\Response
     */
    public function edit(member $member)
    {
       $reservoirs  =Reservoir::orderBy('title')->get();
       return view('member.edit', ['member' => $member, 'reservoirs' => $reservoirs]);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\member  $member
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, member $member)
    {

         $experience = $request->member_experience;


         $validator = Validator::make($request->all(),
            [
                'member_name' => ['required', 'min:3', 'max:100'],
                'member_surname' => ['required', 'min:3', 'max:150'],
                'member_live' => ['required', 'min:3', 'max:50'],
                'member_experience' => ['required', 'integer', 'min:1'],
                'member_registered' => ['required', 'integer', 'min:1', "max:$experience" ],
                'reservoir_id' => ['required' ,'integer', 'min:1'],


            ]

            );
            if ($validator->fails()) {
                $request->flash();
                return redirect()->back()->withErrors($validator);
            }
        
        $member->name = $request->member_name;
        $member->surname = $request->member_surname;
        $member->live = $request->member_live;
        $member->experience = $request->member_experience;
        $member->registered = $request->member_registered;
        $member->reservoir_id = $request->reservoir_id;

        $member->save();
       return redirect()->route('member.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\member  $member
     * @return \Illuminate\Http\Response
     */
    public function destroy(member $member)
    {
    $member->delete();
       return redirect()->route('member.index');

    }
}
