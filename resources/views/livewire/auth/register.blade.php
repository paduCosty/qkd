<div>
    {{-- Background glows --}}
    <div class="fixed inset-0 overflow-hidden pointer-events-none z-0">
        <div class="absolute -top-32 -right-32 w-[480px] h-[480px] rounded-full bg-[radial-gradient(circle,rgba(201,150,15,.07)_0%,transparent_70%)]"></div>
        <div class="absolute -bottom-32 -left-32 w-[480px] h-[480px] rounded-full bg-[radial-gradient(circle,rgba(37,99,235,.05)_0%,transparent_70%)]"></div>
    </div>

    <div class="relative z-10 min-h-screen flex items-center justify-center p-6">
        <div class="w-full max-w-sm">

            {{-- Logo --}}
            <div class="text-center mb-11">
                <div class="inline-flex items-center justify-center w-22 h-22 rounded-full border-2 border-gold bg-gradient-to-br from-card to-gold/20 mb-6 shadow-[0_0_40px_rgba(201,150,15,.2)]">
                    <svg width="44" height="44" viewBox="0 0 44 44" fill="none">
                        <circle cx="22" cy="22" r="17" stroke="#c9960f" stroke-width="1.2" opacity=".4"/>
                        <text x="22" y="29" text-anchor="middle" font-family="Cinzel,serif" font-size="15" font-weight="600" fill="#c9960f">氣</text>
                    </svg>
                </div>
                <h1 class="font-[family-name:var(--font-display)] text-2xl font-bold text-gold tracking-[4px] mb-1.5">QWAN KI DO</h1>
                <p class="text-dim text-xs tracking-[2px] uppercase">Platforma de Antrenament</p>
            </div>

            @if($registered)
                {{-- Success state --}}
                <div class="bg-card border border-emerald-500/30 rounded-2xl p-10 text-center shadow-[0_0_30px_rgba(201,150,15,.08)]">
                    <div class="inline-flex items-center justify-center w-14 h-14 rounded-full bg-emerald-500/10 border border-emerald-500/30 mb-5">
                        <svg width="24" height="24" fill="none" stroke="#10b981" stroke-width="2.5" viewBox="0 0 24 24"><path d="M5 13l4 4L19 7"/></svg>
                    </div>
                    <h2 class="text-xl font-bold text-emerald-400 mb-2.5">Cerere trimisă!</h2>
                    <p class="text-dim text-sm leading-relaxed mb-6">Contul tău a fost creat și așteaptă aprobarea antrenorului. Vei putea să te autentifici după aprobare.</p>
                    <a href="{{ route('login') }}" class="text-gold text-sm font-semibold hover:text-gold-light transition-colors">← Înapoi la autentificare</a>
                </div>
            @else
                {{-- Card --}}
                <div class="bg-card border border-border rounded-2xl p-8 shadow-[0_0_30px_rgba(201,150,15,.08)]">
                    <h2 class="text-xl font-bold mb-1.5">Înregistrare</h2>
                    <p class="text-dim text-sm mb-7">Creează un cont — antrenorul îți va aproba accesul</p>

                    <form wire:submit="register" class="flex flex-col gap-4">

                        {{-- Nume --}}
                        <div>
                            <label class="block text-[11px] text-dim font-bold tracking-[.8px] uppercase mb-1.5">Nume complet</label>
                            <input wire:model="name" type="text" placeholder="Ion Popescu" autocomplete="name"
                                   class="w-full bg-surface border rounded-lg px-3.5 py-3 text-content text-[15px] transition-colors
                                          {{ $errors->has('name') ? 'border-red-500' : 'border-border' }}">
                            @error('name')
                                <p class="text-red-400 text-xs mt-1.5">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- Email --}}
                        <div>
                            <label class="block text-[11px] text-dim font-bold tracking-[.8px] uppercase mb-1.5">Email</label>
                            <input wire:model="email" type="email" placeholder="email@exemplu.ro" autocomplete="email"
                                   class="w-full bg-surface border rounded-lg px-3.5 py-3 text-content text-[15px] transition-colors
                                          {{ $errors->has('email') ? 'border-red-500' : 'border-border' }}">
                            @error('email')
                                <p class="text-red-400 text-xs mt-1.5">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- Parolă --}}
                        <div>
                            <label class="block text-[11px] text-dim font-bold tracking-[.8px] uppercase mb-1.5">Parolă</label>
                            <input wire:model="password" type="password" placeholder="min. 8 caractere" autocomplete="new-password"
                                   class="w-full bg-surface border rounded-lg px-3.5 py-3 text-content text-[15px] transition-colors
                                          {{ $errors->has('password') ? 'border-red-500' : 'border-border' }}">
                            @error('password')
                                <p class="text-red-400 text-xs mt-1.5">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- Confirmare --}}
                        <div>
                            <label class="block text-[11px] text-dim font-bold tracking-[.8px] uppercase mb-1.5">Confirmă parola</label>
                            <input wire:model="password_confirmation" type="password" placeholder="••••••••" autocomplete="new-password"
                                   class="w-full bg-surface border border-border rounded-lg px-3.5 py-3 text-content text-[15px] transition-colors">
                        </div>

                        {{-- Submit --}}
                        <button type="submit"
                                class="w-full bg-gold hover:bg-gold-light text-[#08080e] font-bold rounded-lg py-3.5 text-[15px] tracking-wide transition-colors cursor-pointer mt-1
                                       disabled:opacity-60 disabled:cursor-not-allowed"
                                wire:loading.attr="disabled">
                            <span wire:loading.remove>Trimite cererea</span>
                            <span wire:loading>Se procesează...</span>
                        </button>

                    </form>

                    {{-- Login link --}}
                    <div class="mt-5 pt-5 border-t border-border text-center">
                        <span class="text-dim text-sm">Ai deja cont? </span>
                        <a href="{{ route('login') }}" class="text-gold text-sm font-semibold hover:text-gold-light transition-colors">Autentifică-te</a>
                    </div>
                </div>
            @endif

            <p class="text-center text-[#3a3a55] text-xs mt-7 tracking-widest">Âm — Dương · Forță și Flexibilitate</p>
        </div>
    </div>
</div>
