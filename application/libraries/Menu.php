<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Menu
{
	private $table = 'menus';

	public function render_menu()
	{
		$CI =& get_instance();

		$CI->db->select('*');
		$CI->db->from($this->table);
        $CI->db->order_by('sort');
        $CI->db->where('rol', $CI->session->userdata('rol'));
        // $CI->db->where('rol_school' , $CI->data_user->school_access_role_id);
        $query = $CI->db->get();

        $items_menu = $query->result_array();

        $menu = [
            'items' => array(),
            'parents' => array(),
        ];

        foreach ($items_menu as $items) {
        	$menu['items'][$items['id']] = $items;
        	// $menu['items'][1]

        	$menu['parents'][$items['parent']][] = $items['id'];
        	// $menu['items'][1]
        }

        return $this->buildMenu(0, $menu);
	}

	public function buildMenu($parent, $menu, $submenu = NULL)
	{
		$html = "";
		if (isset($menu['parents'][$parent])) {
			if (!empty($submenu)) {
				$html.= '';
			}

			foreach ($menu['parents'][$parent] as $itemId) {
				$is_active = $this->active_menu_id($menu['items'][$itemId]['id']);

				if ($is_active) {
					$active = 'true';
					$active_2 = 'highlighted';
				}else{
					$active = 'false';
					$active_2 = '';
				}

				if (!isset($menu['parents'][$itemId])) { //show whit parent
					switch ($menu['items'][$itemId]['type']) {
						case 'title':
							// $html .= '<label class="sidebar-label pd-x-10 mg-t-20 op-3">' . $menu['items'][$itemId]['name'] . '</label>';
							break;
						case 'divider':
							$html .= '<v-divider></v-divider>';
							break;
						case 'link':
							$html .= '<v-skeleton-loader type="list-item" :loading="skeletonLoading" transition="slide-x-transition">';
								$html .= '<v-list-item href="' . base_url($menu['items'][$itemId]['slug']) .'">';
									$html .= '<v-list-item-action>';
										$html .= '<v-icon class="'.$active_2.'">'.$menu['items'][$itemId]['ico'].'</v-icon>';
									$html .= '</v-list-item-action>';
									$html .= '<v-list-item-title class="'.$active_2.'">' . $menu['items'][$itemId]['name'] . '</v-list-item-title>';
								$html .= '</v-list-item>';
							$html .= '</v-skeleton-loader>';
							// $html .= '<li class="'. (($parent) ? 'sub-item' : 'br-menu-item') . '">';
						      //$html .= '<a href="' . base_url($menu['items'][$itemId]['slug']) . '" class="' . $active . ' ' . (($parent) ? 'sub-link' : 'br-menu-link') . '">';
						        //$html .= (!empty($menu['items'][$itemId]['ico']) ? '<i class="material-icons md-24">' . $menu['items'][$itemId]['ico'] . '</i>' : '');
						        //$html .= '<span class="menu-item-label">' . $menu['items'][$itemId]['name'] . '</span>';
						      //$html .= '</a>';
						    //$html .= '</li>';

							break;
					}
				}

				if (isset($menu['parents'][$itemId])) { //show whit submenu
					switch ($menu['items'][$itemId]['type']) {
						case 'title':
							$html .= '<label class="sidebar-label pd-x-10 mg-t-20 op-3">' . $menu['items'][$itemId]['name'] . '</label>';
							break;
						case 'divider':
							$html .= '<li class="nav-divider">' . $menu['items'][$itemId]['name'] . '</li>';
							break;
						case 'link':

							$html .= '<v-skeleton-loader width="70%" type="list-item" :loading="skeletonLoading" transition="slide-x-reverse-transition">';
								$html .= '<v-list-group prepend-icon="'. $menu['items'][$itemId]['ico'] .'" :value="'. $active .'">';
									$html .= '<template v-slot:activator>';
										$html .= '<v-list-item-title>' . $menu['items'][$itemId]['name'] . '</v-list-item-title>';
									$html .= '</template>';
						    			$html .= self::buildMenu($itemId, $menu, true);
							$html .= '</v-skeleton-loader>';


							// $html .= '<li class="br-menu-item">';
						 //      $html .= '<a href="' . base_url($menu['items'][$itemId]['slug']) . '" class="' . $active . ' br-menu-link with-sub">';
						 //        $html .= (!empty($menu['items'][$itemId]['ico']) ? '<i class="material-icons md-24">' . $menu['items'][$itemId]['ico'] . '</i>' : '');
						 //        $html .= '<span class="menu-item-label">' . $menu['items'][$itemId]['name'] . '</span>';
						 //      $html .= '</a>';
						    // $html .= '</li>';

							break;
					}
				}
			}
		}
		$html .= "";
		return $html;
	}

	public function active_menu_id($id)
	{
		$CI = & get_instance();
		$activeId = $CI->session->userdata('menu_active_id');

		if (!empty($activeId)) {
			foreach ($activeId as $v_id) {
				if ($id == $v_id) {
					return TRUE;
				}
			}
		}

		return FALSE;
	}
}
