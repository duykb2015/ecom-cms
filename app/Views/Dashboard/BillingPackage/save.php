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
                                    <form id="form-package" action="<?= base_url('dashboard/billing/package/save') ?>" method="POST">
                                        <input type="hidden" name="package_id" value="<?= isset($package['id']) ? $package['id'] : '' ?>">
                                        <div class="form-group row">
                                            <label class="col-sm-2 col-form-label">Tên</label>
                                            <div class="col-sm-10">
                                                <input type="text" name="name" class="form-control" value="<?= isset($package['name']) ? $package['name'] : '' ?>">
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label class="col-sm-2 col-form-label">Mô tả</label>
                                            <div class="col-sm-10">
                                                <textarea name="description" rows="4" class="form-control"><?= isset($package['description']) ? $package['description'] : '' ?></textarea>
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label class="col-sm-2 col-form-label">Giá</label>
                                            <div class="col-sm-10">
                                                <input type="number" name="lt_coin" class="form-control" value="<?= isset($package['lt_coin']) ? $package['lt_coin'] : '' ?>">
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label class="col-sm-2 col-form-label">Loại</label>
                                            <div class="col-sm-10">
                                                <select class="form-control" name="type">
                                                    <?php foreach (PACKAGE_TYPE as $key => $val) : ?>
                                                        <option <?= isset($package['type']) && $package['type'] == $key ? 'selected' : '' ?> value="<?= $key ?>"><?= $val ?></option>
                                                    <?php endforeach ?>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label class="col-sm-2 col-form-label">Trạng thái</label>
                                            <div class="col-sm-10">
                                                <select class="form-control" name="status">
                                                    <?php foreach (STATUS_CMS as $key => $val) : ?>
                                                        <option <?= isset($package['status']) && $package['status'] == $key ? 'selected' : '' ?> value="<?= $key ?>"><?= $val ?></option>
                                                    <?php endforeach ?>
                                                </select>
                                            </div>
                                        </div>
                                        
                                        <div class="row">
                                            <label class="col-sm-2"></label>
                                            <div class="col-sm-10 text-right">
                                                <button type="submit" class="btn btn-primary m-b-0 ">Xác nhận</button>
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
    const form = document.getElementById('form-package');
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