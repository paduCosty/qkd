<div>

    
    <div class="bg-card border-b border-border px-5 py-3.5 flex items-center justify-between sticky top-0 z-50">
        <div class="flex items-center gap-3">
            <div class="w-10 h-10 rounded-full bg-gradient-to-br from-[#1a1a30] to-[#2a2a4a] border border-gold flex items-center justify-center font-bold text-[15px] text-gold shrink-0">
                <?php echo e(strtoupper(substr($user->name, 0, 1))); ?>

            </div>
            <div>
                <div class="font-bold text-[15px] leading-tight"><?php echo e($user->name); ?></div>
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($user->currentGrade): ?>
                    <div class="flex items-center gap-1.5 mt-0.5">
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($user->currentGrade->order === 0): ?>
                            <div class="belt"><span class="text-[11px] text-[#555] font-semibold">0</span></div>
                        <?php else: ?>
                            <div class="belt">
                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php for($i = 0; $i < $user->currentGrade->order; $i++): ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
                                    <div class="cap"></div>
                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endfor; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                            </div>
                        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                        <span class="text-dim text-xs"><?php echo e($user->currentGrade->name); ?></span>
                    </div>
                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
            </div>
        </div>
        <form method="POST" action="<?php echo e(route('logout')); ?>">
            <?php echo csrf_field(); ?>
            <button type="submit" class="text-dim hover:text-content transition-colors p-1.5 cursor-pointer bg-transparent border-none" title="Deconectare">
                <svg width="20" height="20" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/></svg>
            </button>
        </form>
    </div>

    
    <div x-data="{ filter: 'all' }" class="flex flex-col md:flex-row">

        
        <div class="md:w-[340px] md:shrink-0 p-5 md:p-6 md:border-r md:border-border md:sticky md:top-[69px] md:h-[calc(100vh-69px)] md:overflow-y-auto">

            
            <div class="grid grid-cols-3 gap-2.5 mb-5">
                <div class="bg-card border border-border rounded-xl p-3.5 text-center">
                    <div class="text-[26px] font-extrabold text-emerald-400 leading-none"><?php echo e($masteredCount); ?></div>
                    <div class="text-[11px] text-dim mt-1">Stăpânite</div>
                </div>
                <div class="bg-card border border-border rounded-xl p-3.5 text-center">
                    <div class="text-[26px] font-extrabold text-amber-400 leading-none"><?php echo e($progressCount); ?></div>
                    <div class="text-[11px] text-dim mt-1">În lucru</div>
                </div>
                <div class="bg-card border border-border rounded-xl p-3.5 text-center">
                    <div class="text-[26px] font-extrabold text-dim leading-none"><?php echo e($unknownCount); ?></div>
                    <div class="text-[11px] text-dim mt-1">De studiat</div>
                </div>
            </div>

            
            <div class="flex gap-2 mb-5 overflow-x-auto pb-0.5 [scrollbar-width:none]">
                <button @click="filter = 'all'"
                        :class="filter === 'all' ? 'bg-gold/12 text-gold border-gold/30 font-bold' : 'text-dim border-border hover:border-content/20 hover:text-content'"
                        class="text-xs px-3.5 py-1.5 rounded-full border shrink-0 transition-colors cursor-pointer bg-transparent">
                    Toate <span class="opacity-60 font-normal"><?php echo e($totalCount); ?></span>
                </button>
                <button @click="filter = 'mastered'"
                        :class="filter === 'mastered' ? 'bg-gold/12 text-gold border-gold/30 font-bold' : 'text-dim border-border hover:border-content/20 hover:text-content'"
                        class="text-xs px-3.5 py-1.5 rounded-full border shrink-0 transition-colors cursor-pointer bg-transparent">
                    ✓ Stăpânite <span class="opacity-60 font-normal"><?php echo e($masteredCount); ?></span>
                </button>
                <button @click="filter = 'progress'"
                        :class="filter === 'progress' ? 'bg-gold/12 text-gold border-gold/30 font-bold' : 'text-dim border-border hover:border-content/20 hover:text-content'"
                        class="text-xs px-3.5 py-1.5 rounded-full border shrink-0 transition-colors cursor-pointer bg-transparent">
                    ⚡ În lucru <span class="opacity-60 font-normal"><?php echo e($progressCount); ?></span>
                </button>
                <button @click="filter = 'unknown'"
                        :class="filter === 'unknown' ? 'bg-gold/12 text-gold border-gold/30 font-bold' : 'text-dim border-border hover:border-content/20 hover:text-content'"
                        class="text-xs px-3.5 py-1.5 rounded-full border shrink-0 transition-colors cursor-pointer bg-transparent">
                    — De studiat <span class="opacity-60 font-normal"><?php echo e($unknownCount); ?></span>
                </button>
            </div>

            
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($lastProgress): ?>
                <p class="text-[11px] uppercase tracking-[1.5px] text-dim font-semibold mb-2.5">Continuă de unde ai rămas</p>
                <div class="bg-card border border-border rounded-xl p-3.5 flex items-center gap-3.5 mb-5">
                    <div class="w-14 h-11 bg-gradient-to-br from-[#1a1a30] to-[#0f0f1e] rounded-lg shrink-0 flex items-center justify-center border border-border">
                        <svg width="20" height="20" fill="#c9960f" viewBox="0 0 24 24"><path d="M8 5v14l11-7z"/></svg>
                    </div>
                    <div class="flex-1 min-w-0">
                        <div class="viet-name mb-0.5"><?php echo e($lastProgress->name_viet); ?></div>
                        <div class="text-[13px] font-medium text-content truncate"><?php echo e($lastProgress->name_ro); ?></div>
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($lastProgress->category): ?>
                            <div class="text-[11px] text-dim mt-0.5"><?php echo e($lastProgress->category->name_viet); ?></div>
                        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                    </div>
                    <span class="text-[11px] px-2.5 py-1 rounded-full bg-amber-400/12 text-amber-400 border border-amber-400/25 whitespace-nowrap shrink-0">⚡ În lucru</span>
                </div>
            <?php elseif($totalCount === 0): ?>
                <div class="bg-card border border-border rounded-xl p-5 text-center mb-5">
                    <p class="text-dim text-sm">Antrenorul nu a adăugat materie încă.</p>
                </div>
            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

        </div>

        
        <div class="flex-1 p-4 md:p-6 pb-24">
            <p class="text-[11px] uppercase tracking-[1.5px] text-dim font-semibold mb-3">Materie pe grade</p>

            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__empty_1 = true; $__currentLoopData = $grades; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $grade): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
                <?php
                    $gradeTechs    = $grade->categories->flatMap->techniques;
                    $gradeTotal    = $gradeTechs->count();
                    $gradeMastered = $gradeTechs->filter(fn($t) => ($progressMap[$t->id] ?? null) === 'mastered')->count();
                    $pct           = $gradeTotal > 0 ? round($gradeMastered / $gradeTotal * 100) : 0;
                    $isCurrentGrade = $user->current_grade_id === $grade->id;
                ?>

                <div <?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::$currentLoop['key'] = 'grade-'.e($grade->id).''; ?>wire:key="grade-<?php echo e($grade->id); ?>"
                     x-data="{ open: <?php echo e($isCurrentGrade ? 'true' : 'false'); ?> }"
                     class="bg-card border border-border rounded-xl mb-2 overflow-hidden">

                    
                    <div @click="open = !open" class="px-4 py-3.5 flex items-center justify-between cursor-pointer select-none">
                        <div class="flex items-center gap-3">
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($grade->order === 0): ?>
                                <div class="belt"><span class="text-[11px] text-[#555] font-semibold">0</span></div>
                            <?php else: ?>
                                <div class="belt">
                                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php for($i = 0; $i < $grade->order; $i++): ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
                                        <div class="cap"></div>
                                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endfor; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                                </div>
                            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                            <div>
                                <div class="font-semibold text-[14px]"><?php echo e($grade->name); ?></div>
                                <div class="text-xs text-dim mt-0.5"><?php echo e($gradeMastered); ?> / <?php echo e($gradeTotal); ?> tehnici</div>
                            </div>
                        </div>
                        <div class="flex items-center gap-2.5">
                            <div class="w-11 h-1.5 bg-border rounded-full overflow-hidden">
                                <div class="h-full rounded-full transition-all"
                                     style="width:<?php echo e($pct); ?>%;background:<?php echo e($pct === 100 ? '#10b981' : ($pct > 0 ? '#f59e0b' : 'transparent')); ?>;"></div>
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

                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $grade->categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
                                <div class="flex items-center justify-between <?php echo e($loop->first ? 'mt-2' : 'mt-3'); ?> mb-1.5 pb-1.5 border-b border-white/4">
                                    <span class="text-[9px] font-extrabold text-dim uppercase tracking-[2px]"><?php echo e($category->name_viet); ?> — <?php echo e($category->name_ro); ?></span>
                                    <span class="text-[10px] text-[#3a3a55]"><?php echo e($category->techniques->count()); ?></span>
                                </div>

                                <div class="flex flex-col gap-1.5">
                                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $category->techniques; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $technique): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
                                        <?php
                                            $status    = $progressMap[$technique->id] ?? 'unknown';
                                            $isForm    = $technique->type === 'form';
                                            $hasDetail = $technique->description || $technique->coach_note || $technique->video_url;
                                        ?>

                                        <div <?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::$currentLoop['key'] = 'tech-'.e($technique->id).''; ?>wire:key="tech-<?php echo e($technique->id); ?>"
                                             x-data="{ open: false }"
                                             data-status="<?php echo e($status); ?>"
                                             x-show="filter === 'all' || $el.dataset.status === filter"
                                             class="bg-card-2 rounded-lg overflow-hidden <?php echo e($isForm ? 'border border-gold/10' : 'border border-border'); ?>">

                                            
                                            <div @click="<?php echo e($hasDetail ? 'open = !open' : ''); ?>"
                                                 class="flex items-center gap-2 px-2.5 py-1.5 <?php echo e($hasDetail ? 'cursor-pointer hover:bg-white/2' : ''); ?> transition-colors">

                                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($hasDetail): ?>
                                                    <svg :style="open ? 'transform:rotate(90deg)' : ''"
                                                         style="transition:transform .15s"
                                                         class="text-dim shrink-0"
                                                         width="10" height="10" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                                                        <path d="M9 18l6-6-6-6"/>
                                                    </svg>
                                                <?php else: ?>
                                                    <span class="w-[10px] shrink-0"></span>
                                                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

                                                <div class="flex-1 min-w-0">
                                                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($isForm): ?>
                                                        <div class="flex items-center gap-1.5 mb-0.5">
                                                            <span class="viet-name text-[10px]"><?php echo e($technique->name_viet); ?></span>
                                                            <span class="text-[9px] text-gold bg-gold/8 border border-gold/18 px-1 py-px rounded">FORMĂ</span>
                                                        </div>
                                                        <span class="text-xs text-dim"><?php echo e($technique->name_ro); ?></span>
                                                    <?php else: ?>
                                                        <span class="viet-name text-[10px]"><?php echo e($technique->name_viet); ?></span>
                                                        <span class="text-xs text-dim ml-1.5"><?php echo e($technique->name_ro); ?></span>
                                                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                                </div>

                                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($technique->video_url): ?>
                                                    <svg class="text-gold shrink-0" width="11" height="11" fill="currentColor" viewBox="0 0 24 24"><circle cx="12" cy="12" r="10" fill="none" stroke="currentColor" stroke-width="2"/><polygon points="10 8 16 12 10 16 10 8" fill="currentColor"/></svg>
                                                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

                                                <button wire:click.stop="cycleStatus(<?php echo e($technique->id); ?>)"
                                                        wire:loading.attr="disabled"
                                                        class="shrink-0 border-none bg-transparent cursor-pointer p-0">
                                                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($status === 'mastered'): ?>
                                                        <span class="text-[10px] px-2 py-0.5 rounded-full bg-emerald-500/12 text-emerald-400 border border-emerald-500/25 block whitespace-nowrap">✓</span>
                                                    <?php elseif($status === 'progress'): ?>
                                                        <span class="text-[10px] px-2 py-0.5 rounded-full bg-amber-400/12 text-amber-400 border border-amber-400/25 block whitespace-nowrap">⚡</span>
                                                    <?php else: ?>
                                                        <span class="text-[10px] px-2 py-0.5 rounded-full bg-dim/12 text-dim border border-dim/20 block whitespace-nowrap">—</span>
                                                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                                </button>
                                            </div>

                                            
                                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($hasDetail): ?>
                                                <div x-show="open" x-transition class="border-t border-border px-3 py-2.5 flex flex-col gap-2">
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
                                                        <?php $embedUrl = $technique->youtubeEmbedUrl(); ?>
                                                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($embedUrl): ?>
                                                            <div class="relative w-full rounded-lg overflow-hidden" style="padding-bottom:56.25%">
                                                                <iframe class="absolute inset-0 w-full h-full"
                                                                        src="<?php echo e($embedUrl); ?>"
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
                                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                                </div>
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>

                        </div>
                    </div>

                </div>
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                <div class="bg-card border border-border rounded-xl p-8 text-center">
                    <p class="text-dim text-sm">Niciun grad adăugat încă. Antrenorul va adăuga materia în curând.</p>
                </div>
            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

        </div>

    </div>

</div>
<?php /**PATH /var/www/html/resources/views/livewire/student/dashboard.blade.php ENDPATH**/ ?>