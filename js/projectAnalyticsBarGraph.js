window.onscroll = function() {myFunction()};

function myFunction() {
	var leftOffset = 300-window.pageXOffset,
		stopPos = $('#svgBarGraph').position().top+$('#svgBarGraph').height()+30;

	if(window.pageYOffset+window.innerHeight > stopPos && window.pageXOffset == 0)
	{
		$('#xBar').css('position', 'absolute');
	  	$('#xBar').css('left', '300px');
	  	$('#xBar').css('top', stopPos+'px');
	}
	else if (window.pageYOffset+window.innerHeight > stopPos && window.pageXOffset > 0)
	{
	  	$('#xBar').css('position', 'fixed');
	  	$('#xBar').css('left', leftOffset+'px');
	  	$('#xBar').css('bottom', '');
	  	$('#xBar').css('top', '');
	}
	else if(window.pageYOffset+window.innerHeight < stopPos && window.pageXOffset > 0)
	{
		$('#xBar').css('position', 'fixed');
	  	$('#xBar').css('left', leftOffset+'px');
	  	$('#xBar').css('top', '');
	  	$('#xBar').css('bottom', '0px');
	}
	else
	{
		$('#xBar').css('position', 'fixed');
	  	$('#xBar').css('left', '300px');
	  	$('#xBar').css('top', '');
	}
}

function switchCriteriaAverageGroup(criteriaID, criteriaTitle, userType)
{

	if(document.getElementById("sortBarsBasic"))
	{
		document.getElementById("sortBarsBasic").parentNode.removeChild(document.getElementById("sortBarsBasic"));
	}
	if(!document.getElementById("sortBarsAverage"))
	{
		d3.select('.projectcontainer').append('div').attr('id', 'sortBarsAverage');

		d3.select('#sortBarsAverage').append("text").html("Sort By: ");
		d3.select('#sortBarsAverage').append("select").attr("class", "standard").attr("id", "sortSelect").on("change", sort);
			d3.select('#sortSelect').append("option").attr("value", "none").html("No Sort");
			d3.select('#sortSelect').append("option").attr("value", "high").html("Highest Average");
			d3.select('#sortSelect').append("option").attr("value", "low").html("Lowest Average");
	}

	sort();
  
	function sort()
	{
		var toDelete = document.getElementById("svgBarGraph");

		if(toDelete)
			toDelete.parentNode.removeChild(toDelete);

		var toDelete = document.getElementById("xBar");

		if(toDelete)
			toDelete.parentNode.removeChild(toDelete);

		var toDelete = document.getElementById("toolTip");

		if(toDelete)
			toDelete.parentNode.removeChild(toDelete);

		var svg = d3.select(".projectcontainer").append("svg").attr("id", "svgBarGraph"),
			svgX =  d3.select(".projectcontainer").append("svg").attr("class", "svgXAxis").attr("id","xBar"),
			margin = {top: 100, right: 20, bottom: 30, left: 80},
		    width = 1080 - margin.left - margin.right,
		    height = 720 - margin.top - margin.bottom,
		  	selectData = [],
		  	select = document.getElementById("sortSelect"),
			selected = select.options[select.selectedIndex].value,
			sortedData,
			tooltip = d3.select("body").append("div").attr("id", "toolTip");


		var x = d3.scaleLinear().range([0, width]);
		var y = d3.scaleBand().range([height, 0]);

		var g = svg.append("g")
				.attr("transform", "translate(" + margin.left + "," + margin.top + ")");

		svg.append("text")
	        .attr("x", (width / 2))             
	        .attr("y", margin.top/2)
	        .attr("text-anchor", "middle")  
	        .style("font-size", "32px") 
	        .style("text-decoration", "bold")  
	        .text(criteriaTitle);

	  	x.domain([0, 5]);

	  	var gX = svgX.append("g")
			.attr("transform", "translate("+margin.left+", 0)")

	    gX.append("g")
	        .attr("class", "x axis")
	      	.call(d3.axisBottom(x)
	      		.ticks(5, ",f")
	      		.tickSizeInner(-5)
	      		.tickSizeOuter(0));

	    var leftOffset = 300-window.pageXOffset;

		if (window.pageXOffset > 0)
		{
			$('#xBar').css('position', 'fixed');
			$('#xBar').css('left', leftOffset+'px');
			$('#xBar').css('bottom', '0px');
		}

	  	d3.json("averageRatingsEvaluationsGroup.json", function(error, data) {
		  	if (error) throw error;

		  	data.forEach(function(d){
				if(d.criteriaID == criteriaID)
				{
					var temp = {};
					temp['average'] = d.average,
					temp['groupTitle'] = d.groupTitle
					temp['criteriaID'] = d.criteriaID
					temp['groupID'] = d.groupID
					temp['criteriaTitle'] = d.criteriaTitle;

					selectData.push(temp);
				}
			});

			if(selected == "high")
			{
				sortedData = selectData.sort(function(a,b){
					return d3.ascending(a.average, b.average);
				});
			}
			else if(selected == "low")
			{
				sortedData = selectData.sort(function(a,b){
					return d3.descending(a.average, b.average);
				});
			}
			else
			{
				sortedData = selectData;
			}

		    y.domain(sortedData.map(function(d) { return d.groupTitle; })).padding(0.1);

		    g.append("g")
		        .attr("class", "y axis")
		        .attr("transform", "translate(-2, 0)")
		        .call(d3.axisLeft(y));

		    g.selectAll(".bar")
		        .data(sortedData)
		      	.enter()
		      	.append("rect")
		        .attr("class", "bar")
		        .attr("x", 0)
		        .attr("height", y.bandwidth())
		        .attr("y", function(d) { return y(d.groupTitle); })
		        .attr("width", function(d) { return x(d.average); })
		        .on("mousemove", function(d){
		            tooltip.style("left", (d3.event.pageX + 5) +"px")
		              .style("top", (d3.event.pageY + 5) + "px")
		              .style("display", "inline-block")
		              .html("Group: " + d.groupTitle + "<br>" + "Average: " + Math.floor(d.average *100)/100);
		        })
		    	.on("mouseout", function(d){ tooltip.style("display", "none");})
		    	.on("click", function(d){
		    		switchCriteriaBaseGroup(d.criteriaID, d.groupID, d.criteriaTitle, d.groupTitle, userType);
		    	});
		});

	}
}

function switchCriteriaAveragePeer(criteriaID, criteriaTitle, userType)
{

	if(document.getElementById("sortBarsBasic"))
	{
		document.getElementById("sortBarsBasic").parentNode.removeChild(document.getElementById("sortBarsBasic"));
	}
	if(!document.getElementById("sortBarsAverage"))
	{
		d3.select('.projectcontainer').append('div').attr('id', 'sortBarsAverage');

		d3.select('#sortBarsAverage').append("text").html("Sort By: ");
		d3.select('#sortBarsAverage').append("select").attr("class", "standard").attr("id", "sortSelect").on("change", sort);
			d3.select('#sortSelect').append("option").attr("value", "none").html("No Sort");
			d3.select('#sortSelect').append("option").attr("value", "high").html("Highest Average");
			d3.select('#sortSelect').append("option").attr("value", "low").html("Lowest Average");
			d3.select('#sortSelect').append("option").attr("value", "alphabet").html("First Name Descending");
			d3.select('#sortSelect').append("option").attr("value", "betabet").html("First Name Ascending");
	}

	sort();
  
	function sort()
	{
		var toDelete = document.getElementById("svgBarGraph");

		if(toDelete)
			toDelete.parentNode.removeChild(toDelete);

		var toDelete = document.getElementById("xBar");

		if(toDelete)
			toDelete.parentNode.removeChild(toDelete);

		var toDelete = document.getElementById("toolTip");

		if(toDelete)
			toDelete.parentNode.removeChild(toDelete);

		d3.json("averageRatingsEvaluationsPeer.json", function(error, data) {

			var svg = d3.select(".projectcontainer").append("svg").attr("id", "svgBarGraph"),
				svgX =  d3.select(".projectcontainer").append("svg").attr("class", "svgXAxis").attr("id","xBar"),
				margin = {top: 100, right: 20, bottom: 30, left: 150},
			    width = 1080 - margin.left - margin.right,
			    height = 720 - margin.top - margin.bottom,
			  	selectData = [],
			  	select = document.getElementById("sortSelect"),
				selected = select.options[select.selectedIndex].value,
				sortedData,
				tooltip = d3.select("body").append("div").attr("id", "toolTip");


			var x = d3.scaleLinear().range([0, width]);
			var y = d3.scaleBand().range([height, 0]);

			var g = svg.append("g")
					.attr("transform", "translate(" + margin.left + "," + margin.top + ")");

			svg.append("text")
		        .attr("x", (width / 2))             
		        .attr("y", margin.top/2)
		        .attr("text-anchor", "middle")  
		        .style("font-size", "32px") 
		        .style("text-decoration", "bold")  
		        .text(criteriaTitle);

		  	x.domain([0, 5]);

		  	var gX = svgX.append("g")
				.attr("transform", "translate("+margin.left+", 0)")

		    gX.append("g")
		        .attr("class", "x axis")
		      	.call(d3.axisBottom(x)
		      		.ticks(5, ",f")
		      		.tickSizeInner(-5)
		      		.tickSizeOuter(0));

		    var leftOffset = 300-window.pageXOffset;

			if (window.pageXOffset > 0)
			{
				$('#xBar').css('position', 'fixed');
				$('#xBar').css('left', leftOffset+'px');
				$('#xBar').css('bottom', '0px');
			}

		  	if (error) throw error;

		  	data.forEach(function(d){
				if(d.criteriaID == criteriaID && d.average > 0)
				{
					var temp = {};
					temp['average'] = d.average,
					temp['targetName'] = d.targetName
					temp['criteriaID'] = d.criteriaID
					temp['targetID'] = d.targetID
					temp['criteriaTitle'] = d.criteriaTitle;

					selectData.push(temp);
				}
			});

			if(selected == "high")
			{
				sortedData = selectData.sort(function(a,b){
					return d3.ascending(a.average, b.average);
				});
			}
			else if(selected == "low")
			{
				sortedData = selectData.sort(function(a,b){
					return d3.descending(a.average, b.average);
				});
			}
			else if(selected == 'alphabet')
			{
				sortedData = selectData.sort(function(a,b){
					return d3.ascending(a.targetName.toUpperCase(), b.targetName.toUpperCase());
				});
			}
			else if(selected == 'betabet')
			{
				sortedData = selectData.sort(function(a,b){
					return d3.descending(a.targetName.toUpperCase(), b.targetName.toUpperCase());
				});
			}
			else
			{
				sortedData = selectData;
			}

		    y.domain(sortedData.map(function(d) { return d.targetName; })).padding(0.1);

		    g.append("g")
		        .attr("class", "y axis")
		        .attr("transform", "translate(-2, 0)")
		        .call(d3.axisLeft(y));

		    g.selectAll(".bar")
		        .data(sortedData)
		      	.enter()
		      	.append("rect")
		        .attr("class", "bar")
		        .attr("x", 0)
		        .attr("height", y.bandwidth())
		        .attr("y", function(d) { return y(d.targetName); })
		        .attr("width", function(d) { return x(d.average); })
		        .on("mousemove", function(d){
		            tooltip.style("left", (d3.event.pageX + 5) +"px")
		              .style("top", (d3.event.pageY + 5) + "px")
		              .style("display", "inline-block")
		              .html("User: " + d.targetName + "<br>" + "Average: " + Math.floor(d.average *100)/100);
		        })
		    	.on("mouseout", function(d){ tooltip.style("display", "none");})
		    	.on("click", function(d){
		    		switchCriteriaBasePeer(d.criteriaID, d.targetID, d.criteriaTitle, d.targetName, userType);
		    	});
		});

	}
}

function switchCriteriaBaseGroup(criteriaID, groupID, criteriaTitle, groupTitle, userType)
{

	if(document.getElementById("sortBarsAverage"))
	{
		document.getElementById("sortBarsAverage").parentNode.removeChild(document.getElementById("sortBarsAverage"));
	}
	if(!document.getElementById("sortBarsBasic"))
	{
		d3.select('.projectcontainer').append('div').attr('id', 'sortBarsBasic');

		d3.select('#sortBarsBasic').append("text").html("Sort By: ");
		d3.select('#sortBarsBasic').append("select").attr("class", "standard").attr("id", "sortSelect").on("change", sort);
			d3.select('#sortSelect').append("option").attr("value", "none").html("No Sort");
			d3.select('#sortSelect').append("option").attr("value", "high").html("Highest Rating");
			d3.select('#sortSelect').append("option").attr("value", "low").html("Lowest Rating");
			if(userType != "user")
			{
				d3.select('#sortSelect').append("option").attr("value", "alphabet").html("First Name Descending");
				d3.select('#sortSelect').append("option").attr("value", "betabet").html("First Name Ascending");
			}
	}

	sort();
	
	function sort()
	{
		var toDelete = document.getElementById("svgBarGraph");

		if(toDelete)
			toDelete.parentNode.removeChild(toDelete);

		var toDelete = document.getElementById("xBar");

		if(toDelete)
			toDelete.parentNode.removeChild(toDelete);

		var toDelete = document.getElementById("toolTip");

		if(toDelete)
			toDelete.parentNode.removeChild(toDelete);

		var svg = d3.select(".projectcontainer").append("svg").attr("id", "svgBarGraph").on("click", function(d){switchCriteriaAverageGroup(criteriaID, criteriaTitle, userType);}),
			svgX =  d3.select(".projectcontainer").append("svg").attr("class", "svgXAxis").attr("id","xBar"),
		    margin = {top: 100, right: 20, bottom: 30, left: 150},
		    width = 1080 - margin.left - margin.right,
		  	selectData = [],
		  	select = document.getElementById("sortSelect"),
			selected = select.options[select.selectedIndex].value,
			sortedData,
		    height = 720 - margin.top - margin.bottom;
  
		var tooltip = d3.select("body").append("div").attr("id", "toolTip");
		  
		var x = d3.scaleLinear().range([0, width]);
		var y = d3.scaleBand().range([height, 0]);

		svg.append("text")
	        .attr("x", (width / 2))             
	        .attr("y", margin.top/2)
	        .attr("text-anchor", "middle")  
	        .style("font-size", "32px") 
	        .style("text-decoration", "bold")  
	        .text(criteriaTitle+" - "+groupTitle);

		var g = svg.append("g")
				.attr("transform", "translate(" + margin.left + "," + margin.top + ")");

	  	x.domain([0, 5]);
		  
		d3.json("baseRatingsEvaluationsGroup.json", function(error, data) {
		  	if (error) throw error;

		  	data.forEach(function(d){
				if(d.criteriaID == criteriaID && d.groupID == groupID)
				{
					var temp = {};
					temp['rating'] = d.rating,
					temp['groupTitle'] = d.groupTitle,
					temp['criteriaID'] = d.criteriaID,
					temp['groupID'] = d.groupID,
					temp['criteriaTitle'] = d.criteriaTitle,
					temp['author'] = d.author,
					temp['comment'] = d.comment;

					selectData.push(temp);
				}
			});

			if(selected == "high")
			{
				sortedData = selectData.sort(function(a,b){
					return d3.ascending(a.rating, b.rating);
				});
			}
			else if(selected == "low")
			{
				sortedData = selectData.sort(function(a,b){
					return d3.descending(a.rating, b.rating);
				});
			}
			else if(selected == 'alphabet')
			{
				sortedData = selectData.sort(function(a,b){
					return d3.ascending(a.author.toUpperCase(), b.author.toUpperCase());
				});
			}
			else if(selected == 'betabet')
			{
				sortedData = selectData.sort(function(a,b){
					return d3.descending(a.author.toUpperCase(), b.author.toUpperCase());
				});
			}
			else
			{
				sortedData = selectData;
			}

		  	if(userType == "user")
		  	{
		  		sortedData.forEach(function(d, i){
		  			d.author = "Anonymous "+(i+1);
		  		});
		  	}
		
		  	var yDomain = sortedData.map(function(d, i) { return d.author; });
		  
		    y.domain(yDomain).padding(0.1);

		    g.append("g")
		        .attr("class", "y axis")
		        .attr("transform", "translate(-2, 0)")
		        .call(d3.axisLeft(y));

		    g.selectAll(".bar")
		        .data(sortedData)
		      	.enter().append("rect")
		        .attr("class", "bar")
		        .attr("x", 0)
		        .attr("height", y.bandwidth())
		        .attr("y", function(d) { return y(d.author); })
		        .attr("width", function(d) { return x(d.rating); })
		    	.on("mousemove", function(d){
		            tooltip.style("left", (d3.event.pageX + 5) +"px")
		              .style("top", (d3.event.pageY + 5) + "px")
		              .style("display", "inline-block")
		              .html("Rating: " + Math.floor(d.rating *100)/100 + "<br> Comment: " + d.comment);
		        })
		    	.on("mouseout", function(d){ tooltip.style("display", "none");});
		});

		var gX = svgX.append("g")
				.attr("transform", "translate("+margin.left+", 0)")

	    gX.append("g")
	        .attr("class", "x axis")
	      	.call(d3.axisBottom(x)
	      		.ticks(5, ",f")
	      		.tickSizeInner(-5)
	      		.tickSizeOuter(0));

	    var leftOffset = 300-window.pageXOffset;

		if (window.pageXOffset > 0)
		{
			$('#xBar').css('position', 'fixed');
			$('#xBar').css('left', leftOffset+'px');
			$('#xBar').css('bottom', '0px');
		}
	}
}

function switchCriteriaBasePeer(criteriaID, targetID, criteriaTitle, targetName, userType)
{
	if(document.getElementById("sortBarsAverage"))
	{
		document.getElementById("sortBarsAverage").parentNode.removeChild(document.getElementById("sortBarsAverage"));
	}
	if(!document.getElementById("sortBarsBasic"))
	{
		d3.select('.projectcontainer').append('div').attr('id', 'sortBarsBasic');

		d3.select('#sortBarsBasic').append("text").html("Sort By: ");
		d3.select('#sortBarsBasic').append("select").attr("class", "standard").attr("id", "sortSelect").on("change", sort);
			d3.select('#sortSelect').append("option").attr("value", "none").html("No Sort");
			d3.select('#sortSelect').append("option").attr("value", "high").html("Highest Rating");
			d3.select('#sortSelect').append("option").attr("value", "low").html("Lowest Rating");
			if(userType != "user")
			{
				d3.select('#sortSelect').append("option").attr("value", "alphabet").html("First Name Descending");
				d3.select('#sortSelect').append("option").attr("value", "betabet").html("First Name Ascending");
			}
	}

	sort();
	
	function sort()
	{
		var toDelete = document.getElementById("svgBarGraph");

		if(toDelete)
			toDelete.parentNode.removeChild(toDelete);

		var toDelete = document.getElementById("xBar");

		if(toDelete)
			toDelete.parentNode.removeChild(toDelete);

		var toDelete = document.getElementById("toolTip");

		if(toDelete)
			toDelete.parentNode.removeChild(toDelete);

		var svg = d3.select(".projectcontainer").append("svg").attr("id", "svgBarGraph").on("click", function(d){switchCriteriaAveragePeer(criteriaID, criteriaTitle, userType);}),
			svgX =  d3.select(".projectcontainer").append("svg").attr("class", "svgXAxis").attr("id","xBar"),
		    margin = {top: 100, right: 20, bottom: 30, left: 150},
		    width = 1080 - margin.left - margin.right,
		  	selectData = [],
		  	select = document.getElementById("sortSelect"),
			selected = select.options[select.selectedIndex].value,
			sortedData,
		    height = 720 - margin.top - margin.bottom;
  
		var tooltip = d3.select("body").append("div").attr("id", "toolTip");
		  
		var x = d3.scaleLinear().range([0, width]);
		var y = d3.scaleBand().range([height, 0]);

		svg.append("text")
	        .attr("x", (width / 2))             
	        .attr("y", margin.top/2)
	        .attr("text-anchor", "middle")  
	        .style("font-size", "32px") 
	        .style("text-decoration", "bold")  
	        .text(criteriaTitle+" - "+targetName);

		var g = svg.append("g")
				.attr("transform", "translate(" + margin.left + "," + margin.top + ")");

	  	x.domain([0, 5]);
		  
		d3.json("baseRatingsEvaluationsPeer.json", function(error, data) {
		  	if (error) throw error;

		  	data.forEach(function(d){
				if(d.criteriaID == criteriaID && d.targetID == targetID)
				{
					var temp = {};
					temp['rating'] = d.rating,
					temp['targetName'] = d.targetName,
					temp['criteriaID'] = d.criteriaID,
					temp['targetID'] = d.targetID,
					temp['criteriaTitle'] = d.criteriaTitle,
					temp['author'] = d.author,
					temp['comment'] = d.comment;

					selectData.push(temp);
				}
			});

			console.log(selectData);

			if(selected == "high")
			{
				sortedData = selectData.sort(function(a,b){
					return d3.ascending(a.rating, b.rating);
				});
			}
			else if(selected == "low")
			{
				sortedData = selectData.sort(function(a,b){
					return d3.descending(a.rating, b.rating);
				});
			}
			else if(selected == 'alphabet')
			{
				sortedData = selectData.sort(function(a,b){
					return d3.ascending(a.author.toUpperCase(), b.author.toUpperCase());
				});
			}
			else if(selected == 'betabet')
			{
				sortedData = selectData.sort(function(a,b){
					return d3.descending(a.author.toUpperCase(), b.author.toUpperCase());
				});
			}
			else
			{
				sortedData = selectData;
			}

		  	if(userType == "user")
		  	{
		  		sortedData.forEach(function(d, i){
		  			d.author = "Anonymous "+(i+1);
		  		});
		  	}
		
		  	var yDomain = sortedData.map(function(d, i) { return d.author; });
		  
		    y.domain(yDomain).padding(0.1);

		    g.append("g")
		        .attr("class", "y axis")
		        .attr("transform", "translate(-2, 0)")
		        .call(d3.axisLeft(y));

		    g.selectAll(".bar")
		        .data(sortedData)
		      	.enter().append("rect")
		        .attr("class", "bar")
		        .attr("x", 0)
		        .attr("height", y.bandwidth())
		        .attr("y", function(d) { return y(d.author); })
		        .attr("width", function(d) { return x(d.rating); })
		    	.on("mousemove", function(d){
		            tooltip.style("left", (d3.event.pageX + 5) +"px")
		              .style("top", (d3.event.pageY + 5) + "px")
		              .style("display", "inline-block")
		              .html("Rating: " + Math.floor(d.rating *100)/100 + "<br> Comment: " + d.comment);
		        })
		    	.on("mouseout", function(d){ tooltip.style("display", "none");});
		});

		var gX = svgX.append("g")
				.attr("transform", "translate("+margin.left+", 0)")

	    gX.append("g")
	        .attr("class", "x axis")
	      	.call(d3.axisBottom(x)
	      		.ticks(5, ",f")
	      		.tickSizeInner(-5)
	      		.tickSizeOuter(0));

	    var leftOffset = 300-window.pageXOffset;

		if (window.pageXOffset > 0)
		{
			$('#xBar').css('position', 'fixed');
			$('#xBar').css('left', leftOffset+'px');
			$('#xBar').css('bottom', '0px');
		}
	}
}