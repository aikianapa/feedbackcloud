var __awaiter = (this && this.__awaiter) || function (thisArg, _arguments, P, generator) {
    function adopt(value) { return value instanceof P ? value : new P(function (resolve) { resolve(value); }); }
    return new (P || (P = Promise))(function (resolve, reject) {
        function fulfilled(value) { try { step(generator.next(value)); } catch (e) { reject(e); } }
        function rejected(value) { try { step(generator["throw"](value)); } catch (e) { reject(e); } }
        function step(result) { result.done ? resolve(result.value) : adopt(result.value).then(fulfilled, rejected); }
        step((generator = generator.apply(thisArg, _arguments || [])).next());
    });
};
class push_starter {
    constructor(serviceWorkerUrl = 'push-worker.js') {
        this.serviceWorkerUrl = serviceWorkerUrl;
        /**
         * Параметры, которые необходимо будет переделать
         */
        this.applicationServerKey = this.urlBase64ToUint8Array('BPreGodrOR6tjcFVRKkP6xw2BJlF22vPON3-lUV1k4Zjq2oplKzseMQogCRoH4MIiLo-8opP8GHKtkzoIpG7TYQ');
    }
    /**
     * Преобразование base64 в нормальный, человечий бинарный вид
     * @param base64String
     */
    urlBase64ToUint8Array(base64String) {
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
            registration.update(); // Новая версия - обновим
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
    getNotificationPermissionState() {
        if (navigator.permissions) {
            return navigator.permissions.query({ name: 'notifications' })
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
    subscribeUserToPush() {
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
function subscribeToNotification() {
    return __awaiter(this, void 0, void 0, function* () {
        let n = new push_starter();
        n.check();
        yield n.askPermission();
        yield n.registerServiceWorker();
        return yield n.subscribeUserToPush();
    });
}
function checkNotificationPermissions() {
    let n = new push_starter();
    n.check();
    return n.getNotificationPermissionState();
}
//# sourceMappingURL=push_starter.js.map