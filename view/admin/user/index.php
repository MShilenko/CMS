<?php includeView('admin.header', ['title' => 'Пользователи']); ?>
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
          </tr>
        </thead>
        <tbody>
          <?php foreach ($users as $user): ?>
            <tr>
              <td><?= $user->id ?></td>
              <td><?= $user->name ?></td>
              <?php $form->setParams(['userId' => $user->id]); ?>
              <td><?= $form->render() ?></td>
            </tr>
        <?php endforeach; ?>
        </tbody>
      </table>
    </div>
  </div>
</div>
<?php includeView('admin.footer'); ?>