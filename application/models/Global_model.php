<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Global_model extends CI_Model {

	/**
     * @param $uriSegment
     * @return array|bool
     */
    public function select_menu_by_uri($uriSegment)
    {
        $this->db->select('menu.*', FALSE);
        $this->db->from('menu');
        $this->db->where('menu_slug', $uriSegment);
        $query_result = $this->db->get();
        $result       = $query_result->row();
        if ($query_result->num_rows > 0) {
            $menuId[] = $result->menu_id;
            $menuId   = $this->select_menu_by_id($result->menu_parent, $menuId);
        } else {

            return false;
        }
        if (!empty($menuId)) {
            $lastId  = end($menuId);
            $parrent = $this->select_menu_first_parent($lastId);
            array_push($menuId, $parrent->menu_parent);
            return $menuId;
        }
    }

    /**
     * @param $id
     * @param $menuId
     * @return mixed
     */
    public function select_menu_by_id($id, $menuId)
    {
        $this->db->select('menu.*', FALSE);
        $this->db->from('menu');
        $this->db->where('menu_id', $id);
        $query_result = $this->db->get();
        $result       = $query_result->row();
        if (count($result)) {
            array_push($menuId, $result->menu_id);
            if ($result->menu_parent != 0) {
                $result = self::select_menu_by_id($result->menu_parent, $menuId);
            }
        }
        return $menuId;
    }

    /**
     * @param $lastId
     * @return mixed
     */
    public function select_menu_first_parent($lastId)
    {
        $this->db->select('menu.*', FALSE);
        $this->db->from('menu');
        $this->db->where('menu_id', $lastId);
        $query_result = $this->db->get();
        $result       = $query_result->row();
        return $result;
    }

}
