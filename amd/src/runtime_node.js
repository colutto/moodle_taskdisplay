import * as ajaxcalls from './ajaxcalls';
export function initialise_runtimNode(){
    document.getElementById('asynchronousRequest').addEventListener('click', function(){
        ajaxcalls.get_chart_data();
    });
}