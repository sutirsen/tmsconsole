<?php
class ControllerTrainingTraining extends Controller {
	private $error = array();

	public function index() {
		$this->language->load('training/training');

		$this->document->setTitle($this->language->get('heading_title'));

		$this->load->model('training/training');

		$this->getList();
	}
	
	public function insert() {
		$this->language->load('training/training');
	
		$this->document->setTitle($this->language->get('heading_title'));
	
		$this->load->model('training/training');
	
		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validateForm()) {
			$this->model_training_training->addTraining($this->request->post);
	
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
	
			$this->redirect($this->url->link('training/training', 'token=' . $this->session->data['token'] . $url, 'SSL'));
		}
	
		$this->getForm();
	}
	
	public function update() {
		$this->language->load('training/training');

		$this->document->setTitle($this->language->get('heading_title'));

		$this->load->model('training/training');

		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validateForm()) {
			$this->model_training_training->editTraining($this->request->get['trng_code'], $this->request->post);

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

			$this->redirect($this->url->link('training/training', 'token=' . $this->session->data['token'] . $url, 'SSL'));
		}

		$this->getForm();
	}

	public function delete() {
		$this->language->load('training/training');

		$this->document->setTitle($this->language->get('heading_title'));

		$this->load->model('training/training');

		if (isset($this->request->post['selected']) && $this->validateDelete()) {
			foreach ($this->request->post['selected'] as $trng_code) {
				$this->model_training_training->deleteTraining($trng_code);
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

			$this->redirect($this->url->link('training/training', 'token=' . $this->session->data['token'] . $url, 'SSL'));
		}

		$this->getList();
	}
	
	protected function getList() {
		
		//Default Sort Crieteria
		if (isset($this->request->get['sort'])) {
			$sort = $this->request->get['sort'];
		} else {
			$sort = 'createdon';
		}
	
		//Default ordering crieteria
		if (isset($this->request->get['order'])) {
			$order = $this->request->get['order'];
		} else {
			$order = 'DESC';
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
				'href'      => $this->url->link('training/training', 'token=' . $this->session->data['token'] . $url, 'SSL'),
				'separator' => ' :: '
		);
		//Bread Crumb End
		$this->data['insert'] = $this->url->link('training/training/insert', 'token=' . $this->session->data['token'] . $url, 'SSL');
		$this->data['delete'] = $this->url->link('training/training/delete', 'token=' . $this->session->data['token'] . $url, 'SSL');
	
		$this->data['trainings'] = array();
	
		$data = array(
				'sort'  => $sort,
				'order' => $order,
				'start' => ($page - 1) * $this->config->get('config_admin_limit'),
				'limit' => $this->config->get('config_admin_limit')
		);
	
		$user_total = $this->model_training_training->getTotalTrainings();
	
		$results = $this->model_training_training->getTrainings($data);
		
		foreach ($results as $result) {
			$action = array();
	
			$action[] = array(
					'text' => $this->language->get('text_edit'),
					'href' => $this->url->link('training/training/update', 'token=' . $this->session->data['token'] . '&id=' . $result['id'] . $url, 'SSL')
			);
	
			$this->data['trainings'][] = array(
					'id'    					=> $result['id'],
					'training_title'    		=> $result['training_title'],
					'training_description'    	=> $result['training_description'],
					'training_type'   			=> $result['training_type'],
					'training_time'    			=> $result['training_time'],
					'training_duration'    		=> $result['training_duration'],
					'training_location'     	=> $result['training_location'],
					'training_cost'     		=> $result['training_cost'],
					'training_instructor'     	=> $result['training_instructor'],
					'createdon'     			=> $result['createdon'],
					'selected'   				=> isset($this->request->post['selected']) && in_array($result['id'], $this->request->post['selected']),
					'action'     				=> $action
			);
		}
	
		$this->data['heading_title'] = $this->language->get('heading_title');
	
		$this->data['text_no_results'] = $this->language->get('text_no_results');
	
		$this->data['text_column_training_title'] 		= $this->language->get('text_column_training_title');
		$this->data['text_column_training_type'] 		= $this->language->get('text_column_training_type');
		$this->data['text_column_training_time'] 		= $this->language->get('text_column_training_time');
		$this->data['text_column_training_duration'] 	= $this->language->get('text_column_training_duration');
		$this->data['text_column_training_location'] 	= $this->language->get('text_column_training_location');
		$this->data['text_column_training_cost'] 		= $this->language->get('text_column_training_cost');
		$this->data['text_column_training_instructor'] 	= $this->language->get('text_column_training_instructor');
		$this->data['text_column_createdon'] 			= $this->language->get('text_column_createdon');
		$this->data['text_column_action'] 				= $this->language->get('text_column_action');
		
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
	
		$this->data['sort_training_title'] 		= $this->url->link('training/training', 'token=' . $this->session->data['token'] . '&sort=training_title' . $url, 'SSL');
		$this->data['sort_training_type'] 		= $this->url->link('training/training', 'token=' . $this->session->data['token'] . '&sort=training_type' . $url, 'SSL');
		$this->data['sort_training_time'] 		= $this->url->link('training/training', 'token=' . $this->session->data['token'] . '&sort=training_time' . $url, 'SSL');
		$this->data['sort_training_location'] 	= $this->url->link('training/training', 'token=' . $this->session->data['token'] . '&sort=training_location' . $url, 'SSL');
		$this->data['sort_training_duration'] 	= $this->url->link('training/training', 'token=' . $this->session->data['token'] . '&sort=training_duration' . $url, 'SSL');
		$this->data['sort_training_cost'] 		= $this->url->link('training/training', 'token=' . $this->session->data['token'] . '&sort=training_cost' . $url, 'SSL');
		$this->data['sort_training_instructor'] = $this->url->link('training/training', 'token=' . $this->session->data['token'] . '&sort=training_instructor' . $url, 'SSL');
		$this->data['sort_createdon'] 			= $this->url->link('training/training', 'token=' . $this->session->data['token'] . '&sort=createdon' . $url, 'SSL');
			
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
		$pagination->url = $this->url->link('training/training', 'token=' . $this->session->data['token'] . $url . '&page={page}', 'SSL');
	
		$this->data['pagination'] = $pagination->render();
	
		$this->data['sort'] = $sort;
		$this->data['order'] = $order;
	
		$this->template = 'training/training_list.tpl';
		$this->children = array(
				'common/header',
				'common/footer'
		);
	
		$this->response->setOutput($this->render());
	}
	protected function getForm() {
		$this->data['heading_title'] = $this->language->get('heading_title');
		$this->data['entry_code'] = $this->language->get('entry_code');
		$this->data['entry_name'] = $this->language->get('entry_name');
		$this->data['entry_type'] = $this->language->get('entry_type');
		$this->data['entry_date'] = $this->language->get('entry_date');
		$this->data['entry_duration'] = $this->language->get('entry_duration');
		$this->data['entry_location'] = $this->language->get('entry_location');
		
		$this->data['button_save'] = $this->language->get('button_save');
		$this->data['button_cancel'] = $this->language->get('button_cancel');
	
		if (isset($this->error['warning'])) {
			$this->data['error_warning'] = $this->error['warning'];
		} else {
			$this->data['error_warning'] = '';
		}
		if (isset($this->error['code'])) {
			$this->data['error_code'] = $this->error['code'];
		} else {
			$this->data['error_code'] = '';
		}
	
		if (isset($this->error['date'])) {
			$this->data['error_date'] = $this->error['date'];
		} else {
			$this->data['error_date'] = '';
		}
	
		if (isset($this->error['duration'])) {
			$this->data['error_duration'] = $this->error['duration'];
		} else {
			$this->data['error_duration'] = '';
		}
	
		if (isset($this->error['location'])) {
			$this->data['error_location'] = $this->error['location'];
		} else {
			$this->data['error_location'] = '';
		}
	
		if (isset($this->error['name'])) {
			$this->data['error_name'] = $this->error['name'];
		} else {
			$this->data['error_name'] = '';
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
				'href'      => $this->url->link('training/training', 'token=' . $this->session->data['token'] . $url, 'SSL'),
				'separator' => ' :: '
		);
	
		if (!isset($this->request->get['trng_code'])) {
			$this->data['action'] = $this->url->link('training/training/insert', 'token=' . $this->session->data['token'] . $url, 'SSL');
		} else {
			$this->data['action'] = $this->url->link('training/training/update', 'token=' . $this->session->data['token'] . '&trng_code=' . $this->request->get['trng_code'] . $url, 'SSL');
		}
	
		$this->data['cancel'] = $this->url->link('training/training', 'token=' . $this->session->data['token'] . $url, 'SSL');
	
		if (isset($this->request->get['trng_code']) && ($this->request->server['REQUEST_METHOD'] != 'POST')) {
			$training_info = $this->model_training_training->getTraining($this->request->get['trng_code']);
		}
	
		/*if (isset($this->request->post['username'])) {
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
		}*/
		if (isset($this->request->post['code'])) {
			$this->data['name'] = $this->request->post['code'];
		} elseif (!empty($training_info)) {
			$this->data['code'] = $training_info['code'];
		} else {
			$this->data['code'] = '';
		}
		if (isset($this->request->post['name'])) {
			$this->data['name'] = $this->request->post['name'];
		} elseif (!empty($training_info)) {
			$this->data['name'] = $training_info['name'];
		} else {
			$this->data['name'] = '';
		}
	
		if (isset($this->request->post['type'])) {
			$this->data['type'] = $this->request->post['type'];
		} elseif (!empty($training_info)) {
			$this->data['type'] = $training_info['type'];
		} else {
			$this->data['type'] = '';
		}
	
		if (isset($this->request->post['date'])) {
			$this->data['date'] = $this->request->post['date'];
		} elseif (!empty($training_info)) {
			$this->data['date'] = $training_info['date'];
		} else {
			$this->data['date'] = '';
		}
		if (isset($this->request->post['duration'])) {
			$this->data['duration'] = $this->request->post['duration'];
		} elseif (!empty($training_info)) {
			$this->data['duration'] = $training_info['duration'];
		} else {
			$this->data['duration'] = '';
		}
		
		$this->data['locations'] = $this->model_training_training->getTrainingLocations();
		
	if (isset($this->request->post['location'])) {
			$this->data['trng_location'] = $this->request->post['location'];
		} elseif (!empty($training_info)) {
			$this->data['trng_location'] = $training_info['location'];
		} else {
			$this->data['trng_location'] = 0;
		}
		//$this->load->model('user/user_group');
	
		//$this->data['user_groups'] = $this->model_user_user_group->getUserGroups();
	
		if (isset($this->request->post['status'])) {
			$this->data['status'] = $this->request->post['status'];
		} elseif (!empty($training_info)) {
			$this->data['status'] = $training_info['status'];
		} else {
			$this->data['status'] = 0;
		}
	
		$this->template = 'training/training_form.tpl';
		$this->children = array(
				'common/header',
				'common/footer'
		);
	
		$this->response->setOutput($this->render());
	}
	
	protected function validateForm() {
		if (!$this->user->hasPermission('modify', 'training/training')) {
			$this->error['warning'] = $this->language->get('error_permission');
		}
	
		/*if ((utf8_strlen($this->request->post['username']) < 3) || (utf8_strlen($this->request->post['username']) > 20)) {
			$this->error['username'] = $this->language->get('error_username');
		}*/
	
		$training_info = $this->model_training_training->getTrainingByName($this->request->post['name']);
	
		if (!isset($this->request->get['trng_code'])) {
			if ($training_info) {
				$this->error['warning'] = $this->language->get('error_exists');
			}
		} else {
			if ($training_info && ($this->request->get['trng_code'] != $training_info['trng_code'])) {
				$this->error['warning'] = $this->language->get('error_exists');
			}
		}
	
		if ((utf8_strlen($this->request->post['name']) < 1) || (utf8_strlen($this->request->post['name']) > 32)) {
			$this->error['name'] = $this->language->get('error_name');
		}
	
		
	
		/*if ($this->request->post['password'] || (!isset($this->request->get['user_id']))) {
			if ((utf8_strlen($this->request->post['password']) < 4) || (utf8_strlen($this->request->post['password']) > 20)) {
				$this->error['password'] = $this->language->get('error_password');
			}
	
			if ($this->request->post['password'] != $this->request->post['confirm']) {
				$this->error['confirm'] = $this->language->get('error_confirm');
			}
		}*/
	
		if (!$this->error) {
			return true;
		} else {
			return false;
		}
	}

	protected function validateDelete() {
		if (!$this->user->hasPermission('modify', 'training/training')) {
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