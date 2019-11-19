<?php
include "common.php";
include "set.php";
//include "ifcgrid_.php";

if (!$ACC->isLog()) {
	echo "<p>Access denied!!!</p>";
	return;
}
$idcanv = $_GET['idcanv']; //	//'interf';//Интерфейс
$cursId = $_GET['idcurs']; //	//'canvs';//что рисуется

$stmt = $pdo->prepare("select * from canvcurs WHERE idcanv=? and cursid=?");
$stmt->execute([$idcanv, $cursId]);
$curss = $stmt -> fetch(PDO::FETCH_ASSOC);

$stmt = $pdo->prepare("select * from formz WHERE idform=?");
$stmt->execute([$curss['form'] ]);
$formz = $stmt -> fetch(PDO::FETCH_ASSOC);

$stmts = $pdo->prepare("select * from forms WHERE idform=? order by ftype");
$stmts->execute([$curss['form'] ]);

//echo "<p>IDCanv: $idcanv; CursID: $cursId; table: $curss[dbt]; editForm: $curss[form]</p>";
echo "\t<div class='form'>";
    if ($formz['fname']) {
        print "<div class='form_title' style='border:1px solid red;'>.$formz[fname].</div>";
    }
    echo "<form action='ifcform.php' method='POST'>\n";
        echo "<input type='submit' value='YES'>";
        echo "<input type='reset' value='Clear'>";
        echo "<input type='button' value='Cansel' onclick='quitForm(this)'>";
        $lasty = 0;
        while ($forms = $stmts->fetch(PDO::FETCH_ASSOC)) {
            $x_ = $forms["x"];
            $y_ = $forms['y'] * 1.7;
            $lasty = max($lasty,  $y_);
            switch($forms['ftype']) {
                case 'label':
                    print"\n<div class='form_element' style='left:$x_" ."rem; top:$y_"."rem;'>" .$forms['name'] ."</div>";
                    break;
                case 'input':
                    print "\n<input name='$forms[varn]' class='form_element' type='$forms[vart]' style='left:$x_"."rem; top:$y_"."rem; width:$forms[w]rem;'>";
                    break;
            }
        } $y_ = $lasty + 1;
        echo "<div style='margin-top:$y_" . "rem;'>!!!!!!</div>";
    echo "</form>";
echo "\t</div>";

   // $parent = array_combine(explode(',', $_GET['pkeys']), explode(',', $_GET['pkval']));

	/*<!-- Set Filter
	foreach($relates as &$r) {
	    if($r['cursc']==$cursId) {
		    $r['val_p'] = $parent[$r['field_p']]; //$parent[$f_p]; //"interf";<---->//$grid['idcanv'];
	    }
	} unset ($r);
	 set filter -->*/
//echo "<p>$_GET</p>";
print_r($_GET);
	//echoPlaceGrid($idcanv, $cursId, true);
php?>