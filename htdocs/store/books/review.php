<?php
    session_start();

    $book_isbn = $_POST["book_isbn"];
    $book_name = $_POST["book_name"];
    
    $db_user="root";
    $db_pass="1234";
    $db_type="mysql";
    $db_host="localhost";
    $db_name="project";
    $dsn    ="$db_type:host=$db_host; dbname=$db_name; charset=utf8";

    try{
        $pdo=new PDO($dsn, $db_user, $db_pass);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $sql = "select * from book where isbn = :isbn and cid = :user_id";

        $stmh = $pdo->prepare($sql);
        $stmh->bindValue(':isbn', (int) $book_isbn, PDO::PARAM_STR);
        $stmh->bindValue(':user_id', $_SESSION['ses_id'], PDO::PARAM_STR);
        $stmh->execute();
        //$pdo->commit();
        
        $row = $stmh->fetch(PDO::FETCH_ASSOC);
    } catch (PDOException $Exception) {
        //$pdo->rollBack();
        die('Error: '.$Exception->getMessage());
    }
    
    if($row['cid']=="") {
?>
<script>
    alert("책을 구매하신 경우에만 리뷰를 작성하실 수 있습니다.");
    //history.go(-1);//첫번째 방법
    history.back();//두번째 방법
    //href.location ="주소"//해당 주소로 이동하는방법
</script>
<?php
    }
?>

<html>
    <head>
        <style>
            <?php include "../../css/layout_member.css"; ?> 
            <?php //include "../../css/common.css"; ?> 
            <?php //include "../../css/hover.css"; ?> 
            <?php //include "../../css/layout-member.css"; ?> 
            <?php //include "../../css/layout-hanbit.css"; ?> 
            <?php //include "../../css/layout-myhanbit.css"; ?> 
            <?php //include "../../css/layout-network.css"; ?> 
            <?php include "../../css/layout-store.css"; ?> 
        </style>
        <title>한빛출판네트워크</title>
    </head>
    <body>
        <div id="review_popup_div">
            <div class="review_layer" style="display: block;">					
                <div class="bg"></div>
                <div class="review_pop-layer" id="layer_review" style="margin-top: -309px; margin-left: -450px;">												
                    <div class="pop-container">
                        <div class="pop-conts">																		
                            <!--content //-->
                            <form id="frm" name="frm" method="post" action="register_review.php">
                                <input type="hidden" name="book_isbn" id="book_isbn" value=<?=htmlspecialchars($_POST['book_isbn'])?>>

                                <p class="tit">리뷰쓰기</p>
                                <div class="close"><a class="cbtn" href="javascript:history.back();"><img src="../../img/icon_close2.png" width="39" height="38" alt="닫기"></a></div>

                                <div class="layer_scroll">
                                    <div class="layer_con_box">
                                        <fieldset>
                                            <div class="lp_register_li">
                                                <div class="i_tit"><span>* </span>도서명 :</div>
                                                <div class="i_con"><?=htmlspecialchars($book_name)?></div>
                                            </div>
                                            <div class="lp_register_li">
                                                <div class="i_tit"><span>* </span>제목 :</div>
                                                <div class="i_con">
                                                    <label>
                                                        <input type="text" name="r_title" id="r_title" class="i_text1" value="">	
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="lp_register_li">
                                                <div class="i_tit"><span>* </span>별점평가</div>
                                                <div class="i_con">	
                                                    <label><img alt="5" src="../../img/star2-on.png"><img alt="5" src="../../img/star2-on.png"><img alt="5" src="../../img/star2-on.png"><img alt="5" src="../../img/star2-on.png"><img alt="5" src="../../img/star2-on.png"><input type="radio" value="5" name="r_rate" checked="1"></label>
                                                    <label><img alt="5" src="../../img/star2-on.png"><img alt="5" src="../../img/star2-on.png"><img alt="5" src="../../img/star2-on.png"><img alt="5" src="../../img/star2-on.png"><img alt="5" src="../../img/star2-off.png"><input type="radio" value="4" name="r_rate"></label>
                                                    <label><img alt="5" src="../../img/star2-on.png"><img alt="5" src="../../img/star2-on.png"><img alt="5" src="../../img/star2-on.png"><img alt="5" src="../../img/star2-off.png"><img alt="5" src="../../img/star2-off.png"><input type="radio" value="3" name="r_rate"></label>
                                                    <label><img alt="5" src="../../img/star2-on.png"><img alt="5" src="../../img/star2-on.png"><img alt="5" src="../../img/star2-off.png"><img alt="5" src="../../img/star2-off.png"><img alt="5" src="../../img/star2-off.png"><input type="radio" value="2" name="r_rate"></label>
                                                    <label><img alt="5" src="../../img/star2-on.png"><img alt="5" src="../../img/star2-off.png"><img alt="5" src="../../img/star2-off.png"><img alt="5" src="../../img/star2-off.png"><img alt="5" src="../../img/star2-off.png"><input type="radio" value="1" name="r_rate"></label>
                                                </div>
                                            </div>

                                            <div class="lp_register_li">
                                                <div class="i_tit"><span>* </span>내용 :</div>
                                                <div class="i_con" id="hbc_cont_div">
                                                    <label>																
                                                        <textarea cols="40" rows="3" class="i_textarea" name="r_content" id="r_content" ></textarea>
                                                    </label>
                                                </div>
                                            </div>
                                        </fieldset>
                                    </div>

                                    <p class="note_tit">* 리뷰 작성시 유의사항</p>
                                    <p class="note_txt">글이나 이미지/사진 저작권 등 다른 사람의 권리를 침해하거나 명예를 훼손하는 게시물은 이용약관 및 관련법률에 의해 제재를 받을 수 있습니다.</p>
                                    <p class="note_txt">
                                            1. 특히 뉴스/언론사 기사를 전문 또는 부분적으로 '허락없이' 갖고 와서는 안됩니다 (출처를 밝히는 경우에도 안됨).<br>
                                            2. 저작권자의 허락을 받지 않은 콘텐츠의 무단 사용은 저작권자의 권리를 침해하는 행위로, 이에 대한 법적 책임을 지게 될 수 있습니다.
                                    </p>
                                    <div class="btn_layer_default">
                                        <label><button id="proc_btn" name="proc_btn" type="submit" value="" class="btn_blue" onclick="">등록</button></label>
                                        <label><button id="reset_btn" name="reset_btn" type="button" value="" class="btn_white" onclick="javascript:history.back();">취소</button></label>
                                    </div>
                                </div>
                            </form> 
                            <!--// content-->					
                        </div>
                    </div>											
                </div>			
            </div>			
	</div>
    </body>
</html>

