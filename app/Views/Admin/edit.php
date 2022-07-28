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
                                    <?php $errors = session()->getFlashdata('error_msg') ?>
                                    <?php if (!empty($errors)) : ?>
                                        <div class="alert alert-danger">
                                            <?= $errors ?>
                                        </div>
                                    <?php endif ?>
                                    <h4>Chỉnh sửa tài khoản</h4>
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
                                            <h5 class="card-header-text">Thông tin cơ bản</h5>
                                        </div>
                                        <div class="card-block">

                                            <div class="edit-info">
                                                <div class="row">
                                                    <div class="col-lg-12">
                                                        <div class="general-info">
                                                            <form action="<?= base_url('admin/edit?uid=') . $_GET['uid'] ?>" method="post">
                                                                <div class="row">
                                                                    <div class="col-lg-12">
                                                                        <table class="table">
                                                                            <tbody>
                                                                                <td>
                                                                                    <select id="hello-single" name="level" class="form-control">
                                                                                        <option value="">
                                                                                            Vai trò
                                                                                        </option>
                                                                                        <option value="1" <?= !empty($account['level']) && $account['level'] == 1 ? 'selected' : '' ?>>
                                                                                            Member
                                                                                        </option>
                                                                                        <option value="2" <?= !empty($account['level']) && $account['level'] == 2 ? 'selected' : '' ?>>
                                                                                            Moderator
                                                                                        </option>
                                                                                        <option value="3" <?= !empty($account['level']) && $account['level'] == 3 ? 'selected' : '' ?>>
                                                                                            Admin
                                                                                        </option>
                                                                                    </select>
                                                                                </td>
                                                                                </tr>
                                                                            </tbody>
                                                                        </table>
                                                                    </div>
                                                                    <!-- end of table col-lg-12 -->
                                                                </div>
                                                                <!-- end of row -->
                                                                <div class="text-center">
                                                                    <button type="submit" class="btn btn-primary waves-effect waves-light m-r-20">Save</button>
                                                                    <a href="<?= base_url('admin') ?>" id="edit-cancel" class="btn btn-default waves-effect">Cancel</a>
                                                                </div>
                                                            </form>
                                                        </div>
                                                        <!-- end of edit info -->
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