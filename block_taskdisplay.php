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

class block_taskdisplay extends block_base {
    /**
     * Displays the title of the plugin.
     */
    public function init(){
        // $this->title = get_string('taskdisplay', 'block_taskdisplay');
    }

    /**
     * This method determines the content of the plugin.
     * @return stdClass with the actual display content.
     */
    public function get_content() {
        global $DB;
        if ($this->content !== null){
            return $this->content;
        }
        $renderer = $this->page->get_renderer('block_taskdisplay');
        $this->content = new stdClass();
        $this->content->text = '';
        $this->content->text .= $renderer->render_taskdisplay();



        return $this->content;
    }

    public function specialization() {
        if (isset($this->config)) {
            if (empty($this->config->title)) {
                $this->title = get_string('defaulttitle', 'block_taskdisplay');
            } else {
                $this->title = $this->config->title;
            }

            if (empty($this->config->text)) {
                $this->config->text = get_string('defaulttext', 'block_taskdisplay');
            }
        }
    }

    /**
     * This method enables global configuration for the plugin.
     * @return bool to determine if the plugin has a settings.php file.
     */
    function has_config(){
        return true;
    }

}