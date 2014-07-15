<?php
class ModelTrainingTraining extends Model {
public function addTraining($data) {
		$this->db->query("INSERT INTO `" . DB_PREFIX . "training` SET trng_name = '" . $this->db->escape($data['name']) . "', trng_type = '" . $this->db->escape($data['type']) . "', trng_date = '" . $this->db->escape($data['date']) . "', trng_duration = '" . $this->db->escape($data['duration'])  ."', trng_location = '" . $this->db->escape($data['location'])."'");
	}

	public function editTraining($trng_code, $data) {
		$this->db->query("UPDATE `" . DB_PREFIX . "training` SET trng_name = '" . $this->db->escape($data['name']) . "', trng_type = '" . $this->db->escape($data['type']) . "', trng_date = '" . $this->db->escape($data['date']) . "', trng_duration = '" . $this->db->escape($data['duration']) . "', trng_location = '" . $this->db->escape($data['location']) . "' WHERE trng_code = '" . (int)$code . "'");
		
	}
	public function getTrainingByName($name) {
		$query = $this->db->query("SELECT * FROM `" . DB_PREFIX . "training` WHERE trng_name = '" . $this->db->escape($name) . "'");

		return $query->row;
	}
	public function deleteTraining($trng_code) {
		$this->db->query("DELETE FROM `" . DB_PREFIX . "training` WHERE trng_code = '" . (int)$trng_code . "'");
	}
	public function getTraining($code) {
		$query = $this->db->query("SELECT * FROM `" . DB_PREFIX . "training` WHERE trng_code = '" . (int)$code. "'");

		return $query->row;
	}
	public function getTrainings($data = array()) {
		$sql = "SELECT * FROM `" . DB_PREFIX . "training`";

		$sort_data = array(
			'training_title',
			'training_type',
			'training_time',
			'training_location',
			'training_duration',
			'training_cost',
			'training_instructor',
			'createdon'
		);	

		$sql .= "WHERE '1'='1'";

		if (!empty($data['filter_training_title'])) {
			$sql .= " AND training_title LIKE '" . $this->db->escape($data['filter_training_title']) . "%'";
		}

		if (!empty($data['filter_training_type'])) {
			$sql .= " AND training_type LIKE '" . $this->db->escape($data['filter_training_type']) . "%'";
		}

		if (!empty($data['filter_training_time'])) {
			$sql .= " AND training_time LIKE '" . $this->db->escape($data['filter_training_time']) . "%'";
		}

		if (!empty($data['filter_training_location'])) {
			$sql .= " AND training_location LIKE '" . $this->db->escape($data['filter_training_location']) . "%'";
		}

		if (!empty($data['filter_training_duration'])) {
			$sql .= " AND training_duration LIKE '" . $this->db->escape($data['filter_training_duration']) . "%'";
		}

		if (!empty($data['filter_training_cost'])) {
			$sql .= " AND training_cost LIKE '" . $this->db->escape($data['filter_training_cost']) . "%'";
		}

		if (!empty($data['filter_training_instructor'])) {
			$sql .= " AND training_instructor LIKE '" . $this->db->escape($data['filter_training_instructor']) . "%'";
		}

		if (!empty($data['filter_createdon'])) {
			$sql .= " AND createdon LIKE '" . $this->db->escape($data['filter_createdon']) . "%'";
		}

		
		if (isset($data['sort']) && in_array($data['sort'], $sort_data)) {
			$sql .= " ORDER BY " . $data['sort'];
		} else {
			$sql .= " ORDER BY createdon";
		}

		if (isset($data['order']) && ($data['order'] == 'DESC')) {
			$sql .= " DESC";
		} else {
			$sql .= " ASC";
		}
		
		if (isset($data['start']) || isset($data['limit'])) {
			if ($data['start'] < 0) {
				$data['start'] = 0;
			}			

			if ($data['limit'] < 1) {
				$data['limit'] = 20;
			}	

			$sql .= " LIMIT " . (int)$data['start'] . "," . (int)$data['limit'];
		}

		$query = $this->db->query($sql);

		return $query->rows;
	}
	
	public function getTotaltrainings() {
		$query = $this->db->query("SELECT COUNT(*) AS total FROM `" . DB_PREFIX . "training`");

		return $query->row['total'];
	}
	
	public function getTrainingLocations(){
		$query = $this->db->query("SELECT * FROM `".DB_PREFIX."training_locations` WHERE loc_status = 'A'");
		
		return $query->rows;
	}
}
?>