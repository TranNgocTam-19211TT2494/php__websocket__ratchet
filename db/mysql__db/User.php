<?php
class User
{
    private $id;
    private $name;
    private $email;
    private $password;
    private $profile;
    private $status;
    private $created_on;
    private $verification_code;
    private $login_status;
    public $conn;

    public function __construct()
    {
        require_once('../mysql__init/config.php');
        $obj = new Config();
        $this->conn = $obj->connect();
    }
    public function setUserId($id)
    {
        $this->id = $id;
    }
    public function getUserId()
    {
        return $this->id;
    }
    public function setUserName($name)
    {
        $this->name = $name;
    }
    public function getUserName()
    {
        return $this->name;
    }
    public function setUserEmail($email)
    {
        $this->email = $email;
    }
    public function getUserEmail()
    {
        return $this->email;
    }
    public function setUserPassword($password)
    {
        $this->password = $password;
    }
    public function getUserPassword()
    {
        return $this->password;
    }
    public function setUserProfile($profile)
    {
        $this->profile = $profile;
    }
    public function getUserProfile()
    {
        return $this->profile;
    }
    public function setUserStatus($status)
    {
        $this->status = $status;
    }
    public function getUserStatus()
    {
        return $this->status;
    }
    public function setUserCreatedOn($created_on)
    {
        $this->created_on = $created_on;
    }
    public function getUserCreatedOn()
    {
        return $this->created_on;
    }
    public function setUserVerificationCode($verification_code)
    {
        $this->verification_code = $verification_code;
    }
    public function getUserVerificationCode()
    {
        return $this->verification_code;
    }
    public function setUserLoginStatus($login_status)
    {
        $this->login_status = $login_status;
    }
    public function getUserLoginStatus()
    {
        return $this->login_status;
    }
    public function make_avatar($character)
    {
        imagecolorallocate(imagecreate(200, 200), rand(0, 255), rand(0, 255), rand(0, 255));
        $text = imagecolorallocate(imagecreate(200, 200), 255, 255, 255);
        $font = dirname(__FILE__) . '/';
        imagettftext(imagecreate(200, 200), 100, 0, 55, 150, $text, null, $character);
        imagepng(imagecreate(200, 200), "img/" . time() . ".png");
        imagedestroy(imagecreate(200, 200));
        return "img/" . time() . ".png";
    }
    public function getDataForEmail()
    {
        $sql = "select * from users where email = :email";
        $statement = $this->conn->prepare($sql);
        $statement->bindParam(':email', $this->email);
        if ($statement->execute()) {
            $data = $statement->fetch(PDO::FETCH_ASSOC);
        }
        return $data;
    }
    public function save()
    {
        $sql = "insert into users (name, email, password, profile, status, created_on ,verification_code, login_status) value (:name, :email, :password, :profile, :status, :created_on , :verification_code, :login_status)";
        $stt = $this->conn->prepare($sql);
        $stt->bindParam(':name', $this->name);
        $stt->bindParam(':email', $this->email);
        $stt->bindParam(':password', $this->password);
        $stt->bindParam(':profile', $this->profile);
        $stt->bindParam(':status', $this->status);
        $stt->bindParam(':created_on', $this->created_on);
        $stt->bindParam(':verification_code', $this->verification_code);
        $stt->bindParam(':login_status', $this->login_status);
        if ($stt->execute()) {
            return true;
        }
        return false;
    }
    public function isValidEmailVeryCode()
    {
        $sql = "select * from users where verification_code = :verification_code";
        $stt = $this->conn->prepare($sql);
        $stt->bindParam(':verification_code', $this->verification_code);
        $stt->execute();
        if ($stt->rowCount() > 0) {
            return true;
        }
        return false;
    }
    public function enableAccount()
    {
        $sql = "update users set status = :status where verification_code = :verification_code";
        $stt = $this->conn->prepare($sql);
        $stt->bindParam(':status', $this->status);
        $stt->bindParam(':verification_code', $this->verification_code);
        if ($stt->execute()) {
            return true;
        }
        return false;
    }
    public function changeAccount()
    {
        $sql = "update users set login_status = :login_status where id = :id";
        $stt = $this->conn->prepare($sql);
        $stt->bindParam(':login_status', $this->login_status);
        $stt->bindParam(':id', $this->id);
        if ($stt->execute()) {
            return true;
        }
        return false;
    }
    public function getUserById()
    {
        $sql = "select * from users where id = :id";
        $stt = $this->conn->prepare($sql);
        $stt->bindParam(':id', $this->id);
        try {
            if ($stt->execute()) {
                $data = $stt->fetch(PDO::FETCH_ASSOC);
            }
            $data = array();
        } catch (\Exception $error) {
            echo $error->getMessage();
        }
        return $data;
    }
    public function uploadImage($profile)
    {
        $name_img = rand() . '.' . explode('.', $profile['name'])[1];
        return move_uploaded_file($profile['tmp_name'], 'img/' . $name_img);
    }
    public function getAll()
    {
        $stt = $this->conn->prepare("select * from users");
        $stt->execute();
        return $stt->fetchAll(PDO::FETCH_ASSOC);
    }
}
