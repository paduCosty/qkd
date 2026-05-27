<div>
    {{-- Topbar --}}
    <div class="bg-card border-b border-border px-5 py-3.5 flex items-center gap-3.5 sticky top-0 z-50">
        <a href="{{ route('admin.dashboard') }}"
           class="text-dim hover:text-content transition-colors p-1 flex items-center">
            <svg width="22" height="22" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M19 12H5M12 19l-7-7 7-7"/></svg>
        </a>
        <div class="flex-1">
            <h2 class="font-bold text-[17px] leading-tight">{{ $student->name }}</h2>
            <p class="text-xs text-dim mt-0.5">{{ $student->email }}</p>
        </div>
    </div>

    <div class="max-w-2xl mx-auto px-5 py-6 flex flex-col gap-6">

        {{-- Info card --}}
        <div class="bg-card border border-border rounded-2xl p-5 flex items-center gap-4">
            <div class="w-14 h-14 rounded-full bg-gradient-to-br from-[#1a1a30] to-[#2a2a4a] border border-gold flex items-center justify-center font-bold text-[20px] text-gold shrink-0">
                {{ strtoupper(substr($student->name, 0, 1)) }}
            </div>
            <div class="flex-1">
                <div class="font-bold text-[16px]">{{ $student->name }}</div>
                <div class="text-sm text-dim">{{ $student->email }}</div>
                @if($student->currentGrade)
                    <div class="text-[13px] text-gold mt-1 font-medium">{{ $student->currentGrade->name }}</div>
                @else
                    <div class="text-[13px] text-dim mt-1">Fără grad atribuit</div>
                @endif
            </div>
            <div class="text-right shrink-0">
                <div class="text-[11px] text-dim mb-1">Progres materie</div>
                <div class="text-[24px] font-extrabold text-emerald-400 leading-none">{{ $masteredCount }}</div>
                <div class="text-[11px] text-dim">/ {{ $totalCount }} stăpânite</div>
            </div>
        </div>

        {{-- Stage history --}}
        <div>
            <div class="flex items-center justify-between mb-3">
                <p class="text-[11px] uppercase tracking-[1.5px] text-dim font-semibold">Stagii participate</p>
                <span class="text-[12px] text-gold font-semibold">{{ $stageHistory->count() }}</span>
            </div>

            @if($stageHistory->isEmpty())
                <div class="bg-card border border-border rounded-xl px-4 py-4 text-center">
                    <p class="text-dim text-sm">Niciun stagiu participat.</p>
                </div>
            @else
                <div class="flex flex-col gap-2">
                    @foreach($stageHistory as $enrollment)
                        <div class="bg-card border border-border rounded-xl px-4 py-3 flex items-center justify-between">
                            <div>
                                <div class="font-medium text-[14px] text-content">{{ $enrollment->stage->title }}</div>
                                <div class="text-[12px] text-dim mt-0.5">
                                    {{ $enrollment->stage->date->format('d M Y') }}
                                    @if($enrollment->stage->location)
                                        · {{ $enrollment->stage->location }}
                                    @endif
                                </div>
                            </div>
                            <span class="text-[11px] text-emerald-400 bg-emerald-500/10 border border-emerald-500/25 px-2.5 py-1 rounded-full shrink-0">✓</span>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>

        {{-- Exam history --}}
        <div>
            <div class="flex items-center justify-between mb-3">
                <p class="text-[11px] uppercase tracking-[1.5px] text-dim font-semibold">Examene</p>
                <span class="text-[12px] text-gold font-semibold">{{ $examHistory->count() }}</span>
            </div>

            @if($examHistory->isEmpty())
                <div class="bg-card border border-border rounded-xl px-4 py-4 text-center">
                    <p class="text-dim text-sm">Niciun examen susținut.</p>
                </div>
            @else
                <div class="flex flex-col gap-2">
                    @foreach($examHistory as $reg)
                        <div class="bg-card border border-border rounded-xl px-4 py-3 flex items-center justify-between">
                            <div>
                                <div class="font-medium text-[14px] text-content">{{ $reg->exam->title }}</div>
                                <div class="text-[12px] text-dim mt-0.5">
                                    {{ $reg->exam->date->format('d M Y') }}
                                    @if($reg->exam->grade)
                                        · → {{ $reg->exam->grade->name }}
                                    @endif
                                </div>
                            </div>
                            @if($reg->result === 'passed')
                                <span class="text-[11px] text-gold bg-gold/10 border border-gold/25 px-2.5 py-1 rounded-full shrink-0">🏅 Promovat</span>
                            @elseif($reg->result === 'failed')
                                <span class="text-[11px] text-dim bg-card-2 border border-border px-2.5 py-1 rounded-full shrink-0">Nepromovat</span>
                            @elseif($reg->status === 'accepted')
                                <span class="text-[11px] text-emerald-400 bg-emerald-500/10 border border-emerald-500/25 px-2.5 py-1 rounded-full shrink-0">Acceptat</span>
                            @else
                                <span class="text-[11px] text-amber-400 bg-amber-400/10 border border-amber-400/25 px-2.5 py-1 rounded-full shrink-0">{{ ucfirst($reg->status) }}</span>
                            @endif
                        </div>
                    @endforeach
                </div>
            @endif
        </div>

    </div>
</div>
