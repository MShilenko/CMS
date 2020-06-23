<?php includeView('base.header', ['title' => 'Профиль', 'description' => 'Персональный раздел']); ?>
  <section id="profile">
    <div class="profile-card">
      <div class="photo"><img src="<?= UPLOADS_DIR ?>/<?= $currentUser->avatar->name ?? 'pr-default.png' ?>"></div>
      <div class="text-info-outer">
        <div class="text-info-inner">
          <h1><?= $currentUser->name?></h1>
          <h3><?= $currentUser->email?></h3>
          <p><?= $currentUser->about ?? '...' ?></p>
        </div>
      </div>
    </div>
    <div class="clear"></div>
  </section>
<?php includeView('base.footer'); ?>