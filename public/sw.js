const CACHE   = 'qkd-v1';
const OFFLINE  = '/offline';

const STATIC = [
    '/',
    OFFLINE,
    '/manifest.json',
    '/pwa-icons/icon-192x192.png',
    '/pwa-icons/icon-512x512.png',
    '/pwa-icons/icon.svg',
];

// ── Install: pre-cache shell ───────────────────────────────────────────────
self.addEventListener('install', event => {
    event.waitUntil(
        caches.open(CACHE).then(cache => cache.addAll(STATIC)).then(() => self.skipWaiting())
    );
});

// ── Activate: clean old caches ─────────────────────────────────────────────
self.addEventListener('activate', event => {
    event.waitUntil(
        caches.keys()
            .then(keys => Promise.all(keys.filter(k => k !== CACHE).map(k => caches.delete(k))))
            .then(() => self.clients.claim())
    );
});

// ── Fetch strategy ─────────────────────────────────────────────────────────
self.addEventListener('fetch', event => {
    const { request } = event;
    const url = new URL(request.url);

    // Skip non-GET, cross-origin, Livewire updates, and Vite HMR
    if (
        request.method !== 'GET' ||
        url.origin !== self.location.origin ||
        url.pathname.startsWith('/livewire') ||
        url.pathname.startsWith('/vite') ||
        url.port === '5175' ||
        url.port === '5173'
    ) {
        return;
    }

    // Static assets (CSS, JS, images, fonts) → cache-first
    if (
        url.pathname.startsWith('/build/') ||
        url.pathname.startsWith('/pwa-icons/') ||
        url.pathname.match(/\.(png|jpg|jpeg|svg|ico|woff2?|ttf)$/)
    ) {
        event.respondWith(
            caches.match(request).then(cached => cached || fetch(request).then(resp => {
                if (resp.ok) {
                    const clone = resp.clone();
                    caches.open(CACHE).then(cache => cache.put(request, clone));
                }
                return resp;
            }))
        );
        return;
    }

    // HTML pages → network-first, fall back to offline page
    event.respondWith(
        fetch(request)
            .then(resp => {
                if (resp.ok) {
                    const clone = resp.clone();
                    caches.open(CACHE).then(cache => cache.put(request, clone));
                }
                return resp;
            })
            .catch(() => caches.match(request).then(cached => cached || caches.match(OFFLINE)))
    );
});
