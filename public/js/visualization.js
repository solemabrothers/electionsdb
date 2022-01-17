$(document).ready(function() {
    var margin = {top: 8, right: 30, bottom: 50, left: 60},
        width = 2320 - margin.left - margin.right,
        height = 500 - margin.top - margin.bottom;

    // append the svg object to the body of the page
    var svg = d3.select("#partyperfonamce")
        .append("svg")
        .attr("width", width + margin.left + margin.right)
        .attr("height", height + margin.top + margin.bottom)
        .append("g")
        .attr("transform",
            "translate(" + margin.left + "," + margin.top + ")")
        .attr("style", "outline: thin solid red;");


    // Parse the Data
    d3.json("/visualisation", function (data) {

        // List of subgroups = header of the csv files = soil condition here
        var subgroups = Object.keys(data[0]).slice(1);
        // List of groups = species here = value of the first column called group -> I show them on the X axis
        var groups = d3.map(data, function (d) {
            return (d.Region)
        }).keys()

        // Add X axis
        var x = d3.scaleBand()
            .domain(groups)
            .range([0, width])
            .padding([0.2])
        svg.append("g")
            .attr("transform", "translate(0," + height + ")")
            .call(d3.axisBottom(x).tickSize(0));
        // Add Y axis
        var y = d3.scaleLinear()
            .domain([0, 2000000])
            .range([height, 0]);
        svg.append("g")
            .call(d3.axisLeft(y));


        // Another scale for subgroup position?
        var xSubgroup = d3.scaleBand()
            .domain(subgroups)
            .range([0, x.bandwidth()])
            .padding([0])

        // color palette = one color per subgroup
        var color = d3.scaleOrdinal()
            .domain(subgroups)
            .range(['#ffff00', '#e41a1c', '#8000ff','#377eb8','#4daf4a','#ff8000'])

//Create X axis
        svg.append("g")
            .attr("class", "axis x")
            .attr("transform", "translate(0," + height + ")")
            .call(x);

        svg.append("text")
            .attr("y", 0)
            .attr("text-anchor", "middle")
            .style("font-size", "16px");


        // Show the bars
        svg.append("g")
            .selectAll("g")
            // Enter in data = loop group per group
            .data(data)
            .enter()
            .append("g")
            .attr("transform", function (d) {
                return "translate(" + x(d.Region) + ",0)";
            })
            .selectAll("rect")
            .data(function (d) {
                return subgroups.map(function (key) {
                    return {key: key, value: d[key]};
                });
            })
            .enter().append("rect")
            .attr("x", function (d) {
                return xSubgroup(d.key);
            })

            .attr("y", function (d) {
                return y(d.value);
            })
            .attr("width", 20)
            .attr("height", function (d) {
                return height - y(d.value);
            })
            .attr("fill", function (d) {
                return color(d.key);
            });
    })

});

$(document).ready(function() {

    let fetchData = async () => {
        //I've handily uploaded the data to this site for easy reference.
        let url = "https://api.myjson.com/bins/cgbm8";
        //'fetch()' returns a promise
        let response = await fetch(url);
        //'json()' also returns a promise
        return response.json();
    };

    const width = 900;
    const height = 600;

    const svg = d3.select("#map").append("svg")
        .attr("width", width)
        .attr("height", height);

    const projection = d3.geoAlbersUsa()
        .translate([width / 2, height / 2])    // translate to center of screen
        .scale([1000]);          // scale things down so see entire US

    const path = d3.geoPath().projection(projection);

    fetchData().then(response => {

        const tooltip = d3.select("#map").append("div")
            .attr("class", "tooltip")
            .style("opacity", 0);

        let sampleMap = response.data.map(item => {
            return Number(item.unemploymentRate);
        });
        let domain = selectDivisionNumber(sampleMap).sort();

        //To help generate the scale, https://hihayk.github.io/scale/
        const colorScale = d3.scaleLinear()
            .domain(domain)
            .range(["#00806D", "#00BC4C", "#00F200", "#85FB44"].reverse());

        //This loads our topojson
        d3.json("https://gist.githubusercontent.com/Bradleykingz/3aa5206b6819a3c38b5d73cb814ed470/raw/a476b9098ba0244718b496697c5b350460d32f99/us-states.json", function (error, uState) {
            if (error) throw error;
            _(uState.features)
                .keyBy('properties.name')
                .merge(_.keyBy(response.data, 'State'))
                .values()
                .value();

            svg.selectAll('path')
                .data(uState.features)
                .enter()
                .append('path')
                .attr("d", path)
                .style('transition', "all 0.2s ease-in-out")
                .attr('class', 'state')
                .style('fill', function (d, i) {
                    let uRate = d.unemploymentRate;
                    return uRate ? colorScale(uRate) : "#ccc";
                })
                .on('mousemove', function (d) {
                    tooltip.transition()
                        .duration(200)
                        .style("opacity", .9);

                    tooltip.style("left", (d3.event.pageX) + "px")
                        .style("top", (d3.event.pageY) + "px")
                        .text(() => `${d.State}: ${(d.unemploymentRate * 100).round(2).toFixed(1)}%`)
                })
                .on("mouseover", function (d) {
                    d3.select(this)
                        .style("fill", tinycolor(colorScale(d.unemploymentRate)).darken(15).toString())
                        .style("cursor", "pointer");

                })
                .on("mouseout", function (d, i) {
                    d3.select(this).style("fill", function () {
                        let uRate = d.unemploymentRate;
                        return uRate ? colorScale(uRate) : "#ccc";
                    });

                    tooltip.transition()
                        .duration(500)
                        .style("opacity", 0);
                });

            //create a new SVG in the body
            const legend = d3.select(".home").append('svg')
            //add it with the '.legend' class
                .attr('class', 'legend')
                //it should be 14px wide
                .attr('width', 148)
                //and 148px high
                .attr('height', 148)
                //then either select all the 'g's inside the svg
                //or create placeholders
                .selectAll('g')
                //Fill the data into our placeholders in reverse order
                //This arranges our legend in descending order.
                //The 'data' here is the items we entered in the 'domain',
                //in this case [min, max]
                .data(colorScale.domain().slice().reverse())
                //Every node in teh data should have a 'g' appended
                .enter().append('g')
                //the 'g' should have this attribute
                .attr("transform", function (d, i) {
                    return "translate(0," + i * 20 + ")";
                });
            //Inside every 'legend', insert a rect
            legend.append("rect")
            //that's 18px wide
                .attr("width", 18)
                //and 18px high
                .attr("height", 18)
                //then fill it will the color assigned by the scale
                .style("fill", colorScale);

            legend.append("text")
                .attr("x", 24)
                .attr("y", 9)
                .attr("dy", ".35em")
                .text(function (d) {
                    return `${(d * 100).round(2).toFixed(1)}%`
                });

        })
    })
})


