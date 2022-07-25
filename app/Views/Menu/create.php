<?= $this->extend('layout') ?>
<?= $this->section('content') ?>
<div class="pcoded-content">
    <div class="pcoded-inner-content">
        <!-- Main-body start -->
        <div class="main-body">
            <div class="page-wrapper">
                <!-- Page-header start -->
                <div class="page-header">
                    <div class="row align-items-end">
                        <div class="col-lg-8">
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
                                    <?php $id = $_GET['id'] ? $_GET['id'] : '' ?>
                                    <form id="form-menu" action="<?= base_url('menu/create') . '?id=' .  $id ?>" method="POST">
                                        <input type="hidden" name="menu_id" value="<?= isset($menu['id']) ? $menu['id'] : '' ?>">
                                        <div class="form-group row">
                                            <label class="col-sm-2 col-form-label">Tên</label>
                                            <div class="col-sm-10">
                                                <input type="text" name="name" class="form-control" value="<?= isset($menu['name']) ? $menu['name'] : '' ?>">
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label class="col-sm-2 col-form-label">Menu Cha</label>
                                            <div class="col-sm-10">
                                                <select class="form-control" name="parent_id">
                                                    <option value="0">Không chọn</option>
                                                    <?php foreach ($parent_menus as $val) : ?>
                                                        <option <?= isset($menu['parent_id']) && $menu['parent_id'] == $val['id'] ? 'selected' : '' ?> value="<?= $val['id'] ?>"><?= $val['name'] ?></option>
                                                    <?php endforeach ?>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label class="col-sm-2 col-form-label">Loại</label>
                                            <div class="col-sm-10">
                                                <select class="form-control" name="type">
                                                    <?php foreach (MENU_TYPE as $key => $val) : ?>
                                                        <option <?= isset($menu['type']) && $menu['type'] == $key ? 'selected' : '' ?> value="<?= $key ?>"><?= $val ?></option>
                                                    <?php endforeach ?>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label class="col-sm-2 col-form-label">Trạng thái</label>
                                            <div class="col-sm-10">
                                                <select class="form-control" name="status">
                                                    <?php foreach (STATUS_CMS as $key => $val) : ?>
                                                        <option <?= isset($menu['status']) && $menu['status'] == $key ? 'selected' : '' ?> value="<?= $key ?>"><?= $val ?></option>
                                                    <?php endforeach ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <label class="col-sm-2"></label>
                                            <div class="col-sm-10 text-right">
                                                <button type="submit" class="btn btn-primary m-b-0 ">Submit</button>
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
    const form = document.getElementById('form-menus');
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
            .catch(error => msgbox_error());
    });
</script>

<?= $this->endSection() ?>