<?php
function pre($data, $exit = true)
{
    echo '<pre>';
    print_r(var_dump($data));
    echo '</pre>';
    if ($exit) {
        exit;
    }
}
