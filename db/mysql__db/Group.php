<?php

class Group
{
    private $id;
    private $users_id;
    private $msg_text;
    private $created_on;
    protected $conn;

    public function setMessageId($id)
    {
        $this->id = $id;
    }
    public function getMessageId()
    {
        return $this->id;
    }
    public function setUserId($users_id)
    {
        $this->users_id = $users_id;
    }
    public function getUserId()
    {
        return $this->users_id;
    }
    public function setMessageText($msg_text)
    {
        $this->msg_text = $msg_text;
    }
    public function getMessageText()
    {
        return $this->msg_text;
    }
    public function setUserCreatedOn($created_on)
    {
        $this->created_on = $created_on;
    }
    public function getUserCreatedOn()
    {
        return $this->created_on;
    }

    public function __construct()
    {
        require_once('../mysql__init/config.php');
        $obj = new Config();
        $this->conn = $obj->connect();
    }
    public function save()
    {
        $sql = "insert into groups (users_id, msg_text, created_on) value (:users_id, :msg_text, :created_on)";
        $stt = $this->conn->prepare($sql);
        $stt->bindParam(':users_id', $this->users_id);
        $stt->bindParam(':msg_text', $this->msg_text);
        $stt->bindParam(':created_on', $this->created_on);

        if ($stt->execute()) {
            return true;
        }
        return false;
    }
    public function getDataUserAndGroup()
    {
        $stt = $this->conn->prepare("select * from groups inner join users on users.id = groups.users_id order by groups.id asc");
        $stt->execute();
        return $stt->fetchAll(PDO::FETCH_ASSOC);
    }
}
