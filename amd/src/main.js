import * as d3 from './d3-x3d_library/d3';
import * as d3x3d from './d3-x3d_library/d3-x3d';
import 'block_taskdisplay/x3dom';
import * as supportFunct from './supportFunctions';

export function initialise() {
    var chartholder = d3.select('#chartholder');
    var myData = [
        {
            key: "UK",
            values: [
                {key: "Apples", value: 9},
                {key: "Oranges", value: 3},
                {key: "Pears", value: 5},
                {key: "Bananas", value: 7}
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

    var mychart = d3x3d.chart.barChartMultiSeries();
    chartholder.datum(myData).call(mychart);
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
