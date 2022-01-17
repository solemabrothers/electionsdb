@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        @include('layouts.header')
        <div class="card" id="title">ELECTIONS DATA SUMMARY</div>
        <div class="row">
            <div class="col-12 col-sm-6 col-md-3">
                <div class="info-box mb-3">
                    <span class="info-box-icon bg-warning elevation-1"><i class="fas fa-users"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">Registered Voters</span>
                        <span class="info-box-number">{{number_format($electionssummary[0]->Registerd_Voters)}}</span>
                    </div>
                    <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
            </div>
            <div class="col-12 col-sm-6 col-md-3">
                <div class="info-box mb-3">
                    <span class="info-box-icon bg-warning elevation-1"><i class="fas fa-users"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">Voter Turn Out</span>
                        <span class="info-box-number">{{number_format($electionssummary[0]->Voter_turnOut)}}</span>
                    </div>
                    <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
            </div>
            <!-- /.col -->
            <div class="col-12 col-sm-6 col-md-3">
                <div class="info-box mb-3">
                    <span class="info-box-icon bg-warning elevation-1"><i class="fas fa-users"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">Valid Votes</span>
                        <span class="info-box-number">{{number_format($electionssummary[0]->Valid_Votes)}}</span>
                    </div>
                    <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
            </div>
            <!-- /.col -->
            <div class="col-12 col-sm-6 col-md-3">
                <div class="info-box mb-2">
                    <span class="info-box-icon bg-warning elevation-1"><i class="fas fa-users"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">Valid Votes</span>
                        <span class="info-box-number">{{number_format($electionssummary[0]->Invalid_Votes)}}</span>
                    </div>
                    <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
            </div>
            <!-- /.col -->
        </div>
            <!-- /.info-box -->
    </div>

    <div class="card" id="title">POLITICAL PARTY PERFORMANCE BY REGION </div>
    <div class="row">
        <div class="col-12" id="partyperfonamce">

        </div>
    </div>
    <div class="row">
            <div class="col-lg-6" id="regions2">

                <script>
                    // set the dimensions and margins of the graph
                    var margin = {top: 10, right: 20, bottom: 50, left: 60},
                        width = 500 - margin.left - margin.right,
                        height = 500 - margin.top - margin.bottom;

                    // append the svg object to the body of the page
                    var svg = d3.select("#regions2")
                        .append("svg")
                        .attr("width", width + margin.left + margin.right)
                         .attr("height", height + margin.top + margin.bottom)
                        .append("g")
                        .attr("transform",
                            "translate(" + margin.left + "," + margin.top + ")")
                        .attr("style", "outline: thin solid red;");

                    // Parse the Data
                    d3.json("/regionvoterturnout", function(data) {

                        // List of subgroups = header of the csv files = soil condition here
                        var subgroups =  Object.keys(data[0]).slice(1);

                        // List of groups = species here = value of the first column called group -> I show them on the X axis
                        var groups = d3.map(data, function(d){return(d.Region)}).keys()

                        // Add X axis
                        var x = d3.scaleBand()
                            .domain(groups)
                            .range([0, width])
                            .padding([0.1])
                        svg.append("g")
                            .attr("transform", "translate(0," + height + ")")
                            .call(d3.axisBottom(x).tickSize(0))
                            .selectAll("text")
                            .attr("transform", "translate(-10,0)rotate(-45)")
                            .style("text-anchor", "end");

                        // Add Y axis
                        var y = d3.scaleLinear()
                            .domain([0, 6000000])
                            .range([ height, 0 ]);
                        svg.append("g")
                            .call(d3.axisLeft(y));

                        // Another scale for subgroup position?
                        var xSubgroup = d3.scaleBand()
                            .domain(subgroups)
                            .range([0, x.bandwidth()])
                            .padding([0.05])

                        // color palette = one color per subgroup
                        var color = d3.scaleOrdinal()
                            .domain(subgroups)
                            .range(['#e41a1c','#377eb8','#4daf4a'])

                        // Show the bars
                        svg.append("g")
                            .selectAll("g")
                            // Enter in data = loop group per group
                            .data(data)
                            .enter()
                            .append("g")
                            .attr("transform", function(d) { return "translate(" + x(d.Region) + ",0)"; })
                            .selectAll("rect")
                            .data(function(d) { return subgroups.map(function(key) { return {key: key, value: d[key]}; }); })
                            .enter().append("rect")
                            .attr("x", function(d) { return xSubgroup(d.key); })
                            .attr("y", function(d) { return y(d.value); })
                            .attr("width", xSubgroup.bandwidth())
                            .attr("height", function(d) { return height - y(d.value); })
                            .attr("fill", function(d) { return color(d.key); });
                    })


                </script>
        </div>
        <div class="col-6" id="map">

        </div>

    </div>
    </div>
@endsection
