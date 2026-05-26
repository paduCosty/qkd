<div x-data="{ mode: 'view' }">

    
    <div class="bg-card border-b border-border px-5 py-3.5 flex items-center justify-between sticky top-0 z-50">
        <div>
            <h2 class="font-[family-name:var(--font-display)] text-[15px] font-bold text-gold tracking-[2px] leading-tight">CURRICULĂ</h2>
            <p class="text-xs text-dim mt-0.5">
                <?php echo e($grades->count()); ?> grade · <?php echo e($grades->sum(fn($g) => $g->categories->sum(fn($c) => $c->techniques->count()))); ?> tehnici
            </p>
        </div>

        
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

    
    <div x-show="mode === 'edit'" x-transition
         class="flex items-center gap-2 px-5 py-2 bg-gold/5 border-b border-gold/18 text-[12px] text-gold/70">
        <svg width="13" height="13" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/></svg>
        Modificările sunt permanente — revino la <strong class="text-gold mx-1">Vizualizare</strong> când ai terminat.
    </div>

    <div class="max-w-3xl mx-auto px-5 py-5 pb-16">

        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $grades; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $grade): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
            <div <?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::$currentLoop['key'] = 'grade-'.e($grade->id).''; ?>wire:key="grade-<?php echo e($grade->id); ?>"
                 x-data="{ open: true }"
                 class="bg-card border border-border rounded-2xl mb-3.5 overflow-hidden">

                
                <div @click="open = !open"
                     class="px-4 py-4 flex items-center justify-between cursor-pointer select-none">
                    <div class="flex items-center gap-3">
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($grade->order === 0): ?>
                            <div class="belt"><span class="text-[11px] text-[#555] font-semibold">0</span></div>
                        <?php else: ?>
                            <div class="belt">
                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php for($i = 0; $i < $grade->order; $i++): ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?><div class="cap"></div><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endfor; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                            </div>
                        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                        <div>
                            <div class="font-bold text-[15px]"><?php echo e($grade->name); ?></div>
                            <div class="text-xs text-dim mt-0.5">
                                <?php echo e($grade->categories->count()); ?> categorii · <?php echo e($grade->categories->sum(fn($c) => $c->techniques->count())); ?> tehnici
                            </div>
                        </div>
                    </div>
                    <svg :style="open ? 'transform:rotate(180deg)' : ''"
                         style="transition:transform .2s"
                         class="text-dim shrink-0"
                         width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path d="M6 9l6 6 6-6"/>
                    </svg>
                </div>

                
                <div x-show="open" class="border-t border-border px-3.5 py-3.5 flex flex-col gap-3">

                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $grade->categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
                        <div <?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::$currentLoop['key'] = 'cat-'.e($category->id).''; ?>wire:key="cat-<?php echo e($category->id); ?>" x-data="{ catOpen: true }">

                            
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($editCatId === $category->id): ?>
                                <div class="flex gap-2 items-center flex-wrap mb-2">
                                    <input wire:model="editCatNameViet" type="text"
                                           class="flex-1 min-w-28 bg-surface border border-gold rounded-lg px-2.5 py-1.5 text-gold text-xs font-bold uppercase tracking-wide">
                                    <input wire:model="editCatNameRo" type="text"
                                           class="flex-1 min-w-36 bg-surface border border-border rounded-lg px-2.5 py-1.5 text-content text-xs">
                                    <button wire:click="saveCategory"
                                            class="px-3 py-1.5 bg-gold hover:bg-gold-light text-[#08080e] font-bold text-xs rounded-lg cursor-pointer border-none transition-colors">
                                        OK
                                    </button>
                                    <button wire:click="$set('editCatId', null)"
                                            class="px-2.5 py-1.5 bg-transparent border border-border text-dim text-xs rounded-lg cursor-pointer hover:text-content transition-colors">
                                        ✕
                                    </button>
                                </div>
                            <?php else: ?>
                                <div class="flex items-center justify-between mb-2">
                                    <div @click="catOpen = !catOpen"
                                         class="flex items-center gap-2 cursor-pointer select-none flex-1">
                                        <svg :style="catOpen ? 'transform:rotate(90deg)' : ''"
                                             style="transition:transform .15s"
                                             class="text-dim shrink-0"
                                             width="11" height="11" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                                            <path d="M9 18l6-6-6-6"/>
                                        </svg>
                                        <span class="text-[9px] font-extrabold text-gold uppercase tracking-[2px]"><?php echo e($category->name_viet); ?></span>
                                        <span class="text-xs text-dim">— <?php echo e($category->name_ro); ?></span>
                                        <span class="text-[11px] text-[#3a3a55]"><?php echo e($category->techniques->count()); ?></span>
                                    </div>
                                    <div x-show="mode === 'edit'" class="flex gap-1.5 shrink-0 ml-2">
                                        <button wire:click="startEditCategory(<?php echo e($category->id); ?>)"
                                                class="text-[11px] text-dim border border-border px-2 py-1 rounded-md bg-transparent cursor-pointer hover:text-content transition-colors">✎</button>
                                        <button wire:click="deleteCategory(<?php echo e($category->id); ?>)"
                                                wire:confirm="Ștergi categoria '<?php echo e($category->name_viet); ?>' și toate tehnicile din ea?"
                                                class="text-[11px] text-red-400 bg-red-500/8 border border-red-500/20 px-2 py-1 rounded-md cursor-pointer hover:bg-red-500/15 transition-colors">✕</button>
                                    </div>
                                </div>
                            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

                            
                            <div x-show="catOpen" class="flex flex-col gap-1 pl-4">

                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $category->techniques; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $technique): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
                                    <div <?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::$currentLoop['key'] = 'tech-'.e($technique->id).''; ?>wire:key="tech-<?php echo e($technique->id); ?>">

                                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($editTechId === $technique->id): ?>
                                            <div class="bg-surface border border-gold/30 rounded-xl p-3 mb-1">
                                                <div class="grid grid-cols-2 gap-2 mb-2">
                                                    <input wire:model="editTechNameViet" type="text" placeholder="Denumire vietnameză"
                                                           class="bg-card border border-border rounded-lg px-2.5 py-1.5 text-gold text-xs font-bold uppercase tracking-wide w-full">
                                                    <input wire:model="editTechNameRo" type="text" placeholder="Traducere română"
                                                           class="bg-card border border-border rounded-lg px-2.5 py-1.5 text-content text-xs w-full">
                                                </div>
                                                <div class="flex gap-2 mb-2 flex-wrap">
                                                    <label class="flex items-center gap-1.5 cursor-pointer text-xs px-2.5 py-1.5 rounded-lg border transition-colors <?php echo e($editTechType === 'simple' ? 'border-gold/40 bg-gold/8 text-gold' : 'border-border text-dim'); ?>">
                                                        <input wire:model="editTechType" type="radio" value="simple" class="sr-only"> Simplă
                                                    </label>
                                                    <label class="flex items-center gap-1.5 cursor-pointer text-xs px-2.5 py-1.5 rounded-lg border transition-colors <?php echo e($editTechType === 'form' ? 'border-gold/40 bg-gold/8 text-gold' : 'border-border text-dim'); ?>">
                                                        <input wire:model="editTechType" type="radio" value="form" class="sr-only"> Formă
                                                    </label>
                                                </div>
                                                
                                                <div class="mb-2">
                                                    <div class="flex bg-surface border border-border rounded-lg p-0.5 gap-0.5 mb-1.5 w-fit">
                                                        <button type="button" wire:click="$set('editVideoTab','url')"
                                                                class="px-3 py-1 text-[11px] font-semibold rounded-md border-none cursor-pointer transition-colors <?php echo e($editVideoTab === 'url' ? 'bg-card-2 text-content' : 'bg-transparent text-dim hover:text-content'); ?>">
                                                            YouTube URL
                                                        </button>
                                                        <button type="button" wire:click="$set('editVideoTab','upload')"
                                                                class="px-3 py-1 text-[11px] font-semibold rounded-md border-none cursor-pointer transition-colors <?php echo e($editVideoTab === 'upload' ? 'bg-card-2 text-content' : 'bg-transparent text-dim hover:text-content'); ?>">
                                                            Fișier video
                                                        </button>
                                                    </div>
                                                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($editVideoTab === 'url'): ?>
                                                        <input wire:model="editTechVideo" type="url" placeholder="https://youtube.com/watch?v=..."
                                                               class="w-full bg-card border border-border rounded-lg px-2.5 py-1.5 text-content text-xs">
                                                    <?php else: ?>
                                                        <input wire:model="editTechFile" type="file" accept="video/mp4,video/webm,video/quicktime"
                                                               class="w-full text-xs text-dim file:mr-3 file:py-1 file:px-2.5 file:rounded-lg file:border-none file:text-xs file:font-semibold file:bg-gold/12 file:text-gold file:cursor-pointer hover:file:bg-gold/20 cursor-pointer">
                                                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($editTechVideo && !$editTechFile): ?>
                                                            <p class="text-[10px] text-amber-400/80 mt-1">Video curent: <?php echo e(basename($editTechVideo)); ?></p>
                                                        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                                        <p class="text-[10px] text-dim mt-0.5">MP4, WebM sau MOV · max 200 MB</p>
                                                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                                </div>
                                                <textarea wire:model="editTechDesc" rows="2" placeholder="Descriere (opțional)"
                                                          class="w-full bg-card border border-border rounded-lg px-2.5 py-1.5 text-content text-xs resize-y leading-relaxed mb-2"></textarea>
                                                <textarea wire:model="editTechNote" rows="2" placeholder="Notă antrenor (opțional)"
                                                          class="w-full bg-card border border-border rounded-lg px-2.5 py-1.5 text-content text-xs resize-y leading-relaxed mb-3"></textarea>
                                                <div class="flex gap-2">
                                                    <button wire:click="saveTechnique"
                                                            class="px-3.5 py-1.5 bg-gold hover:bg-gold-light text-[#08080e] font-bold text-xs rounded-lg cursor-pointer border-none transition-colors">
                                                        Salvează
                                                    </button>
                                                    <button wire:click="$set('editTechId', null)"
                                                            class="px-2.5 py-1.5 bg-transparent border border-border text-dim text-xs rounded-lg cursor-pointer hover:text-content transition-colors">
                                                        Anulează
                                                    </button>
                                                </div>
                                            </div>
                                        <?php else: ?>
                                            <div x-data="{ expanded: false }"
                                                 class="bg-card-2 rounded-lg overflow-hidden <?php echo e($technique->type === 'form' ? 'border border-gold/12' : 'border border-border'); ?>">

                                                <div class="flex items-center gap-2 px-2.5 py-2">
                                                    
                                                    <button x-show="mode === 'view'"
                                                            @click="<?php echo e(($technique->description || $technique->coach_note || $technique->video_url) ? 'expanded = !expanded' : ''); ?>"
                                                            class="shrink-0 border-none bg-transparent p-0.5 <?php echo e(($technique->description || $technique->coach_note || $technique->video_url) ? 'cursor-pointer text-dim' : 'cursor-default text-[#2a2a40]'); ?>">
                                                        <svg :style="expanded ? 'transform:rotate(90deg)' : ''"
                                                             style="transition:transform .15s"
                                                             width="11" height="11" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                                                            <path d="M9 18l6-6-6-6"/>
                                                        </svg>
                                                    </button>

                                                    <div class="flex-1 min-w-0">
                                                        <div class="flex items-center gap-1.5 flex-wrap">
                                                            <span class="viet-name text-[11px]"><?php echo e($technique->name_viet); ?></span>
                                                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($technique->type === 'form'): ?>
                                                                <span class="text-[9px] text-gold bg-gold/8 border border-gold/18 px-1.5 py-px rounded">FORMĂ</span>
                                                            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                                        </div>
                                                        <div class="text-xs text-dim mt-0.5"><?php echo e($technique->name_ro); ?></div>
                                                    </div>

                                                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($technique->video_url): ?>
                                                        <span class="text-gold text-xs shrink-0" title="Are video">▶</span>
                                                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

                                                    <div x-show="mode === 'edit'" class="flex gap-1 shrink-0">
                                                        <button wire:click="startEditTechnique(<?php echo e($technique->id); ?>)"
                                                                class="text-[11px] text-dim border border-border px-2 py-1 rounded-md bg-transparent cursor-pointer hover:text-content transition-colors">✎</button>
                                                        <button wire:click="deleteTechnique(<?php echo e($technique->id); ?>)"
                                                                wire:confirm="Ștergi tehnica '<?php echo e($technique->name_viet); ?>'?"
                                                                class="text-[11px] text-red-400 bg-red-500/8 border border-red-500/15 px-2 py-1 rounded-md cursor-pointer hover:bg-red-500/15 transition-colors">✕</button>
                                                    </div>
                                                </div>

                                                
                                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($technique->description || $technique->coach_note || $technique->video_url): ?>
                                                    <div x-show="expanded && mode === 'view'" x-transition
                                                         class="border-t border-border px-3.5 py-2.5 flex flex-col gap-2">
                                                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($technique->description): ?>
                                                            <p class="text-[13px] text-content leading-relaxed m-0"><?php echo e($technique->description); ?></p>
                                                        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($technique->coach_note): ?>
                                                            <div class="bg-gold/6 border border-gold/15 rounded-lg px-3 py-2">
                                                                <div class="text-[9px] font-bold text-gold uppercase tracking-[1.5px] mb-1">Notă antrenor</div>
                                                                <p class="text-[13px] text-content leading-relaxed m-0"><?php echo e($technique->coach_note); ?></p>
                                                            </div>
                                                        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($technique->video_url): ?>
                                                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($technique->isLocalVideo()): ?>
                                                                <video controls class="w-full rounded-lg" style="max-height:320px">
                                                                    <source src="<?php echo e(asset($technique->video_url)); ?>" type="video/mp4">
                                                                </video>
                                                            <?php elseif($technique->youtubeEmbedUrl()): ?>
                                                                <div class="relative w-full rounded-lg overflow-hidden" style="padding-bottom:56.25%">
                                                                    <iframe class="absolute inset-0 w-full h-full"
                                                                            src="<?php echo e($technique->youtubeEmbedUrl()); ?>"
                                                                            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                                                                            allowfullscreen loading="lazy"></iframe>
                                                                </div>
                                                            <?php else: ?>
                                                                <a href="<?php echo e($technique->video_url); ?>" target="_blank" rel="noopener"
                                                                   class="inline-flex items-center gap-1.5 text-xs text-gold font-semibold no-underline hover:text-gold-light transition-colors">
                                                                    <svg width="13" height="13" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><circle cx="12" cy="12" r="10"/><polygon points="10 8 16 12 10 16 10 8" fill="currentColor" stroke="none"/></svg>
                                                                    Vizualizează video
                                                                </a>
                                                            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                                        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                                    </div>
                                                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

                                            </div>
                                        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                    </div>
                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>

                                
                                <div x-show="mode === 'edit'">
                                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($addTechCatId === $category->id): ?>
                                        <div class="bg-surface border border-gold/25 rounded-xl p-3 mt-1">
                                            <div class="grid grid-cols-2 gap-2 mb-2">
                                                <input wire:model="techNameViet" type="text" placeholder="Denumire vietnameză"
                                                       class="bg-card border border-border rounded-lg px-2.5 py-1.5 text-gold text-xs font-bold uppercase tracking-wide w-full">
                                                <input wire:model="techNameRo" type="text" placeholder="Traducere română"
                                                       class="bg-card border border-border rounded-lg px-2.5 py-1.5 text-content text-xs w-full">
                                            </div>
                                            <div class="flex gap-2 mb-2 flex-wrap">
                                                <label class="flex items-center gap-1.5 cursor-pointer text-xs px-2.5 py-1.5 rounded-lg border transition-colors <?php echo e($techType === 'simple' ? 'border-gold/40 bg-gold/8 text-gold' : 'border-border text-dim'); ?>">
                                                    <input wire:model="techType" type="radio" value="simple" class="sr-only"> Simplă
                                                </label>
                                                <label class="flex items-center gap-1.5 cursor-pointer text-xs px-2.5 py-1.5 rounded-lg border transition-colors <?php echo e($techType === 'form' ? 'border-gold/40 bg-gold/8 text-gold' : 'border-border text-dim'); ?>">
                                                    <input wire:model="techType" type="radio" value="form" class="sr-only"> Formă
                                                </label>
                                            </div>
                                            
                                            <div class="mb-2">
                                                <div class="flex bg-surface border border-border rounded-lg p-0.5 gap-0.5 mb-1.5 w-fit">
                                                    <button type="button" wire:click="$set('addVideoTab','url')"
                                                            class="px-3 py-1 text-[11px] font-semibold rounded-md border-none cursor-pointer transition-colors <?php echo e($addVideoTab === 'url' ? 'bg-card-2 text-content' : 'bg-transparent text-dim hover:text-content'); ?>">
                                                        YouTube URL
                                                    </button>
                                                    <button type="button" wire:click="$set('addVideoTab','upload')"
                                                            class="px-3 py-1 text-[11px] font-semibold rounded-md border-none cursor-pointer transition-colors <?php echo e($addVideoTab === 'upload' ? 'bg-card-2 text-content' : 'bg-transparent text-dim hover:text-content'); ?>">
                                                        Fișier video
                                                    </button>
                                                </div>
                                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($addVideoTab === 'url'): ?>
                                                    <input wire:model="techVideoUrl" type="url" placeholder="https://youtube.com/watch?v=..."
                                                           class="w-full bg-card border border-border rounded-lg px-2.5 py-1.5 text-content text-xs">
                                                <?php else: ?>
                                                    <input wire:model="techVideoFile" type="file" accept="video/mp4,video/webm,video/quicktime"
                                                           class="w-full text-xs text-dim file:mr-3 file:py-1 file:px-2.5 file:rounded-lg file:border-none file:text-xs file:font-semibold file:bg-gold/12 file:text-gold file:cursor-pointer hover:file:bg-gold/20 cursor-pointer">
                                                    <p class="text-[10px] text-dim mt-0.5">MP4, WebM sau MOV · max 200 MB</p>
                                                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                            </div>
                                            <textarea wire:model="techDescription" rows="2" placeholder="Descriere (opțional)"
                                                      class="w-full bg-card border border-border rounded-lg px-2.5 py-1.5 text-content text-xs resize-y leading-relaxed mb-2"></textarea>
                                            <textarea wire:model="techCoachNote" rows="2" placeholder="Notă antrenor (opțional)"
                                                      class="w-full bg-card border border-border rounded-lg px-2.5 py-1.5 text-content text-xs resize-y leading-relaxed mb-3"></textarea>
                                            <div class="flex gap-2">
                                                <button wire:click="addTechnique"
                                                        class="px-3.5 py-1.5 bg-gold hover:bg-gold-light text-[#08080e] font-bold text-xs rounded-lg cursor-pointer border-none transition-colors">
                                                    Adaugă
                                                </button>
                                                <button wire:click="$set('addTechCatId', null)"
                                                        class="px-2.5 py-1.5 bg-transparent border border-border text-dim text-xs rounded-lg cursor-pointer hover:text-content transition-colors">
                                                    Anulează
                                                </button>
                                            </div>
                                        </div>
                                    <?php else: ?>
                                        <button wire:click="openAddTechnique(<?php echo e($category->id); ?>)"
                                                class="w-full bg-transparent border border-dashed border-border text-gold text-xs font-semibold py-2 rounded-lg mt-1 cursor-pointer hover:bg-gold/5 transition-colors">
                                            + Adaugă tehnică
                                        </button>
                                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                </div>

                            </div>
                        </div>
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>

                </div>
            </div>
        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>

    </div>
</div>
<?php /**PATH /var/www/html/resources/views/livewire/admin/curriculum.blade.php ENDPATH**/ ?>