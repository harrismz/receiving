<?php
include "koneksi.php";
$con = mssql_connect($_MSSQL[Host], $_MSSQL[User], $_MSSQL[Pass]) or die("Cant connect to database");
mssql_select_db($_MSSQL[DBNa], $con);
echo '<html>';
echo '<body>';

echo '<a href="index.php">menu</a><br />Data hasil upload : <br />';

if ($_REQUEST["loadheader"] == "ok") 
   { 
		if (is_uploaded_file($_FILES["userfile"]["tmp_name"])) 
		{
			// hapus record table sa90temp
			$sqldeltemp = "delete from sa90temp";
			$hasildeltemp = mssql_query($sqldeltemp,$con);
			
			set_time_limit(3600);  // Set limit time fpr maximum execute			
			// insert data to sa90temp		
			$namatemp = $_FILES['userfile']['tmp_name'];
			$kopifile = "c:\\xampp\\tmp\\so.csv";
            copy($namatemp,  $kopifile);
			$sql = "SET QUOTED_IDENTIFIER OFF BULK INSERT EDI.dbo.sa90temp from 'c:\\xampp\\tmp\\so.csv' with ( FIELDTERMINATOR = ',')";
			$result = mssql_query($sql);
			
			// hapus data di sa90prodtemp
			$del_sa90prodtemp 		= "delete from sa90prodtemp";
			$rs_del_sa90prodtemp	= mssql_query($del_sa90prodtemp, $con);
			// insert data ke sa90prodtemp dari sa90temp
			$ins_sa90prodtemp 		= "insert into sa90prodtemp select convert(char,c),convert(char,i),j,convert(float,p),convert(float,q),ad,an,ac,aa from sa90temp";
			$rs_ins_sa90prodtemp	= mssql_query($ins_sa90prodtemp, $con);
			
			// bersihkan double quote
			$upd_sa90prodtemp  		 = "update sa90prodtemp set so = REPLACE(so,CHAR(34),''), partno = REPLACE(partno,CHAR(34),'')";
			$upd_sa90prodtemp 		.= " , partname = REPLACE(partname,CHAR(34),''), lot = REPLACE(lot,CHAR(34),'')";
			$upd_sa90prodtemp 		.= " , line = REPLACE(line,CHAR(34),''), model = REPLACE(model,CHAR(34),''), aa = REPLACE(aa,CHAR(34),'')";
			$rs_upd_sa90prodtemp	 = mssql_query($upd_sa90prodtemp, $con);
			
			//  insert or update data to sa90prodtemp  table  (   used by transacation  and history )
			$sel_sa90prodtemp	= "select * from sa90prodtemp";
			$rs_sa90prodtemp	= mssql_query($sel_sa90prodtemp, $con);
			
			while($row = mssql_fetch_array($rs_sa90prodtemp))
			{
				$so 		= str_replace("'", "", $row[0]);
				$part 		= str_replace("'", "", $row[1]);
				$partname	= str_replace("'", "", $row[2]);
				$bom 		= str_replace("'", "", $row[3]);
				$qty 		= str_replace("'", "", $row[4]);
				$lot 		= str_replace("'", "", $row[5]);
				$line 		= str_replace("'", "", $row[6]);
				$model 		= str_replace("'", "", $row[7]);
				$aa 		= str_replace("'", "", $row[8]);

				// cek data di table SA90M --> jika belum ada --> do insert , jika sudah ada --> do update
				$sel_sa90prod 	= "select * from sa90prod where so = '$so' and partno = '$part'";
				$rs_sa90prod	= mssql_query($sel_sa90prod,$con);
				$cek 			= mssql_num_rows($rs_sa90prod);
			   
				if($cek == 0)
				{
					$ins_sa90prod 		= "insert into sa90prod select * from sa90prodtemp where so = '$so' and partno = '$part'";
					$rs_ins_sa90prod	= mssql_query($ins_sa90prod, $con);
				}
				else
				{
					$upd_sa90prod    = "update sa90prod set partname = '$partname', bom = $bom, qty = $qty, lot = '$lot', ";
					$upd_sa90prod	.= "line = '$line', model = '$model', aa = '$aa' where so = '$so' and partno = '$part'";
					$rs_upd_sa90prod = mssql_query($upd_sa90prod, $con);
				}
			}
		}
   else 
		{
           // if not ok
		}

} 


echo '</body>';
echo '</html>';

?>



