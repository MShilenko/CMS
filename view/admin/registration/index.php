<?php includeView('admin.forms.header', ['title' => 'Регистрация']); ?>
<div class="card o-hidden border-0 shadow-lg my-5">
  <div class="card-body p-0">
    <!-- Nested Row within Card Body -->
    <div class="row">
      <div class="col-lg-5 d-none d-lg-block bg-register-image"></div>
      <div class="col-lg-7">
        <div class="p-5">
          <div class="text-center">
            <h1 class="h4 text-gray-900 mb-4">Регистрация</h1>
          </div>
          <?php if (!empty($error)): ?>
            <div class="alert alert-danger mt-2" role="alert"><?= $error ?></div>
          <?php endif; ?>
          <?= $form->render() ?>
          <hr>
          <div class="text-center">
            <a class="small" href="/authorization">Уже есть аккаунт? Авторизуйтесь!</a>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- <script>
  addUser.onsubmit = async (e) => {
    e.preventDefault();

    let response = await fetch('/src/Modules/Validation/ModelRequestValidation.php', {
      method: 'POST',
      body: new FormData(addUser)
    });

    let result = await response.text();

    console.log(result);
  };
</script> -->

<?php includeView('admin.forms.footer'); ?>