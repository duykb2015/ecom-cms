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
                                    <h4>Thêm menu</h4>
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
                                    <?php $id = !empty($_GET['id']) ? '?id=' . $_GET['id'] : '' ?>
                                    <form id="form-menu" action="<?= base_url('menu/save') ?>" method="POST">
                                        <input type="hidden" name="menu_id" value="<?= isset($menu['id']) ? $menu['id'] : '' ?>">
                                        <div class="form-group row">
                                            <label class="col-sm-2 col-form-label">Tên</label>
                                            <div class="col-sm-10">
                                                <input id="name" type="text" name="name" class="form-control" value="<?= isset($menu['name']) ? $menu['name'] : set_value('name') ?>">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-sm-2 col-form-label">Slug</label>
                                            <div class="col-sm-10">
                                                <input id="slug" type="text" name="slug" class="form-control" value="<?= isset($menu['slug']) ? $menu['slug'] : set_value('slug') ?>">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-sm-2 col-form-label">Menu Cha</label>
                                            <div class="col-sm-10">
                                                <select class="form-control" name="parent_id">
                                                    <option value="0">Không chọn</option>
                                                    <?php foreach ($parent_menu as $val) : ?>
                                                        <option <?= isset($menu['parent_id']) && $menu['parent_id'] == $val['id'] ? 'selected' : '' ?> value="<?= $val['id'] ?>"><?= $val['name'] ?></option>
                                                    <?php endforeach ?>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label class="col-sm-2 col-form-label">Loại</label>
                                            <div class="col-sm-10">
                                                <select class="form-control" name="type">
                                                    <?php foreach (MENU_TYPE as $key => $val) : ?>
                                                        <option <?= isset($menu['type']) && $menu['type'] == $key ? 'selected' : '' ?> value="<?= $key ?>"><?= $val ?></option>
                                                    <?php endforeach ?>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label class="col-sm-2 col-form-label">Trạng thái</label>
                                            <div class="col-sm-10">
                                                <select class="form-control" name="status">
                                                    <?php foreach (STATUS_CMS as $key => $val) : ?>
                                                        <option <?= isset($menu['status']) && $menu['status'] == $key ? 'selected' : '' ?> value="<?= $key ?>"><?= $val ?></option>
                                                    <?php endforeach ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-12 text-right">
                                                <button type="submit" class="btn btn-primary m-b-0 ">Submit</button>
                                                <a href="<?= base_url('menu') ?>" class="btn btn-default waves-effect">Canel</a>
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

    $('#name').on('keyup', function() {
        $('#slug').val(slug($(this).val()))
    })
</script>



<?= $this->endSection() ?>