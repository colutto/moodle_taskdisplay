import * as ajax from 'core/ajax';
import * as notification from 'core/notification';
import * as d3 from './d3-x3d_library/d3';
import * as d3x3d from './d3-x3d_library/d3-x3d';
import * as supportFunct from './supportFunctions';
export let userData;
export let studentsData;
/**
 * The function getChartData retrieves the data via AJAX from the server to the client and converts it
 * into an usable data structure for JavaScript.
 */
export function get_chart_data(){
    var connection = ajax.call([{
        methodname: 'block_taskdisplay_loaddata',
        args: {},
        fail: notification.exception,
    }]);
    connection[0].then(function(data){
        [userData, studentsData] = convertAJAXData(data);
        supportFunct.renewDiv('chartholder');
        var chartholder = d3.select('#chartholder');
        switch(sessionStorage.getItem('userChart')){
            case 'areaChartMultiSeries':
                var userChart = d3x3d.chart.areaChartMultiSeries();
                break;
            case 'ribbonChartMultiSeries':
                var userChart = d3x3d.chart.ribbonChartMultiSeries();
                break;
            default:
                var userChart = d3x3d.chart.barChartMultiSeries();
        }
        chartholder.datum(userData).call(userChart);
        supportFunct.renewDiv('chartholder2');
        var chartholder = d3.select('#chartholder2');
        switch(sessionStorage.getItem('studentsChart')){
            case 'areaChartMultiSeries':
                var studentsChart = d3x3d.chart.areaChartMultiSeries();
                break;
            case 'ribbonChartMultiSeries':
                var studentsChart = d3x3d.chart.ribbonChartMultiSeries();
                break;
            default:
                var studentsChart = d3x3d.chart.barChartMultiSeries();
        }
        chartholder.datum(studentsData).call(studentsChart);
        window.x3dom.reload();
    });
}
/**
 *
 * @param {*} data; The data which gets transferred in JSON structure via AJAX form the server to the client.
 * @returns userData, StudentData; The two return statements represent the two charts. The userData has stored
 * all the information about the courses and assignments from the user, whereas the studetnsData has stored all the
 * information about the average student submissions of every course.
 */
export function convertAJAXData(data){
    var userData = [];
    var studentsData = [];
    for(var key in data){
    /** The for loop iterates through all the courses in the data object. */
        var course = data[key];
        var assignmentsUser = [];
        var assignmentsStudents = [];
        var index = 1;
        for(var assignmentName in course.assignments){
        /** The for loop iterates through all the assignments of each course. */
            var value = course.assignments[assignmentName].is_submitted;
            assignmentsUser.push({key:'EA'+index, value: value});
            var value2 = (course.assignments[assignmentName].totalSubmissions / course.number_of_users) * 100;
            assignmentsStudents.push({key:'EA'+index, value: value2});
            index += 1;
        }
        userData.unshift({key:course.course_name, values:assignmentsUser});
        studentsData.unshift({key:course.course_name, values:assignmentsStudents});
    }
    return[userData, studentsData];
}
export function getUserData(){
    return this.userData;
}
export function getStudentsData(){
    return this.studentsData;
}