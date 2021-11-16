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
import {connect} from './server_events';
// import * as ajaxcall from './ajaxcalls';
/**
 *
 * @param {*} data Stores all the courses the user is enrolled in and the
 * to the courses related assignments.
 */
export function initialise() {
    get_chart_data();
    connect();
}