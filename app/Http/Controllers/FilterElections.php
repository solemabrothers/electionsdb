<?php


namespace App\Http\Controllers;


use Illuminate\Http\Request;
use DB;
class FilterElections extends Controller
{
    public function index(Request $request)
    {
        $election_year = $request->input('year');
        $region_id = $request->input('region');

        $year_of_election= DB::table('election_year')->get();
        $region= DB::table('region')->get();

       $header_information= DB::select("SELECT SUM(registered_voters) As Registerd_Voters,
       (SUM(valid_votes)+SUM(invalid_votes)) As Voter_turnOut,
       (round((((SUM(valid_votes)+SUM(invalid_votes))/SUM(registered_voters))*100),2)) As Percentage_turnout, SUM(valid_votes) As Valid_Votes,((SUM(valid_votes)/(SUM(valid_votes)+SUM(invalid_votes))*100)) As Percentage_Valid,
       SUM(invalid_votes) As Invalid_Votes,((SUM(invalid_votes)/(SUM(valid_votes)+SUM(invalid_votes))*100)) As Percentage_Invalid
        from polling_numbers pn INNER JOIN polling_station ps on pn.polling_station = ps.location_id inner join district d on pn.district_id = d.district_id inner join region r on d.region = r.region_id where pn.election_year='$election_year' and r.region_id='$region_id'");


       $district_performance=DB::select("select r.name as Region,d.district_name, SUM(pn.nrm_performance) as NRM, SUM(pn.nup_performance) as NUP,SUM(pn.ant_performance) as ANT, SUM(pn.fdc_performance) as FDC,SUM(pn.dp_performance) AS DP,SUM(PN.independents) AS IND from polling_numbers
        pn inner join district d on pn.district_id = d.district_id
        inner join region r on d.region = r.region_id
        INNER JOIN polling_station ps on ps.location_id=pn.polling_station where r.region_id='$region_id' and pn.election_year='$election_year' group by d.district_id");



    return view('filter',compact('header_information','district_performance','year_of_election','region'));
    }

}