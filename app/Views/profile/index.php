<div class="container-fluid">
  <div class="row">
    <div class="col-md-3 col-xl-2 mb-4">
      <div class="list-group" id="list-tab" role="tablist">
        <a class="list-group-item list-group-item-action d-flex justify-content-between align-items-center active"
           id="list-orders-list" data-toggle="list" href="#profile" role="tab" aria-controls="profile">
          <span>Профиль</span>
        </a>
      </div>
    </div>

    <div class="col-md-9 col-xl-10 mb-4">
      <div class="tab-content" id="nav-tabContent">
        <div class="tab-pane fade show active" id="profile" role="tabpanel" aria-labelledby="list-orders-list">
          <div class="card mb-3">
            <div class="card-body">
              <form action="/profile" enctype="multipart/form-data" method="POST">
                <div class="input-group">
                  <div class="custom-file">
                    <input type="file" class="custom-file-input" id="images" name="images"
                           aria-describedby="inputGroupFileAddon">
                    <label class="custom-file-label" for="images">Выберите файл</label>
                  </div>

                  <div class="input-group-append">
                    <input type="hidden" name="downloadImage">
                    <button class="btn btn-info" type="submit" id="inputGroupFileAddon04">
                      Загрузить изображение
                    </button>
                  </div>
                </div>
              </form>

                <?php if (isset($_SESSION['errors'])): ?>
                    <?php foreach ($_SESSION['errors'] as $error): ?>
                    <ul class="my-4">
                      <li><?= $error ?></li>
                    </ul>
                    <?php endforeach ?>
                <?php endif ?>

                <?php if ($images): ?>
                  <div class="table-responsive">
                    <table class="table table-hover">
                      <thead>
                      <tr>
                        <th style="width: 5%">№</th>
                        <th style="width: 80%">Изображение</th>
                        <th style="width: 15%">Действие</th>
                      </tr>
                      </thead>

                      <tbody>
                      <?php foreach ($images as $image): ?>
                        <tr>
                          <td><?= $image['id'] ?></td>

                          <td>
                            <a class="group" href="uploads/images/profile/<?= $image['img'] ?>"><img src="<?= $image['img2'] ?>" alt="no alt"/></a>
                          </td>

                          <td>
                            <form action="/profile" method="POST">
                              <input type="hidden" name="delete" value="<?= $image['id'] ?>">

                              <button type="submit" class="btn btn-sm btn-danger"
                                      onclick="return confirm('Вы действительно хотите удалить изображение?')">Удалить
                              </button>
                            </form>
                          </td>
                        </tr>
                      <?php endforeach ?>
                      </tbody>
                    </table>
                  </div>
                <?php else: ?>
                  <div class="mt-4">
                    <p>Здесь пока ничего нет. Загрузите изображение.</p>
                  </div>
                <?php endif ?>
            </div>
          </div><!-- /.card -->
        </div><!-- /.tab-pane -->
      </div> <!-- /.tab-content -->
    </div> <!-- /.col-... -->
  </div> <!-- /.row -->
</div> <!-- /.container-fluid -->