<?php


class Lecture extends DBConnection {
    private $db = null;

    public function __construct() {
        $this->db = parent::connect();
    }

    public function lectureLogin($email, $password) {
		$row = $this->db->prepare("SELECT * FROM `administrator` WHERE admin_email = ? AND admin_pword = ? ");
		$row->bindValue(1, $email);
		$row->bindValue(2, $password);
		$row->execute();
		if($row->rowCount() > 0) {
		    $data = $row->fetch(PDO::FETCH_OBJ);
		    $_SESSION['admin'] = sha1($data->admin_email);
		    return true;
		}
		else {
		    return 0;
		}
    }


    public function lectureLogout() {
		unset($_SESSION['admin']);
		return true;
    }

}

?>