// Регистрируем обработчик события 'notificationclick'.
importScripts('./ngsw-worker.js');

self.addEventListener('notificationclick', function(event) {
    console.log(event.notification);
    event.waitUntil(
        // Получаем список клиентов SW.
        self.clients.matchAll().then(function(clientList) {
            // Если есть хотя бы один клиент, фокусируем его.
            if (clientList.length > 0) {
                return clientList[0].focus();
            }
            // В противном случае открываем новую страницу.
            return self.clients.openWindow(event.notification.data.url);
        })
    );
});

