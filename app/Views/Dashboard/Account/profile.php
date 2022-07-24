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
                                    <h4>Thông tin cá nhân</h4>
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
                                            <?php if (!empty(session()->getFlashdata('error_msg'))) : ?>
                                                <div class="alert alert-danger">
                                                    <?= session()->getFlashdata('error_msg') ?>
                                                </div>
                                            <?php endif ?>
                                            <?php if (!empty(session()->getFlashdata('success'))) : ?>
                                                <div class="alert alert-success">
                                                    <?= session()->getFlashdata('success') ?>
                                                </div>
                                            <?php endif ?>
                                            <h5 class="card-header-text">Thông tin cơ bản</h5>

                                        </div>
                                        <div class="card-block">
                                            <div class="view-info">
                                                <div class="row">
                                                    <div class="col-lg-12">
                                                        <div class="general-info">
                                                            <div class="row">
                                                                <div class="col-lg-12 col-xl-6">
                                                                    <div class="table-responsive">
                                                                        <?php if (!empty($account)) : ?>
                                                                            <table class="table m-0">
                                                                                <tbody>
                                                                                    <tr>
                                                                                        <th scope="row">Tài khoản</th>
                                                                                        <td><?= $account['username'] ?></td>
                                                                                    </tr>
                                                                                    <tr>
                                                                                        <th scope="row">Vai trò</th>
                                                                                        <td><?= $account['level'] ?></td>
                                                                                    </tr>
                                                                                    <tr>
                                                                                        <th scope="row">Ngày tạo</th>
                                                                                        <td><?= $account['created_at'] ?></td>
                                                                                    </tr>
                                                                                </tbody>
                                                                            </table>
                                                                        <?php endif; ?>
                                                                    </div>
                                                                </div>
                                                                <!-- end of table col-lg-6 -->
                                                                <div class="col-lg-12 col-xl-6">
                                                                    <div class="table-responsive">
                                                                        <?php if (!empty($account)) : ?>
                                                                            <table class="table">
                                                                                <tbody>
                                                                                    <tr>
                                                                                        <th scope="row">Email</th>
                                                                                        <td>
                                                                                            <?= $account['email'] ?>
                                                                                        </td>
                                                                                    </tr>
                                                                                    <tr>
                                                                                        <th scope="row">Trạng thái</th>
                                                                                        <td>
                                                                                            <?php if ($account['status'] == 1) : ?>
                                                                                                <span class="badge badge-success">Bình thường</span>
                                                                                            <?php else : ?>
                                                                                                <span class="badge badge-danger">Khóa</span>
                                                                                            <?php endif; ?>
                                                                                        </td>
                                                                                    </tr>
                                                                                </tbody>
                                                                            </table>
                                                                        <?php endif; ?>
                                                                    </div>
                                                                </div>
                                                                <!-- end of table col-lg-6 -->
                                                            </div>
                                                            <!-- end of row -->
                                                        </div>
                                                        <!-- end of general info -->
                                                    </div>
                                                    <!-- end of col-lg-12 -->
                                                </div>
                                                <!-- end of row -->
                                            </div>
                                            <!-- end of view-info -->
                                            <div class="edit-info">
                                                <div class="row">
                                                    <div class="col-lg-12">
                                                        <form action="<?= base_url('dashboard/account/profile') ?>" method="post">
                                                            <div class="general-info">
                                                                <div class="row">

                                                                    <div class="col-lg-6">
                                                                        <table class="table">
                                                                            <tbody>
                                                                                <tr>
                                                                                    <td>
                                                                                        <div class="input-group">
                                                                                            <span class="input-group-addon"><i class="icofont icofont-user"></i></span>
                                                                                            <input type="text" class="form-control" placeholder="" value="<?= $account['username'] ?>" disabled>
                                                                                        </div>
                                                                                    </td>
                                                                                </tr>
                                                                                <tr>
                                                                                    <td>
                                                                                        <div class="input-group">
                                                                                            <span class="input-group-addon"><i class="icofont icofont-ui-email"></i></span>
                                                                                            <input type="text" class="form-control" placeholder="Email" name="email" value="<?= $account['email'] ?>">
                                                                                        </div>
                                                                                    </td>
                                                                                </tr>
                                                                            </tbody>
                                                                        </table>
                                                                    </div>
                                                                    <!-- end of table col-lg-6 -->
                                                                    <div class="col-lg-6">
                                                                        <table class="table">
                                                                            <tbody>
                                                                                <tr>
                                                                                    <td>
                                                                                        <div class="input-group">
                                                                                            <span class="input-group-addon"><i class="icofont icofont-ui-password"></i></span>
                                                                                            <input type="password" class="form-control" name="old_password" placeholder="Mật khẩu cũ">
                                                                                        </div>
                                                                                    </td>
                                                                                </tr>
                                                                                <tr>
                                                                                    <td>
                                                                                        <div class="input-group">
                                                                                            <span class="input-group-addon"><i class="icofont icofont-ui-password"></i></span>
                                                                                            <input type="password" class="form-control" name="new_password" placeholder="Mật khẩu mới (Để thay đổi mật khẩu, bạn cần nhập mật khẩu cũ!)">
                                                                                        </div>
                                                                                    </td>
                                                                                </tr>
                                                                            </tbody>
                                                                        </table>
                                                                    </div>
                                                                    <!-- end of table col-lg-6 -->
                                                                </div>
                                                                <!-- end of row -->
                                                                <div class="text-center">
                                                                    <button type="submit" class="btn btn-primary waves-effect waves-light m-r-20">Save</button>
                                                                    <a href="#!" id="edit-cancel" class="btn btn-default waves-effect">Cancel</a>
                                                                </div>
                                                            </div>
                                                        </form>
                                                        <!-- end of edit info -->
                                                    </div>
                                                    <!-- end of col-lg-12 -->
                                                </div>
                                                <!-- end of row -->
                                            </div>
                                            <!-- end of edit-info -->
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