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
}
?>