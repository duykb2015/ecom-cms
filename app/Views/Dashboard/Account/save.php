<?= $this->extend('Dashboard/layout') ?>
<?= $this->section('content') ?>
<div class="pcoded-content">
    <div class="pcoded-inner-content">
        <!-- Main-body start -->
        <div class="main-body">
            <div class="page-wrapper">
                <!-- Page-header start -->
                <div class="page-header">
                    <div class="row align-items-end">
                        <div class="col-lg-12">
                            <div class="page-header-title">
                                <div class="d-inline">
                                    <h4><?= $title ?></h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Page-header end -->

                <!-- Page body start -->
                <div class="page-body">
                    <div class="row">
                        <div class="col-sm-12">
                            <!-- Basic Form Inputs card start -->
                            <div class="card">
                                <div class="card-block">
                                    <form id="form-monster" action="<?= base_url('dashboard/monster/save') ?>" method="POST">
                                        <input type="hidden" name="monster_id" value="<?= isset($monster['id']) ? $monster['id'] : '' ?>">
                                        <div class="form-group row">
                                            <label class="col-sm-2 col-form-label">Tên</label>
                                            <div class="col-sm-10">
                                                <input type="text" name="name" class="form-control" value="<?= isset($monster['name']) ? $monster['name'] : '' ?>">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-sm-2 col-form-label">Tên (Sau khi tiến hóa)</label>
                                            <div class="col-sm-10">
                                                <input type="text" name="name_awakened" class="form-control" value="<?= isset($monster['name_awakened']) ? $monster['name_awakened'] : '' ?>">
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label class="col-sm-2 col-form-label">Loại</label>
                                            <div class="col-sm-10">
                                                <select class="form-control" name="type">
                                                    <option <?= isset($monster['type']) && $monster['type'] == 'Water' ? 'selected' : '' ?> value="Water">Water</option>
                                                    <option <?= isset($monster['type']) && $monster['type'] == 'Wind' ? 'selected' : '' ?> value="Wind">Wind</option>
                                                    <option <?= isset($monster['type']) && $monster['type'] == 'Fire' ? 'selected' : '' ?> value="Fire">Fire</option>
                                                    <option <?= isset($monster['type']) && $monster['type'] == 'Light' ? 'selected' : '' ?> value="Light">Light</option>
                                                    <option <?= isset($monster['type']) && $monster['type'] == 'Dark' ? 'selected' : '' ?> value="Dark">Dark</option>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label class="col-sm-2 col-form-label">Loại</label>
                                            <div class="col-sm-10">
                                                <select class="form-control" name="rating">
                                                    <?php for ($i = 1; $i <= 5; $i++) : ?>
                                                        <option <?= isset($monster['rating']) && $monster['rating'] == $i ? 'selected' : '' ?> value="<?= $i ?>"><?= $i ?></option>
                                                    <?php endfor ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-sm-2 col-form-label">Trạng thái</label>
                                            <div class="col-sm-10">
                                                <select class="form-control" name="status">
                                                    <?php foreach (STATUS_CMS as $key => $val) : ?>
                                                        <option <?= isset($monster['status']) && $monster['status'] == $key ? 'selected' : '' ?> value="<?= $key ?>"><?= $val ?></option>
                                                    <?php endforeach ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-sm-2 col-form-label">Ảnh quái vật</label>
                                            <div class="col-sm-9">
                                                <input type="text" name="avatar" class="form-control" value="<?= isset($monster['avatar']) ? $monster['avatar'] : '' ?>">
                                            </div>
                                            <div class="col-sm-1">
                                                <?php if ($monster['avatar'] != 'none' || $monster['avatar'] == '') : ?>
                                                    <a href="<?= $monster['avatar'] ?>" target="_blank"><img src="<?= $monster['avatar'] ?>" width="40" height="40" alt="Monster avatar"></a>
                                                <?php else : ?>
                                                    <p>Không có ảnh</p>
                                                <?php endif ?>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-sm-2 col-form-label">Ảnh quái vật (sau khi tiến hóa)</label>
                                            <div class="col-sm-9">
                                                <input type="text" name="avatar_awakened" class="form-control" value="<?= isset($monster['avatar_awakened']) ? $monster['avatar_awakened'] : '' ?>">
                                            </div>
                                            <div class="col-sm-1">
                                                <?php if ($monster['avatar_awakened'] != 'none' || $monster['avatar_awakened'] == '') : ?>
                                                    <a href="<?= $monster['avatar_awakened'] ?>" target="_blank"><img src="<?= $monster['avatar_awakened'] ?>" width="40" height="40" alt="Monster avatar"></a>
                                                <?php else : ?>
                                                    <p>Không có ảnh</p>
                                                <?php endif ?>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <label class="col-sm-2"></label>
                                            <div class="col-sm-10 text-right">
                                                <button type="submit" class="btn btn-primary m-b-0 ">Submit</button>
                                                <a href="<?= base_url('dashboard/monster') . '?page=' . $_GET['page'] ?>" class="btn btn-outline-secondary m-b-0 ">Cancel</a>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Page body end -->
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>

<?= $this->section('js') ?>
<script>
    const form = document.getElementById('form-monster');
    form.addEventListener('submit', (e) => {
        // stop form submission
        e.preventDefault();

        const data = new FormData(form);
        var requestOptions = {
            method: 'POST',
            body: data,
            redirect: 'follow'
        };

        fetch(form.action, requestOptions)
            .then(response => response.json())
            .then(result => {
                if (result.success) {
                    redirect_url(result.result.url_redirect)
                    return
                }

                const errors = result.result.errors;
                if (errors) {
                    for (var key in errors) {
                        if (errors.hasOwnProperty(key)) {
                            msgbox_error(errors[key])
                            break
                        }
                    }
                }

            })
            .catch(error => msgbox_error('Có lỗi xảy ra. Vui lòng thử lại!'));
    });
</script>

<?= $this->endSection() ?>