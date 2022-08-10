<?= $this->extend('layout') ?>
<?= $this->section('css') ?>
<!-- Select 2 css -->
<link rel="stylesheet" href="<?= base_url() ?>\templates\libraries\bower_components\select2\css\select2.min.css">

<style>
    .select2-container--default .select2-selection--multiple .select2-selection__rendered {
        background-color: white !important;
    }

    .select2-container--default .select2-selection--multiple .select2-selection__choice {
        background-color: #01a9ac !important;
    }
</style>
<?= $this->endSection() ?>
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
                                    <h4><?= $title ?></h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="page-body">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="card">
                                <div class="row">
                                    <?php $error = session()->getFlashdata('error_msg') ?>
                                    <?php if (!empty($error)) : ?>
                                        <div class="alert alert-danger">
                                            <div class="row">
                                                <div class="col-11">
                                                    <?= $error ?>
                                                </div>
                                                <div class="col-1 text-right">
                                                    <span aria-hidden="true" id="remove-alert">&times;</span>
                                                </div>
                                            </div>
                                        </div>
                                    <?php endif ?>
                                    <div class="col-sm-12">
                                        <div class="product-edit">
                                            <form class="md-float-material card-block " action="<?= base_url('product-item/save') ?>" method="POST" enctype="multipart/form-data">
                                                <input type="hidden" name="product_item_id" value="<?= isset($product_item['id']) ? $product_item['id'] : '' ?>">
                                                <div class="row">
                                                    <div class="col-sm-6">
                                                        <label for="name">Tên sản phẩm</label>
                                                        <div class="input-group">
                                                            <input type="text" class="form-control" id="name" name="name" placeholder="Tên ..." value="<?= isset($product_item['name']) ? $product_item['name'] : set_value('name') ?>" required>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <label for="slug">Slug</label>
                                                        <div class="input-group">
                                                            <input type="text" class="form-control" id="slug" name="slug" placeholder="Slug ..." value="<?= isset($product_item['slug']) ? $product_item['slug'] : set_value('slug') ?>" required>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row mb-4">
                                                    <div class="col-sm-6">
                                                        <label for="product_id">Dòng sản phẩm</label>
                                                        <select name="product_id" class="form-control" required>
                                                            <option value=""></option>
                                                            <?php if (isset($product)) :  ?>
                                                                <?php foreach ($product as $row) : ?>
                                                                    <option value="<?= $row['id'] ?>" <?= isset($product_item['product_id']) && $product_item['product_id'] == $row['id'] ? 'selected' : '' ?>><?= $row['name'] ?></option>
                                                                <?php endforeach ?>
                                                            <?php endif ?>
                                                        </select>
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <label for="status">Trạng thái</label>
                                                        <select name="status" class="form-control">
                                                            <option value=""></option>
                                                            <?php foreach (PRODUCT_STATUS as $key => $val) : ?>
                                                                <option value="<?= $key ?>" <?= isset($product_item['status']) && $product_item['status'] == $key ? 'selected' : '' ?>><?= $val ?></option>
                                                            <?php endforeach ?>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="clone-link mb-3">
                                                    <div class="toclone">
                                                        <button class=" clone btn btn-primary m-b-15">Thêm màu</button>
                                                        <button class=" delete  btn btn-danger m-b-15">Xoá màu</button>
                                                        <div class="row">
                                                            <div class="col-sm-6">
                                                                <label for="color">Tên màu sắc</label>
                                                                <div class="input-group">
                                                                    <input type="text" class="form-control" name="colors[]" placeholder="Màu sản phẩm" value="<?= isset($product_item['color']) ? $product_item['color'] : set_value('color') ?>" required>
                                                                </div>
                                                            </div>
                                                            <div class="col-sm-6">
                                                                <label for="hexcode">Mã màu (dạng hexcode)</label>
                                                                <div class="input-group">
                                                                    <!-- <input type="color" name="" id=""> -->
                                                                    <input type="color" class="form-control" name="hexcodes[]" placeholder="Mã màu, dạng hexcode" value="<?= isset($product_item['hexcode']) ? $product_item['hexcode'] : set_value('hexcode') ?>" required>
                                                                </div>
                                                            </div>
                                                            <div class="col-sm-6">
                                                                <label for="price">Giá</label>
                                                                <div class="input-group">
                                                                    <input type="number" class="form-control" name="prices[]" placeholder="Giá" value="<?= isset($product_item['price']) ? $product_item['price'] : set_value('price') ?>" required>
                                                                </div>
                                                            </div>
                                                            <div class="col-sm-6">
                                                                <label for="price">Giảm giá (%)</label>
                                                                <div class="input-group">
                                                                    <input type="number" class="form-control" name="discounts[]" placeholder="Giảm giá" value="<?= isset($product_item['price']) ? $product_item['price'] : set_value('price') ?>" required>
                                                                </div>
                                                            </div>
                                                            <div class="col-sm-6">
                                                                <label for="quantity">Số lượng</label>
                                                                <div class="input-group">
                                                                    <input type="number" class="form-control" name="quantitys[]" placeholder="Số lượng" value="<?= isset($product_item['quantity']) ? $product_item['quantity'] : set_value('quantity') ?>" required>
                                                                </div>
                                                            </div>
                                                            <div class="col-sm-6">
                                                                <label for="status">Trạng thái</label>
                                                                <select name="status[] " class="form-control">
                                                                    <option value=""></option>
                                                                    <?php foreach (PRODUCT_STATUS as $key => $val) : ?>
                                                                        <option value="<?= $key ?>" <?= isset($product_item['status']) && $product_item['status'] == $key ? 'selected' : '' ?>><?= $val ?></option>
                                                                    <?php endforeach ?>
                                                                </select>
                                                            </div>
                                                        </div>

                                                    </div>
                                                    <!-- end /.toclone -->
                                                </div>
                                                <div class="row mb-3">
                                                    <div class="col-sm-12">
                                                        <div class="d-inline">
                                                            <h5>Tải lên hình ảnh sản phẩm</h5>
                                                        </div>
                                                        <br>
                                                        <h6>Hãy chọn thật kỹ ảnh để tránh xảy ra sai sót, bức ảnh đầu tiên sẽ là ảnh hiển thị ở trang chủ </h6>
                                                        <input type="file" name="images[]" id="filer_input" multiple="multiple" required>
                                                    </div>
                                                </div>

                                                <div class="row mb-4">
                                                    <div class="col-sm-12 mb-3">
                                                        <h5>Mô tả sản phẩm</h5>
                                                    </div>
                                                    <div class="col-sm-12">
                                                        <textarea name="description" id="editor1" required><?= isset($product_item['description']) ? $product_item['description'] : 'Mô tả về về sản phẩm ...' ?></textarea>
                                                    </div>
                                                </div>

                                                <div class="row">
                                                    <div class="col-sm-12 mb-3">
                                                        <h5>Thông số kĩ thuật riêng</h5>
                                                    </div>
                                                </div>
                                                <div id="attributes" class="row">
                                                    <div class="col-sm-12">
                                                        <select class="js-example-basic-multiple col-sm-12" name="product_attribute_value[]" multiple="multiple" required>
                                                            <option value=""></option>
                                                            <?php if (isset($product_attribute_values)) : ?>
                                                                <?php foreach ($product_attribute_values as $row) : ?>
                                                                    <option value="<?= $row['id'] ?>" <?= isset($product_attributes) && in_array($row['id'], $product_attributes) ? 'selected' : '' ?>><?= $row['name'] ?></option>
                                                                <?php endforeach ?>
                                                            <?php endif ?>
                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="row">
                                                    <div class="col-sm-12">
                                                        <div class="text-right m-t-20">
                                                            <button type="submit" class="btn btn-primary waves-effect waves-light m-r-10">Lưu</button>
                                                            <a href="<?= base_url('product') ?>" class="btn btn-light waves-effect waves-light">Huỷ</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                        <!-- Product edit card end -->

                                    </div>

                                    <!-- Main-body end -->

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
</div>
<?= $this->endSection() ?>

<?= $this->section('js') ?>
<script type="text/javascript" src="<?= base_url() ?>\templates\libraries\bower_components\select2\js\select2.full.min.js"></script>
<script type="text/javascript" src="<?= base_url() ?>\templates\libraries\assets\js\jquery.quicksearch.js"></script>
<!-- Multiselect js -->
<script type="text/javascript" src="<?= base_url() ?>\templates\libraries\bower_components\bootstrap-multiselect\js\bootstrap-multiselect.js"></script>
<!-- Custom js -->
<script type="text/javascript" src="<?= base_url() ?>\templates\libraries\assets\pages\advance-elements\select2-custom.js"></script>
<!-- Clone form -->
<script type="text/javascript" src="<?= base_url() ?>\templates\libraries\assets\pages\j-pro\js\jquery-cloneya.min.js"></script>
<script type="text/javascript" src="<?= base_url() ?>\templates\libraries\assets\pages\j-pro\js\custom\cloned-form.js"></script>
<script>
    CKEDITOR.replace('editor1');

    function slug(str) {

        str = str.replace(/^\s+|\s+$/g, "");
        str = str.toLowerCase();

        var from = "àáạảãâầấậẩẫăằắặẳẵèéẹẻẽêềếệểễìíịỉĩòóọỏõôồốộổỗơờớợởỡùúụủũưừứựửữỳýỵỷỹđ·/_,:;";
        var to = "aaaaaaaaaaaaaaaaaeeeeeeeeeeeiiiiiooooooooooooooooouuuuuuuuuuuyyyyyd------";
        for (var i = 0; i < from.length; i++) {
            str = str.replace(new RegExp(from.charAt(i), "g"), to.charAt(i));
        }

        str = str.replace(/[^a-z0-9 -]/g, '')
            .replace(/\s+/g, "-")
            .replace(/-+/g, "-")

        return str
    }

    $('#name').on('keyup', function() {
        $('#slug').val(slug($(this).val()))
    })
    data = $('#color').html()
    $('#add-color').on('click', function(event) {
        $('#color').append(data)
    })
</script>
<?= $this->endSection() ?>