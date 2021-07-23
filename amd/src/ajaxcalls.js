import * as ajax from 'core/ajax';
import * as notification from 'core/notification';
export function get_chart_data(){
    var connection = ajax.call([{
        methodname: 'block_taskdisplay_loaddata',
        fail: notification.exception
    }]);
    connection[0].then(function(data){
        alert(data[0].content);
    });
    // alert('funciton works');
}