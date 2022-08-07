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
function response_failed(?string $error = null)
{
    return [
        'success' => false,
        'message' => 'Có lỗi xảy ra',
        'result' =>  [
            'error' => $error != null ? $error : 'Có lỗi xảy ra, thử lại sau'
        ]
    ];
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
function custom_validation_error_message()
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

/**
 * Used to create slug from string
 * 
 * @param string $str String to convert to slug
 * @return string Slug
 */
function create_slug($string)
{
    $search = array(
        '#(à|á|ạ|ả|ã|â|ầ|ấ|ậ|ẩ|ẫ|ă|ằ|ắ|ặ|ẳ|ẵ)#',
        '#(è|é|ẹ|ẻ|ẽ|ê|ề|ế|ệ|ể|ễ)#',
        '#(ì|í|ị|ỉ|ĩ)#',
        '#(ò|ó|ọ|ỏ|õ|ô|ồ|ố|ộ|ổ|ỗ|ơ|ờ|ớ|ợ|ở|ỡ)#',
        '#(ù|ú|ụ|ủ|ũ|ư|ừ|ứ|ự|ử|ữ)#',
        '#(ỳ|ý|ỵ|ỷ|ỹ)#',
        '#(đ)#',
        '#(À|Á|Ạ|Ả|Ã|Â|Ầ|Ấ|Ậ|Ẩ|Ẫ|Ă|Ằ|Ắ|Ặ|Ẳ|Ẵ)#',
        '#(È|É|Ẹ|Ẻ|Ẽ|Ê|Ề|Ế|Ệ|Ể|Ễ)#',
        '#(Ì|Í|Ị|Ỉ|Ĩ)#',
        '#(Ò|Ó|Ọ|Ỏ|Õ|Ô|Ồ|Ố|Ộ|Ổ|Ỗ|Ơ|Ờ|Ớ|Ợ|Ở|Ỡ)#',
        '#(Ù|Ú|Ụ|Ủ|Ũ|Ư|Ừ|Ứ|Ự|Ử|Ữ)#',
        '#(Ỳ|Ý|Ỵ|Ỷ|Ỹ)#',
        '#(Đ)#',
        "/[^a-zA-Z0-9\-\_]/",
    );
    $replace = array(
        'a',
        'e',
        'i',
        'o',
        'u',
        'y',
        'd',
        'A',
        'E',
        'I',
        'O',
        'U',
        'Y',
        'D',
        '-',
    );
    $string = preg_replace($search, $replace, $string);
    $string = preg_replace('/(-)+/', '-', $string);
    $string = strtolower($string);
    return $string;
}

/**
 * Used to remove file from server, if exists
 *
 * @param string $images json encode string of images name
 * @return bool TRUE on success or FALSE on failure
 */
function remove($file_name)
{
    $file = ROOTPATH . 'public/uploads/' . $file_name;
    if (!file_exists($file)) {
        return false;
    }
    return unlink($file);;
}
