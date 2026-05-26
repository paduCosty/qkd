<div x-data="{ mode: 'view' }">

    {{-- Topbar --}}
    <div class="bg-card border-b border-border px-5 py-3.5 flex items-center gap-3.5 sticky top-0 z-50">
        <a href="{{ route('admin.curriculum') }}"
           class="text-dim hover:text-content transition-colors p-1 flex items-center">
            <svg width="22" height="22" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M19 12H5M12 19l-7-7 7-7"/></svg>
        </a>
        <div class="flex-1">
            <h2 class="font-bold text-[17px] leading-tight">{{ $grade->name }}</h2>
            <p class="text-xs text-dim mt-0.5">{{ $categories->count() }} categorii · {{ $categories->sum(fn($c) => $c->techniques->count()) }} tehnici</p>
        </div>

        {{-- Mode toggle --}}
        <div class="flex bg-surface border border-border rounded-xl p-1 gap-1">
            <button @click="mode = 'view'"
                    :class="mode === 'view' ? 'bg-card-2 text-content' : 'text-dim hover:text-content'"
                    class="flex items-center gap-1.5 px-3.5 py-1.5 rounded-lg text-[12px] font-semibold border-none cursor-pointer transition-colors">
                <svg width="13" height="13" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/><circle cx="12" cy="12" r="3"/></svg>
                Vizualizare
            </button>
            <button @click="mode = 'edit'"
                    :class="mode === 'edit' ? 'bg-gold/12 text-gold' : 'text-dim hover:text-content'"
                    class="flex items-center gap-1.5 px-3.5 py-1.5 rounded-lg text-[12px] font-semibold border-none cursor-pointer transition-colors">
                <svg width="13" height="13" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M11 4H4a2 2 0 00-2 2v14a2 2 0 002 2h14a2 2 0 002-2v-7"/><path d="M18.5 2.5a2.121 2.121 0 013 3L12 15l-4 1 1-4 9.5-9.5z"/></svg>
                Editează
            </button>
        </div>
    </div>

    {{-- Edit strip --}}
    <div x-show="mode === 'edit'" x-transition
         class="flex items-center gap-2 px-5 py-2 bg-gold/5 border-b border-gold/18 text-[12px] text-gold/70">
        <svg width="13" height="13" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/></svg>
        Modificările sunt permanente — revino la <strong class="text-gold mx-1">Vizualizare</strong> când ai terminat.
    </div>

    <div class="max-w-2xl mx-auto px-5 py-5 pb-16">

        @foreach($categories as $category)
            <div wire:key="cat-{{ $category->id }}"
                 x-data="{ open: true }"
                 class="bg-card border border-border rounded-xl mb-3 overflow-hidden">

                {{-- Category header --}}
                @if($editCatId === $category->id)
                    <div class="px-4 py-3.5 flex gap-2 items-center flex-wrap border-b border-border">
                        <input wire:model="editCatNameViet" type="text" placeholder="Denumire vietnameză"
                               class="flex-1 min-w-36 bg-surface border border-gold rounded-lg px-3 py-2 text-gold text-[13px] font-bold uppercase tracking-wide">
                        <input wire:model="editCatNameRo" type="text" placeholder="Traducere română"
                               class="flex-1 min-w-36 bg-surface border border-border rounded-lg px-3 py-2 text-content text-[13px]">
                        <button wire:click="saveCategory"
                                class="px-3.5 py-2 bg-gold hover:bg-gold-light text-[#08080e] font-bold text-sm rounded-lg cursor-pointer border-none transition-colors">
                            OK
                        </button>
                        <button wire:click="$set('editCatId', null)"
                                class="px-3 py-2 bg-transparent border border-border text-dim text-sm rounded-lg cursor-pointer hover:text-content transition-colors">
                            ✕
                        </button>
                    </div>
                @else
                    <div @click="open = !open"
                         class="px-4 py-3.5 flex items-center justify-between cursor-pointer select-none">
                        <div class="flex items-center gap-2">
                            <svg x-show="!open" class="text-dim shrink-0" width="14" height="14" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M9 18l6-6-6-6"/></svg>
                            <svg x-show="open" class="text-dim shrink-0" width="14" height="14" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M6 9l6 6 6-6"/></svg>
                            <span class="text-[9px] font-extrabold text-gold uppercase tracking-[2px]">{{ $category->name_viet }}</span>
                            <span class="text-xs text-dim">— {{ $category->name_ro }}</span>
                            <span class="text-[10px] text-[#3a3a55]">{{ $category->techniques->count() }}</span>
                        </div>
                        <div class="flex gap-1.5" @click.stop x-show="mode === 'edit'">
                            <button wire:click="startEditCategory({{ $category->id }})"
                                    class="text-[11px] text-dim border border-border px-2 py-1 rounded-md bg-transparent cursor-pointer hover:text-content transition-colors">✎</button>
                            <button wire:click="deleteCategory({{ $category->id }})"
                                    wire:confirm="Ștergi categoria '{{ $category->name_viet }}' și toate tehnicile din ea?"
                                    class="text-[11px] text-red-400 bg-red-500/8 border border-red-500/20 px-2 py-1 rounded-md cursor-pointer hover:bg-red-500/15 transition-colors">✕</button>
                        </div>
                    </div>
                @endif

                {{-- Techniques --}}
                <div x-show="open" class="px-3.5 pb-3.5 flex flex-col gap-1.5">

                    @foreach($category->techniques as $technique)
                        <div wire:key="tech-{{ $technique->id }}">

                            @if($editTechId === $technique->id)
                                <div class="bg-surface border border-gold/30 rounded-xl p-3.5 mb-1">
                                    <div class="grid grid-cols-2 gap-2 mb-2.5">
                                        <input wire:model="editTechNameViet" type="text"
                                               class="bg-card border border-border rounded-lg px-3 py-2 text-gold text-[13px] font-bold uppercase tracking-wide w-full">
                                        <input wire:model="editTechNameRo" type="text"
                                               class="bg-card border border-border rounded-lg px-3 py-2 text-content text-[13px] w-full">
                                    </div>
                                    <div class="flex gap-2 mb-2.5 flex-wrap">
                                        <label class="flex items-center gap-1.5 cursor-pointer text-[13px] px-3 py-1.5 rounded-lg border transition-colors {{ $editTechType === 'simple' ? 'border-gold/40 bg-gold/8 text-gold' : 'border-border text-dim' }}">
                                            <input wire:model="editTechType" type="radio" value="simple"> Simplă
                                        </label>
                                        <label class="flex items-center gap-1.5 cursor-pointer text-[13px] px-3 py-1.5 rounded-lg border transition-colors {{ $editTechType === 'form' ? 'border-gold/40 bg-gold/8 text-gold' : 'border-border text-dim' }}">
                                            <input wire:model="editTechType" type="radio" value="form"> Formă
                                        </label>
                                    </div>
                                    {{-- Video --}}
                                    <div class="mb-2">
                                        <div class="flex bg-surface border border-border rounded-lg p-0.5 gap-0.5 mb-1.5 w-fit">
                                            <button type="button" wire:click="$set('editVideoTab','url')"
                                                    class="px-3 py-1.5 text-[12px] font-semibold rounded-md border-none cursor-pointer transition-colors {{ $editVideoTab === 'url' ? 'bg-card-2 text-content' : 'bg-transparent text-dim hover:text-content' }}">
                                                YouTube URL
                                            </button>
                                            <button type="button" wire:click="$set('editVideoTab','upload')"
                                                    class="px-3 py-1.5 text-[12px] font-semibold rounded-md border-none cursor-pointer transition-colors {{ $editVideoTab === 'upload' ? 'bg-card-2 text-content' : 'bg-transparent text-dim hover:text-content' }}">
                                                Fișier video
                                            </button>
                                        </div>
                                        @if($editVideoTab === 'url')
                                            <input wire:model="editTechVideo" type="url" placeholder="https://youtube.com/watch?v=..."
                                                   class="w-full bg-card border border-border rounded-lg px-3 py-2 text-content text-[13px]">
                                        @else
                                            <input wire:model="editTechFile" type="file" accept="video/mp4,video/webm,video/quicktime"
                                                   class="w-full text-[13px] text-dim file:mr-3 file:py-1.5 file:px-3 file:rounded-lg file:border-none file:text-[12px] file:font-semibold file:bg-gold/12 file:text-gold file:cursor-pointer hover:file:bg-gold/20 cursor-pointer">
                                            @if($editTechVideo && !$editTechFile)
                                                <p class="text-[11px] text-amber-400/80 mt-1">Video curent: {{ basename($editTechVideo) }}</p>
                                            @endif
                                            <p class="text-[11px] text-dim mt-0.5">MP4, WebM sau MOV · max 200 MB</p>
                                        @endif
                                    </div>
                                    <textarea wire:model="editTechDesc" rows="2" placeholder="Descriere (opțional)"
                                              class="w-full bg-card border border-border rounded-lg px-3 py-2 text-content text-[13px] resize-y leading-relaxed mb-2"></textarea>
                                    <textarea wire:model="editTechNote" rows="2" placeholder="Notă antrenor (opțional)"
                                              class="w-full bg-card border border-border rounded-lg px-3 py-2 text-content text-[13px] resize-y leading-relaxed mb-3"></textarea>
                                    <div class="flex gap-2">
                                        <button wire:click="saveTechnique"
                                                class="px-4 py-2 bg-gold hover:bg-gold-light text-[#08080e] font-bold text-[13px] rounded-lg cursor-pointer border-none transition-colors">
                                            Salvează
                                        </button>
                                        <button wire:click="$set('editTechId', null)"
                                                class="px-3 py-2 bg-transparent border border-border text-dim text-[13px] rounded-lg cursor-pointer hover:text-content transition-colors">
                                            Anulează
                                        </button>
                                    </div>
                                </div>
                            @else
                                <div x-data="{ expanded: false }"
                                     class="bg-card-2 rounded-lg overflow-hidden {{ $technique->type === 'form' ? 'border border-gold/12' : 'border border-border' }}">

                                    <div class="flex items-center gap-2 px-2.5 py-2">
                                        <button x-show="mode === 'view'"
                                                @click="{{ ($technique->description || $technique->coach_note || $technique->video_url) ? 'expanded = !expanded' : '' }}"
                                                class="shrink-0 border-none bg-transparent p-0.5 {{ ($technique->description || $technique->coach_note || $technique->video_url) ? 'cursor-pointer text-dim' : 'cursor-default text-[#2a2a40]' }}">
                                            <svg :style="expanded ? 'transform:rotate(90deg)' : ''"
                                                 style="transition:transform .15s"
                                                 width="11" height="11" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                                                <path d="M9 18l6-6-6-6"/>
                                            </svg>
                                        </button>

                                        <div class="flex-1 min-w-0">
                                            @if($technique->type === 'form')
                                                <div class="flex items-center gap-1.5 mb-0.5">
                                                    <span class="viet-name text-[10px]">{{ $technique->name_viet }}</span>
                                                    <span class="text-[9px] text-gold bg-gold/8 border border-gold/18 px-1.5 py-px rounded">FORMĂ</span>
                                                </div>
                                                <span class="text-xs text-dim">{{ $technique->name_ro }}</span>
                                            @else
                                                <span class="viet-name text-[10px]">{{ $technique->name_viet }}</span>
                                                <span class="text-xs text-dim ml-1.5">{{ $technique->name_ro }}</span>
                                            @endif
                                        </div>

                                        @if($technique->video_url)
                                            <span class="text-gold text-[11px] shrink-0" title="Are video">▶</span>
                                        @endif

                                        <div x-show="mode === 'edit'" class="flex gap-1 shrink-0">
                                            <button wire:click="startEditTechnique({{ $technique->id }})"
                                                    class="text-[11px] text-dim border border-border px-2 py-1 rounded-md bg-transparent cursor-pointer hover:text-content transition-colors">✎</button>
                                            <button wire:click="deleteTechnique({{ $technique->id }})"
                                                    wire:confirm="Ștergi tehnica '{{ $technique->name_viet }}'?"
                                                    class="text-[11px] text-red-400 bg-red-500/8 border border-red-500/15 px-2 py-1 rounded-md cursor-pointer hover:bg-red-500/15 transition-colors">✕</button>
                                        </div>
                                    </div>

                                    @if($technique->description || $technique->coach_note || $technique->video_url)
                                        <div x-show="expanded && mode === 'view'" x-transition
                                             class="border-t border-border px-3.5 py-2.5 flex flex-col gap-2">
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
                            @endif

                        </div>
                    @endforeach

                    {{-- Add technique (edit mode) --}}
                    <div x-show="mode === 'edit'">
                        @if($addTechCatId === $category->id)
                            <div class="bg-surface border border-gold/25 rounded-xl p-3.5 mt-1">
                                <div class="grid grid-cols-2 gap-2 mb-2.5">
                                    <input wire:model="techNameViet" type="text" placeholder="Denumire vietnameză"
                                           class="bg-card border border-border rounded-lg px-3 py-2 text-gold text-[13px] font-bold uppercase tracking-wide w-full">
                                    <input wire:model="techNameRo" type="text" placeholder="Traducere română"
                                           class="bg-card border border-border rounded-lg px-3 py-2 text-content text-[13px] w-full">
                                </div>
                                <div class="flex gap-2 mb-2.5 flex-wrap">
                                    <label class="flex items-center gap-1.5 cursor-pointer text-[13px] px-3 py-1.5 rounded-lg border transition-colors {{ $techType === 'simple' ? 'border-gold/40 bg-gold/8 text-gold' : 'border-border text-dim' }}">
                                        <input wire:model="techType" type="radio" value="simple"> Simplă
                                    </label>
                                    <label class="flex items-center gap-1.5 cursor-pointer text-[13px] px-3 py-1.5 rounded-lg border transition-colors {{ $techType === 'form' ? 'border-gold/40 bg-gold/8 text-gold' : 'border-border text-dim' }}">
                                        <input wire:model="techType" type="radio" value="form"> Formă
                                    </label>
                                </div>
                                {{-- Video --}}
                                <div class="mb-2">
                                    <div class="flex bg-surface border border-border rounded-lg p-0.5 gap-0.5 mb-1.5 w-fit">
                                        <button type="button" wire:click="$set('addVideoTab','url')"
                                                class="px-3 py-1.5 text-[12px] font-semibold rounded-md border-none cursor-pointer transition-colors {{ $addVideoTab === 'url' ? 'bg-card-2 text-content' : 'bg-transparent text-dim hover:text-content' }}">
                                            YouTube URL
                                        </button>
                                        <button type="button" wire:click="$set('addVideoTab','upload')"
                                                class="px-3 py-1.5 text-[12px] font-semibold rounded-md border-none cursor-pointer transition-colors {{ $addVideoTab === 'upload' ? 'bg-card-2 text-content' : 'bg-transparent text-dim hover:text-content' }}">
                                            Fișier video
                                        </button>
                                    </div>
                                    @if($addVideoTab === 'url')
                                        <input wire:model="techVideoUrl" type="url" placeholder="https://youtube.com/watch?v=..."
                                               class="w-full bg-card border border-border rounded-lg px-3 py-2 text-content text-[13px]">
                                    @else
                                        <input wire:model="techVideoFile" type="file" accept="video/mp4,video/webm,video/quicktime"
                                               class="w-full text-[13px] text-dim file:mr-3 file:py-1.5 file:px-3 file:rounded-lg file:border-none file:text-[12px] file:font-semibold file:bg-gold/12 file:text-gold file:cursor-pointer hover:file:bg-gold/20 cursor-pointer">
                                        <p class="text-[11px] text-dim mt-0.5">MP4, WebM sau MOV · max 200 MB</p>
                                    @endif
                                </div>
                                <textarea wire:model="techDescription" rows="2" placeholder="Descriere (opțional)"
                                          class="w-full bg-card border border-border rounded-lg px-3 py-2 text-content text-[13px] resize-y leading-relaxed mb-2"></textarea>
                                <textarea wire:model="techCoachNote" rows="2" placeholder="Notă antrenor (opțional)"
                                          class="w-full bg-card border border-border rounded-lg px-3 py-2 text-content text-[13px] resize-y leading-relaxed mb-3"></textarea>
                                <div class="flex gap-2">
                                    <button wire:click="addTechnique"
                                            class="px-4 py-2 bg-gold hover:bg-gold-light text-[#08080e] font-bold text-[13px] rounded-lg cursor-pointer border-none transition-colors">
                                        Adaugă
                                    </button>
                                    <button wire:click="$set('addTechCatId', null)"
                                            class="px-3 py-2 bg-transparent border border-border text-dim text-[13px] rounded-lg cursor-pointer hover:text-content transition-colors">
                                        Anulează
                                    </button>
                                </div>
                            </div>
                        @else
                            <button wire:click="openAddTechnique({{ $category->id }})"
                                    class="w-full bg-transparent border border-dashed border-border text-gold text-xs font-semibold py-2 rounded-lg mt-1 cursor-pointer hover:bg-gold/5 transition-colors">
                                + Adaugă tehnică
                            </button>
                        @endif
                    </div>

                </div>
            </div>
        @endforeach

        {{-- Add category (edit mode) --}}
        <div x-show="mode === 'edit'">
            @if($showAddCategory)
                <div class="bg-card border border-gold/30 rounded-xl p-5">
                    <p class="text-[13px] font-bold text-gold mb-3.5">Categorie nouă</p>
                    <div class="grid grid-cols-2 gap-2.5 mb-3">
                        <input wire:model="newCatNameViet" type="text" placeholder="ex: BO PHAP"
                               class="bg-surface border border-border rounded-xl px-3.5 py-2.5 text-gold text-[14px] font-bold uppercase tracking-wide w-full">
                        <input wire:model="newCatNameRo" type="text" placeholder="ex: Poziții"
                               class="bg-surface border border-border rounded-xl px-3.5 py-2.5 text-content text-[14px] w-full">
                    </div>
                    <div class="flex gap-2.5">
                        <button wire:click="addCategory"
                                class="px-5 py-2.5 bg-gold hover:bg-gold-light text-[#08080e] font-bold text-[14px] rounded-xl cursor-pointer border-none transition-colors">
                            Adaugă
                        </button>
                        <button wire:click="$set('showAddCategory', false)"
                                class="px-4 py-2.5 bg-transparent border border-border text-dim text-[14px] rounded-xl cursor-pointer hover:text-content transition-colors">
                            Anulează
                        </button>
                    </div>
                    @error('newCatNameViet') <p class="text-red-400 text-xs mt-2">{{ $message }}</p> @enderror
                </div>
            @else
                <button wire:click="$set('showAddCategory', true)"
                        class="w-full bg-transparent border-2 border-dashed border-border text-dim hover:border-gold hover:text-gold py-3.5 rounded-xl text-sm cursor-pointer transition-colors">
                    + Adaugă categorie
                </button>
            @endif
        </div>

    </div>
</div>
