<?php

/**
 * An improve funtion of var_dump that dumps information about a variable
 * 
 * @param mixed $value The variable you want to export
 * @param bool $exit Exit the script after dumping?
 * @return void
 */

function pre($value, bool $exit = true)
{
    echo '<pre>';
    print_r($value);
    echo '</pre>';
    if ($exit) {
        die;
    }
}

/**
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
 * Get time ago in a human readable format
 * 
 * @param int $time Time in seconds
 * @return string Time ago
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
 * Provide response message for failed request
 * 
 * @param string $error Error message to show
 * @return array an array of data for failed response
 */
function response_failed(?mixed $error = null)
{
    return [
        'success' => false,
        'message' => 'Có lỗi xảy ra',
        'result' =>  [
            'error' => $error != null ? $error : 'Dữ liệu không hợp lệ'
        ]
    ];
    var_dump(1);
}

/**
 * Provide response message for successful request
 * 
 * @return array an array of data for successed response
 */
function response_successed($url = null)
{
    return [
        'success' => true,
        'message' => 'Thành công',
        'result'  =>  [
            'url_redirect' => $url != null ? $url : ''
        ]
    ];
}


/**
 * Provide a set of error messages in Vietnamese language.
 * 
 * @return array an array of error messages 
 */
function custom_validation_rule()
{
    return [
        'username' => [
            'required' => 'Tài khoản không được để trống!',
        ],
        'email' => [
            'required' => 'Email không được để trống!',
            'valid_email' => 'Email không hợp lệ!',
        ],
        'password' => [
            'required' => 'Mật khẩu không được để trống!',
            'min_length' => 'Mật khẩu phải có ít nhất 3 kí tự!',
        ],
    ];
}


/**
 * Convinience redirect with flash message
 * 
 * @param string $url URL to redirect
 * @param mixed $message Message to store in flash session
 * @param string $type Type of message
 * @return \CodeIgniter\HTTP\RedirectResponse destination URL
 */
function redirect_with_message(string $url, $message, string $type = 'error_msg')
{
    session()->setFlashdata($type, $message);
    return redirect()->to($url);
}
