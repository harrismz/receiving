
<?php
 if ($_SERVER['REQUEST_METHOD'] != 'POST')
{
   echo 'not post';  

}  // end if server post
else
{
 
  $txtso = $_POST['so'];
  echo $txtso;
}
 
?>