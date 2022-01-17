<?php


namespace App\Http\Controllers;
use DB;


class ElectionsController
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
//    public function __construct()
//    {
//        $this->middleware('auth');
//    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {

        $electionssummary= DB::select('SELECT SUM(registered_voters) As Registerd_Voters,
       (SUM(valid_votes)+SUM(invalid_votes)) As Voter_turnOut,
       (round((((SUM(valid_votes)+SUM(invalid_votes))/SUM(registered_voters))*100),2)) As Percentage_turnout, SUM(valid_votes) As Valid_Votes,((SUM(valid_votes)/(SUM(valid_votes)+SUM(invalid_votes))*100)) As Percentage_Valid,
       SUM(invalid_votes) As Invalid_Votes,((SUM(invalid_votes)/(SUM(valid_votes)+SUM(invalid_votes))*100)) As Percentage_Invalid
        from polling_numbers where election_year=10001');

        //re//turn view('home');
        print_r($electionssummary);
    }

}