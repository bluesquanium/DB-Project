<?php
    session_start();

    if(isset($_POST["recharge"]) && isset($_SESSION["ses_id"])) {
        $id = $_SESSION["ses_id"];
        $pw = $_SESSION["ses_pw"];
        $recharge = $_POST["recharge"];
        
        $db_user="root";
        $db_pass="1234";
        $db_type="mysql";
        $db_host="localhost";
        $db_name="project";
        $dsn    ="$db_type:host=$db_host; dbname=$db_name; charset=utf8";
        $tb_name="customer";

        try{
            $pdo=new PDO($dsn, $db_user, $db_pass);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $sql = "update $tb_name set mileage = mileage + :recharge where cid = :id and password = :pw";

            $stmh = $pdo->prepare($sql);
            $stmh->bindValue(':recharge', $recharge, PDO::PARAM_INT);
            $stmh->bindValue(':id', $id, PDO::PARAM_STR);
            $stmh->bindValue(':pw', $pw, PDO::PARAM_STR);
            $stmh->execute();
            
            Header("Location:./myhanbit.php");
        } catch (PDOException $Exception) {
            die('Error: '.$Exception->getMessage());
        }
    }
?>