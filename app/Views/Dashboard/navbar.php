<?php
$menus = [
    [
        'url' => base_url('dashboard'),
        'active' => 'dashboard',
        'name' => 'Dashboard',
        'icon' => '<i class="feather icon-home"></i>',
    ],
    [
        'url' => '',
        'name' => 'Quản lý Nick',
        'active' => 'dashboard/product',
        'icon' => '<i class="feather icon-shopping-cart"></i>',
        'sub_menu' => [
            [
                'url' => base_url('dashboard/product'),
                'name' => 'Danh sách',
            ],
        ]
    ],
    [
        'url' => '',
        'active' => 'dashboard/service',
        'name' => 'Quản lý Dịch Vụ',
        'icon' => '<i class="feather icon-cpu"></i>',
        'sub_menu' => [
            [
                'url' => base_url('dashboard/service'),
                'name' => 'Danh sách',
            ],
        ]
    ],
    [
        'url' => '',
        'active' => 'dashboard/post',
        'name' => 'Quản lý Bài Viết',
        'icon' => '<i class="feather icon-inbox"></i>',
        'sub_menu' => [
            [
                'url' => base_url('dashboard/post'),
                'name' => 'Danh sách',
            ],
        ]
    ],
    [
        'url' => '',
        'active' => 'dashboard/monster',
        'name' => 'Quản lý Quái Thú',
        'icon' => '<i class="feather icon-tv"></i>',
        'sub_menu' => [
            [
                'url' => base_url('dashboard/monster'),
                'name' => 'Danh sách',
            ],
            [
                'url' => base_url('dashboard/monster/save'),
                'name' => 'Thêm',
            ],
        ]
    ],
    [
        'url' => '',
        'active' => 'dashboard/tag',
        'name' => 'Quản lý Tag',
        'icon' => '<i class="feather icon-hash"></i>',
        'sub_menu' => [
            [
                'url' => base_url('dashboard/tag'),
                'name' => 'Danh sách',
            ],
            [
                'url' => base_url('dashboard/tag/save'),
                'name' => 'Thêm',
            ],
        ]
    ],

    [
        'url' => '',
        'active' => 'dashboard/meta-seo',
        'name' => 'Quản lý Meta Seo',
        'icon' => '<i class="feather icon-server"></i>',
        'sub_menu' => [
            [
                'url' => base_url('dashboard/meta-seo'),
                'name' => 'Danh sách',
            ],
        ]
    ],
    [
        'url' => '',
        'name' => 'Quản lý Menu',
        'active' => 'dashboard/menu',
        'icon' => '<i class="feather icon-sidebar"></i>',
        'sub_menu' => [
            [
                'url' => base_url('dashboard/menu'),
                'name' => 'Danh sách',
            ],
            [
                'url' => base_url('dashboard/menu/save'),
                'name' => 'Thêm mới',
            ],
        ]
    ],
    [
        'url' => '',
        'name' => 'Quản lý Package',
        'active' => 'dashboard/billing',
        'icon' => '<i class="feather icon-sidebar"></i>',
        'sub_menu' => [
            [
                'url' => base_url('dashboard/billing/package'),
                'name' => 'Danh sách',
            ],
            [
                'url' => base_url('dashboard/billing/package/save'),
                'name' => 'Thêm mới',
            ],
        ]
    ],
];
?>

<nav class="pcoded-navbar">
    <div class="pcoded-inner-navbar main-menu">
        <div class="pcoded-navigatio-lavel">Navigation</div>
        <ul class="pcoded-item pcoded-left-item">
            <?php foreach ($menus as $row) : ?>
                <?php
                $class_active = url_is($row['active'] . '*') ? 'active pcoded-trigger' : '';
                ?>
                <li class="<?= !empty($row['url']) ? '' : 'pcoded-hasmenu' ?> <?= $class_active ?>">
                    <a href="<?= !empty($row['url']) ? $row['url'] : 'javascript:void(0)' ?>">
                        <span class="pcoded-micon"><?= $row['icon'] ?></span>
                        <span class="pcoded-mtext"><?= $row['name'] ?></span>
                    </a>

                    <?php if (!empty($row['sub_menu'])) : ?>
                        <ul class="pcoded-submenu">
                            <?php foreach ($row['sub_menu'] as $val) : ?>
                                <li class="<?= url_is(str_replace(base_url(), '', $val['url'])) ? 'active' : '' ?>">
                                    <a href="<?= $val['url'] ?>">
                                        <span class="pcoded-mtext"><?= $val['name'] ?></span>
                                    </a>
                                </li>
                            <?php endforeach ?>
                        </ul>
                    <?php endif ?>
                </li>
            <?php endforeach ?>
        </ul>
    </div>
</nav>