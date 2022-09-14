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
                                            <?php $errors = session()->getFlashdata('error_msg')  ?>
                                            <?php if (!empty($errors)) : ?>
                                                <div class="alert alert-danger">
                                                    <?= $errors ?>
                                                </div>
                                            <?php endif ?>
                                            <?php $success = session()->getFlashdata('success') ?>
                                            <?php if (!empty($success)) : ?>
                                                <div class="alert alert-success">
                                                    <?= $success ?>
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
                                                                                        <td><?= LEVEL_TYPE[$account['level']] ?></td>
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
                                                                                        <th scope="row">Ngày tạo</th>
                                                                                        <td><?= $account['created_at'] ?></td>
                                                                                    </tr>
                                                                                    <tr>
                                                                                        <th scope="row">Trạng thái</th>
                                                                                        <td>
                                                                                            <?= ACCOUNT_STATUS[$account['status']] ?>
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