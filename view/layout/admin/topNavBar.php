<?php 

$topBarSubscribes = ['list' => \App\Models\Subscribe::limit(5)->orderBy('id', 'desc')->get(), 'count' => \App\Models\Subscribe::count()]; 
$topBarUsers = ['list' => \App\Models\User::limit(5)->orderBy('created_at', 'desc')->get(), 'count' => \App\Models\User::withTrashed()->count()];
$topBarComments = ['list' => \App\Models\Comment::limit(5)->orderBy('created_at', 'desc')->get(), 'count' => \App\Models\Comment::count()];
?>
<?php if ($user->isAdmin()): ?>
<!-- Nav Item - Messages -->
<li class="nav-item dropdown no-arrow mx-2">
  <a class="nav-link dropdown-toggle" href="#" id="messagesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
    <i class="fas fa-user fa-fw"></i>
    <!-- Counter - Messages -->
    <span class="badge badge-danger badge-counter"><?= $topBarUsers['count'] ?></span>
  </a>
  <!-- Dropdown - Messages -->
  <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="messagesDropdown">
    <h6 class="dropdown-header">
      Новые пользователи
    </h6>
    <?php foreach ($topBarUsers['list'] as $tbUser): ?>
      <div class="dropdown-item d-flex align-items-center">
        <div class="font-weight-bold">
          <div class="text-truncate"><a href="/users/<?= $tbUser->id ?>"><?= $tbUser->name ?> | <?= $tbUser->email ?></div>
        </div>
      </div>
    <?php endforeach; ?>  
    <a class="dropdown-item text-center small text-gray-500" href="/admin/users">Перейти к редактированию пользователей</a>
  </div>
</li>
<li class="nav-item dropdown no-arrow mx-1">
  <a class="nav-link dropdown-toggle" href="#" id="messagesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
    <i class="fas fa-envelope fa-fw"></i>
    <!-- Counter - Messages -->
    <span class="badge badge-danger badge-counter"><?= $topBarSubscribes['count'] ?></span>
  </a>
  <!-- Dropdown - Messages -->
  <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="messagesDropdown">
    <h6 class="dropdown-header">
      Последние подписки
    </h6>
    <?php foreach ($topBarSubscribes['list'] as $subscribe): ?>
      <div class="dropdown-item d-flex align-items-center">
        <div class="font-weight-bold">
          <div class="text-truncate"><?= $subscribe->email ?></div>
        </div>
      </div>
    <?php endforeach; ?>  
    <a class="dropdown-item text-center small text-gray-500" href="/admin/subscribes">Перейти к редактированию подписок</a>
  </div>
</li>
<?php endif; ?>
<li class="nav-item dropdown no-arrow mx-1">
  <a class="nav-link dropdown-toggle" href="#" id="messagesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
    <i class="fas fa-comments fa-fw"></i>
    <!-- Counter - Messages -->
    <span class="badge badge-danger badge-counter"><?= $topBarComments['count'] ?></span>
  </a>
  <!-- Dropdown - Messages -->
  <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="messagesDropdown">
    <h6 class="dropdown-header">
      Последние комментарии
    </h6>
    <?php foreach ($topBarComments['list'] as $comment): ?>
      <div class="dropdown-item d-flex align-items-center">
        <div class="font-weight-bold">
          <div class="text-truncate"><a href="/articles/<?= $comment->article->slug ?>"><?= $comment->article->title ?></a></div>
          <div class="small "><?= shortLine($comment->comment, 50) ?></div>
        </div>
      </div>
    <?php endforeach; ?>  
    <a class="dropdown-item text-center small text-gray-500" href="/admin/comments">Перейти к редактированию комментариев</a>
  </div>
</li>

<div class="topbar-divider d-none d-sm-block"></div>

<!-- Nav Item - User Information -->
<li class="nav-item dropdown no-arrow">
  <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
    <span class="mr-2 d-none d-lg-inline text-gray-600 small"><?= $user->name ?></span>
    <img class="img-profile rounded-circle" src="<?= UPLOADS_DIR ?>/<?= $user->avatar->name ?? 'pr-default.png' ?>">
  </a>
  <!-- Dropdown - User Information -->
  <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
    <a class="dropdown-item" href="/personal-area">
      <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
      Профиль
    </a>
    <div class="dropdown-divider"></div>
    <a class="dropdown-item" href="/logout">
      <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
      Выйти
    </a>
  </div>
</li>