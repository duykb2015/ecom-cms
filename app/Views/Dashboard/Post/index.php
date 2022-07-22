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
                                    <h4>Danh sách bài viết</h4>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="page-header-breadcrumb">
                                <ul class="breadcrumb-title">
                                    Danh sách bài viết
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
                                            <th>Tác giả</th>
                                            <th>Tiêu đề</th>
                                            <th>Mô tả ngắn</th>
                                            <th>Nội dung</th>
                                            <th width="10%">Trạng thái</th>
                                            <th width="10%">Hành động</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php if (!empty($menus)) : ?>
                                            <?php foreach ($menus as $row) : ?>
                                                <tr id="menu-<?= $row['id'] ?>">
                                                    <th scope="row"><?= $row['name'] ?></th>
                                                    <td><?= $row['parent_name'] ?></td>
                                                    <td><?= MENU_TYPE[$row['type']] ?></td>
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
                                                            <a href="<?= base_url('dashboard/menu/save?id=' . $row['id']) ?>" class="tabledit-edit-button btn btn-primary waves-effect waves-light" style="float: none;margin: 5px;">
                                                                <span class="icofont icofont-ui-edit"></span>
                                                            </a>
                                                            <a href="javascript:void(0)" onclick="delete_menu('<?= $row['id'] ?>', '<?= $row['name'] ?>')" class="tabledit-delete-button btn btn-danger waves-effect waves-light" style="float: none;margin: 5px;">
                                                                <span class="icofont icofont-ui-delete"></span>
                                                            </a>
                                                        </div>
                                                    </td>
                                                </tr>
                                            <?php endforeach ?>
                                        <?php else : ?>
                                            <tr>
                                                <td colspan="6">
                                                    <p class="card-text text-center">Hiện tại chưa có bài viết nào.</p>
                                                </td>
                                            </tr>
                                        <?php endif ?>
                                    </tbody>
                                </table>
                            </div>
                            <?php if (1 == 0) : ?>
                                <nav aria-label="Page navigation example">
                                    <ul class="pagination justify-content-center">
                                        <li class="page-item">
                                            <a class="page-link" href="#" aria-label="Previous">
                                                <span aria-hidden="true">«</span>
                                                <span class="sr-only">Previous</span>
                                            </a>
                                        </li>
                                        <li class="page-item"><a class="page-link" href="#">1</a></li>
                                        <li class="page-item active"><a class="page-link" href="#">2</a></li>
                                        <li class="page-item"><a class="page-link" href="#">3</a></li>
                                        <li class="page-item">
                                            <a class="page-link" href="#" aria-label="Next">
                                                <span aria-hidden="true">»</span>
                                                <span class="sr-only">Next</span>
                                            </a>
                                        </li>
                                    </ul>
                                </nav>
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