<?php
require_once 'config.php';
$page_title = 'Snorlax - ' . t('products_page');
$current_page = 'prodotti';
$page_css = ['css/style_prodotti.css'];
include 'includes/header.php';
?>
<section class="intestazione">
    <h1><?= e(t('products_title')) ?> <em><?= e(t('products_title_em')) ?></em></h1>
    <p><?= e(t('products_sub')) ?></p>
</section>
<section class="sezione-modelli">
    <div class="scheda-modello" id="sense">
        <div class="immagine-modello">
            <div class="immagine-modello" style="background-image:url('img/Sense.jpeg');"><span
                    class="intestazione-modello"><?= e(t('sleep_sensors')) ?></span></div>
        </div>
        <div class="info-modello">
            <div class="numero-modello"><?= e(t('model_01')) ?></div>
            <div class="nome-modello">Snorlax Sense</div>
            <div class="slogan-modello"><?= e(t('sleep_analyzed')) ?></div>
            <p class="descrizione-modello"><?= e(t('sense_long')) ?></p>
            <ul class="caratteristiche-modello">
                <li><?= e(t('sense_f1')) ?></li>
                <li><?= e(t('sense_f2')) ?></li>
                <li><?= e(t('sense_f3')) ?></li>
                <li><?= e(t('sense_f4')) ?></li>
                <li><?= e(t('sense_f5')) ?></li>
                <li><?= e(t('sense_f6')) ?></li>
            </ul>
            <div class="prezzi-modello">
                <div class="blocco-prezzi"><span class="prezzo">€1.200</span><span
                        class="nota-prezzo"><?= e(t('vat_shipping')) ?></span></div>
                <div class="azioni-modello"><a href="<?= e(url_with_lang('login.php')) ?>"
                        class="btn-principale"><span><?= e(t('buy')) ?></span></a><a
                        href="<?= e(url_with_lang('login.php')) ?>"
                        class="btn-secondario"><?= e(t('plus_subscription')) ?></a></div>
            </div>
        </div>
    </div>
    <div class="scheda-modello" id="vision">
        <div class="immagine-modello">
            <div class="immagine-modello" style="background-image:url('img/Vision.jpeg');"><span
                    class="intestazione-modello"><?= e(t('integrated_monitor')) ?></span></div>
        </div>
        <div class="info-modello">
            <div class="numero-modello"><?= e(t('model_02')) ?></div>
            <div class="nome-modello">Snorlax Vision</div>
            <div class="slogan-modello"><?= e(t('vision_slogan')) ?></div>
            <p class="descrizione-modello"><?= e(t('vision_long')) ?></p>
            <ul class="caratteristiche-modello">
                <li><?= e(t('vision_f1')) ?></li>
                <li><?= e(t('vision_f2')) ?></li>
                <li><?= e(t('vision_f3')) ?></li>
                <li><?= e(t('vision_f4')) ?></li>
                <li><?= e(t('vision_f5')) ?></li>
                <li><?= e(t('vision_f6')) ?></li>
            </ul>
            <div class="prezzi-modello">
                <div class="blocco-prezzi"><span class="prezzo">€1.500</span><span
                        class="nota-prezzo"><?= e(t('vat_shipping')) ?></span></div>
                <div class="azioni-modello"><a href="<?= e(url_with_lang('login.php')) ?>"
                        class="btn-principale"><span><?= e(t('buy')) ?></span></a><a
                        href="<?= e(url_with_lang('login.php')) ?>"
                        class="btn-secondario"><?= e(t('plus_subscription')) ?></a></div>
            </div>
        </div>
    </div>
    <div class="scheda-modello" id="dream">
        <div class="immagine-modello">
            <div class="immagine-modello" style="background-image:url('img/Dream.jpeg');"><span
                    class="intestazione-modello"><?= e(t('complete_solution')) ?></span></div>
        </div>
        <div class="info-modello">
            <div class="numero-modello"><?= e(t('model_03')) ?></div>
            <div class="nome-modello">Snorlax Dream</div>
            <div class="slogan-modello"><?= e(t('dream_slogan')) ?></div>
            <p class="descrizione-modello"><?= e(t('dream_long')) ?></p>
            <ul class="caratteristiche-modello">
                <li><?= e(t('dream_f1')) ?></li>
                <li><?= e(t('dream_f2')) ?></li>
                <li><?= e(t('dream_f3')) ?></li>
                <li><?= e(t('dream_f4')) ?></li>
                <li><?= e(t('dream_f5')) ?></li>
            </ul>
            <div class="prezzi-modello">
                <div class="blocco-prezzi"><span class="prezzo">€2.200</span><span
                        class="nota-prezzo"><?= e(t('vat_shipping')) ?></span></div>
                <div class="azioni-modello"><a href="<?= e(url_with_lang('login.php')) ?>"
                        class="btn-principale"><span><?= e(t('buy')) ?></span></a><a
                        href="<?= e(url_with_lang('login.php')) ?>"
                        class="btn-secondario"><?= e(t('plus_subscription')) ?></a></div>
            </div>
        </div>
    </div>
</section>
<section class="pricing-section" id="abbonamenti" style="padding:4rem 0 5rem;">
    <div class="container">
        <div class="text-center mb-5">
            <p class="text-uppercase small mb-2"><?= e(t('unlock_night_data')) ?></p>
            <h2><?= e(t('choose_plan')) ?> <em><?= e(t('best_plan')) ?></em></h2>
        </div>
        <div class="row g-4 justify-content-center">
            <div class="col-md-4">
                <div class="card h-100 shadow-sm border-0 rounded-4">
                    <div class="card-body p-4">
                        <h3><?= e(t('free')) ?></h3>
                        <div class="display-6 mb-3">€0 <small class="fs-6"><?= e(t('always')) ?></small></div>
                        <ul>
                            <li><?= e(t('last_7_days')) ?></li>
                            <li><?= e(t('daily_report')) ?></li>
                            <li><?= e(t('phases')) ?></li>
                        </ul><a href="<?= e(url_with_lang('register.php')) ?>"
                            class="btn btn-outline-dark w-100"><?= e(t('start_free')) ?></a>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card h-100 shadow border-0 rounded-4">
                    <div class="card-body p-4">
                        <div class="badge bg-dark mb-3"><?= e(t('most_popular')) ?></div>
                        <h3>Pro</h3>
                        <div class="display-6 mb-3">€12 <small class="fs-6">/ <?= e(t('month')) ?></small></div>
                        <ul>
                            <li><?= e(t('last_6_months')) ?></li>
                            <li><?= e(t('daily_report')) ?></li>
                            <li><?= e(t('ai_dream_analysis')) ?></li>
                        </ul><a href="<?= e(url_with_lang('register.php')) ?>"
                            class="btn btn-dark w-100"><?= e(t('subscribe')) ?></a>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card h-100 shadow-sm border-0 rounded-4">
                    <div class="card-body p-4">
                        <h3>Premium</h3>
                        <div class="display-6 mb-3">€24 <small class="fs-6">/ <?= e(t('month')) ?></small></div>
                        <ul>
                            <li><?= e(t('last_year')) ?></li>
                            <li><?= e(t('ai_dream_analysis')) ?></li>
                            <li><?= e(t('priority_support')) ?></li>
                        </ul><a href="<?= e(url_with_lang('register.php')) ?>"
                            class="btn btn-outline-dark w-100"><?= e(t('subscribe')) ?></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<?php include 'includes/footer.php'; ?>