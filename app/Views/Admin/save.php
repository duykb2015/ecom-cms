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

                <!-- Page-body start -->
                <div class="page-body">

                    <!--profile cover end-->
                    <div class="row">
                        <div class="col-lg-12">
                            <!-- tab content start -->
                            <div class="tab-content">
                                <!-- tab panel personal start -->
                                <div class="tab-pane active" id="personal" role="tabpanel">
                                    <!-- personal card start -->
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
                                                        <form action="<?= base_url('admin/save') ?>" method="post">
                                                            <input type="hidden" name="id" value="<?= isset($account['id']) ? $account['id'] : '' ?>">
                                                            <div class="general-info">
                                                                <div class="row">
                                                                    <div class="col-md-6">
                                                                        <label for="username">Tên tài khoản</label>
                                                                        <div class="input-group">
                                                                            <input type="text" class="form-control" value="<?= isset($account['username']) ? $account['username'] : set_value('username') ?>" name="username" placeholder="Tên ...">
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-6">
                                                                        <label for="password">Mật khẩu</label>
                                                                        <div class="input-group">
                                                                            <input type="password" name="password" class="form-control" placeholder="Mật khẩu ...">
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="row">
                                                                    <!-- end of table col-lg-6 -->
                                                                    <div class="col-md-6">
                                                                        <label for="status">Trạng thái</label>
                                                                        <div class="input-group">
                                                                            <select name="status" class="form-control">
                                                                                <option value="1" <?= isset($account['status']) && $account['status'] == 1 ? 'selected' : '' ?>>Bình thường</option>
                                                                                <option value="0" <?= isset($account['status']) && $account['status'] == 0 ? 'selected' : '' ?>>Bị cấm</option>
                                                                            </select>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-6">
                                                                        <label for="level">Cấp bậc</label>
                                                                        <div class="input-group">
                                                                            <select name="level" class="form-control">
                                                                                <option value="1" <?= isset($account['level']) && $account['level'] == 1 ? 'selected' : '' ?>>
                                                                                    Không cấp quyền
                                                                                </option>
                                                                                <option value="2" <?= isset($account['level']) && $account['level'] == 2 ? 'selected' : '' ?>>
                                                                                    Moderator
                                                                                </option>
                                                                                <option value="3" <?= isset($account['level']) && $account['level'] == 3 ? 'selected' : '' ?>>
                                                                                    Admin
                                                                                </option>
                                                                            </select>
                                                                        </div>
                                                                    </div>
                                                                    <!-- end of table col-lg-6 -->
                                                                </div>
                                                                <!-- end of row -->
                                                                <div class="row">
                                                                    <div class="col-md-12 text-right">
                                                                        <button type="submit" class="btn btn-primary waves-effect waves-light m-r-20">Lưu</button>
                                                                        <a href="<?= base_url('admin/') ?>" id="edit-cancel" class="btn btn-default waves-effect">Huỷ</a>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <!-- end of edit info -->
                                                        </form>
                                                    </div>
                                                    <!-- end of col-lg-12 -->
                                                </div>
                                                <!-- end of row -->
                                            </div>
                                        </div>
                                        <!-- end of card-block -->
                                    </div>
                                    <!-- personal card end-->
                                </div>

                            </div>
                            <!-- tab content end -->
                        </div>
                    </div>
                </div>
                <!-- Page-body end -->
            </div>
        </div>
        <!-- Main body end -->
    </div>
</div>
<?= $this->endSection() ?>
