<?php defined('BASEPATH') or exit('No direct script access allowed');

if (!function_exists('json_output')) {
    function json_output($data)
    {
        header('Access-Control-Allow_Origin: *');
        header('Cache-Control: no-cache, must-revalidate');
        header('Expires: Mon, 26 Jul 1997 05:00:00 GMT');
        header('Content-type: application/json');

        if (isset($data['error']) && $data['error'] == TRUE) {
            header('HTTP/2.0 401 Unauthorized');
        }

        echo json_encode($data);
    }
}
if (!function_exists('pwEncrypt')) {
	function pwEncrypt($string = null)
	{
		if ($string) {
			return password_hash($string, PASSWORD_BCRYPT,  [10]);
			// return hash('sha512', $string . config_item('encryption_key'));
		}else{
			return false;
		}
	}
}

if (!function_exists('pwDecrypt')) {
	function pwDecrypt($pwText = null, $pwhash =  null)
	{
		return password_verify($pwText, $pwhash);
	}
}

if (!function_exists('status_order')) {
	function status_order($status = null)
	{
		switch ($status) {
			case 1:
				return 'nuevo';
				break;
			case 2:
				return 'procesando';
				break;
			case 3:
				return 'completado';
				break;
			case 4:
				return 'cancelado';
				break;
		}
	}
}
