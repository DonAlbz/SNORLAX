<?php
require_once 'config.php';
if (is_logged_in()) { redirect(url_with_lang('dashboard.php')); }
$error = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome = trim((string) ($_POST['nome'] ?? ''));
    $cognome = trim((string) ($_POST['cognome'] ?? ''));
    $email = trim((string) ($_POST['email'] ?? ''));
    $password = (string) ($_POST['password'] ?? '');
    $data_nascita = trim((string) ($_POST['data_nascita'] ?? ''));
    if ($nome === '' || $cognome === '' || $email === '' || $password === '') {
        $error = t('fill_required');
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error = t('invalid_email');
    } elseif (strlen($password) < 8) {
        $error = t('password_min');
    } else {
        $check = db()->prepare('SELECT id_utente FROM utente WHERE email = ? LIMIT 1');
        $check->execute([$email]);
        if ($check->fetch()) {
            $error = t('email_exists');
        } else {
            $stmt = db()->prepare('INSERT INTO utente (nome, cognome, email, password_hash, data_nascita, ruolo) VALUES (?, ?, ?, ?, ?, ?)');
            $stmt->execute([$nome, $cognome, $email, password_hash($password, PASSWORD_DEFAULT), $data_nascita !== '' ? $data_nascita : null, 'utente']);
            flash_set('success', t('account_created'));
            redirect(url_with_lang('login.php'));
        }
    }
}
$page_title='Snorlax - '.t('register_title'); include 'includes/header.php'; ?>
<main class="auth-page"><div class="auth-wrap"><h1><?= e(t('register_title')) ?></h1><?php if ($error): ?><div class="alert alert-danger"><?= e($error) ?></div><?php endif; ?><form method="post"><div class="row"><div class="col-md-6 mb-3"><label class="form-label"><?= e(t('name')) ?></label><input type="text" name="nome" class="form-control" value="<?= e($_POST['nome'] ?? '') ?>" required></div><div class="col-md-6 mb-3"><label class="form-label"><?= e(t('surname')) ?></label><input type="text" name="cognome" class="form-control" value="<?= e($_POST['cognome'] ?? '') ?>" required></div></div><div class="mb-3"><label class="form-label"><?= e(t('email')) ?></label><input type="email" name="email" class="form-control" value="<?= e($_POST['email'] ?? '') ?>" required></div><div class="mb-3"><label class="form-label"><?= e(t('birth_date')) ?></label><input type="date" name="data_nascita" class="form-control" value="<?= e($_POST['data_nascita'] ?? '') ?>"></div><div class="mb-4"><label class="form-label"><?= e(t('password')) ?></label><input type="password" name="password" class="form-control" required></div><button class="btn btn-primary w-100" type="submit"><?= e(t('register_title')) ?></button></form><a class="auth-link" href="<?= e(url_with_lang('login.php')) ?>"><?= e(t('already_have_account')) ?></a></div></main>
<?php include 'includes/footer.php'; ?>