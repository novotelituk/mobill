<?php 
session_start();
if(!isset($_SESSION['login_user'])){
	header("location:../login/");
}
//error_reporting(E_ALL ^ E_NOTICE);
?>
<html>
<form name="createitem" method="post" action="" enctype="multipart/form-data">
    Item Code:<input type="text" name="itemcode" id="itemcode"><br/>
    Item Name:<input type="text" name="itemname" id="itmename"><br/>
    Price:<input type="text" name="itemprice" id="itemprice"><br/>
    Length:<input type="text" name="itemlength" id="itemlength"><br/>
    Width:<input type="text" name="itemwidth" id="itemwidth"><br/>
    Breadth:<input type="text" name="itembreadth" id="itembreadth"><br/>
    Height:<input type="text" name="itemheight" id="itemheight"><br/>
    Craft Type:
    <select name="crafttype">
        <option value="default">--Select Craft Type--</option>
        <option value="1">Ceramics and glass crafts</option>
        <option value="2">Fiber and textile crafts</option>
        <option value="3">Flower crafts</option>
        <option value="4">Leatherwork</option>
        <option value="5">Mixed Media</option>
        <option value="6">Needlework</option>
        <option value="7">Paper crafts</option>
        <option value="8">Wood and furniture crafts</option>
        <option value="9">Stone crafts</option>
        <option value="10">Metal crafts</option>
    </select><br/>
    Stock Position:
    <input type="radio" name="itemstock" value="1">Available
    <input type="radio" name="itemstock" value="0">Not Available<br/>
    Available Stock: <input type="text" name="availstock" id="availstock"><br/>
    Upload Item Image:
    <input type="file" name="itempic" id="itempic"><br>
    <input type="submit" name="submit" value="Create Item">
</form>
</html>

<?php
include("../../php_includes/db_config.php");

if(isset($_POST["submit"])){
$itemcode=$_POST["itemcode"];
$itemname=$_POST["itemname"];
$itemprice=$_POST["itemprice"]; 
$itemlength=$_POST["itemlength"];
$itemwidth=$_POST["itemwidth"];
$itembreadth=$_POST["itembreadth"];
$itemheight=$_POST["itemheight"];
$crafttype=$_POST["crafttype"];
$itemstock=$_POST["itemstock"];
$availstock=$_POST["availstock"];
$ip=$_SERVER["REMOTE_ADDR"];

$allowedExts=array("jpeg","jpg","png");
$temp=explode(".", $_FILES["itempic"]["name"]);
$extension=end($temp);
if ((($_FILES["itempic"]["type"] == "image/jpeg")
|| ($_FILES["itempic"]["type"] == "image/jpg")
|| ($_FILES["itempic"]["type"] == "image/pjpeg")
|| ($_FILES["itempic"]["type"] == "image/x-png")
|| ($_FILES["itempic"]["type"] == "image/png"))
&& ($_FILES["itempic"]["size"] < 2000000)
&& in_array($extension, $allowedExts))
  {
    if ($_FILES["itempic"]["error"] > 0)
    {
    echo "Error: " . $_FILES["itempic"]["error"] . "<br>";
    }
  else
    {
    echo "Upload: " . $_FILES["itempic"]["name"] . "<br>";
    echo "Type: " . $_FILES["itempic"]["type"] . "<br>";
    echo "Size: " . ($_FILES["itempic"]["size"] / 1024) . " kB<br>";
    echo "Stored in: " . $_FILES["itempic"]["tmp_name"];
    if (file_exists("upload/" . $_FILES["itempic"]["name"]))
      {
      echo $_FILES["itempic"]["name"] . " already exists. ";
      }
    else
      {
      move_uploaded_file($_FILES["itempic"]["tmp_name"],
      "upload/" . $_FILES["itempic"]["name"]);
      echo "Stored in: " . "../dashboard/upload/" . $_FILES["itempic"]["name"];
      $image_addr="http://localhost/vms/admin/dashboard/upload/" . $_FILES["itempic"]["name"];
      echo $image_addr;
      $sql=mysql_query("INSERT into item(item_id, item_code, item_name, price, length, breadth, width, height, craft_type, stock_position,availstock, item_image, item_barcode) values('','$itemcode','$itemname', '$itemprice','$itemlength','$itemwidth', '$itembreadth','$itemheight', '$crafttype', '$itemstock','$availstock', '$image_addr','')");
      
      }
    }
  }
else
  {
  echo "Invalid file";
  }
}
?>