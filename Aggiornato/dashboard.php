<?php
require_once 'config.php';
require_login();
$user = current_user();
$pdo = db();

// 1. Recupero Sonno
$stmt = $pdo->prepare('SELECT score_notte, fase_rem, fase_deep, ora_inizio, ora_fine FROM sonno WHERE id_utente = ? ORDER BY ora_inizio DESC LIMIT 5');
$stmt->execute([$user['id_utente']]);
$sonni = $stmt->fetchAll();

// 2. Recupero Salute
$stmt = $pdo->prepare('SELECT freq_cardiaca, temp_corporea, qualita_sonno, data_rilevazione FROM salute WHERE id_utente = ? ORDER BY data_rilevazione DESC LIMIT 5');
$stmt->execute([$user['id_utente']]);
$saluteRows = $stmt->fetchAll();

// 3. Recupero Sogni
$stmt = $pdo->prepare('SELECT s.descrizione_ai, s.emozione_rilevata, s.intensita, s.data_registrazione FROM sogni s INNER JOIN sonno so ON so.id_sonno = s.id_sonno WHERE so.id_utente = ? ORDER BY s.data_registrazione DESC LIMIT 3');
$stmt->execute([$user['id_utente']]);
$sogni = $stmt->fetchAll();

// 4. Recupero Media
$stmt = $pdo->prepare('SELECT tipo, titolo, durata_minuti, data_riproduzione FROM servizi_media WHERE id_utente = ? ORDER BY data_riproduzione DESC LIMIT 5');
$stmt->execute([$user['id_utente']]);
$media = $stmt->fetchAll();

// 5. Stato Server
$servers = $pdo->query('SELECT nome_server, stato FROM server ORDER BY id_server ASC LIMIT 4')->fetchAll();

// 6. Analisi AI
$stmt = $pdo->prepare('SELECT tipo_analisi, risultato_json, tokens_usati, timestamp FROM ai_sessioni WHERE id_utente = ? ORDER BY timestamp DESC LIMIT 3');
$stmt->execute([$user['id_utente']]);
$ai = $stmt->fetchAll();

// --- Calcolo Statistiche ---
$avgScore = $sonni ? round(array_sum(array_column($sonni, 'score_notte')) / count($sonni)) : 0;
$avgHeart = 0; 
$avgTemp = 0;

if ($saluteRows) {
    $vals = array_filter(array_column($saluteRows, 'freq_cardiaca'), fn($v) => $v !== null);
    if ($vals) $avgHeart = round(array_sum($vals) / count($vals));
    
    $temps = array_filter(array_column($saluteRows, 'temp_corporea'), fn($v) => $v !== null);
    if ($temps) $avgTemp = round(array_sum($temps) / count($temps), 1);
}

// Helper per i badge
function badge_server(string $stato): string { 
    return match (strtolower($stato)) { 
        'online'       => 'badge-soft badge-ok', 
        'manutenzione' => 'badge-soft badge-warn', 
        default        => 'badge-soft badge-danger',
    }; 
}

$page_title = 'Snorlax - ' . t('nav_dashboard'); 
$current_page = 'dashboard'; 
include 'includes/header.php'; 
?>

<main class="dashboard-page">
    <section class="hero">
        <h1><?= e(t('welcome_user', ['name' => $user['nome'] ?? 'User'])) ?></h1>
    </section>

    <section class="dashboard-grid">
        <div class="stat-card">
            <div class="stat-label"><?= e(t('avg_sleep_score')) ?></div>
            <div class="stat-value"><?= e((string)$avgScore) ?>%</div>
            <div class="stat-note"><?= e(t('last_n_nights', ['n' => count($sonni)])) ?></div>
        </div>
        <div class="stat-card">
            <div class="stat-label"><?= e(t('avg_heart_rate')) ?></div>
            <div class="stat-value"><?= e((string)$avgHeart) ?></div>
            <div class="stat-note"><?= e(t('detected_bpm')) ?></div>
        </div>
        <div class="stat-card">
            <div class="stat-label"><?= e(t('avg_temperature')) ?></div>
            <div class="stat-value"><?= e(number_format((float)$avgTemp, 1)) ?>°</div>
            <div class="stat-note"><?= e(t('latest_health_checks')) ?></div>
        </div>
        <div class="stat-card">
            <div class="stat-label"><?= e(t('ai_sessions')) ?></div>
            <div class="stat-value"><?= e((string)count($ai)) ?></div>
            <div class="stat-note"><?= e(t('latest_ai_analysis')) ?></div>
        </div>

        <div class="panel-card span-6">
            <h3><?= e(t('latest_nights')) ?></h3>
            <table class="table-lite">
                <thead>
                    <tr><th><?= e(t('start')) ?></th><th><?= e(t('end')) ?></th><th>REM</th><th><?= e(t('deep')) ?></th><th><?= e(t('score')) ?></th></tr>
                </thead>
                <tbody>
                    <?php foreach($sonni as $row): ?>
                    <tr>
                        <td><?= e((string)$row['ora_inizio']) ?></td>
                        <td><?= e((string)$row['ora_fine']) ?></td>
                        <td><?= e((string)$row['fase_rem']) ?> min</td>
                        <td><?= e((string)$row['fase_deep']) ?> min</td>
                        <td><?= e((string)$row['score_notte']) ?>%</td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>

        <div class="panel-card span-6">
            <h3><?= e(t('health_status')) ?></h3>
            <table class="table-lite">
                <thead>
                    <tr><th><?= e(t('date')) ?></th><th>BPM</th><th>Temp.</th><th><?= e(t('quality')) ?></th></tr>
                </thead>
                <tbody>
                    <?php foreach($saluteRows as $row): ?>
                    <tr>
                        <td><?= e((string)$row['data_rilevazione']) ?></td>
                        <td><?= e((string)$row['freq_cardiaca']) ?></td>
                        <td><?= e((string)$row['temp_corporea']) ?>°</td>
                        <td><?= e((string)$row['qualita_sonno']) ?>/10</td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>

        <div class="panel-card span-8">
            <h3><?= e(t('detected_dreams')) ?></h3>
            <?php foreach($sogni as $row): ?>
            <div class="mb-4">
                <div class="d-flex align-items-center gap-2 mb-2">
                    <span class="badge-soft"><?= e((string)$row['emozione_rilevata']) ?></span>
                    <span class="text-secondary"><?= e(t('intensity')) ?> <?= e((string)$row['intensita']) ?>/10</span>
                </div>
                <p class="mb-1"><?= e((string)$row['descrizione_ai']) ?></p>
                <small class="text-secondary"><?= e((string)$row['data_registrazione']) ?></small>
            </div>
            <?php endforeach; ?>
        </div>

        <div class="panel-card span-4">
            <h3><?= e(t('servers')) ?></h3>
            <?php foreach($servers as $row): ?>
            <div class="mb-3">
                <div class="d-flex justify-content-between align-items-center">
                    <strong><?= e((string)$row['nome_server']) ?></strong>
                    <span class="<?= badge_server((string)$row['stato']) ?>"><?= e((string)$row['stato']) ?></span>
                </div>
            </div>
            <?php endforeach; ?>
        </div>

        <div class="panel-card span-4">
            <h3><?= e(t('recent_media')) ?></h3>
            <table class="table-lite">
                <thead>
                    <tr><th><?= e(t('type')) ?></th><th><?= e(t('title')) ?></th></tr>
                </thead>
                <tbody>
                    <?php foreach($media as $row): ?>
                    <tr>
                        <td><?= e((string)$row['tipo']) ?></td>
                        <td><?= e((string)$row['titolo']) ?></td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>

        <div class="panel-card span-8">
            <h3><?= e(t('ai_analysis')) ?></h3>
            <?php foreach($ai as $row): ?>
                <?php $aiData = json_decode((string)$row['risultato_json'], true) ?? []; ?>
                <div class="mb-4">
                    <div class="d-flex justify-content-between">
                        <strong><?= e((string)$row['tipo_analisi']) ?></strong>
                        <small class="text-secondary"><?= e((string)$row['tokens_usati']) ?> <?= e(t('token')) ?></small>
                    </div>
                    <div class="mt-2 mb-1" style="background:#f8fafc; border-radius:16px; padding:14px;">
                        <?php if (($row['tipo_analisi'] ?? '') === 'sogno'): ?>
                            <div><strong>Emozione:</strong> <?= e((string)($aiData['sentiment'] ?? '-')) ?></div>
                            <div><strong>Parole chiave:</strong> <?= e(isset($aiData['keywords']) && is_array($aiData['keywords']) ? implode(', ', $aiData['keywords']) : '-') ?></div>
                            <div><strong>Interpretazione:</strong> <?= e((string)($aiData['suggerimento'] ?? '-')) ?></div>
                        <?php elseif (($row['tipo_analisi'] ?? '') === 'salute'): ?>
                            <div><strong>Stato:</strong> <?= e((string)($aiData['stato'] ?? '-')) ?></div>
                            <div><strong>Frequenza media:</strong> <?= e((string)($aiData['freq_media'] ?? '-')) ?> bpm</div>
                            <div><strong>Consiglio:</strong> <?= e((string)($aiData['consiglio'] ?? '-')) ?></div>
                        <?php elseif (($row['tipo_analisi'] ?? '') === 'consiglio'): ?>
                            <div><strong>Tipo:</strong> <?= e((string)($aiData['tipo'] ?? '-')) ?></div>
                            <div><strong>Consiglio:</strong> <?= e((string)($aiData['suggerimento'] ?? '-')) ?></div>
                        <?php else: ?>
                            <div><?= e((string)$row['risultato_json']) ?></div>
                        <?php endif; ?>
                    </div>
                    <small class="text-secondary"><?= e((string)$row['timestamp']) ?></small>
                </div>
            <?php endforeach; ?>
        </div>
    </section>
</main>

<?php include 'includes/footer.php'; ?>