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
                <div class="page-body">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="card">
                                <div class="row">
                                    <?php $errors = session()->getFlashdata('error_msg') ?>
                                    <?php if (!empty($errors)) : ?>
                                        <div class="alert alert-danger">
                                            <?= $errors ?>
                                        </div>
                                    <?php endif ?>
                                    <div class="col-sm-12">
                                        <div class="product-edit">
                                            <form class="md-float-material card-block " action="<?= base_url('product-item/save') ?>" method="POST" enctype="multipart/form-data">
                                                <input type="hidden" name="product_id" value="<?= isset($product['id']) ? $product['id'] : '' ?>">

                                                <div class="row">
                                                    <div class="col-sm-6">
                                                        <div class="input-group">
                                                            <span class="input-group-addon"><i class="icofont icofont-cube"></i></span>
                                                            <input type="text" class="form-control" id="name" name="name" placeholder="Tên sản phẩm" value="<?= isset($product['name']) ? $product['name'] : set_value('name') ?>" required>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <div class="input-group">
                                                            <span class="input-group-addon"><i class="icofont icofont-cube"></i></span>
                                                            <input type="text" class="form-control" id="slug" name="slug" placeholder="Slug" value="<?= isset($product['slug']) ? $product['slug'] : set_value('slug') ?>" required>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row mb-4">
                                                    <div class="col-sm-6">
                                                        <select name="product_id" class="form-control">
                                                            <option value="">Chọn dòng sản phẩm</option>
                                                            <?php if (isset($product)) :  ?>
                                                                <?php foreach ($product as $row) : ?>
                                                                    <option value="<?= $row['id'] ?>" <?= isset($product_item['product_id']) && $product_item['product_id'] == $key ? 'selected' : '' ?>><?= $row['name'] ?></option>
                                                                <?php endforeach ?>
                                                            <?php endif ?>
                                                        </select>
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <select name="status" class="form-control">
                                                            <?php foreach (PRODUCT_STATUS as $key => $val) : ?>
                                                                <option value="<?= $key ?>" <?= isset($product['status']) && $product['status'] == $key ? 'selected' : '' ?>><?= $val ?></option>
                                                            <?php endforeach ?>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="row mb-3">
                                                    <div class="col-sm-2">
                                                        <button type="button" class="btn btn-primary" id="add-color">
                                                            Thêm màu
                                                        </button>
                                                    </div>
                                                </div>
                                                <div class="row mb-3" id="color">

                                                    <div class="col-sm-11">
                                                        <div class="input-group">
                                                            <span class="input-group-addon"><i class="icofont icofont-color-picker"></i></span>
                                                            <input type="text" class="form-control" id="color-name" name="color" placeholder="Màu sản phẩm (ghi tiếng Anh)" value="<?= isset($product['color']) ? $product['color'] : set_value('color') ?>" required>
                                                        </div>
                                                    </div>

                                                    <div class="col-sm-1">
                                                        <button type="button" class="btn btn-danger" id="delete-color">
                                                            Xoá
                                                        </button>
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <div class="input-group">
                                                            <span class="input-group-addon"><i class="icofont icofont-price"></i></span>
                                                            <input type="text" class="form-control" name="price[]" placeholder="Giá" value="<?= isset($product['price']) ? $product['price'] : set_value('price') ?>" required>

                                                        </div>
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <div class="input-group">
                                                            <span class="input-group-addon"><i class="icofont icofont-color-picker"></i></span>

                                                            <input type="text" class="form-control" id="hexcode[]" name="hexcode" placeholder="Mã màu" value="<?= isset($product['hexcode']) ? $product['hexcode'] : set_value('hexcode') ?>" required>

                                                        </div>
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <div class="input-group">
                                                            <span class="input-group-addon"><i class="icofont icofont-numbered"></i></span>

                                                            <input type="text" class="form-control" name="quantity[]" placeholder="Số lượng" value="<?= isset($product['quantity']) ? $product['quantity'] : set_value('quantity') ?>" required>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <select name="status[]" class="form-control">

                                                            <?php foreach (PRODUCT_STATUS as $key => $val) : ?>
                                                                <option value="<?= $key ?>" <?= isset($product_item['status']) && $product_item['status'] == $key ? 'selected' : '' ?>><?= $val ?></option>
                                                            <?php endforeach ?>
                                                        </select>
                                                    </div>

                                                </div>

                                                <div class="row mb-3">
                                                    <div class="col-sm-12">
                                                        <div class="d-inline">
                                                            <h5>Tải lên hình ảnh sản phẩm</h5>
                                                        </div>
                                                        <br>
                                                        <h6>Hãy chọn thật kỹ ảnh để tránh xảy ra sai sót, bức ảnh đầu tiên sẽ là ảnh hiển thị ở trang chủ </h6>
                                                        <input type="file" name="images[]" id="filer_input" multiple="multiple">
                                                    </div>
                                                </div>

                                                <div class="row mb-4">
                                                    <div class="col-sm-12 mb-3">
                                                        <h5>Mô tả sản phẩm</h5>
                                                    </div>
                                                    <div class="col-sm-12">
                                                        <textarea name="description" id="editor1" required><?= isset($product['description']) ? $product['description'] : 'Mô tả về về sản phẩm ...' ?></textarea>
                                                    </div>
                                                </div>

                                                <div class="row">
                                                    <div class="col-sm-12 mb-3">
                                                        <h5>Thông số kĩ thuật riêng</h5>
                                                    </div>
                                                </div>
                                                <?php if (isset($product_attribute)) : ?>
                                                    <?php foreach ($product_attribute as $row) : ?>
                                                        <div class="row">
                                                            <label class="col-sm-2 col-form-label"><?= $row['name'] ?></label>
                                                            <div class="col-sm-10">
                                                                <div class="input-group">
                                                                    <?php if (isset($row['pav_id'])) : ?>
                                                                        <input type="hidden" name="pav_<?= $row['pav_id'] ?>" value="<?= $row['pav_id'] ?>">
                                                                    <?php endif ?>
                                                                    <input type="text" class="form-control" name="attribute_<?= $row['id'] ?>" value="<?= isset($row['value']) ? $row['value'] : set_value('short_descriptons') ?>" required>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    <?php endforeach ?>
                                                <?php endif ?>

                                                <div class="row">
                                                    <div class="col-sm-12">
                                                        <div class="text-right m-t-20">
                                                            <button type="submit" class="btn btn-primary waves-effect waves-light m-r-10">Save
                                                            </button>
                                                            <a href="<?= base_url('product') ?>" class="btn btn-light waves-effect waves-light">Cancel</a>
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
        //slug
        $('#name').on('keyup', function() {
            $('#slug').val(slug($(this).val()))
        })
        // Remove alert
        function remove_alert() {
            $('.alert').remove();
        }

        let i = 1
        data = $('#color').html()
        $('#add-color').on('click', function(event) {
            $('#color').append(data)
        })

        $('#delete-color').on('click', function(event) {
            $('#color').html('')
        })
    </script>
    <?= $this->endSection() ?>