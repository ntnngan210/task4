<?php
require_once("connection.php");

class Model
{
    var $conn;
    var $table;
    var $contens;

    function __construct()
    {
        $database = new Database(null, null, null, null);
        $this->conn = $database->getConnect();
    }

    function All()
    {
        $query = "select * from $this->table ORDER BY $this->contens DESC ";

        require("result.php");

        return $data;

    }

    function find($id)
    {
        $query = "select * from $this->table where $this->contens =$id";
        $cmd = $this->conn->prepare($query);
        $cmd->execute();
        return $cmd->fetch();
    }

    function delete($id)
    {
        $query = "DELETE from $this->table where $this->contens=$id";

        $cmd = $this->conn->prepare($query);
        $status = $cmd->execute();
        if ($status == true) {
            setcookie('msg', 'Xóa thành công', time() + 2);
        } else {
            setcookie('msg', 'Xóa không thành công', time() + 2);
        }
        header('Location: ?mod=' . $this->table);
    }

    function store($data)
    {
        $f = "";
        $v = "";
        foreach ($data as $key => $value) {
            $f .= $key . ",";
            $v .= "'" . $value . "',";
        }
        $f = trim($f, ",");
        $v = trim($v, ",");
        $query = "INSERT INTO $this->table($f) VALUES ($v);";

        $cmd = $this->conn->prepare($query);
        $status = $cmd->execute();

        if ($status == true) {
            setcookie('msg', 'Thêm mới thành công', time() + 2);
            header('Location: ?mod=' . $this->table);
        } else {
            setcookie('msg', 'Thêm vào không thành công', time() + 2);
            header('Location: ?mod=' . $this->table . '&act=add');
        }
    }

    function update($data)
    {
        $v = "";
        foreach ($data as $key => $value) {
            $v .= $key . "='" . $value . "',";
        }
        $v = trim($v, ",");


        $query = "UPDATE $this->table SET  $v   WHERE $this->contens = " . $data[$this->contens];

        $cmd = $this->conn->prepare($query);
        $result = $cmd->execute();

        if ($result == true) {
            setcookie('msg', 'Duyệt thành công', time() + 2);
            header('Location: ?mod=' . $this->table);
        } else {
            setcookie('msg', 'Update vào không thành công', time() + 2);
            header('Location: ?mod=' . $this->table . '&act=edit&id=' . $data['id']['id']);
        }
    }
}
