import * as ajax from 'core/ajax';
import * as notification from 'core/notification';
import * as d3 from './d3-x3d_library/d3';
import * as d3x3d from './d3-x3d_library/d3-x3d';
import * as supportFunct from './supportFunctions';
export function get_chart_data(){
    var connection = ajax.call([{
        methodname: 'block_taskdisplay_loaddata',
        args: {},
        fail: notification.exception,
    }]);
    connection[0].then(function(data){
        var my_data = convertAJAXData(data);
        supportFunct.renewDiv('chartholder');
        var chartholder = d3.select('#chartholder');
        var mychart = d3x3d.chart.areaChartMultiSeries();
        chartholder.datum(my_data).call(mychart);
        window.x3dom.reload();
    });
}

export function convertAJAXData(data){
    var my_data = [];
    for(var key in data) {
        var course = data[key];
        var values_assignments = [];
        var index = 1;
        if(!course.noAssignments){
            for(var assignment_key in course.assignments){
                var assignment = course.assignments[assignment_key];
                if(assignment.is_submitted == 'submitted'){
                    values_assignments.push({key: 'EA'+index, value: 100});
                }else{
                    values_assignments.push({key: 'EA'+index, value: 0});
                }
                index++;
            }
        } else{
            values_assignments.push({key: 'EA'+index, value: 0});
        }
        my_data.unshift({key: course.course_name, values: values_assignments});
        alert(course.user_count);
    }
    return my_data;
}