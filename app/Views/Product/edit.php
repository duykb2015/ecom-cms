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
                        <div class="col-lg-8">
                            <div class="page-header-title">
                                <div class="d-inline">
                                    <?php $errors = session()->getFlashdata('error_msg') ?>
                                    <?php if (!empty($errors)) : ?>
                                        <div class="alert alert-danger">
                                            <?= $errors ?>
                                        </div>
                                    <?php endif ?>
                                    <h4>Sửa thông tin sản phẩm</h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Page-header end -->
                <!-- Main-body start -->

                <!-- Page-header start -->

                <!-- Page body start -->
                <div class="page-body">
                    <div class="row">
                        <div class="col-sm-12">
                            <!-- Product edit card start -->
                            <div class="card">
                                <div class="card-block">
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <div class="product-edit">
                                                <ul class="nav nav-tabs nav-justified md-tabs " role="tablist">
                                                    <li class="nav-item">
                                                        <a class="nav-link active" data-toggle="tab" href="#home7" role="tab">
                                                            <div class="f-20">
                                                                <i class="icofont icofont-edit"></i>
                                                            </div>
                                                            Sửa thông tin sản phẩm
                                                        </a>

                                                    </li>
                                                    <li class="nav-item">
                                                        <a class="nav-link" data-toggle="tab" href="#messages7" role="tab">
                                                            <div class="f-20">
                                                                <i class="icofont icofont-ui-image"></i>
                                                            </div>
                                                            Hình ảnh sản phẩm
                                                        </a>

                                                    </li>
                                                </ul>
                                                <!-- Tab panes -->
                                                <form class="md-float-material card-block" method="POST" action="<?= base_url('product/edit') . '?id=' . $product['id'] ?>" enctype="multipart/form-data">
                                                    <div class="tab-content">
                                                        <div class="tab-pane active" id="home7" role="tabpanel">

                                                            <div class="row">
                                                                <div class="col-sm-6">
                                                                    <div class="input-group">
                                                                        <span class="input-group-addon"><i class="icofont icofont-cube"></i></span>
                                                                        <input type="text" class="form-control" name="name" placeholder="Tên sản phẩm" value="<?= $product['name'] ?>" required>
                                                                    </div>
                                                                </div>
                                                                <div class="col-sm-6">
                                                                    <div class="input-group">
                                                                        <span class="input-group-addon"><i class="icofont icofont-cube"></i></span>
                                                                        <input type="text" class="form-control" name="short_descriptions" placeholder="Mô tả ngắn" value="<?= $product['short_descriptions'] ?>" required>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-sm-6">
                                                                    <div class="input-group">
                                                                        <span class="input-group-addon"><i class="icofont icofont-ui-note"></i></span>
                                                                        <input type="text" class="form-control" name="price" placeholder="Giá" value="<?= $product['price'] ?>" required>
                                                                    </div>
                                                                </div>
                                                                <div class="col-sm-6">
                                                                    <div class="input-group">
                                                                        <span class="input-group-addon"><i class="icofont icofont-numbered"></i></span>
                                                                        <input type="text" class="form-control" name="quantity" placeholder="Số lượng" value="<?= $product['quantity'] ?>" required>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-sm-6">
                                                                    <select name="select" class="form-control form-control-primary">
                                                                        <option value="0">Ẩn</option>
                                                                        <option value="1">Hiện</option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <br>
                                                            <div class="row">
                                                                <div class="col-sm-12">
                                                                    <textarea name="descriptions" id="editor1" rows="10" cols="100" required><?= !empty(set_value('descriptions')) ? set_value('descriptions') : 'Nhập mô tả sản phẩm ...' ?></textarea>
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-sm-12">
                                                                    <div class="text-center m-t-20">
                                                                        <button type="submit" class="btn btn-primary waves-effect waves-light m-r-10">Save</button>
                                                                        <a href="<?= base_url('product') ?>" class="btn btn-warning waves-effect waves-light">Cancel</a>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                        </div>
                                                        <div class="tab-pane" id="messages7" role="tabpanel">
                                                            <div class="md-float-material card-block">

                                                                <?php if (!empty($product['images'])) : ?>
                                                                    <?php foreach ($product['images'] as $image) : ?>
                                                                        <div class="row p-t-10 p-b-10">

                                                                            <div class="col-lg-3 col-md-6 col-sm-12">
                                                                                <a href="">
                                                                                    <img src="<?= base_url() . '/uploads/' . $image ?>" class="img-fluid width-100 m-b-20" alt="img-edit">
                                                                                </a>
                                                                            </div>

                                                                        </div>
                                                                    <?php endforeach; ?>
                                                                <?php endif ?>
                                                                <div class="col-sm-12">
                                                                    <div class="d-inline">
                                                                        <h5>File Upload</h5>
                                                                    </div>
                                                                    <br>
                                                                    <h6>Hình ảnh đầu tiên sẽ được chọn làm ảnh đại diện sản phẩm. <span class="text-danger">Chú ý, thay đổi hình ảnh sẽ xoá toàn bộ hình ảnh trước đó</span></h6>

                                                                    <input type="file" name="images[]" id="filer_input" multiple="multiple">
                                                                </div>
                                                            </div>

                                                            <hr>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>


                                        </div>
                                    </div>
                                </div>
                                <!-- Product edit card end -->

                            </div>

                            <!-- Main-body end -->
                        </div>
                    </div>
                    <!-- Page-body end -->
                </div>
            </div>
            <!-- Main-body end -->
        </div>

        <!-- Page body start -->
        <!-- Page body end -->
    </div>
</div>
</div>
</div>
<?= $this->endSection() ?>

<?= $this->section('js') ?>
<script>
    CKEDITOR.replace('editor1');
</script>

<?= $this->endSection() ?>