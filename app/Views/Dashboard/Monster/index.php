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
                                    <h4>Danh sách nick</h4>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="page-header-breadcrumb">
                                <ul class="breadcrumb-title">
                                    Danh sách nick
                                </ul>
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
                                            <th>Dạng thường</th>
                                            <th>Dạng tiến hóa</th>
                                            <th>Tên</th>
                                            <th>Tên (Sau khi tiến hóa)</th>
                                            <th>Hệ</th>
                                            <th>Đánh giá</th>
                                            <th width="10%">Trạng thái</th>
                                            <th width="10%">Hành động</th>

                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php if (!empty($monsters)) : ?>
                                            <?php foreach ($monsters as $monster) : ?>
                                                <tr id="menu-<?= $monster['id'] ?>">
                                                    <th scope="row">
                                                        <?php if ($monster['avatar'] != 'none' || $monster['avatar'] == '') : ?>
                                                            <img src="<?= $monster['avatar'] ?>" width="100" height="100" alt="Monster avatar">
                                                        <?php else : ?>
                                                            <p>Không có ảnh</p>
                                                        <?php endif ?>
                                                    </th>
                                                    <th>
                                                        <?php if ($monster['avatar_awakened'] != 'none' || $monster['avatar_awakened'] == '') : ?>
                                                            <img src="<?= $monster['avatar_awakened'] ?>" width="100" height="100" alt="Monster Awakened avatar">
                                                        <?php else : ?>
                                                            <p>Không có ảnh</p>
                                                        <?php endif ?>
                                                    </th>
                                                    <td><?= $monster['name'] ?></td>
                                                    <td><?= $monster['name_awakened'] ?></td>
                                                    <td><?= $monster['element'] ?></td>
                                                    <td><?= $monster['rating'] ?></td>
                                                    <td>
                                                        <div class="checkbox-fade fade-in-primary">
                                                            <label class="check-task">
                                                                <input type="checkbox" onclick="return change_status(this, '<?= $monster['id'] ?>', '<?= $monster['name'] ?>')" <?= $monster['status'] == STATUS_DISPLAY ? 'checked' : '' ?>>
                                                                <span class="cr">
                                                                    <i class="cr-icon feather icon-check txt-default"></i>
                                                                </span>
                                                            </label>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="btn-group btn-group-sm">
                                                            <a href="<?= base_url('dashboard/monster/save?id=' . $monster['id']) . '&page=' . $_GET['page'] ?>" class="tabledit-edit-button btn btn-primary waves-effect waves-light" style="float: none;margin: 5px;">
                                                                <span class="icofont icofont-ui-edit"></span>
                                                            </a>
                                                            <a href="javascript:void(0)" onclick="delete_monster('<?= $monster['id'] ?>', '<?= $monster['name'] ?>')" class="tabledit-delete-button btn btn-danger waves-effect waves-light" style="float: none;margin: 5px;">
                                                                <span class="icofont icofont-ui-delete"></span>
                                                            </a>
                                                        </div>
                                                    </td>
                                                </tr>
                                            <?php endforeach ?>
                                        <?php else : ?>
                                            <tr>
                                                <td colspan="9">
                                                    <p class="card-text text-center">Hiện tại chưa có quái vật nào.</p>
                                                </td>
                                            </tr>
                                        <?php endif ?>
                                    </tbody>
                                </table>
                            </div>

                            <div class="d-flex justify-content-end">
                                <?php if ($pager) : ?>
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