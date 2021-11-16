import { get_chart_data } from './ajaxcalls';
/**
 * Function to establish the connection for all data transfers between the server and the client via AJAX.
 */
export function connect(){
    if(typeof(EventSource) !== "undefined") {
        // checks if the Server support Server-Side Events
        //TODO change the hostname to a dynamic hostname function.
        var source = new EventSource("http://localhost:8080/moodle/blocks/taskdisplay/server_sent.php");
        source.addEventListener('update', function(){
            console.log('Server has sent new message');
            get_chart_data();
        });
        } else {
            document.getElementById("test").innerHTML = "Sorry, your browser does not support server-sent events...";
        }
}