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

			if (isset($this->request->get['filter_training_title'])) {
				$url .= '&filter_training_title=' . urlencode(html_entity_decode($this->request->get['filter_training_title'], ENT_QUOTES, 'UTF-8'));
			}

			if (isset($this->request->get['filter_training_type'])) {
				$url .= '&filter_training_type=' . urlencode(html_entity_decode($this->request->get['filter_training_type'], ENT_QUOTES, 'UTF-8'));
			}

			if (isset($this->request->get['filter_training_time'])) {
				$url .= '&filter_training_time=' . urlencode(html_entity_decode($this->request->get['filter_training_time'], ENT_QUOTES, 'UTF-8'));
			}

			if (isset($this->request->get['filter_training_location'])) {
				$url .= '&filter_training_location=' . urlencode(html_entity_decode($this->request->get['filter_training_location'], ENT_QUOTES, 'UTF-8'));
			}

			if (isset($this->request->get['filter_training_duration'])) {
				$url .= '&filter_training_duration=' . urlencode(html_entity_decode($this->request->get['filter_training_duration'], ENT_QUOTES, 'UTF-8'));
			}

			if (isset($this->request->get['filter_training_cost'])) {
				$url .= '&filter_training_cost=' . urlencode(html_entity_decode($this->request->get['filter_training_cost'], ENT_QUOTES, 'UTF-8'));
			}

			if (isset($this->request->get['filter_training_instructor'])) {
				$url .= '&filter_training_instructor=' . urlencode(html_entity_decode($this->request->get['filter_training_instructor'], ENT_QUOTES, 'UTF-8'));
			}

			if (isset($this->request->get['filter_createdon'])) {
				$url .= '&filter_createdon=' . urlencode(html_entity_decode($this->request->get['filter_createdon'], ENT_QUOTES, 'UTF-8'));
			}
	
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
			$this->model_training_training->editTraining($this->request->get['id'], $this->request->post);

			$this->session->data['success'] = $this->language->get('text_success_update');

			$url = '';

			if (isset($this->request->get['filter_training_title'])) {
				$url .= '&filter_training_title=' . urlencode(html_entity_decode($this->request->get['filter_training_title'], ENT_QUOTES, 'UTF-8'));
			}

			if (isset($this->request->get['filter_training_type'])) {
				$url .= '&filter_training_type=' . urlencode(html_entity_decode($this->request->get['filter_training_type'], ENT_QUOTES, 'UTF-8'));
			}

			if (isset($this->request->get['filter_training_time'])) {
				$url .= '&filter_training_time=' . urlencode(html_entity_decode($this->request->get['filter_training_time'], ENT_QUOTES, 'UTF-8'));
			}

			if (isset($this->request->get['filter_training_location'])) {
				$url .= '&filter_training_location=' . urlencode(html_entity_decode($this->request->get['filter_training_location'], ENT_QUOTES, 'UTF-8'));
			}

			if (isset($this->request->get['filter_training_duration'])) {
				$url .= '&filter_training_duration=' . urlencode(html_entity_decode($this->request->get['filter_training_duration'], ENT_QUOTES, 'UTF-8'));
			}

			if (isset($this->request->get['filter_training_cost'])) {
				$url .= '&filter_training_cost=' . urlencode(html_entity_decode($this->request->get['filter_training_cost'], ENT_QUOTES, 'UTF-8'));
			}

			if (isset($this->request->get['filter_training_instructor'])) {
				$url .= '&filter_training_instructor=' . urlencode(html_entity_decode($this->request->get['filter_training_instructor'], ENT_QUOTES, 'UTF-8'));
			}

			if (isset($this->request->get['filter_createdon'])) {
				$url .= '&filter_createdon=' . urlencode(html_entity_decode($this->request->get['filter_createdon'], ENT_QUOTES, 'UTF-8'));
			}

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
			foreach ($this->request->post['selected'] as $id) {
				$this->model_training_training->deleteTraining($id);
			}

			$this->session->data['success'] = $this->language->get('text_success_delete');

			$url = '';

			if (isset($this->request->get['filter_training_title'])) {
				$url .= '&filter_training_title=' . urlencode(html_entity_decode($this->request->get['filter_training_title'], ENT_QUOTES, 'UTF-8'));
			}

			if (isset($this->request->get['filter_training_type'])) {
				$url .= '&filter_training_type=' . urlencode(html_entity_decode($this->request->get['filter_training_type'], ENT_QUOTES, 'UTF-8'));
			}

			if (isset($this->request->get['filter_training_time'])) {
				$url .= '&filter_training_time=' . urlencode(html_entity_decode($this->request->get['filter_training_time'], ENT_QUOTES, 'UTF-8'));
			}

			if (isset($this->request->get['filter_training_location'])) {
				$url .= '&filter_training_location=' . urlencode(html_entity_decode($this->request->get['filter_training_location'], ENT_QUOTES, 'UTF-8'));
			}

			if (isset($this->request->get['filter_training_duration'])) {
				$url .= '&filter_training_duration=' . urlencode(html_entity_decode($this->request->get['filter_training_duration'], ENT_QUOTES, 'UTF-8'));
			}

			if (isset($this->request->get['filter_training_cost'])) {
				$url .= '&filter_training_cost=' . urlencode(html_entity_decode($this->request->get['filter_training_cost'], ENT_QUOTES, 'UTF-8'));
			}

			if (isset($this->request->get['filter_training_instructor'])) {
				$url .= '&filter_training_instructor=' . urlencode(html_entity_decode($this->request->get['filter_training_instructor'], ENT_QUOTES, 'UTF-8'));
			}

			if (isset($this->request->get['filter_createdon'])) {
				$url .= '&filter_createdon=' . urlencode(html_entity_decode($this->request->get['filter_createdon'], ENT_QUOTES, 'UTF-8'));
			}

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
		
		if (isset($this->request->get['filter_training_title'])) {
			$filter_training_title = $this->request->get['filter_training_title'];
		} else {
			$filter_training_title = null;
		}

		if (isset($this->request->get['filter_training_type'])) {
			$filter_training_type = $this->request->get['filter_training_type'];
		} else {
			$filter_training_type = null;
		}
		
		if (isset($this->request->get['filter_training_time'])) {
			$filter_training_time = $this->request->get['filter_training_time'];
		} else {
			$filter_training_time = null;
		}
		
		if (isset($this->request->get['filter_training_location'])) {
			$filter_training_location = $this->request->get['filter_training_location'];
		} else {
			$filter_training_location = null;
		}
		
		if (isset($this->request->get['filter_training_duration'])) {
			$filter_training_duration = $this->request->get['filter_training_duration'];
		} else {
			$filter_training_duration = null;
		}
		
		if (isset($this->request->get['filter_training_cost'])) {
			$filter_training_cost = $this->request->get['filter_training_cost'];
		} else {
			$filter_training_cost = null;
		}
		
		if (isset($this->request->get['filter_training_instructor'])) {
			$filter_training_instructor = $this->request->get['filter_training_instructor'];
		} else {
			$filter_training_instructor = null;
		}
		
		if (isset($this->request->get['filter_createdon'])) {
			$filter_createdon = $this->request->get['filter_createdon'];
		} else {
			$filter_createdon = null;
		}
		
		
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

		if (isset($this->request->get['filter_training_title'])) {
			$url .= '&filter_training_title=' . urlencode(html_entity_decode($this->request->get['filter_training_title'], ENT_QUOTES, 'UTF-8'));
		}

		if (isset($this->request->get['filter_training_type'])) {
			$url .= '&filter_training_type=' . urlencode(html_entity_decode($this->request->get['filter_training_type'], ENT_QUOTES, 'UTF-8'));
		}

		if (isset($this->request->get['filter_training_time'])) {
			$url .= '&filter_training_time=' . urlencode(html_entity_decode($this->request->get['filter_training_time'], ENT_QUOTES, 'UTF-8'));
		}

		if (isset($this->request->get['filter_training_location'])) {
			$url .= '&filter_training_location=' . urlencode(html_entity_decode($this->request->get['filter_training_location'], ENT_QUOTES, 'UTF-8'));
		}

		if (isset($this->request->get['filter_training_duration'])) {
			$url .= '&filter_training_duration=' . urlencode(html_entity_decode($this->request->get['filter_training_duration'], ENT_QUOTES, 'UTF-8'));
		}

		if (isset($this->request->get['filter_training_cost'])) {
			$url .= '&filter_training_cost=' . urlencode(html_entity_decode($this->request->get['filter_training_cost'], ENT_QUOTES, 'UTF-8'));
		}

		if (isset($this->request->get['filter_training_instructor'])) {
			$url .= '&filter_training_instructor=' . urlencode(html_entity_decode($this->request->get['filter_training_instructor'], ENT_QUOTES, 'UTF-8'));
		}

		if (isset($this->request->get['filter_createdon'])) {
			$url .= '&filter_createdon=' . urlencode(html_entity_decode($this->request->get['filter_createdon'], ENT_QUOTES, 'UTF-8'));
		}

		
	
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
		$this->data['resetSearch'] = $this->url->link('training/training', 'token=' . $this->session->data['token'] , 'SSL');
		$this->data['trainings'] = array();
	
		$data = array(
				'filter_training_title'	  		=> $filter_training_title,
				'filter_training_type'	  		=> $filter_training_type,
				'filter_training_time'	  		=> $filter_training_time,
				'filter_training_location'	  	=> $filter_training_location,
				'filter_training_duration'	  	=> $filter_training_duration,
				'filter_training_cost'	  		=> $filter_training_cost,
				'filter_training_instructor'	=> $filter_training_instructor,
				'filter_createdon'	  			=> $filter_createdon,
				'sort'  						=> $sort,
				'order' 						=> $order,
				'start' 						=> ($page - 1) * $this->config->get('config_admin_limit'),
				'limit' 						=> $this->config->get('config_admin_limit')
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
		$this->data['button_filter'] = $this->language->get('button_filter');

		$this->data['token'] = $this->session->data['token'];
	
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
	
		if (isset($this->request->get['filter_training_title'])) {
			$url .= '&filter_training_title=' . urlencode(html_entity_decode($this->request->get['filter_training_title'], ENT_QUOTES, 'UTF-8'));
		}

		if (isset($this->request->get['filter_training_type'])) {
			$url .= '&filter_training_type=' . urlencode(html_entity_decode($this->request->get['filter_training_type'], ENT_QUOTES, 'UTF-8'));
		}

		if (isset($this->request->get['filter_training_time'])) {
			$url .= '&filter_training_time=' . urlencode(html_entity_decode($this->request->get['filter_training_time'], ENT_QUOTES, 'UTF-8'));
		}

		if (isset($this->request->get['filter_training_location'])) {
			$url .= '&filter_training_location=' . urlencode(html_entity_decode($this->request->get['filter_training_location'], ENT_QUOTES, 'UTF-8'));
		}

		if (isset($this->request->get['filter_training_duration'])) {
			$url .= '&filter_training_duration=' . urlencode(html_entity_decode($this->request->get['filter_training_duration'], ENT_QUOTES, 'UTF-8'));
		}

		if (isset($this->request->get['filter_training_cost'])) {
			$url .= '&filter_training_cost=' . urlencode(html_entity_decode($this->request->get['filter_training_cost'], ENT_QUOTES, 'UTF-8'));
		}

		if (isset($this->request->get['filter_training_instructor'])) {
			$url .= '&filter_training_instructor=' . urlencode(html_entity_decode($this->request->get['filter_training_instructor'], ENT_QUOTES, 'UTF-8'));
		}

		if (isset($this->request->get['filter_createdon'])) {
			$url .= '&filter_createdon=' . urlencode(html_entity_decode($this->request->get['filter_createdon'], ENT_QUOTES, 'UTF-8'));
		}

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
		if (isset($this->request->get['filter_training_title'])) {
			$url .= '&filter_training_title=' . urlencode(html_entity_decode($this->request->get['filter_training_title'], ENT_QUOTES, 'UTF-8'));
		}

		if (isset($this->request->get['filter_training_type'])) {
			$url .= '&filter_training_type=' . urlencode(html_entity_decode($this->request->get['filter_training_type'], ENT_QUOTES, 'UTF-8'));
		}

		if (isset($this->request->get['filter_training_time'])) {
			$url .= '&filter_training_time=' . urlencode(html_entity_decode($this->request->get['filter_training_time'], ENT_QUOTES, 'UTF-8'));
		}

		if (isset($this->request->get['filter_training_location'])) {
			$url .= '&filter_training_location=' . urlencode(html_entity_decode($this->request->get['filter_training_location'], ENT_QUOTES, 'UTF-8'));
		}

		if (isset($this->request->get['filter_training_duration'])) {
			$url .= '&filter_training_duration=' . urlencode(html_entity_decode($this->request->get['filter_training_duration'], ENT_QUOTES, 'UTF-8'));
		}

		if (isset($this->request->get['filter_training_cost'])) {
			$url .= '&filter_training_cost=' . urlencode(html_entity_decode($this->request->get['filter_training_cost'], ENT_QUOTES, 'UTF-8'));
		}

		if (isset($this->request->get['filter_training_instructor'])) {
			$url .= '&filter_training_instructor=' . urlencode(html_entity_decode($this->request->get['filter_training_instructor'], ENT_QUOTES, 'UTF-8'));
		}

		if (isset($this->request->get['filter_createdon'])) {
			$url .= '&filter_createdon=' . urlencode(html_entity_decode($this->request->get['filter_createdon'], ENT_QUOTES, 'UTF-8'));
		}	
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

		$this->data['filter_training_title'] 		= $filter_training_title;
		$this->data['filter_training_type'] 		= $filter_training_type;
		$this->data['filter_training_time'] 		= $filter_training_time;
		$this->data['filter_training_location'] 	= $filter_training_location;
		$this->data['filter_training_duration'] 	= $filter_training_duration;
		$this->data['filter_training_cost'] 		= $filter_training_cost;
		$this->data['filter_training_instructor'] 	= $filter_training_instructor;
		$this->data['filter_createdon'] 			= $filter_createdon;
	
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

		$this->data['entry_training_title'] 		= $this->language->get('entry_training_title');
		$this->data['entry_training_description'] 	= $this->language->get('entry_training_description');
		$this->data['entry_training_type'] 			= $this->language->get('entry_training_type');
		$this->data['entry_training_time'] 			= $this->language->get('entry_training_time');
		$this->data['entry_training_duration'] 		= $this->language->get('entry_training_duration');
		$this->data['entry_training_location'] 		= $this->language->get('entry_training_location');
		$this->data['entry_training_cost'] 			= $this->language->get('entry_training_cost');
		$this->data['entry_training_instructor'] 	= $this->language->get('entry_training_instructor');
		
		$this->data['button_save'] = $this->language->get('button_save');
		$this->data['button_cancel'] = $this->language->get('button_cancel');
	
		if (isset($this->error['warning'])) {
			$this->data['error_warning'] = $this->error['warning'];
		} else {
			$this->data['error_warning'] = '';
		}
		if (isset($this->error['training_title'])) {
			$this->data['error_training_title'] = $this->error['training_title'];
		} else {
			$this->data['error_training_title'] = '';
		}
		
		if (isset($this->error['training_time'])) {
			$this->data['error_training_time'] = $this->error['training_time'];
		} else {
			$this->data['error_training_time'] = '';
		}
	
		if (isset($this->error['training_duration'])) {
			$this->data['error_training_duration'] = $this->error['training_duration'];
		} else {
			$this->data['error_training_duration'] = '';
		}
	
		if (isset($this->error['training_location'])) {
			$this->data['error_training_location'] = $this->error['training_location'];
		} else {
			$this->data['error_training_location'] = '';
		}
	
			
		$url = '';
	
		if (isset($this->request->get['filter_training_title'])) {
			$url .= '&filter_training_title=' . urlencode(html_entity_decode($this->request->get['filter_training_title'], ENT_QUOTES, 'UTF-8'));
		}

		if (isset($this->request->get['filter_training_type'])) {
			$url .= '&filter_training_type=' . urlencode(html_entity_decode($this->request->get['filter_training_type'], ENT_QUOTES, 'UTF-8'));
		}

		if (isset($this->request->get['filter_training_time'])) {
			$url .= '&filter_training_time=' . urlencode(html_entity_decode($this->request->get['filter_training_time'], ENT_QUOTES, 'UTF-8'));
		}

		if (isset($this->request->get['filter_training_location'])) {
			$url .= '&filter_training_location=' . urlencode(html_entity_decode($this->request->get['filter_training_location'], ENT_QUOTES, 'UTF-8'));
		}

		if (isset($this->request->get['filter_training_duration'])) {
			$url .= '&filter_training_duration=' . urlencode(html_entity_decode($this->request->get['filter_training_duration'], ENT_QUOTES, 'UTF-8'));
		}

		if (isset($this->request->get['filter_training_cost'])) {
			$url .= '&filter_training_cost=' . urlencode(html_entity_decode($this->request->get['filter_training_cost'], ENT_QUOTES, 'UTF-8'));
		}

		if (isset($this->request->get['filter_training_instructor'])) {
			$url .= '&filter_training_instructor=' . urlencode(html_entity_decode($this->request->get['filter_training_instructor'], ENT_QUOTES, 'UTF-8'));
		}

		if (isset($this->request->get['filter_createdon'])) {
			$url .= '&filter_createdon=' . urlencode(html_entity_decode($this->request->get['filter_createdon'], ENT_QUOTES, 'UTF-8'));
		}

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
	
		if (!isset($this->request->get['id'])) {
			$this->data['action'] = $this->url->link('training/training/insert', 'token=' . $this->session->data['token'] . $url, 'SSL');
		} else {
			$this->data['action'] = $this->url->link('training/training/update', 'token=' . $this->session->data['token'] . '&id=' . $this->request->get['id'] . $url, 'SSL');
		}
	
		$this->data['cancel'] = $this->url->link('training/training', 'token=' . $this->session->data['token'] . $url, 'SSL');
	
		if (isset($this->request->get['id']) && ($this->request->server['REQUEST_METHOD'] != 'POST')) {
			$training_info = $this->model_training_training->getTraining($this->request->get['id']);
		}
	
		if (isset($this->request->post['training_title'])) {
			$this->data['training_title'] = $this->request->post['training_title'];
		} elseif (!empty($training_info)) {
			$this->data['training_title'] = $training_info['training_title'];
		} else {
			$this->data['training_title'] = '';
		}
		
		if (isset($this->request->post['training_description'])) {
			$this->data['training_description'] = $this->request->post['training_description'];
		} elseif (!empty($training_info)) {
			$this->data['training_description'] = $training_info['training_description'];
		} else {
			$this->data['training_description'] = '';
		}

		if (isset($this->request->post['training_type'])) {
			$this->data['training_type'] = $this->request->post['training_type'];
		} elseif (!empty($training_info)) {
			$this->data['training_type'] = $training_info['training_type'];
		} else {
			$this->data['training_type'] = '';
		}
		
		if (isset($this->request->post['training_time'])) {
			$this->data['training_time'] = $this->request->post['training_time'];
		} elseif (!empty($training_info)) {
			$this->data['training_time'] = $training_info['training_time'];
		} else {
			$this->data['training_time'] = '';
		}
		
		if (isset($this->request->post['training_duration'])) {
			$this->data['training_duration'] = $this->request->post['training_duration'];
		} elseif (!empty($training_info)) {
			$this->data['training_duration'] = $training_info['training_duration'];
		} else {
			$this->data['training_duration'] = '';
		}
		
		if (isset($this->request->post['training_location'])) {
			$this->data['training_location'] = $this->request->post['training_location'];
		} elseif (!empty($training_info)) {
			$this->data['training_location'] = $training_info['training_location'];
		} else {
			$this->data['training_location'] = '';
		}
		
		if (isset($this->request->post['training_cost'])) {
			$this->data['training_cost'] = $this->request->post['training_cost'];
		} elseif (!empty($training_info)) {
			$this->data['training_cost'] = $training_info['training_cost'];
		} else {
			$this->data['training_cost'] = '';
		}
		
		if (isset($this->request->post['training_instructor'])) {
			$this->data['training_instructor'] = $this->request->post['training_instructor'];
		} elseif (!empty($training_info)) {
			$this->data['training_instructor'] = $training_info['training_instructor'];
		} else {
			$this->data['training_instructor'] = '';
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
	
		if ((utf8_strlen($this->request->post['training_title']) < 1) || (utf8_strlen($this->request->post['training_title']) > 100)) {
			$this->error['training_title'] = $this->language->get('error_training_title');
		}

		if ((utf8_strlen($this->request->post['training_time']) < 1) || (utf8_strlen($this->request->post['training_time']) > 100)) {
			$this->error['training_time'] = $this->language->get('error_training_time');
		}

		if ((utf8_strlen($this->request->post['training_duration']) < 1) || (utf8_strlen($this->request->post['training_duration']) > 100)) {
			$this->error['training_duration'] = $this->language->get('error_training_duration');
		}

		if ((utf8_strlen($this->request->post['training_location']) < 1) || (utf8_strlen($this->request->post['training_location']) > 100)) {
			$this->error['training_location'] = $this->language->get('error_training_location');
		}

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