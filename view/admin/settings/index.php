<?php includeView('admin.header', ['title' => 'Настройки']); ?>
<div class="admin-form-block">
  <?= $form->render(); ?>
</div>
<?php includeView('admin.footer'); ?>