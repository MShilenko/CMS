<?php includeView('admin.header', ['title' => 'Пользователи']); ?>
<div class="admin-add-button mb-3">
  <a href="/admin/users/add" class="btn btn-primary mr-1"><i class="fas fa-fw fa-user"></i> Добавить пользователя</a>
</div>
<div class="card shadow mb-4">
  <div class="card-header py-3">
    <h6 class="m-0 font-weight-bold text-primary">Список пользователей сайта</h6>
  </div>
  <div class="card-body">
    <div class="table-responsive">
      <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
        <thead>
          <tr>
            <th>Id</th>
            <th>Имя</th>
            <th>Роли</th>
            <th></th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($users as $user): ?>
            <tr class="user-edit<?= $user->trashed() ? ' trashed' : '' ?>">
              <td><?= $user->id ?></td>
              <td><?= $user->name ?></td>
              <?php $form->setParams(['userId' => $user->id]); ?>
              <td><?= $form->render() ?></td>
              <td class="d-flex align-items-start">
                <?php $switchForm->setParams(['userId' => $user->id]); ?>
                <?= $switchForm->render(); ?>
                </td>
            </tr>
        <?php endforeach; ?>
        </tbody>
      </table>
    </div>
  </div>
</div>
<?php includeView('admin.footer'); ?>