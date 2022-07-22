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
                                    <h4>Danh sách package</h4>
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
                                            <th>Tên</th>
                                            <th>Mô tả</th>
                                            <th>Loại</th>
                                            <th>LT Coin</th>
                                            <th width="10%">Trạng thái</th>
                                            <th width="10%">Ngày tạo</th>
                                            <th width="10%">Ngày cập nhật</th>
                                            <th width="10%">Hành động</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php if (!empty($packages)) : ?>
                                            <?php foreach ($packages as $row) : ?>
                                                <tr id="menu-<?= $row['id'] ?>">
                                                    <th scope="row"><?= $row['name'] ?></th>
                                                    <td><?= $row['description'] ?></td>
                                                    <td><?= PACKAGE_TYPE[$row['type']] ?></td>
                                                    <td><?= $row['lt_coin'] ?></td>
                                                    <td>
                                                        <div class="checkbox-fade fade-in-primary">
                                                            <label class="check-task">
                                                                <input type="checkbox" onclick="return change_status(this, '<?= $row['id'] ?>', '<?= $row['name'] ?>')" <?= $row['status'] == STATUS_DISPLAY ? 'checked' : '' ?>>
                                                                <span class="cr">
                                                                    <i class="cr-icon feather icon-check txt-default"></i>
                                                                </span>
                                                            </label>
                                                        </div>
                                                    </td>
                                                    <td><?= $row['created_at'] ?></td>
                                                    <td><?= $row['updated_at'] ?></td>
                                                    <td>
                                                        <div class="btn-group btn-group-sm">
                                                            <a href="<?= base_url('dashboard/billing/package/save?id=' . $row['id']) ?>" class="tabledit-edit-button btn btn-primary waves-effect waves-light" style="float: none;margin: 5px;">
                                                                <span class="icofont icofont-ui-edit"></span>
                                                            </a>
                                                            <a href="javascript:void(0)" onclick="delete_package('<?= $row['id'] ?>', '<?= $row['name'] ?>')" class="tabledit-delete-button btn btn-danger waves-effect waves-light" style="float: none;margin: 5px;">
                                                                <span class="icofont icofont-ui-delete"></span>
                                                            </a>
                                                        </div>
                                                    </td>
                                                </tr>
                                            <?php endforeach ?>
                                        <?php else : ?>
                                            <tr>
                                                <td colspan="7">
                                                    <p class="card-text text-center">Chưa có dữ liệu. Vui lòng cập nhật</p>
                                                </td>
                                            </tr>
                                        <?php endif ?>
                                    </tbody>
                                </table>
                            </div>

                            <?php if (!empty($packages)) : ?>
                                <?= $pager->links('default', 'dashboard') ?>
                            <?php endif ?>
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
        const is_confirm = confirm(`Bạn muốn thay đổi trạng thái của Package "${name}" ?`);
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

        fetch('<?= base_url('dashboard/billing/package/action-status') ?>', requestOptions)
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

    function delete_package(id, name) {
        const is_confirm = confirm(`Bạn muốn xóa Menu "${name}" ?`);
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

        fetch('<?= base_url('dashboard/billing/package/delete') ?>', requestOptions)
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