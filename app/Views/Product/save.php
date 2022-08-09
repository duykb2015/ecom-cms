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
                                            <form class="md-float-material card-block" action="<?= base_url('product-line/save') ?>" method="POST">
                                                <input type="hidden" name="product_id" value="<?= !empty($product['id']) ? $product['id'] : '' ?>">
                                                <div class="row">
                                                    <div class="col-sm-6">
                                                        <div class="input-group">
                                                            <span class="input-group-addon"><i class="icofont icofont-cube"></i></span>
                                                            <input type="text" class="form-control" id="name" name="name" placeholder="Tên dòng sản phẩm" value="<?= !empty($product['name']) ? $product['name'] : set_value('name') ?>" required>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <div class="input-group">
                                                            <span class="input-group-addon"><i class="icofont icofont-cube"></i></span>
                                                            <input type="text" class="form-control" id="slug" name="slug" placeholder="Slug" value="<?= !empty($product['slug']) ? $product['slug'] : set_value('slug') ?>" required>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-sm-6">
                                                        <div class="input-group">
                                                            <select name="menu_id" class="form-control">
                                                                <?php if (isset($menu)) : ?>
                                                                    <?php foreach ($menu as $row) : ?>

                                                                        <option value="<?= $row['id'] ?>" <?= !empty($product['menu_id']) && $product['menu_id'] == $row['id'] ? 'selected' : '' ?>><?= $row['name'] ?></option>

                                                                    <?php endforeach ?>
                                                                <?php endif ?>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <select name="status" class="form-control">
                                                            <?php foreach (PRODUCT_STATUS as $key => $val) : ?>
                                                                <option value="<?= $key ?>" <?= !empty($product['status']) && $product['status'] == $key ? 'selected' : '' ?>><?= $val ?></option>

                                                            <?php endforeach ?>
                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="row mb-3">
                                                    <div class="col-sm-6">
                                                        <textarea name="additional_information" id="editor1" required><?= !empty($product['additional_information']) ? $product['additional_information'] : 'Thông tin thêm về sản phẩm ...' ?></textarea>
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <textarea name="support_information" id="editor2" required><?= !empty($product['support_information']) ? $product['support_information'] : 'Hỗ trợ khi mua hàng ...' ?></textarea>
                                                    </div>
                                                </div>

                                                <div class="row">
                                                    <div class="col-sm-12 mb-3">
                                                        <h5>Thông số kĩ thuật chung</h5>
                                                    </div>
                                                </div>
                                                <?php if (isset($product_attribute)) : ?>
                                                    <?php foreach ($product_attribute as $row) : ?>
                                                        <div class="row">
                                                            <label class="col-sm-2 col-form-label"><?= $row['name'] ?></label>
                                                            <div class="col-sm-10">
                                                                <div class="input-group">

                                                                    <?php if (!empty($row['pav_id'])) : ?>
                                                                        <input type="hidden" name="pav_<?= $row['pav_id'] ?>" value="<?= $row['pav_id'] ?>">
                                                                    <?php endif ?>
                                                                    <input type="text" class="form-control" name="attribute_<?= $row['id'] ?>" value="<?= !empty($row['value']) ? $row['value'] : set_value('short_descriptons') ?>" required>

                                                                </div>
                                                            </div>
                                                        </div>
                                                    <?php endforeach ?>
                                                <?php endif ?>


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
    <?= $this->endSection() ?>

    <?= $this->section('js') ?>
    <script>
        CKEDITOR.replace('editor1');
        CKEDITOR.replace('editor2');

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

        $('#remove-alert').on('click', function() {
            $('.alert').remove();
        })
    </script>

    <?= $this->endSection() ?>