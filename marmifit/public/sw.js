// public/sw.js

const STATIC_CACHE_NAME = 'marmifit-static-v2'; // Cache para o App Shell (estático)
const DYNAMIC_CACHE_NAME = 'marmifit-dynamic-v2'; // Cache para as imagens e dados (dinâmico)

// Lista de arquivos estáticos para o App Shell
const urlsToCache = [
    '/',
    '/offline.html',
    '/css/app.css', // Verifique se este é o caminho correto
    '/js/app.js',   // Verifique se este é o caminho correto
    '/public/images/marmifit_logo.png' // Ícone principal
];

// Evento de Instalação: Salva os arquivos do App Shell no cache estático
self.addEventListener('install', event => {
    event.waitUntil(
        caches.open(STATIC_CACHE_NAME)
            .then(cache => {
                console.log('Cache estático aberto e App Shell salvo');
                return cache.addAll(urlsToCache);
            })
    );
});

// Evento de Ativação: Limpa caches antigos para evitar conflitos
self.addEventListener('activate', event => {
    const cacheWhitelist = [STATIC_CACHE_NAME, DYNAMIC_CACHE_NAME];
    event.waitUntil(
        caches.keys().then(cacheNames => {
            return Promise.all(
                cacheNames.map(cacheName => {
                    if (cacheWhitelist.indexOf(cacheName) === -1) {
                        console.log('Limpando cache antigo:', cacheName);
                        return caches.delete(cacheName);
                    }
                })
            );
        })
    );
});

// Evento de Fetch: Intercepta TODAS as requisições
self.addEventListener('fetch', event => {
    event.respondWith(
        caches.match(event.request)
            .then(cachedResponse => {
                // 1. Se a resposta estiver no cache, retorna-a imediatamente
                if (cachedResponse) {
                    return cachedResponse;
                }

                // 2. Se não estiver no cache, busca na rede
                return fetch(event.request).then(
                    networkResponse => {
                        // 3. Verifica se a requisição é para as imagens das marmitas
                        if (event.request.url.includes('/images/marmitas/')) {
                            // Clona a resposta da rede, pois ela só pode ser lida uma vez
                            const responseToCache = networkResponse.clone();
                            
                            // Abre o cache dinâmico e salva a nova imagem
                            caches.open(DYNAMIC_CACHE_NAME)
                                .then(cache => {
                                    cache.put(event.request, responseToCache);
                                });
                        }
                        // Retorna a resposta original da rede para a página
                        return networkResponse;
                    }
                ).catch(() => {
                    // 4. Se a rede falhar E não houver nada no cache, mostra a página offline
                    return caches.match('/offline.html');
                });
            })
    );
});