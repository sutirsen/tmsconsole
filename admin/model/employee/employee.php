<?php
class ModelEmployeeEmployee extends Model {
	
	public function getEmployees($data = array()) {
		$sql = "SELECT * FROM `" . DB_PREFIX . "employee`";

		$sort_data = array(
			'fullname',
			'emp_dob',
			'emp_gender',
			'emp_dateofjoining',
			'emp_designation'
		);	

		if (isset($data['sort']) && in_array($data['sort'], $sort_data)) {
			if($data['sort']=="fullname")
			{
				$sql .= " ORDER BY CONCAT(emp_first_name,' ',emp_middle_name,' ',emp_last_name)";
			}
			else
			{
				$sql .= " ORDER BY " . $data['sort'];
			}	
		} else {
			$sql .= " ORDER BY CONCAT(emp_first_name,' ',emp_middle_name,' ',emp_last_name)";	
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

	public function getTotalEmployees() {
		$query = $this->db->query("SELECT COUNT(*) AS total FROM `" . DB_PREFIX . "employee`");

		return $query->row['total'];
	}
	
	public function getEmployeeByEmailid($eml_addr)
	{
		$query = $this->db->query("SELECT * FROM `" . DB_PREFIX . "employee` WHERE emp_email = '" . $this->db->escape($eml_addr) . "'");

		return $query->row;
	}
	
	public function addEmployee($data)
	{
		$this->db->query("INSERT INTO `" . DB_PREFIX . "employee` SET emp_first_name = '" . $this->db->escape($data['emp_first_name']) . "', emp_middle_name = '" . $this->db->escape($data['emp_middle_name']) . "', emp_last_name = '" . $this->db->escape($data['emp_last_name']) . "', emp_dob = '" . $this->db->escape($data['emp_dob']) . "', emp_gender = '" . $this->db->escape($data['emp_gender']) . "', emp_email = '" . $this->db->escape($data['emp_email']) . "', emp_mob1 = '" . $this->db->escape($data['emp_mob1']) . "', emp_mob2 = '" . $this->db->escape($data['emp_mob2']) . "', emp_land_phn = '" . $this->db->escape($data['emp_land_phn']) . "', emp_dateofjoining = '" . $this->db->escape($data['emp_dateofjoining']) . "', emp_designation = '" . $this->db->escape($data['emp_designation']) . "', emp_passport = '" . $this->db->escape($data['emp_passport']) . "', emp_nationality = '" . $this->db->escape($data['emp_nationality']) . "', emp_address = '" . $this->db->escape($data['emp_address']) . "', date_added = NOW()");
	}
	
	public function deleteEmployee($emp_id) {
		$this->db->query("DELETE FROM `" . DB_PREFIX . "employee` WHERE emp_id = '" . (int)$emp_id . "'");
	}
}
?>