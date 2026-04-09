<?php
require_once 'config.php';
if (is_logged_in()) { redirect(url_with_lang('dashboard.php')); }
$error = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = trim((string) ($_POST['email'] ?? ''));
    $password = (string) ($_POST['password'] ?? '');
    $stmt = db()->prepare('SELECT * FROM utente WHERE email = ? LIMIT 1');
    $stmt->execute([$email]);
    $user = $stmt->fetch();
    if ($user && password_verify($password, $user['password_hash'])) {
        $_SESSION['user'] = $user;
        redirect(url_with_lang('dashboard.php'));
    }
    $error = t('invalid_credentials');
}
$page_title='Snorlax - '.t('login_title');
include 'includes/header.php';
?>
<main class="auth-page"><div class="auth-wrap"><h1><?= e(t('login_title')) ?></h1><?php if ($error): ?><div class="alert alert-danger"><?= e($error) ?></div><?php endif; ?><form method="post"><div class="mb-3"><label class="form-label"><?= e(t('email')) ?></label><input type="email" name="email" class="form-control" value="<?= e($_POST['email'] ?? '') ?>" required></div><div class="mb-4"><label class="form-label"><?= e(t('password')) ?></label><input type="password" name="password" class="form-control" required></div><button class="btn btn-primary w-100" type="submit"><?= e(t('login_title')) ?></button></form><a class="auth-link" href="<?= e(url_with_lang('register.php')) ?>"><?= e(t('no_account')) ?></a></div></main>
<?php include 'includes/footer.php'; ?>