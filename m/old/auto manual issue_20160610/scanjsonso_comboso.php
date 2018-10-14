<?php
include "koneksi_edit.php";
try{
    $sql    = "SELECT DISTINCT(so_number) FROM partlist WHERE (partdept = 'SMALLFA') AND (date_issue = '2016-04-19') AND (line = '1') AND (model = 'KDC-125UKN') AND (prod_no = '062A') AND (lot = '45916') AND (qty = '1000') AND (issue_ke = '1') ";
    $rs     = $db->Execute($sql);
    $return = array();
}
catch (Exception $ex){
    echo '[[[MYSQL]]] :::'.$ex->getMessage();
}

for($i=0; !$rs->EOF; $i++){
    $return[$i]['so_number']= trim($rs->fields['0']);
    $rs->MoveNext();
}

/*$data = array(
    "success" => true,
    "data" => $return
);
echo json_encode($data);*/
//echo json_encode($return);

$data = array("data" => $return);
echo json_encode($data);
$db->Close();
$db=null;
?>