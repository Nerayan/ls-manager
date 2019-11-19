<?php
function printr1($xa) {
	$keys = array_keys($xa);

echo "<div style='display:table;    border:1px dotted green;'>";
	echo "<div style='display:table-row;border:1px dotted black;'>";
	foreach($keys as $key){
		echo "<span style='display: table-cell;border:1px dotted green;padding:10px;'>$key</span>";
	}
	echo "</div>";

	echo "<div style='display:table-row;'>";
	foreach($xa as $clmn){
		echo "<span style='display: table-cell;'>$clmn</span>";
	}
        echo "</div>";

echo "</div>";
}
function printr2($xa) {
	$keys = array_keys($xa[0]);


	echo "<div style='display:table;    border:1px dotted green;'>";
	echo "<div style='display:table-row;border:1px dotted green;'>";
	foreach($keys as $key){
		echo "<span style='display: table-cell;border:1px dotted green;padding:10px;'>$key</span>";
	}
	echo "</div>";
	foreach($xa as $row){
		echo "<div style='display:table-row;'>";
		foreach($row as $clmn){
			echo "<span style='display: table-cell;'>$clmn</span>";
		}
               	echo "</div>";

	}


	echo "</div>";
}
?>

