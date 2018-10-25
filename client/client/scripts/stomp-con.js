/*************************************
        Stomp connection config
*************************************/
// define socket url 
var url = "ws://localhost:61614/stomp";
var client = Stomp.client(url);

function connect() {
    var success_cb = (status) => console.log("SUCCESSFUL WS CONNECTION", status);
    var fail_cb = (status) => console.log("FAILED WS CONNECTION", status);
    client.connect('admin', 'admin', success_cb, fail_cb);
}

function disconnect() {
    let defaultMsg = "Web socket disconnected";
    let notify = (args) => console.log(...args);
    client.disconnect((err) => err ? notify([defaultMsg, err]) : notify(defaultMsg))
}

connect()