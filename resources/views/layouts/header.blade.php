
<h4>UGANDA ELECTIONS DAHSBOARD PORTAL

<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal" style="margin-left: 300px;"> Filter</button></h4>

<div id="myModal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Filter Elections Data</h4>
            </div>
            <div class="modal-body">
                <form class="form-inline" method="GET" action={{action('FilterElections@index')}} id="filterdata">
                    <div class="form-group">
                        <table class="table" id="filtertable">
                            <tr>
                                <td><label id="label">Year of Election</label></td>
                                <td><select class="form-control form-control-lg" name="year">
                                        <option></option>
                                        @foreach($year_of_election as $year)
                                            {
                                            <option value="{{$year->election_year_id}}">{{$year->election_year}}</option>
                                            }
                                        @endforeach
                                    </select></td>
                            </tr>
                            </select></td>
                            </tr>
                            <tr>
                                <td><label id="label">REGION</label></td>
                                  <td><select class="form-control form-control-lg" name="region">
                                          <option></option>
                                          @foreach($region as $region)
                                              {
                                              <option value="{{$region->region_id}}">{{$region->name}}</option>
                                              }
                                          @endforeach
                                      </select></td>
                            </tr>

                        </table>
                        <div class="modal-footer">
                            <input type="Submit" class="btn btn-success" value="Filter" name="filter"/>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


