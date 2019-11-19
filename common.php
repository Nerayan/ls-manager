<?php
function RandomString($hl=10)
{
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $randstring = '';
    for ($i = 0; $i < $hl; $i++) {
        $randstring .= $characters[rand(0, strlen($characters))];
    }
    return $randstring;
}
/////////////////////////
class Acc {
    public $sesId = '';
    public $userId ='';
    private $is_log = false;
    //public $comm = '<br>comm=In ACC....';
    function __construct()
    {
      $this->is_log = $this->checkS();
    }

    /**
     * @return boolean
     */
    public function isLog()
    {
        return $this->is_log;
    }

    private function checkS() {
//print "go CHECKs !!!";
        $this->sesId = isset($_COOKIE["suid"]) ? $_COOKIE["suid"] : '';
        $this->userId = isset($_POST["logn"]) ? $_POST["logn"] : '';
        $PASS = isset($_POST["pass"]) ? $_POST["pass"] : '';
        $LOGOUT = isset($_POST["logout"]) ? $_POST["logout"] : '';
        global $pdo;
//print "name=".$this->userId."; pass=".$PASS."; ses_id=".$this->sesId;
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
                $this->userId = $userobj['login'];
                return true;
            } else {
                $this->sesId = '';
                $this->userLog = '';
                setcookie("suid", '');
                return false;
            }
        } elseif ( !empty($this->userId) and !empty($PASS) ) {
//print "go CHECK name+pass!!!";
            $stmt = $pdo->prepare("select * FROM users WHERE login=? and pass=md5(?)");
            $stmt->execute([$this->userId, $PASS]);
            $userobj = $stmt -> fetch(PDO::FETCH_ASSOC);
            if($userobj)
            {
                $this->sesId = RandomString(10);
                $stmt = $pdo->prepare("UPDATE users set sid=? WHERE login=? and id=?");
                $stmt->execute([$this->sesId, $this->userId, $userobj['id'] ]);
                setcookie("suid", $this->sesId);
                return true;
            }
        }
    }
}
////////////////
?>