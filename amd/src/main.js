/**
 * The main Javascript page for the Task Display plugin.
 *
 * @package block_taskdisplay
 * @license http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 * @author Stefan Colutto
 */
import * as d3 from './d3-x3d_library/d3';
import * as d3x3d from './d3-x3d_library/d3-x3d';
import 'block_taskdisplay/x3dom';
import * as supportFunct from './supportFunctions';
/**
 *
 * @param {*} data Stores all the courses the user is enrolled in and the
 * to the courses related assignments.
 */
export function initialise(data) {
    var chartholder = d3.select('#chartholder');
    var my_data = [];
    var keys = Object.keys(data);
    for (var i=0; i<keys.length; i++){
        // loops through all the user enrolled courses.
        alert(keys[i]);
        var values = [];
        var index = 1;
        for (var object in data[keys[i]]){
            // loops through all the course related assignments.
            // alert(object+' '+data[keys[i]][object]);
            if (data[keys[i]][object]=='submitted'){
                values.push({key: 'EA'+index, value: 100});
            }else {
                values.push({key: 'EA'+index});
            }
            index += 1;
        }
        my_data.unshift({key: keys[i], values: values});
    }
    var mychart = d3x3d.chart.barChartMultiSeries();
    chartholder.datum(my_data).call(mychart);
    var newData = [
        {
            key: "UK",
            values: [
                {key: "hello", value: 3},
                {key: "world", value: 1},
                {key: "love", value: 9},
                {key: "it", value: 5}
            ]
        },
        {
            key: "France",
            values: [
                {key: "Apples", value: 5},
                {key: "Oranges", value: 4},
                {key: "Pears", value: 6},
                {key: "Bananas", value: 2}
            ]
        }
    ];
    document.getElementById('area_chart').addEventListener('click', function(){
        supportFunct.changeChart('chartholder', 'areaChartMultiSeries', newData);});
    document.getElementById('multi_series_bar_chart').addEventListener('click', function(){
        supportFunct.changeChart('chartholder', 'areaChartMultiSeries', newData);});
    document.getElementById('vertical_bar_chart').addEventListener('click', function() {
        supportFunct.changeChart('chartholder', 'areaChartMultiSeries', newData);
    });
}