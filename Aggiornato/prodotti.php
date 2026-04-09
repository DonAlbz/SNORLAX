<?php
require_once 'config.php';
$page_title = 'Snorlax - '.t('products_page');
$current_page = 'prodotti';
$page_css = ['css/style_prodotti.css'];
include 'includes/header.php';
?>
<section class="intestazione"><h1><?= e(t('products_title')) ?> <em><?= e(t('products_title_em')) ?></em></h1><p><?= e(t('products_sub')) ?></p></section>
<section class="sezione-modelli">
    <div class="scheda-modello" id="sense">
        <div class="immagine-modello"><div class="immagine-modello" style="background-image:url('img/Sense.jpeg');"><span class="intestazione-modello"><?= e(t('sleep_sensors')) ?></span></div></div>
        <div class="info-modello"><div class="numero-modello"><?= e(t('model_01')) ?></div><div class="nome-modello">Snorlax Sense</div><div class="slogan-modello"><?= e(t('sleep_analyzed')) ?></div><p class="descrizione-modello"><?= e(t('sense_long')) ?></p><ul class="caratteristiche-modello"><li><?= e(t('sense_f1')) ?></li><li><?= e(t('sense_f2')) ?></li><li><?= e(t('sense_f3')) ?></li><li><?= e(t('sense_f4')) ?></li><li><?= e(t('sense_f5')) ?></li><li><?= e(t('sense_f6')) ?></li></ul><div class="prezzi-modello"><div class="blocco-prezzi"><span class="prezzo">€1.200</span><span class="nota-prezzo"><?= e(t('vat_shipping')) ?></span></div><div class="azioni-modello"><a href="<?= e(url_with_lang('login.php')) ?>" class="btn-principale"><span><?= e(t('buy')) ?></span></a><a href="<?= e(url_with_lang('login.php')) ?>" class="btn-secondario"><?= e(t('plus_subscription')) ?></a></div></div></div>
    </div>
    <div class="scheda-modello" id="vision">
        <div class="immagine-modello"><div class="immagine-modello" style="background-image:url('img/Vision.jpeg');"><span class="intestazione-modello"><?= e(t('integrated_monitor')) ?></span></div></div>
        <div class="info-modello"><div class="numero-modello"><?= e(t('model_02')) ?></div><div class="nome-modello">Snorlax Vision</div><div class="slogan-modello"><?= e(t('vision_slogan')) ?></div><p class="descrizione-modello"><?= e(t('vision_long')) ?></p><ul class="caratteristiche-modello"><li><?= e(t('vision_f1')) ?></li><li><?= e(t('vision_f2')) ?></li><li><?= e(t('vision_f3')) ?></li><li><?= e(t('vision_f4')) ?></li><li><?= e(t('vision_f5')) ?></li><li><?= e(t('vision_f6')) ?></li></ul><div class="prezzi-modello"><div class="blocco-prezzi"><span class="prezzo">€1.500</span><span class="nota-prezzo"><?= e(t('vat_shipping')) ?></span></div><div class="azioni-modello"><a href="<?= e(url_with_lang('login.php')) ?>" class="btn-principale"><span><?= e(t('buy')) ?></span></a><a href="<?= e(url_with_lang('login.php')) ?>" class="btn-secondario"><?= e(t('plus_subscription')) ?></a></div></div></div>
    </div>
    <div class="scheda-modello" id="dream">
        <div class="immagine-modello"><div class="immagine-modello" style="background-image:url('img/Dream.jpeg');"><span class="intestazione-modello"><?= e(t('complete_solution')) ?></span></div></div>
        <div class="info-modello"><div class="numero-modello"><?= e(t('model_03')) ?></div><div class="nome-modello">Snorlax Dream</div><div class="slogan-modello"><?= e(t('dream_slogan')) ?></div><p class="descrizione-modello"><?= e(t('dream_long')) ?></p><ul class="caratteristiche-modello"><li><?= e(t('dream_f1')) ?></li><li><?= e(t('dream_f2')) ?></li><li><?= e(t('dream_f3')) ?></li><li><?= e(t('dream_f4')) ?></li><li><?= e(t('dream_f5')) ?></li></ul><div class="prezzi-modello"><div class="blocco-prezzi"><span class="prezzo">€2.200</span><span class="nota-prezzo"><?= e(t('vat_shipping')) ?></span></div><div class="azioni-modello"><a href="<?= e(url_with_lang('login.php')) ?>" class="btn-principale"><span><?= e(t('buy')) ?></span></a><a href="<?= e(url_with_lang('login.php')) ?>" class="btn-secondario"><?= e(t('plus_subscription')) ?></a></div></div></div>
    </div>
</section>
<section class="sezione-abbonamenti" id="abbonamenti">
    <div class="abbonamenti-header">
        <p><?= e(t('unlock_night_data')) ?></p>
        <span><?= e(t('choose_plan')) ?></span>
        <h2><?= e(t('choose_plan')) ?> <em><?= e(t('best_plan')) ?></em></h2>
    </div>

    <div class="abbonamenti-grid">
        <div class="scheda-abbonamento">
            <div class="piano-nome"><?= e(t('free')) ?></div>
            <div class="piano-prezzo">€0 <span>/ <?= e(t('always')) ?></span></div>
            <ul class="piano-features">
                <li><?= e(t('last_7_days')) ?></li>
                <li><?= e(t('daily_report')) ?></li>
                <li><?= e(t('phases')) ?></li>
            </ul>
            <a href="<?= e(url_with_lang('register.php')) ?>" class="btn-gratis"><?= e(t('start_free')) ?></a>
        </div>

        <div class="scheda-abbonamento scheda-abbonamento--evidenziata">
            <div class="piano-badge"><?= e(t('most_popular')) ?></div>
            <div class="piano-nome">Pro</div>
            <div class="piano-prezzo">€12 <span>/ <?= e(t('month')) ?></span></div>
            <ul class="piano-features">
                <li><?= e(t('last_6_months')) ?></li>
                <li><?= e(t('daily_report')) ?></li>
                <li><?= e(t('ai_dream_analysis')) ?></li>
            </ul>
            <a href="<?= e(url_with_lang('register.php')) ?>" class="btn-abbonamento"><?= e(t('subscribe')) ?></a>
        </div>

        <div class="scheda-abbonamento">
            <div class="piano-nome">Premium</div>
            <div class="piano-prezzo">€24 <span>/ <?= e(t('month')) ?></span></div>
            <ul class="piano-features">
                <li><?= e(t('last_year')) ?></li>
                <li><?= e(t('ai_dream_analysis')) ?></li>
                <li><?= e(t('priority_support')) ?></li>
            </ul>
            <a href="<?= e(url_with_lang('register.php')) ?>" class="btn-abbonamento"><?= e(t('subscribe')) ?></a>
        </div>
    </div>
</section>
<?php include 'includes/footer.php'; ?>