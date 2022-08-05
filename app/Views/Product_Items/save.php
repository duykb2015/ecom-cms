<?= $this->extend('layout') ?>
<?= $this->section('css') ?>
<!-- jpro forms css -->
<link rel="stylesheet" type="text/css" href="<?= base_url() ?>\templates\admin\adminty_dashboard\libraries\assets\pages\j-pro\css\demo.css">
<link rel="stylesheet" type="text/css" href="<?= base_url() ?>\templates\admin\adminty_dashboard\libraries\assets\pages\j-pro\css\font-awesome.min.css">
<link rel="stylesheet" type="text/css" href="<?= base_url() ?>\templates\admin\adminty_dashboard\libraries\assets\pages\j-pro\css\j-forms.css">
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
                                    <?php $errors = session()->getFlashdata('error_msg') ?>
                                    <?php if (!empty($errors)) : ?>
                                        <div class="alert alert-danger">
                                            <?= $errors ?>
                                        </div>
                                    <?php endif ?>
                                    <div class="col-sm-12">
                                        <div class="product-edit">
                                            <form class="md-float-material card-block j-forms" id="j-forms" action="<?= base_url('product-item/save') ?>" method="POST" enctype="multipart/form-data">
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

                                                <div class="row content mb-3">
                                                    <div class="content col-sm-12">
                                                        <div class="clone-rightside-btn-1">
                                                            <label class="label">Right side buttons</label>
                                                            <div class="j-row toclone-widget-right toclone">
                                                                <div class="span6 unit">
                                                                    <div class="input">
                                                                        <span class="input-group-addon"><i class="icofont icofont-color-picker"></i></span>
                                                                        <input type="text" class="form-control" id="color" name="color" placeholder="Màu sản phẩm (ghi tiếng Anh)" value="<?= isset($product['color']) ? $product['color'] : set_value('color') ?>" required>
                                                                    </div>
                                                                </div>
                                                                <div class="span6 unit">
                                                                    <div class="input">
                                                                        <span class="input-group-addon"><i class="icofont icofont-color-picker"></i></span>
                                                                        <input type="text" class="form-control" name="color" placeholder="Màu sản phẩm (ghi tiếng Anh)" value="<?= isset($product['color']) ? $product['color'] : set_value('color') ?>" required>
                                                                    </div>
                                                                </div>
                                                                <div class="span6 unit">
                                                                    <div class="input">
                                                                        <span class="input-group-addon"><i class="icofont icofont-price"></i></span>
                                                                        <input type="text" class="form-control" name="price" placeholder="Giá" value="<?= isset($product['price']) ? $product['price'] : set_value('price') ?>" required>
                                                                    </div>
                                                                </div>
                                                                <div class="span6 unit">
                                                                    <div class="input">
                                                                        <span class="input-group-addon"><i class="icofont icofont-color-picker"></i></span>
                                                                        <input type="text" class="form-control" id="hexcode" name="hexcode" placeholder="Mã màu" value="<?= isset($product['hexcode']) ? $product['hexcode'] : set_value('hexcode') ?>" required>
                                                                    </div>
                                                                </div>
                                                                <div class="span6 unit">
                                                                    <div class="input">
                                                                        <span class="input-group-addon"><i class="icofont icofont-numbered"></i></span>
                                                                        <input type="text" class="form-control" name="quantity" placeholder="Số lượng" value="<?= isset($product['quantity']) ? $product['quantity'] : set_value('quantity') ?>" required>
                                                                    </div>
                                                                </div>
                                                                <div class="span6 unit">
                                                                    <div class="input">
                                                                        <select name="status" class="form-control">
                                                                            <?php foreach (PRODUCT_STATUS as $key => $val) : ?>
                                                                                <option value="<?= $key ?>" <?= isset($product_item['status']) && $product_item['status'] == $key ? 'selected' : '' ?>><?= $val ?></option>
                                                                            <?php endforeach ?>
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                                <button type="button" class="btn btn-primary clone-btn-right clone">
                                                                    <i class="icofont icofont-plus"></i>
                                                                </button>
                                                                <button type="button" class="btn btn-default clone-btn-right delete">
                                                                    <i class="icofont icofont-minus"></i>
                                                                </button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!-- <div class="col-sm-10">
                                                        <div class="input-group">
                                                            <span class="input-group-addon"><i class="icofont icofont-color-picker"></i></span>
                                                            <input type="text" class="form-control" id="color" name="color" placeholder="Màu sản phẩm (ghi tiếng Anh)" value="<?= isset($product['color']) ? $product['color'] : set_value('color') ?>" required>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-2">
                                                        <div class="input-group">
                                                            <span class="input-group-addon"><i class="icofont icofont-color-picker"></i></span>
                                                            <input type="text" class="form-control" name="color" placeholder="Màu sản phẩm (ghi tiếng Anh)" value="<?= isset($product['color']) ? $product['color'] : set_value('color') ?>" required>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <div class="input-group">
                                                            <span class="input-group-addon"><i class="icofont icofont-price"></i></span>
                                                            <input type="text" class="form-control" name="price" placeholder="Giá" value="<?= isset($product['price']) ? $product['price'] : set_value('price') ?>" required>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <div class="input-group">
                                                            <span class="input-group-addon"><i class="icofont icofont-color-picker"></i></span>
                                                            <input type="text" class="form-control" id="hexcode" name="hexcode" placeholder="Mã màu" value="<?= isset($product['hexcode']) ? $product['hexcode'] : set_value('hexcode') ?>" required>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <div class="input-group">
                                                            <span class="input-group-addon"><i class="icofont icofont-numbered"></i></span>
                                                            <input type="text" class="form-control" name="quantity" placeholder="Số lượng" value="<?= isset($product['quantity']) ? $product['quantity'] : set_value('quantity') ?>" required>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <select name="status" class="form-control">
                                                            <?php foreach (PRODUCT_STATUS as $key => $val) : ?>
                                                                <option value="<?= $key ?>" <?= isset($product_item['status']) && $product_item['status'] == $key ? 'selected' : '' ?>><?= $val ?></option>
                                                            <?php endforeach ?>
                                                        </select>
                                                    </div> -->
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

        //color
        function colourNameToHex(colour) {
            var colours = {
                "aliceblue": "#f0f8ff",
                "antiquewhite": "#faebd7",
                "aqua": "#00ffff",
                "aquamarine": "#7fffd4",
                "azure": "#f0ffff",
                "beige": "#f5f5dc",
                "bisque": "#ffe4c4",
                "black": "#000000",
                "blanchedalmond": "#ffebcd",
                "blue": "#0000ff",
                "blueviolet": "#8a2be2",
                "brown": "#a52a2a",
                "burlywood": "#deb887",
                "cadetblue": "#5f9ea0",
                "chartreuse": "#7fff00",
                "chocolate": "#d2691e",
                "coral": "#ff7f50",
                "cornflowerblue": "#6495ed",
                "cornsilk": "#fff8dc",
                "crimson": "#dc143c",
                "cyan": "#00ffff",
                "darkblue": "#00008b",
                "darkcyan": "#008b8b",
                "darkgoldenrod": "#b8860b",
                "darkgray": "#a9a9a9",
                "darkgreen": "#006400",
                "darkkhaki": "#bdb76b",
                "darkmagenta": "#8b008b",
                "darkolivegreen": "#556b2f",
                "darkorange": "#ff8c00",
                "darkorchid": "#9932cc",
                "darkred": "#8b0000",
                "darksalmon": "#e9967a",
                "darkseagreen": "#8fbc8f",
                "darkslateblue": "#483d8b",
                "darkslategray": "#2f4f4f",
                "darkturquoise": "#00ced1",
                "darkviolet": "#9400d3",
                "deeppink": "#ff1493",
                "deepskyblue": "#00bfff",
                "dimgray": "#696969",
                "dodgerblue": "#1e90ff",
                "firebrick": "#b22222",
                "floralwhite": "#fffaf0",
                "forestgreen": "#228b22",
                "fuchsia": "#ff00ff",
                "gainsboro": "#dcdcdc",
                "ghostwhite": "#f8f8ff",
                "gold": "#ffd700",
                "goldenrod": "#daa520",
                "gray": "#808080",
                "green": "#008000",
                "greenyellow": "#adff2f",
                "honeydew": "#f0fff0",
                "hotpink": "#ff69b4",
                "indianred ": "#cd5c5c",
                "indigo": "#4b0082",
                "ivory": "#fffff0",
                "khaki": "#f0e68c",
                "lavender": "#e6e6fa",
                "lavenderblush": "#fff0f5",
                "lawngreen": "#7cfc00",
                "lemonchiffon": "#fffacd",
                "lightblue": "#add8e6",
                "lightcoral": "#f08080",
                "lightcyan": "#e0ffff",
                "lightgoldenrodyellow": "#fafad2",
                "lightgrey": "#d3d3d3",
                "lightgreen": "#90ee90",
                "lightpink": "#ffb6c1",
                "lightsalmon": "#ffa07a",
                "lightseagreen": "#20b2aa",
                "lightskyblue": "#87cefa",
                "lightslategray": "#778899",
                "lightsteelblue": "#b0c4de",
                "lightyellow": "#ffffe0",
                "lime": "#00ff00",
                "limegreen": "#32cd32",
                "linen": "#faf0e6",
                "magenta": "#ff00ff",
                "maroon": "#800000",
                "mediumaquamarine": "#66cdaa",
                "mediumblue": "#0000cd",
                "mediumorchid": "#ba55d3",
                "mediumpurple": "#9370d8",
                "mediumseagreen": "#3cb371",
                "mediumslateblue": "#7b68ee",
                "mediumspringgreen": "#00fa9a",
                "mediumturquoise": "#48d1cc",
                "mediumvioletred": "#c71585",
                "midnightblue": "#191970",
                "mintcream": "#f5fffa",
                "mistyrose": "#ffe4e1",
                "moccasin": "#ffe4b5",
                "navajowhite": "#ffdead",
                "navy": "#000080",
                "oldlace": "#fdf5e6",
                "olive": "#808000",
                "olivedrab": "#6b8e23",
                "orange": "#ffa500",
                "orangered": "#ff4500",
                "orchid": "#da70d6",
                "palegoldenrod": "#eee8aa",
                "palegreen": "#98fb98",
                "paleturquoise": "#afeeee",
                "palevioletred": "#d87093",
                "papayawhip": "#ffefd5",
                "peachpuff": "#ffdab9",
                "peru": "#cd853f",
                "pink": "#ffc0cb",
                "plum": "#dda0dd",
                "powderblue": "#b0e0e6",
                "purple": "#800080",
                "rebeccapurple": "#663399",
                "red": "#ff0000",
                "rosybrown": "#bc8f8f",
                "royalblue": "#4169e1",
                "saddlebrown": "#8b4513",
                "salmon": "#fa8072",
                "sandybrown": "#f4a460",
                "seagreen": "#2e8b57",
                "seashell": "#fff5ee",
                "sienna": "#a0522d",
                "silver": "#c0c0c0",
                "skyblue": "#87ceeb",
                "slateblue": "#6a5acd",
                "slategray": "#708090",
                "snow": "#fffafa",
                "springgreen": "#00ff7f",
                "steelblue": "#4682b4",
                "tan": "#d2b48c",
                "teal": "#008080",
                "thistle": "#d8bfd8",
                "tomato": "#ff6347",
                "turquoise": "#40e0d0",
                "violet": "#ee82ee",
                "wheat": "#f5deb3",
                "white": "#ffffff",
                "whitesmoke": "#f5f5f5",
                "yellow": "#ffff00",
                "yellowgreen": "#9acd32"
            };

            if (typeof colours[colour.toLowerCase()] != 'undefined')
                return colours[colour.toLowerCase()];

            return "Không có mã cho màu này";
        }

        $('#color').on('keyup', function() {
            $('#hexcode').val(colourNameToHex($(this).val()))
        })
    </script>

    <script type="text/javascript" src="<?= base_url() ?>\templates\admin\adminty_dashboard\libraries\assets\pages\j-pro\js\jquery.ui.min.js"></script>
    <script type="text/javascript" src="<?= base_url() ?>\templates\admin\adminty_dashboard\libraries\assets\pages\j-pro\js\jquery.maskedinput.min.js"></script>
    <script type="text/javascript" src="<?= base_url() ?>\templates\admin\adminty_dashboard\libraries\assets\pages\j-pro\js\jquery-cloneya.js"></script>
    <script type="text/javascript" src="<?= base_url() ?>\templates\admin\adminty_dashboard\libraries\assets\pages\j-pro\js\custom\cloned-form.js"></script>

    <?= $this->endSection() ?>