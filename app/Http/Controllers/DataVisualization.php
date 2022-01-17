<?php


namespace App\Http\Controllers;

use App\Models\RegionalVoting;
use DB;
class DataVisualization
{
 public function RegionalPerformance()
 {
     $regional_voting_patterns= DB::select('select r.name as Region, SUM(pn.nrm_performance) as NRM, SUM(pn.nup_performance) as NUP,SUM(pn.ant_performance) as ANT, SUM(pn.fdc_performance) as FDC,SUM(pn.dp_performance) AS DP,SUM(PN.independents) AS IND from polling_numbers
        pn inner join district d on pn.district_id = d.district_id
        inner join region r on d.region = r.region_id
        INNER JOIN polling_station ps on ps.location_id=pn.polling_station group by r.region_id');
     return ($regional_voting_patterns);

 }
    public function RegionalVoterTunOut()
    {
       $regional_voter_turnout = DB::select('SELECT r.name as Region,SUM(pn.registered_voters) AS RegisteredVoters,SUM(pn.valid_votes)+SUM(pn.invalid_votes) as TotalVotesCast from  polling_numbers pn
                                inner join district d on pn.district_id = d.district_id
                                inner join region r on d.region = r.region_id group by r.region_id');
       return json_encode($regional_voter_turnout);

    }
}