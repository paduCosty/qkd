<div x-data="{ tab: 'materie', filter: 'all' }">

    {{-- Topbar --}}
    <div class="bg-card border-b border-border px-5 py-3.5 flex items-center justify-between sticky top-0 z-50">
        <div class="flex items-center gap-3">
            <div class="w-10 h-10 rounded-full bg-gradient-to-br from-[#1a1a30] to-[#2a2a4a] border border-gold flex items-center justify-center font-bold text-[15px] text-gold shrink-0">
                {{ strtoupper(substr($user->name, 0, 1)) }}
            </div>
            <div>
                <div class="font-bold text-[15px] leading-tight">{{ $user->name }}</div>
                @if($user->currentGrade)
                    <div class="flex items-center gap-1.5 mt-0.5">
                        @if($user->currentGrade->order === 0)
                            <div class="belt"><span class="text-[11px] text-[#555] font-semibold">0</span></div>
                        @else
                            <div class="belt">
                                @for($i = 0; $i < $user->currentGrade->order; $i++)
                                    <div class="cap"></div>
                                @endfor
                            </div>
                        @endif
                        <span class="text-dim text-xs">{{ $user->currentGrade->name }}</span>
                    </div>
                @endif
            </div>
        </div>
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="text-dim hover:text-content transition-colors p-1.5 cursor-pointer bg-transparent border-none" title="Deconectare">
                <svg width="20" height="20" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/></svg>
            </button>
        </form>
    </div>

    {{-- Tab bar --}}
    <div class="flex bg-card border-b border-border px-4 gap-1">
        <button @click="tab = 'materie'"
                :class="tab === 'materie' ? 'text-gold border-b-2 border-gold' : 'text-dim hover:text-content border-b-2 border-transparent'"
                class="px-3 py-3 text-[13px] font-semibold cursor-pointer bg-transparent border-none transition-colors">
            Materie
        </button>
        <button @click="tab = 'stagii'"
                :class="tab === 'stagii' ? 'text-gold border-b-2 border-gold' : 'text-dim hover:text-content border-b-2 border-transparent'"
                class="px-3 py-3 text-[13px] font-semibold cursor-pointer bg-transparent border-none transition-colors flex items-center gap-1.5">
            Stagii
            @if($upcomingStages->isNotEmpty())
                <span class="text-[10px] bg-gold/15 text-gold px-1.5 py-0.5 rounded-full">{{ $upcomingStages->count() }}</span>
            @endif
        </button>
        <button @click="tab = 'examene'"
                :class="tab === 'examene' ? 'text-gold border-b-2 border-gold' : 'text-dim hover:text-content border-b-2 border-transparent'"
                class="px-3 py-3 text-[13px] font-semibold cursor-pointer bg-transparent border-none transition-colors flex items-center gap-1.5">
            Examene
            @if($upcomingExams->isNotEmpty())
                <span class="text-[10px] bg-gold/15 text-gold px-1.5 py-0.5 rounded-full">{{ $upcomingExams->count() }}</span>
            @endif
        </button>
    </div>

    {{-- ══════════════════════════════════════════════════════════════════════ --}}
    {{-- MATERIE TAB                                                           --}}
    {{-- ══════════════════════════════════════════════════════════════════════ --}}
    <div x-show="tab === 'materie'" class="flex flex-col md:flex-row">

        {{-- Left column --}}
        <div class="md:w-[340px] md:shrink-0 p-5 md:p-6 md:border-r md:border-border md:sticky md:top-[105px] md:h-[calc(100vh-105px)] md:overflow-y-auto">

            {{-- Stats --}}
            <div class="grid grid-cols-3 gap-2.5 mb-5">
                <div class="bg-card border border-border rounded-xl p-3.5 text-center">
                    <div class="text-[26px] font-extrabold text-emerald-400 leading-none">{{ $masteredCount }}</div>
                    <div class="text-[11px] text-dim mt-1">Stăpânite</div>
                </div>
                <div class="bg-card border border-border rounded-xl p-3.5 text-center">
                    <div class="text-[26px] font-extrabold text-amber-400 leading-none">{{ $progressCount }}</div>
                    <div class="text-[11px] text-dim mt-1">În lucru</div>
                </div>
                <div class="bg-card border border-border rounded-xl p-3.5 text-center">
                    <div class="text-[26px] font-extrabold text-dim leading-none">{{ $unknownCount }}</div>
                    <div class="text-[11px] text-dim mt-1">De studiat</div>
                </div>
            </div>

            {{-- Filter pills --}}
            <div class="flex gap-2 mb-5 overflow-x-auto pb-0.5 [scrollbar-width:none]">
                <button @click="filter = 'all'"
                        :class="filter === 'all' ? 'bg-gold/12 text-gold border-gold/30 font-bold' : 'text-dim border-border hover:border-content/20 hover:text-content'"
                        class="text-xs px-3.5 py-1.5 rounded-full border shrink-0 transition-colors cursor-pointer bg-transparent">
                    Toate <span class="opacity-60 font-normal">{{ $totalCount }}</span>
                </button>
                <button @click="filter = 'mastered'"
                        :class="filter === 'mastered' ? 'bg-gold/12 text-gold border-gold/30 font-bold' : 'text-dim border-border hover:border-content/20 hover:text-content'"
                        class="text-xs px-3.5 py-1.5 rounded-full border shrink-0 transition-colors cursor-pointer bg-transparent">
                    ✓ Stăpânite <span class="opacity-60 font-normal">{{ $masteredCount }}</span>
                </button>
                <button @click="filter = 'progress'"
                        :class="filter === 'progress' ? 'bg-gold/12 text-gold border-gold/30 font-bold' : 'text-dim border-border hover:border-content/20 hover:text-content'"
                        class="text-xs px-3.5 py-1.5 rounded-full border shrink-0 transition-colors cursor-pointer bg-transparent">
                    ⚡ În lucru <span class="opacity-60 font-normal">{{ $progressCount }}</span>
                </button>
                <button @click="filter = 'unknown'"
                        :class="filter === 'unknown' ? 'bg-gold/12 text-gold border-gold/30 font-bold' : 'text-dim border-border hover:border-content/20 hover:text-content'"
                        class="text-xs px-3.5 py-1.5 rounded-full border shrink-0 transition-colors cursor-pointer bg-transparent">
                    — De studiat <span class="opacity-60 font-normal">{{ $unknownCount }}</span>
                </button>
            </div>

            {{-- Continue card --}}
            @if($lastProgress)
                <p class="text-[11px] uppercase tracking-[1.5px] text-dim font-semibold mb-2.5">Continuă de unde ai rămas</p>
                <div class="bg-card border border-border rounded-xl p-3.5 flex items-center gap-3.5 mb-5">
                    <div class="w-14 h-11 bg-gradient-to-br from-[#1a1a30] to-[#0f0f1e] rounded-lg shrink-0 flex items-center justify-center border border-border">
                        <svg width="20" height="20" fill="#c9960f" viewBox="0 0 24 24"><path d="M8 5v14l11-7z"/></svg>
                    </div>
                    <div class="flex-1 min-w-0">
                        <div class="viet-name mb-0.5">{{ $lastProgress->name_viet }}</div>
                        <div class="text-[13px] font-medium text-content truncate">{{ $lastProgress->name_ro }}</div>
                        @if($lastProgress->category)
                            <div class="text-[11px] text-dim mt-0.5">{{ $lastProgress->category->name_viet }}</div>
                        @endif
                    </div>
                    <span class="text-[11px] px-2.5 py-1 rounded-full bg-amber-400/12 text-amber-400 border border-amber-400/25 whitespace-nowrap shrink-0">⚡ În lucru</span>
                </div>
            @elseif($totalCount === 0)
                <div class="bg-card border border-border rounded-xl p-5 text-center mb-5">
                    <p class="text-dim text-sm">Antrenorul nu a adăugat materie încă.</p>
                </div>
            @endif

        </div>

        {{-- Right column --}}
        <div class="flex-1 p-4 md:p-6 pb-24">
            <p class="text-[11px] uppercase tracking-[1.5px] text-dim font-semibold mb-3">Materie pe grade</p>

            @forelse($grades as $grade)
                @php
                    $gradeTechs    = $grade->categories->flatMap->techniques;
                    $gradeTotal    = $gradeTechs->count();
                    $gradeMastered = $gradeTechs->filter(fn($t) => ($progressMap[$t->id] ?? null) === 'mastered')->count();
                    $pct           = $gradeTotal > 0 ? round($gradeMastered / $gradeTotal * 100) : 0;
                    $isCurrentGrade = $user->current_grade_id === $grade->id;
                @endphp

                <div wire:key="grade-{{ $grade->id }}"
                     x-data="{ open: {{ $isCurrentGrade ? 'true' : 'false' }} }"
                     class="bg-card border border-border rounded-xl mb-2 overflow-hidden">

                    <div @click="open = !open" class="px-4 py-3.5 flex items-center justify-between cursor-pointer select-none">
                        <div class="flex items-center gap-3">
                            @if($grade->order === 0)
                                <div class="belt"><span class="text-[11px] text-[#555] font-semibold">0</span></div>
                            @else
                                <div class="belt">
                                    @for($i = 0; $i < $grade->order; $i++)
                                        <div class="cap"></div>
                                    @endfor
                                </div>
                            @endif
                            <div>
                                <div class="font-semibold text-[14px]">{{ $grade->name }}</div>
                                <div class="text-xs text-dim mt-0.5">{{ $gradeMastered }} / {{ $gradeTotal }} tehnici</div>
                            </div>
                        </div>
                        <div class="flex items-center gap-2.5">
                            <div class="w-11 h-1.5 bg-border rounded-full overflow-hidden">
                                <div class="h-full rounded-full transition-all"
                                     style="width:{{ $pct }}%;background:{{ $pct === 100 ? '#10b981' : ($pct > 0 ? '#f59e0b' : 'transparent') }};"></div>
                            </div>
                            <svg :style="open ? 'transform:rotate(180deg)' : ''"
                                 style="transition:transform .2s"
                                 class="text-dim shrink-0"
                                 width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path d="M19 9l-7 7-7-7"/>
                            </svg>
                        </div>
                    </div>

                    <div x-show="open"
                         x-transition:enter="transition ease-out duration-150"
                         x-transition:enter-start="opacity-0"
                         x-transition:enter-end="opacity-100"
                         class="px-3.5 pb-3.5">
                        <div class="border-t border-border pt-2.5 flex flex-col gap-1">

                            @foreach($grade->categories as $category)
                                <div class="flex items-center justify-between {{ $loop->first ? 'mt-2' : 'mt-3' }} mb-1.5 pb-1.5 border-b border-white/4">
                                    <span class="text-[9px] font-extrabold text-dim uppercase tracking-[2px]">{{ $category->name_viet }} — {{ $category->name_ro }}</span>
                                    <span class="text-[10px] text-[#3a3a55]">{{ $category->techniques->count() }}</span>
                                </div>

                                <div class="flex flex-col gap-1.5">
                                    @foreach($category->techniques as $technique)
                                        @php
                                            $status    = $progressMap[$technique->id] ?? 'unknown';
                                            $isForm    = $technique->type === 'form';
                                            $hasDetail = $technique->description || $technique->coach_note || $technique->video_url;
                                        @endphp

                                        <div wire:key="tech-{{ $technique->id }}"
                                             x-data="{ open: false }"
                                             data-status="{{ $status }}"
                                             x-show="filter === 'all' || $el.dataset.status === filter"
                                             class="bg-card-2 rounded-lg overflow-hidden {{ $isForm ? 'border border-gold/10' : 'border border-border' }}">

                                            <div @click="{{ $hasDetail ? 'open = !open' : '' }}"
                                                 class="flex items-center gap-2 px-2.5 py-1.5 {{ $hasDetail ? 'cursor-pointer hover:bg-white/2' : '' }} transition-colors">

                                                @if($hasDetail)
                                                    <svg :style="open ? 'transform:rotate(90deg)' : ''"
                                                         style="transition:transform .15s"
                                                         class="text-dim shrink-0"
                                                         width="10" height="10" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                                                        <path d="M9 18l6-6-6-6"/>
                                                    </svg>
                                                @else
                                                    <span class="w-[10px] shrink-0"></span>
                                                @endif

                                                <div class="flex-1 min-w-0">
                                                    @if($isForm)
                                                        <div class="flex items-center gap-1.5 mb-0.5">
                                                            <span class="viet-name text-[10px]">{{ $technique->name_viet }}</span>
                                                            <span class="text-[9px] text-gold bg-gold/8 border border-gold/18 px-1 py-px rounded">FORMĂ</span>
                                                        </div>
                                                        <span class="text-xs text-dim">{{ $technique->name_ro }}</span>
                                                    @else
                                                        <span class="viet-name text-[10px]">{{ $technique->name_viet }}</span>
                                                        <span class="text-xs text-dim ml-1.5">{{ $technique->name_ro }}</span>
                                                    @endif
                                                </div>

                                                @if($technique->video_url)
                                                    <svg class="text-gold shrink-0" width="11" height="11" fill="currentColor" viewBox="0 0 24 24"><circle cx="12" cy="12" r="10" fill="none" stroke="currentColor" stroke-width="2"/><polygon points="10 8 16 12 10 16 10 8" fill="currentColor"/></svg>
                                                @endif

                                                <button wire:click.stop="cycleStatus({{ $technique->id }})"
                                                        wire:loading.attr="disabled"
                                                        class="shrink-0 border-none bg-transparent cursor-pointer p-0">
                                                    @if($status === 'mastered')
                                                        <span class="text-[10px] px-2 py-0.5 rounded-full bg-emerald-500/12 text-emerald-400 border border-emerald-500/25 block whitespace-nowrap">✓</span>
                                                    @elseif($status === 'progress')
                                                        <span class="text-[10px] px-2 py-0.5 rounded-full bg-amber-400/12 text-amber-400 border border-amber-400/25 block whitespace-nowrap">⚡</span>
                                                    @else
                                                        <span class="text-[10px] px-2 py-0.5 rounded-full bg-dim/12 text-dim border border-dim/20 block whitespace-nowrap">—</span>
                                                    @endif
                                                </button>
                                            </div>

                                            @if($hasDetail)
                                                <div x-show="open" x-transition class="border-t border-border px-3 py-2.5 flex flex-col gap-2">
                                                    @if($technique->description)
                                                        <p class="text-[13px] text-content leading-relaxed m-0">{{ $technique->description }}</p>
                                                    @endif
                                                    @if($technique->coach_note)
                                                        <div class="bg-gold/6 border border-gold/15 rounded-lg px-3 py-2">
                                                            <div class="text-[9px] font-bold text-gold uppercase tracking-[1.5px] mb-1">Notă antrenor</div>
                                                            <p class="text-[13px] text-content leading-relaxed m-0">{{ $technique->coach_note }}</p>
                                                        </div>
                                                    @endif
                                                    @if($technique->video_url)
                                                        @if($technique->isLocalVideo())
                                                            <video controls class="w-full rounded-lg" style="max-height:320px">
                                                                <source src="{{ asset($technique->video_url) }}" type="video/mp4">
                                                            </video>
                                                        @elseif($technique->youtubeEmbedUrl())
                                                            <div class="relative w-full rounded-lg overflow-hidden" style="padding-bottom:56.25%">
                                                                <iframe class="absolute inset-0 w-full h-full"
                                                                        src="{{ $technique->youtubeEmbedUrl() }}"
                                                                        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                                                                        allowfullscreen loading="lazy"></iframe>
                                                            </div>
                                                        @else
                                                            <a href="{{ $technique->video_url }}" target="_blank" rel="noopener"
                                                               class="inline-flex items-center gap-1.5 text-xs text-gold font-semibold no-underline hover:text-gold-light transition-colors">
                                                                <svg width="13" height="13" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><circle cx="12" cy="12" r="10"/><polygon points="10 8 16 12 10 16 10 8" fill="currentColor" stroke="none"/></svg>
                                                                Vizualizează video
                                                            </a>
                                                        @endif
                                                    @endif
                                                </div>
                                            @endif

                                        </div>
                                    @endforeach
                                </div>
                            @endforeach

                        </div>
                    </div>

                </div>
            @empty
                <div class="bg-card border border-border rounded-xl p-8 text-center">
                    <p class="text-dim text-sm">Niciun grad disponibil încă.</p>
                </div>
            @endforelse

        </div>
    </div>

    {{-- ══════════════════════════════════════════════════════════════════════ --}}
    {{-- STAGII TAB                                                            --}}
    {{-- ══════════════════════════════════════════════════════════════════════ --}}
    <div x-show="tab === 'stagii'" class="max-w-2xl mx-auto px-5 py-6 pb-24">

        {{-- Upcoming stages --}}
        <p class="text-[11px] uppercase tracking-[1.5px] text-dim font-semibold mb-3">Stagii viitoare</p>

        @if($upcomingStages->isEmpty())
            <div class="bg-card border border-border rounded-xl p-6 text-center mb-8">
                <p class="text-dim text-sm">Niciun stagiu programat momentan.</p>
            </div>
        @else
            <div class="flex flex-col gap-2 mb-8">
                @foreach($upcomingStages as $stage)
                    @php $myStatus = $myStageEnrollments[$stage->id] ?? null; @endphp
                    <div wire:key="us-{{ $stage->id }}"
                         class="bg-card border border-border rounded-xl px-4 py-4">
                        <div class="flex items-start justify-between gap-3">
                            <div class="flex-1 min-w-0">
                                <div class="font-semibold text-[15px] text-content">{{ $stage->title }}</div>
                                <div class="flex items-center gap-3 mt-1.5 flex-wrap">
                                    <span class="text-[12px] text-gold font-medium">
                                        <svg class="inline -mt-0.5 mr-0.5" width="12" height="12" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><rect x="3" y="4" width="18" height="18" rx="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/></svg>
                                        {{ $stage->date->format('d M Y') }}
                                    </span>
                                    @if($stage->location)
                                        <span class="text-[12px] text-dim">📍 {{ $stage->location }}</span>
                                    @endif
                                </div>
                                @if($stage->registration_deadline)
                                    <div class="text-[11px] text-dim mt-1">
                                        Înscrieri până la {{ $stage->registration_deadline->format('d M Y') }}
                                    </div>
                                @endif
                                @if($stage->description)
                                    <p class="text-[13px] text-dim mt-2 leading-relaxed">{{ $stage->description }}</p>
                                @endif
                            </div>

                            <div class="shrink-0 mt-0.5">
                                @if($myStatus === 'accepted')
                                    <span class="text-[12px] text-emerald-400 bg-emerald-500/10 border border-emerald-500/25 px-3 py-1.5 rounded-lg block text-center">✓ Acceptat</span>
                                @elseif($myStatus === 'pending')
                                    <span class="text-[12px] text-amber-400 bg-amber-400/10 border border-amber-400/25 px-3 py-1.5 rounded-lg block text-center">În așteptare</span>
                                @elseif($myStatus === 'rejected')
                                    <span class="text-[12px] text-red-400 bg-red-500/8 border border-red-500/20 px-3 py-1.5 rounded-lg block text-center">Respins</span>
                                @elseif($stage->registrationOpen())
                                    <button wire:click="registerStage({{ $stage->id }})"
                                            class="text-[12px] font-semibold text-[#08080e] bg-gold hover:bg-gold-light px-3 py-1.5 rounded-lg cursor-pointer border-none transition-colors block">
                                        Mă înscriu
                                    </button>
                                @else
                                    <span class="text-[12px] text-dim px-3 py-1.5 block">Înscrieri închise</span>
                                @endif
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif

        {{-- Stage history --}}
        <div class="flex items-center justify-between mb-3">
            <p class="text-[11px] uppercase tracking-[1.5px] text-dim font-semibold">Stagii la care am participat</p>
            <span class="text-[12px] text-gold font-semibold">{{ $stageHistory->count() }}</span>
        </div>

        @if($stageHistory->isEmpty())
            <div class="bg-card border border-border rounded-xl p-6 text-center">
                <p class="text-dim text-sm">Niciun stagiu în istoric.</p>
            </div>
        @else
            <div class="flex flex-col gap-2">
                @foreach($stageHistory as $enrollment)
                    <div class="bg-card border border-border rounded-xl px-4 py-3 flex items-center justify-between">
                        <div>
                            <div class="font-medium text-[14px] text-content">{{ $enrollment->stage->title }}</div>
                            <div class="text-[12px] text-dim mt-0.5">
                                {{ $enrollment->stage->date->format('d M Y') }}
                                @if($enrollment->stage->location) · {{ $enrollment->stage->location }} @endif
                            </div>
                        </div>
                        <span class="text-[11px] text-emerald-400 bg-emerald-500/10 border border-emerald-500/25 px-2.5 py-1 rounded-full shrink-0">✓</span>
                    </div>
                @endforeach
            </div>
        @endif

    </div>

    {{-- ══════════════════════════════════════════════════════════════════════ --}}
    {{-- EXAMENE TAB                                                           --}}
    {{-- ══════════════════════════════════════════════════════════════════════ --}}
    <div x-show="tab === 'examene'" class="max-w-2xl mx-auto px-5 py-6 pb-24">

        {{-- Upcoming exams --}}
        <p class="text-[11px] uppercase tracking-[1.5px] text-dim font-semibold mb-3">Examene viitoare</p>

        @if($upcomingExams->isEmpty())
            <div class="bg-card border border-border rounded-xl p-6 text-center mb-8">
                <p class="text-dim text-sm">Niciun examen programat momentan.</p>
            </div>
        @else
            <div class="flex flex-col gap-2 mb-8">
                @foreach($upcomingExams as $exam)
                    @php $myExamStatus = $myExamEnrollments[$exam->id] ?? null; @endphp
                    <div wire:key="ue-{{ $exam->id }}"
                         class="bg-card border border-border rounded-xl px-4 py-4">
                        <div class="flex items-start justify-between gap-3">
                            <div class="flex-1 min-w-0">
                                <div class="font-semibold text-[15px] text-content">{{ $exam->title }}</div>
                                <div class="flex items-center gap-3 mt-1.5 flex-wrap">
                                    <span class="text-[12px] text-gold font-medium">{{ $exam->date->format('d M Y') }}</span>
                                    @if($exam->location)
                                        <span class="text-[12px] text-dim">📍 {{ $exam->location }}</span>
                                    @endif
                                </div>
                                @if($exam->notes)
                                    <p class="text-[13px] text-dim mt-2 leading-relaxed">{{ $exam->notes }}</p>
                                @endif
                            </div>

                            <div class="shrink-0 mt-0.5">
                                @if($myExamStatus === 'accepted')
                                    <span class="text-[12px] text-emerald-400 bg-emerald-500/10 border border-emerald-500/25 px-3 py-1.5 rounded-lg block text-center">✓ Acceptat</span>
                                @elseif($myExamStatus === 'pending')
                                    <span class="text-[12px] text-amber-400 bg-amber-400/10 border border-amber-400/25 px-3 py-1.5 rounded-lg block text-center">În așteptare</span>
                                @elseif($myExamStatus === 'rejected')
                                    <span class="text-[12px] text-red-400 bg-red-500/8 border border-red-500/20 px-3 py-1.5 rounded-lg block text-center">Respins</span>
                                @else
                                    <button wire:click="registerExam({{ $exam->id }})"
                                            class="text-[12px] font-semibold text-[#08080e] bg-gold hover:bg-gold-light px-3 py-1.5 rounded-lg cursor-pointer border-none transition-colors block">
                                        Mă înscriu
                                    </button>
                                @endif
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif

        {{-- Exam history --}}
        <div class="flex items-center justify-between mb-3">
            <p class="text-[11px] uppercase tracking-[1.5px] text-dim font-semibold">Istoricul examenelor</p>
            <span class="text-[12px] text-gold font-semibold">{{ $examHistory->count() }}</span>
        </div>

        @if($examHistory->isEmpty())
            <div class="bg-card border border-border rounded-xl p-6 text-center">
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
