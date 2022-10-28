const staticfiles = "staticfiles-v1.0.8";
const cachefiles = "cachefiles-v1.0.8";
const cacheWhitelist = [ cachefiles, staticfiles ];

this.addEventListener('install', function(event) {
	event.waitUntil(
		caches.open(staticfiles).then(function(cache) {
			return cache.addAll([]);
		})
	);
});

async function put_into_cache( cache_name, request, response ) {
	const cache = await caches.open(cache_name);
	cache.put(request, response.clone() );
	return response;
}


self.addEventListener('fetch', event => {
	event.respondWith( function() {
		const reg_content = /wp-content/;
		const reg_include = /wp-include/;

		if( reg_content.test(event.request.url) || reg_include.test(event.request.url) ) {
			return caches.match(event.request).then( response => {
				return response || fetch(event.request)
					.then( 
						response => put_into_cache(staticfiles, event.request, response) 
					).catch( 
						() => caches.match(event.request)
					);
			});
		}

		return fetch(event.request).then( 
			response => put_into_cache(cachefiles, event.request, response)
		).catch( () => caches.match(event.request) );
	}() );
});

self.addEventListener('activate', function(event) {
	event.waitUntil(
		caches.keys().then(function(keyList) {
			return Promise.all(keyList.map(function(key) {
				if (cacheWhitelist.indexOf(key) === -1) {
					return caches.delete(key);
				}
			}));
		})
	);
});
