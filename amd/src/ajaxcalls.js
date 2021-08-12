import * as ajax from 'core/ajax';
import * as notification from 'core/notification';
export function get_chart_data(){
    var connection = ajax.call([{
        methodname: 'block_taskdisplay_loaddata',
        args: {},
        fail: notification.exception,
    }]);
    connection[0].then(function(data){
        alert(data[0].course_name+' '+data[0].number_of_assignments+' '+data[0].submitted_assignments+' '+
        data[0].assignments[0].assignment_name+' '+data[0].assignments[0].is_submitted);
    });
}