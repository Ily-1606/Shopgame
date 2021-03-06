<?php
class Regsiter
{
    public $username;
    public $password;
    public $re_password;
    public $gender;
    public $email;
    public $number_phone;
    public $first_name;
    public $last_name;
    public $result;
    public function __construct($username, $password, $re_password, $gender, $email, $number_phone, $first_name, $last_name)
    {
        $this->username = $username;
        $this->password = $password;
        $this->re_password = $re_password;
        $this->gender = $gender;
        $this->email = $email;
        $this->number_phone = $number_phone;
        $this->first_name = $first_name;
        $this->last_name = $last_name;
    }
    public function check_username_exist($username)
    {
        global $conn;
        $res = mysqli_query($conn, "SELECT id FROM table_accounts WHERE username = '$username'");
        if (mysqli_num_rows($res))
            return true;
        else
            return false;
    }
    public function check_email_exist($email)
    {
        global $conn;
        $res = mysqli_query($conn, "SELECT id FROM table_accounts WHERE email = '$email'");
        if (mysqli_num_rows($res))
            return true;
        else
            return false;
    }
    public function check_gender($gender)
    {
        if ($gender == 1 || $gender == 2)
            return true;
        else
            return false;
    }
    public function check_number_phone($number_phone)
    {
        if (is_numeric($number_phone))
            return true;
        else
            return false;
    }
    public function get_result()
    {
        return $this->result;
    }
    public function process()
    {
        $data = [];
        global $conn;
        $username = $this->username;
        $email = $this->email;
        $password = $this->password;
        $re_password = $this->re_password;
        $gender = $this->gender;
        $number_phone = $this->number_phone;
        $first_name = $this->first_name;
        $last_name = $this->last_name;
        if ($this->check_username_exist($username) == false) {
            if ($this->check_email_exist($email) == false) {
                if ($password == $re_password) {
                    $password = md5($password);
                    if ($this->check_gender($gender)) {
                        if ($this->check_number_phone($number_phone)) {
                            if (mysqli_query($conn, "INSERT INTO table_accounts (`username`,`passwords`,`email`,`gender`,`number_phone`,`first_name`,`last_name`) VALUES ('$username','$password','$email','$gender','$number_phone','$first_name','$last_name')")) {
                                $_SESSION["id"] = mysqli_insert_id($conn);
                                $_SESSION["email"] = $email;
                                $data["status"] = true;
                                $data["msg"] = "Đăng ký tài khoản thành công!";
                            } else {
                                $data["status"] = false;
                                $data["msg"] = "Có lỗi khi đăng ký tài khoản, vui lòng thử lại sau!";
                            }
                        } else {
                            $data["status"] = false;
                            $data["msg"] = "Số điện thoại không hợp lệ!";
                        }
                    } else {
                        $data["status"] = false;
                        $data["msg"] = "Giới tính không hợp lệ!";
                    }
                } else {
                    $data["status"] = false;
                    $data["msg"] = "Mật khẩu không khớp!";
                }
            } else {
                $data["status"] = false;
                $data["msg"] = "Email đã tồn tại!";
            }
        } else {
            $data["status"] = false;
            $data["msg"] = "Username đã tồn tại!";
        }
        $this->result = $data;
    }
}
