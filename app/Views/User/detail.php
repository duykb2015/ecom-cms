<?= $this->extend('layout') ?>

<?= $this->section('css') ?>
<?= $this->endSection() ?>

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

                            </div>
                        </div>
                    </div>
                    <input type="hidden" id="user_id" name="user_id" value="<?= $account['id'] ? $account['id'] : '' ?>">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="card">
                                <div class="card-header">
                                    <div class="row">
                                        <div class="col-sm-10">
                                            <h4>Giỏ Hàng</h4>
                                        </div>
                                        <div class="col-sm-2 float-right">
                                            <button type="button" id="viewCartData" class="btn btn-primary m-b-20">Xem <i class="fa fa-spinner fa-pulse fa-lg loading"></i></button>
                                            <button type="button" id="closeCartData" class="btn btn-outline-danger m-b-20">Đóng</button>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="table-responsive dt--responsive">
                                        <div class="col-sm-12">
                                            <table id="shoping-cart-table" class="table table-striped table-bordered nowrap">
                                                <thead>
                                                    <tr>
                                                        <th>Product Name</th>
                                                        <th>Product Color</th>
                                                        <th>Quantity</th>
                                                        <th>Price</th>
                                                    </tr>
                                                </thead>
                                                <tbody id="cartData">

                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-12">
                            <div class="card">
                                <div class="card-header">
                                    <div class="row">
                                        <div class="col-sm-10">
                                            <h4>Giao Dịch Đã Thực Hiện</h4>
                                        </div>
                                        <div class="col-sm-2 float-right">
                                            <button type="button" id="viewTransactionData" class="btn btn-primary m-b-20">Xem <i class="fa fa-spinner fa-pulse fa-lg loading1"></i></button>
                                            <button type="button" id="closeTransactionData" class="btn btn-outline-danger m-b-20">Đóng</button>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="table-responsive dt--responsive">
                                        <div class="col-sm-12">
                                            <table id="shoping-cart-table" class="table table-striped table-bordered nowrap">
                                                <thead>
                                                    <tr>
                                                        <th>Mã Giao Dịch</th>
                                                        <th>Product Name</th>
                                                        <th>Product Color</th>
                                                        <th>Quantity</th>
                                                        <th>Price</th>
                                                        <th>Trạng thái</th>
                                                        <th>Quản lý</th>
                                                    </tr>
                                                </thead>
                                                <tbody id="transactionData">

                                                </tbody>
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
    $('.loading').hide()
    $('.loading1').hide()
    $('#viewCartData').on('click', function() {
        $('.loading').show()
        var user_id = document.getElementById('user_id')
        var requestOptions = {
            method: 'POST',
            body: user_id,
            redirect: 'follow'
        }
        fetch('<?= base_url('user/get-shoping-cart') ?>', requestOptions)
            .then(response => response.json())
            .then(result => {
                if (result.success) {
                    var row
                    for (let i = 0; i < result.result.length; i++) {
                        row += '<tr role="row" class="rowData1"> <td>' + result.result[i].product_name +
                            '</td><td>' + result.result[i].color +
                            '</td><td>' + result.result[i].quantity +
                            '</td><td>' + Intl.NumberFormat('vi-VN', {
                                style: 'currency',
                                currency: 'VND'
                            }).format(result.result[i].price - (result.result[i].price * result.result[i].discount / 100)) +
                            '</td></tr>'
                    }
                    $('.rowData1').remove()
                    $('#cartData').append(row)
                    $('.loading').hide()
                    return
                }

                const error = result.result.error;
                if (error) {
                    msgbox_error(error)
                    return
                }

            })
            .catch(error => msgbox_error(error));
    })
    $('#viewTransactionData').on('click', function() {
        $('.loading1').show()
        var user_id = document.getElementById('user_id')
        var requestOptions = {
            method: 'POST',
            body: user_id,
            redirect: 'follow'
        }
        fetch('<?= base_url('user/get-transaction') ?>', requestOptions)
            .then(response => response.json())
            .then(result => {
                if (result.success) {
                    var row
                    for (let i = 0; i < result.result.length; i++) {
                        row += '<tr role="row" class="rowData2"><td>' + result.result[i].code +
                            '</td><td>' + result.result[i].product_name +
                            '</td><td>' + result.result[i].color +
                            '</td><td>' + result.result[i].quantity +
                            '</td><td>' + Intl.NumberFormat('vi-VN', {
                                style: 'currency',
                                currency: 'VND'
                            }).format(result.result[i].price - (result.result[i].price * result.result[i].discount / 100)) +
                            '</td><td>' + result.result[i].status +
                            '</td><td><a href="<?= base_url('trasaction/detail') ?>/' + result.result[i].id + '">Xem chi tiết</a></td></tr>'
                    }
                    $('.rowData2').remove()
                    $('#transactionData').append(row)
                    $('.loading1').hide()
                    return
                }

                const error = result.result.error;
                if (error) {
                    msgbox_error(error)
                    return
                }

            })
            .catch(error => msgbox_error(error));
    })
    $('#closeCartData').on('click', function() {
        $('.rowData1').remove()
    })
    $('#closeTransactionData').on('click', function() {
        $('.rowData2').remove()
    })
</script>

<?= $this->endSection() ?>