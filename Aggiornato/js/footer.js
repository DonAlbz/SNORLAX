// ── 1. Snorlax Loader (Implementato con Libreria GSAP)
(function () {
    if (sessionStorage.getItem('snorlax-loaded')) return;
    sessionStorage.setItem('snorlax-loaded', '1');

    var style = document.createElement('style');
    style.textContent = [
        '#snorlax-loader{position:fixed;inset:0;z-index:9999;display:flex;flex-direction:column;align-items:center;justify-content:center;background:radial-gradient(ellipse at center,#ffffff 0%,#eaf6ff 50%,#c8e4f5 100%);overflow:hidden;}',
        '.loader-bg-sym{position:absolute;pointer-events:none;font-family:"Great Vibes",cursive;color:#4a9bbf;line-height:1;opacity:0;}',
        '.loader-bg-bed{position:absolute;pointer-events:none;opacity:0;}',
        '#loader-svg text{font-family:"Great Vibes",cursive;font-size:108px;fill:transparent;stroke:#2a6a8a;stroke-width:1.4;stroke-linecap:round;stroke-linejoin:round;paint-order:stroke fill;}',
        '#snorlax-heart-overlay{position:fixed;inset:0;z-index:10000;display:flex;align-items:center;justify-content:center;pointer-events:none;overflow:hidden;background:transparent;}',
        '#snorlax-loader-bottom{display:flex;flex-direction:column;align-items:center;margin-top:-8px;width:clamp(220px,40vw,400px);}',
        '#ecg-svg{display:block;width:100%;height:36px;overflow:visible;}',
        '#ecg-path{fill:none;stroke:#2a8aaa;stroke-width:2;stroke-linecap:round;stroke-linejoin:round;}',
        '#ecg-head{fill:#2a8aaa;}'
    ].join('\n');
    document.head.appendChild(style);

    var ECG_PATTERN = [
        { x: 0, y: 18 }, { x: 30, y: 18 }, { x: 40, y: 15 }, { x: 50, y: 21 },
        { x: 60, y: 18 }, { x: 70, y: 18 }, { x: 80, y: 4 }, { x: 90, y: 32 },
        { x: 100, y: 18 }, { x: 110, y: 22 }, { x: 120, y: 14 }, { x: 130, y: 18 },
        { x: 160, y: 18 }
    ];
    var PATTERN_W = 160;

    function buildECGPath(progress) {
        var headX = progress * 400;
        var cycles = Math.ceil(headX / PATTERN_W) + 1;
        var points = [];
        for (var c = 0; c < cycles; c++) {
            var offsetX = headX - (cycles - 1 - c) * PATTERN_W - PATTERN_W;
            ECG_PATTERN.forEach(function (pt) {
                var px = offsetX + pt.x;
                if (px >= -10 && px <= headX + 1) points.push({ x: px, y: pt.y });
            });
        }
        points.sort(function (a, b) { return a.x - b.x; });
        if (!points.length) return 'M0 18 L' + (progress * 400).toFixed(1) + ' 18';
        return 'M' + points.map(function (p) { return p.x.toFixed(1) + ' ' + p.y.toFixed(1); }).join(' L');
    }

    function getECGHeadY(headX) {
        var modX = ((headX % PATTERN_W) + PATTERN_W) % PATTERN_W;
        for (var p = 0; p < ECG_PATTERN.length - 1; p++) {
            if (modX >= ECG_PATTERN[p].x && modX <= ECG_PATTERN[p + 1].x) {
                var t = (modX - ECG_PATTERN[p].x) / (ECG_PATTERN[p + 1].x - ECG_PATTERN[p].x);
                return ECG_PATTERN[p].y + t * (ECG_PATTERN[p + 1].y - ECG_PATTERN[p].y);
            }
        }
        return 18;
    }

    function buildDOM() {
        var loader = document.createElement('div');
        loader.id = 'snorlax-loader';
        loader.setAttribute('aria-hidden', 'true');

        var cols = 8, rows = 7, cellW = 100 / cols, cellH = 100 / rows;
        for (var i = 0; i < cols * rows; i++) {
            var col = i % cols, row = Math.floor(i / cols);
            var lft = (col * cellW + Math.random() * cellW * 0.6 + cellW * 0.15).toFixed(1) + '%';
            var top = (row * cellH + Math.random() * cellH * 0.6 + cellH * 0.15).toFixed(1) + '%';
            var type = i % 4;
            if (type === 3) {
                var sz = (28 + Math.random() * 20).toFixed(0) + 'px';
                var bed = document.createElement('div');
                bed.className = 'loader-bg-bed';
                bed.style.cssText = 'left:' + lft + ';top:' + top + ';width:' + sz + ';height:' + sz + ';';
                bed.innerHTML = '<svg viewBox="0 0 64 64" width="' + sz + '" height="' + sz + '" xmlns="http://www.w3.org/2000/svg" fill="none" stroke="#4a9bbf" stroke-width="4" stroke-linecap="round" stroke-linejoin="round"><rect x="4" y="28" width="56" height="22" rx="3"/><path d="M4 36h56"/><rect x="4" y="20" width="13" height="16" rx="3"/><rect x="47" y="20" width="13" height="16" rx="3"/><line x1="4" y1="50" x2="4" y2="58"/><line x1="60" y1="50" x2="60" y2="58"/></svg>';
                loader.appendChild(bed);
            } else {
                var el = document.createElement('span');
                el.className = 'loader-bg-sym';
                el.textContent = type === 1 ? '♡' : 'z';
                el.style.cssText = 'font-size:' + (1.8 + Math.random() * 2.8).toFixed(1) + 'rem;left:' + lft + ';top:' + top + ';';
                loader.appendChild(el);
            }
        }

        var svg = document.createElementNS('http://www.w3.org/2000/svg', 'svg');
        svg.setAttribute('id', 'loader-svg');
        svg.setAttribute('viewBox', '0 0 440 130');
        svg.setAttribute('width', 'clamp(280px,48vw,520px)');
        svg.setAttribute('height', 'auto');

        var defs = document.createElementNS('http://www.w3.org/2000/svg', 'defs');
        var grad = document.createElementNS('http://www.w3.org/2000/svg', 'linearGradient');
        grad.setAttribute('id', 'snorlax-fill-grad');
        grad.setAttribute('x1', '0%'); grad.setAttribute('y1', '0%');
        grad.setAttribute('x2', '100%'); grad.setAttribute('y2', '0%');
        [['0%', '#1a5a7a'], ['100%', '#2a8aaa']].forEach(function (s) {
            var stop = document.createElementNS('http://www.w3.org/2000/svg', 'stop');
            stop.setAttribute('offset', s[0]); stop.setAttribute('stop-color', s[1]);
            grad.appendChild(stop);
        });
        defs.appendChild(grad);
        svg.appendChild(defs);

        var textEl = document.createElementNS('http://www.w3.org/2000/svg', 'text');
        textEl.setAttribute('x', '220'); textEl.setAttribute('y', '100');
        textEl.setAttribute('text-anchor', 'middle');
        textEl.textContent = 'Snorlax';
        svg.appendChild(textEl);
        loader.appendChild(svg);

        var bottom = document.createElement('div');
        bottom.id = 'snorlax-loader-bottom';
        var ecgSvg = document.createElementNS('http://www.w3.org/2000/svg', 'svg');
        ecgSvg.setAttribute('id', 'ecg-svg');
        ecgSvg.setAttribute('viewBox', '0 0 400 36');
        ecgSvg.setAttribute('preserveAspectRatio', 'none');
        var ecgPath = document.createElementNS('http://www.w3.org/2000/svg', 'path');
        ecgPath.setAttribute('id', 'ecg-path'); ecgPath.setAttribute('d', 'M0 18');
        var ecgHead = document.createElementNS('http://www.w3.org/2000/svg', 'circle');
        ecgHead.setAttribute('id', 'ecg-head'); ecgHead.setAttribute('r', '3');
        ecgHead.setAttribute('cx', '0'); ecgHead.setAttribute('cy', '18');
        ecgSvg.appendChild(ecgPath); ecgSvg.appendChild(ecgHead);
        bottom.appendChild(ecgSvg);
        loader.appendChild(bottom);
        document.body.insertBefore(loader, document.body.firstChild);

        return { loader, svg, defs, textEl, ecgPath, ecgHead };
    }

    function buildAndStart() {
        var WRITE = 3.0;
        var { loader, svg, defs, textEl, ecgPath, ecgHead } = buildDOM();

        gsap.fromTo('.loader-bg-sym, .loader-bg-bed',
            { opacity: 0, y: 0, scale: 0.88 },
            {
                opacity: function () { return 0.28 + Math.random() * 0.32; },
                y: -28, scale: 1.08,
                duration: function () { return 1.2 + Math.random() * 0.8; },
                ease: 'sine.inOut',
                stagger: { each: 0.06, from: 'random' },
                yoyo: true, repeat: -1
            }
        );

        var ecgProxy = { progress: 0 };
        gsap.to(ecgProxy, {
            progress: 1,
            duration: WRITE + 1.8,
            ease: 'none',
            onUpdate: function () {
                var hx = ecgProxy.progress * 400;
                ecgPath.setAttribute('d', buildECGPath(ecgProxy.progress));
                ecgHead.setAttribute('cx', hx.toFixed(1));
                ecgHead.setAttribute('cy', getECGHeadY(hx).toFixed(1));
            }
        });

        // aspetta font + un frame di rendering prima di misurare il testo
        document.fonts.load('108px "Great Vibes"').then(function () {
            return document.fonts.ready;
        }).then(function () {
            requestAnimationFrame(function () {
                requestAnimationFrame(function () {
                    var len = 0;
                    try { len = textEl.getComputedTextLength(); } catch (e) { }
                    if (!len || len < 20) len = 900;

                    var clipId = 'snorlax-clip-' + Date.now();
                    var clipEl = document.createElementNS('http://www.w3.org/2000/svg', 'clipPath');
                    clipEl.setAttribute('id', clipId);
                    var clipRect = document.createElementNS('http://www.w3.org/2000/svg', 'rect');
                    clipRect.setAttribute('x', '-10'); clipRect.setAttribute('y', '-20');
                    clipRect.setAttribute('width', '0'); clipRect.setAttribute('height', '200');
                    clipEl.appendChild(clipRect);
                    defs.appendChild(clipEl);

                    var filledText = document.createElementNS('http://www.w3.org/2000/svg', 'text');
                    filledText.setAttribute('x', '220'); filledText.setAttribute('y', '100');
                    filledText.setAttribute('text-anchor', 'middle');
                    filledText.setAttribute('clip-path', 'url(#' + clipId + ')');
                    filledText.textContent = 'Snorlax';
                    filledText.style.cssText = 'font-family:"Great Vibes",cursive;font-size:108px;fill:url(#snorlax-fill-grad);stroke:none;';
                    svg.appendChild(filledText);

                    var overlay = document.createElement('div');
                    overlay.id = 'snorlax-heart-overlay';
                    overlay.style.cssText = 'position:fixed;inset:0;z-index:10000;display:flex;align-items:center;justify-content:center;pointer-events:none;overflow:hidden;background:transparent;opacity:0;';
                    var hSvg = document.createElementNS('http://www.w3.org/2000/svg', 'svg');
                    hSvg.setAttribute('viewBox', '0 0 100 100');
                    hSvg.style.cssText = 'width:80px;height:80px;display:block;';
                    var hPath = document.createElementNS('http://www.w3.org/2000/svg', 'path');
                    hPath.setAttribute('d', 'M50 85 C50 85 10 55 10 30 C10 18 18 10 30 10 C38 10 45 15 50 22 C55 15 62 10 70 10 C82 10 90 18 90 30 C90 55 50 85 50 85Z');
                    hPath.setAttribute('fill', '#0a1628');
                    hSvg.appendChild(hPath);
                    overlay.appendChild(hSvg);
                    document.body.appendChild(overlay);

                    var scale = Math.sqrt(window.innerWidth ** 2 + window.innerHeight ** 2) / 80 * 2.2;

                    gsap.timeline()
                        .set(textEl, { strokeDasharray: len, strokeDashoffset: len })
                        .to(textEl, { strokeDashoffset: 0, duration: WRITE, ease: 'power2.inOut' })
                        .to(clipRect, { attr: { width: 460 }, duration: 0.9, ease: 'power3.inOut' })
                        .add(function () { filledText.removeAttribute('clip-path'); })
                        .to(textEl, { opacity: 0.18, duration: 0.5, ease: 'power1.out' }, '<')
                        .to(loader, {
                            opacity: 0,
                            duration: 1.2,
                            ease: 'power2.out',
                            onStart: function () {
                                // overlay visibile subito
                                gsap.set(overlay, { opacity: 1 });

                                // cuore parte mentre il loader svanisce
                                gsap.fromTo(hSvg, { scale: 0 }, {
                                    scale: scale,
                                    duration: 0.6,
                                    ease: 'power2.out'
                                });
                            },
                            onComplete: function () {
                                loader.style.display = 'none';
                            }
                        })
                        .set(overlay, { backgroundColor: '#0a1628' })
                        .to(hSvg, { scale: 0, duration: 0.5, ease: 'power2.in' }, '+=0.15')
                        .to(overlay, {
                            opacity: 0, duration: 0.4, ease: 'power1.out',
                            onComplete: function () { overlay.remove(); }
                        });
                });
            });
        }).catch(function () { setTimeout(buildAndStart, 400); });
    }
    buildAndStart();
})();

// ── 2. Testo Follower "Rlax!" 
(function () {
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

    var moveX = gsap.quickTo(rlax, 'x', { duration: 0.5, ease: 'power2.out' });
    var moveY = gsap.quickTo(rlax, 'y', { duration: 0.5, ease: 'power2.out' });
    var initialized = false;

    document.addEventListener('mousemove', function (e) {
        if (!initialized) {
            gsap.set(rlax, { x: e.clientX + 12, y: e.clientY + 12 });
            initialized = true;
            requestAnimationFrame(function () {
                rlax.style.transition = 'opacity 0.3s ease-in-out';
                rlax.style.opacity = '1';
            });
        } else {
            moveX(e.clientX + 12);
            moveY(e.clientY + 12);
        }
    });
})();

// ── 3. Toggle Menu Mobile 
(function () {
    var toggle = document.getElementById('nav-toggle');
    var menu = document.getElementById('nav-menu');
    if (!toggle || !menu) return;
    toggle.addEventListener('click', function () {
        var open = menu.classList.toggle('open');
        toggle.classList.toggle('open', open);
        toggle.setAttribute('aria-expanded', open);
    });
})();

// ── 4. Scroll reveal 
(function () {
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
        var observer = new IntersectionObserver(function (entries) {
            entries.forEach(function (entry) {
                if (entry.isIntersecting) {
                    entry.target.classList.add('visible');
                    observer.unobserve(entry.target);
                }
            });
        }, {
            threshold: 0.12
        });

        window.addEventListener('load', function () {
            document.querySelectorAll(selectors).forEach(function (el) {
                el.classList.add('reveal');
                observer.observe(el);
            });
        });
    }
})();

// ── 5. Smooth scroll + history
(function () {
    document.addEventListener('click', function (e) {
        var link = e.target.closest('a[href]');
        if (!link) return;
        var href = link.getAttribute('href');
        if (!href || !href.includes('#')) return;
        var hash = href.substring(href.indexOf('#'));
        var path = href.substring(0, href.indexOf('#'));
        var currentPath = window.location.pathname.split('/').pop() || '';
        var linkPage = path.split('/').pop() || '';
        if (path === '' || linkPage === currentPath) {
            if (document.querySelector(hash)) history.pushState(null, '', hash);
        }
    });
})();
// ── Scroll padding dinamico
(function () {
    function updateScrollPadding() {
        var navbar = document.getElementById('navbar');
        if (!navbar) return;
        document.documentElement.style.setProperty(
            'scroll-padding-top',
            (navbar.offsetHeight + 16) + 'px'
        );
    }
    updateScrollPadding();
    window.addEventListener('resize', updateScrollPadding);
})();

// ── 6. Transizione Cuore per Navigazione (Implementato con libreria GSAP)
(function () {
    document.querySelectorAll('footer a, .heart-click').forEach(function (link) {
        link.addEventListener('click', function (e) {
            var href = this.getAttribute('href');
            if (!href || href.startsWith('#') || href.includes(window.location.pathname + '#')) return;
            e.preventDefault();

            var overlay = document.createElement('div');
            overlay.style.cssText = 'position:fixed;inset:0;z-index:10000;display:flex;align-items:center;justify-content:center;pointer-events:none;overflow:hidden;background:transparent;';
            var hSvg = document.createElementNS('http://www.w3.org/2000/svg', 'svg');
            hSvg.setAttribute('viewBox', '0 0 100 100');
            hSvg.style.cssText = 'width:80px;height:80px;display:block;';
            var hPath = document.createElementNS('http://www.w3.org/2000/svg', 'path');
            hPath.setAttribute('d', 'M50 85 C50 85 10 55 10 30 C10 18 18 10 30 10 C38 10 45 15 50 22 C55 15 62 10 70 10 C82 10 90 18 90 30 C90 55 50 85 50 85Z');
            hPath.setAttribute('fill', '#0a1628');
            hSvg.appendChild(hPath);
            overlay.appendChild(hSvg);
            document.body.appendChild(overlay);

            var scale = Math.sqrt(window.innerWidth ** 2 + window.innerHeight ** 2) / 80 * 2.5;

            gsap.timeline()
                .fromTo(hSvg, { scale: 0 }, { scale: scale, duration: 0.6, ease: 'power2.out' })
                .set(overlay, { backgroundColor: '#0a1628' })
                .add(function () { window.location.href = href; });
        });
    });
})();