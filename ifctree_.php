<?php
function echoPlaceTree($canv, $cursid, $is_ajx=false){
	global $pdo, $relates;
	$stmt = $pdo->prepare("select dbt from canvcurs WHERE idcanv=? and cursid=?");
	$stmt->execute([$canv,$cursid]);
	$dbt = $stmt->fetchColumn();	//таблица для курсора

	//print_r($relates);
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
	$mnItems = array();	// Массив для пунктов меню
	$childrens = array();	// Массив для соответствий дочерних элементов их родительским
	echo "\t\t\t<div class='tree pkwarp' pkeys='$pkeys'>\n";

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

		$pkval=array();
		foreach($pkeya as $pkv){
			$pkval[]= $grid[$pkv];
		} $pkval = implode(',', $pkval);

		$grid['pkval']=$pkval;
		$mnItems[$grid['id']] = $grid; // Заполняем массив выборкой из БД

		/*echo "\t\t\t\t<span class='cursRow' pkval='$pkval' onClick = 'setCurRow(this);'>";
		echo "<img src='img/$grid[pic]'><p>$grid[name]</p>";
		echo "</span>\n";*/
	} // End WHILE
	
	foreach ($mnItems as $item) {
		if ($item["parent"]) $childrens[$item["id"]] = $item["parent"]; // Заполняем массив
	}
	//////////////
	echo "<ul>\n";
	foreach($mnItems as $item) {
		if (!$item["parent"]) echo printItem($item, $mnItems, $childrens); // Выводим все элементы верхнего уровня
	}
	echo "</ul>\n";
	//////////////
	echo "\t\t\t</div>\n";
	//include "test.php";
	//printr2($mnItems);
}
function printItem($item, $items, $childrens) {
	/* Выводим пункт меню */
	echo "<li class='cursRow' pkval=$item[pkval] onclick='setCurRow(this);'>";
	if ($item['mtype']=='Folder'){
		echo "<input type='checkbox'>";
		echo "<label>$item[name]</label>";
	} else echo "<span onClick=\"$item[mfunc];\">$item[name]</span>";

	$ul = false; // Выводились ли дочерние элементы?
	while (true) {
	/* Бесконечный цикл, в котором мы ищем все дочерние элементы */
		$key = array_search($item["id"], $childrens); // Ищем дочерний элемент
		if (!$key) {
			/* Дочерних элементов не найдено */
			if ($ul) echo "</ul>"; // Если выводились дочерние элементы, то закрываем список
			break; // Выходим из цикла
		}
		unset($childrens[$key]); // Удаляем найденный элемент (чтобы он не выводился ещё раз)
		if (!$ul) {
			echo "<ul>"; // Начинаем внутренний список, если дочерних элементов ещё не было
			$ul = true; // Устанавливаем флаг
		}
		echo printItem($items[$key], $items, $childrens); // Рекурсивно выводим все дочерние элементы
	}
	echo "</li>";
}
?>