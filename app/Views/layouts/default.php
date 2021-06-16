<?php

if (isset($_POST['logout'])) {
    unset($_SESSION['user']);
    header('Location: /');
}

?>
<!doctype html>
<html lang="ru">
<head>
  <meta charset="UTF-8">
  <meta name="viewport"
        content="width=device-width">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title><?= $title ? $title : 'Profile.loc' ?></title>
  <link rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css"
        integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l"
        crossorigin="anonymous">
  <link rel="stylesheet" href="/assets/fancybox/jquery.fancybox-1.3.4.css" type="text/css" media="screen" />
  <link rel="stylesheet" href="/assets/css/main.css">
</head>
<body>
<div id="app">
  <header>
    <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
      <div class="container-fluid">
        <a href="/" class="navbar-brand">PROFILE</a>

        <button type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                aria-expanded="false" aria-label="Toggle navigation"
                class="navbar-toggler">
          <span class="navbar-toggler-icon"></span>
        </button>

          <?php if (isset($_SESSION['user'])): ?>
            <div id="navbarSupportedContent" class="collapse navbar-collapse">
              <ul class="navbar-nav ml-auto">
                <li class="nav-item dropdown">
                  <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                     data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <span><?= $_SESSION['user']['login'] ?></span>
                    <span class="caret"></span>
                  </a>

                  <div aria-labelledby="navbarDropdown" class="dropdown-menu dropdown-menu-right">
                    <a href="/profile"
                       onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
                       class="dropdown-item">Выйти</a>

                    <form id="logout-form" action="/profile" method="POST"
                          style="display: none;">
                      <input type="hidden" name="logout">
                      <input type="hidden" name="_token"
                             value="5PUVkcKQpoa9rxFdTBjWfayoJhPeZkWb7G1wBEFF">
                    </form>
                  </div>
                </li>
              </ul>
            </div>
          <?php endif ?>
      </div>
    </nav>
  </header>

  <main class="py-4">
      <?= $content ?>
  </main>

  <footer></footer>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"
        integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj"
        crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns"
        crossorigin="anonymous"></script>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.4/jquery.min.js"></script>
<script src="/assets/fancybox/jquery.fancybox-1.3.4.pack.js"></script>
<script src="/assets/js/main.js"></script>
</body>
</html>