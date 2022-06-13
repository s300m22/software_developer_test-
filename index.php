<?
include "FileSystem.php";

$fileSys = new FileSystem;

$nodes=[];
if(isset($_GET['query'])){
    $nodes = $fileSys->search($_GET['query']);
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>File System Search</title>
</head>

<body>
<form id="form1" name="form1" method="get" action="">
  <label for="query"></label>
  <input type="text" name="query" id="query" />
  <input type="submit" name="search" id="search" value="Search" /><br>
  <?
  // fetch data from $nodes value
  foreach($nodes as $node){
    echo $node .'<br>';
  }
  ?>
</form>
</body>
</html>