import * as d3 from './d3-x3d_library/d3';
import * as d3x3d from './d3-x3d_library/d3-x3d';
import 'block_taskdisplay/x3dom';

/**
 * Renews the HTML Element when the chart is getting changed because the variables of the HTML
 * Elements need to be renewed
 * @param divName The id-Name of the HTML Element which should get deleted.
 */
export function renewDiv(divName){
    var element = document.getElementById(divName);
    var parent = element.parentNode;
    var wrapper = document.createElement('div');
    wrapper.setAttribute('id', divName);
    parent.replaceChild(wrapper, element);
}

/**
 * Changes the chart of the X3DOM scene.
 * @param divName The id-Name of the HTML Element in which the X3DOM chart is displayed.
 * @param chartType The type of the new chart.
 * @param data The data for the new chart.
 */
export function changeChart(divName, chartType, data){
    renewDiv(divName);
    var chartholder = d3.select('#' + divName);
    switch (chartType){
        case 'areaChartMultiSeries':
            var myChart = d3x3d.chart.areaChartMultiSeries();
            break;
        case 'barChartVertical':
            var myChart = d3x3d.chart.barChartVertical();
            break;
        case 'bubbleChart':
            var myChart = d3x3d.chart.bubbleChart();
            break;
        case 'particlePlot':
            var myChart = d3x3d.chart.particlePlot();
            break;
        case 'scatterPlot':
            var myChart = d3x3d.chart.scatterPlot();
            break;
        case 'surfacePlot':
            var myChart = d3x3d.chart.surfacePlot();
            break;
        case 'ribbonChartMultiSeries':
            var myChart = d3x3d.chart.ribbonChartMultiSeries();
            break;
        default:
            var myChart = d3x3d.chart.barChartMultiSeries();
            break;
    }
    var myChart = d3x3d.chart.barChartVertical();
    chartholder.datum(data).call(myChart);
    window.x3dom.reload();
}
export function initialiseChart(data){
    changeChart('chartholder', 'areaChartMultiSeries', data);
}
export function convertJSONData(data){
    var my_data = [];
    var keys = Object.keys(data);
    // alert(Object.keys(data).length);
    // if(!supportFunct.isEmpty(data)){
        for (var i=0; i<keys.length; i++){
            // loops through all the user enrolled courses.
            var values = [];
            var index = 1;
            if(!data[keys[i]]['noAssignments']){
            /* if there aren't any assignments at the moment it should fill in the
            key variable for the chart with an empty string, because the chart needs at least
            an empty string to function accordingly*/
                for (var object in data[keys[i]]){
                    // loops through all the course related assignments.
                    if(object!='number_of_assignments' && object!='submitted_assignments' && object!='noAssignments'){
                        /**checks if the object is an assingment or just some additional information of the course */
                        if (data[keys[i]][object]=='submitted'){
                            values.push({key: 'EA'+index, value: 100});
                        }else {
                            values.push({key: 'EA'+index, value: 0});
                        }
                        index += 1;
                    }
                }
            } else {
                // if the values array is empty it gets default parameters.
                values.push({key: 'EA'+index, value: 0});
                //TODO try to get rid of the EA statement when there are no assingments stored for the course
            }
            my_data.unshift({key: keys[i], values: values});
            /**insert the value array with the corresponding key to the mydata array
             * which will then be given to the chart method for visualization */
        }
        return my_data;
}