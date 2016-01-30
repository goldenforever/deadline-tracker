function add() {
	alert($("#name").val()+"\n"+$("#day").val()+"/"+$("#month").val()+"\n"+$("#cat").val());
}

function refresh() {
		var numItems = $('.date').length;
		var dayArray = [];
		var monthArray = [];
		var dateArray = [];
		var bubbleSort = [];
		var testString = "";
		var currentDate = new Date();
		var deadlineDays;
		var sectionStore;
		var var1;
		var var2;
		for (var i=0;i<numItems;i++) {
				testString = document.getElementsByClassName("date");
				testString = testString[i].innerHTML;
				if (testString.search(" ") >= 0) {//get rid of date, save it
						dayArray[i] = parseInt(testString.substring(0,(testString.search(' '))));
						testString = testString.substring((testString.search(' ')+1),(testString.length));
				}
				switch (testString) {
					case "January" : monthArray[i] = 0; break;
					case "February" : monthArray[i] = 1; break;
					case "March" : monthArray[i] = 2; break;
					case "April" : monthArray[i] = 3; break;
					case "May" : monthArray[i] = 4; break;
					case "June" : monthArray[i] = 5; break;
					case "July" : monthArray[i] = 6; break;
					case "August" : monthArray[i] = 7; break;
					case "September" : monthArray[i] = 8; break;
					case "October" : monthArray[i] = 9; break;
					case "November" : monthArray[i] = 10; break;
					default : monthArray[i] = 11;
				}
				var1 = currentDate.getFullYear();
				if(currentDate.getMonth()<=monthArray[i]) {
						dateArray[i] = new Date(var1, monthArray[i], dayArray[i]);
				} else {
						dateArray[i] = new Date(var1+1, monthArray[i], dayArray[i]);
				}
			
				deadlineDays = Math.ceil(Math.abs((dateArray[i].getTime() - currentDate.getTime())/86400000));
				testString = document.getElementsByClassName("daysuntil");
				if (deadlineDays>1) {
						testString[i].innerHTML = deadlineDays + " Days Until Deadline";
				} else if (deadlineDays==1) {
						testString[i].innerHTML = deadlineDays + " Day Until Deadline";
				} else if (deadlineDays<1) {
						testString[i].innerHTML = "Deadline Today";
				} else {
						testString[i].innerHTML = "";
				}
		}
}
function addDate() {
		var daytoday = new Date();
		$('#todaysdate').html(daytoday.toDateString());
}


var firstWords = [];
$(".itemname").map(function() {firstWords.push(this.innerHTML.split(' ')[0]);});

var colors = [];
var uniques = [];
mainLoop:
for (var i=0; i<firstWords.length; i++) {
    for (var j=0; j<uniques.length; j++) {
	if (firstWords[i] === uniques[j][0]) {
	    continue mainLoop;
	}
    }
    uniques.push([firstWords[i],colorGenerator()]);
}

console.log(uniques);

$(".itemname").map(
	function() {
		for (var i=0;i<uniques.length;i++) {
			if (this.innerHTML.split(' ')[0]===uniques[i][0]) {
				$(this).parent().css("background-color","rgba("+uniques[i][1]+",0.7)");
				$(this).parent().css("border-top-color","rgb("+uniques[i][1]+")");
			}
		}
	}
); 

function colorGenerator() {
    generate:
    while (true) {
	var r = 122;
	var g = 122;
	var b = 122;

	var x = Math.random();
	var y = (1.5-x)*Math.random();
	var z = 1.5-(x+y);

	var sum = x + y + z;

	r += Math.round(110*x/sum);
	g += Math.round(110*y/sum);
	b += Math.round(110*z/sum);

	for (var i=0; i<colors.length; i++) {
	    if ((colors[i][0]-r)*(colors[i][0]-r) + (colors[i][1]-g)*(colors[i][1]-g) + (colors[i][2]-b)*(colors[i][2]-b) < 1500/Math.sqrt(uniques.length)) {
		continue generate;
	    }
    	}
    	colors.push([r,g,b]);      
        return r + "," + g + "," + b;
    }
}

function changeDate() {
		var today = new Date();
		var todaymonth = today.getMonth() + 1;
		var todayday = today.getDate();
		var todayyear = today.getFullYear();
		var today = todayyear + '-' + todaymonth + '-' + todayday;
		$('#todaysdate').attr('value',today);
}
$(document).ready(function() {
		changeDate();
		refresh();
		addDate();
		var i=$("section > div").sort(function(a, b) {
			return parseInt($(a).children(".daysuntil").html().substring(0,$(a).children(".daysuntil").html().indexOf(' '))) - parseInt($(b).children(".daysuntil").html().substring(0,$(b).children(".daysuntil").html().indexOf(' ')));
		});
		var j = i;
		$("section").empty();
		for (var a=0;a<i.length;a++) {
			$("section").append($("<div>").append($(i[a]).clone()).html());
		}
		setInterval(function() {
				refresh();
				addDate();
				i=$("section > div").sort(function(a, b) {
					return parseInt($(a).children(".daysuntil").html().substring(0,$(a).children(".daysuntil").html().indexOf(' '))) - parseInt($(b).children(".daysuntil").html().substring(0,$(b).children(".daysuntil").html().indexOf(' ')));
				});
		}, 10000);

});
