<?php
include "koneksi.php";

$con = mssql_connect($_MSSQL[Host], $_MSSQL[User], $_MSSQL[Pass]) or die("Cant connect to database");
mssql_select_db($_MSSQL[DBNa], $con);
?>
<html>
<head>
<title>SCAN ISSUE</title>
</head>

<?php
IF ($_SERVER['REQUEST_METHOD'] != 'POST')
   {
      echo "Silahkan Pilih SO NUMBER untuk memulai";
      echo "<br />";

   }
 else  // jika hasil dari postingan .......
   {
     $tipe = $_POST['scantype'];
     $txtcont = $_POST['cont'];
     $txtbarcode = $_POST['modelhdn'];
     $varmodel = substr($txtbarcode,0,12);
     $varserial = substr($txtbarcode,12,8);
     $varsub1  = substr($txtbarcode,12,4);
     $varsubserial = substr($txtbarcode,16,4);

// cek data di detailcsv...
// ---    form pindah ke sini.......
?>
<hr>
<?
echo '<h1>' . $txtcont . '</h1>';
echo '<table border="1">';
echo '<tr>';
echo '<th><h2>MODEL</h2></th>';
echo '<th><h2>SET QTY </h2></th>';
echo '<th><h2>SCANNING QTY</h2></th>';
echo '<th><h2>EDIT</h2></th>';
echo '<th><h2>Make CSV</h2></th>';
echo '</tr>';    

     $sqldetail = "select * from detailcsv where contno = '" . $txtcont . "' and modelno = '" . $varmodel . "'";
     $result = mysql_query($sqldetail);
     $cek_data = mysql_num_rows($result);
     if ($cek_data == 0)
        {
         echo "model nothing ....";
            $suara = 'button-4.wav';
           echo "<embed src =\"$suara\" hidden=\"true\" autostart=\"true\"></embed>";

        }
        else
       { // if jika model ok
            $suara = 'button-3.wav';
           echo "<embed src =\"$suara\" hidden=\"true\" autostart=\"true\"></embed>";


        //ambil data vanningid dari header
        $sqlvan = "select * from header where ContNo = '" . $txtcont . "'";
        $vandata = mysql_query($sqlvan);
        while ($vanrec = mysql_fetch_array($vandata))
          {
            $txtvanning = $vanrec['VanningID'];
          }
//----------------------- end of ambil data vanning -------------

        // cek jika scan type manual atau auto
         if ($tipe == 'MANUAL')
         {
// --------- display data ----------------------------------    
// ----------- end of display data --------------------------




           $sqlins = "insert into detailcek(contno,modelno,serialno,vanningid) values ('" . $txtcont . "','" . $varmodel . "','" . $varserial . "','" . $txtvanning . "')";
           $masukrec = mysql_query($sqlins);

         } //end if tipe manual
         else
         { // ---------- if tipe auto --------------------------
 
//----------------- ambil data carton di model ------------------
        $sqlmdl = "select * from model where ModelID = '" . $varmodel . "'";
        $datmdl = mysql_query($sqlmdl);
        while ($recmdl = mysql_fetch_array($datmdl))
            {
             // echo "<br>";
             // echo $recmdl['ModelID'];
             // echo " qty per carton : " ;
              $qtycrt = $recmdl['Carton'];
             // echo $qtycrt;
            //  echo " , ";
            //  echo " serial : " . $varsubserial;
            //  echo "<br>";
              $sisabagi = $varsubserial % $qtycrt;
             // echo "<br>";
             // echo "sisa bagi = " . $sisabagi;
              if($sisabagi == 0)
                {
                   $sisabagi = $qtycrt ;
                }
              $mulai = ($varsubserial - $sisabagi) + 1;
             // echo "<br>";
             // echo "baca serial dari : " . $mulai;
              $akhir = $mulai + $qtycrt;
             // echo "<br>";
            //  echo "akhir : " . $akhir;
            //  echo "<br><br><br>";
            }
          // buat nomor serial dengan auto
    
          for($wp=$mulai;$wp<$akhir;$wp++)
            {  
	
                $trwp = trim($wp);
                $lenwp = strlen($trwp);
               // echo " panjang : " . $lenwp . " ";
                if($lenwp == 1)
                  {
                    $gabung = "000" . $trwp;
                    $gabser = $varsub1 . $gabung;
                  //  echo "serial : " . $gabser . "<br>";
                  }
                if($lenwp == 2)
                  {
                    $gabung = "00" . $trwp;
                    $gabser = $varsub1 . $gabung;
                  //  echo "serial : " . $gabser . "<br />";
                  }
                if($lenwp == 3)
                  {
                    $gabung = "0" . $trwp;
                    $gabser = $varsub1 . $gabung;
                  //  echo "serial : " . $gabser . "<br />";
                  }
                if($lenwp == 4)
                  {
                    $gabung = $trwp;
                    $gabser = $varsub1 . $gabung;
                  }

// --------- display data auto mode --------------------------    
     //echo "hasil pembacaan : " . $txtbarcode ;
// ----------- end of display data auto mode -----------------

// ----------------  insert data to table -----------------
     $sqlinsauto = "insert into detailcek(contno,modelno,serialno,vanningid) values('" . $txtcont . "','" . $varmodel . "','" . $gabser . "','" . $txtvanning . "')";
     $autorec = mysql_query($sqlinsauto);

            } // end for     
    
     

// ------------------------------------------------------------
// penggabungan serial setelah kalkulasi untuk otomatis serial
// -------------------------------------------------------------
     

// -------------------------------------------------------
//  SUARA ..
// -------------------------------------------------------
           //$wave_file = generate_wavfile();
          // $suara = '8point1.wav';
          //  $suara = 'button-3.wav';
            $suara = 'button-4.wav';
           echo "<embed src =\"$suara\" hidden=\"true\" autostart=\"true\"></embed>";
// -------------------------------------------------------
// END OF SUARA ........
// -------------------------------------------------------
         } // ------------- end if tipe auto ----------

  } // end if jika model ok

  $sqlmodel = "select `detailcsv`.`modelno`,`detailcsv`.`totalset`,`vjumscan`.`jumlah` from detailcsv left join vjumscan on `detailcsv`.`modelno` = `vjumscan`.`modelno` where `detailcsv`.`contno` = '" . $txtcont . "'";
  $datamodel = mysql_query($sqlmodel);
  while ($recmodel = mysql_fetch_array($datamodel))
          {
             echo "<tr>";
             echo "<td><h2>" . $recmodel[0] . "</h2></td>" ;
             echo "<td><h2>" . $recmodel[1] . "</h2></td>";
             echo "<td><h2>" . $recmodel[2] . "</h2></td>";
             echo '<td><h2><a href="detailcekv.php?contno=' . $txtcont . '&model=' . $recmodel[0] . '">edit</a></h2></td>';
             echo '<td><h2><a href="dtlcsv.php?contno=' . $txtcont . '&model=' . $recmodel[0] . '">make csv</a></h2></td>';
             echo "</tr>";
          }
       

echo "</table>";

?>


<br>
<br>
<br>
</body>
</html>

<?php
   }

?>
