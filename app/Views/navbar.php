<?php
$menus = [
    [
        'url' => base_url('/'),
        'active' => '/',
        'level' => 1,
        'name' => 'Dashboard',
        'icon' => '<i class="feather icon-home"></i>',
    ],
    [
        'url' => '',
        'active' => 'admin',
        'level' => 1,
        'name' => 'Quản lý Tài khoản',
        'icon' => '<i class="feather icon-user"></i>',
        'sub_menu' => [
            [
                'url' => base_url('admin'),
                'name' => 'Danh sách',
                'level' => 3,
            ],
            [
                'url' => base_url('admin/save'),
                'name' => 'Thêm',
                'level' => 3,
            ],
        ]
    ],
    [
        'url' => '',
        'name' => 'Quản lý Menu',
        'active' => 'menu',
        'level' => 2,
        'icon' => '<i class="feather icon-menu"></i>',
        'sub_menu' => [
            [
                'url' => base_url('menu'),
                'name' => 'Danh sách',
                'level' => 2,
            ],
            [
                'url' => base_url('menu/save'),
                'name' => 'Thêm mới',
                'level' => 3,
            ],
        ]
    ],
    [
        'url' => '',
        'name' => 'Quản lý thuộc tính',
        'active' => 'attribute',
        'level' => 2,
        'icon' => '<i class="feather icon-box"></i>',
        'sub_menu' => [
            [
                'url' => base_url('attribute'),
                'name' => 'Danh sách',
                'level' => 2,
            ],
            [
                'url' => base_url('attribute/save'),
                'name' => 'Thêm mới',
                'level' => 2,
            ],
        ]
    ],
    [
        'url' => '',
        'name' => 'Quản lý sản phẩm',
        'active' => 'product',
        'level' => 1,
        'icon' => '<i class="feather icon-shopping-cart"></i>',
        'sub_menu' => [
            [
                'url' => base_url('product'),
                'name' => 'Dòng sản phẩm',
                'level' => 1,
            ],
            [
                'url' => base_url('product/save'),
                'name' => 'Thêm dòng sản phẩm',
                'level' => 2,
            ],
            [
                'url' => base_url('product-item'),
                'name' => 'Danh sách sản phẩm',
                'level' => 1,
            ],
            [
                'url' => base_url('product-item/save'),
                'name' => 'Thêm mới',
                'level' => 2,
            ],
        ]
    ],



];
?>

<nav class="pcoded-navbar">
    <div class="pcoded-inner-navbar main-menu">
        <div class="pcoded-navigatio-lavel">Bảng điều khiển</div>
        <ul class="pcoded-item pcoded-left-item">
            <?php foreach ($menus as $row) : ?>
                <?php $class_active = url_is($row['active'] . '*') ? 'active pcoded-trigger' : ''; ?>
                <?php if (session()->get('level') >= $row['level']) : ?>
                    <li class="<?= !empty($row['url']) ? '' : 'pcoded-hasmenu' ?> <?= $class_active ?>">
                        <a href="<?= !empty($row['url']) ? $row['url'] : 'javascript:void(0)' ?>">
                            <span class="pcoded-micon"><?= $row['icon'] ?></span>
                            <span class="pcoded-mtext"><?= $row['name'] ?></span>
                        </a>

                        <?php if (!empty($row['sub_menu'])) : ?>
                            <ul class="pcoded-submenu">
                                <?php foreach ($row['sub_menu'] as $val) : ?>
                                    <?php if (session()->get('level') >= $val['level']) : ?>
                                        <li class="<?= url_is(str_replace(base_url(), '', $val['url'])) ? 'active' : '' ?>">
                                            <a href="<?= $val['url'] ?>">
                                                <span class="pcoded-mtext"><?= $val['name'] ?></span>
                                            </a>
                                        </li>
                                    <?php endif; ?>
                                <?php endforeach ?>
                            </ul>
                        <?php endif ?>
                    </li>
                <?php endif ?>
            <?php endforeach ?>
        </ul>
    </div>
</nav>