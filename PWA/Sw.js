const STATIC_CACHE = "static-v1";
const APP_SHELL = [
  "/",
  "Empleado.php",
  "ForminserEmpleado.html",
  "FormUpdEmpleado.php",
  "UpdEmpleado.php",
  "DelEmpleado.php",
  "images/X.png",
];

self.addEventListener("install", (e) => {
  e.waitUntil(
    caches.open(STATIC_CACHE)
      .then((cache) => cache.addAll(APP_SHELL))
  );
});

self.addEventListener("fetch", (e) => {

  if (
    e.request.url.includes('chrome-extension') || 
    e.request.url.includes('manifest.json')
  ) {
    return fetch(e.request);
  }


  e.respondWith(
    fetch(e.request)
      .then((response) => {
        return caches.open(STATIC_CACHE).then((cache) => {
          cache.put(e.request, response.clone()); 
          return response;
        });
      })
      .catch(() => caches.match(e.request)) 
  );
});
