<?= $this->extend('layout') ?>

<?= $this->section('content') ?>

<div class="pcoded-content">
    <div class="pcoded-inner-content">
        <div class="main-body">
            <div class="page-wrapper">
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

                <div class="page-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="card">
                                <div class="card-header">
                                    <?php $errors = session()->getFlashdata('error_msg') ?>
                                    <?php if (isset($errors)) : ?>
                                        <?php if (!is_array($errors)) : ?>
                                            <div class="alert alert-danger">
                                                <div class="col-11">
                                                    <?= $errors ?>
                                                </div>
                                                <div class="col-1 text-right">
                                                    <span aria-hidden="true" id="remove-alert">&times;</span>
                                                </div>
                                            </div>
                                        <?php else : ?>
                                            <?php foreach ($errors as $error) : ?>
                                                <div class="alert alert-danger mb-1">
                                                    <div class="row">
                                                        <div class="col-11">
                                                            <?= $error ?>
                                                        </div>
                                                        <div class="col-1 text-right">
                                                            <span aria-hidden="true" id="remove-alert">&times;</span>
                                                        </div>
                                                    </div>
                                                </div>
                                            <?php endforeach ?>
                                        <?php endif ?>
                                    <?php endif ?>
                                </div>

                                <div class="card-block">
                                    <div class="edit-info">
                                        <div class="row">
                                            <div class="col-lg-12">
                                                <form action="<?= base_url('user/save') ?>" method="post">
                                                    <input type="hidden" name="id" value="<?= isset($account['id']) ? $account['id'] : '' ?>">
                                                    <div class="general-info">
                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <label for="username">Tên tài khoản</label>
                                                                <div class="input-group">
                                                                    <input type="text" class="form-control" value="<?= isset($account['username']) ? $account['username'] : set_value('username') ?>" name="username" required placeholder="Tên ...">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <label for="password">Mật khẩu</label>
                                                                <div class="input-group">
                                                                    <input type="password" name="password" class="form-control" required placeholder="Mật khẩu ...">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <label for="email">Email</label>
                                                                <div class="input-group">
                                                                    <input type="email" class="form-control" value="<?= isset($account['email']) ? $account['email'] : set_value('email') ?>" name="email" required placeholder="Email ...">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <label for="phone">Số điện thoại</label>
                                                                <div class="input-group">
                                                                    <input type="number" value="<?= isset($account['phone']) ? $account['phone'] : set_value('phone') ?>" name="phone" class="form-control" placeholder="Số điện thoại ...">
                                                                </div>
                                                            </div>

                                                        </div>
                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <label for="address">Địa chỉ</label>
                                                                <div class="input-group">
                                                                    <input type="text" class="form-control" value="<?= isset($account['address']) ? $account['address'] : set_value('address') ?>" name="address" placeholder="Địa chỉ ...">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <label for="status">Trạng thái</label>
                                                                <div class="input-group">
                                                                    <select name="status" class="form-control">
                                                                        <option value="1" <?= isset($account['status']) && $account['status'] == 1 ? 'selected' : '' ?>>Bình thường</option>
                                                                        <option value="0" <?= isset($account['status']) && $account['status'] == 0 ? 'selected' : '' ?>>Bị cấm</option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-md-12 text-right">
                                                                <button type="submit" class="btn btn-primary waves-effect waves-light m-r-20">Lưu</button>
                                                                <a href="<?= base_url('admin/') ?>" id="edit-cancel" class="btn btn-default waves-effect">Huỷ</a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card">
                                    <div class="card-header">
                                        <h5>Ajax Data Source (Arrays)</h5>
                                        <span>The example below shows DataTables loading data for a table from arrays as the data source, where the structure of the row's data source in this example is:</span>

                                    </div>
                                    <div class="card-block">
                                        <div class="table-responsive dt-responsive">
                                            <table id="dt-ajax-object" class="table table-striped table-bordered nowrap">
                                                <thead>
                                                    <tr>
                                                        <th>ID</th>
                                                        <th>Product Name</th>
                                                        <th>Product Color</th>
                                                        <th>Discount</th>
                                                        <th>Quantity</th>
                                                        <th>Price</th>
                                                    </tr>
                                                </thead>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>

<?= $this->section('js') ?>


<script>
    // $('#dt-ajax-object').DataTable({
    //     "ajax": "<?= base_url('user/get-shoping-cart') ?>",
    //     "columns": [{
    //             "data": "id"
    //         },
    //         {
    //             "data": "product_name"
    //         },
    //         {
    //             "data": "color"
    //         },
    //         {
    //             "data": "discount"
    //         },
    //         {
    //             "data": "quantity"
    //         },
    //         {
    //             "data": "price"
    //         }
    //     ]
    // });
</script>
<?= $this->endSection() ?>