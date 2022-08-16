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
                <!-- Page-header end -->
                <!-- Main-body start -->

                <!-- Page-header start -->

                <!-- Page body start -->
                <div class="page-body">
                    <div class="row">
                        <div class="col-sm-12">
                            <!-- Product edit card start -->
                            <div class="card">
                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="product-edit">
                                            <form class="md-float-material card-block" id="j-forms" action="<?= base_url('product-line/save') ?>" method="POST">
                                                <input type="hidden" name="product_id" value="<?= !empty($product['id']) ? $product['id'] : '' ?>">
                                                <div class="row">
                                                    <div class="col-sm-6">
                                                        <label for="name">Tên dòng sản phẩm</label>
                                                        <div class="input-group">
                                                            <input type="text" class="form-control" id="name" name="name" placeholder="Tên dòng sản phẩm" value="<?= !empty($product['name']) ? $product['name'] : set_value('name') ?>" required>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <label for="slug">Slug</label>
                                                        <div class="input-group">
                                                            <input type="text" class="form-control" id="slug" name="slug" placeholder="Slug" value="<?= !empty($product['slug']) ? $product['slug'] : set_value('slug') ?>" required>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-sm-6">
                                                        <label for="menu_id">Danh mục</label>
                                                        <div class="input-group">
                                                            <select name="category_id" class="form-control">
                                                                <?php if (isset($category)) : ?>
                                                                    <?php foreach ($category as $row) : ?>
                                                                        <option value="<?= $row['id'] ?>" <?= !empty($product['category_id']) && $product['category_id'] == $row['id'] ? 'selected' : '' ?>><?= $row['name'] ?></option>
                                                                    <?php endforeach ?>
                                                                <?php endif ?>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <label for="status">Trạng thái</label>
                                                        <select name="status" class="form-control">
                                                            <?php foreach (PRODUCT_STATUS as $key => $val) : ?>
                                                                <option value="<?= $key ?>" <?= !empty($product['status'])  && $product['status'] == $key ? 'selected' : '' ?>><?= $val ?></option>
                                                            <?php endforeach ?>
                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="row mb-3">
                                                    <div class="col-sm-6">
                                                        <label for="additional_information">Thông tin thêm về sản phẩm</label>
                                                        <textarea name="additional_information" id="editor1" required><?= !empty($product['additional_information']) ? $product['additional_information'] : 'Thông tin thêm về sản phẩm ...' ?></textarea>
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <label for="support_information">Hỗ trợ khi mua sản phẩm</label>
                                                        <textarea name="support_information" id="editor2" required><?= !empty($product['support_information']) ? $product['support_information'] : 'Hỗ trợ khi mua hàng ...' ?></textarea>
                                                    </div>
                                                </div>
                                                <div class="row mb-4">
                                                    <div class="col-sm-12 mb-3">
                                                        <h5>Mô tả sản phẩm</h5>
                                                    </div>
                                                    <div class="col-sm-12">
                                                        <textarea name="description" id="editor3" required><?= isset($product['description']) ? $product['description'] : 'Mô tả về về sản phẩm ...' ?></textarea>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-sm-12 mb-3">
                                                        <h5>Thông số kĩ thuật chung</h5>
                                                    </div>
                                                </div>
                                                <div id="attributes" class="row">
                                                    <div class="col-sm-12">
                                                        <select class="js-example-basic-multiple col-sm-12" name="product_attribute_value[]" multiple="multiple">
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
                                                            <a href="<?= base_url('product-line') ?>" class="btn btn-light waves-effect waves-light">Huỷ</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?= $this->endSection() ?>

    <?= $this->section('js') ?>
    <!-- Select 2 js -->
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
        CKEDITOR.replace('editor2');
        CKEDITOR.replace('editor3');
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

        $('#name').on('input', function() {
            $('#slug').val(slug($(this).val()))
        })

        $('#remove-alert').on('click', function() {
            $('.alert').remove();
        })
    </script>

    <?= $this->endSection() ?>