# Portal de Juegos - GamePortal

Este es un proyecto realizado en Laravel 11. He creado este portal para poder gestionar y jugar a diferentes juegos, además de llevar un registro de las puntuaciones de los jugadores y el manejo de los usuarios que pueden entrar al sistema.

## Lo que he hecho:

### Los Juegos
*   Los he metido con iframes para que carguen rápido.
*   Pasan la puntuación por postMessage (magia de JS).
*   He configurado 3 juegos: Runner Galactic 3D, Planet Escape y Neon Sprint 3D.

### Puntuaciones y Piques
*   El Historial es global. No es solo tuyo, ahora sale todo el mundo ordenado de mayor a menor puntuación.
*   He arreglado el sistema de guardado: ahora solo se manda el dato a la base de datos cuando tú pulsas el botón de "Guardar Récord", así me aseguro de que no falla nada y la puntuación es la real.

### Administración
*   Usuarios: He creado un sistema para añadir peña, editarlos o borrarlos.
*   Juegos: He hecho un panel para añadir juegos nuevos cómodamente. Solo le pones el título, eliges el archivo del motor y listo.
*   He quitado el rol de "Gestor" porque no hacía falta y así he dejado el código más simple: o eres Admin o eres Jugador.

### Diseño
*   He buscado un diseño limpio y que parezca hecho por una persona real, sin fliparme con efectos raros ni mil colores. Sencillo y que funciona bien.

---

## Cómo ponerlo a andar

1.  **Entra al portal:** Abre en tu navegador `http://localhost:8000`.
2.  **Inicia sesión:** Tienes que ir a **/login** directamente para entrar.
3.  **Datos del admin:**
    *   **User:** admin@plataforma.com
    *   **Pass:** password
4.  **Backend:** Esto es lo que tengo corriendo en la terminal para que funcione:
    ```bash
    php artisan migrate --seed
    php artisan serve
    npm run dev
    ```
