self.addEventListener('message', function(e) {
  var data = e.data;
  switch (data.cmd) {
    case 'getchat':
          setTimeout(function(){getchat(data.data);},3000);
          break;
    default:
      self.postMessage('Unknown command');
  }
}, false);

function getchat(data) {
  fetch("/ajax/chat/get/", {
     method: 'post',
     headers: {
       "Content-type": "application/x-www-form-urlencoded; charset=UTF-8"
     },
     body: 'chat='+data.chat+'&last='+data.last+'&user='+data.user+'&token='+data.token
   })
   .then(data)
   .then(function (data) {
    self.postMessage(data);
    console.log('Request succeeded with JSON response', data);
   })
   .catch(function (error) {
     console.log('Request failed', error);
   });
}


const CACHE_PREFIX = 'feedbackcloud-cache';

self.addEventListener('install', (event) => {
    console.log('Установлен');
});

self.addEventListener('activate', (event) => {
    console.log('Активирован');
});

self.addEventListener('fetch', (event) => {
    console.log('Происходит запрос на сервер');
});
