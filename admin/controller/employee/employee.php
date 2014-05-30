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
			
			$this->model_employee_employee->addEmployee($this->request->post);
	
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
	
			$this->redirect($this->url->link('employee/employee', 'token=' . $this->session->data['token'] . $url, 'SSL'));
		}
	
		$this->getForm();
	}
	
	public function delete() {
		$this->language->load('employee/employee');
	
		$this->document->setTitle($this->language->get('heading_title'));
	
		$this->load->model('employee/employee');
	
		if (isset($this->request->post['selected']) && $this->validateDelete()) {
			foreach ($this->request->post['selected'] as $emp_id) {
				$this->model_employee_employee->deleteEmployee($emp_id);
			}
	
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
	
			$this->redirect($this->url->link('employee/employee', 'token=' . $this->session->data['token'] . $url, 'SSL'));
		}
	
		$this->getList();
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

		$this->data['optvalue_gender_male'] = $this->language->get("optvalue_gender_male");
		$this->data['optvalue_gender_female'] = $this->language->get("optvalue_gender_female");
		
		$this->data['button_save'] = $this->language->get('button_save');
		$this->data['button_cancel'] = $this->language->get('button_cancel');
	
		if (isset($this->error['warning'])) {
			$this->data['error_warning'] = $this->error['warning'];
		} else {
			$this->data['error_warning'] = '';
		}
	
		if (isset($this->error['emp_first_name'])) {
			$this->data['error_emp_first_name'] = $this->error['emp_first_name'];
		} else {
			$this->data['error_emp_first_name'] = '';
		}
	
		if (isset($this->error['emp_last_name'])) {
			$this->data['error_emp_last_name'] = $this->error['emp_last_name'];
		} else {
			$this->data['error_emp_last_name'] = '';
		}

		if (isset($this->error['emp_dob'])) {
			$this->data['error_emp_dob'] = $this->error['emp_dob'];
		} else {
			$this->data['error_emp_dob'] = '';
		}
	
		if (isset($this->error['emp_email'])) {
			$this->data['error_emp_email'] = $this->error['emp_email'];
		} else {
			$this->data['error_emp_email'] = '';
		}
				
		if (isset($this->error['emp_mob1'])) {
			$this->data['error_emp_mob1'] = $this->error['emp_mob1'];
		} else {
			$this->data['error_emp_mob1'] = '';
		}
		
		if (isset($this->error['emp_dateofjoining'])) {
			$this->data['error_emp_dateofjoining'] = $this->error['emp_dateofjoining'];
		} else {
			$this->data['error_emp_dateofjoining'] = '';
		}
		
		if (isset($this->error['emp_address'])) {
			$this->data['error_emp_address'] = $this->error['emp_address'];
		} else {
			$this->data['error_emp_address'] = '';
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
				'href'      => $this->url->link('employee/employee', 'token=' . $this->session->data['token'] . $url, 'SSL'),
				'separator' => ' :: '
		);
	
		if (!isset($this->request->get['emp_id'])) {
			$this->data['action'] = $this->url->link('employee/employee/insert', 'token=' . $this->session->data['token'] . $url, 'SSL');
		} else {
			$this->data['action'] = $this->url->link('employee/employee/update', 'token=' . $this->session->data['token'] . '&emp_id=' . $this->request->get['emp_id'] . $url, 'SSL');
		}
	
		$this->data['cancel'] = $this->url->link('employee/employee', 'token=' . $this->session->data['token'] . $url, 'SSL');
	
		if (isset($this->request->get['emp_id']) && ($this->request->server['REQUEST_METHOD'] != 'POST')) {
			$employee_info = $this->model_employee_employee->getEmployee($this->request->get['emp_id']);
		}
	
		if (isset($this->request->post['emp_first_name'])) {
			$this->data['emp_first_name'] = $this->request->post['emp_first_name'];
		} elseif (!empty($employee_info)) {
			$this->data['emp_first_name'] = $employee_info['emp_first_name'];
		} else {
			$this->data['emp_first_name'] = '';
		}
		
		if (isset($this->request->post['emp_middle_name'])) {
			$this->data['emp_middle_name'] = $this->request->post['emp_middle_name'];
		} elseif (!empty($employee_info)) {
			$this->data['emp_middle_name'] = $employee_info['emp_middle_name'];
		} else {
			$this->data['emp_middle_name'] = '';
		}
		
		if (isset($this->request->post['emp_last_name'])) {
			$this->data['emp_last_name'] = $this->request->post['emp_last_name'];
		} elseif (!empty($employee_info)) {
			$this->data['emp_last_name'] = $employee_info['emp_last_name'];
		} else {
			$this->data['emp_last_name'] = '';
		}
		
		if (isset($this->request->post['emp_dob'])) {
			$this->data['emp_dob'] = $this->request->post['emp_dob'];
		} elseif (!empty($employee_info)) {
			$this->data['emp_dob'] = $employee_info['emp_dob'];
		} else {
			$this->data['emp_dob'] = '';
		}
		
		if (isset($this->request->post['emp_gender'])) {
			$this->data['emp_gender'] = $this->request->post['emp_gender'];
		} elseif (!empty($employee_info)) {
			$this->data['emp_gender'] = $employee_info['emp_gender'];
		} else {
			$this->data['emp_gender'] = '';
		}
		
		if (isset($this->request->post['emp_email'])) {
			$this->data['emp_email'] = $this->request->post['emp_email'];
		} elseif (!empty($employee_info)) {
			$this->data['emp_email'] = $employee_info['emp_email'];
		} else {
			$this->data['emp_email'] = '';
		}
		
		if (isset($this->request->post['emp_mob1'])) {
			$this->data['emp_mob1'] = $this->request->post['emp_mob1'];
		} elseif (!empty($employee_info)) {
			$this->data['emp_mob1'] = $employee_info['emp_mob1'];
		} else {
			$this->data['emp_mob1'] = '';
		}
		
		if (isset($this->request->post['emp_mob2'])) {
			$this->data['emp_mob2'] = $this->request->post['emp_mob2'];
		} elseif (!empty($employee_info)) {
			$this->data['emp_mob2'] = $employee_info['emp_mob2'];
		} else {
			$this->data['emp_mob2'] = '';
		}
		
		if (isset($this->request->post['emp_land_phn'])) {
			$this->data['emp_land_phn'] = $this->request->post['emp_land_phn'];
		} elseif (!empty($employee_info)) {
			$this->data['emp_land_phn'] = $employee_info['emp_land_phn'];
		} else {
			$this->data['emp_land_phn'] = '';
		}
		
		if (isset($this->request->post['emp_dateofjoining'])) {
			$this->data['emp_dateofjoining'] = $this->request->post['emp_dateofjoining'];
		} elseif (!empty($employee_info)) {
			$this->data['emp_dateofjoining'] = $employee_info['emp_dateofjoining'];
		} else {
			$this->data['emp_dateofjoining'] = '';
		}
		
		if (isset($this->request->post['emp_designation'])) {
			$this->data['emp_designation'] = $this->request->post['emp_designation'];
		} elseif (!empty($employee_info)) {
			$this->data['emp_designation'] = $employee_info['emp_designation'];
		} else {
			$this->data['emp_designation'] = '';
		}
		
		if (isset($this->request->post['emp_passport'])) {
			$this->data['emp_passport'] = $this->request->post['emp_passport'];
		} elseif (!empty($employee_info)) {
			$this->data['emp_passport'] = $employee_info['emp_passport'];
		} else {
			$this->data['emp_passport'] = '';
		}
		
		if (isset($this->request->post['emp_nationality'])) {
			$this->data['emp_nationality'] = $this->request->post['emp_nationality'];
		} elseif (!empty($employee_info)) {
			$this->data['emp_nationality'] = $employee_info['emp_nationality'];
		} else {
			$this->data['emp_nationality'] = '';
		}
		
		if (isset($this->request->post['emp_address'])) {
			$this->data['emp_address'] = $this->request->post['emp_address'];
		} elseif (!empty($employee_info)) {
			$this->data['emp_address'] = $employee_info['emp_address'];
		} else {
			$this->data['emp_address'] = '';
		}
		
		if (isset($this->request->post['emp_image_url'])) {
			$this->data['emp_image_url'] = $this->request->post['emp_image_url'];
		} elseif (!empty($employee_info)) {
			$this->data['emp_image_url'] = $employee_info['emp_image_url'];
		} else {
			$this->data['emp_image_url'] = '';
		}
		
		

		$this->template = 'employee/employee_form.tpl';
		$this->children = array(
				'common/header',
				'common/footer'
		);
	
		$this->response->setOutput($this->render());
	}
	
	protected function validateForm() {
		if (!$this->user->hasPermission('modify', 'employee/employee')) {
			$this->error['warning'] = $this->language->get('error_permission');
		}
	
		if ((utf8_strlen($this->request->post['emp_first_name']) < 3) || (utf8_strlen($this->request->post['emp_first_name']) > 20)) {
			$this->error['emp_first_name'] = $this->language->get('error_emp_first_name');
		}

		if ((utf8_strlen($this->request->post['emp_last_name']) < 1) || (utf8_strlen($this->request->post['emp_last_name']) > 20)) {
			$this->error['emp_last_name'] = $this->language->get('error_emp_last_name');
		}
		
		$employee_info = $this->model_employee_employee->getEmployeeByEmailid($this->request->post['emp_email']);
	
		if (isset($this->request->post['emp_email'])) {
			if ($employee_info) {
				$this->error['warning'] = $this->language->get('error_exists');
			}
			else
			{
				if ((utf8_strlen($this->request->post['emp_email']) < 6) || !filter_var($this->request->post['emp_email'], FILTER_VALIDATE_EMAIL)) {
					$this->error['emp_email'] = $this->language->get('error_emp_email');
				}
			}
		}
	
		if ((utf8_strlen($this->request->post['emp_dob']) == 0)) {
			$this->error['emp_dob'] = $this->language->get('error_emp_dob');
		}
		
		if ((utf8_strlen($this->request->post['emp_mob1']) < 10) || (utf8_strlen($this->request->post['emp_mob1']) > 13)) {
			$this->error['emp_mob1'] = $this->language->get('error_emp_mob1');
		}
		
		if ((utf8_strlen($this->request->post['emp_dateofjoining']) == 0)) {
			$this->error['emp_dateofjoining'] = $this->language->get('error_emp_dateofjoining');
		}
		
		if ((utf8_strlen($this->request->post['emp_address']) < 5) || (utf8_strlen($this->request->post['emp_address']) > 100)) {
			$this->error['emp_address'] = $this->language->get('error_emp_address');
		}
		
		
		if (!$this->error) {
			return true;
		} else {
			return false;
		}
	}
	
	protected function validateDelete() {
		if (!$this->user->hasPermission('modify', 'employee/employee')) {
			$this->error['warning'] = $this->language->get('error_permission');
		}
	
		if (!$this->error) {
			return true;
		} else {
			return false;
		}
	}
	
} 
?>