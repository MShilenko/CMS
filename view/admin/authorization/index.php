<?php includeView('admin.forms.header', ['title' => 'Авторизация']); ?>
<div class="card o-hidden border-0 shadow-lg my-5">
  <div class="card-body p-0">
    <!-- Nested Row within Card Body -->
    <div class="row">
      <div class="col-lg-6 d-none d-lg-block bg-login-image"></div>
      <div class="col-lg-6">
        <div class="p-5">
          <div class="text-center">
            <h1 class="h4 text-gray-900 mb-4">Авторизация</h1>
          </div>
          <?php if (!empty($error)): ?>
            <div class="alert alert-danger mt-2" role="alert"><?= $error ?></div>
          <?php endif; ?>
          <?= $form->render() ?>
          <hr>
          <div class="text-center">
            <a class="small" href="/registration">Зарегистрироваться!</a>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<?php includeView('admin.forms.footer'); ?>