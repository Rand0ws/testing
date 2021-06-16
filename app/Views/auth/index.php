<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-8 col-lg-6">
      <div class="card">
        <div class="card-header">
          <ul role="tablist" class="nav nav-tabs">
            <li class="nav-item">
              <a data-toggle="tab" href="#auth" role="tab" class="nav-link active" aria-selected="true">Авторизация</a>
            </li>

            <li class="nav-item">
              <a data-toggle="tab" href="#registration" role="tab" class="nav-link"
                 aria-selected="false">Регистрация</a>
            </li>
          </ul>
        </div>

        <div class="card-body">
          <div class="tab-content">
            <div id="auth" role="tabpanel" class="tab-pane active">
              <form action="/" method="POST">
                <div class="form-group">
                  <input class="form-control" type="text" name="login" placeholder="Логин">
                </div>

                <div class="form-group">
                  <input class="form-control" type="password" name="password" placeholder="Пароль">
                </div>

                <input type="hidden" name="auth">
                <button type="submit" class="btn btn-primary">Авторизоваться</button>
              </form>
            </div>

            <div id="registration" role="tabpanel" class="tab-pane">
              <form action="/" method="POST">
                <div class="form-group">
                  <input class="form-control" type="text" name="login" placeholder="Ваше имя">
                </div>

                <div class="form-group">
                  <input class="form-control" type="password" name="password" placeholder="Пароль">
                </div>

                <div class="form-group">
                  <input class="form-control" type="password" name="confirm_password" placeholder="Подтверждение пароля">
                </div>

                <input type="hidden" name="registration">
                <button type="submit" class="btn btn-primary">Зарегистрироваться</button>
              </form>
            </div>
          </div>

            <?php if (isset($_SESSION['errors'])): ?>
                <?php foreach ($_SESSION['errors'] as $error): ?>
                <ul class="mt-4">
                  <li class="text-danger"><?= $error ?></li>
                </ul>
                <?php endforeach ?>
            <?php endif ?>

            <?php if (isset($_SESSION['success'])): ?>
                <ul class="mt-4">
                  <li class="text-success"><?= $_SESSION['success']; unset($_SESSION['success']) ?></li>
                </ul>
            <?php endif ?>
        </div><!-- /.card-body -->
      </div><!-- /.card -->
    </div><!-- /.col-md-4 -->
  </div><!-- /.row -->
</div>