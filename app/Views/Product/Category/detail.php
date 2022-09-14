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

                <!-- Page body start -->
                <div class="page-body">
                    <div class="row">
                        <div class="col-sm-12">
                            <!-- Basic Form Inputs card start -->
                            <div class="card">
                                <div class="card-block">
                                    <?php $error = session()->getFlashdata('error_msg') ?>
                                    <?php if (isset($error)) : ?>
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
                                    <form id="form-menu" action="<?= base_url('product-category/save') ?>" method="POST">
                                        <input type="hidden" name="category_id" value="<?= isset($category['id']) ? $category['id'] : '' ?>">
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <label for="name">Tên danh mục</label>
                                                <div class="input-group">
                                                    <input id="name" type="text" name="name" class="form-control" value="<?= isset($category['name']) ? $category['name'] : set_value('name') ?>" required>
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <label for="slug">Slug</label>
                                                <div class="input-group">
                                                    <input id="slug" type="text" name="slug" class="form-control" value="<?= isset($category['slug']) ? $category['slug'] : set_value('slug') ?>">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <label for="parent_id">Menu</label>
                                                <div class="input-group">
                                                    <select class="form-control" name="menu_id">
                                                        <?php if (isset($menu)) : ?>
                                                            <?php foreach ($menu as $val) : ?>
                                                                <option <?= isset($category['menu_id']) && $category['menu_id'] == $val['id'] ? 'selected' : '' ?> value="<?= $val['id'] ?>"><?= $val['name'] ?></option>
                                                            <?php endforeach ?>
                                                        <?php endif ?>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <label for="status">Trạng thái</label>
                                                <div class="input-group">
                                                    <select class="form-control" name="status">
                                                        <?php foreach (STATUS as $key => $val) : ?>
                                                            <option <?= isset($category['status']) && $category['status'] == $key ? 'selected' : '' ?> value="<?= $key ?>"><?= $val ?></option>
                                                        <?php endforeach ?>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-sm-12 text-right">
                                                <button type="submit" class="btn btn-primary m-b-0 ">Lưu</button>
                                                <a href="<?= base_url('product-category') ?>" class="btn btn-default waves-effect">Huỷ</a>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Page body end -->
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>

<?= $this->section('js') ?>
<script>
    // function slug() {}
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
</script>



<?= $this->endSection() ?>