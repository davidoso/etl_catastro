<?php
class Login_model extends CI_Model {

	public function getUser($data)
	{
		$this->db->where('username', $data['username']);
		$this->db->where('password', $data['password']);
		$query = $this->db->get('dbo.tbl_users');

		return $query->row_array();
	}

	public function createUser($data)
	{
		$this->db->where('username', $data['username']);
		$query = $this->db->get('dbo.tbl_users')->result_array();

		if(empty($query)) {
			$this->db->insert('dbo.tbl_users', $data);
		}

		return $this->db->affected_rows();
	}

	public function logUserLogin($data)
	{
		$this->db->set('username', $data['username']);
		$this->db->insert('dbo.tbl_log_user_login');
	}

	public function logUpdates($data)
	{
		$this->db->set('username', $data['username']);
		$this->db->set('changed_table', $data['changed_table']);
		$this->db->insert('dbo.tbl_log_updates');
	}

	public function getLocatariosMercados()
	{
		$query = $this->db->query('SELECT giro FROM aux_giro_padron_mercados ORDER BY 1');
        return $query->result();
	}

	public function getTianguistas()
	{
		$query = $this->db->query('SELECT giro FROM aux_giro_padron_tianguis ORDER BY 1');
        return $query->result();
	}

}
?>