<?php

/**
 * Dumping data
 * 
 * An funtion that dump data to the screen
 * 
 * @param mixed $data Data to dump
 * @param bool $exit Exit the script after dumping?
 * @return void
 */

function pre($data, $exit = true)
{
    echo '<pre>';
    print_r(($data));
    echo '</pre>';
    if ($exit) {
        exit;
    }
}

/**
 * Encrypt Email
 * 
 * Encrypt email to protect it from hackers
 * 
 * @param string $email Email to encrypt
 * @return string Encrypted email
 */
function encrypt_email($email)
{
    for ($i = 4; $i < strlen($email); $i++) {
        $email[$i] = '*';
    }
    return $email;
}

/**
 * Get Time Ago
 * 
 * Get time ago in a human readable format
 * 
 * @param int $time Time in seconds
 * @return string Time ago in a human readable format
 */
function get_time_ago($time)
{
    $time_difference = time() - $time;
    if ($time_difference < 1) {
        return 'Ít hơn 1 giây trước';
    }
    $condition = array(
        12 * 30 * 24 * 60 * 60 =>  'năm',
        30 * 24 * 60 * 60       =>  'tháng',
        24 * 60 * 60            =>  'ngày',
        60 * 60                 =>  'giờ',
        60                      =>  'phút',
        1                       =>  'giây'
    );

    foreach ($condition as $secs => $str) {
        $d = $time_difference / $secs;

        if ($d >= 1) {
            $t = round($d);
            return $t . ' ' . $str . ' trước';
        }
    }
}
/**
 * Response message for failed request
 * 
 * An funtion that return an array of data for failed response
 * 
 * @param string $error Error message to show
 * @return array 
 */
function response_failed(?mixed $error = null)
{
    return [
        'success' => false,
        'message' => 'Có lỗi xảy ra',
        'result' =>  [
            'error' => $error != null ? $error : 'Dữ liệu không hợp lệ',
        ]
    ];
}

/**
 * Response message for successed request
 * 
 * An funtion that return an array of data for successed response
 * 
 * @param null
 * @return array 
 */
function response_successed(?mixed $url = null)
{
    if ($url == null) {
        return [
            'success' => true,
            'message' => 'Thành công',
        ];
    } else {
        return [
            'success' => true,
            'message' => 'Thành công',
            'result' =>  [
                'url_redirect' => $url,
            ]
        ];
    }
}
