<?php
include "koneksi.php";

echo '<html>';
echo '<body>';
echo '<a href="index.php">menu</a><br />Data hasil upload : <br />';
if ($_REQUEST["loadheader"] == "ok") { 	if (is_uploaded_file($_FILES["userfile"]["tmp_name"]))
	{			
        // hapus record table sa90temp
		$rsdel = $db->Execute("delete from sa90temp");		
		//	Set limit time fpr maximum execute
		set_time_limit(7200);
		// insert data to sa90temp
		$namatemp = $_FILES['userfile']['tmp_name'];
		$feed = fopen($namatemp, 'r');
		$rsdel->Close();
		echo 'insert data to sa90temp...<br>';
		
		//	copy file so.csv
		$kopifile = "d:\\xampp\\tmp\\so.csv";    
		copy($namatemp,  $kopifile);		echo 'set quoted';

		while ($i = fgetcsv($feed, 10000, ",")) 
		{
			$ins = array();
			$ins ["a"] 		= trim( $i['0']);
			$ins ["b"] 		= trim( $i['1']);
			$ins ["c"] 		= trim( $i['2']);
			$ins ["d"] 		= trim( $i['3']);
			$ins ["e"] 		= trim( $i['4']);
			$ins ["f"] 		= trim( $i['5']);
			$ins ["g"] 		= trim( $i['6']);
			$ins ["h"] 		= trim( $i['7']);
			$ins ["i"] 		= trim( $i['8']);
			$ins ["j"] 		= trim( $i['9']);
			$ins ["k"] 		= trim( $i['10']);
			$ins ["l"] 		= trim( $i['11']);
			$ins ["m"] 		= trim( $i['12']);
			$ins ["n"] 		= trim( $i['13']);
			$ins ["o"] 		= trim( $i['14']);
			$ins ["p"] 		= trim( $i['15']);
			$ins ["q"] 		= trim( $i['16']);
			$ins ["r"] 		= trim( $i['17']);
			$ins ["s"] 		= trim( $i['18']);
			$ins ["t"] 		= trim( $i['19']);
			$ins ["u"] 		= trim( $i['20']);
			$ins ["v"] 		= trim( $i['21']);
			$ins ["w"] 		= trim( $i['22']);
			$ins ["x"] 		= trim( $i['23']);
			$ins ["y"] 		= trim( $i['24']);
			$ins ["z"] 		= trim( $i['25']);
			
			$ins ["aa"] 	= trim( $i['26']);
			$ins ["ab"] 	= trim( $i['27']);
			$ins ["ac"] 	= trim( $i['28']);
			$ins ["ad"] 	= trim( $i['29']);
			$ins ["ae"] 	= trim( $i['30']);
			$ins ["af"] 	= trim( $i['31']);
			$ins ["ag"] 	= trim( $i['32']);
			$ins ["ah"] 	= trim( $i['33']);
			$ins ["ai"] 	= trim( $i['34']);
			$ins ["aj"] 	= trim( $i['35']);
			$ins ["ak"] 	= trim( $i['36']);
			$ins ["al"] 	= trim( $i['37']);
			$ins ["am"] 	= trim( $i['38']);
			$ins ["an"] 	= trim( $i['39']);
			$ins ["ao"] 	= trim( $i['40']);
			$ins ["ap"] 	= trim( $i['41']);
			$ins ["aq"] 	= trim( $i['42']);
			$ins ["ar"] 	= trim( $i['43']);
			$ins ["as"] 	= trim( $i['44']);
			$ins ["at"] 	= trim( $i['45']);
			$ins ["au"] 	= trim( $i['46']);
			$ins ["av"] 	= trim( $i['47']);
			$ins ["aw"] 	= trim( $i['48']);
			$ins ["ax"] 	= trim( $i['49']);
			$ins ["ay"] 	= trim( $i['50']);
			$ins ["az"] 	= trim( $i['51']);
			
			$ins ["ba"] 	= trim( $i['52']);
			$ins ["bb"] 	= trim( $i['53']);
			$ins ["bc"] 	= trim( $i['54']);
			$ins ["bd"] 	= trim( $i['55']);
			$ins ["be"] 	= trim( $i['56']);
			$ins ["bf"] 	= trim( $i['57']);
			$ins ["bg"] 	= trim( $i['58']);
			$ins ["bh"] 	= trim( $i['59']);
			$ins ["bi"] 	= trim( $i['60']);
			$ins ["bj"] 	= trim( $i['61']);
			$ins ["bk"] 	= trim( $i['60']);
			
			$rsinsert = $db->Execute("select top 1 * from sa90temp");
			$insertSQL = $db->GetInsertSQL($rsinsert, $ins );
			$db->Execute($insertSQL);
			
			// $rsinsert->Close();
		}
		
		// hapus data di sa90
		echo 'delete from sa90<br>';
        //$sqldelsa = "delete from sa90";
        $rsdel = $db->Execute("delete from sa90");
		// ----------------------------
		
		echo 'insert data ke sa90<br>';
		// insert data ke sa90 dari sa90temp
        $sqlins = "insert into sa90 select convert(char,c),convert(char,i),j,convert(float,p),convert(float,q),ad,an,ac,convert(char,ab) from sa90temp";	       
		$hasilins= $db->Execute($sqlins);
		// ---------------------------------
		
		
		echo '<br><br>';
		echo '<b>Insert data succesfull.</b>';	}	else
	{
		// if not ok
	}
} 

echo '</body>';echo '</html>';

// tutup koneksi 12 des 2011
//mssql_close($con);

?>