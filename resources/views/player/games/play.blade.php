<x-app-layout>
    <div class="py-8 bg-gray-900 min-h-screen">
        <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">

            <div class="flex items-center justify-between mb-5">
                <a href="{{ route('dashboard') }}" class="text-gray-400 hover:text-white text-sm flex items-center gap-1 transition-colors">
                    &larr; Volver al catalogo
                </a>
                <h1 class="text-lg font-bold text-white">{{ $game->title }}</h1>
            </div>

            <div class="bg-black rounded-lg overflow-hidden border border-gray-700 aspect-video">
                <iframe
                    src="{{ $game->url }}"
                    class="w-full h-full border-none"
                    id="game-frame"
                    allow="autoplay; fullscreen"
                ></iframe>
            </div>

            <div class="mt-5 grid grid-cols-1 md:grid-cols-3 gap-4">
                <div class="bg-gray-800 border border-gray-700 rounded-lg p-4">
                    <p class="text-gray-400 text-xs font-semibold uppercase tracking-wide mb-1">Controles</p>
                    <p class="text-gray-200 text-sm">Flechas para moverse, Espacio para saltar.</p>
                </div>
                <div class="bg-gray-800 border border-gray-700 rounded-lg p-4">
                    <p class="text-gray-400 text-xs font-semibold uppercase tracking-wide mb-1">Puntuacion actual</p>
                    <p class="text-white text-2xl font-bold" id="current-score">0</p>
                </div>
                <div class="bg-gray-800 border border-gray-700 rounded-lg p-4">
                    <p class="text-gray-400 text-xs font-semibold uppercase tracking-wide mb-1">Estado</p>
                    <p class="text-yellow-400 text-sm font-medium" id="connection-status">Conectando...</p>
                </div>
            </div>

        </div>
    </div>

    <script>
        let sessionId = null;
        const gameId = {{ $game->id }};
        const CSRF   = '{{ csrf_token() }}';

        async function startSession() {
            try {
                const res  = await fetch(`/player/games/${gameId}/session`, {
                    method : 'POST',
                    headers: { 'Content-Type': 'application/json', 'Accept': 'application/json', 'X-CSRF-TOKEN': CSRF }
                });
                const data = await res.json();
                sessionId  = data.session_id;
                setStatus('green', 'Sesion activa #' + sessionId);
            } catch (e) {
                setStatus('red', 'Sin conexion con el servidor');
            }
        }

        window.addEventListener('message', async function(ev) {
            if (ev.data.type === 'GAME_SCORE') {
                document.getElementById('current-score').innerText = ev.data.score;
            }
            if (ev.data.type === 'GAME_OVER') {
                if (!sessionId) { setStatus('red', 'Error: no hay sesion activa'); return; }
                const finalScore = Math.floor(ev.data.score || 0);
                const bestScore  = Math.floor(ev.data.best_score || finalScore);
                try {
                    await fetch(`/player/sessions/${sessionId}/update`, {
                        method : 'PUT',
                        headers: { 'Content-Type': 'application/json', 'Accept': 'application/json', 'X-CSRF-TOKEN': CSRF },
                        body   : JSON.stringify({ score: finalScore, best_score: bestScore, ended: true })
                    });
                    setStatus('blue', 'Puntuacion guardada: ' + finalScore + ' puntos');
                } catch (e) {
                    setStatus('red', 'Error al guardar la puntuacion');
                }
            }
        });

        function setStatus(color, text) {
            const colors = { green: 'text-green-400', red: 'text-red-400', blue: 'text-blue-400', yellow: 'text-yellow-400' };
            const el = document.getElementById('connection-status');
            el.className = colors[color] + ' text-sm font-medium';
            el.innerText = text;
        }

        startSession();
    </script>
</x-app-layout>
