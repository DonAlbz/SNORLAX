<?php
require_once 'config.php';
$page_title = 'Snorlax - ' . t('privacy_page');
$page_css = ['css/privacy_chi_siamo.css'];
include 'includes/header.php';
?>
<section class="intestazione">
    <h1><?= e(t('privacy_title')) ?> <em><?= e(t('privacy_title_em')) ?></em></h1>
    <p><?= e(t('privacy_sub')) ?></p>
</section>
<section class="contenuto">
    <div class="grid-cards">
        <div class="card"><i class="bi bi-database icon"></i>
            <h3><?= e(t('data_collected')) ?></h3>
            <p><?= e(t('data_collected_desc')) ?></p>
        </div>
        <div class="card"><i class="bi bi-gear icon"></i>
            <h3><?= e(t('data_use')) ?></h3>
            <p><?= e(t('data_use_desc')) ?></p>
        </div>
        <div class="card"><i class="bi bi-shield-check icon"></i>
            <h3><?= e(t('protection')) ?></h3>
            <p><?= e(t('protection_desc')) ?></p>
        </div>
        <div class="card"><i class="bi bi-person-check icon"></i>
            <h3><?= e(t('your_rights')) ?></h3>
            <p><?= e(t('your_rights_desc')) ?></p>
        </div>
    </div>
    <div class="privacy-dettagli">
        <h2><?= e(t('full_notice')) ?></h2>
        <p><?= e(t('full_notice_desc')) ?></p>
        <p><strong><?= e(t('privacy_contact')) ?></strong></p>
    </div>
</section>
<?php include 'includes/footer.php'; ?>