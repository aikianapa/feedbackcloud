self.addEventListener('install', function(event) {
    event.waitUntil(self.skipWaiting());
});

self.addEventListener('activate', function(event) {
    event.waitUntil(self.clients.claim());
});

self.addEventListener('push', function(event) {
    event.waitUntil(
        // Получить список клиентов для SW
        self.clients.matchAll().then(function (clientList) {
            if (!(self.Notification && self.Notification.permission === 'granted')) {
                return;
            }
            // Проверяем, есть ли хотя бы один сфокусированный клиент.
            let focused = clientList.some(function (client) {
                return client.focused;
            });

            let title = 'feedbackcloud.ru';
            let json = event.data.json();
            let notificationMessage;

            if (focused) {
                return; // Если клиент открыт - ничего не делать
            } else if (clientList.length > 0) {
                notificationMessage = `${json.user}: ${json.message}`; // Если есть открытые клиенты, но они в фоне
            } else {
                notificationMessage = `${json.user}: ${json.message}`; // Если нет открытых клиентов
            }

            return self.registration.showNotification(title, {
                body: notificationMessage,
            });
        })
    )
});

// Регистрируем обработчик события 'notificationclick'.
self.addEventListener('notificationclick', function(event) {
    event.waitUntil(
        // Получаем список клиентов SW.
        self.clients.matchAll().then(function(clientList) {
            // Если есть хотя бы один клиент, фокусируем его.
            if (clientList.length > 0) {
                return clientList[0].focus();
            }
            // В противном случае открываем новую страницу.
            return self.clients.openWindow('https://feedbackcloud.ru/fortests/notify/push.html');
        })
    );
});