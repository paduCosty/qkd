<!DOCTYPE html>
<html lang="ro">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name') }} — {{ $title ?? 'Admin' }}</title>
    <meta name="theme-color" content="#09090f">
    <meta name="mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent">
    <meta name="apple-mobile-web-app-title" content="Qwan Ki Do">
    <link rel="manifest" href="/manifest.json">
    <link rel="apple-touch-icon" href="/pwa-icons/icon-180x180.png">
    <link rel="icon" type="image/svg+xml" href="/pwa-icons/icon.svg">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&family=Cinzel:wght@400;600;700&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
</head>
<body class="bg-surface text-content antialiased">

    {{-- ── Global confirm modal ── --}}
    <div x-data
         x-show="$store.confirm.show"
         x-transition:enter="transition ease-out duration-150"
         x-transition:enter-start="opacity-0"
         x-transition:enter-end="opacity-100"
         x-transition:leave="transition ease-in duration-100"
         x-transition:leave-start="opacity-100"
         x-transition:leave-end="opacity-0"
         @keydown.escape.window="$store.confirm.cancel()"
         class="fixed inset-0 z-[200] flex items-center justify-center px-4"
         style="display:none">

        {{-- Backdrop --}}
        <div class="absolute inset-0 bg-black/60 backdrop-blur-sm" @click="$store.confirm.cancel()"></div>

        {{-- Modal --}}
        <div x-show="$store.confirm.show"
             x-transition:enter="transition ease-out duration-150"
             x-transition:enter-start="opacity-0 scale-95"
             x-transition:enter-end="opacity-100 scale-100"
             x-transition:leave="transition ease-in duration-100"
             x-transition:leave-start="opacity-100 scale-100"
             x-transition:leave-end="opacity-0 scale-95"
             class="relative bg-card border border-border rounded-2xl shadow-2xl shadow-black/50 w-full max-w-sm p-6">

            {{-- Icon --}}
            <div class="flex items-center justify-center w-12 h-12 rounded-full bg-red-500/10 border border-red-500/20 mx-auto mb-4">
                <svg width="22" height="22" fill="none" stroke="#f87171" stroke-width="2" viewBox="0 0 24 24">
                    <path d="M10.29 3.86L1.82 18a2 2 0 001.71 3h16.94a2 2 0 001.71-3L13.71 3.86a2 2 0 00-3.42 0z"/>
                    <line x1="12" y1="9" x2="12" y2="13"/><line x1="12" y1="17" x2="12.01" y2="17"/>
                </svg>
            </div>

            {{-- Message --}}
            <p class="text-center text-[14px] text-content font-medium mb-1" x-text="$store.confirm.message"></p>
            <p class="text-center text-[12px] text-dim mb-6">Această acțiune nu poate fi anulată.</p>

            {{-- Buttons --}}
            <div class="flex gap-2.5">
                <button @click="$store.confirm.cancel()"
                        class="flex-1 bg-transparent border border-border text-dim text-[13px] font-medium py-2.5 rounded-xl cursor-pointer transition-colors hover:border-content/30 hover:text-content">
                    Anulează
                </button>
                <button @click="$store.confirm.commit()"
                        class="flex-1 bg-red-500/15 border border-red-500/30 text-red-400 text-[13px] font-bold py-2.5 rounded-xl cursor-pointer transition-colors hover:bg-red-500/25">
                    Confirmă
                </button>
            </div>
        </div>
    </div>

    {{-- Sidebar (desktop only) --}}
    <aside class="hidden md:flex flex-col fixed inset-y-0 left-0 w-60 bg-card border-r border-border z-50 overflow-y-auto">

        {{-- Logo --}}
        <div class="px-5 pt-6 pb-4">
            <div class="flex items-center gap-2.5">
                <div class="w-9 h-9 rounded-full border border-gold/40 bg-gradient-to-br from-card to-gold/10 flex items-center justify-center shrink-0">
                    <svg width="18" height="18" viewBox="0 0 44 44" fill="none">
                        <text x="22" y="30" text-anchor="middle" font-family="Cinzel,serif" font-size="17" font-weight="600" fill="#c9960f">氣</text>
                    </svg>
                </div>
                <div>
                    <div class="font-[family-name:var(--font-display)] text-xs font-bold text-gold tracking-[2px] leading-tight">QWAN KI DO</div>
                    <div class="text-[10px] text-dim mt-0.5">Panou antrenor</div>
                </div>
            </div>
        </div>

        <div class="h-px bg-border mx-3 mb-2"></div>

        {{-- Nav --}}
        <nav class="flex-1 px-2 py-1 flex flex-col gap-0.5">
            <a href="{{ route('admin.dashboard') }}"
               class="flex items-center gap-2.5 px-3 py-2.5 rounded-lg text-[13px] font-medium transition-colors
                      {{ request()->routeIs('admin.dashboard') ? 'bg-gold/10 text-gold font-semibold' : 'text-dim hover:bg-white/4 hover:text-content' }}">
                <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path d="M17 21v-2a4 4 0 00-4-4H5a4 4 0 00-4 4v2"/><circle cx="9" cy="7" r="4"/>
                    <path d="M23 21v-2a4 4 0 00-3-3.87M16 3.13a4 4 0 010 7.75"/>
                </svg>
                Elevi
            </a>
            <a href="{{ route('admin.curriculum') }}"
               class="flex items-center gap-2.5 px-3 py-2.5 rounded-lg text-[13px] font-medium transition-colors
                      {{ request()->routeIs('admin.curriculum') || request()->routeIs('admin.grades.*') ? 'bg-gold/10 text-gold font-semibold' : 'text-dim hover:bg-white/4 hover:text-content' }}">
                <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path d="M4 19.5A2.5 2.5 0 016.5 17H20"/><path d="M6.5 2H20v20H6.5A2.5 2.5 0 014 19.5v-15A2.5 2.5 0 016.5 2z"/>
                </svg>
                Programă
            </a>
            <a href="{{ route('admin.stages') }}"
                   class="flex items-center gap-2.5 px-3 py-2.5 rounded-lg text-[13px] font-medium transition-colors
                          {{ request()->routeIs('admin.stages') ? 'bg-gold/10 text-gold font-semibold' : 'text-dim hover:bg-white/4 hover:text-content' }}">
                <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                Stagii
            </a>
            <a href="{{ route('admin.exams') }}"
                   class="flex items-center gap-2.5 px-3 py-2.5 rounded-lg text-[13px] font-medium transition-colors
                          {{ request()->routeIs('admin.exams') ? 'bg-gold/10 text-gold font-semibold' : 'text-dim hover:bg-white/4 hover:text-content' }}">
                <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"/></svg>
                Examene
            </a>
            <a href="{{ route('coaches') }}"
               class="flex items-center gap-2.5 px-3 py-2.5 rounded-lg text-[13px] font-medium transition-colors
                      {{ request()->routeIs('coaches') ? 'bg-gold/10 text-gold font-semibold' : 'text-dim hover:bg-white/4 hover:text-content' }}">
                <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <circle cx="12" cy="8" r="4"/><path d="M4 20c0-4 3.6-7 8-7s8 3 8 7"/>
                </svg>
                Antrenori
            </a>

            <div class="h-px bg-border mx-1 my-1"></div>

            @livewire('admin.invite-button')
        </nav>

        {{-- User + logout --}}
        <div class="px-3 py-4 border-t border-border">
            <div class="flex items-center gap-2.5 mb-3">
                <div class="w-8 h-8 rounded-full bg-gradient-to-br from-[#1a1830] to-[#2a2050] border border-gold flex items-center justify-center text-gold font-bold text-sm shrink-0">
                    {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                </div>
                <div class="min-w-0">
                    <div class="text-[13px] font-semibold leading-tight truncate">{{ auth()->user()->name }}</div>
                    <div class="text-[11px] text-dim">Administrator</div>
                </div>
            </div>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit"
                        class="w-full bg-transparent border border-border text-dim text-xs py-2 rounded-lg cursor-pointer transition-colors hover:border-content/30 hover:text-content">
                    Deconectare
                </button>
            </form>
        </div>
    </aside>

    {{-- Main content --}}
    <div class="md:ml-60">
        {{ $slot }}
    </div>

    <script>
    document.addEventListener('alpine:init', () => {
        Alpine.store('confirm', {
            show: false,
            message: '',
            _action: null,
            open(message, action) {
                this.message = message;
                this._action = action;
                this.show = true;
            },
            commit() {
                if (this._action) this._action();
                this.show = false;
                this._action = null;
            },
            cancel() {
                this.show = false;
                this._action = null;
            },
        });
    });
    </script>
    @livewireScripts
</body>
</html>
