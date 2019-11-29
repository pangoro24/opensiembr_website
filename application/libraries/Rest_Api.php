<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Rest_Api {

	protected $token_header = 'Authorization';
	/**
     * List of allowed HTTP methods
     * EDUCONTROL API REST
     *
     * @var array
     */
    protected $allowed_http_methods = ['get', 'delete', 'post', 'put', 'options', 'patch', 'head'];
    /**
     * The request method is not supported by the following resource
     * @link http://www.restapitutorial.com/httpstatuscodes.html
     */
    const HTTP_METHOD_NOT_ALLOWED = 405;
    /**
     * The request cannot be fulfilled due to multiple errors
     */
    const HTTP_BAD_REQUEST = 400;
    /**
     * Request Timeout
     */
    const HTTP_REQUEST_TIMEOUT = 408;
    /**
     * The requested resource could not be found
     */
    const HTTP_NOT_FOUND = 404;
    /**
     * The user is unauthorized to access the requested resource
     */
    const HTTP_UNAUTHORIZED = 401;
    /**
     * The request has succeeded
     */
    const HTTP_OK = 200;
    /**
     * HTTP status codes and their respective description
     */
    const HEADER_STATUS_STRINGS = [
        '405' => 'HTTP/1.1 405 Method Not Allowed',
        '400' => 'BAD REQUEST',
        '408' => 'Request Timeout',
        '404' => 'NOT FOUND',
        '401' => 'UNAUTHORIZED',
        '200' => 'OK',
    ];
    /**
     * RETURN DATA
     */
    protected $return_other_data = [];

	public function __construct()
	{
		// parent::__construct();
		//Do your magic here
		$this->CI = &get_instance();
	}

	public function _APIConfig($config = [])
    {
        // return other data
        if (isset($config['data']))
            $this->return_other_data = $config['data'];
        // by default method `GET`
        if ((isset($config) and empty($config)) or empty($config['methods'])) {
            $this->_allow_methods(['GET']);
        } else {
            $this->_allow_methods($config['methods']);
        }

        $_POST = json_decode(file_get_contents("php://input"), true);

        // api key function `_api_key()`
        if (isset($config['key']))
            $this->_api_key($config['key']);

        // IF Require Authentication
        if (isset($config['requireAuthorization']) and $config['requireAuthorization'] === true) {
            $token_data = $this->_isAuthorized();
            // remove api time in user token data
            unset($token_data->API_TIME);
            // return token decode data
            return ['token_data' => (array) $token_data];
        }
    }

	/**
	 * Allow Methods
	 * -------------------------------------
	 * @param array $methods
	 * @return bool
	 */
    public function _allow_methods(array $methods)
    {
        $REQUEST_METHOD = $this->CI->input->server('REQUEST_METHOD', TRUE);
        // check request method in `$allowed_http_methods` array()
        if (in_array(strtolower($REQUEST_METHOD), $this->allowed_http_methods)) {
            // check request method in user define `$methods` array()
            if (in_array(strtolower($REQUEST_METHOD), $methods) or in_array(strtoupper($REQUEST_METHOD), $methods)) {
                // allow request method
                return true;
            } else {
                // not allow request method
                $this->_response(['status' => FALSE, 'error' => 'Unknown method'], self::HTTP_METHOD_NOT_ALLOWED);
            }
        } else {
            $this->_response(['status' => FALSE, 'error' => 'Unknown method'], self::HTTP_METHOD_NOT_ALLOWED);
        }
    }
    /**
     * Is Authorized
     */
    private function _isAuthorized()
    {
//    	// Validamos que el token sea genuino
//        $this->CI->load->helper('jwt_helper');
//        $headers = $this->CI->input->request_headers();
//        // $token = $this->CI->input->post('edu_tkn');
//		$token = $this->tokenIsExist($headers);
//
//		if (isset($token['status']) && $token['status'] === false){
//			$this->_response(['status' => FALSE, 'error' => $token['message']], self::HTTP_UNAUTHORIZED);
//		}else{
//			$result = jwt_helper::validate_token_user($token);
//			if (isset($result['status']) and $result['status'] === true)
//			{
//				// HEADERS 200 OK
//				return $result;
//			}else{
//				// Responder con error en el headers HTTP_UNAUTHORIZED
//				$this->_response(['status' => FALSE, 'error' => $result['message'], 'message' => $result['message']], self::HTTP_UNAUTHORIZED);
//			}
//		}
	}
    /**
     * Private Response Function
     */
    private function _response($data = NULL, $http_code = NULL)
    {
        ob_start();
        header('content-type:application/json; charset=UTF-8');
        header(self::HEADER_STATUS_STRINGS[$http_code], true, $http_code);
        if (!is_array($this->return_other_data)) {
            print_r(json_encode(['status' => false, 'error' => 'Invalid data format']));
        } else {
            print_r(json_encode(array_merge($data, $this->return_other_data)));
        }
        ob_end_flush();
        die();
    }

	/**
	 * Token Header Check
	 * @param: request headers
	 * @return array
	 */
    private function tokenIsExist($headers)
    {
        if (!empty($headers) and is_array($headers)) {
            foreach ($headers as $header_name => $header_value) {
                if (strtolower(trim($header_name)) == strtolower(trim($this->token_header))){
					$tokenHeader = explode(' ', $header_value);
    				$token = (isset($tokenHeader) && $tokenHeader[0] === "Bearer")? $tokenHeader[1]: ['status' => FALSE, 'message' => 'Header Not aceptable.'] ;
					return $token;
				}
            }
        }
        return ['status' => FALSE, 'message' => 'Token is not defined.'];
    }
}
