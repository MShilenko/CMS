<h2 class="text-center">Комментарии</h2>
<?php if (isset($user)): ?>
  <?= $form->render(); ?>
<?php else: ?>
  <p>Для того чтобы оставить комментарий нужно <a href="/authorization">авторизоваться</a></p>
<?php endif; ?>
<?php if ($article->hasComments()): ?>
  <div class="container">
    <div class="row comment-box">
      <?php foreach ($article->comments as $comment): ?>
        <?php if ($comment->active || (isset($user) && $comment->hasRightToView($user))): ?>
          <div class="media col-lg-12<?= $comment->active ? '' : ' not-active' ?>">
            <div class="media-left">
              <img class="img-responsive user-photo" src="<?= UPLOADS_DIR . '/' ?><?= $comment->user->avatar->name ?? 'pr-default.png' ?>">
            </div>
            <div class="media-body">
                <h6 class="media-heading"><a href="/users/<?= $comment->user->id ?>"><?= $comment->user->name ?></a> | <span class="c-date"><?= $comment->updated_at ?? $comment->created_at ?><?= $comment->active ? '' : ' | Не утвержден' ?></span></h6>
                <p><?= $comment->comment ?></p>
            </div>
          </div>
        <?php endif; ?>    
      <?php endforeach; ?>    
    </div>
  </div>
<?php endif; ?>