// https://ru.stackoverflow.com/questions/763806/service-worker-%D0%BA%D0%B0%D0%BA-%D1%81%D0%BE%D0%B7%D0%B4%D0%B0%D1%82%D1%8C-%D0%BF%D1%80%D0%BE%D0%B8%D0%B7%D0%B2%D0%B5%D1%81%D1%82%D0%B8-%D0%BF%D0%BE%D0%B4%D0%BA%D0%BB%D1%8E%D1%87%D0%B5%D0%BD%D0%B8%D0%B5-%D0%BF%D0%BE-websocket
// https://developer.mozilla.org/ru/docs/Web/API/Push_API/Using_the_Push_API

importScripts('websocket.js');

let socket = ws("wss://feedbackcloud.ru:9502");
const channel = new BroadcastChannel('sw-messages');


function postMessage(msg) {
    console.log(`message: ${msg.message}`);
//    self.clients.matchAll().then(all => all.map(client => client.postMessage(msg)));
    channel.postMessage(msg);
}

socket.onopen = function (e) {
    postMessage({message: 'onopen'});
};
socket.onmessage = function (m) {
    postMessage({message: 'onmessage', data: m.data});
    // ServiceWorkerRegistration.showNotification(m.data);
    /*if (Notification.permission === "granted") {
        let title = m.data;
        // let notification = new Notification(title);
        self.registration.showNotification(m.data);
    }*/
};
socket.onclose = function (event) {
    postMessage({message: 'onclose', code: event.code, reason: event.reason, wasClean: event.wasClean});
};
socket.onerror = function (error) {
    console.error(error);
    postMessage({message: 'onerror'});
};

self.addEventListener('message', function (event) {
    switch (event.data.message) {
        case 'send':
            socket.send(event.data.data);
            break;
        case 'connection':
            if (socket.connected())
                socket.onopen();
    }
});

postMessage({message: 'oncreated'});