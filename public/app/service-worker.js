"use strict";var precacheConfig=[["./index.html","f1f7418925c4aaf52019b1b73272b461"],["./static/css/main.f40ad05f.css","2a6959ebb773483ad2623e04e4d186ea"],["./static/js/main.3e0544ad.js","669216ae04e5a0d4b876746fb49732db"],["./static/media/banner1.67a8622e.png","67a8622e37fa74ae05f7181d166c5832"],["./static/media/bg-wallet.aa8d63eb.png","aa8d63ebc1d659307869cbff3918b267"],["./static/media/default_icon.bff1dee9.png","bff1dee902f79e35a9a03b43c724106d"],["./static/media/erweima.b7c64cad.png","b7c64cad29f500d71b93dc9c6686fceb"],["./static/media/group1.77db12d2.png","77db12d2ad0fe9f1e906c91072ab6775"],["./static/media/group2.6cf0deea.png","6cf0deea5333b4442874f3a4aeb3148a"],["./static/media/group4.52fc70c2.png","52fc70c261d8bbd840dbf940fdd5cfed"],["./static/media/group5.389abbab.png","389abbab650dcfd549eb8b9f7745ab58"],["./static/media/index_bg.241a6434.png","241a643495808582bae5bf84023f2cb0"],["./static/media/mine_bg.41b1b445.png","41b1b445df68c0708d1c4ae9fe38e5ee"],["./static/media/qr-code.7557c899.png","7557c899943912bda79794fc5712ab1c"],["./static/media/transition_bg.035a10df.png","035a10df0daa0087b00086b6006142af"]],cacheName="sw-precache-v3-sw-precache-webpack-plugin-"+(self.registration?self.registration.scope:""),ignoreUrlParametersMatching=[/^utm_/],addDirectoryIndex=function(e,t){var n=new URL(e);return"/"===n.pathname.slice(-1)&&(n.pathname+=t),n.toString()},cleanResponse=function(t){return t.redirected?("body"in t?Promise.resolve(t.body):t.blob()).then(function(e){return new Response(e,{headers:t.headers,status:t.status,statusText:t.statusText})}):Promise.resolve(t)},createCacheKey=function(e,t,n,a){var r=new URL(e);return a&&r.pathname.match(a)||(r.search+=(r.search?"&":"")+encodeURIComponent(t)+"="+encodeURIComponent(n)),r.toString()},isPathWhitelisted=function(e,t){if(0===e.length)return!0;var n=new URL(t).pathname;return e.some(function(e){return n.match(e)})},stripIgnoredUrlParameters=function(e,n){var t=new URL(e);return t.hash="",t.search=t.search.slice(1).split("&").map(function(e){return e.split("=")}).filter(function(t){return n.every(function(e){return!e.test(t[0])})}).map(function(e){return e.join("=")}).join("&"),t.toString()},hashParamName="_sw-precache",urlsToCacheKeys=new Map(precacheConfig.map(function(e){var t=e[0],n=e[1],a=new URL(t,self.location),r=createCacheKey(a,hashParamName,n,/\.\w{8}\./);return[a.toString(),r]}));function setOfCachedUrls(e){return e.keys().then(function(e){return e.map(function(e){return e.url})}).then(function(e){return new Set(e)})}self.addEventListener("install",function(e){e.waitUntil(caches.open(cacheName).then(function(a){return setOfCachedUrls(a).then(function(n){return Promise.all(Array.from(urlsToCacheKeys.values()).map(function(t){if(!n.has(t)){var e=new Request(t,{credentials:"same-origin"});return fetch(e).then(function(e){if(!e.ok)throw new Error("Request for "+t+" returned a response with status "+e.status);return cleanResponse(e).then(function(e){return a.put(t,e)})})}}))})}).then(function(){return self.skipWaiting()}))}),self.addEventListener("activate",function(e){var n=new Set(urlsToCacheKeys.values());e.waitUntil(caches.open(cacheName).then(function(t){return t.keys().then(function(e){return Promise.all(e.map(function(e){if(!n.has(e.url))return t.delete(e)}))})}).then(function(){return self.clients.claim()}))}),self.addEventListener("fetch",function(t){if("GET"===t.request.method){var e,n=stripIgnoredUrlParameters(t.request.url,ignoreUrlParametersMatching),a="index.html";(e=urlsToCacheKeys.has(n))||(n=addDirectoryIndex(n,a),e=urlsToCacheKeys.has(n));var r="./index.html";!e&&"navigate"===t.request.mode&&isPathWhitelisted(["^(?!\\/__).*"],t.request.url)&&(n=new URL(r,self.location).toString(),e=urlsToCacheKeys.has(n)),e&&t.respondWith(caches.open(cacheName).then(function(e){return e.match(urlsToCacheKeys.get(n)).then(function(e){if(e)return e;throw Error("The cached response that was expected is missing.")})}).catch(function(e){return console.warn('Couldn\'t serve response for "%s" from cache: %O',t.request.url,e),fetch(t.request)}))}});