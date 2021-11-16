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
defined('MOODLE_INTERNAL') || die;
class renderer extends \plugin_renderer_base{

    public function render_taskdisplay(){
        global $CFG; //Configuration Variable
        global $DB; //Database Variable

//      loads the JavaScript x3dom module
        $url_x3dom = new \moodle_url('https://x3dom.org/release/x3dom.js');
        $this->page->requires->js($url_x3dom);

        $url_x3dom_css = new \moodle_url('https://x3dom.org/release/x3dom.css');
        $this->page->requires->css_theme($url_x3dom_css);




        $this->page->requires->js_call_amd('block_taskdisplay/main', 'initialise');



        $html =     '
                     <div id="chartholder"></div>
                     <div class="dropdown">
                        <button class="dropbtn" id="buttonChangeChart">Area Chart</button>
                        <div class="dropdown-content">
                            <a id="area_chart">Area Chart</a>
                            <a id="bar_chart">Bar Chart</a>
                            <a id="ribbon_chart">Ribbon Chart</a>
                        </div>
                     </div>
                     <div id="chartholder2"></div>
                     <div class="dropdown">
                        <button class="dropbtn" id="buttonChangeChart">Area Chart</button>
                        <div class="dropdown-content">
                            <a id="area_chart">Area Chart</a>
                            <a id="bar_chart">Bar Chart</a>
                            <a id="ribbon_chart">Ribbon Chart</a>
                        </div>
                     ';
        return $html;
    }

}
