<?php includeView('admin.header', ['title' => 'Новый пользователь']); ?>
<div class="admin-form-block">
  <?= $form->render(); ?>
</div>
<?php includeView('admin.footer'); ?>