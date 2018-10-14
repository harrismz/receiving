<?

$list = array
("satu,dua,tiga,empat,lima","enam,tujuh,delapan,sembilan,sepuluh",);

$file = fopen("angka.csv","w");

foreach ($list as $line)
  {
    fputcsv($file,explode(',',$line));
  }

fclose($file);

?>