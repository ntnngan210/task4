<?php
require_once("model.php");

class Quickview extends Model
{
    function detail_sp($id)
    {
        $query = "SELECT * from SanPham where MaSP = $id ";
        $cmd = $this->conn->prepare($query);
        $cmd->execute();
        return $cmd->fetch();
    }
}