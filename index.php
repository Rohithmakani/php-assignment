<html>
<head>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script> 
<head>
<body>

<div class="container">

<br/>Select Option:

<select class="form-control" style="margin-top:30px;" onchange="selectAPI(this)">
<?php
$list=array("persons","users");
foreach($list as $name)
{
	if ($_GET["name"] == $name) $selected="selected";
	else $selected="";
	echo "<option name='$name'$selected>$name</option>";
}
?>
</select>

<?php
$name=($_GET["name"])?$_GET["name"]:"persons";
$api="https://fakerapi.it/api/v1/$name";

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL,"$api");
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$output = curl_exec($ch);
curl_close($ch);
$content = json_decode($output, 1);

echo "<table class='table table-bordered' style='margin-top:30px;'>";
echo "<tr>";
echo "<th>First Name</th>";
echo "<th>Last Name</th>";
echo "<th>Email</th>";
echo "</tr>";

foreach($content["data"] as $item){
echo "<tr>";
echo "<td>$item[firstname]</td>";
echo "<td>$item[lastname]</td>";
echo "<td>$item[email]</td>";
echo "</tr>";
}
echo "</table>";
?>
</div>

<script>
function selectAPI(sel){
 var name = $(sel).val();
 var url = window.location.href.split('?')[0];
 window.location.href = url+"?name="+$(sel).val();
}
</script>
