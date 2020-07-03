<?php includeView('admin.header', ['title' => $title]); ?>
<?php if ($user->isAdmin()): ?>
  <div class="col-xl-3 col-md-6 mb-4">
    <div class="card border-left-primary shadow h-100 py-2">
      <div class="card-body">
        <div class="row no-gutters align-items-center">
          <div class="col mr-2">
            <div class="mb-1"><a class="font-weight-bold text-primary text-uppercase" href="/admin/users">Пользователи</a></div>
            <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $usersCount; ?></div>
          </div>
          <div class="col-auto">
            <i class="fas fa-user fa-2x text-gray-300"></i>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="col-xl-3 col-md-6 mb-4">
    <div class="card border-left-success shadow h-100 py-2">
      <div class="card-body">
        <div class="row no-gutters align-items-center">
          <div class="col mr-2">
            <div class="mb-1"><a class="font-weight-bold text-success text-uppercase" href="/admin/subscribes">Подписки</a></div>
            <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $subscribesCount; ?></div>
          </div>
          <div class="col-auto">
            <i class="fas fa-envelope fa-2x text-gray-300"></i>
          </div>
        </div>
      </div>
    </div>
  </div>
<?php endif; ?>  

<div class="col-xl-3 col-md-6 mb-4">
  <div class="card border-left-info shadow h-100 py-2">
    <div class="card-body">
      <div class="row no-gutters align-items-center">
        <div class="col mr-2">
          <div class="mb-1"><a class="font-weight-bold text-info text-uppercase" href="/admin/articles">Статьи</a></div>
          <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $articlesCount; ?></div>
        </div>
        <div class="col-auto">
          <i class="fas fa-book fa-2x text-gray-300"></i>
        </div>
      </div>
    </div>
  </div>
</div>

<div class="col-xl-3 col-md-6 mb-4">
  <div class="card border-left-warning shadow h-100 py-2">
    <div class="card-body">
      <div class="row no-gutters align-items-center">
        <div class="col mr-2">
          <div class="mb-1"><a class="font-weight-bold text-warning text-uppercase" href="/admin/comments">Комментарии</a></div>
          <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $commentsCount; ?></div>
        </div>
        <div class="col-auto">
          <i class="fas fa-comments fa-2x text-gray-300"></i>
        </div>
      </div>
    </div>
  </div>
</div>
<?php includeView('admin.footer'); ?>
    
