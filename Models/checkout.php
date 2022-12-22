<?php
require_once("model.php");

class Checkout extends Model
{
    function save($data)
    {
        $f = "";
        $v = "";
        foreach ($data as $key => $value) {
            $f .= $key . ",";
            $v .= "'" . $value . "',";
        }
        $f = trim($f, ",");
        $v = trim($v, ",");
        $query = "INSERT INTO HoaDon($f) VALUES ($v);";

        $cmd = $this->conn->prepare($query);
        $status = $cmd->execute();

        $query_mahd = "select MaHD from hoadon ORDER BY NgayLap DESC LIMIT 1";
        $cmd = $this->conn->prepare($query);
        $cmd->execute();
        $data_mahd = $cmd->fetch();

        foreach ($_SESSION['sanpham'] as $value) {
            $MaSP = $value['MaSP'];
            $SoLuong = $value['SoLuong'];
            $DonGia = $value['DonGia'];
            $MaHD = $data_mahd['MaHD'];
            $query_ct = "INSERT INTO chitiethoadon(MaHD,MaSP,SoLuong,DonGia) VALUES ($MaHD,$MaSP,$SoLuong,$DonGia)";
            $cmd = $this->conn->prepare($query);
            $status_ct = $cmd->execute();
        }

        if ($status == true and $status_ct = true) {
            setcookie('msg', 'Đăng ký thành công', time() + 2);
            header('location: ?act=checkout&xuli=order_complete');
        } else {
            setcookie('msg', 'Đăng ký không thành công', time() + 2);
            header('location: ?act=checkout');
        }
    }
}