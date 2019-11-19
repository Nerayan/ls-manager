<?php
include "test.php";
//////////////////////
// ** Aka Interface
//////////////////////
function echoCanv($idcanv, $is_index = true)
{
    global $pdo, $relates;
    $stmt = $pdo->prepare("select * from canvz WHERE idcanv=?");
    $stmt->execute([$idcanv]);
    $canvz = $stmt->fetch(PDO::FETCH_ASSOC);

    ///// зв'язок між курсорами
    $stmt = $pdo->prepare("select * from canvRel WHERE idcanv=?");
    $stmt->execute([$idcanv]);
    $relates = $stmt->fetchAll(PDO::FETCH_ASSOC);

    if ($is_index == true) {
        echo "<div class='canvas' idcanv='$idcanv'>";
    }   echo "<!--BEGIN INTERFACE-->\n";

    /// Interface Buttons ///
    echo "\t<div class='canvas_menu' style='display:flex; border:1px solid green;'>\n";

    $stbt = $pdo->prepare("select * from canvbtn WHERE idcanv=? or idcanv='default' order by sort;");
    $stbt->execute([$idcanv]);
    while ($btn = $stbt->fetch()) {
        echo"\t\t<figure class='canv_btn' btn='$btn[btn]' onClick='canvBtnClick(this)'>"
                . "<div class='btn-wrapper'>"
                    . "<img src='$btn[pic]'>"
                    . "<figcaption>$btn[capt]</figcaption>"
                . "</div>"
            . "</figure>\n";
    }
    /////////////////////////////////////
    if ($is_index == false){
        echo "<button class='c_batton' onClick='quitCanv(this);'><img alt='Exit' src='img/exit.png'/><div>ESC</div></button>";
    }
    ///////////////////////////////////////
    echo "\t</div>\n";
    /// --- ///
    if ($canvz['canvname']) {
        print "\t<div class='form_title' style='border:1px solid red;'>$canvz[canvname].</div>\n";
    }

    $stmt = $pdo->prepare("select * from canvs WHERE idcanv=? order by npp;");
    $stmt->execute([$idcanv]);

    $cItems = array();
    $childs = array();
    while ($canvs = $stmt->fetch(PDO::FETCH_ASSOC)) {
        //print"CanvID=$canvs[idcanv]; Parent=$canvs[parent]; $canvs[boxname]<br>";
        $cItems[$canvs['npp']] = $canvs; // Заполняем массив выборкой из БД
        if($canvs['parent']) {  $childs[$canvs['npp']] = $canvs['parent'];   }
    }
    foreach ($cItems as $cItem){
        if(! $cItem['parent']) echoItem($cItem, $cItems, $childs);
    }

    if ($is_index == true){
        echo "</div>";
    }	echo "<!--END INTERFACE-->\n";

}
function echoItem($cItem, $cItems, $childs) {
    global $relates;
    $style='';
    $attr = '';
    $t = '';
    switch ($cItem['resize']) {
        case '=':
            $style .= "flex:0 0 $cItem[size];";
            break;
        case '>':
            $style .= "flex:1 1 $cItem[size];";
            break;
        case '<>':
            //"flex:1 2 $canvs[height];";
            break;
    }
    if ($cItem['boxtype'] == "wrap") {
        $class = $cItem['boxdir'] == 'col' ? "class='canvas_cols'" : "class='canvas_rows'";
        $t = "\t";
    }else{
        $class = "class='canvas_item'";
        foreach ($relates as $rel) {
            if ($cItem['cursid'] == $rel['cursc'])
                $attr = "parent=$rel[cursp] ";    //  ".= -> ="
        }
        $attr .= "idcurs=$cItem[cursid] ctype='$cItem[boxtype]'";
        $t = "\t\t";
    }

    echo "$t<div $class style='$style' $attr>\n";

    if ($cItem['boxtype'] == 'grid') {
        echo "\t\t\t<div>$cItem[boxname]</div>\n";
        include_once "ifcgrid_.php";
        echoPlaceGrid($cItem['idcanv'], $cItem['cursid']);
    }
    if ($cItem['boxtype'] == 'icons') {
        echo "\t\t\t<div>$cItem[boxname]</div>\n";
        include_once "ifcicons_.php";
        echoPlaceIcons($cItem['idcanv'], $cItem['cursid']);
    }
    if ($cItem['boxtype'] == 'tree') {
        echo "\t\t\t<div>$cItem[boxname]</div>\n";
        include_once "ifctree_.php";
        echoPlaceTree($cItem['idcanv'], $cItem['cursid']);
    }

    while (true){
        $key = array_search($cItem["npp"], $childs); // Ищем дочерний элемент
        if(!$key){break;}
        unset($childs[$key]);
        echoItem($cItems[$key], $cItems, $childs); // Рекурсивно выводим все дочерние элементы
    }
    echo "\t</div>\n";

}

//////////////////////////

?>
