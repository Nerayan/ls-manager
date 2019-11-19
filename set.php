<?php
$SETS = parse_ini_file(__DIR__ . "/config/config.ini", true);
try {
    $pdo = new PDO("mysql:host=".$SETS['db']['db_server'].";dbname=".$SETS['db']['db_schema'].";charset=utf8",
        $SETS['db']['db_user'],
        $SETS['db']['db_passw'],
        array(PDO::ATTR_PERSISTENT => true)
    );
} catch(PDOException $e) {echo "PDOError:" . $e->getMessage();}

$ACC = new Acc();
?>
