import * as d3 from './d3-x3d_library/d3';
import * as d3x3d from './d3-x3d_library/d3-x3d';
import 'block_taskdisplay/x3dom';
import {userData} from './ajaxcalls';
import {studentsData} from './ajaxcalls';
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
export function changeChart(chartType, chartId, buttonId, sessionName){
    renewDiv(chartId);
    var data;
    if(chartId == 'chartholder'){
        data = userData;
    } else{
        data = studentsData;
    }
    var chartholder = d3.select('#'+chartId);
    sessionStorage.setItem(sessionName+'Chart', chartType);
    var userChart;
    switch(sessionStorage.getItem(sessionName+'Chart')){
        case 'areaChartMultiSeries':
            userChart = d3x3d.chart.areaChartMultiSeries();
            document.getElementById(buttonId).innerHTML = 'Area Chart';
            break;
        case 'barChartMultiSeries':
            userChart = d3x3d.chart.barChartMultiSeries();
            document.getElementById(buttonId).innerHTML = 'Bar Chart';
            break;
        default:
            userChart = d3x3d.chart.ribbonChartMultiSeries();
            document.getElementById(buttonId).innerHTML = 'Ribbon Chart';
    }
    chartholder.datum(data).call(userChart);
    window.x3dom.reload();
}
