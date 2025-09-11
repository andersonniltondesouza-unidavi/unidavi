if ("serviceWorker" in navigator) {
            navigator.serviceWorker.register("sw.js")
            .then(() => console.log("Service Worker registrado!"))
            .catch(err => console.log("Erro no SW:", err));
        }