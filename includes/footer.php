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
</script>
</body>
</html>
