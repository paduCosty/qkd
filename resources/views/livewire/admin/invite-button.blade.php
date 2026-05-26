<div class="px-2">
    @if($link)
        {{-- Show generated link --}}
        <div x-data="{ copied: false }" class="bg-gold/8 border border-gold/25 rounded-lg px-3 py-2.5">
            <div class="flex items-center justify-between mb-1.5">
                <span class="text-[11px] text-gold font-semibold">Link generat</span>
                <button wire:click="$set('link', null)"
                        class="text-dim hover:text-content text-[10px] cursor-pointer border-none bg-transparent">
                    ✕
                </button>
            </div>
            <input x-ref="linkInput" type="text" readonly value="{{ $link }}"
                   class="w-full bg-surface border border-border rounded px-2 py-1 text-[10px] text-gold font-mono mb-1.5 min-w-0">
            <button @click="$refs.linkInput.select(); document.execCommand('copy'); copied = true; setTimeout(() => copied = false, 2500)"
                    class="w-full text-[11px] font-bold py-1 rounded cursor-pointer transition-colors border-none"
                    :class="copied ? 'bg-emerald-500/20 text-emerald-400' : 'bg-gold/15 text-gold hover:bg-gold/25'">
                <span x-show="!copied">Copiază link</span>
                <span x-show="copied">✓ Copiat!</span>
            </button>
            <p class="text-[10px] text-dim mt-1.5 text-center">Valabil 48h · o singură utilizare</p>
        </div>
    @else
        {{-- Generate button --}}
        <button wire:click="generate"
                class="flex w-full items-center gap-2.5 px-3 py-2.5 rounded-lg text-[13px] font-medium transition-colors text-dim hover:bg-white/4 hover:text-content cursor-pointer border-none bg-transparent"
                wire:loading.class="opacity-60">
            <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path d="M10 13a5 5 0 007.54.54l3-3a5 5 0 00-7.07-7.07l-1.72 1.71"/>
                <path d="M14 11a5 5 0 00-7.54-.54l-3 3a5 5 0 007.07 7.07l1.71-1.71"/>
            </svg>
            <span wire:loading.remove wire:target="generate">Invită un antrenor</span>
            <span wire:loading wire:target="generate">Se generează...</span>
        </button>
    @endif
</div>
