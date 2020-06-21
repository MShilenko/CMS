<?php includeView('admin.header', ['title' => 'Подписки']); ?>
<div class="card shadow mb-4 admin-subscribes">
  <div class="card-header py-3">
    <h6 class="m-0 font-weight-bold text-primary">Список подписанных на рассылку почтовых ящиков</h6>
  </div>
  <div class="card-body">
    <div class="table-responsive">
      <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
        <thead>
          <tr>
            <th>Id</th>
            <th>E-mail</th>
            <th></th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($subscribes as $subscribe): ?>
            <tr class="subscibe-edit">
              <td><?= $subscribe->id ?></td>
              <td><?= $subscribe->email ?></td>
              <?php $form->setParams(['subscribeId' => $subscribe->id]) ?>
              <td><?= $form->render() ?></td>
            </tr>
        <?php endforeach; ?>
        </tbody>
      </table>
    </div>
  </div>
</div>
<?php includeView('admin.footer'); ?>