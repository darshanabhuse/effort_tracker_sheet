<?php
ini_set("display_errors",1);
error_reporting(E_ALL);


?>
<html>
<head>

<style>
div { display:none; color:#aaa; }
</style>
<script>
function toggle(state) {
	var divs = document.getElementsByTagName('div');
	for (var i=0; i<divs.length; i++) {
		divs[i].style.display = (state)?'inline':'none';
	}
}
</script>
</head>
<body>

Display formatting information: <input type="checkbox" onclick="toggle(this.checked)">
<br><br>

<?php //print_r($xls);
 // perform actions for each file found
echo 'hi';
    $data_array = array();
  foreach (glob("$folder_name/*.xls") as $filename) {
    echo "$filename<br />";
    $xls = new Spreadsheet_Excel_Reader("$filename");
    $row = ($xls->rowcount());

    ?>
<table border="1">
<?php
$emp_file_name = explode('/', $filename);
$emp_raw_name = explode('_', $emp_file_name[count($emp_file_name) - 1]);
$emp_name = $emp_raw_name[0] . " " . $emp_raw_name[1];
$row_array = array();
for ($col=1; $col<=$xls->colcount(); $col++) {	
    if ($col == 1) {
        
        
        array_push($row_array, $emp_name . ' ' .$xls->val($row,$col));
        
        ?>
    <td><?php echo $emp_name . ' ' .$xls->val($row,$col); ?>&nbsp;</td>
    <?php
    }
    else {
    array_push($row_array, $xls->val($row,$col));
    ?>
<td><?php echo $xls->val($row,$col); ?>&nbsp;</td>
	<?php } 
}
        ?>
</table>


<?php
array_push($data_array, $row_array);

}
  

  print_r($data_array);
  
  ?>
