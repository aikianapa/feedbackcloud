class push_starter {
    /**
     * Параметры, которые необходимо будет переделать
     */
    applicationServerKey = this.urlBase64ToUint8Array(
        'BPreGodrOR6tjcFVRKkP6xw2BJlF22vPON3-lUV1k4Zjq2oplKzseMQogCRoH4MIiLo-8opP8GHKtkzoIpG7TYQ');
    /**
     * Переменные, которые, возможно, потом еще где-то пригодяться
     */
    pushSubscription: PushSubscription;

    constructor(private serviceWorkerUrl: string = 'push-worker.js') {
    }

    /**
     * Преобразование base64 в нормальный, человечий бинарный вид
     * @param base64String
     */
    urlBase64ToUint8Array(base64String: string): Uint8Array {
        const padding = '='.repeat((4 - base64String.length % 4) % 4);
        const base64 = (base64String + padding)
            .replace(/\-/g, '+')
            .replace(/_/g, '/');

        const rawData = window.atob(base64);
        const outputArray = new Uint8Array(rawData.length);

        for (let i = 0; i < rawData.length; ++i) {
            outputArray[i] = rawData.charCodeAt(i);
        }
        return outputArray;
    }

    /**
     * Проверка, поддерживаются ли браузером нужные сервисы
     */
    check() {
        if (!('serviceWorker' in navigator)) { // Нет поддержки воркеров - расходимся
            throw new Error('Unsupported serviceWorker');
        }

        if (!('PushManager' in window)) { // Нет поддержки нотификаций - расходимся, всё зря
            throw new Error('Unsupported PushManager');
        }
    }

    /**
     * Регестрирует serviceWorker
     */
    registerServiceWorker() {
        return navigator.serviceWorker.register(this.serviceWorkerUrl)
            .then(function (registration) {
                console.log('Service worker successfully registered.');
                return registration;
            })
            .catch(function (err) {
                console.error('Unable to register service worker.', err);
            });
    }

    /**
     * Запрос у пользователя разрешения на показ уведомлений
     */
    askPermission() {
        return new Promise(function (resolve, reject) {
            const permissionResult = Notification.requestPermission(function (result) {
                resolve(result);
            });
            if (permissionResult) {
                permissionResult.then(resolve, reject);
            }
        })
            .then(function (permissionResult) {
                if (permissionResult !== 'granted') {
                    throw new Error('We weren\'t granted permission.');
                }
            });
    }

    /**
     * Проверка, разрешены ли уведомления
     */
    getNotificationPermissionState(): Promise<PermissionState|NotificationPermission> {
        if (navigator.permissions) {
            return navigator.permissions.query({name: 'notifications'})
                .then((result) => {
                    return result.state;
                });
        }
        return new Promise((resolve) => {
            resolve(Notification.permission);
        });
    }

    getSWRegistration() {
        return navigator.serviceWorker.register(this.serviceWorkerUrl);
    }

    subscribeUserToPush(): Promise<string> {
        return this.getSWRegistration()
            .then((registration) => {
                const subscribeOptions = {
                    userVisibleOnly: true,
                    applicationServerKey: this.applicationServerKey
                };
                return registration.pushManager.subscribe(subscribeOptions);
            })
            .then((pushSubscription) => {
                console.log('Received PushSubscription: ', JSON.stringify(pushSubscription));
                this.pushSubscription = pushSubscription;
                return JSON.stringify(pushSubscription);
            });
    }
}

async function subscribeToNotification(): Promise<string> {
    let n = new push_starter();
    n.check();
    await n.askPermission();
    await n.registerServiceWorker();
    return await n.subscribeUserToPush();
}

function checkNotificationPermissions(): Promise<PermissionState|NotificationPermission> {
    let n = new push_starter();
    n.check();

    return n.getNotificationPermissionState();
}
