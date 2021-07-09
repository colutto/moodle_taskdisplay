/**
 * Function to establish the connection for the Server-Side Events between the Server and the Client.
 */
export function connect(    ){
    if(typeof(EventSource) !== "undefined") {
        //checks if the Server support Server-Side Events
        var source = new EventSource("http://localhost:8080/moodle/blocks/taskdisplay/server_sent.php");
        source.onmessage = function(event) {
            document.getElementById("result").innerHTML += event.data + "<br>";
        };
    } else {
        document.getElementById("result").innerHTML = "Sorry, your browser does not support server-sent events...";
    }
}