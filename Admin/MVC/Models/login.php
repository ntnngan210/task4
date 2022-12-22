<?php
require_once("connection.php");
class login
{
    var $conn;
    function __construct()
    {
        $database = new Database(null, null, null, null);
        $this->conn = $database->getConnect();
    }
    function tk_sanpham($id){
        $query = "SELECT count(MaSP) as Count FROM sanpham WHERE MaDM = $id";
        $cmd = $this->conn->prepare($query);
        $cmd->execute();
        return $cmd->fetch();

    }
    function tk_thongbao(){
        $query = "SELECT count(MaHD) as Count FROM HoaDon WHERE TrangThai = 0";

        $cmd = $this->conn->prepare($query);
        $cmd->execute();
        return $cmd->fetch();
    }
    function tk_dtthang($m){
        $query = "SELECT SUM(TongTien) as Count FROM HoaDon WHERE MONTH(NgayLap) = $m And TrangThai = 1";

        $cmd = $this->conn->prepare($query);
        $cmd->execute();
        return $cmd->fetch();
    }
    function tk_dtnam($y){
        $query = "SELECT SUM(TongTien) as Count FROM HoaDon WHERE YEAR(NgayLap) = $y And TrangThai = 1";

        $cmd = $this->conn->prepare($query);
        $cmd->execute();
        return $cmd->fetch();
    }
    function tk_nguoidung($id){
        $query = "SELECT count(MaND) as Count FROM NguoiDung WHERE MaQuyen = $id";
        $cmd = $this->conn->prepare($query);
        $cmd->execute();
        return $cmd->fetch();
    }
}
