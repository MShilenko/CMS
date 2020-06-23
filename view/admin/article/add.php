<?php includeView('admin.header', ['title' => 'Новая статья']); ?>
<div class="admin-form-block">
  <?= $form->render(); ?>
</div>
<?php includeView('admin.footer'); ?>