/**
 * The main Javascript page for the Task Display plugin.
 *
 * @package block_taskdisplay
 * @license http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 * @author Stefan Colutto
 */
// import * as d3 from './d3-x3d_library/d3';
// import * as d3x3d from './d3-x3d_library/d3-x3d';
// import 'block_taskdisplay/x3dom';
// import * as supportFunct from './supportFunctions';
// import * as supportFunct from './supportFunctions';
import { get_chart_data } from './ajaxcalls';
import {changeChart} from './supportFunctions';
// import {connect} from './server_events';
// import * as ajaxcall from './ajaxcalls';
/**
 *
 * @param {*} data Stores all the courses the user is enrolled in and the
 * to the courses related assignments.
 */
export function initialise() {
    if(!('userChart' in sessionStorage)){
        sessionStorage.setItem('userChart', 'barChartMultiSeries');
    }
    if(!('studentsChart' in sessionStorage)){
        sessionStorage.setItem('studentsChart', 'barChartMultiSeries');
    }
    get_chart_data();
    document.getElementById('areaChartUser').addEventListener('click', function(){
        changeChart('areaChartMultiSeries', 'chartholder', 'buttonChartholder', 'user');
    });
    document.getElementById('barChartUser').addEventListener('click', function(){
        changeChart('barChartMultiSeries', 'chartholder', 'buttonChartholder', 'user');
    });
    document.getElementById('ribbonChartUser').addEventListener('click', function(){
        changeChart('ribbonChartMultiSeries', 'chartholder', 'buttonChartholder', 'user');
    });
    document.getElementById('areaChartStudents').addEventListener('click', function(){
        changeChart('areaChartMultiSeries', 'chartholder2', 'buttonChartholder2', 'students');
    });
    document.getElementById('barChartStudents').addEventListener('click', function(){
        changeChart('barChartMultiSeries', 'chartholder2', 'buttonChartholder2', 'students');
    });
    document.getElementById('ribbonChartStudents').addEventListener('click', function(){
        changeChart('ribbonChartMultiSeries', 'chartholder2', 'buttonChartholder2', 'students');
    });
    // connect();
}