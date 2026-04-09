<?php
require_once 'config.php';
$page_title = 'Snorlax - '.t('about_page');
$page_css = ['css/privacy_chi_siamo.css'];
include 'includes/header.php';
?>
<section class="intestazione"><h1><?= e(t('about_title')) ?> <em><?= e(t('about_title_em')) ?></em></h1><p><?= e(t('about_sub')) ?></p></section>
<section class="contenuto"><div class="grid-cards">
<div class="card"><i class="bi bi-lightbulb icon"></i><h3><?= e(t('mission')) ?></h3><p><?= e(t('mission_desc')) ?></p></div>
<div class="card"><i class="bi bi-rocket-takeoff icon"></i><h3><?= e(t('vision')) ?></h3><p><?= e(t('vision_desc')) ?></p></div>
<div class="card"><i class="bi bi-graph-up icon"></i><h3><?= e(t('what_we_do')) ?></h3><p><?= e(t('what_we_do_desc')) ?></p></div>
<div class="card"><i class="bi bi-shield-lock icon"></i><h3><?= e(t('reliability')) ?></h3><p><?= e(t('reliability_desc')) ?></p></div>
</div></section>
<?php include 'includes/footer.php'; ?>