<?php
require_once 'config.php';
$page_title = 'Snorlax - ' . t('nav_home');
$current_page = 'home';
include 'includes/header.php';
?>
<section class="home">
    <div class="blocco blocco-1">
        <div class="blocco-testo">
            <div class="etichetta"><span class="etichetta-linea"></span><?= e(t('home_hero_tag')) ?></div>
            <h2><?= e(t('home_hero_title')) ?> <em><?= e(t('home_hero_em')) ?></em></h2>
            <p><?= e(t('home_hero_desc')) ?></p>
            <a href="#preview-modelli" class="btn-preview"><?= e(t('discover_models')) ?> <i
                    class="bi bi-arrow-right"></i></a>
        </div>
        <div class="blocco-media"><img src="img/svg/illustrazione_sonno.svg" alt="sleep tech"
                style="width:100%;max-width:480px;"></div>
    </div>
    <div class="blocco blocco-1">
        <div class="blocco-testo">
            <div class="etichetta"><span class="etichetta-linea"></span><?= e(t('night_analysis')) ?></div>
            <h2><?= e(t('home_story_title')) ?> <em><?= e(t('home_story_em')) ?></em></h2>
            <p><?= e(t('home_story_desc')) ?></p>
            <ul class="feature-list">
                <li><i class="bi bi-check2"></i> <?= e(t('feat_ai_sleep')) ?></li>
                <li><i class="bi bi-check2"></i> <?= e(t('feat_dream_live')) ?></li>
                <li><i class="bi bi-check2"></i> <?= e(t('feat_dashboard')) ?></li>
            </ul>
            <a href="<?= e(url_with_lang('dashboard.php')) ?>" class="btn-blocco"><?= e(t('user_dashboard')) ?> <i
                    class="bi bi-arrow-right"></i></a>
        </div>
        <div class="blocco-media"><img class="mockup-zoom" src="img/svg/mockup_telefono.svg" alt="dashboard"></div>
    </div>
</section>
<section class="filosofia">
    <div class="filosofia-header">
        <div class="etichetta etichetta-centered"><span
                class="etichetta-linea"></span><?= e(t('philosophy_tag')) ?><span class="etichetta-linea"></span></div>
        <h2 class="filosofia-titolo"><?= e(t('philosophy_title')) ?>
            <em><?= e(t('philosophy_em')) ?></em><br><?= e(t('philosophy_title_2')) ?>
        </h2>
        <p class="filosofia-desc"><?= e(t('philosophy_desc')) ?></p>
    </div>
    <div class="filosofia-quote">
        <blockquote>"<?= e(t('quote')) ?>"</blockquote>
    </div>
    <div class="features-grid">
        <div class="feature-card">
            <div class="feature-icon-wrap"><i class="bi bi-heart-pulse"></i></div>
            <div class="feature-num">01</div>
            <h4><?= e(t('vital_monitoring')) ?></h4>
            <p><?= e(t('vital_desc')) ?></p>
            <div class="feature-tag"><?= e(t('bio_sensing')) ?></div>
        </div>
        <div class="feature-card">
            <div class="feature-icon-wrap"><i class="bi bi-clock"></i></div>
            <div class="feature-num">02</div>
            <h4><?= e(t('sleep_phases')) ?></h4>
            <p><?= e(t('sleep_phases_desc')) ?></p>
            <div class="feature-tag"><?= e(t('ai_integrated')) ?></div>
        </div>
        <div class="feature-card">
            <div class="feature-icon-wrap"><i class="bi bi-cloud-moon"></i></div>
            <div class="feature-num">03</div>
            <h4><?= e(t('dream_analysis')) ?></h4>
            <p><?= e(t('dream_desc')) ?></p>
            <div class="feature-tag"><?= e(t('dream_mapping')) ?></div>
        </div>
        <div class="feature-card">
            <div class="feature-icon-wrap"><i class="bi bi-grid-1x2"></i></div>
            <div class="feature-num">04</div>
            <h4><?= e(t('live_dashboard')) ?></h4>
            <p><?= e(t('live_dashboard_desc')) ?></p>
            <div class="feature-tag"><?= e(t('real_time')) ?></div>
        </div>
    </div>
    <div class="filosofia-stats">
        <div class="fstat"><span class="fstat-num">98<em>%</em></span><span
                class="fstat-label"><?= e(t('sensor_accuracy')) ?></span></div>
        <div class="fstat-divider"></div>
        <div class="fstat"><span class="fstat-num">+12k</span><span
                class="fstat-label"><?= e(t('nights_analyzed')) ?></span></div>
        <div class="fstat-divider"></div>
        <div class="fstat"><span class="fstat-num">3</span><span
                class="fstat-label"><?= e(t('models_available')) ?></span></div>
        <div class="fstat-divider"></div>
        <div class="fstat"><span class="fstat-num">24<em>/7</em></span><span
                class="fstat-label"><?= e(t('active_support')) ?></span></div>
    </div>
</section>
<section class="dashboard-preview">
    <div class="dashboard-preview-inner">
        <div class="dashboard-testo">
            <div class="etichetta"><span class="etichetta-linea"></span><?= e(t('personal_dashboard')) ?></div>
            <h2><?= e(t('morning_data')) ?> <em><?= e(t('morning_data_em')) ?></em></h2>
            <p><?= e(t('morning_desc')) ?></p>
            <ul class="feature-list">
                <li><i class="bi bi-check2"></i> <?= e(t('sleep_quality_pct')) ?></li>
                <li><i class="bi bi-check2"></i> <?= e(t('night_graph')) ?></li>
                <li><i class="bi bi-check2"></i> <?= e(t('heart_monitor')) ?></li>
                <li><i class="bi bi-check2"></i> <?= e(t('auto_dream')) ?></li>
            </ul>
            <a href="<?= e(url_with_lang('dashboard.php')) ?>" class="btn-dashboard"><?= e(t('go_dashboard')) ?> <i
                    class="bi bi-arrow-right"></i></a>
        </div>
        <div class="dashboard-mockup"><img src="img/svg/demo_dashboard.svg" alt="Dashboard demo"></div>
    </div>
</section>
<section class="models-preview" id="preview-modelli">
    <div class="models-preview-header"><span class="section-etichetta"><?= e(t('our_models')) ?></span>
        <h2 class="section-titolo"><?= e(t('three_levels')) ?> <em><?= e(t('experience')) ?></em></h2>
    </div>
    <div class="models-grid">
        <a href="<?= e(url_with_lang('prodotti.php')) ?>#sense" class="model-card-preview">
            <div class="card-img-wrap" style="background-image:url('img/Sense.jpeg');"><span class="card-number">01 /
                    Snorlax Sense</span></div>
            <div class="card-content">
                <h3>Snorlax Sense</h3>
                <p><?= e(t('sense_desc_short')) ?></p>
                <div class="card-price">€1.200 <span>/ <?= e(t('base_model')) ?></span></div>
            </div>
        </a>
        <a href="<?= e(url_with_lang('prodotti.php')) ?>#vision" class="model-card-preview">
            <div class="card-img-wrap" style="background-image:url('img/Vision.jpeg');"><span class="card-number">02 /
                    Snorlax Vision</span></div>
            <div class="card-content">
                <h3>Snorlax Vision</h3>
                <p><?= e(t('vision_desc_short')) ?></p>
                <div class="card-price">€1.500 <span>/ <?= e(t('with_monitor')) ?></span></div>
            </div>
        </a>
        <a href="<?= e(url_with_lang('prodotti.php')) ?>#dream" class="model-card-preview">
            <div class="card-img-wrap" style="background-image:url('img/Dream.jpeg');"><span class="card-number">03 /
                    Snorlax Dream</span></div>
            <div class="card-content">
                <h3>Snorlax Dream</h3>
                <p><?= e(t('dream_desc_short')) ?></p>
                <div class="card-price">€2.200 <span>/ <?= e(t('full_solution')) ?></span></div>
            </div>
        </a>
    </div>
    <div style="margin-top:3.5rem;"><a href="<?= e(url_with_lang('prodotti.php')) ?>"
            class="btn-secondario"><?= e(t('all_details')) ?></a></div>
</section>
<section class="section-invito">
    <div class="contenuto-invito">
        <span class="section-etichetta"><?= e(t('start_tonight')) ?></span>
        <h2 class="section-titolo"><?= e(t('ready_sleep')) ?> <em><?= e(t('better')) ?></em></h2>
        <p class="section-descrizione"><?= e(t('ready_desc')) ?></p>
        <div class="section-buttons"><a href="<?= e(url_with_lang('login.php')) ?>"
                class="btn-principale"><span><?= e(t('buy_now')) ?></span></a><a
                href="<?= e(url_with_lang('contatti.php')) ?>" class="btn-secondario"><?= e(t('talk_to_us')) ?></a>
        </div>
    </div>
</section>
<?php include 'includes/footer.php'; ?>