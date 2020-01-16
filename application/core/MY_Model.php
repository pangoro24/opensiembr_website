<?php defined('BASEPATH') OR exit('No direct script access allowed');

class MY_Model extends CI_Model
{
    protected $_table_name = '';
    protected $_primary_key = 'id';
    protected $_primary_filter = 'intval';
    protected $_order_by = '';
    public $rules = array();
    protected $_timestamps = FALSE;

    # Image Manipulation
    protected $width = 0;
    protected $height = 0;
    protected $quality = 100;
    protected $x_axis = 0;
    protected $y_axis = 0;
    protected $maintain_ratio = FALSE;

    function __construct()
    {
        parent::__construct();
    }

    /**
     * @param $fields
     * @return array
     */
    public function array_from_post($fields)
    {

        $data = array();
        foreach ($fields as $field) {
            $data[$field] = $this->input->post($field);
        }
        return $data;
    }

    /**
     * @param null $id
     * @param bool $single
     * @return mixed
     */
    public function get($id = NULL, $single = FALSE)
    {

        if ($id != NULL) {
            $filter = $this->_primary_filter;
            $id     = $filter($id);
            $this->db->where($this->_primary_key, $id);
            $method = 'row';
        } elseif ($single == TRUE) {
            $method = 'row';
        } else {
            $method = 'result';
        }

        $this->db->order_by($this->_order_by);
        return $this->db->get($this->_table_name)->$method();
    }

    /**
     * @param $where
     * @param bool $single
     * @return mixed
     */
    public function get_by($where, $single = FALSE)
    {
        $this->db->where($where);
        return $this->get(NULL, $single);
    }

    /**
     * @param $data
     * @param null $id
     * @return |null
     */
    public function save($data, $id = NULL)
    {
        #Set timestamps
        if ($this->_timestamps == TRUE) {
            $now = date('Y-m-d H:i:s');
            $id || $data['created'] = $now;
            $data['modified'] = $now;
        }

        #Insert
        if ($id === NULL) {
            !isset($data[$this->_primary_key]) || $data[$this->_primary_key] = NULL;
            $this->db->set($data);
            $this->db->insert($this->_table_name);
            $id = $this->db->insert_id();
        }
        #Update
        else {
            $filter = $this->_primary_filter;
            $id     = $filter($id);
            $this->db->set($data);
            $this->db->where($this->_primary_key, $id);
            $this->db->update($this->_table_name);
        }

        return $id;
    }

    /**
     * @param $id
     * @return bool
     */
    public function delete($id)
    {
        $filter = $this->_primary_filter;
        $id     = $filter($id);

        if (!$id) {
            return FALSE;
        }
        $this->db->where($this->_primary_key, $id);
        $this->db->limit(1);
        $this->db->delete($this->_table_name);
    }

    /**
     * Delete Multiple rows
     */
    public function delete_multiple($where)
    {
        $this->db->where($where);
        $this->db->delete($this->_table_name);
    }

    /**
     * @param $field
     * @param $real_path
     * @param $type_send
     * @param null $mode
     * @return bool|mixed
     */
    function uploadImage($field, $real_path, $type_send, $mode = null)
    {
        $config['upload_path']   = $real_path;
        $config['allowed_types'] = 'gif|jpg|jpeg|png';
        $config['max_size']      = '20000';
        $config['overwrite']     = TRUE;
        $config['encrypt_name'] = TRUE;
        # $config['max_width']     = '1024';
        # $config['max_height']    = '768';

        $this->load->library('upload', $config);
        $this->upload->initialize($config);
        if (!$this->upload->do_upload($field)) {
            $error   = $this->upload->display_errors();
            $type    = "error";
            $message = $error;

            if ($type_send == 'xhr') {
                $response['error'] = true;
                $response['message'] = $message;
                return $response;
            }else{
                set_message($type, $message);
                return FALSE;
            }
            # uploading failed. $error will holds the errors.
        } else {
            $fdata = $this->upload->data();
            if (isset($mode)) {
                switch ($mode) {
                    case "crop":
                        $img_data = $this->crop($fdata, $real_path);
                        $img_data['file_name'] = $fdata['file_name'];
                        $img_data['path'] = $config['upload_path'] . $fdata['file_name'];
                break;
                    case "resize":
                        $img_data = $this->resize($fdata, $real_path);
                        $img_data['file_name'] = $fdata['file_name'];
                        $img_data['path'] = $config['upload_path'] . $fdata['file_name'];
                        break;
                }
            }else{
                $img_data['file_name'] = $fdata['file_name'];
                $img_data['path'] = $config['upload_path'] . $fdata['file_name'];
            }

            return $img_data;
            # uploading successfull, now do your further actions
        }
    }

    # Resize Manipulation.

    /**
     * @param $image_data
     * @param $real_path
     * @return mixed
     */
    public function resize($image_data, $real_path)
    {
        $this->load->library('image_lib');
        $config['image_library']  = 'gd2';
        $config['source_image']   = $image_data['full_path'];
        $config['new_image']      = $real_path;
        $config['quality']        = $this->quality;
        $config['width']          = $this->width;
        $config['height']         = $this->height;
        $config['maintain_ratio'] = $this->maintain_ratio;

        #send config array to image_lib's  initialize function
        $this->image_lib->initialize($config);
        $data['image'] = $config['new_image'];
        # Call resize function in image library.
        $this->image_lib->resize();
        # Return new image contains above properties and also store in "upload" folder.
        return $data;
    }

    # Crop Manipulation.

    /**
     * @param $image_data
     * @param $real_path
     * @return mixed
     */
    public function crop($image_data, $real_path)
    {
        $this->load->library('image_lib');
        $config['image_library']  = 'gd2';
        $config['source_image']   = $image_data['full_path'];
        $config['quality']        = $this->quality;
        $config['width']          = $this->width;
        $config['height']         = $this->height;
        $config['x_axis']         = $this->x_axis;
        $config['y_axis']         = $this->y_axis;
        $config['new_image']      = $real_path;
        $config['maintain_ratio'] = $this->maintain_ratio;

        #send config array to image_lib's  initialize function
        $this->image_lib->initialize($config);
        $data['image'] = $config['new_image'];
        # Call crop function in image library.
        $this->image_lib->crop();
        # Return new image contains above properties and also store in "upload" folder.
        return $data;
    }

    /**
     * @param $field
     * @param $real_path
     * @param $type_send
     * @return bool
     */
    function uploadFile($field, $real_path, $type_send)
    {
        $config['upload_path']   = $real_path;
        $config['allowed_types'] = 'pdf|docx|doc|ai|iso';
        $config['max_size']      = '2048';
        $config['encrypt_name'] = TRUE;
        $this->load->library('upload', $config);
        $this->upload->initialize($config);
        if (!$this->upload->do_upload($field)) {
            $error   = $this->upload->display_errors();
            $type    = "error";
            $message = $error;

            if ($type_send == 'xhr') {
                $response['error'] = true;
                $response['message'] = $message;
                return $response;
            }else{
                set_message($type, $message);
                return FALSE;
            }
            # uploading failed. $error will holds the errors.
        } else {
            $fdata                     = $this->upload->data();
            $file_data['fileName']     = $fdata['file_name'];
            $file_data['path']         = $config['upload_path'] . $fdata['file_name'];
            $file_data['fullPath']     = $fdata['full_path'];
            $file_data['ext']          = $fdata['file_ext'];
            $file_data['size']         = $fdata['file_size'];
            $file_data['is_image']     = $fdata['is_image'];
            $file_data['image_width']  = $fdata['image_width'];
            $file_data['image_height'] = $fdata['image_height'];
            return $file_data;
            # uploading successfull, now do your further actions
        }
    }

    /**
     * @param $field
     * @param $real_path
     * @param $type_send
     * @return bool
     */
    function uploadAllType($field, $real_path, $type_send)
    {
        $config['upload_path']   = $real_path;
        $config['allowed_types'] = '*';
        $config['max_size']      = '2048';
        $config['encrypt_name'] = TRUE;
        $this->load->library('upload', $config);
        $this->upload->initialize($config);
        if (!$this->upload->do_upload($field)) {
            $error   = $this->upload->display_errors();
            $type    = "error";
            $message = $error;

            if ($type_send == 'xhr') {
                $response['error'] = true;
                $response['message'] = $message;
                return $response;
            }else{
                set_message($type, $message);
                return FALSE;
            }
            # uploading failed. $error will holds the errors.
        } else {
            $fdata                     = $this->upload->data();
            $file_data['fileName']     = $fdata['file_name'];
            $file_data['path']         = $config['upload_path'] . $fdata['file_name'];
            $file_data['fullPath']     = $fdata['full_path'];
            $file_data['ext']          = $fdata['file_ext'];
            $file_data['size']         = $fdata['file_size'];
            $file_data['is_image']     = $fdata['is_image'];
            $file_data['image_width']  = $fdata['image_width'];
            $file_data['image_height'] = $fdata['image_height'];
            return $file_data;
            # uploading successfull, now do your further actions
        }
    }

    /**
     * @param $field
     * @param $real_path
     * @param $type_send
     * @return array|bool
     */
    function multi_uploadAllType($field, $real_path, $type_send)
    {
        $config['upload_path']   = $real_path;
        $config['allowed_types'] = '*';
        $config['max_size']      = '2048';
        $config['encrypt_name'] = TRUE;
        $this->load->library('upload', $config);
        $this->upload->initialize($config);
        if (!$this->upload->do_multi_upload($field)) {
            $error   = $this->upload->display_errors();
            $type    = "error";
            $message = $error;

            if ($type_send == 'xhr') {
                $response['error'] = true;
                $response['message'] = $message;
                return $response;
            }else{
                set_message($type, $message);
                return FALSE;
            }
            # uploading failed. $error will holds the errors.
        } else {
            $multi_fdata = $this->upload->get_multi_upload_data();
            foreach ($multi_fdata as $fdata) {

                $file_data['fileName']     = $fdata['file_name'];
                $file_data['path']         = $config['upload_path'] . $fdata['file_name'];
                $file_data['fullPath']     = $fdata['full_path'];
                $file_data['ext']          = $fdata['file_ext'];
                $file_data['size']         = $fdata['file_size'];
                $file_data['is_image']     = $fdata['is_image'];
                $file_data['image_width']  = $fdata['image_width'];
                $file_data['image_height'] = $fdata['image_height'];

                $result[] = $file_data;
            }
            return $result;
            # uploading successfull, now do your further actions
        }
    }

    /**
     * @param $where
     * @param $tbl_name
     * @return mixed
     */
    public function check_by($where, $tbl_name)
    {

        $this->db->select('*');
        $this->db->from($tbl_name);
        $this->db->where($where);
        $query_result = $this->db->get();
        $result       = $query_result->row();
        return $result;
    }

    /**
     * @param $table
     * @param null $where
     * @return int
     */
    function count_rows($table, $where = null)
    {
        if (!empty($where)) {
            $this->db->where($where);
        }

        $query = $this->db->get($table);
        if ($query->num_rows() > 0) {
            return $query->num_rows();
        } else {
            return 0;
        }
    }

    /**
     * @param $table
     * @param $where_criteria
     * @param $table_field
     * @return mixed
     */
    function get_any_field($table, $where_criteria, $table_field)
    {
        $query = $this->db->select($table_field)->where($where_criteria)->get($table);
        if ($query->num_rows() > 0) {
            $row = $query->row();
            return $row->$table_field;
        }
    }

    /**
     * @ Upadate row with duplicasi check
     */
    public function check_update($table, $where, $id = Null)
    {
        $this->db->select('*', FALSE);
        $this->db->from($table);
        if ($id != null) {
            $this->db->where($id);
        }
        $this->db->where($where);
        $query_result = $this->db->get();
        $result       = $query_result->result();
        return $result;
    }

    # set actiion setting

    /**
     * @param $where
     * @param $value
     * @param $tbl_name
     */
    public function set_action($where, $value, $tbl_name)
    {
        $this->db->set($value);
        $this->db->where($where);
        $this->db->update($tbl_name);
    }

    /**
     * @param $table
     * @param $field
     * @param $where
     * @return int
     */
    function get_sum($table, $field, $where)
    {

        $this->db->where($where);
        $this->db->select_sum($field);
        $query = $this->db->get($table);
        if ($query->num_rows() > 0) {
            $row = $query->row();
            return $row->$field;
        } else {
            return 0;
        }
    }

    /**
     * @param $where
     * @param $tbl_name
     * @param $limit
     * @return mixed
     */
    public function get_limit($where, $tbl_name, $limit)
    {

        $this->db->select('*');
        $this->db->from($tbl_name);
        $this->db->where($where);
        $this->db->limit($limit);
        $query_result = $this->db->get();
        $result       = $query_result->result();
        return $result;
    }

    /**
     * @param bool $string
     * @param int $from_start
     * @param int $from_end
     * @param bool $limit
     * @return bool|string
     */
    function short_description($string = FALSE, $from_start = 30, $from_end = 10, $limit = FALSE)
    {
        if (!$string) {
            return FALSE;
        }
        if ($limit) {
            if (mb_strlen($string) < $limit) {
                return $string;
            }
        }
        return mb_substr($string, 0, $from_start - 1) . "..." . ($from_end > 0 ? mb_substr($string, -$from_end) : '');
    }

    /**
     * @param $tableName
     * @param array $where
     * @param $field
     * @return mixed
     */
    function get_table_field($tableName, $where = array(), $field)
    {

        return $this->db->select($field)->where($where)->get($tableName)->row()->$field;
    }

    /**
     * @param $from
     * @param $to
     * @return string
     */
    function get_time_different($from, $to)
    {
        $diff    = abs($from - $to);
        $years   = $diff / 31557600;
        $months  = $diff / 2635200;
        $weeks   = $diff / 604800;
        $days    = $diff / 86400;
        $hours   = $diff / 3600;
        $minutes = $diff / 60;
        if ($years > 1) {
            $duration = round($years) . lang('years');
        } elseif ($months > 1) {
            $duration = round($months) . lang('months');
        } elseif ($weeks > 1) {
            $duration = round($weeks) . lang('weeks');
        } elseif ($days > 1) {
            $duration = round($days) . lang('days');
        } elseif ($hours > 1) {
            $duration = round($hours) . lang('hours');
        } else {
            $duration = round($minutes) . lang('minutes');
        }

        return $duration;
    }

    /**
     * @param $client_id
     * @return mixed
     */
    public function client_currency_sambol($client_id)
    {
        $this->db->select('tbl_client.currency', FALSE);
        $this->db->select('tbl_currencies.*', FALSE);
        $this->db->from('tbl_client');
        $this->db->join('tbl_currencies', 'tbl_currencies.code = tbl_client.currency', 'left');
        $this->db->where('tbl_client.client_id', $client_id);
        $query_result = $this->db->get();
        $result       = $query_result->row();
        return $result;
    }

    /**
     * @param $string
     * @return string
     */
    public function hash($string)
    {
        return hash('sha512', $string . config_item('encryption_key'));
    }

    /**
     * @param $params
     */
    function send_email($params)
    {
        # If postmark API is being used
        if (config_item('use_postmark') == 'TRUE') {
            $config = array(
                'api_key' => config_item('postmark_api_key')
            );
            $this->load->library('postmark', $config);
            $this->postmark->from(config_item('postmark_from_address'), config_item('company_name'));
            $this->postmark->to($params['recipient']);
            $this->postmark->subject($params['subject']);
            $this->postmark->message_plain($params['message']);
            $this->postmark->message_html($params['message']);
            # Check resourceed file
            if (isset($params['resourcement_url'])) {
                $this->postmark->resource($params['resourceed_file']);
            }
            $this->postmark->send();
        } else {
            # If using SMTP
            if (config_item('protocol') == 'smtp') {
                $this->load->library('encrypt');
                $raw_smtp_pass = config_item('smtp_pass');
                $config        = array(
                    'smtp_host' => config_item('smtp_host'),
                    'smtp_port' => config_item('smtp_port'),
                    'smtp_user' => config_item('smtp_user'),
                    'smtp_pass' => $raw_smtp_pass,
                    'crlf' => "\r\n",
                    'protocol' => config_item('protocol')
                );
            }
            # Send email
            $config['useragent'] = 'Soon Ticket - Mailer';
            $config['mailtype']  = "html";
            $config['newline']   = "\r\n";
            $config['charset']   = 'utf-8';
            $config['wordwrap']  = TRUE;

            $this->load->library('email', $config);
            $this->email->initialize($config);
            $this->email->from($params['from'], config_item('company_name'));
            $this->email->to($params['recipient']);

            $this->email->subject($params['subject']);
            $this->email->message($params['message']);
            if ($params['resourceed_file'] != '') {
                $this->email->resource($params['resourceed_file']);
            }
            $send = $this->email->send();
            if ($send) {
                return $send;
            } else {
                $error = show_error($this->email->print_debugger());
                return $error;
            }
        }
    }

    /**
     * @param $image
     * @param $route
     * @param string $ext
     * @param null $name
     * @return string
     */
    public function decode_b64_image($image, $route, $ext = '.png', $name=null)
    {
        $image = str_replace('data:image/png;base64,', '', $image);
        $image = str_replace('data:image/jpg;base64,', '', $image);
        $image = str_replace(' ', '+', $image);
        $data = base64_decode($image);

        if (!empty($name)) {
            $file = $name . $ext;
        }
        else
        {
            $file = uniqid() . $ext;
        }

        $file_path = $route . $file;
        file_put_contents($file_path, $data);

        return $file;
    }
}
