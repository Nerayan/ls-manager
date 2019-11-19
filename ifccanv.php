<?php
include "common.php";
include "set.php";
include "ifccanv_.php";

if (!$ACC->isLog()) {
	runForm('flogin');
} else {
	$idcanv = $_GET['idcanv'];


	/*<!-- Set Filter
	set filter -->*/

	echoCanv($idcanv, false);
}
?>