<?php
include "common.php";
include "set.php";
include "ifcgrid_.php";

if (!$ACC->isLog()) {
	runForm('flogin');
} else {
	$idcanv = $_GET['idcanv']; //	//'interf';//Интерфейс
	$cursId = $_GET['curs']; //	//'canvs';//что рисуется

	$stmt = $pdo->prepare("select * from canvRel WHERE idcanv=?");
	$stmt->execute([$idcanv]);
	$relates = $stmt -> fetchAll(PDO::FETCH_ASSOC);
	$parent = array_combine(explode(',', $_GET['pkeys']), explode(',', $_GET['pkval']));

	/*<!-- Set Filter */
	foreach($relates as &$r) {
	    if($r['cursc']==$cursId){
		$r['val_p'] = $parent[$r['field_p']]; //$parent[$f_p]; //"interf";<---->//$grid['idcanv'];
	    }
	} unset ($r);
	/* set filter -->*/

	echoPlaceGrid($idcanv, $cursId, true);
}
?>