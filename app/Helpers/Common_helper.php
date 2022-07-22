<?php
function pre($data, $exit = false)
{
    echo '<pre>';
    print_r(var_dump($data));
    echo '</pre>';
    if ($exit) {
        exit;
    }
}
