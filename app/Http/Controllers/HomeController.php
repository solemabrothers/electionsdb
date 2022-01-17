<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use function MongoDB\BSON\toJSON;

class HomeController extends Controller
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

        $regional_voting_patterns= DB::select('select r.name, SUM(pn.nrm_performance) as NRM, SUM(pn.nup_performance) as NUP,SUM(pn.ant_performance) as ANT, SUM(pn.fdc_performance) as FDC,SUM(pn.dp_performance) AS DP,SUM(PN.independents) AS IND from polling_numbers
        pn inner join district d on pn.district_id = d.district_id
        inner join region r on d.region = r.region_id
        INNER JOIN polling_station ps on ps.location_id=pn.polling_station group by r.region_id');


        $year_of_election= DB::table('election_year')->get();
        $region= DB::table('region')->get();


        return view('home',compact('electionssummary','regional_voting_patterns','year_of_election','region'));
    }
}
