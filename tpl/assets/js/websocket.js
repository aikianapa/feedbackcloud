function ws(address) {
    if (WebSocket) { // Если веб-сокеты поддерживаются, в противном случае, наверное, стоит сделать полингом?
        let timeout = 0.5;
        let socket = null;
        let connected = false;

        function connect() {
            if (socket === null || socket.readyState > 1) {
                socket = new WebSocket(address);
                timeout = Math.min(2 * timeout, 30);
                connectCallbacks();
            }
        }

        let callbacks = {
            connected() {
                return connected;
            },
            onopen: function (e) {
            },
            onmessage: function (m) {
            },
            onclose: function (e) {
            },
            onerror: function (e) {
            },
            send: function (msg) {
                socket.send(msg);
            },
            connect: function () {
                timeout = 0.5;
                connect();
            }
        };

        function connectCallbacks() {
            socket.onopen = function (e) {
                timeout = 0.5;
                connected = true;
                callbacks.onopen(e);
            };
            socket.onmessage = function (m) {
                callbacks.onmessage(m);
            };
            socket.onclose = function (event) {
                callbacks.onclose(event);
                connected = false;
                console.log("reconnect... in 1 second");
                setTimeout(connect, 1000 * timeout);
            };
            socket.onerror = function (error) {
                callbacks.onerror(error);
            };
        }

        connect();
        return callbacks;
    }
}
