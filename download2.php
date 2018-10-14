<?
header('Content-Type: application/excel');
header('Content-Disposition: attachment; filename="sample.csv"');


$fp = fopen('php://output', 'w');


$line = 'a,b,c,d'
    $val = explode(",", $line);
    fputcsv($fp, $val);

fclose($fp);

?>