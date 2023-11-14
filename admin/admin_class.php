<?php
session_start();
ini_set('display_errors', 1);
class Action
{
	private $db;

	public function __construct()
	{
		ob_start();
		include 'db_connect.php';

		$this->db = $conn;
	}
	function __destruct()
	{
		$this->db->close();
		ob_end_flush();
	}

	function login()
	{

		extract($_POST);
		$qry = $this->db->query("SELECT * FROM users where username = '" . $username . "' and password = '" . md5($password) . "' and `type` = 1");
		if ($qry->num_rows > 0) {
			foreach ($qry->fetch_array() as $key => $value) {
				if ($key != 'password' && !is_numeric($key))
					$_SESSION['login_' . $key] = $value;
			}
			if ($_SESSION['login_type'] != 1) {
				foreach ($_SESSION as $key => $value) {
					unset($_SESSION[$key]);
				}
				return 2;
				exit;
			}
			return 1;
		} else {
			return 3;
		}
	}
	function login2()
	{

		extract($_POST);
		if (isset($email))
			$username = $email;
		$qry = $this->db->query("SELECT * FROM users where username = '" . $username . "' and password = '" . md5($password) . "' and `type` not in (1,4)");
		if ($qry->num_rows > 0) {
			foreach ($qry->fetch_array() as $key => $value) {
				if ($key != 'password' && !is_numeric($key))
					$_SESSION['login_' . $key] = $value;
			}
			if ($_SESSION['login_alumnus_id'] > 0) {
				$bio = $this->db->query("SELECT * FROM alumnus_bio where id = " . $_SESSION['login_alumnus_id']);
				if ($bio->num_rows > 0) {
					foreach ($bio->fetch_array() as $key => $value) {
						if ($key != 'password' && !is_numeric($key))
							$_SESSION['bio'][$key] = $value;
					}
				}
			}
			if ($_SESSION['bio']['status'] != 1) {
				foreach ($_SESSION as $key => $value) {
					unset($_SESSION[$key]);
				}
				return 2;
				exit;
			}
			return 1;
		} else {
			return 3;
		}
	}
	function logout()
	{
		session_destroy();
		foreach ($_SESSION as $key => $value) {
			unset($_SESSION[$key]);
		}
		header("location:login.php");
	}
	function logout2()
	{
		session_destroy();
		foreach ($_SESSION as $key => $value) {
			unset($_SESSION[$key]);
		}
		header("location:../index.php");
	}

	function save_user()
	{
		extract($_POST);
		$data = " name = '$name' ";
		$data .= ", username = '$username' ";
		if (!empty($password))
			$data .= ", password = '" . md5($password) . "' ";
		$data .= ", type = '$type' ";
		if ($type == 1)
			$establishment_id = 0;
		$data .= ", establishment_id = '$establishment_id' ";
		$chk = $this->db->query("Select * from users where username = '$username' and id !='$id' ")->num_rows;
		if ($chk > 0) {
			return 2;
			exit;
		}
		if (empty($id)) {
			$save = $this->db->query("INSERT INTO users set " . $data);
		} else {
			$save = $this->db->query("UPDATE users set " . $data . " where id = " . $id);
		}
		if ($save) {
			return 1;
		}
	}
	function delete_user()
	{
		extract($_POST);
		$delete = $this->db->query("DELETE FROM users where id = " . $id);
		if ($delete)
			return 1;
	}

	function delete_alumni()
	{
		extract($_POST);
		$delete = $this->db->query("DELETE FROM alumnus_bio where id = " . $id);
		if ($delete)
			return 1;
	}
	function signup()
	{
		extract($_POST);
		$data = " name = '" . $firstname . ' ' . $lastname . "' ";
		$data .= ", username = '$email' ";
		$data .= ", password = '" . md5($password) . "' ";
		$chk = $this->db->query("SELECT * FROM users where username = '$email' ")->num_rows;
		if ($chk > 0) {
			return 2;
			exit;
		}
		$save = $this->db->query("INSERT INTO users set " . $data);
		if ($save) {
			$uid = $this->db->insert_id;
			$data = '';
			foreach ($_POST as $k => $v) {
				if ($k == 'password')
					continue;
				if (empty($data) && !is_numeric($k))
					$data = " $k = '$v' ";
				else
					$data .= ", $k = '$v' ";
			}
			if ($_FILES['img']['tmp_name'] != '') {
				$fname = strtotime(date('y-m-d H:i')) . '_' . $_FILES['img']['name'];
				$move = move_uploaded_file($_FILES['img']['tmp_name'], 'assets/uploads/' . $fname);
				$data .= ", avatar = '$fname' ";
			}

			$save_alumni = $this->db->query("INSERT INTO alumnus_bio set $data ");
			if ($data) {
				$aid = $this->db->insert_id;
				$this->db->query("UPDATE users set alumnus_id = $aid where id = $uid ");
				$login = $this->login2();
				if ($login)
					echo json_encode(array(

						"data" => $aid,
						"id" => 1
					));
			}
		}
	}
	function update_account()
	{
		extract($_POST);
		$data = " name = '" . $firstname . ' ' . $lastname . "' ";
		$data .= ", username = '$email' ";
		if (!empty($password))
			$data .= ", password = '" . md5($password) . "' ";
		$chk = $this->db->query("SELECT * FROM users where username = '$email' and id != '{$_SESSION['login_id']}' ")->num_rows;
		if ($chk > 0) {
			return 2;
			exit;
		}
		$save = $this->db->query("UPDATE users set $data where id = '{$_SESSION['login_id']}' ");

		if ($save) {
			$data = '';
			foreach ($_POST as $k => $v) {
				if ($k == 'password')
					continue;
				if (empty($data) && !is_numeric($k))
					$data = " $k = '$v' ";
				else
					$data .= ", $k = '$v' ";
			}

			if ($_FILES['img']['tmp_name'] != '') {
				$fname = strtotime(date('y-m-d H:i')) . '_' . $_FILES['img']['name'];
				$move = move_uploaded_file($_FILES['img']['tmp_name'], 'assets/uploads/' . $fname);
				$data .= ", avatar = '$fname' ";
			} 


			$save_alumni = $this->db->query("UPDATE alumnus_bio set $data where id = '{$_SESSION['bio']['id']}' ");
			if ($data) {
				foreach ($_SESSION as $key => $value) {
					unset($_SESSION[$key]);
				}
				$login = $this->login2();
				if ($login)
					return 1;
			}
		}
	}

	function save_settings()
	{
		extract($_POST);
		$data = " name = '" . str_replace("'", "&#x2019;", $name) . "' ";
		$data .= ", email = '$email' ";
		$data .= ", contact = '$contact' ";
		$data .= ", about_content = '" . htmlentities(str_replace("'", "&#x2019;", $about)) . "' ";
		if ($_FILES['img']['tmp_name'] != '') {
			$fname = strtotime(date('y-m-d H:i')) . '_' . $_FILES['img']['name'];
			$move = move_uploaded_file($_FILES['img']['tmp_name'], 'assets/uploads/' . $fname);
			$data .= ", cover_img = '$fname' ";
		}

		// echo "INSERT INTO system_settings set ".$data;
		$chk = $this->db->query("SELECT * FROM system_settings");
		if ($chk->num_rows > 0) {
			$save = $this->db->query("UPDATE system_settings set " . $data);
		} else {
			$save = $this->db->query("INSERT INTO system_settings set " . $data);
		}
		if ($save) {
			$query = $this->db->query("SELECT * FROM system_settings limit 1")->fetch_array();
			foreach ($query as $key => $value) {
				if (!is_numeric($key))
					$_SESSION['settings'][$key] = $value;
			}

			return 1;
		}
	}


	function update_alumni_acc()
	{
		extract($_POST);
		$update = $this->db->query("UPDATE alumnus_bio set status = $status where id = $id");
		if ($update)
			return 1;
	}


	function save_career()
	{
		extract($_POST);
		$data = " company = '$company' ";
		$data .= ", job_title = '$title' ";
		$data .= ", location = '$location' ";
		$data .= ", description = '" . htmlentities(str_replace("'", "&#x2019;", $description)) . "' ";

		if (empty($id)) {
			// echo "INSERT INTO careers set ".$data;
			$data .= ", user_id = '{$_SESSION['login_id']}' ";
			$save = $this->db->query("INSERT INTO careers set " . $data);
		} else {
			$save = $this->db->query("UPDATE careers set " . $data . " where id=" . $id);
		}
		if ($save)
			return 1;
	}
	function delete_career()
	{
		extract($_POST);
		$delete = $this->db->query("DELETE FROM careers where id = " . $id);
		if ($delete) {
			return 1;
		}
	}

	// function forgot_password() {
	// 	$email = isset($_POST['email']) ? strtolower($_POST['email']) : '';

	// 	if (empty($email)) {
	// 		return 2;
	// 	}

	// 	$result = $this->db->query('SELECT * FROM users WHERE LOWER(username) = "'.$this->db->real_escape_string($email).'" LIMIT 1');

	// 	if ($result->num_rows < 1) {
	// 		return 2;
	// 	}

	// 	$user = $result->fetch_assoc();

	// 	$string = uniqid(rand());
	// 	$randomString = substr($string, 0, 16);

	// 	$updated = $this->db->query('UPDATE users SET password_token = "'.$randomString.'", password_token_expiration = "' . date('Y-m-d H:i:s', strtotime('+2 hrs')). '" WHERE id = '. $user['id']);

	// 	if (!$updated) {
	// 		return 2;
	// 	}

	// 	$host = $_SERVER['SERVER_NAME'];

	// 	$headers = "MIME-Version: 1.0" . "\r\n";
	// 	$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
	// 	$headers .= "From: webmaster@sandbox57a4ba19173c4d9992ba0c27ad6b3cde.mailgun.org" . "\r\n";

	// 	$reset_password_message = 'Hi! Click <a href="' .$host. '/index.php?page=reset_password&token='.urlencode($randomString).'&email='.urlencode($user['username']).'">here</a> to reset your password. Link expires in 2 hrs. Thanks!';

	// 	/*ini_set('SMTP','sandbox.smtp.mailtrap.io');
	// 	ini_set('smtp_server','sandbox.smtp.mailtrap.io');
	// 	ini_set('smtp_port', 25);
	// 	ini_set('auth_username', '637657e19cb4a2');
	// 	ini_set('auth_password', '281d902a9b899e');*/
	// 	//ini_set('force_sender', 'webmaster@sandbox57a4ba19173c4d9992ba0c27ad6b3cde.mailgun.org');

	// 	if (!mail($user['username'], 'Reset Password', $reset_password_message, $headers)) {
	// 		return 3;
	// 	}

	// 	return 1;
	// }

	function forgot_password()
	{
		$email = isset($_POST['email']) ? strtolower($_POST['email']) : '';

		if (empty($email)) {
			return 2;
		}

		$result = $this->db->query('SELECT * FROM users WHERE LOWER(username) = "' . $this->db->real_escape_string($email) . '" LIMIT 1');

		if ($result->num_rows < 1) {
			return 2;
		}

		$user = $result->fetch_assoc();

		$string = uniqid(rand());
		$randomString = substr($string, 0, 16);

		$updated = $this->db->query('UPDATE users SET password_token = "' . $randomString . '", password_token_expiration = "' . date('Y-m-d H:i:s', strtotime('+2 hrs')) . '" WHERE id = ' . $user['id']);

		if (!$updated) {
			return 2;
		} else {
			return 1;
		}
	}

	function reset_password()
	{
		$new_password = isset($_POST['new_password']) ? $_POST['new_password'] : '';
		$confirm_new_password = isset($_POST['confirm_password']) ? $_POST['confirm_password'] : '';
		$user_id = isset($_POST['user_id']) ? $_POST['user_id'] : '';

		if (empty($new_password) || empty($confirm_new_password) || empty($user_id)) {
			return 2;
		}

		if ($new_password !== $confirm_new_password) {
			return 3;
		}

		$updated = $this->db->query('UPDATE users SET password = "' . $this->db->real_escape_string(md5($new_password)) . '", password_token = NULL, password_token_expiration = NULL WHERE id = ' . $this->db->real_escape_string($user_id));

		if (!$updated) {
			return 4;
		}

		return 1;
	}

	function confirm_career()
	{
		$career_id = isset($_POST['id']) ? $_POST['id'] : null;

		if (empty($career_id)) {
			return 2;
		}

		$updated = $this->db->query('UPDATE careers SET confirmed_at = CURRENT_TIMESTAMP() WHERE id = ' . $this->db->real_escape_string($career_id));

		if (!$updated) {
			return 3;
		}

		return 1;
	}

	function apply_career()
	{
		$career_id = isset($_POST['id']) ? $_POST['id'] : null;

		if (empty($career_id)) {
			return 2;
		}

		$application = $this->db->query('SELECT * FROM applicants WHERE career_id = ' . $this->db->real_escape_string($career_id) . ' AND user_id = ' . $_SESSION['login_id'] . ' LIMIT 1');

		if ($application->num_rows > 0) {
			return 3;
		}

		$this->db->query('INSERT INTO applicants (user_id, career_id, date_applied) VALUES (' . $_SESSION['login_id'] . ', ' . $this->db->real_escape_string($career_id) . ', CURRENT_TIMESTAMP())');

		if ($this->db->affected_rows < 1) {
			return 4;
		}

		return 1;
	}
}
