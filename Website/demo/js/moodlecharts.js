$('#username').load('../backend/APIs.php?option=postName');
var name = $.get('../backend/APIs.php?option=Name',
    function getMessage(name) {
        var message = 'Dear ' + name + ', please choose datasets below:';
        document.getElementById("notice").innerHTML = message;
    });
//Ajax Loading Assignment
$(document).ready(function () {
    $.ajax({
        type: "get",
        async: true,
        url: "../backend/APIs.php?option=LoadCourse",
        dataType: "json",
        success: function (result) {
            var CourseName = [];
            $.each(result, function (i, j) {
                CourseName[i] = j['CourseName'];
                $("#SelectCourse").append(
                    " <option id='" + CourseName[i] + "'>" + CourseName[i] + "</option>"
                );
            });
        }
    });
    $("#SelectCourse").change(function () {
        $("#SelectYear option").remove();
        $("#SelectSemester option").remove();
        $("#SelectAssignment option").remove();
        $("#SelectYear").append(
            " <option id='PleaseSelectYear'>Select Year</option>");
        $("#SelectSemester").append(
            " <option id='PleaseSelectSemester'>Select Semester</option>");
        $("#SelectAssignment").append(
            " <option id='PleaseSelectAssignment'>Select Assignment</option>");
        var SelectCourseId = $("#SelectCourse option:selected").attr("id");
        $.ajax({
            type: "get",
            async: true,
            url: "../backend/APIs.php?option=LoadYear",
            dataType: "json",
            data: { "SelectCourseId": SelectCourseId },
            success: function (result) {
                var SchoolYear = [];
                $.each(result, function (i, j) {
                    SchoolYear[i] = j['SchoolYear'];
                    $("#SelectYear").append(
                        " <option id='" + SchoolYear[i] + "'>" + SchoolYear[i] + "</option>"
                    );
                });
            }
        });
    });
    $("#SelectYear").change(function () {
        $("#SelectSemester option").remove();
        $("#SelectAssignment option").remove();
        $("#SelectSemester").append(
            " <option id='PleaseSelectSemester'>Select Semester</option>");
        $("#SelectAssignment").append(
            " <option id='PleaseSelectSemester'>Select Assignment</option>");
        var SelectCourseId = $("#SelectCourse option:selected").attr("id");
        var SelectYearId = $("#SelectYear option:selected").attr("id");
        $.ajax({
            type: "get",
            async: true,
            url: "../backend/APIs.php?option=LoadSemester",
            dataType: "json",
            data: { "SelectCourseId": SelectCourseId, "SelectYearId": SelectYearId },
            success: function (result) {
                var Semester = [];
                $.each(result, function (i, j) {
                    Semester[i] = j['Semester'];
                    $("#SelectSemester").append(" <option id='" + Semester[i] + "'>"
                        + Semester[i] + "</option>");
                });
            }
        });
    });
    $("#SelectSemester").change(function () {
        $("#SelectAssignment option").remove();
        $("#SelectAssignment").append("<option id='PleaseSelectSemester'>Select Assignment</option>");
        var SelectCourseId = $("#SelectCourse option:selected").attr("id");
        var SelectYearId = $("#SelectYear option:selected").attr("id");
        var SelectSemesterId = $("#SelectSemester option:selected").attr("id");
        $.ajax({
            type: "get",
            async: true,
            url: "../backend/APIs.php?option=LoadAssignment",
            dataType: "json",
            data: { "SelectCourseId": SelectCourseId, "SelectYearId": SelectYearId, "SelectSemesterId": SelectSemesterId },
            success: function (result) {
                var AssignmentName = [];
                $.each(result, function (i, j) {
                    AssignmentName[i] = j['AssignmentName'];
                    $("#SelectAssignment").append(" <option id='" + AssignmentName[i] + "'>" + AssignmentName[i] + "</option>");
                });
            }
        });
    });

})
$('#SelectSemester').change(function () {
    var SelectCourseId = $("#SelectCourse option:selected").attr("id");
    var SelectYearId = $("#SelectYear option:selected").attr("id");
    var SelectSemesterId = $("#SelectSemester option:selected").attr("id");
    var PeriodFrom;
    var PeriodTo;
    switch (SelectYearId) {
        //the start day and end day of semesters in different years are different
        case "2004":
            if (SelectSemesterId == "Semester 1") {
                PeriodFrom = SelectYearId + "0301";
                PeriodTo = SelectYearId + "0630";
            } else if (SelectSemesterId == "Semester 2") {
                PeriodFrom = SelectYearId + "0726";
                PeriodTo = SelectYearId + "1120";
            }
            break;
        case "2005":
            if (SelectSemesterId == "Semester 1") {
                PeriodFrom = SelectYearId + "0228";
                PeriodTo = SelectYearId + "0702";
            } else if (SelectSemesterId == "Semester 2") {
                PeriodFrom = SelectYearId + "0725";
                PeriodTo = SelectYearId + "1119";
            }
            break;
        case "2006":
            if (SelectSemesterId == "Semester 1") {
                PeriodFrom = SelectYearId + "0227";
                PeriodTo = SelectYearId + "0701";
            } else if (SelectSemesterId == "Semester 2") {
                PeriodFrom = SelectYearId + "0724";
                PeriodTo = SelectYearId + "1118";
            }
            break;
        case "2007":
            if (SelectSemesterId == "Semester 1") {
                PeriodFrom = SelectYearId + "0226";
                PeriodTo = SelectYearId + "0630";
            } else if (SelectSemesterId == "Semester 2") {
                PeriodFrom = SelectYearId + "0723";
                PeriodTo = SelectYearId + "1117";
            }
            break;
        case "2008":
            if (SelectSemesterId == "Semester 1") {
                PeriodFrom = SelectYearId + "0303";
                PeriodTo = SelectYearId + "0705";
            } else if (SelectSemesterId == "Semester 2") {
                PeriodFrom = SelectYearId + "0728";
                PeriodTo = SelectYearId + "1122";
            }
            break;
        case "2009":
            if (SelectSemesterId == "Semester 1") {
                PeriodFrom = SelectYearId + "0302";
                PeriodTo = SelectYearId + "0704";
            } else if (SelectSemesterId == "Semester 2") {
                PeriodFrom = SelectYearId + "0727";
                PeriodTo = SelectYearId + "1121";
            }
            break;
        case "2010":
            if (SelectSemesterId == "Semester 1") {
                PeriodFrom = SelectYearId + "0301";
                PeriodTo = SelectYearId + "0703";
            } else if (SelectSemesterId == "Semester 2") {
                PeriodFrom = SelectYearId + "0726";
                PeriodTo = SelectYearId + "1120";
            }
            break;
        case "2011":
            if (SelectSemesterId == "Semester 1") {
                PeriodFrom = SelectYearId + "0228";
                PeriodTo = SelectYearId + "0702";
            } else if (SelectSemesterId == "Semester 2") {
                PeriodFrom = SelectYearId + "0725";
                PeriodTo = SelectYearId + "1129";
            }
            break;
        case "2012":
            if (SelectSemesterId == "Semester 1") {
                PeriodFrom = SelectYearId + "0227";
                PeriodTo = SelectYearId + "0630";
            } else if (SelectSemesterId == "Semester 2") {
                PeriodFrom = SelectYearId + "0723";
                PeriodTo = SelectYearId + "1117";
            }
            break;
        case "2013":
            if (SelectSemesterId == "Semester 1") {
                PeriodFrom = SelectYearId + "0304";
                PeriodTo = SelectYearId + "0705";
            } else if (SelectSemesterId == "Semester 2") {
                PeriodFrom = SelectYearId + "0729";
                PeriodTo = SelectYearId + "1122";
            }
            break;
        case "2014":
            if (SelectSemesterId == "Semester 1") {
                PeriodFrom = SelectYearId + "0303";
                PeriodTo = SelectYearId + "0704";
            } else if (SelectSemesterId == "Semester 2") {
                PeriodFrom = SelectYearId + "0728";
                PeriodTo = SelectYearId + "1121";
            }
            break;
        case "2015":
            if (SelectSemesterId == "Semester 1") {
                PeriodFrom = SelectYearId + "0302";
                PeriodTo = SelectYearId + "0703";
            } else if (SelectSemesterId == "Semester 2") {
                PeriodFrom = SelectYearId + "0727";
                PeriodTo = SelectYearId + "1120";
            }
            break;
        case "2016":
            if (SelectSemesterId == "Semester 1") {
                PeriodFrom = SelectYearId + "0229";
                PeriodTo = SelectYearId + "0702";
            } else if (SelectSemesterId == "Semester 2") {
                PeriodFrom = SelectYearId + "0725";
                PeriodTo = SelectYearId + "1119";
            }
            break;
        case "2017":
            if (SelectSemesterId == "Semester 1") {
                PeriodFrom = SelectYearId + "0227";
                PeriodTo = SelectYearId + "0701";
            } else if (SelectSemesterId == "Semester 2") {
                PeriodFrom = SelectYearId + "0724";
                PeriodTo = SelectYearId + "1118";
            }
            break;
        case "2018":
            if (SelectSemesterId == "Semester 1") {
                PeriodFrom = SelectYearId + "0226";
                PeriodTo = SelectYearId + "0630";
            } else if (SelectSemesterId == "Semester 2") {
                PeriodFrom = SelectYearId + "0723";
                PeriodTo = SelectYearId + "1117";
            }
            break;
        case "2019":
            if (SelectSemesterId == "Semester 1") {
                PeriodFrom = SelectYearId + "0304";
                PeriodTo = SelectYearId + "0706";
            } else if (SelectSemesterId == "Semester 2") {
                PeriodFrom = SelectYearId + "0729";
                PeriodTo = SelectYearId + "1123";
            }
            break;
    }
    $("#StudentActivitiesOverviewFrom").val(PeriodFrom);
    $("#StudentActivitiesOverviewTo").val(PeriodTo);
    $("#AllActivitiesOverviewFrom").val(PeriodFrom);
    $("#AllActivitiesOverviewTo").val(PeriodTo);
    $("#EventNamesOverviewFrom").val(PeriodFrom);
    $("#EventNamesOverviewTo").val(PeriodTo);
    $("#SpecificEventNameOverviewFrom").val(PeriodFrom);
    $("#SpecificEventNameOverviewTo").val(PeriodTo);
    $("#EventContextsOverviewFrom").val(PeriodFrom);
    $("#EventContextsOverviewTo").val(PeriodTo);
    $("#SpecificEventContextOverviewFrom").val(PeriodFrom);
    $("#SpecificEventContextOverviewTo").val(PeriodTo);
    $("#SemesterStartDay").html(PeriodFrom);
    $("#SemesterEndDay").html(PeriodTo);
    displayAssignmentInformation();
})
$('#SelectAssignment').change(function () {
    getAssignmentStartDueDayAndUpdateAllCharts();
})


function displayAssignmentInformation() {
    var SelectCourse = $("#SelectCourse option:selected").attr("id");
    var SelectYear = $("#SelectYear option:selected").attr("id");
    var SelectSemester = $("#SelectSemester option:selected").attr("id");

    $.ajax({
        type: "get",
        async: true, //asynchronous
        url: "../../dashboard/controller.php?type=getAssignmentInformation",
        dataType: "json", //return JSON data
        data: { "SelectCourse": SelectCourse, "SelectYear": SelectYear, "SelectSemester": SelectSemester },
        success: function (result) {
            $("#AssignmentInformation").empty();
            $.each(result, function (i, p) {
                $("#AssignmentInformation").append("<p>" + p['AssignmentName'] + " start day (YYYYMMDD): " + p['StartDate'] + "</p>");
                $("#AssignmentInformation").append("<p>" + p['AssignmentName'] + " due day (YYYYMMDD): " + p['DueDate'] + "</p>");
            });
        }//success
    });//ajax
}

function getAssignmentStartDueDayAndUpdateAllCharts() {
    var SelectCourse = $("#SelectCourse option:selected").attr("id");
    var SelectYear = $("#SelectYear option:selected").attr("id");
    var SelectSemester = $("#SelectSemester option:selected").attr("id");
    var SelectAssignment = $("#SelectAssignment option:selected").attr("id");
    $.ajax({
        type: "get",
        async: true, //asynchronous
        url: "controller.php?type=getAssignmentStartAndDueDay",
        dataType: "json", //return JSON data
        data: { "SelectCourse": SelectCourse, "SelectYear": SelectYear, "SelectSemester": SelectSemester, "SelectAssignment": SelectAssignment },
        success: function (result) {
            $.each(result, function (i, p) {
                $("#StudentActivitiesOverviewFrom").val(p['StartDate']);
                $("#StudentActivitiesOverviewTo").val(p['DueDate']);
                $("#AllActivitiesOverviewFrom").val(p['StartDate']);
                $("#AllActivitiesOverviewTo").val(p['DueDate']);
                $("#EventNamesOverviewFrom").val(p['StartDate']);
                $("#EventNamesOverviewTo").val(p['DueDate']);
                $("#SpecificEventNameOverviewFrom").val(p['StartDate']);
                $("#SpecificEventNameOverviewTo").val(p['DueDate']);
                $("#EventContextsOverviewFrom").val(p['StartDate']);
                $("#EventContextsOverviewTo").val(p['DueDate']);
                $("#SpecificEventContextOverviewFrom").val(p['StartDate']);
                $("#SpecificEventContextOverviewTo").val(p['DueDate']);
            });
        }//success
    });//ajax
}

$(document).ready(function () {
    $("#StudentActivitiesOverviewFrom").datepicker({
        defaultDate: "+1w",
        changeMonth: true,
        changeYear: true,
        numberOfMonths: 3,
        onClose: function (selectedDate) {
            $("#StudentActivitiesOverviewTo").datepicker("option", "minDate", selectedDate);
        }
    });
    $("#StudentActivitiesOverviewTo").datepicker({
        defaultDate: "+1w",
        changeMonth: true,
        changeYear: true,
        numberOfMonths: 3,
        onClose: function (selectedDate) {
            $("#StudentActivitiesOverviewFrom").datepicker("option", "maxDate", selectedDate);
        }
    });

    //set the format (YYYYMMDD) of start date and end date for the chart "Student Activities Overview" 
    $("#StudentActivitiesOverviewFrom").datepicker("option", "dateFormat", "yymmdd");//YYYYMMDD
    $("#StudentActivitiesOverviewTo").datepicker("option", "dateFormat", "yymmdd");//YYYYMMDD
})

var myChartStudentActivitiesOverview = echarts.init(document.getElementById('StudentActivitiesOverview'));
//configuration item and data for the chart
var option = {
	title: {
		// text: 'Student activities overview'
	},
	tooltip: {},
	xAxis: {
		name: 'User',
		data: []
	},
	yAxis: {
		name: 'Amount of activities'
	},
	grid: {
		x: 100,
		y2: 100
	},
	dataZoom: [
		{   // dataZoom component controls x-axis by default
			type: 'slider',
			start: 0, // left position 0%
			end: 100  // right position 100%
		}
	],
	series: [{
		name: 'Amount of activities',
		type: 'bar',
		data: []
	}],
	toolbox: {
		show: true,
		feature: {
			dataView: { readOnly: false },
			magicType: { type: ['line', 'bar'] },
			restore: {},
			saveAsImage: {}
		}
	}
};
// display the chart based on the configuration item and data
myChartStudentActivitiesOverview.setOption(option);


var StudentActivitiesOverviewAmount;//number of bars (number of records)
var StudentActivitiesOverviewDiff = 100;

function studentActivitiesOverviewUpdate() {
	var SelectCourse = $("#SelectCourse option:selected").attr("id");
	var from = $("#StudentActivitiesOverviewFrom").val();
	var to = $("#StudentActivitiesOverviewTo").val();
	var order = $('#StudentActivitiesOverviewPresentationOrder').val();
	var ThresholdSelect = $('#StudentActivitiesOverviewThresholdSelect').val();
	var Threshold = $('#StudentActivitiesOverviewThreshold').val();

	$.ajax({
		type: "get",
		async: true, //asynchronous
		url: "../../dashboard/controller.php?type=studentActivitiesOverview",
		dataType: "json", //return JSON data
		data: { "from": from, "to": to, "order": order, "ThresholdSelect": ThresholdSelect, "Threshold": Threshold, "SelectCourse": SelectCourse},
		success: function (result) {
			var name = [];
			var count = [];
			var amount = [];
			$.each(result, function (i, p) {
				name[i] = p['name'];
				count[i] = p['count'];
				amount[i] = p['amount'];
			});
		StudentActivitiesOverviewAmount = amount[0];
		myChartStudentActivitiesOverview.hideLoading();
		var StudentActivitiesOverviewRelativeAmount = StudentActivitiesOverviewDiff * StudentActivitiesOverviewAmount / 100;
		// the purpose of the following code is to solve the x-label issue to ensure the accuracy and correctness of information, it will determine which stage we are at when loading the data: at the first stage, display no x-label (e-charts display some of the labels by default because there is not enough space to accommodate all the x-labels, this will provide misleading information); at the second stage, display all x-labels at a 90 degree; at the third stage, display all x-labels at a 40 degree; at the last stage, display all x-labels normally (at a 0 degree).
		if (StudentActivitiesOverviewRelativeAmount <= 8.15) {
			myChartStudentActivitiesOverview.setOption({
				xAxis: {
					data: name,
					axisLabel: {
						show: true,
						interval: 'auto',
						rotate: 0
					}
				},
				series: [{
					name: 'Amount of activities',
					data: count
				}]
			});
		} else if (StudentActivitiesOverviewRelativeAmount <= 16.3) {
			myChartStudentActivitiesOverview.setOption({
				xAxis: {
					data: name,
					axisLabel: {
						show: true,
						interval: 0,
						rotate: 40
					}
				},
				series: [{
					name: 'Amount of activities',
					data: count
				}]
			});
		} else if (StudentActivitiesOverviewRelativeAmount <= 48.9) {
			myChartStudentActivitiesOverview.setOption({
				xAxis: {
					data: name,
					axisLabel: {
						show: true,
						interval: 0,
						rotate: 90
					}
				},
				series: [{
					name: 'Amount of activities',
					data: count
				}]
			});
		} else if (StudentActivitiesOverviewRelativeAmount > 48.9) {
			myChartStudentActivitiesOverview.setOption({
				xAxis: {
					data: name,
					axisLabel: {
						show: false
					}
				},
				series: [{
					name: 'Amount of activities',
					data: count
				}]
			});
		}
		}//success
	});//ajax
}
myChartStudentActivitiesOverview.on('datazoom', function (params) {
	var diff = params.end - params.start;//difference between left and right position of the slider
	StudentActivitiesOverviewDiff = diff;
	var StudentActivitiesOverviewRelativeAmount = StudentActivitiesOverviewDiff * StudentActivitiesOverviewAmount / 100;
	if (StudentActivitiesOverviewRelativeAmount < 8.15) {
		myChartStudentActivitiesOverview.setOption({
			xAxis: {
				axisLabel: {
					show: true,
					interval: 'auto',
					rotate: 0
				}

			}
		});
	} else if (StudentActivitiesOverviewRelativeAmount < 16.3) {
		myChartStudentActivitiesOverview.setOption({
			xAxis: {
				axisLabel: {
					show: true,
					interval: 0,
					rotate: 40
				}

			}
		});
	} else if (StudentActivitiesOverviewRelativeAmount < 48.9) {
		myChartStudentActivitiesOverview.setOption({
			xAxis: {
				axisLabel: {
					show: true,
					interval: 0,
					rotate: 90
				}

			}
		});
	} else if (StudentActivitiesOverviewRelativeAmount >= 48.9) {
		myChartStudentActivitiesOverview.setOption({
			xAxis: {
				axisLabel: {
					show: false
				}

			}
		});
	}
});

// After user clicks a bar (a bar represents a user), redirect to another page showing the detailed information of that user (the amount of different events of that user).
myChartStudentActivitiesOverview.on('click', function (param) {
	var from = $("#StudentActivitiesOverviewFrom").val();
	var to = $("#StudentActivitiesOverviewTo").val();
	var SelectCourseId = $("#SelectCourse option:selected").attr("id");
	var SelectYearId = $("#SelectYear option:selected").attr("id");
	var SelectSemesterId = $("#SelectSemester option:selected").attr("id");
	var url = 'StudentActivitiesOverviewDetails.php?user=' + param.name + '&from=' + from + '&to=' + to + '&SelectCourseId=' + SelectCourseId + '&SelectYearId=' + SelectYearId + '&SelectSemesterId=' + SelectSemesterId;
	window.open(url, "_blank");
});
$("#confirm_button").click(function () {
    studentActivitiesOverviewUpdate();
    allActivitiesOverviewUpdate();
    eventNamesOverviewUpdate();
    specificEventNameOverviewUpdate();
    eventContextsOverviewUpdate();
    specificEventContextOverviewUpdate();
})