<?php
require_once('../core/config.php');

abstract class DBAbstractModel{

	private  $db_host = DBHOST_ACCES;
	private  $db_user = DBACCES_USER;
	private  $db_pass = DBACCES_PASSWORD;
	private  $db_name = DBACCES;
	private  $db_port = DBPORT;

	protected 	$query;
	protected 	$rows = array();
	private 	$conn;

	private function open_connection() {
		/*$this->conn = new mysqli($this->db_host, $this->db_user,$this->db_pass, $this->db_name);
		$charset = $this->conn->character_set_name();
		$this->conn->set_charset("utf8");*/
		$this->conn = mysqli_connect($this->db_host, $this->db_user,$this->db_pass, $this->db_name);
		//$charset = $this->conn->character_set_name();
		$this->conn->set_charset("utf8");
	}

	private function close_connection() {
		$this->conn->close(); //
	}

	protected function execute_single_query() {
		$this->open_connection();
		$this->conn->query($this->query);
		$this->close_connection();
	}

	protected function get_results_from_query() {
		$this->rows = array();
		$this->open_connection();
		$result = $this->conn->query($this->query);
		if($result!=null){
			while ($this->rows[] = $result->fetch_assoc());
			$result->close();
		}
		$this->close_connection();
		if(count($this->rows)>0)
			array_pop($this->rows);

	}
}
?>
