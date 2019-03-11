<?php
    session_start();
    
    if(!isset($_SESSION['ses_mgr_id'])) {
?>
<script>
    alert("잘못된 접근입니다.");
    history.back();
</script>
<?php
    }
?>

<html>
    <head>
        <meta charset="utf-8"/>
        <title>한빛출판네트워크</title>
        <link rel="stylesheet" href="/css/common.css" />
        <link href="/css/hover.css" rel="stylesheet" media="all">
        <link rel="stylesheet" href="/css/layout-hanbit.css" />
        <link rel="stylesheet" href="/css/layout-member.css" />
        <link rel="stylesheet" href="/css/layout-network.css" />
        <link rel="stylesheet" href="/css/layout-store.css" />
        <link rel="stylesheet" href="/css/layout-myhanbit.css" />
        <link rel="stylesheet" href="/css/layout-event.css" />
        <link rel="stylesheet" href="./css/main.css" />
    </head>
    <body>
        <header>
            <nav>
                <div id="wrap_nav">
                    <ul class="top_brand">
                        <li><a href="/manager.php" name="hanbit_network"><span>HOME</span></a></li>
                        <li><p style="font-size:15px; color:#fff;"><?php if(isset($_SESSION['ses_mgr_id'])) {print $_SESSION['ses_mgr_name']."님 환영합니다.";}?></p></li>
                    </ul>
                    
                    <ul class="top_menu">
                        <?php
                        if(!isset($_SESSION['ses_mgr_id'])) {
                        ?>
                        <li><a href="/member/manager_login.php" class="login"><img src="/img/top_icon_login.png">매니저 로그인</a></li>
                        <li><a href="/member/login.php" class="login"><img src="/img/top_icon_login.png">로그인</a></li>
                        <li><a href="/member/member_agree.php" class="join"><img src="/img/top_icon_join.png">회원가입</a></li>
                        <?php
                        }
                        else {
                        ?>
                        <li><a href="./logout.php" class="logout"><img src="/img/top_icon_logout.png">로그아웃</a></li>
                        <?php
                        }
                        ?>
                    </ul>
                </div>
            </nav>      
        </header>
        <?php
            $db_user="root";
            $db_pass="1234";
            $db_type="mysql";
            $db_host="localhost";
            $db_name="project";
            $dsn    ="$db_type:host=$db_host; dbname=$db_name; charset=utf8";

            try{
                $pdo=new PDO($dsn, $db_user, $db_pass);
                $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                $sql = "select * from book_type";

                $stmh = $pdo->prepare($sql);
                $stmh->execute();
                $count = $stmh->rowCount();


            } catch (PDOException $Exception) {
                die('Error: '.$Exception->getMessage());
            }
        ?>
        <br>
        <br>
        <br>
        <br>
        <br>
        <div>
            <form class="mgr" method="post" action="./manager_make_book_type.php">
                <fieldset>
                    <legend>책 추가하기</legend>
                    <p><strong>새롭게 Book_type을 추가합니다.</strong></p>
                    <p>정보를 모두 입력해주세요.</p>
                    
                    <div class="register_essential">
                        <div class="register_li">
                            <div class="i_tit"><strong>Isbn</strong></div>
                            <div class="i_con">
                                <input type="text" name="isbn" id="isbn" class="i_text" value="">
                            </div>
                        </div>

                        <div class="register_li">
                            <div class="i_tit"><strong>Name</strong></div>
                            <div class="i_con">
                                <input type="text" name="name" id="name" class="i_text" value="">
                            </div>
                        </div>

                        <div class="register_li">
                            <div class="i_tit"><strong>Price</strong></div>
                            <div class="i_con">
                                <input type="text" name="price" id="price" class="i_text" value="">
                            </div>
                        </div>

                        <div class="register_li">
                            <div class="i_tit"><strong>Publisher</strong></div>
                            <div class="i_con">
                                <input type="text" name="publisher" id="publisher" class="i_text" value="">
                            </div>
                        </div>

                        <div class="register_li">
                            <div class="i_tit"><strong>Author</strong></div>
                            <div class="i_con">
                                <input type="text" name="author" id="author" class="i_text" value="">
                            </div>
                        </div>
                        
                        <div class="register_li">
                            <div class="i_tit"><strong>tags</strong></div>
                            <div class="i_con2">
                                <span class="chk_list">
                                    <input type="checkbox" name="tags[]" id="tags" class="i_check" value="인공지능"> <span>인공지능</span>
                                </span>
                                <span class="chk_list">
                                    <input type="checkbox" name="tags[]" id="tags" class="i_check" value="프로그래밍 언어"> <span>프로그래밍 언어</span>
                                </span>
                                <span class="chk_list">
                                    <input type="checkbox" name="tags[]" id="tags" class="i_check" value="웹"> <span>웹</span>
                                </span>
                                <span class="chk_list">
                                    <input type="checkbox" name="tags[]" id="tags" class="i_check" value="여행/취미"> <span>여행/취미</span>
                                </span>
                                <span class="chk_list">
                                    <input type="checkbox" name="tags[]" id="tags" class="i_check" value="자기계발"> <span>자기계발</span>
                                </span>
                                <span class="chk_list">
                                    <input type="checkbox" name="tags[]" id="tags" class="i_check" value="사진/예술"> <span>사진/예술</span>
                                </span>
                                <span class="chk_list">
                                    <input type="checkbox" name="tags[]" id="tags" class="i_check" value="외국어"> <span>외국어</span>
                                </span>
                                <span class="chk_list">
                                    <input type="checkbox" name="tags[]" id="tags" class="i_check" value="디자인"> <span>디자인</span>
                                </span>
                                <span class="chk_list">
                                    <input type="checkbox" name="tags[]" id="tags" class="i_check" value="시집"> <span>시집</span>
                                </span>
                                <span class="chk_list">
                                    <input type="checkbox" name="tags[]" id="tags" class="i_check" value="소설"> <span>소설</span>
                                </span>
                                <span class="chk_list">
                                    <input type="checkbox" name="tags[]" id="tags" class="i_check" value="경제/경영"> <span>경제/경영</span>
                                </span>
                                <span class="chk_list">
                                    <input type="checkbox" name="tags[]" id="tags" class="i_check" value="전공서적"> <span>전공서적</span>
                                </span>
                            </div>
                        </div>
                    </div>

                    <div>
                        <label>
                            <input type="submit" name="make_btn" id="make_btn" value="등록하기" class="btn_blue2">
                        </label>
                    </div>
                </fieldset>
            </form>
            <form class="mgr" method="post" action="./manager_make_book.php">
                <fieldset>
                    <legend>책 추가하기</legend>
                    <p><strong>등록된 Book_type의 Book을 추가합니다.</strong></p>
                    <p>정보를 모두 입력해주세요.</p>
                    
                    <div class="register_essential">
                        <div class="register_li">
                            <div class="i_tit"><strong>bid</strong></div>
                            <div class="i_con">
                                <input type="text" name="bid" id="bid" class="i_text" value="">
                            </div>
                        </div>

                        <div class="register_li">
                            <div class="i_tit"><strong>isbn</strong></div>
                            <div class="i_con">
                                <input type="text" name="isbn" id="bisn" class="i_text" value="">
                            </div>
                        </div>
                        
                    <br>

                    <div>
                        <label>
                            <input type="submit" name="make_btn" id="make_btn" value="등록하기" class="btn_blue2">
                        </label>
                    </div>
                </fieldset>
            </form>
        </div>
        <div class="mgr_table">
            <table width="900" boarder="1" cellspacing="0" cellpadding="8">
                <tbody>
                    <tr>
                        <th>등록번호</th>
                        <th>서명</th>
                        <th>가격</th>
                        <th>저자</th>
                        <th>출판사</th>
                    </tr>
                    <?php
                    while($row = $stmh->fetch(PDO::FETCH_ASSOC)) {
                    ?>
                    <tr>
                        <td align="center" width=100 style="word-break:break-all"><?=htmlspecialchars($row['isbn'])?></td>
                        <td width=300 style="word-break:break-all"><?=htmlspecialchars($row['name'])?></td>
                        <td align="center" width=80 style="word-break:break-all"><?=htmlspecialchars($row['price'])?></td>
                        <td align="center" width=120 style="word-break:break-all"><?=htmlspecialchars($row['author'])?></td>
                        <td align="center" width=200 style="word-break:break-all"><?=htmlspecialchars($row['publisher'])?></td>
                    </tr>
                    <?php
                    }
                    ?>
                </tbody>
            </table>
            
            <?php
                try{
                    $sql = "select * from book";

                    $stmh = $pdo->prepare($sql);
                    $stmh->execute();
                    $count = $stmh->rowCount();

                } catch (PDOException $Exception) {
                    die('Error: '.$Exception->getMessage());
                }
            ?>
            <table width="900" boarder="1" cellspacing="0" cellpadding="8">
                <br>
                <br>
                <tbody>
                    <tr>
                        <th>bid</th>
                        <th>mid</th>
                        <th>cid</th>
                        <th>isbn</th>
                    </tr>
                    <?php
                    while($row = $stmh->fetch(PDO::FETCH_ASSOC)) {
                    ?>
                    <tr>
                        <td align="center" width=100 style="word-break:break-all"><?=htmlspecialchars($row['bid'])?></td>
                        <td width=100    style="word-break:break-all"><?=htmlspecialchars($row['mid'])?></td>
                        <td align="center" width=80 style="word-break:break-all"><?=htmlspecialchars($row['cid'])?></td>
                        <td align="center" width=100 style="word-break:break-all"><?=htmlspecialchars($row['isbn'])?></td>
                    </tr>
                    <?php
                    }
                    ?>
                </tbody>
            </table>
        </div>
                 
        
    </body>
</html>