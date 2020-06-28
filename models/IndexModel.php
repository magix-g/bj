<?php

class IndexModel extends Model {

      public function getTasks() {
        $sql = "SELECT * from Tasks order by ".$_SESSION['FIELD_SORT']." ".$_SESSION['FIELD_ORD']." LIMIT ".$_SESSION['PAGE_NUM'].", ".$_SESSION['items_per_page'];

        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        $result = array();
        while($row = $stmt->fetch(PDO::FETCH_ASSOC)) 
            $result[$row['ID']] = $row;
        return $result;
    }

      public function addTask($Name1, $Task, $Mail) {
        $Name1 = htmlspecialchars($Name1, ENT_QUOTES);
        $Task = htmlspecialchars($Task, ENT_QUOTES);
        $Mail = htmlspecialchars($Mail, ENT_QUOTES);
	$sql = "INSERT INTO Tasks (Name, Task, Mail) VALUES (:Name, :Task, :Mail)";

	$stmt = $this->db->prepare($sql);
	$stmt->bindValue(":Name", $Name1, PDO::PARAM_STR);
	$stmt->bindValue(":Task", $Task, PDO::PARAM_STR);
	$stmt->bindValue(":Mail", $Mail, PDO::PARAM_STR);
	$stmt->execute();
	return true;	
	}

      public function delTask($ID) {
	$sql = "DELETE FROM Tasks WHERE ID = :ID";

	$stmt = $this->db->prepare($sql);
	$stmt->bindValue(":ID", $ID, PDO::PARAM_STR);
	$stmt->execute();
	return true;	
	}

      public function updTask($ID, $Task,$name1,$email) {
        $Task = htmlspecialchars($Task, ENT_QUOTES);
	$sql = "UPDATE Tasks SET Task = :Task, Name = :name1, Mail = :email, Changed='Изменено администратором' WHERE ID = :ID";

	$stmt = $this->db->prepare($sql);
	$stmt->bindValue(":ID", $ID, PDO::PARAM_STR);
	$stmt->bindValue(":Task", $Task, PDO::PARAM_STR);
	$stmt->bindValue(":name1", $name1, PDO::PARAM_STR);
	$stmt->bindValue(":email", $email, PDO::PARAM_STR);
	$stmt->execute();
	return true;	
	}

      public function checkChange($ID) {
	$sql = "UPDATE Tasks SET Todo = CASE WHEN Todo = 1 THEN 0 ELSE 1 END WHERE ID = :ID";
	$stmt = $this->db->prepare($sql);
	$stmt->bindValue(":ID", $ID, PDO::PARAM_STR);
	$stmt->execute();
	return true;	
	}

      public function getTaskDub($Name1, $Task, $Mail) {
        $Name1 = htmlspecialchars($Name1, ENT_QUOTES);
        $Task = htmlspecialchars($Task, ENT_QUOTES);
        $Mail = htmlspecialchars($Mail, ENT_QUOTES);

	$sql = "select count(*) as s from Tasks where Name = :Name1 and Task = :Task and Mail = :Mail ";
	$stmt = $this->db->prepare($sql);

	$stmt->bindValue(":Name1", $Name1, PDO::PARAM_STR);
	$stmt->bindValue(":Task", $Task, PDO::PARAM_STR);
	$stmt->bindValue(":Mail", $Mail, PDO::PARAM_STR);

	$stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return ($result['s']>0?true:false);
	}

      public function getCount() {
	$sql = "select count(*) as s from Tasks";
	$stmt = $this->db->prepare($sql);
	$stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result['s'];
	}
}