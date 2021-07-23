<?php
// This file is part of Moodle - http://moodle.org/
//
// Moodle is free software: you can redistribute it and/or modify
// it under the terms of the GNU General Public License as published by
// the Free Software Foundation, either version 3 of the License, or
// (at your option) any later version.
//
// Moodle is distributed in the hope that it will be useful,
// but WITHOUT ANY WARRANTY; without even the implied warranty of
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
// GNU General Public License for more details.
//
// You should have received a copy of the GNU General Public License
// along with Moodle.  If not, see <http://www.gnu.org/licenses/>.

/**
 * Task Display - keeps track of student assignments and displays it in charts.
 *
 * @package     block_taskdisplay
 * @license     http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 * @author      Stefan Colutto
 */
namespace block_taskdisplay\output;

use block_taskdisplay\external;

defined('MOODLE_INTERNAL') || die;
class renderer extends \plugin_renderer_base{

    public function render_taskdisplay(){
        global $CFG; //Configuration Variable
        global $DB; //Database Variable

//        loads the JavaScript x3dom module
        $url_x3dom = new \moodle_url('https://x3dom.org/release/x3dom.js');
        $this->page->requires->js($url_x3dom);

//        loads the cascading style sheet for the x3dom scenes.
        $url_x3dom_css = new \moodle_url('https://x3dom.org/release/x3dom.css');
        $this->page->requires->css_theme($url_x3dom_css);


//      gets the data for the user assignment results
        $user_data = $DB->get_records('block_taskdisplay', array('id' => 1));

        // loads the JavaScript code for the client server-sent messaging system
//        $this->page->requires->js_call_amd('block_taskdisplay/server_events', 'connect');
        $this->page->requires->js_call_amd('block_taskdisplay/runtime_node', 'initialise_runtimNode');
        $chart_data = new chart_data($this->page);
        $chart_data->initialiseChart();


        $html =     '
                     <div id="chartholder"></div>
                     <div class="dropdown">
                        <button class="dropbtn" id="buttonChangeChart">Area Chart</button>
                        <div class="dropdown-content">
                            <a id="area_chart">Area Chart</a>
                            <a id="multi_series_bar_chart">Multi Series Bar Chart</a>
                            <a id="vertical_bar_chart">Vertical Bar Chart</a>
                        </div>
                     </div>
                     <button id="asynchronousRequest">Runtime Node</button>';





        return $html;

    }

}
