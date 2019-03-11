<?php
    if(isset($_POST["mgr_id"]) && isset($_POST["mgr_pw"])) {
        $id = $_POST["mgr_id"];
        $pw = $_POST["mgr_pw"];
        
        $db_user="root";
        $db_pass="1234";
        $db_type="mysql";
        $db_host="localhost";
        $db_name="project";
        $dsn    ="$db_type:host=$db_host; dbname=$db_name; charset=utf8";
        $tb_name="manager";

        try{
            $pdo=new PDO($dsn, $db_user, $db_pass);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $sql = "select * from $tb_name where mid = :id and password = :pw";

            $stmh = $pdo->prepare($sql);
            $stmh->bindValue(':id', $id, PDO::PARAM_STR);
            $stmh->bindValue(':pw', $pw, PDO::PARAM_STR);
            $stmh->execute();
            $count = $stmh->rowCount();

            if($count<1) {
                //로그인 실패.
                $warn = "ID, 패스워드를 정확히 입력해주세요.";
                //Header("Location:./member/login.php?login=0");
            }
            else {
                //로그인 성공. 로그인 정보를 세션에 저장. index.php 페이지로 돌아감.
                $row = $stmh->fetch(PDO::FETCH_ASSOC);
                $name = $row['name'];

                session_start();
                $_SESSION['ses_mgr_id'] = $id;
                $_SESSION['ses_mgr_pw'] = $pw;
                $_SESSION['ses_mgr_name'] = $name;

                Header("Location:../manager.php");
            }
        } catch (PDOException $Exception) {
            die('Error: '.$Exception->getMessage());
        }
    }
?>
<html>
    <head>
        <style>
            <?php include "../css/layout_member.css"; ?> 
        </style>
        <title>한빛출판네트워크</title>
    </head>
    <body>
        <div class="login_left">
            <form method="post" action="./manager_login.php">
                 <?php if(isset($warn)) print $warn; ?>
                <h3> 매니저 로그인 </h3>
                <fieldset>
                    <legend>매니저 로그인</legend>
				
				<label class="i_label" for="login_id"><strong style="position: absolute;"></strong>
					<input name="mgr_id" id="user_id" type="text" value="" class="i_text" placeholder="아이디">
				</label> 

				<label class="i_label" for="login_pw"><strong style="position: absolute;"></strong>
					<input name="mgr_pw" id="user_pw" type="password" value="" class="i_text" placeholder="비밀번호">
				</label>
				
				<label>
					<input type="submit" name="login_btn" id="login_btn" value="로그인" class="btn_login">					
				</label>
                </fieldset>
            </form>
        </div>
    </body>
</html>