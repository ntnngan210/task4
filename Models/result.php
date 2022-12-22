<?php
$cmd = $this->conn->prepare($query);
$cmd->execute();
$result = $cmd->fetchAll();
$data = array();

foreach ($result as $row) {
    $data[] = $row;
}
?>

