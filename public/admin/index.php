<?php
require_once __DIR__ . '/../../config/config.php'; require_admin();
$counts = [
'Services actifs' => (int)db()->query('SELECT COUNT(*) FROM services WHERE is_active=1')->fetchColumn(),
'Véhicules' => (int)db()->query('SELECT COUNT(*) FROM vehicles')->fetchColumn(),
'Nouvelles demandes' => (int)db()->query("SELECT COUNT(*) FROM quote_requests WHERE status='Nouvelle'")->fetchColumn(),
'Messages reçus' => (int)db()->query('SELECT COUNT(*) FROM contact_messages')->fetchColumn()
];
$recent = db()->query('SELECT * FROM quote_requests ORDER BY created_at DESC LIMIT 8')->fetchAll();
include '_header.php'; ?>
<div class="admin-title"><span class="eyebrow">APERÇU</span><h1>Tableau de bord</h1><p>Bienvenue dans l'espace d'administration de GMS PLUS.</p></div>
<div class="stats-grid"><?php foreach($counts as $label=>$count): ?><div class="stat-card"><span><?= e($label) ?></span><strong><?= $count ?></strong></div><?php endforeach; ?></div>
<div class="panel"><div class="panel-heading"><h2>Demandes récentes</h2><a href="requests.php">Voir tout →</a></div><div class="table-wrap"><table><thead><tr><th>Client</th><th>Service</th><th>Téléphone</th><th>Statut</th><th>Date</th></tr></thead><tbody>
<?php foreach($recent as $r): ?><tr><td><?= e($r['full_name']) ?></td><td><?= e($r['service_type']) ?></td><td><?= e($r['phone']) ?></td><td><span class="status"><?= e($r['status']) ?></span></td><td><?= e($r['created_at']) ?></td></tr><?php endforeach; ?>
<?php if(!$recent): ?><tr><td colspan="5">Aucune demande pour le moment.</td></tr><?php endif; ?></tbody></table></div></div>
<?php include '_footer.php'; ?>
