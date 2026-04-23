<footer>
    <div class="footer">
        <div class="footer-brand"><a href="<?= e(url_with_lang('home.php')) ?>" class="logo-footer">Snorlax</a><p><?= e(t('footer_desc')) ?></p></div>
        <div class="footer-colonna"><h4><?= e(t('footer_products')) ?></h4><ul><li><a href="<?= e(url_with_lang('prodotti.php', ['anchor'=>'sense'])) ?>#sense">Snorlax Sense</a></li><li><a href="<?= e(url_with_lang('prodotti.php', ['anchor'=>'vision'])) ?>#vision">Snorlax Vision</a></li><li><a href="<?= e(url_with_lang('prodotti.php', ['anchor'=>'dream'])) ?>#dream">Snorlax Dream</a></li><li><a href="<?= e(url_with_lang('prodotti.php', ['anchor'=>'abbonamenti'])) ?>#abbonamenti"><?= e(t('subscriptions')) ?></a></li></ul></div>
        <div class="footer-colonna"><h4><?= e(t('footer_company')) ?></h4><ul><li><a href="<?= e(url_with_lang('chi_siamo.php')) ?>"><?= e(t('about_us')) ?></a></li><li><a href="<?= e(url_with_lang('contatti.php', ['section'=>'contact'])) ?>#contact"><?= e(t('nav_contacts')) ?></a></li></ul></div>
        <div class="footer-colonna"><h4><?= e(t('footer_support')) ?></h4><ul><li><a href="<?= e(url_with_lang('contatti.php', ['section'=>'faq'])) ?>#faq">FAQ</a></li><li><a href="<?= e(url_with_lang('privacy.php')) ?>"><?= e(t('privacy')) ?></a></li></ul></div>
    </div>
    <div class="footer-bottom"><span><?= e(t('rights')) ?></span></div>
</footer>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script>
// ── 1. Snorlax Loader (Invariato) ──────────────────────────────────────
(function(){
    if(sessionStorage.getItem('snorlax-loaded')) return;
    sessionStorage.setItem('snorlax-loaded','1');

    var fontLink = document.createElement('link');
    fontLink.rel  = 'stylesheet';
    fontLink.href = 'https://fonts.googleapis.com/css2?family=Great+Vibes&display=swap';
    document.head.appendChild(fontLink);

    var style = document.createElement('style');
    style.textContent = [
        '#snorlax-loader{ position:fixed;inset:0;z-index:9999; display:flex;flex-direction:column;align-items:center;justify-content:center; background:radial-gradient(ellipse at center,#ffffff 0%,#eaf6ff 50%,#c8e4f5 100%); transition:opacity 1.0s cubic-bezier(0.22,1,0.36,1); overflow:hidden; }',
        '#snorlax-loader.fade-out{opacity:0;pointer-events:none;}',
        '.loader-bg-sym, .loader-bg-bed{ position:absolute;opacity:0;pointer-events:none; animation:bgSymFloat var(--dur) ease-in-out infinite var(--del); }',
        '.loader-bg-sym{ font-family:"Great Vibes",cursive; color:#4a9bbf; line-height:1; }',
        '@keyframes bgSymFloat{ 0% {opacity:0;transform:translateY(0) scale(0.88);} 30% {opacity:var(--op);} 70% {opacity:var(--op);} 100%{opacity:0;transform:translateY(-28px) scale(1.08);} }',
        '#loader-svg{overflow:visible;display:block;}',
        '#loader-svg text{ font-family:"Great Vibes",cursive;font-size:108px; fill:transparent; stroke:#2a6a8a;stroke-width:1.4; stroke-linecap:round;stroke-linejoin:round; paint-order:stroke fill; }',
        '#snorlax-heart-overlay{ position:fixed;inset:0;z-index:10000; display:flex;align-items:center;justify-content:center; pointer-events:none;overflow:hidden;background:transparent; }',
        /* ECG wrapper */
        '#snorlax-loader-bottom{ display:flex; flex-direction:column; align-items:center; margin-top:-8px; width:clamp(220px,40vw,400px); }',
        '#ecg-svg{ display:block; width:100%; height:36px; overflow:visible; }',
        '#ecg-path{ fill:none; stroke:#2a8aaa; stroke-width:2; stroke-linecap:round; stroke-linejoin:round; }',
        '#ecg-head{ fill:#2a8aaa; }',
        '@media(prefers-reduced-motion:reduce){ #loader-svg text{stroke-dashoffset:0!important;} .loader-bg-sym,.loader-bg-bed{animation:none;opacity:0.25;} }'
    ].join('\n');
    document.head.appendChild(style);

    var loader = document.createElement('div');
    loader.id = 'snorlax-loader';
    loader.setAttribute('aria-hidden','true');

    var cols=8, rows=7, cellW=100/cols, cellH=100/rows;
    for(var i=0; i<cols*rows; i++){
        var col=i%cols, row=Math.floor(i/cols);
        var dur=(2.8+Math.random()*2.4).toFixed(1)+'s';
        var del=(Math.random()*5.0).toFixed(2)+'s';
        var op=(0.28+Math.random()*0.32).toFixed(2);
        var lft=(col*cellW+Math.random()*cellW*0.6+cellW*0.15).toFixed(1)+'%';
        var top=(row*cellH+Math.random()*cellH*0.6+cellH*0.15).toFixed(1)+'%';
        var type = i % 4;
        if(type === 3){
            var sz=(28+Math.random()*20).toFixed(0)+'px';
            var bed=document.createElement('div');
            bed.className='loader-bg-bed';
            bed.style.cssText='left:'+lft+';top:'+top+';width:'+sz+';height:'+sz+';';
            bed.style.setProperty('--dur',dur);
            bed.style.setProperty('--del',del);
            bed.style.setProperty('--op',op);
            bed.innerHTML='<svg viewBox="0 0 64 64" width="'+sz+'" height="'+sz+'" xmlns="http://www.w3.org/2000/svg" fill="none" stroke="#4a9bbf" stroke-width="4" stroke-linecap="round" stroke-linejoin="round"><rect x="4" y="28" width="56" height="22" rx="3"/><path d="M4 36h56"/><rect x="4" y="20" width="13" height="16" rx="3"/><rect x="47" y="20" width="13" height="16" rx="3"/><line x1="4" y1="50" x2="4" y2="58"/><line x1="60" y1="50" x2="60" y2="58"/></svg>';
            loader.appendChild(bed);
        } else {
            var sym = type===1 ? '♡' : 'z';
            var el=document.createElement('span');
            el.className='loader-bg-sym';
            el.textContent=sym;
            var fsz=(1.8+Math.random()*2.8).toFixed(1)+'rem';
            el.style.cssText='font-size:'+fsz+';left:'+lft+';top:'+top+';';
            el.style.setProperty('--dur',dur);
            el.style.setProperty('--del',del);
            el.style.setProperty('--op',op);
            loader.appendChild(el);
        }
    }

    var svg=document.createElementNS('http://www.w3.org/2000/svg','svg');
    svg.setAttribute('id','loader-svg');
    svg.setAttribute('viewBox','0 0 440 130');
    svg.setAttribute('width','clamp(280px,48vw,520px)');
    svg.setAttribute('height','auto');

    var defs=document.createElementNS('http://www.w3.org/2000/svg','defs');
    var grad=document.createElementNS('http://www.w3.org/2000/svg','linearGradient');
    grad.setAttribute('id','snorlax-fill-grad');
    grad.setAttribute('x1','0%'); grad.setAttribute('y1','0%');
    grad.setAttribute('x2','100%'); grad.setAttribute('y2','0%');
    var s1=document.createElementNS('http://www.w3.org/2000/svg','stop');
    s1.setAttribute('offset','0%'); s1.setAttribute('stop-color','#1a5a7a');
    var s2=document.createElementNS('http://www.w3.org/2000/svg','stop');
    s2.setAttribute('offset','100%'); s2.setAttribute('stop-color','#2a8aaa');
    grad.appendChild(s1); grad.appendChild(s2);
    defs.appendChild(grad);
    svg.appendChild(defs);

    var textEl=document.createElementNS('http://www.w3.org/2000/svg','text');
    textEl.setAttribute('x','220');
    textEl.setAttribute('y','100');
    textEl.setAttribute('text-anchor','middle');
    textEl.textContent='Snorlax';
    svg.appendChild(textEl);
    loader.appendChild(svg);

    /* ── ECG ── */
    var bottom = document.createElement('div');
    bottom.id = 'snorlax-loader-bottom';

    var ecgSvg = document.createElementNS('http://www.w3.org/2000/svg','svg');
    ecgSvg.setAttribute('id','ecg-svg');
    ecgSvg.setAttribute('viewBox','0 0 400 36');
    ecgSvg.setAttribute('preserveAspectRatio','none');
    var ecgPath = document.createElementNS('http://www.w3.org/2000/svg','path');
    ecgPath.setAttribute('id','ecg-path');
    ecgPath.setAttribute('d','M0 18');
    var ecgHead = document.createElementNS('http://www.w3.org/2000/svg','circle');
    ecgHead.setAttribute('id','ecg-head');
    ecgHead.setAttribute('r','3');
    ecgHead.setAttribute('cx','0');
    ecgHead.setAttribute('cy','18');
    ecgSvg.appendChild(ecgPath);
    ecgSvg.appendChild(ecgHead);
    bottom.appendChild(ecgSvg);
    loader.appendChild(bottom);

    /* pattern ECG: flat → onda P → spike QRS → onda T → flat */
    var ECG_PATTERN = [
        {x:0,  y:18},{x:30, y:18},{x:40, y:15},{x:50, y:21},
        {x:60, y:18},{x:70, y:18},{x:80, y:4}, {x:90, y:32},
        {x:100,y:18},{x:110,y:22},{x:120,y:14},{x:130,y:18},
        {x:160,y:18}
    ];
    var PATTERN_W = 160;

    function buildECGPath(progress) {
        var headX = progress * 400;
        var cycles = Math.ceil(headX / PATTERN_W) + 1;
        var points = [];
        for (var c = 0; c < cycles; c++) {
            var offsetX = headX - (cycles - 1 - c) * PATTERN_W - PATTERN_W;
            for (var p = 0; p < ECG_PATTERN.length; p++) {
                var px = offsetX + ECG_PATTERN[p].x;
                if (px >= -10 && px <= headX + 1) points.push({x: px, y: ECG_PATTERN[p].y});
            }
        }
        points.sort(function(a,b){ return a.x - b.x; });
        if (!points.length) return 'M0 18 L' + headX.toFixed(1) + ' 18';
        var d = 'M' + points[0].x.toFixed(1) + ' ' + points[0].y.toFixed(1);
        for (var i = 1; i < points.length; i++) d += ' L' + points[i].x.toFixed(1) + ' ' + points[i].y.toFixed(1);
        return d;
    }

    var rafEcg;
    var loadStart = Date.now();
    var TOTAL_DURATION_ECG = 2200 + 1800;

    function updateECG() {
        var elapsed = Date.now() - loadStart;
        var raw = Math.min(elapsed / TOTAL_DURATION_ECG, 1);
        ecgPath.setAttribute('d', buildECGPath(raw));
        var headX = raw * 400;
        ecgHead.setAttribute('cx', headX.toFixed(1));
        var modX = ((headX % PATTERN_W) + PATTERN_W) % PATTERN_W;
        var hy = 18;
        for (var p = 0; p < ECG_PATTERN.length - 1; p++) {
            if (modX >= ECG_PATTERN[p].x && modX <= ECG_PATTERN[p+1].x) {
                var t = (modX - ECG_PATTERN[p].x) / (ECG_PATTERN[p+1].x - ECG_PATTERN[p].x);
                hy = ECG_PATTERN[p].y + t * (ECG_PATTERN[p+1].y - ECG_PATTERN[p].y);
                break;
            }
        }
        ecgHead.setAttribute('cy', hy.toFixed(1));
        if (raw < 1) rafEcg = requestAnimationFrame(updateECG);
    }
    requestAnimationFrame(updateECG);

    document.body.insertBefore(loader,document.body.firstChild);

    var WRITE_DURATION = 2200;

    function startSequence(){
        var len=0;
        try{ len=textEl.getComputedTextLength(); }catch(e){}
        if(!len||len<20) len=900;

        textEl.style.strokeDasharray = len+'px';
        textEl.style.strokeDashoffset = len+'px';
        textEl.style.transition = 'none';
        void textEl.getBoundingClientRect();
        textEl.style.transition = 'stroke-dashoffset '+( WRITE_DURATION/1000 )+'s cubic-bezier(0.4,0,0.15,1)';
        requestAnimationFrame(function(){
            textEl.style.strokeDashoffset = '0px';
        });

        setTimeout(function(){
            var clipId = 'snorlax-clip-'+Date.now();
            var clipEl = document.createElementNS('http://www.w3.org/2000/svg','clipPath');
            clipEl.setAttribute('id', clipId);
            var clipRect = document.createElementNS('http://www.w3.org/2000/svg','rect');
            clipRect.setAttribute('x','-10'); clipRect.setAttribute('y','-20');
            clipRect.setAttribute('width','0'); clipRect.setAttribute('height','200');
            clipEl.appendChild(clipRect);
            defs.appendChild(clipEl);

            var filledText = document.createElementNS('http://www.w3.org/2000/svg','text');
            filledText.setAttribute('x','220'); filledText.setAttribute('y','100');
            filledText.setAttribute('text-anchor','middle');
            filledText.setAttribute('clip-path','url(#'+clipId+')');
            filledText.textContent = 'Snorlax';
            filledText.style.cssText = 'font-family:"Great Vibes",cursive;font-size:108px;fill:url(#snorlax-fill-grad);stroke:none;';
            svg.appendChild(filledText);

            var start = null, totalW = 460, fillDur = 900;
            function animFill(ts){
                if(!start) start = ts;
                var p = Math.min((ts-start)/fillDur, 1);
                var e = p<0.5 ? 4*p*p*p : 1-Math.pow(-2*p+2,3)/2;
                clipRect.setAttribute('width', (e * totalW).toFixed(1));
                if(p < 1) requestAnimationFrame(animFill);
                else { filledText.removeAttribute('clip-path'); textEl.style.transition = 'opacity 0.5s ease'; textEl.style.opacity = '0.18'; }
            }
            requestAnimationFrame(animFill);
        }, WRITE_DURATION + 80);
    }

    if(document.fonts&&document.fonts.load){
        document.fonts.load('108px "Great Vibes"').then(startSequence).catch(function(){ setTimeout(startSequence,400); });
    } else { setTimeout(startSequence,500); }

    var loaded = false;
    var startTime = Date.now();

    function finish(){
        if(loaded) return; loaded = true;
        cancelAnimationFrame(rafEcg);
        loader.classList.add('fade-out');
        setTimeout(function(){ loader.style.display='none'; }, 1050);

        var overlay = document.createElement('div');
        overlay.id = 'snorlax-heart-overlay';
        var hSvg = document.createElementNS('http://www.w3.org/2000/svg','svg');
        hSvg.setAttribute('viewBox','0 0 100 100');
        hSvg.style.cssText = 'width:80px;height:80px;display:block;transform:scale(0);transition:transform 0.5s cubic-bezier(0.22,1,0.36,1);';
        var hPath = document.createElementNS('http://www.w3.org/2000/svg','path');
        hPath.setAttribute('d','M50 85 C50 85 10 55 10 30 C10 18 18 10 30 10 C38 10 45 15 50 22 C55 15 62 10 70 10 C82 10 90 18 90 30 C90 55 50 85 50 85Z');
        hPath.setAttribute('fill','#0a1628');
        hSvg.appendChild(hPath);
        overlay.appendChild(hSvg);
        document.body.appendChild(overlay);

        requestAnimationFrame(function(){ requestAnimationFrame(function(){
            var scale = (Math.sqrt(window.innerWidth*window.innerWidth + window.innerHeight*window.innerHeight) / 80) * 2.2;
            hSvg.style.transform = 'scale('+scale+')';
            setTimeout(function(){
                overlay.style.background = '#0a1628';
                setTimeout(function(){
                    hSvg.style.transition = 'transform 0.5s cubic-bezier(0.55,0,1,0.45)';
                    hSvg.style.transform = 'scale(0)';
                    setTimeout(function(){
                        overlay.style.transition = 'opacity 0.4s ease';
                        overlay.style.opacity = '0';
                        setTimeout(function(){ overlay.remove(); }, 420);
                    }, 500);
                }, 150);
            }, 520);
        }); });
    }

    window.addEventListener('load', function(){
        var elapsed = Date.now() - startTime;
        setTimeout(finish, Math.max(0, (WRITE_DURATION + 1800) - elapsed));
    });
    setTimeout(finish, 7000);
})();

// ── 2. Testo Follower "Rlax!" (Invariato) ──────────────────────────────────────
(function() {
    var style = document.createElement('style');
    style.textContent = [
        '.cursor-rlax {',
        '  position: fixed; top: 0; left: 0; pointer-events: none; z-index: 999999;',
        '  font-family: "Great Vibes", cursive;',
        '  font-size: 16px; color: #2a6a8a;',
        '  white-space: nowrap; opacity: 0;',
        '  transition: opacity 0.3s ease-in-out;',
        '  text-shadow: 1px 1px 2px rgba(255,255,255,0.8);',
        '}'
    ].join('\n');
    document.head.appendChild(style);

    var rlax = document.createElement('div');
    rlax.className = 'cursor-rlax';
    rlax.textContent = 'Rlax!';
    document.body.appendChild(rlax);

    var mouseX = 0, mouseY = 0;
    var currentX = 0, currentY = 0;

    document.addEventListener('mousemove', function(e) {
        mouseX = e.clientX;
        mouseY = e.clientY;
        rlax.style.opacity = "1";
    });

    function animate() {
        currentX += (mouseX - currentX) * 0.15;
        currentY += (mouseY - currentY) * 0.15;
        rlax.style.transform = 'translate(' + (currentX + 12) + 'px, ' + (currentY + 12) + 'px)';
        requestAnimationFrame(animate);
    }
    animate();
})();

// ── 3. Toggle Menu Mobile (Invariato) ──────────────────────────────────────
(function(){
    var toggle = document.getElementById('nav-toggle');
    var menu   = document.getElementById('nav-menu');
    if(!toggle || !menu) return;
    toggle.addEventListener('click', function(){
        var open = menu.classList.toggle('open');
        toggle.classList.toggle('open', open);
        toggle.setAttribute('aria-expanded', open);
    });
})();

// ── 4. Scroll reveal (Invariato) ──────────────────────────────────────
(function(){
    var style = document.createElement('style');
    style.textContent = [
        '.reveal { opacity: 0; transform: translateY(40px); transition: opacity 1.0s cubic-bezier(0.22, 1, 0.36, 1), transform 1.0s cubic-bezier(0.22, 1, 0.36, 1); will-change: opacity, transform; }',
        '.reveal.visible { opacity: 1; transform: translateY(0); }',
        '.reveal-delay-1 { transition-delay: 0.12s; }',
        '.reveal-delay-2 { transition-delay: 0.24s; }',
        '.reveal-delay-3 { transition-delay: 0.36s; }',
        '.reveal-delay-4 { transition-delay: 0.48s; }',
        '@media (prefers-reduced-motion: reduce) { .reveal { opacity: 1; transform: none; transition: none; } }'
    ].join('\n');
    document.head.appendChild(style);

    var selectors = [
        'section .section-etichetta', 'section h1', 'section h2', 'section h3',
        'section .section-descrizione', 'section p:not(.card-content p)',
        '.feature-card', '.model-card-preview', '.scheda-modello',
        '.faq-card', '.contatto-card', '.footer-colonna',
        '.dashboard-testo', '.dashboard-mockup', '.section-invito', '.section-buttons',
        '.btn-principale', '.btn-preview'
    ].join(', ');

    if ('IntersectionObserver' in window) {
        var observer = new IntersectionObserver(function(entries) {
            entries.forEach(function(entry) {
                if (entry.isIntersecting) {
                    entry.target.classList.add('visible');
                    observer.unobserve(entry.target);
                }
            });
        }, { threshold: 0.12 });

        window.addEventListener('load', function() {
            document.querySelectorAll(selectors).forEach(function(el) {
                el.classList.add('reveal');
                observer.observe(el);
            });
        });
    }
})();

// ── 5. Smooth scrolling (Invariato) ──────────────────────────────────────
(function(){
    function scrollToAnchor(hash) {
        var target = document.querySelector(hash);
        if (!target) return;
        var navbarHeight = (document.getElementById('navbar') || {offsetHeight: 0}).offsetHeight;
        var targetPosition = target.getBoundingClientRect().top + window.pageYOffset - navbarHeight - 16;
        window.scrollTo({ top: targetPosition, behavior: 'smooth' });
    }

    document.addEventListener('click', function(e) {
        var link = e.target.closest('a[href]');
        if (!link) return;
        var href = link.getAttribute('href');
        if (!href || !href.includes('#')) return;
        var hash = href.substring(href.indexOf('#'));
        var path = href.substring(0, href.indexOf('#'));
        var currentPath = window.location.pathname.split('/').pop() || '';
        var linkPage = path.split('/').pop() || '';
        if (path === '' || linkPage === currentPath) {
            var target = document.querySelector(hash);
            if (target) { e.preventDefault(); scrollToAnchor(hash); history.pushState(null, '', hash); }
        }
    });

    if (window.location.hash) {
        window.addEventListener('load', function() { setTimeout(function() { scrollToAnchor(window.location.hash); }, 100); });
    }
})();

// ── 6. Nuova Transizione Cuore per Navigazione ──────────────────────────────
(function() {
    // Intercettiamo tutti i link del footer (Home, Prodotti, Contatti, ecc.)
    document.querySelectorAll('footer a').forEach(function(link) {
        link.addEventListener('click', function(e) {
            var href = this.getAttribute('href');
            
            // Se è un ancora interna alla stessa pagina, lasciamo fare allo smooth scroll
            if (!href || href.startsWith('#') || href.includes(window.location.pathname + '#')) return;

            e.preventDefault(); // Blocchiamo la navigazione immediata

            // Creiamo l'overlay del cuore blu
            var overlay = document.createElement('div');
            overlay.id = 'snorlax-heart-overlay';
            overlay.style.cssText = 'position:fixed;inset:0;z-index:10000;display:flex;align-items:center;justify-content:center;pointer-events:none;overflow:hidden;background:transparent;';
            
            var hSvg = document.createElementNS('http://www.w3.org/2000/svg','svg');
            hSvg.setAttribute('viewBox','0 0 100 100');
            hSvg.style.cssText = 'width:80px;height:80px;display:block;transform:scale(0);transition:transform 0.6s cubic-bezier(0.22,1,0.36,1);';
            
            var hPath = document.createElementNS('http://www.w3.org/2000/svg','path');
            hPath.setAttribute('d','M50 85 C50 85 10 55 10 30 C10 18 18 10 30 10 C38 10 45 15 50 22 C55 15 62 10 70 10 C82 10 90 18 90 30 C90 55 50 85 50 85Z');
            hPath.setAttribute('fill','#0a1628'); // Blu scuro Snorlax
            
            hSvg.appendChild(hPath);
            overlay.appendChild(hSvg);
            document.body.appendChild(overlay);

            // Avviamo l'animazione di espansione
            requestAnimationFrame(function(){
                requestAnimationFrame(function(){
                    var scale = (Math.sqrt(window.innerWidth*window.innerWidth + window.innerHeight*window.innerHeight) / 80) * 2.5;
                    hSvg.style.transform = 'scale(' + scale + ')';
                    
                    // Quando lo schermo è coperto (circa 550ms), cambiamo pagina
                    setTimeout(function(){
                        overlay.style.background = '#0a1628'; // Copertura totale per sicurezza
                        window.location.href = href;
                    }, 550);
                });
            });
        });
    });
})();
</script>
</body>
</html>