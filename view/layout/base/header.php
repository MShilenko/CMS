<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <title><?= $title ?? 'Блог'?></title>

  <!-- Bootstrap core CSS -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

  <!-- Custom fonts for this template -->
  <link href="<?= FRONT_THEME_DIR ?>/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href='https://fonts.googleapis.com/css?family=Lora:400,700,400italic,700italic' rel='stylesheet' type='text/css'>
  <link href='https://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800' rel='stylesheet' type='text/css'>

  <!-- Custom styles for this template -->
  <link href="<?= FRONT_THEME_DIR ?>/css/clean-blog.min.css" rel="stylesheet">

  <link href="<?= THEMES_DIR ?>/custom/style.css" rel="stylesheet">

</head>

<body>

  <!-- Navigation -->
  <nav class="navbar navbar-expand-lg navbar-light fixed-top" id="mainNav">
    <div class="container">
      <a class="navbar-brand" href="/">Блог</a>
      <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
        Menu
        <i class="fas fa-bars"></i>
      </button>
      <div class="collapse navbar-collapse" id="navbarResponsive">
        <ul class="navbar-nav ml-auto">
          <li class="nav-item">
            <a class="nav-link" href="/">Главная</a>
          </li>
          <?php if (isset($user)): ?>
            <?php if ($user->isAdmin() || $user->isRedactor()): ?>
              <li class="nav-item">
                <a class="nav-link" href="/admin">Админка</a>
              </li>
            <?php endif; ?>  
            <li class="nav-item">
              <a class="nav-link" href="/personal-area">Личный кабинет</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="/logout">Выйти</a>
            </li>
          <?php else: ?>  
            <li class="nav-item">
              <a class="nav-link" href="/authorization">Авторизоваться</a>
            </li>
          <?php endif; ?>  
        </ul>
      </div>
    </div>
  </nav>

  <!-- Page Header -->
  <header class="masthead" style="background-image: url('<?= UPLOADS_DIR ?>/<?= $image ?>')">
    <div class="overlay"></div>
    <div class="container">
      <div class="row">
        <div class="col-lg-8 col-md-10 mx-auto">
          <div class="site-heading">
            <h1><?= $title ?? 'Блог'?></h1>
            <span class="subheading"><?= $description ?? 'Раздел блога'?></span>
          </div>
        </div>
      </div>
    </div>
  </header>

  <!-- Main Content -->
  <div class="container">
    <div class="row">
      