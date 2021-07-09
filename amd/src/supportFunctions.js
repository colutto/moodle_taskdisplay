import * as d3 from './d3-x3d_library/d3';
import * as d3x3d from './d3-x3d_library/d3-x3d';
import 'block_taskdisplay/x3dom';

/**
 * Renews the HTML Element when the chart is getting changed because the variables of the HTML
 * Element have to be deleted.
 * @param divName The id-Name of the HTML Element which should get deleted.
 */
function renewDiv(divName){
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


