<?php
require_once __DIR__ . '/../../config/config.php'; require_admin();
$keys = ['company_name'=>'Nom de l’entreprise','tagline'=>'Slogan','phone'=>'Téléphone','email'=>'Email','address'=>'Adresse','hero_title'=>'Titre de la bannière','hero_text'=>'Texte de la bannière','about_text'=>'Présentation de l’entreprise'];
if ($_SERVER['REQUEST_METHOD']==='POST') {
 verify_csrf();
 $stmt=db()->prepare('INSERT INTO settings(setting_key,setting_value) VALUES(?,?) ON DUPLICATE KEY UPDATE setting_value=VALUES(setting_value)');
 foreach($keys as $key=>$label) { $value=trim((string)($_POST[$key] ?? '')); if(mb_strlen($value)>5000) continue; $stmt->execute([$key,$value]); }
 db()->prepare('INSERT INTO activity_logs(admin_id,action,details) VALUES(?,?,?)')->execute([$_SESSION['admin_id'],'Modification des contenus','Paramètres généraux du site']);
 $saved=true;
}
include '_header.php'; ?>
<div class="admin-title"><span class="eyebrow">CMS</span><h1>Contenus du site</h1><p>Modifiez les textes et coordonnées affichés sur le site public.</p></div>
<?php if(!empty($saved)): ?><div class="success">Modifications enregistrées.</div><?php endif; ?>
<form class="panel editor-form" method="post"><input type="hidden" name="csrf" value="<?= e(csrf_token()) ?>">
<?php foreach($keys as $key=>$label): $value=setting($key); ?><label><?= e($label) ?><?php if(in_array($key,['hero_text','about_text'])): ?><textarea name="<?= e($key) ?>" rows="4"><?= e($value) ?></textarea><?php else: ?><input name="<?= e($key) ?>" value="<?= e($value) ?>" maxlength="5000"><?php endif; ?></label><?php endforeach; ?>
<button class="btn" type="submit">Enregistrer les modifications</button></form>
<?php include '_footer.php'; ?>
