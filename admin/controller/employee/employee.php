<?php
class ControllerEmployeeEmployee extends Controller {
	private $error = array();

	public function index() {
		$this->language->load('employee/employee');

		$this->document->setTitle($this->language->get('heading_title'));

		$this->load->model('employee/employee');

		$this->getList();
	}
	
	public function insert() {
		$this->language->load('employee/employee');
	
		$this->document->setTitle($this->language->get('heading_title'));
	
		$this->load->model('employee/employee');
	
		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validateForm()) {
			$this->model_user_user->addUser($this->request->post);
	
			$this->session->data['success'] = $this->language->get('text_success');
	
			$url = '';
	
			if (isset($this->request->get['sort'])) {
				$url .= '&sort=' . $this->request->get['sort'];
			}
	
			if (isset($this->request->get['order'])) {
				$url .= '&order=' . $this->request->get['order'];
			}
	
			if (isset($this->request->get['page'])) {
				$url .= '&page=' . $this->request->get['page'];
			}
	
			$this->redirect($this->url->link('user/user', 'token=' . $this->session->data['token'] . $url, 'SSL'));
		}
	
		$this->getForm();
	}
	
	protected function getList() {
		
		//Default Sort Crieteria
		if (isset($this->request->get['sort'])) {
			$sort = $this->request->get['sort'];
		} else {
			$sort = 'fullname';
		}
	
		//Default ordering crieteria
		if (isset($this->request->get['order'])) {
			$order = $this->request->get['order'];
		} else {
			$order = 'ASC';
		}
	
		//Page no maintained for pagination
		if (isset($this->request->get['page'])) {
			$page = $this->request->get['page'];
		} else {
			$page = 1;
		}
	
		
		$url = '';
	
		if (isset($this->request->get['sort'])) {
			$url .= '&sort=' . $this->request->get['sort'];
		}
	
		if (isset($this->request->get['order'])) {
			$url .= '&order=' . $this->request->get['order'];
		}
	
		if (isset($this->request->get['page'])) {
			$url .= '&page=' . $this->request->get['page'];
		}
		
		//Bread crumb trail Start
		$this->data['breadcrumbs'] = array();
	
		$this->data['breadcrumbs'][] = array(
				'text'      => $this->language->get('text_home'),
				'href'      => $this->url->link('common/home', 'token=' . $this->session->data['token'], 'SSL'),
				'separator' => false
		);
	
		$this->data['breadcrumbs'][] = array(
				'text'      => $this->language->get('heading_title'),
				'href'      => $this->url->link('employee/employee', 'token=' . $this->session->data['token'] . $url, 'SSL'),
				'separator' => ' :: '
		);
		//Bread Crumb End
		$this->data['insert'] = $this->url->link('employee/employee/insert', 'token=' . $this->session->data['token'] . $url, 'SSL');
		$this->data['delete'] = $this->url->link('employee/employee/delete', 'token=' . $this->session->data['token'] . $url, 'SSL');
	
		$this->data['employees'] = array();
	
		$data = array(
				'sort'  => $sort,
				'order' => $order,
				'start' => ($page - 1) * $this->config->get('config_admin_limit'),
				'limit' => $this->config->get('config_admin_limit')
		);
	
		$user_total = $this->model_employee_employee->getTotalEmployees();
	
		$results = $this->model_employee_employee->getEmployees($data);
	
		foreach ($results as $result) {
			$action = array();
	
			$action[] = array(
					'text' => $this->language->get('text_edit'),
					'href' => $this->url->link('employee/employee/update', 'token=' . $this->session->data['token'] . '&emp_id=' . $result['emp_id'] . $url, 'SSL')
			);
	
			$this->data['employees'][] = array(
					'emp_id'    		=> $result['emp_id'],
					'emp_first_name'    => $result['emp_first_name'],
					'emp_middle_name'   => $result['emp_middle_name'],
					'emp_last_name'    	=> $result['emp_last_name'],
					'emp_dob'    		=> $result['emp_dob'],
					'emp_gender'   		=> $result['emp_gender'],
					'emp_email'   		=> $result['emp_email'],
					'emp_mob1'   		=> $result['emp_mob1'],
					'emp_mob2'   		=> $result['emp_mob2'],
					'emp_land_phn'   	=> $result['emp_land_phn'],
					'emp_dateofjoining' => $result['emp_dateofjoining'],
					'emp_designation'   => $result['emp_designation'],
					'emp_passport'   	=> $result['emp_passport'],
					'emp_nationality'   => $result['emp_nationality'],
					'emp_address'   	=> $result['emp_address'],
					'emp_image_url'   	=> $result['emp_image_url'],
					'date_added'   		=> $result['date_added'],
					'selected'   		=> isset($this->request->post['selected']) && in_array($result['emp_id'], $this->request->post['selected']),
					'action'     		=> $action
			);
		}
	
		$this->data['heading_title'] = $this->language->get('heading_title');
	
		$this->data['text_no_results'] = $this->language->get('text_no_results');
	
		$this->data['column_name'] = $this->language->get('column_name');
		$this->data['column_dateofbirth'] = $this->language->get('column_dateofbirth');
		$this->data['column_gender'] = $this->language->get('column_gender');
		$this->data['optvalue_gender_male'] = $this->language->get('optvalue_gender_male');
		$this->data['optvalue_gender_female'] = $this->language->get('optvalue_gender_female');
		$this->data['column_email'] = $this->language->get('column_email');
		$this->data['column_mobile1'] = $this->language->get('column_mobile1');
		$this->data['column_mobile2'] = $this->language->get('column_mobile2');
		$this->data['column_land_phone'] = $this->language->get('column_land_phone');
		$this->data['column_dateofjoining'] = $this->language->get('column_dateofjoining');
		$this->data['column_designation'] = $this->language->get('column_designation');
		$this->data['column_passport'] = $this->language->get('column_passport');
		$this->data['column_nationality'] = $this->language->get('column_nationality');
		$this->data['column_address'] = $this->language->get('column_address');
		$this->data['column_image'] = $this->language->get('column_image');
		$this->data['column_dateofentry'] = $this->language->get('column_dateofentry');
		$this->data['column_action'] = $this->language->get('column_action');
	
		$this->data['button_insert'] = $this->language->get('button_insert');
		$this->data['button_delete'] = $this->language->get('button_delete');
	
		if (isset($this->error['warning'])) {
			$this->data['error_warning'] = $this->error['warning'];
		} else {
			$this->data['error_warning'] = '';
		}
	
		if (isset($this->session->data['success'])) {
			$this->data['success'] = $this->session->data['success'];
	
			unset($this->session->data['success']);
		} else {
			$this->data['success'] = '';
		}
	
		$url = '';
	
		if ($order == 'ASC') {
			$url .= '&order=DESC';
		} else {
			$url .= '&order=ASC';
		}
	
		if (isset($this->request->get['page'])) {
			$url .= '&page=' . $this->request->get['page'];
		}
	
		$this->data['sort_name'] = $this->url->link('employee/employee', 'token=' . $this->session->data['token'] . '&sort=fullname' . $url, 'SSL');
		$this->data['sort_dob'] = $this->url->link('employee/employee', 'token=' . $this->session->data['token'] . '&sort=emp_dob' . $url, 'SSL');
		$this->data['sort_gender'] = $this->url->link('employee/employee', 'token=' . $this->session->data['token'] . '&sort=emp_gender' . $url, 'SSL');
		$this->data['sort_doj'] = $this->url->link('employee/employee', 'token=' . $this->session->data['token'] . '&sort=emp_dateofjoining' . $url, 'SSL');
		$this->data['sort_designation'] = $this->url->link('employee/employee', 'token=' . $this->session->data['token'] . '&sort=emp_designation' . $url, 'SSL');
	
		$url = '';
	
		if (isset($this->request->get['sort'])) {
			$url .= '&sort=' . $this->request->get['sort'];
		}
	
		if (isset($this->request->get['order'])) {
			$url .= '&order=' . $this->request->get['order'];
		}
	
		$pagination = new Pagination();
		$pagination->total = $user_total;
		$pagination->page = $page;
		$pagination->limit = $this->config->get('config_admin_limit');
		$pagination->text = $this->language->get('text_pagination');
		$pagination->url = $this->url->link('employee/employee', 'token=' . $this->session->data['token'] . $url . '&page={page}', 'SSL');
	
		$this->data['pagination'] = $pagination->render();
	
		$this->data['sort'] = $sort;
		$this->data['order'] = $order;
	
		$this->template = 'employee/employee_list.tpl';
		$this->children = array(
				'common/header',
				'common/footer'
		);
	
		$this->response->setOutput($this->render());
	}
	protected function getForm() {
		$this->data['heading_title'] = $this->language->get('heading_title');
	
		$this->data['entry_firstname'] = $this->language->get('entry_firstname');
		$this->data['entry_middlename'] = $this->language->get('entry_middlename');
		$this->data['entry_lastname'] = $this->language->get('entry_lastname');
		$this->data['entry_dateofbirth'] = $this->language->get('entry_dateofbirth');
		$this->data['entry_gender'] = $this->language->get('entry_gender');
		$this->data['entry_email'] = $this->language->get('entry_email');
		$this->data['entry_mobile1'] = $this->language->get('entry_mobile1');
		$this->data['entry_mobile2'] = $this->language->get('entry_mobile2');
		$this->data['entry_landphone'] = $this->language->get('entry_landphone');
		$this->data['entry_dateofjoining'] = $this->language->get('entry_dateofjoining');
		$this->data['entry_designation'] = $this->language->get('entry_designation');
		$this->data['entry_passport'] = $this->language->get('entry_passport');
		$this->data['entry_nationality'] = $this->language->get('entry_nationality');
		$this->data['entry_address'] = $this->language->get('entry_address');
		
		$this->data['button_save'] = $this->language->get('button_save');
		$this->data['button_cancel'] = $this->language->get('button_cancel');
	
		if (isset($this->error['warning'])) {
			$this->data['error_warning'] = $this->error['warning'];
		} else {
			$this->data['error_warning'] = '';
		}
	
		if (isset($this->error['username'])) {
			$this->data['error_username'] = $this->error['username'];
		} else {
			$this->data['error_username'] = '';
		}
	
		if (isset($this->error['password'])) {
			$this->data['error_password'] = $this->error['password'];
		} else {
			$this->data['error_password'] = '';
		}
	
		if (isset($this->error['confirm'])) {
			$this->data['error_confirm'] = $this->error['confirm'];
		} else {
			$this->data['error_confirm'] = '';
		}
	
		if (isset($this->error['firstname'])) {
			$this->data['error_firstname'] = $this->error['firstname'];
		} else {
			$this->data['error_firstname'] = '';
		}
	
		if (isset($this->error['lastname'])) {
			$this->data['error_lastname'] = $this->error['lastname'];
		} else {
			$this->data['error_lastname'] = '';
		}
	
		$url = '';
	
		if (isset($this->request->get['sort'])) {
			$url .= '&sort=' . $this->request->get['sort'];
		}
	
		if (isset($this->request->get['order'])) {
			$url .= '&order=' . $this->request->get['order'];
		}
	
		if (isset($this->request->get['page'])) {
			$url .= '&page=' . $this->request->get['page'];
		}
	
		$this->data['breadcrumbs'] = array();
	
		$this->data['breadcrumbs'][] = array(
				'text'      => $this->language->get('text_home'),
				'href'      => $this->url->link('common/home', 'token=' . $this->session->data['token'], 'SSL'),
				'separator' => false
		);
	
		$this->data['breadcrumbs'][] = array(
				'text'      => $this->language->get('heading_title'),
				'href'      => $this->url->link('user/user', 'token=' . $this->session->data['token'] . $url, 'SSL'),
				'separator' => ' :: '
		);
	
		if (!isset($this->request->get['user_id'])) {
			$this->data['action'] = $this->url->link('user/user/insert', 'token=' . $this->session->data['token'] . $url, 'SSL');
		} else {
			$this->data['action'] = $this->url->link('user/user/update', 'token=' . $this->session->data['token'] . '&user_id=' . $this->request->get['user_id'] . $url, 'SSL');
		}
	
		$this->data['cancel'] = $this->url->link('user/user', 'token=' . $this->session->data['token'] . $url, 'SSL');
	
		if (isset($this->request->get['user_id']) && ($this->request->server['REQUEST_METHOD'] != 'POST')) {
			$user_info = $this->model_user_user->getUser($this->request->get['user_id']);
		}
	
		if (isset($this->request->post['username'])) {
			$this->data['username'] = $this->request->post['username'];
		} elseif (!empty($user_info)) {
			$this->data['username'] = $user_info['username'];
		} else {
			$this->data['username'] = '';
		}
	
		if (isset($this->request->post['password'])) {
			$this->data['password'] = $this->request->post['password'];
		} else {
			$this->data['password'] = '';
		}
	
		if (isset($this->request->post['confirm'])) {
			$this->data['confirm'] = $this->request->post['confirm'];
		} else {
			$this->data['confirm'] = '';
		}
	
		if (isset($this->request->post['firstname'])) {
			$this->data['firstname'] = $this->request->post['firstname'];
		} elseif (!empty($user_info)) {
			$this->data['firstname'] = $user_info['firstname'];
		} else {
			$this->data['firstname'] = '';
		}
	
		if (isset($this->request->post['lastname'])) {
			$this->data['lastname'] = $this->request->post['lastname'];
		} elseif (!empty($user_info)) {
			$this->data['lastname'] = $user_info['lastname'];
		} else {
			$this->data['lastname'] = '';
		}
	
		if (isset($this->request->post['email'])) {
			$this->data['email'] = $this->request->post['email'];
		} elseif (!empty($user_info)) {
			$this->data['email'] = $user_info['email'];
		} else {
			$this->data['email'] = '';
		}
	
		if (isset($this->request->post['user_group_id'])) {
			$this->data['user_group_id'] = $this->request->post['user_group_id'];
		} elseif (!empty($user_info)) {
			$this->data['user_group_id'] = $user_info['user_group_id'];
		} else {
			$this->data['user_group_id'] = '';
		}
	
		$this->load->model('user/user_group');
	
		$this->data['user_groups'] = $this->model_user_user_group->getUserGroups();
	
		if (isset($this->request->post['status'])) {
			$this->data['status'] = $this->request->post['status'];
		} elseif (!empty($user_info)) {
			$this->data['status'] = $user_info['status'];
		} else {
			$this->data['status'] = 0;
		}
	
		$this->template = 'user/user_form.tpl';
		$this->children = array(
				'common/header',
				'common/footer'
		);
	
		$this->response->setOutput($this->render());
	}
	
	protected function validateForm() {
		if (!$this->user->hasPermission('modify', 'user/user')) {
			$this->error['warning'] = $this->language->get('error_permission');
		}
	
		if ((utf8_strlen($this->request->post['username']) < 3) || (utf8_strlen($this->request->post['username']) > 20)) {
			$this->error['username'] = $this->language->get('error_username');
		}
	
		$user_info = $this->model_user_user->getUserByUsername($this->request->post['username']);
	
		if (!isset($this->request->get['user_id'])) {
			if ($user_info) {
				$this->error['warning'] = $this->language->get('error_exists');
			}
		} else {
			if ($user_info && ($this->request->get['user_id'] != $user_info['user_id'])) {
				$this->error['warning'] = $this->language->get('error_exists');
			}
		}
	
		if ((utf8_strlen($this->request->post['firstname']) < 1) || (utf8_strlen($this->request->post['firstname']) > 32)) {
			$this->error['firstname'] = $this->language->get('error_firstname');
		}
	
		if ((utf8_strlen($this->request->post['lastname']) < 1) || (utf8_strlen($this->request->post['lastname']) > 32)) {
			$this->error['lastname'] = $this->language->get('error_lastname');
		}
	
		if ($this->request->post['password'] || (!isset($this->request->get['user_id']))) {
			if ((utf8_strlen($this->request->post['password']) < 4) || (utf8_strlen($this->request->post['password']) > 20)) {
				$this->error['password'] = $this->language->get('error_password');
			}
	
			if ($this->request->post['password'] != $this->request->post['confirm']) {
				$this->error['confirm'] = $this->language->get('error_confirm');
			}
		}
	
		if (!$this->error) {
			return true;
		} else {
			return false;
		}
	}
	
} 
?>