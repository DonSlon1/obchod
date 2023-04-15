if ('serviceWorker' in navigator) {
    window.addEventListener('load', function () {
        navigator.serviceWorker.register('/service-worker.js').then(function (registration) {
            // Registration was successful
        }, function (err) {
            // Registration failed
            console.log('ServiceWorker registration failed: ', err);
        });
    });
}

var CACHE_NAME = 'my-site-cache-v1';
var urlsToCache = [
    '/js/global_funcion.js',
    '/style/global.css',
    '/svg/eye-off.svg',
    '/svg/eye-open.svg',
    '/svg/user.svg',
    '/svg/shop_cart.svg'
];

self.addEventListener('install', function (event) {
    // Perform install steps
    event.waitUntil(
        caches.open(CACHE_NAME)
            .then(function (cache) {
                return cache.addAll(urlsToCache);
            })
    );
});