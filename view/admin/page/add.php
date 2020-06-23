<?php includeView('admin.header', ['title' => 'Новая страница']); ?>
<div class="admin-form-block">
  <?= $form->render(); ?>
</div>
<?php includeView('admin.footer'); ?>