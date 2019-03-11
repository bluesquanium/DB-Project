<?php
    session_start();
    
    $bid = $_POST["bid"];
    $isbn = $_POST["isbn"];
    
    $db_user="root";
    $db_pass="1234";
    $db_type="mysql";
    $db_host="localhost";
    $db_name="project";
    $tb_name="book";
    
    $dsn    ="$db_type:host=$db_host; dbname=$db_name; charset=utf8";

    try{
        $pdo=new PDO($dsn, $db_user, $db_pass);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $sql = "insert into $tb_name (bid, mid, isbn) values (:bid, :mid, :isbn)";

        $stmh = $pdo->prepare($sql);
        $stmh->bindValue(':bid', $bid, PDO::PARAM_STR);
        $stmh->bindValue(':mid', $_SESSION['ses_mgr_id'], PDO::PARAM_STR);
        $stmh->bindValue(':isbn', (int) $isbn, PDO::PARAM_STR);
        
        $stmh->execute();
        
?>
<script>
    alert("정상적으로 등록되었습니다.");
    //history.go(-1);//첫번째 방법
    history.back();//두번째 방법
    //href.location ="주소"//해당 주소로 이동하는방법
</script>
<?php
    } catch (PDOException $Exception) {
        print('Error: '.$Exception->getMessage());
?>
<script>
    alert("이미 등록된 isbn이거나, 값들을 모두 채우지 않으셨습니다.");
    //history.go(-1);//첫번째 방법
    history.back();//두번째 방법
    //href.location ="주소"//해당 주소로 이동하는방법
</script>
<?php
    }
?>