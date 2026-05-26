<div x-data="{
    tab: window.location.hash === '#curricula' ? 'curricula' : 'elevi',
    init() {
        window.addEventListener('hashchange', () => {
            this.tab = window.location.hash === '#curricula' ? 'curricula' : 'elevi';
        });
    }
}">

    
    <div class="bg-card border-b border-border px-5 py-3.5 flex items-center justify-between sticky top-0 z-50">
        <div>
            <h1 class="font-[family-name:var(--font-display)] text-[15px] font-bold text-gold tracking-[2px] leading-tight">QWAN KI DO</h1>
            <p class="text-xs text-dim mt-0.5">Panou antrenor</p>
        </div>
        <button @click="tab = 'curricula'; window.location.hash = 'curricula'"
                wire:click="$set('showAddGrade', true)"
                class="px-4 py-2 text-[13px] font-bold bg-gold hover:bg-gold-light text-[#08080e] rounded-lg transition-colors cursor-pointer border-none">
            + Grad nou
        </button>
    </div>

    <div class="max-w-4xl mx-auto px-5 py-5 pb-16">

        
        <div class="grid grid-cols-2 sm:grid-cols-4 gap-2.5 mb-5">
            <div class="bg-card border border-border rounded-xl p-4 text-center">
                <div class="text-[28px] font-extrabold leading-none"><?php echo e($stats['activeCount']); ?></div>
                <div class="text-[11px] text-dim mt-1.5">Elevi activi</div>
            </div>
            <div class="bg-card border rounded-xl p-4 text-center <?php echo e($stats['pendingCount'] > 0 ? 'border-amber-400/30' : 'border-border'); ?>">
                <div class="text-[28px] font-extrabold leading-none <?php echo e($stats['pendingCount'] > 0 ? 'text-amber-400' : ''); ?>"><?php echo e($stats['pendingCount']); ?></div>
                <div class="text-[11px] text-dim mt-1.5">În așteptare</div>
            </div>
            <div class="bg-card border border-border rounded-xl p-4 text-center">
                <div class="text-[28px] font-extrabold text-gold leading-none"><?php echo e($stats['gradeCount']); ?></div>
                <div class="text-[11px] text-dim mt-1.5">Grade</div>
            </div>
            <div class="bg-card border border-border rounded-xl p-4 text-center">
                <div class="text-[28px] font-extrabold text-emerald-400 leading-none"><?php echo e($stats['techniqueCount']); ?></div>
                <div class="text-[11px] text-dim mt-1.5">Tehnici</div>
            </div>
        </div>

        
        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($stats['pendingCount'] > 0): ?>
            <div class="flex items-center gap-3 bg-amber-400/5 border border-amber-400/20 rounded-xl px-4 py-3 mb-5">
                <svg class="shrink-0 text-amber-400" width="18" height="18" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M10.29 3.86L1.82 18a2 2 0 001.71 3h16.94a2 2 0 001.71-3L13.71 3.86a2 2 0 00-3.42 0z"/><line x1="12" y1="9" x2="12" y2="13"/><line x1="12" y1="17" x2="12.01" y2="17"/></svg>
                <p class="text-[13px] font-semibold text-amber-400">
                    <?php echo e($stats['pendingCount']); ?> <?php echo e($stats['pendingCount'] === 1 ? 'elev așteaptă' : 'elevi așteaptă'); ?> aprobare
                </p>
            </div>
        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

        
        <div class="flex bg-card border border-border rounded-xl p-1 gap-1 mb-4">
            <button @click="tab = 'elevi'; window.location.hash = 'elevi'"
                    :class="tab === 'elevi' ? 'bg-gold text-[#08080e] font-bold' : 'text-dim font-medium hover:text-content'"
                    class="flex-1 py-2 text-[13px] rounded-lg border-none cursor-pointer transition-colors">
                Elevi
            </button>
            <button @click="tab = 'curricula'; window.location.hash = 'curricula'"
                    :class="tab === 'curricula' ? 'bg-gold text-[#08080e] font-bold' : 'text-dim font-medium hover:text-content'"
                    class="flex-1 py-2 text-[13px] rounded-lg border-none cursor-pointer transition-colors">
                Curriculă
            </button>
        </div>

        
        <div x-show="tab === 'elevi'">

            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($pendingStudents->count() > 0): ?>
                <p class="text-[11px] uppercase tracking-[1.5px] text-amber-400 font-bold mb-2.5">Cereri în așteptare</p>
                <div class="flex flex-col gap-2.5 mb-6">
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $pendingStudents; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $student): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
                        <div class="bg-card border border-amber-400/20 rounded-xl px-4 py-3.5">
                            <div class="flex items-center justify-between flex-wrap gap-2.5">
                                <div class="flex items-center gap-2.5">
                                    <div class="w-9 h-9 rounded-full bg-gradient-to-br from-[#1a1a20] to-[#2a2a30] border border-amber-400/40 flex items-center justify-center font-bold text-[14px] text-amber-400 shrink-0">
                                        <?php echo e(strtoupper(substr($student->name, 0, 1))); ?>

                                    </div>
                                    <div>
                                        <div class="font-semibold text-[14px]"><?php echo e($student->name); ?></div>
                                        <div class="text-xs text-dim"><?php echo e($student->email); ?> · <?php echo e($student->created_at->diffForHumans()); ?></div>
                                    </div>
                                </div>
                                <div class="flex gap-2">
                                    <button wire:click="approveStudent(<?php echo e($student->id); ?>)" wire:loading.attr="disabled"
                                            class="bg-emerald-500/10 border border-emerald-500/30 text-emerald-400 text-[13px] font-semibold px-3.5 py-1.5 rounded-lg cursor-pointer transition-colors hover:bg-emerald-500/20">
                                        ✓ Aprobă
                                    </button>
                                    <button wire:click="rejectStudent(<?php echo e($student->id); ?>)" wire:loading.attr="disabled"
                                            class="bg-red-500/8 border border-red-500/20 text-red-400 text-[13px] px-3.5 py-1.5 rounded-lg cursor-pointer transition-colors hover:bg-red-500/15">
                                        ✕ Respinge
                                    </button>
                                </div>
                            </div>
                        </div>
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                </div>
            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

            <p class="text-[11px] uppercase tracking-[1.5px] text-dim font-semibold mb-2.5">Elevi activi</p>

            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($activeStudents->isEmpty()): ?>
                <div class="bg-card border border-border rounded-xl p-8 text-center">
                    <p class="text-dim text-sm">Niciun elev activ momentan.</p>
                </div>
            <?php else: ?>
                <div class="flex flex-col gap-2.5">
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $activeStudents; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $student): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
                        <div class="bg-card border border-border rounded-xl px-4 py-3.5">
                            <div class="flex items-center justify-between flex-wrap gap-2.5">
                                <div class="flex items-center gap-2.5">
                                    <div class="w-9 h-9 rounded-full bg-gradient-to-br from-[#1a2040] to-[#2a3060] border border-[#3b4080] flex items-center justify-center font-bold text-[14px] text-[#8090d0] shrink-0">
                                        <?php echo e(strtoupper(substr($student->name, 0, 1))); ?>

                                    </div>
                                    <div>
                                        <div class="font-semibold text-[14px]"><?php echo e($student->name); ?></div>
                                        <div class="text-xs text-dim"><?php echo e($student->email); ?></div>
                                    </div>
                                </div>
                                <select wire:change="setStudentGrade(<?php echo e($student->id); ?>, $event.target.value)"
                                        class="bg-surface border border-border rounded-lg px-2.5 py-1.5 text-content text-xs cursor-pointer">
                                    <option value="">— Fără grad —</option>
                                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $allGrades; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $grade): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
                                        <option value="<?php echo e($grade->id); ?>" <?php echo e($student->current_grade_id === $grade->id ? 'selected' : ''); ?>>
                                            <?php echo e($grade->name); ?>

                                        </option>
                                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                                </select>
                            </div>
                        </div>
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                </div>
            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

        </div>

        
        <div x-show="tab === 'curricula'">

            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($grades->isEmpty() && !$showAddGrade): ?>
                <div class="bg-card border border-border rounded-xl p-8 text-center mb-3.5">
                    <p class="text-dim text-sm">Nu există grade. Adaugă primul grad.</p>
                </div>
            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

            <div class="flex flex-col gap-2.5 mb-3.5">
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $grades; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $grade): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
                    <div <?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::$currentLoop['key'] = 'grade-'.e($grade->id).''; ?>wire:key="grade-<?php echo e($grade->id); ?>" class="bg-card border border-border rounded-xl overflow-hidden">

                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($editGradeId === $grade->id): ?>
                            <div class="px-4 py-3.5 flex items-center gap-2.5 flex-wrap">
                                <input wire:model="editGradeName" type="text" placeholder="Nume grad (ex: 1 Câp)"
                                       class="flex-1 min-w-40 bg-surface border border-gold rounded-lg px-3 py-2 text-content text-sm font-semibold">
                                <input wire:model.number="editGradeOrder" type="number" min="0" placeholder="Ordine"
                                       class="w-20 bg-surface border border-border rounded-lg px-3 py-2 text-content text-sm">
                                <button wire:click="saveGrade"
                                        class="px-4 py-2 bg-gold hover:bg-gold-light text-[#08080e] font-bold text-sm rounded-lg cursor-pointer border-none transition-colors">
                                    Salvează
                                </button>
                                <button wire:click="cancelEditGrade"
                                        class="px-3.5 py-2 bg-transparent border border-border text-dim hover:text-content text-sm rounded-lg cursor-pointer transition-colors">
                                    Anulează
                                </button>
                            </div>
                        <?php else: ?>
                            <div class="px-4 py-3.5 flex items-center justify-between">
                                <div class="flex items-center gap-3">
                                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($grade->order === 0): ?>
                                        <div class="belt"><span class="text-[11px] text-[#555] font-semibold">0</span></div>
                                    <?php else: ?>
                                        <div class="belt">
                                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php for($i = 0; $i < min($grade->order, 8); $i++): ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
                                                <div class="cap"></div>
                                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endfor; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                                        </div>
                                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                    <div>
                                        <div class="font-semibold text-[14px]"><?php echo e($grade->name); ?></div>
                                        <div class="text-xs text-dim mt-0.5">
                                            <?php echo e($grade->categories->sum('techniques_count')); ?> tehnici · <?php echo e($grade->categories->count()); ?> categorii
                                        </div>
                                    </div>
                                </div>
                                <div class="flex items-center gap-2">
                                    <a href="<?php echo e(route('admin.grades.manage', $grade)); ?>"
                                       class="text-xs text-dim border border-border px-3 py-1.5 rounded-lg hover:text-content hover:border-content/30 transition-colors no-underline">
                                        Gestionează
                                    </a>
                                    <button wire:click="startEditGrade(<?php echo e($grade->id); ?>)"
                                            class="text-xs text-dim border border-border px-2.5 py-1.5 rounded-lg hover:text-content cursor-pointer bg-transparent transition-colors">
                                        ✎
                                    </button>
                                    <button wire:click="deleteGrade(<?php echo e($grade->id); ?>)"
                                            wire:confirm="Ștergi gradul '<?php echo e($grade->name); ?>' și toate tehnicile din el?"
                                            class="text-xs text-red-400 bg-red-500/8 border border-red-500/20 px-2.5 py-1.5 rounded-lg hover:bg-red-500/15 cursor-pointer transition-colors">
                                        ✕
                                    </button>
                                </div>
                            </div>
                        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

                    </div>
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
            </div>

            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($showAddGrade): ?>
                <div class="bg-card border border-gold/30 rounded-xl p-5 mb-3.5">
                    <p class="text-[13px] font-bold text-gold mb-3.5">Grad nou</p>
                    <div class="flex gap-2.5 flex-wrap">
                        <input wire:model="newGradeName" type="text" placeholder="ex: 1 Câp sau 2 Câp — Intermediar"
                               class="flex-1 min-w-48 bg-surface border border-border rounded-lg px-3.5 py-2.5 text-content text-sm font-semibold">
                        <input wire:model.number="newGradeOrder" type="number" min="0" placeholder="Ordine"
                               class="w-28 bg-surface border border-border rounded-lg px-3.5 py-2.5 text-content text-sm">
                        <button wire:click="addGrade"
                                class="px-5 py-2.5 bg-gold hover:bg-gold-light text-[#08080e] font-bold text-sm rounded-lg cursor-pointer border-none transition-colors">
                            Adaugă
                        </button>
                        <button wire:click="$set('showAddGrade', false)"
                                class="px-4 py-2.5 bg-transparent border border-border text-dim hover:text-content text-sm rounded-lg cursor-pointer transition-colors">
                            Anulează
                        </button>
                    </div>
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__errorArgs = ['newGradeName'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <p class="text-red-400 text-xs mt-2"><?php echo e($message); ?></p> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                </div>
            <?php else: ?>
                <button wire:click="$set('showAddGrade', true)"
                        class="w-full bg-transparent border-2 border-dashed border-border text-dim hover:border-gold hover:text-gold py-3.5 rounded-xl text-sm cursor-pointer transition-colors">
                    + Adaugă grad nou
                </button>
            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

        </div>

    </div>
</div>
<?php /**PATH /var/www/html/resources/views/livewire/admin/dashboard.blade.php ENDPATH**/ ?>