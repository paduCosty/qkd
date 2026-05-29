<div>
    {{-- ── List view ─────────────────────────────────────────────────────── --}}
    @if($view === 'list')

        <div class="bg-card border-b border-border px-5 py-3.5 flex items-center justify-between sticky top-0 z-50">
            <div>
                <h2 class="font-[family-name:var(--font-display)] text-[15px] font-bold text-gold tracking-[2px]">STAGII</h2>
                <p class="text-xs text-dim mt-0.5">{{ $upcoming->count() }} viitoare · {{ $past->count() }} trecute</p>
            </div>
            <button wire:click="openCreate"
                    class="flex items-center gap-1.5 px-3.5 py-2 bg-gold hover:bg-gold-light text-[#08080e] text-[13px] font-bold rounded-xl cursor-pointer border-none transition-colors">
                <svg width="14" height="14" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg>
                Stagiu nou
            </button>
        </div>

        <div class="max-w-2xl mx-auto px-5 py-6">

            @if($upcoming->isEmpty() && $past->isEmpty())
                <div class="bg-card border border-border rounded-2xl p-10 text-center">
                    <p class="text-dim text-sm">Niciun stagiu adăugat încă.</p>
                </div>
            @endif

            @if($upcoming->isNotEmpty())
                <p class="text-[11px] uppercase tracking-[1.5px] text-dim font-semibold mb-3">Viitoare</p>
                <div class="flex flex-col gap-2 mb-8">
                    @foreach($upcoming as $stage)
                        <div wire:key="s-{{ $stage->id }}"
                             class="bg-card border border-border rounded-xl px-4 py-3.5 flex items-center justify-between gap-3">
                            <div class="flex-1 min-w-0">
                                <div class="font-semibold text-[14px] text-content">{{ $stage->title }}</div>
                                <div class="flex items-center gap-3 mt-1 flex-wrap">
                                    <span class="text-[12px] text-gold font-medium">{{ $stage->date->format('d M Y') }}</span>
                                    @if($stage->location)
                                        <span class="text-[12px] text-dim">📍 {{ $stage->location }}</span>
                                    @endif
                                    @if($stage->registration_deadline)
                                        <span class="text-[11px] text-dim">Înscrieri până {{ $stage->registration_deadline->format('d M') }}</span>
                                    @endif
                                </div>
                            </div>
                            <div class="flex items-center gap-2 shrink-0">
                                <button wire:click="openParticipants({{ $stage->id }})"
                                        class="flex items-center gap-1.5 text-[12px] text-gold bg-gold/8 border border-gold/20 px-3 py-1.5 rounded-lg cursor-pointer hover:bg-gold/15 transition-colors border-none">
                                    <svg width="13" height="13" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M17 21v-2a4 4 0 00-4-4H5a4 4 0 00-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 00-3-3.87"/><path d="M16 3.13a4 4 0 010 7.75"/></svg>
                                    {{ $stage->enrollments_count }}
                                </button>
                                <button wire:click="openEdit({{ $stage->id }})"
                                        class="text-dim border border-border px-2.5 py-1.5 rounded-lg bg-transparent cursor-pointer hover:text-content transition-colors text-[12px]">✎</button>
                                <button @click="$store.confirm.open('Ștergi stagiul {{ addslashes($stage->title) }}?', () => $wire.deleteStage({{ $stage->id }}))"
                                        class="text-red-400 bg-red-500/8 border border-red-500/20 px-2.5 py-1.5 rounded-lg cursor-pointer hover:bg-red-500/15 transition-colors text-[12px]">✕</button>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif

            @if($past->isNotEmpty())
                <p class="text-[11px] uppercase tracking-[1.5px] text-dim font-semibold mb-3">Trecute</p>
                <div class="flex flex-col gap-2">
                    @foreach($past as $stage)
                        <div wire:key="sp-{{ $stage->id }}"
                             class="bg-card border border-border rounded-xl px-4 py-3.5 flex items-center justify-between gap-3 opacity-70">
                            <div class="flex-1 min-w-0">
                                <div class="font-semibold text-[14px] text-content">{{ $stage->title }}</div>
                                <div class="flex items-center gap-3 mt-1">
                                    <span class="text-[12px] text-dim">{{ $stage->date->format('d M Y') }}</span>
                                    @if($stage->location)
                                        <span class="text-[12px] text-dim">📍 {{ $stage->location }}</span>
                                    @endif
                                </div>
                            </div>
                            <div class="flex items-center gap-2 shrink-0">
                                <button wire:click="openParticipants({{ $stage->id }})"
                                        class="flex items-center gap-1.5 text-[12px] text-dim bg-card-2 border border-border px-3 py-1.5 rounded-lg cursor-pointer hover:text-content transition-colors border-none">
                                    <svg width="13" height="13" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M17 21v-2a4 4 0 00-4-4H5a4 4 0 00-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 00-3-3.87"/><path d="M16 3.13a4 4 0 010 7.75"/></svg>
                                    {{ $stage->enrollments_count }}
                                </button>
                                <button @click="$store.confirm.open('Ștergi stagiul {{ addslashes($stage->title) }}?', () => $wire.deleteStage({{ $stage->id }}))"
                                        class="text-red-400 bg-red-500/8 border border-red-500/20 px-2.5 py-1.5 rounded-lg cursor-pointer hover:bg-red-500/15 transition-colors text-[12px]">✕</button>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif

        </div>

    {{-- ── Form view ──────────────────────────────────────────────────────── --}}
    @elseif($view === 'form')

        <div class="bg-card border-b border-border px-5 py-3.5 flex items-center gap-3.5 sticky top-0 z-50">
            <button wire:click="cancelForm" class="text-dim hover:text-content transition-colors p-1 cursor-pointer border-none bg-transparent">
                <svg width="22" height="22" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M19 12H5M12 19l-7-7 7-7"/></svg>
            </button>
            <h2 class="font-bold text-[16px]">{{ $editStageId ? 'Editează stagiu' : 'Stagiu nou' }}</h2>
        </div>

        <div class="max-w-lg mx-auto px-5 py-6 flex flex-col gap-4">

            <div>
                <label class="text-[12px] text-dim font-medium mb-1.5 block">Titlu *</label>
                <input wire:model="title" type="text" placeholder="ex: Stagiu Național Cluj 2026"
                       class="w-full bg-card border border-border rounded-xl px-3.5 py-2.5 text-content text-[14px]">
                @error('title') <p class="text-red-400 text-xs mt-1">{{ $message }}</p> @enderror
            </div>

            <div class="grid grid-cols-2 gap-3">
                <div>
                    <label class="text-[12px] text-dim font-medium mb-1.5 block">Data stagiului *</label>
                    <input wire:model="date" type="datetime-local"
                        class="w-full bg-card border border-border rounded-xl px-3.5 py-2.5 text-content text-[14px]">
                    @error('date') <p class="text-red-400 text-xs mt-1">{{ $message }}</p> @enderror
                </div>
                <div>
                    <label class="text-[12px] text-dim font-medium mb-1.5 block">Limită înscrieri</label>
                    <input wire:model="registrationDeadline" type="date"
                           class="w-full bg-card border border-border rounded-xl px-3.5 py-2.5 text-content text-[14px]">
                </div>
            </div>

            <div>
                <label class="text-[12px] text-dim font-medium mb-1.5 block">Locație</label>
                <input wire:model="location" type="text" placeholder="ex: Sala Polivalentă, Cluj"
                       class="w-full bg-card border border-border rounded-xl px-3.5 py-2.5 text-content text-[14px]">
            </div>

            <div>
                <label class="text-[12px] text-dim font-medium mb-1.5 block">Descriere</label>
                <textarea wire:model="description" rows="4" placeholder="Detalii despre stagiu..."
                          class="w-full bg-card border border-border rounded-xl px-3.5 py-2.5 text-content text-[14px] resize-y leading-relaxed"></textarea>
            </div>

            <div class="flex gap-3 pt-2">
                <button wire:click="saveStage"
                        class="px-6 py-2.5 bg-gold hover:bg-gold-light text-[#08080e] font-bold text-[14px] rounded-xl cursor-pointer border-none transition-colors">
                    {{ $editStageId ? 'Salvează' : 'Creează stagiu' }}
                </button>
                <button wire:click="cancelForm"
                        class="px-5 py-2.5 bg-transparent border border-border text-dim text-[14px] rounded-xl cursor-pointer hover:text-content transition-colors">
                    Anulează
                </button>
            </div>

        </div>

    {{-- ── Participants view ──────────────────────────────────────────────── --}}
    @elseif($view === 'participants')

        <div class="bg-card border-b border-border px-5 py-3.5 flex items-center gap-3.5 sticky top-0 z-50">
            <button wire:click="backToList" class="text-dim hover:text-content transition-colors p-1 cursor-pointer border-none bg-transparent">
                <svg width="22" height="22" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M19 12H5M12 19l-7-7 7-7"/></svg>
            </button>
            <div>
                <h2 class="font-bold text-[16px] leading-tight">{{ $stage->title }}</h2>
                <p class="text-xs text-dim mt-0.5">{{ $stage->date->format('d M Y') }} · {{ $participants->count() }} înscriși</p>
            </div>
        </div>

        <div class="max-w-2xl mx-auto px-5 py-6">

            @if($participants->isEmpty())
                <div class="bg-card border border-border rounded-2xl p-10 text-center">
                    <p class="text-dim text-sm">Niciun elev înscris încă.</p>
                </div>
            @else
                <div class="flex flex-col gap-2">
                    @foreach($participants as $enrollment)
                        <div wire:key="e-{{ $enrollment->id }}"
                             class="bg-card border border-border rounded-xl px-4 py-3 flex items-center justify-between gap-3">
                            <div class="flex items-center gap-3 flex-1 min-w-0">
                                <div class="w-9 h-9 rounded-full bg-gradient-to-br from-[#1a1a30] to-[#2a2a4a] border border-border flex items-center justify-center text-[13px] font-bold text-gold shrink-0">
                                    {{ strtoupper(substr($enrollment->user->name, 0, 1)) }}
                                </div>
                                <div class="min-w-0">
                                    <a href="{{ route('admin.student.profile', $enrollment->user) }}"
                                       class="font-medium text-[14px] text-content hover:text-gold transition-colors no-underline">
                                        {{ $enrollment->user->name }}
                                    </a>
                                    @if($enrollment->user->currentGrade)
                                        <div class="text-[11px] text-dim">{{ $enrollment->user->currentGrade->name }}</div>
                                    @endif
                                </div>
                            </div>

                            <div class="flex items-center gap-2 shrink-0">
                                @if($enrollment->status === 'pending')
                                    <span class="text-[11px] text-amber-400 bg-amber-400/10 border border-amber-400/25 px-2.5 py-1 rounded-full">În așteptare</span>
                                    <button wire:click="accept({{ $enrollment->id }})"
                                            class="text-[12px] text-emerald-400 bg-emerald-500/10 border border-emerald-500/25 px-3 py-1.5 rounded-lg cursor-pointer hover:bg-emerald-500/20 transition-colors border-none">
                                        Acceptă
                                    </button>
                                    <button wire:click="reject({{ $enrollment->id }})"
                                            class="text-[12px] text-red-400 bg-red-500/8 border border-red-500/20 px-3 py-1.5 rounded-lg cursor-pointer hover:bg-red-500/15 transition-colors border-none">
                                        Respinge
                                    </button>
                                @elseif($enrollment->status === 'accepted')
                                    <span class="text-[11px] text-emerald-400 bg-emerald-500/10 border border-emerald-500/25 px-2.5 py-1 rounded-full">✓ Acceptat</span>
                                    <button wire:click="reject({{ $enrollment->id }})"
                                            class="text-[11px] text-dim border border-border px-2.5 py-1 rounded-lg cursor-pointer hover:text-red-400 transition-colors border-none bg-transparent">
                                        Anulează
                                    </button>
                                @else
                                    <span class="text-[11px] text-red-400 bg-red-500/8 border border-red-500/20 px-2.5 py-1 rounded-full">Respins</span>
                                    <button wire:click="accept({{ $enrollment->id }})"
                                            class="text-[11px] text-dim border border-border px-2.5 py-1 rounded-lg cursor-pointer hover:text-emerald-400 transition-colors border-none bg-transparent">
                                        Acceptă
                                    </button>
                                @endif
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif

        </div>

    @endif
</div>
