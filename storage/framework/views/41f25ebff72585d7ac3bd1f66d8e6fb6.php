<!DOCTYPE html>
<html lang="ro">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Qwan Ki Do — Platforma de Antrenament</title>
    <meta name="description" content="Platforma digitală pentru practica și urmărirea progresului în Qwan Ki Do.">
    <meta name="theme-color" content="#09090f">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <link rel="manifest" href="/manifest.json">
    <link rel="apple-touch-icon" href="/icons/icon-180x180.png">
    <link rel="icon" type="image/svg+xml" href="/icons/icon.svg">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&family=Cinzel:wght@400;600;700&display=swap" rel="stylesheet">
    <?php echo app('Illuminate\Foundation\Vite')(['resources/css/app.css', 'resources/js/app.js']); ?>
</head>
<body class="bg-surface text-content antialiased">

    
    <div class="fixed inset-0 overflow-hidden pointer-events-none z-0">
        <div class="absolute -top-48 -right-48 w-[700px] h-[700px] rounded-full bg-[radial-gradient(circle,rgba(201,150,15,.06)_0%,transparent_65%)]"></div>
        <div class="absolute -bottom-48 -left-48 w-[700px] h-[700px] rounded-full bg-[radial-gradient(circle,rgba(37,99,235,.04)_0%,transparent_65%)]"></div>
        <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-[900px] h-[900px] rounded-full bg-[radial-gradient(circle,rgba(201,150,15,.03)_0%,transparent_60%)]"></div>
    </div>

    <div class="relative z-10">

        
        <nav class="max-w-5xl mx-auto px-6 py-5 flex items-center justify-between">
            <div class="flex items-center gap-2.5">
                <div class="w-9 h-9 rounded-full border border-gold/50 bg-gradient-to-br from-card to-gold/15 flex items-center justify-center">
                    <svg width="18" height="18" viewBox="0 0 44 44" fill="none">
                        <text x="22" y="30" text-anchor="middle" font-family="Cinzel,serif" font-size="17" font-weight="600" fill="#c9960f">氣</text>
                    </svg>
                </div>
                <span class="font-[family-name:var(--font-display)] text-[13px] font-bold text-gold tracking-[2px]">QWAN KI DO</span>
            </div>
            <div class="flex items-center gap-2.5">
                <a href="<?php echo e(route('login')); ?>"
                   class="px-4 py-2 text-[13px] text-dim border border-border rounded-lg hover:border-content/30 hover:text-content transition-colors">
                    Intră în cont
                </a>
                <a href="<?php echo e(route('register')); ?>"
                   class="px-4 py-2 text-[13px] font-bold bg-gold hover:bg-gold-light text-[#08080e] rounded-lg transition-colors">
                    Înregistrează-te
                </a>
            </div>
        </nav>

        
        <section class="text-center max-w-2xl mx-auto px-6 pt-16 pb-20">
            <div class="inline-flex items-center justify-center w-28 h-28 rounded-full border-2 border-gold bg-gradient-to-br from-card to-gold/20 mb-9 shadow-[0_0_60px_rgba(201,150,15,.2)]">
                <svg width="56" height="56" viewBox="0 0 44 44" fill="none">
                    <circle cx="22" cy="22" r="17" stroke="#c9960f" stroke-width="1.2" opacity=".4"/>
                    <text x="22" y="29" text-anchor="middle" font-family="Cinzel,serif" font-size="15" font-weight="600" fill="#c9960f">氣</text>
                </svg>
            </div>

            <h1 class="font-[family-name:var(--font-display)] text-[clamp(32px,6vw,54px)] font-bold text-gold tracking-[6px] leading-tight mb-2.5">
                QWAN KI DO
            </h1>
            <p class="text-dim text-[13px] tracking-[3px] uppercase mb-7">Calea Pumnului care Înaintează</p>
            <p class="text-[18px] leading-relaxed font-light mb-11">
                Platforma digitală pentru urmărirea progresului în antrenament.<br>
                Materie structurată pe grade, tehnici video și statistici în timp real.
            </p>

            <div class="flex items-center justify-center gap-3.5 flex-wrap">
                <a href="<?php echo e(route('register')); ?>"
                   class="px-8 py-4 text-[16px] font-bold bg-gold hover:bg-gold-light text-[#08080e] rounded-xl tracking-wide transition-colors">
                    Începe acum
                </a>
                <a href="<?php echo e(route('login')); ?>"
                   class="px-7 py-4 text-[15px] border border-border text-dim hover:border-content/30 hover:text-content rounded-xl transition-colors">
                    Intră în cont
                </a>
            </div>
        </section>

        
        <div class="max-w-4xl mx-auto h-px bg-gradient-to-r from-transparent via-border to-transparent"></div>

        
        <section class="max-w-4xl mx-auto px-6 py-16">
            <p class="text-center text-[11px] uppercase tracking-[3px] text-dim font-bold mb-12">Ce oferă platforma</p>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-5">

                <div class="bg-card border border-border rounded-2xl p-7">
                    <div class="w-11 h-11 rounded-xl bg-gold/10 border border-gold/20 flex items-center justify-center mb-5">
                        <svg width="22" height="22" fill="none" stroke="#c9960f" stroke-width="2" viewBox="0 0 24 24"><path d="M4 19.5A2.5 2.5 0 016.5 17H20"/><path d="M6.5 2H20v20H6.5A2.5 2.5 0 014 19.5v-15A2.5 2.5 0 016.5 2z"/></svg>
                    </div>
                    <h3 class="font-semibold text-[16px] mb-2">Curriculă pe grade</h3>
                    <p class="text-dim text-sm leading-relaxed">Toată materia structurată pe grade (câp), categorii și tehnici — exact cum se predă în sala de antrenament.</p>
                </div>

                <div class="bg-card border border-border rounded-2xl p-7">
                    <div class="w-11 h-11 rounded-xl bg-emerald-500/10 border border-emerald-500/20 flex items-center justify-center mb-5">
                        <svg width="22" height="22" fill="none" stroke="#10b981" stroke-width="2" viewBox="0 0 24 24"><line x1="18" y1="20" x2="18" y2="10"/><line x1="12" y1="20" x2="12" y2="4"/><line x1="6" y1="20" x2="6" y2="14"/></svg>
                    </div>
                    <h3 class="font-semibold text-[16px] mb-2">Urmărire progres</h3>
                    <p class="text-dim text-sm leading-relaxed">Marchează fiecare tehnică ca <em>în lucru</em> sau <em>stăpânită</em>. Vizualizează progresul per grad în timp real.</p>
                </div>

                <div class="bg-card border border-border rounded-2xl p-7">
                    <div class="w-11 h-11 rounded-xl bg-blue-500/10 border border-blue-500/20 flex items-center justify-center mb-5">
                        <svg width="22" height="22" fill="none" stroke="#60a5fa" stroke-width="2" viewBox="0 0 24 24"><path d="M8 5v14l11-7z"/></svg>
                    </div>
                    <h3 class="font-semibold text-[16px] mb-2">Tehnici video</h3>
                    <p class="text-dim text-sm leading-relaxed">Fiecare tehnică poate include un video demonstrativ — YouTube sau încarcat direct — pentru studiu acasă.</p>
                </div>

                <div class="bg-card border border-border rounded-2xl p-7">
                    <div class="w-11 h-11 rounded-xl bg-amber-500/10 border border-amber-500/20 flex items-center justify-center mb-5">
                        <svg width="22" height="22" fill="none" stroke="#f59e0b" stroke-width="2" viewBox="0 0 24 24"><rect x="3" y="4" width="18" height="18" rx="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/></svg>
                    </div>
                    <h3 class="font-semibold text-[16px] mb-2">Examene & stagii</h3>
                    <p class="text-dim text-sm leading-relaxed">Antrenorul publică datele examenelor și stagiilor. Elevii se pot înscrie și urmări pregătirea.</p>
                </div>

                <div class="bg-card border border-border rounded-2xl p-7">
                    <div class="w-11 h-11 rounded-xl bg-violet-500/10 border border-violet-500/20 flex items-center justify-center mb-5">
                        <svg width="22" height="22" fill="none" stroke="#a78bfa" stroke-width="2" viewBox="0 0 24 24"><path d="M12 2L2 7l10 5 10-5-10-5z"/><path d="M2 17l10 5 10-5"/><path d="M2 12l10 5 10-5"/></svg>
                    </div>
                    <h3 class="font-semibold text-[16px] mb-2">Forme & înlănțuiri</h3>
                    <p class="text-dim text-sm leading-relaxed">Formele (Doc Luyen) sunt marcate distinct cu pașii lor secvențiali, pentru studiu pas cu pas.</p>
                </div>

                <div class="bg-card border border-border rounded-2xl p-7">
                    <div class="w-11 h-11 rounded-xl bg-gold/10 border border-gold/20 flex items-center justify-center mb-5">
                        <svg width="22" height="22" fill="none" stroke="#c9960f" stroke-width="2" viewBox="0 0 24 24"><rect x="5" y="2" width="14" height="20" rx="2"/><line x1="12" y1="18" x2="12" y2="18"/></svg>
                    </div>
                    <h3 class="font-semibold text-[16px] mb-2">PWA — Funcționează offline</h3>
                    <p class="text-dim text-sm leading-relaxed">Instalează aplicația pe telefon ca o aplicație nativă. Funcționează și fără conexiune la internet.</p>
                </div>

            </div>
        </section>

        
        <section class="max-w-2xl mx-auto px-6 pb-20">
            <div class="relative bg-card border border-border rounded-2xl p-12 text-center overflow-hidden">
                <div class="absolute inset-0 bg-[radial-gradient(circle_at_50%_0%,rgba(201,150,15,.06),transparent_60%)] pointer-events-none"></div>
                <p class="font-[family-name:var(--font-display)] text-4xl text-gold tracking-[4px] mb-1.5">氣</p>
                <p class="text-[11px] uppercase tracking-[3px] text-dim mb-7">Qi — Energia vitală</p>
                <blockquote class="text-[17px] leading-relaxed font-light italic mb-8">
                    „Qwan Ki Do — Calea Pumnului care Înaintează — este un sistem complet de luptă bazat pe principiile Âm-Dương, îmbinând forța și flexibilitatea, atacul și apărarea într-un singur flux armonios."
                </blockquote>
                <div class="flex items-center justify-center gap-8 flex-wrap">
                    <div class="text-center">
                        <div class="text-2xl font-extrabold text-gold">5</div>
                        <div class="text-[11px] text-dim uppercase tracking-wider mt-1">Principii</div>
                    </div>
                    <div class="w-px h-8 bg-border"></div>
                    <div class="text-center">
                        <div class="text-2xl font-extrabold text-gold">9+</div>
                        <div class="text-[11px] text-dim uppercase tracking-wider mt-1">Grade (Câp)</div>
                    </div>
                    <div class="w-px h-8 bg-border"></div>
                    <div class="text-center">
                        <div class="text-2xl font-extrabold text-gold">1973</div>
                        <div class="text-[11px] text-dim uppercase tracking-wider mt-1">Fondat</div>
                    </div>
                </div>
            </div>
        </section>

        
        <section class="text-center px-6 pb-24">
            <h2 class="font-[family-name:var(--font-display)] text-[clamp(22px,4vw,36px)] text-gold tracking-[4px] mb-3.5">
                ÎNCEPE ANTRENAMENTUL
            </h2>
            <p class="text-dim text-[15px] mb-9">Înregistrează-te și antrenorul tău îți va aproba accesul.</p>
            <a href="<?php echo e(route('register')); ?>"
               class="px-11 py-4 text-[16px] font-bold bg-gold hover:bg-gold-light text-[#08080e] rounded-xl tracking-wide transition-colors inline-block">
                Creează cont gratuit
            </a>
        </section>

        
        <footer class="border-t border-border px-6 py-6 text-center">
            <p class="text-[#3a3a55] text-xs tracking-widest">Âm — Dương · Forță și Flexibilitate · © <?php echo e(date('Y')); ?> Qwan Ki Do</p>
        </footer>

    </div>

</body>
</html>
<?php /**PATH /var/www/html/resources/views/home.blade.php ENDPATH**/ ?>