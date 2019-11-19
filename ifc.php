<?php
//include "test.php";
//////////////////////
// ** Aka Interface
//////////////////////
// FORMS
//////////////////////
function runForm($idform){
    global $pdo;
    $stmt = $pdo->prepare("select * from formz WHERE idform=?");
    $stmt->execute([$idform]);
    $formz = $stmt -> fetch(PDO::FETCH_ASSOC);
    ?>
<div class='form_wall'>
    <div class='form' style='display:block; width:20em; margin:auto; border:3px solid green;opacity:1.0; background:yellow;top:1em; right:0; left:0;'>
        <?php if($formz['fname']) {print "<div class='form_title' style='border:1px solid red;'>.$formz[fname].</div>\n";} ?>
        <?php
print "<form action='index.php' method='POST'>\n";
print '<input type="submit" value="Login">';
print '<input type="reset" value="Clear">';
        ?>
<?php
    $stmts = $pdo->prepare("select * from forms WHERE idform=? order by ftype");
    $stmts->execute([$idform]);
    $lasty = 0;
    while($forms = $stmts->fetch(PDO::FETCH_ASSOC)) {
        $x_ = $forms['x'];
        $y_ = $forms['y'] * 1.7;
        $lasty = max($lasty,  $y_);
        switch($forms['ftype']){
            case 'label':
                print"\n<div class='form_element' style='left:$x_" ."rem; top:$y_"."rem;'>" .$forms['name'] ."</div>";
                break;
            case 'input':
                print"\n<input name='$forms[varn]' class='form_element' type='$forms[vart]' style='left:$x_"."rem; top:$y_"."rem; width:$forms[w]rem;'>";
                break;
	    }
    }
$y_ = $lasty + 1;
print "<div style='margin-top:$y_"."rem;'></div>
        </form>";

#print"<div class='form_element' style='position:relative;left_:1em;top_:1em;'>test 1</div>\n";
#print"<div class='form_element' style='position:relative;left_:2em;top_:2em;'>test 2</div>\n";
#print"<div class='form_element' style='position:absolute;left:0em;top:3em; margin_:inherit;'>test 3</div>\n";
 
#print"<div style='clear:both;'>zzzzzz</div>";
?>

    </div>
</div>
<?php	return true;
}

/////////////////////////
class Acc2Del {
    public $sesId = '';
    public $userLog ='';
    public $comm = '<br>comm=In ACC....';
    public function checkS() {
        $this->sesId = isset($_COOKIE["suid"]) ? $_COOKIE["suid"] : '';
        $this->userLog = isset($_POST["usermail"]) ? $_POST["usermail"] : '';
        $PASS = isset($_POST["passwd"]) ? $_POST["passwd"] : '';
        $LOGOUT = isset($_POST["logout"]) ? $_POST["logout"] : '';
        global $pdo;
        if($LOGOUT == 'go' and !empty($this->sesId)) {
            $stmt = $pdo->prepare("UPDATE users set sid='' WHERE sid=?");
            $stmt->execute([$this->sesId]);
            setcookie("suid", '');
            $this->sesId = '';
            return false;
        } elseif ( !empty($this->sesId) ) {
            $stmt = $pdo->prepare("SELECT * FROM users WHERE sid=?");
            $stmt->execute([$this->sesId]);
            $userobj = $stmt -> fetch(PDO::FETCH_ASSOC);
            if($userobj) {
                $this->userLog = $userobj['login'];
                return true;
            } else {
                $this->sesId = '';
                $this->userLog = '';
                setcookie("suid", '');
                return false;
            }
        } elseif ( !empty($this->userLog) and !empty($PASS) ) {
            $stmt = $pdo->prepare("select * FROM users WHERE login=? and pass=md5(?)");
            $stmt->execute([$this->userLog, $PASS]);
            $userobj = $stmt -> fetch(PDO::FETCH_ASSOC);
            if($userobj)
            {
                $this->sesId = RandomString(10);
                $stmt = $pdo->prepare("UPDATE users set sid=? WHERE login=? and id=?");
                $stmt->execute([$this->sesId, $this->userLog, $userobj['id'] ]);
                setcookie("suid", $this->sesId);
                return true;
            }
        }
    }
}
////////////////

?>
