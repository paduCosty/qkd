<div class="min-h-screen bg-surface text-content antialiased">

    {{-- Background glows --}}
    <div class="fixed inset-0 overflow-hidden pointer-events-none z-0">
        <div class="absolute -top-48 -right-48 w-[700px] h-[700px] rounded-full bg-[radial-gradient(circle,rgba(201,150,15,.06)_0%,transparent_65%)]"></div>
        <div class="absolute -bottom-48 -left-48 w-[700px] h-[700px] rounded-full bg-[radial-gradient(circle,rgba(37,99,235,.04)_0%,transparent_65%)]"></div>
    </div>

    <div class="relative z-10 max-w-3xl mx-auto px-6 py-12">

        {{-- Header --}}
        <div class="mb-10 text-center">
            <a href="{{ route('home') }}" class="inline-flex items-center gap-2 text-dim hover:text-content text-sm mb-8 transition-colors">
                <svg width="14" height="14" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path d="M19 12H5M12 5l-7 7 7 7"/>
                </svg>
                Înapoi la pagina principală
            </a>
            <h1 class="font-[family-name:var(--font-display)] text-3xl font-bold text-gold tracking-widest mb-2">ANTRENORI</h1>
            <p class="text-dim text-sm">Echipa de instructori Qwan Ki Do</p>
        </div>

        {{-- Coaches grid --}}
        @if($coaches->isEmpty())
            <div class="text-center py-16 text-dim">Niciun antrenor activ momentan.</div>
        @else
            <div class="grid gap-4 sm:grid-cols-2">
                @foreach($coaches as $coach)
                    <div class="bg-card border border-border rounded-xl px-6 py-5 flex items-center gap-4">
                        <div class="w-12 h-12 rounded-full bg-gradient-to-br from-[#1a1830] to-[#2a2050] border border-gold/60 flex items-center justify-center text-gold font-bold text-lg shrink-0">
                            {{ strtoupper(substr($coach->name, 0, 1)) }}
                        </div>
                        <div class="min-w-0">
                            <div class="font-semibold text-[15px] leading-tight truncate">{{ $coach->name }}</div>
                            @if($coach->is_owner)
                                <div class="text-[11px] text-gold mt-0.5">Fondator & Instructor Principal</div>
                            @else
                                <div class="text-[11px] text-dim mt-0.5">Instructor</div>
                            @endif
                        </div>
                        @if($coach->is_owner)
                            <div class="ml-auto shrink-0">
                                <span class="text-[10px] bg-gold/10 text-gold border border-gold/30 px-2 py-0.5 rounded-full">Owner</span>
                            </div>
                        @endif
                    </div>
                @endforeach
            </div>
        @endif
    </div>
</div>
