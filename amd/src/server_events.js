/**
 * Function to establish the connection for the Server-Side Events between the Server and the Client.
 */
import * as ajaxcalls from './ajaxcalls';
export function connect(){
    if(typeof(EventSource) !== "undefined") {
        // checks if the Server support Server-Side Events
        //TODO change the hostname to a dynamic hostname function.
        var source = new EventSource("http://localhost:8080/moodle/blocks/taskdisplay/server_sent.php");
        source.addEventListener('update', function(){
            document.getElementById('test').innerHTML = 'server sent event works';

            ajaxcalls.get_chart_data();
        });
        } else {
            document.getElementById("test").innerHTML = "Sorry, your browser does not support server-sent events...";
        }
}