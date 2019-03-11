<?php
    session_start();
    if(!isset($_SESSION['ses_id'])) {
?>
<script>
    alert("로그인을 하여주세요.");
    //history.go(-1);//첫번째 방법
    history.back();//두번째 방법
    //href.location ="../../member/login.php"//해당 주소로 이동하는방법
</script>
<?php
    }
?>

<?php
    $db_user="root";
    $db_pass="1234";
    $db_type="mysql";
    $db_host="localhost";
    $db_name="project";
    $dsn    ="$db_type:host=$db_host; dbname=$db_name; charset=utf8";

    $book_isbn = $_POST["book_isbn"];
    $book_price = $_POST["book_price"];

    try{
        $pdo=new PDO($dsn, $db_user, $db_pass);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $sql = "select * from customer where cid = :user_id";

        $stmh = $pdo->prepare($sql);
        $stmh->bindValue(':user_id', $_SESSION['ses_id'], PDO::PARAM_STR);
        $stmh->execute();
        //$pdo->commit();
        
        $row = $stmh->fetch(PDO::FETCH_ASSOC);
        $user_mileage = $row['mileage'];
    } catch (PDOException $Exception) {
        //$pdo->rollBack();
        die('Error: '.$Exception->getMessage());
    }
    
    if( $book_price <= $user_mileage) {
        
        //만약 bid 남은거 없으면 rollBack. sql문을 통해 bid 중 아직 안 나눠준거 있는지 확인
        //유저에게 책 등록
        try{
            $pdo=new PDO($dsn, $db_user, $db_pass);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $sql = "select bid from book where isbn = :isbn and cid is null";

            $stmh = $pdo->prepare($sql);
            
            $stmh->bindValue(':isbn', (int) $book_isbn, PDO::PARAM_INT);
            $stmh->execute();
            //$pdo->commit();
            
            $row = $stmh->fetch(PDO::FETCH_ASSOC);
            $bid = $row['bid'];
        } catch (PDOException $Exception) {
            //$pdo->rollBack();
            die('Error: '.$Exception->getMessage());
        }
        
        if ($bid == "") {
?>
<script>
    alert("현재 남은 재고가 없습니다. 죄송합니다.");
    //history.go(-1);//첫번째 방법
    history.back();//두번째 방법
    //href.location ="주소"//해당 주소로 이동하는방법
</script>
<?php
        }
        else {
            try{
                $pdo=new PDO($dsn, $db_user, $db_pass);
                $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                $sql = "update book set cid = :user_id where bid = :bid";

                $stmh = $pdo->prepare($sql);

                $stmh->bindValue(':bid', $bid, PDO::PARAM_STR);
                $stmh->bindValue(':user_id', $_SESSION['ses_id'], PDO::PARAM_STR);
                $stmh->execute();
                //$pdo->commit();

                //$row = $stmh->fetch(PDO::FETCH_ASSOC);
                //$user_mileage = $row['mileage'];
            } catch (PDOException $Exception) {
                //$pdo->rollBack();
                die('Error: '.$Exception->getMessage());
            }

            //유저 마일리지 깎아줌
            try{
                $pdo=new PDO($dsn, $db_user, $db_pass);
                $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                $sql = "update customer set mileage = mileage - :mileage where cid = :user_id";

                $stmh = $pdo->prepare($sql);
                $stmh->bindValue(':user_id', $_SESSION['ses_id'], PDO::PARAM_STR);
                $stmh->bindValue(':mileage', (int) $book_price, PDO::PARAM_INT);
                $stmh->execute();
                //$pdo->commit();

                //$row = $stmh->fetch(PDO::FETCH_ASSOC);
                //$user_mileage = $row['mileage'];
            } catch (PDOException $Exception) {
                //$pdo->rollBack();
                die('Error: '.$Exception->getMessage());
            }
        }
?>
<script>
    alert("구매가 완료되었습니다!");
    //history.go(-1);//첫번째 방법
    history.back();//두번째 방법
    //href.location ="주소"//해당 주소로 이동하는방법
</script>
<?php
    }
    else {
?>
<script>
    alert("마일리지가 부족합니다.");
    //history.go(-1);//첫번째 방법
    history.back();//두번째 방법
    //href.location ="주소"//해당 주소로 이동하는방법
</script>
<?php
        }
?>