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

// Scroll reveal professionale: fade + slide fluido con easing cubic-bezier
(function(){
    var style = document.createElement('style');
    style.textContent = [
        '.reveal {',
        '  opacity: 0;',
        '  transform: translateY(40px);',
        '  transition: opacity 1.0s cubic-bezier(0.22, 1, 0.36, 1),',
        '              transform 1.0s cubic-bezier(0.22, 1, 0.36, 1);',
        '  will-change: opacity, transform;',
        '}',
        '.reveal.visible {',
        '  opacity: 1;',
        '  transform: translateY(0);',
        '}',
        '.reveal-delay-1 { transition-delay: 0.12s; }',
        '.reveal-delay-2 { transition-delay: 0.24s; }',
        '.reveal-delay-3 { transition-delay: 0.36s; }',
        '.reveal-delay-4 { transition-delay: 0.48s; }',
        /* Rispetta preferenze accessibilità utente */
        '@media (prefers-reduced-motion: reduce) {',
        '  .reveal { opacity: 1; transform: none; transition: none; }',
        '}'
    ].join('\n');
    document.head.appendChild(style);

    var selectors = [
        'section .section-etichetta',
        'section h1', 'section h2', 'section h3',
        'section .section-descrizione',
        'section p:not(.card-content p)',
        '.feature-card', '.model-card-preview', '.scheda-modello',
        '.faq-card', '.contatto-card', '.footer-colonna',
        '.dashboard-testo', '.dashboard-mockup',
        '.section-invito', '.section-buttons',
        '.btn-principale', '.btn-preview'
    ].join(', ');

    // Usa IntersectionObserver se disponibile (più performante)
    var useObserver = 'IntersectionObserver' in window;

    function addRevealClass(el, siblings) {
        var rect = el.getBoundingClientRect();
        // Salta elementi già in vista al caricamento
        if (rect.top < window.innerHeight * 0.95) return;
        el.classList.add('reveal');
        var revealSiblings = Array.from(siblings).filter(function(s) {
            return s.classList.contains('reveal');
        });
        var idx = revealSiblings.indexOf(el);
        if (idx >= 1 && idx <= 4) el.classList.add('reveal-delay-' + idx);
    }

    function applyReveal() {
        var elements = document.querySelectorAll(selectors);
        elements.forEach(function(el) {
            var siblings = el.parentElement
                ? el.parentElement.querySelectorAll(selectors)
                : [];
            addRevealClass(el, siblings);
        });
    }

    if (useObserver) {
        var observer = new IntersectionObserver(function(entries) {
            entries.forEach(function(entry) {
                if (entry.isIntersecting) {
                    entry.target.classList.add('visible');
                    observer.unobserve(entry.target); // Anima una volta sola
                }
            });
        }, { threshold: 0.12 });

        window.addEventListener('load', function() {
            applyReveal();
            document.querySelectorAll('.reveal').forEach(function(el) {
                observer.observe(el);
            });
        });
    } else {
        // Fallback per browser vecchi
        function onScroll() {
            document.querySelectorAll('.reveal:not(.visible)').forEach(function(el) {
                if (el.getBoundingClientRect().top < window.innerHeight * 0.88) {
                    el.classList.add('visible');
                }
            });
        }
        window.addEventListener('load', function() {
            applyReveal();
            onScroll();
            window.addEventListener('scroll', onScroll, { passive: true });
        });
    }
})();

// Smooth scrolling per link con anchor (#)
(function(){
    function scrollToAnchor(hash) {
        var target = document.querySelector(hash);
        if (!target) return;
        var navbarHeight = (document.getElementById('navbar') || {offsetHeight: 0}).offsetHeight;
        var targetPosition = target.getBoundingClientRect().top + window.pageYOffset - navbarHeight - 16;
        window.scrollTo({ top: targetPosition, behavior: 'smooth' });
    }

    // Gestisce click su link ancora nella stessa pagina
    document.addEventListener('click', function(e) {
        var link = e.target.closest('a[href]');
        if (!link) return;

        var href = link.getAttribute('href');
        if (!href) return;

        // Estrai la parte dopo il #
        var hashIndex = href.indexOf('#');
        if (hashIndex === -1) return;

        var hash = href.substring(hashIndex);
        var path = href.substring(0, hashIndex);

        // Verifica se il link punta alla pagina corrente (o è solo un anchor)
        var currentPath = window.location.pathname.split('/').pop() || '';
        var linkPage    = path.split('/').pop() || '';

        if (path === '' || linkPage === currentPath || path === '#') {
            var target = document.querySelector(hash);
            if (target) {
                e.preventDefault();
                scrollToAnchor(hash);
                history.pushState(null, '', hash);
            }
        }
    });

    // Se la pagina viene caricata con un anchor nell'URL, scrolla con animazione
    if (window.location.hash) {
        window.addEventListener('load', function() {
            setTimeout(function() {
                scrollToAnchor(window.location.hash);
            }, 100);
        });
    }
})();
</script>
</body>
</html>
