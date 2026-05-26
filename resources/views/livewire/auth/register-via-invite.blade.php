<div class="min-h-screen bg-surface text-content antialiased flex items-center justify-center px-4">

    <div class="w-full max-w-md">

        {{-- Logo --}}
        <div class="text-center mb-8">
            <div class="inline-flex items-center justify-center w-16 h-16 rounded-full border border-gold/50 bg-gradient-to-br from-card to-gold/15 mb-4">
                <svg width="28" height="28" viewBox="0 0 44 44" fill="none">
                    <text x="22" y="30" text-anchor="middle" font-family="Cinzel,serif" font-size="17" font-weight="600" fill="#c9960f">氣</text>
                </svg>
            </div>
            <h1 class="font-[family-name:var(--font-display)] text-xl font-bold text-gold tracking-[3px]">QWAN KI DO</h1>
        </div>

        @if($invalid)
            {{-- Invalid / expired invite --}}
            <div class="bg-card border border-border rounded-2xl p-8 text-center">
                <div class="text-4xl mb-4">⚠️</div>
                <h2 class="text-lg font-semibold mb-2">Link invalid sau expirat</h2>
                <p class="text-dim text-sm mb-6">Acest link de invitație nu mai este valid. Cere un link nou de la un antrenor.</p>
                <a href="{{ route('home') }}" class="text-gold hover:text-gold-light text-sm transition-colors">Înapoi la pagina principală</a>
            </div>
        @else
            <div class="bg-card border border-border rounded-2xl p-8">
                <h2 class="text-lg font-semibold mb-1">Înregistrare antrenor</h2>
                <p class="text-dim text-[13px] mb-6">Creează-ți contul. Vei fi activ imediat ca instructor.</p>

                <form wire:submit="register" class="space-y-4">

                    <div>
                        <label class="block text-[12px] text-dim mb-1.5">Nume complet</label>
                        <input wire:model="name" type="text" autocomplete="name"
                               class="w-full bg-surface border border-border rounded-lg px-3.5 py-2.5 text-[14px] text-content placeholder-dim/50 focus:outline-none focus:border-gold/50 transition-colors"
                               placeholder="Ion Popescu">
                        @error('name') <p class="text-red-400 text-[11px] mt-1">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label class="block text-[12px] text-dim mb-1.5">Email</label>
                        <input wire:model="email" type="email" autocomplete="email"
                               class="w-full bg-surface border border-border rounded-lg px-3.5 py-2.5 text-[14px] text-content placeholder-dim/50 focus:outline-none focus:border-gold/50 transition-colors"
                               placeholder="ion@exemplu.ro">
                        @error('email') <p class="text-red-400 text-[11px] mt-1">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label class="block text-[12px] text-dim mb-1.5">Parolă</label>
                        <input wire:model="password" type="password" autocomplete="new-password"
                               class="w-full bg-surface border border-border rounded-lg px-3.5 py-2.5 text-[14px] text-content placeholder-dim/50 focus:outline-none focus:border-gold/50 transition-colors"
                               placeholder="Minim 8 caractere">
                        @error('password') <p class="text-red-400 text-[11px] mt-1">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label class="block text-[12px] text-dim mb-1.5">Confirmă parola</label>
                        <input wire:model="password_confirmation" type="password" autocomplete="new-password"
                               class="w-full bg-surface border border-border rounded-lg px-3.5 py-2.5 text-[14px] text-content placeholder-dim/50 focus:outline-none focus:border-gold/50 transition-colors"
                               placeholder="Repetă parola">
                    </div>

                    <button type="submit"
                            class="w-full bg-gold hover:bg-gold-light text-[#08080e] font-bold text-[14px] py-2.5 rounded-lg transition-colors mt-2"
                            wire:loading.attr="disabled" wire:loading.class="opacity-70">
                        <span wire:loading.remove>Creează cont de antrenor</span>
                        <span wire:loading>Se creează contul...</span>
                    </button>

                </form>
            </div>
        @endif
    </div>
</div>
