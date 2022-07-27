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

                                    <h4>Thêm mới sản phẩm</h4>
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
                                        <?php $errors = session()->getFlashdata('error_msg') ?>
                                        <?php if (!empty($errors)) : ?>
                                            <div class="alert alert-danger">
                                                <?= $errors ?>
                                            </div>
                                        <?php endif ?>
                                        <div class="col-sm-12">
                                            <div class="product-edit">
                                                <form class="md-float-material card-block" action="<?= base_url('product/create') ?>" method="POST" enctype="multipart/form-data">
                                                    <div class="row">
                                                        <div class="col-sm-6">
                                                            <div class="input-group">
                                                                <span class="input-group-addon"><i class="icofont icofont-cube"></i></span>
                                                                <input type="text" class="form-control" name="name" placeholder="Tên sản phẩm" value="<?= !empty(set_value('name')) ? set_value('name') : '' ?>" required>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-6">
                                                            <div class="input-group">
                                                                <span class="input-group-addon"><i class="icofont icofont-cube"></i></span>
                                                                <input type="text" class="form-control" name="short_descriptions" placeholder="Mô tả ngắn" value="<?= !empty(set_value('short_descriptions')) ? set_value('short_descriptons') : '' ?>" required>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-sm-6">
                                                            <div class="input-group">
                                                                <span class="input-group-addon"><i class="icofont icofont-price"></i></span>
                                                                <input type="number" class="form-control" name="price" placeholder="Giá" value="<?= !empty(set_value('price')) ? set_value('price') : '' ?>" required>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-sm-6">
                                                            <div class="input-group">
                                                                <span class="input-group-addon"><i class="icofont icofont-numbered"></i></span>
                                                                <input type="number" class="form-control" name="quantity" placeholder="Số lượng" value="<?= !empty(set_value('quantity')) ? set_value('quantity') : '' ?>" required>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-6">
                                                            <select name="status" class="form-control form-control-primary">
                                                                <option value="0">Ẩn</option>
                                                                <option value="1">Hiện</option>
                                                            </select>
                                                        </div>
                                                    </div>

                                                    <div class="col-sm-12">
                                                        <textarea name="descriptions" id="editor1" rows="10" cols="100" required><?= !empty(set_value('descriptions')) ? set_value('descriptions') : 'Nhập mô tả sản phẩm ...' ?></textarea>
                                                    </div>

                                                    <br>
                                                    <div class="col-sm-12">
                                                        <div class="d-inline">
                                                            <h5>File Upload</h5>
                                                        </div>
                                                        <br>
                                                        <h6>Hình ảnh đầu tiên sẽ được chọn làm ảnh đại diện sản phẩm</h6>
                                                        <input type="file" name="images[]" id="filer_input" multiple="multiple" required>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-sm-12">
                                                            <div class="text-center m-t-20">
                                                                <button type="submit" class="btn btn-primary waves-effect waves-light m-r-10">Save
                                                                </button>
                                                                <a href="<?= base_url('product/index') ?>" class="btn btn-warning waves-effect waves-light">Cancel</a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </form>
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
    <script>
        const form = document.getElementById('form-menus');
        form.addEventListener('submit', (e) => {
            // stop form submission
            e.preventDefault();

            const data = new FormData(form);
            var requestOptions = {
                method: 'POST',
                body: data,
                redirect: 'follow'
            };

            fetch(form.action, requestOptions)
                .then(response => response.json())
                .then(result => {
                    if (result.success) {
                        redirect_url(result.result.url_redirect)
                        return
                    }

                    const errors = result.result.errors;
                    if (errors) {
                        for (var key in errors) {
                            if (errors.hasOwnProperty(key)) {
                                msgbox_error(errors[key])
                                break
                            }
                        }
                    }

                })
                .catch(error => msgbox_error());
        });
    </script>

    <?= $this->endSection() ?>