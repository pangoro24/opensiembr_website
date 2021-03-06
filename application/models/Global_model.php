<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Global_model extends CI_Model {

	/**
     * @param $uriSegment
     * @return array|bool
     */
    public function select_menu_by_uri($uriSegment)
    {
        $this->db->select('menus.*', FALSE);
        $this->db->from('menus');
        $this->db->where('slug', $uriSegment);
        $query_result = $this->db->get();
        $result       = $query_result->row();
        if ($result) {
            $menuId[] = $result->id;
            $menuId   = $this->select_menu_by_id($result->parent, $menuId);
        } else {

            return false;
        }
        if (!empty($menuId)) {
            $lastId  = end($menuId);
            $parrent = $this->select_menu_first_parent($lastId);
            array_push($menuId, $parrent->parent);
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
        $this->db->select('menus.*', FALSE);
        $this->db->from('menus');
        $this->db->where('id', $id);
        $query_result = $this->db->get();
        $result       = $query_result->row();
        if ($result) {
            array_push($menuId, $result->id);
            if ($result->parent != 0) {
                $result = self::select_menu_by_id($result->parent, $menuId);
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
        $this->db->select('menus.*', FALSE);
        $this->db->from('menus');
        $this->db->where('id', $lastId);
        $query_result = $this->db->get();
        $result       = $query_result->row();
        return $result;
    }

}
