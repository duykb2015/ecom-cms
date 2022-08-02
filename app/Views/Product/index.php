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
                                    <h4>Danh sách Sản Phẩm</h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Page-header end -->

                <div class="page-body">
                    <div class="row">
                        <div class="col-sm-12">
                            <!-- Product list card start -->
                            <div class="card">
                                <div class="card-header">
                                    <small> Để xem các hình ảnh đính kèm và mô tả, chọn chỉnh sửa sản phẩm</small>
                                </div>
                                <div class="card-block">
                                    <div class="table-responsive">
                                        <div class="table-content">
                                            <div class="project-table">
                                                <table id="e-product-list" class="table table-striped dt-responsive nowrap">
                                                    <thead>
                                                        <tr>
                                                            <th>Tên sản phẩm</th>
                                                            <th>Giá</th>
                                                            <th>Mô tả ngắn</th>
                                                            <th class="text-center" width="5%">Trạng thái</th>
                                                            <th width="10%">Ngày tạo</th>
                                                            <th width="10%">Ngày cập nhật</th>
                                                            <th width="10%">Hành động</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php if (!empty($products)) : ?>
                                                            <?php foreach ($products as $product) : ?>
                                                                <tr>
                                                                    <td class="pro-name">
                                                                        <?= $product['name'] ?>
                                                                    </td>

                                                                    <td> <?= $product['price'] ?></td>
                                                                    <td> <?= $product['short_descriptions'] ?></td>
                                                                    <td class="text-center" width="10%">
                                                                        <div class="checkbox-fade fade-in-primary text-center">
                                                                            <label class="check-task">
                                                                                <input type="checkbox" onclick="return change_status(this, '<?= $product['id'] ?>', '<?= $product['name'] ?>')" <?= $product['status'] == STATUS_DISPLAY ? 'checked' : '' ?>>
                                                                                <span class="cr">
                                                                                    <i class="cr-icon feather icon-check txt-default"></i>
                                                                                </span>
                                                                            </label>
                                                                        </div>
                                                                    </td>
                                                                    <td> <?= $product['created_at'] ?></td>
                                                                    <td> <?= $product['updated_at'] ?></td>
                                                                    <td class="action-icon">
                                                                        <div class="btn-group btn-group-sm">
                                                                            <a href="<?= base_url('product/edit?id=' . $product['id']) ?>" class="tabledit-edit-button btn btn-primary waves-effect waves-light" style="float: none;margin: 5px;">
                                                                                <span class="icofont icofont-ui-edit"></span>
                                                                            </a>
                                                                            <a href="javascript:void(0)" onclick="delete_product('<?= $product['id'] ?>', '<?= $product['name'] ?>')" class="tabledit-delete-button btn btn-danger waves-effect waves-light" style="float: none;margin: 5px;">
                                                                                <span class="icofont icofont-ui-delete"></span>
                                                                            </a>
                                                                        </div>
                                                                    </td>
                                                                </tr>
                                                            <?php endforeach ?>
                                                        <?php else : ?>
                                                            <tr>
                                                                <td colspan="7">Hiện không có sản phẩm nào</td>
                                                            </tr>
                                                        <?php endif ?>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Product list card end -->
                        </div>

                    </div>
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="text-center">
                                <?php if (!empty($pager)) : ?>
                                    <?= $pager->links('default', 'default_full') ?>
                                <?php endif ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <?= $this->endSection() ?>

    <?= $this->section('js') ?>

    <script>
        function change_status(element, id, name) {
            
            const is_confirm = confirm(`Bạn muốn thay đổi trạng thái của sản phẩm "${name}" ?`);
            if (!is_confirm) {
                return false
            }

            const data = new FormData();
            data.append('id', id);
            data.append('status', element.checked ? 1 : 0);
            var requestOptions = {
                method: 'POST',
                body: data,
                redirect: 'follow'
            };

            fetch('<?= base_url('product/action-status') ?>', requestOptions)
                .then(response => response.json())
                .then(result => {
                    if (result.success) {
                        msgbox_success(result.message)
                        return true
                    }

                    const error = result.result.error;
                    if (error) {
                        msgbox_error(error)
                        return false
                    }

                })
                .catch(error => {
                    msgbox_error('Có lỗi xảy ra. Vui lòng thử lại!')
                    return false
                });
        }

        function delete_product(id, name) {
            const is_confirm = confirm(`Bạn muốn xóa Menu "${name}" ?`);
            if (!is_confirm) {
                return
            }

            const data = new FormData();
            data.append('id', id);
            var requestOptions = {
                method: 'POST',
                body: data,
                redirect: 'follow'
            };

            fetch('<?= base_url('product/delete') ?>', requestOptions)
                .then(response => response.json())
                .then(result => {
                    if (result.success) {
                        msgbox_success(result.message)
                        document.getElementById(`menu-${id}`).remove()
                        return true
                    }

                    const error = result.result.error;
                    if (error) {
                        msgbox_error(error)
                        return false
                    }

                })
                .catch(error => msgbox_error(error));
        }
    </script>

    <?= $this->endSection() ?>