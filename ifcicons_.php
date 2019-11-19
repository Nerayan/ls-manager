<?php
function echoPlaceIcons($canv, $cursid, $is_index=true) {
	global $pdo, $relates;
	$stmt = $pdo->prepare("select dbt from canvcurs WHERE idcanv=? and cursid=?");
	$stmt->execute([$canv,$cursid]);
	$dbt = $stmt->fetchColumn();	//таблица для курсора
/* <!-- Get Filter */
	$where = 'where';
	$and = '';
	$where_comp='';
	$params = array();
	$first_row = true;
	foreach($relates as &$r){
		
		if($r['cursc']==$cursid){
			//trigger_error ("My notice: relRow=$r[cursc], cursid=$cursid; zTest=$zTest");
			$where_comp .= "$where $and $dbt.$r[field_c]=?";
			$and = 'and';
			$where = '';

			if(isset($r['val_p'])){		//array_key_exists('val_p', $r)
				$params[] = $r['val_p'];
			}else{
				$params[] = '';
				$where_comp .= " and 1=0";
			}
			//echo"<br>w= $where_comp";
		}
	}

/*  get filter -->*/

/*  echo "db=$dbt; pkeys=pkeys<br>"; print_r($pkeys);*/
	$pkeys='';
	if(!true){
		$stmt = $pdo->prepare("select GROUP_CONCAT(fl order by pkey separator ',') from dbs where pkey>0 and dbt=?");
		$stmt -> execute([$dbt]);
		$pkeys = $stmt->fetchColumn();
	}else{
		$sth = $pdo->prepare("select fl from dbs where pkey>0 and dbt=? order by pkey");
		$sth->execute([$dbt]);
		$pkeya = $sth->fetchAll(PDO::FETCH_COLUMN, 0);
		$pkeys = implode(',', $pkeya);
	}

	$stmt = $pdo->prepare("select * from $dbt $where_comp ");
	$stmt->execute($params);

	if ($is_index) echo "\t\t\t<div class='icons pkwarp' pkeys='$pkeys'>\n";

	while( $grid = $stmt -> fetch(PDO::FETCH_ASSOC) ) {
	/*<!-- Set Filter */
		foreach($relates as &$r) {
			if($r['cursp']==$cursid and $first_row){
				//echo "Для інших $r[cursp]=$r[field_p] --<br>";
				$r['val_p'] = $grid[$r['field_p']];	//$grid['idcanv'];	//'interf';	//
			}
		} unset ($r);
		$first_row = false;
	/* set filter -->*/
		// 
		$pkval=array();
		foreach($pkeya as $pkv){
			$pkval[]= $grid[$pkv];
		} $pkval = implode(',', $pkval);
	
		echo "\t\t\t\t<span class='cursRow' pkval='$pkval' onClick = 'setCurRow(this);'>";
		echo "<img src='img/$grid[pic]'><p>$grid[name]</p>";
		//foreach($grid as $val){
		//	echo "<span>$val</span>";
		//}
		echo "</span>\n";
	}
	if ($is_index) echo "\t\t\t</div>\n";
}
?>