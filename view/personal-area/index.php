<?php includeView('base.header', ['title' => 'Профиль', 'description' => 'Персональный раздел']); ?>
  <section id="profile">
    <div class="profile-card">
      <div class="photo"><img src="<?= UPLOADS_DIR ?>/<?= $user->avatar->name ?? 'pr-default.png' ?>"></div>
      <div class="text-info-outer">
        <div class="text-info-inner">
          <h1><?= $user->name?></h1>
          <h3><?= $user->email?></h3>
          <p><?= $user->about ?? 'Расскажите о себе...' ?></p>
        </div>
      </div>
      <div class="clear"></div>
      <hr>
      <h2 class="text-center">Обновить информацию</h2>
      <?= $form->render(); ?>
    </div>
  </section>
<?php includeView('base.footer'); ?>