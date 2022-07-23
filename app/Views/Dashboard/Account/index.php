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
                                    <h4>Danh sách tài khoản</h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Page-header end -->


                <div class="page-body">
                    <!-- Extra Large table start -->
                    <div class="card">
                        <div class="card-block">

                            <div class="table-responsive">
                                <table class="table table-xl">
                                    <thead>
                                        <tr>
                                            <th>Tài Khoản</th>
                                            <th>Email</th>
                                            <th>Vai trò</th>
                                            <th>Ngày tạo</th>
                                            <th>Ngày chỉnh sửa</th>
                                            <th>Đăng nhập lần cuối</th>
                                            <th width="10%">Trạng thái</th>
                                            <th width="10%">Hành động</th>

                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php if (!empty($accounts)) : ?>
                                            <?php foreach ($accounts as $account) : ?>
                                                <tr id="menu-<?= $account['id'] ?>">
                                                    <td><?= $account['username'] ?></td>
                                                    <td><?= $account['email'] ?></td>
                                                    <td><?= $account['level'] ?></td>
                                                    <td><?= $account['created_at'] ?></td>
                                                    <td><?= $account['updated_at'] ?></td>
                                                    <td><?= $account['last_login_at'] ?></td>
                                                    <td>
                                                        <div class="checkbox-fade fade-in-primary">
                                                            <label class="check-task">
                                                                <input type="checkbox" onclick="return change_status(this, '<?= $account['id'] ?>', '<?= $account['username'] ?>')" <?= $account['status'] == 1 ? 'checked' : '' ?>>
                                                                <span class="cr">
                                                                    <i class="cr-icon feather icon-check txt-default"></i>
                                                                </span>
                                                            </label>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="btn-group btn-group-sm">
                                                            <a href="<?= base_url('dashboard/account/save?id=' . $account['id']) ?>" class="tabledit-edit-button btn btn-primary waves-effect waves-light" style="float: none;margin: 5px;">
                                                                <span class="icofont icofont-ui-edit"></span>
                                                            </a>
                                                            <a href="javascript:void(0)" onclick="delete_monster('<?= $account['id'] ?>', '<?= $account['username'] ?>')" class="tabledit-delete-button btn btn-danger waves-effect waves-light" style="float: none;margin: 5px;">
                                                                <span class="icofont icofont-ui-delete"></span>
                                                            </a>
                                                        </div>
                                                    </td>
                                                </tr>
                                            <?php endforeach ?>
                                        <?php else : ?>
                                            <tr>
                                                <td colspan="9">
                                                    <p class="card-text text-center">Hiện tại chưa có tài khoản.</p>
                                                </td>
                                            </tr>
                                        <?php endif ?>
                                    </tbody>
                                </table>
                            </div>

                            <div class="d-flex justify-content-end">
                                <?php if (!empty($pager)) : ?>
                                    <?= $pager->links('default', 'paginate') ?>
                                <?php endif ?>
                            </div>

                        </div>

                    </div>
                    <!-- Extra Large table end -->
                </div>

            </div>
        </div>
    </div>
</div>


<?= $this->endSection() ?>

<?= $this->section('js') ?>
<script>
    function change_status(element, id, name) {
        const is_confirm = confirm(`Bạn muốn thay đổi trạng thái của quái vật "${name}" ?`);
        if (!is_confirm) {
            return false
        }

        const data = new FormData();
        data.append('id', id);
        data.append('status', element.checked ? 2 : 0);
        var requestOptions = {
            method: 'POST',
            body: data,
            redirect: 'follow'
        };

        fetch('<?= base_url('dashboard/monster/action-status') ?>', requestOptions)
            .then(response => response.json())
            .then(result => {
                if (result.success) {
                    msgbox_success(result.message)
                    return true
                }

                const error = result.result.error;
                if (error) {
                    msgbox_error(error)
                    return false
                }

            })
            .catch(error => {
                msgbox_error('Có lỗi xảy ra. Vui lòng thử lại!')
                return false
            });
    }

    function delete_monster(id, name) {
        const is_confirm = confirm(`Bạn muốn xóa quái vật "${name}" ?`);
        if (!is_confirm) {
            return
        }

        const data = new FormData();
        data.append('id', id);
        var requestOptions = {
            method: 'POST',
            body: data,
            redirect: 'follow'
        };

        fetch('<?= base_url('dashboard/monster/delete') ?>', requestOptions)
            .then(response => response.json())
            .then(result => {
                if (result.success) {
                    msgbox_success(result.message)
                    document.getElementById(`menu-${id}`).remove()
                    return
                }

                const error = result.result.error;
                if (error) {
                    msgbox_error(error)
                    return
                }

            })
            .catch(error => msgbox_error('Có lỗi xảy ra. Vui lòng thử lại!'));
    }
</script>

<?= $this->endSection() ?>