<?php
require_once __DIR__ . '/../config.php';
$page_title = $page_title ?? 'Snorlax';
$page_css = $page_css ?? [];
$current_page = $current_page ?? '';
$user = current_user();
$flash = flash_get();
?><!DOCTYPE html>
<html lang="<?= e(current_lang_code()) ?>">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= e($page_title) ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/app.css">
    <?php foreach ($page_css as $css): ?>
        <link rel="stylesheet" href="<?= e($css) ?>">
    <?php endforeach; ?>
    <style>
        #snorlax-heart-transition {
            position: fixed;
            inset: 0;
            z-index: 10000;
            display: flex;
            align-items: center;
            justify-content: center;
            pointer-events: none;
            overflow: hidden;
            background: transparent;
        }
    </style>
</head>

<body>
    <header>
        <nav id="navbar">
            <div class="logo">
                <div class="logo-testo">
                    <a href="<?= e(url_with_lang('home.php')) ?>" style="text-decoration:none;color:inherit;"><span
                            class="logo-nome">Snorlax</span></a>
                    <div class="logo-secondario"><?= e(t('tagline')) ?> <i class="bi bi-moon-stars-fill"></i></div>
                </div>
            </div>
            <button class="nav-toggle" id="nav-toggle" aria-label="Apri menu" aria-expanded="false">
                <span></span><span></span><span></span>
            </button>
            <ul class="menu" id="nav-menu">
                <li><a href="<?= e(url_with_lang('home.php')) ?>"
                        class="<?= menu_active('home', $current_page) ?> heart-click"><?= e(t('nav_home')) ?></a></li>
                <li><a href="<?= e(url_with_lang('prodotti.php')) ?>"
                        class="<?= menu_active('prodotti', $current_page) ?> heart-click"><?= e(t('nav_products')) ?></a></li>
                <li><a href="<?= e(url_with_lang('dashboard.php')) ?>"
                        class="<?= menu_active('dashboard', $current_page) ?> heart-click"><?= e(t('nav_dashboard')) ?></a></li>
                <li><a href="<?= e(url_with_lang('contatti.php')) ?>"
                        class="<?= menu_active('contatti', $current_page) ?> heart-click"><?= e(t('nav_contacts')) ?></a></li>
            </ul>
            <div class="d-flex align-items-center gap-2">
                <form method="get" class="m-0">
                    <?php foreach ($_GET as $k => $v):
                        if ($k === 'lang')
                            continue; ?>
                        <input type="hidden" name="<?= e((string) $k) ?>" value="<?= e((string) $v) ?>">
                    <?php endforeach; ?>
                    <select name="lang" class="form-select form-select-sm" onchange="this.form.submit()"
                        aria-label="Language switcher">
                        <?php foreach (available_languages() as $code => $label): ?>
                            <option value="<?= e($code) ?>" <?= $code === current_lang_code() ? 'selected' : '' ?>>
                                <?= e($label) ?></option>
                        <?php endforeach; ?>
                    </select>
                </form>
                <?php if ($user): ?>
                    <div class="user-nav"><span class="user-pill"><?= e($user['nome']) ?></span><a
                            href="<?= e(url_with_lang('logout.php')) ?>" class="login"><?= e(t('logout')) ?> <i
                                class="bi bi-box-arrow-right"></i></a></div>
                <?php else: ?>
                    <a href="<?= e(url_with_lang('login.php')) ?>" class="login"><?= e(t('nav_login')) ?> <i
                            class="bi bi-person-circle"></i></a>
                <?php endif; ?>
            </div>
        </nav>
    </header>

    <script>
    (function() {
        document.querySelectorAll('.heart-click').forEach(function(link) {
            link.addEventListener('click', function(e) {
                var href = this.getAttribute('href');
                if (!href || href.startsWith('#')) return;
                e.preventDefault();
                var overlay = document.createElement('div');
                overlay.id = 'snorlax-heart-transition';
                var hSvg = document.createElementNS('http://www.w3.org/2000/svg','svg');
                hSvg.setAttribute('viewBox','0 0 100 100');
                hSvg.style.cssText = 'width:80px;height:80px;display:block;transform:scale(0);transition:transform 0.6s cubic-bezier(0.22,1,0.36,1);';
                var hPath = document.createElementNS('http://www.w3.org/2000/svg','path');
                hPath.setAttribute('d','M50 85 C50 85 10 55 10 30 C10 18 18 10 30 10 C38 10 45 15 50 22 C55 15 62 10 70 10 C82 10 90 18 90 30 C90 55 50 85 50 85Z');
                hPath.setAttribute('fill','#0a1628');
                hSvg.appendChild(hPath);
                overlay.appendChild(hSvg);
                document.body.appendChild(overlay);
                requestAnimationFrame(function(){
                    requestAnimationFrame(function(){
                        var scale = (Math.sqrt(window.innerWidth*window.innerWidth + window.innerHeight*window.innerHeight) / 80) * 2.5;
                        hSvg.style.transform = 'scale(' + scale + ')';
                        setTimeout(function(){
                            overlay.style.background = '#0a1628';
                            window.location.href = href;
                        }, 550);
                    });
                });
            });
        });
    })();
    </script>

    <?php if ($flash): ?>
        <div class="container mt-4">
            <div class="alert alert-<?= e($flash['type']) ?> shadow-sm"><?= e($flash['message']) ?></div>
        </div><?php endif; ?>