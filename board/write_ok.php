<?php
header('Content-Type: text/html; charset=utf-8'); // utf-8인코딩

// localhost = DB주소, web=DB계정아이디, 1234=DB계정비밀번호, post_board="DB이름"
$db = new mysqli("localhost", "root", "kosea2019a", "world");
$db->set_charset("utf8");

function mq($sql)
{
    global $db;
    return $db->query($sql);
}

// 각 변수에 write.php에서 input name값들을 저장한다
$username = $_POST['name'];
$userpw = password_hash($_POST['pw'], PASSWORD_DEFAULT);
$title = $_POST['title'];
$content = $_POST['content'];
$date = date('Y-m-d');

if(isset($_POST['lockpost'])){
    $lo_post = '1';
}else{
    $lo_post = '0';
}
    
$tmpfile =  $_FILES['b_file']['tmp_name'];
$o_name = $_FILES['b_file']['name'];
$filename = iconv("UTF-8", "EUC-KR",$_FILES['b_file']['name']);
$folder = "../../upload/".$filename;
move_uploaded_file($tmpfile,$folder);

if ($username && $userpw && $title && $content) {
    $mqq = mq("alter table board auto_increment =1"); //auto_increment 값 초기화
    $sql = mq("insert into board(name,pw,title,content,date,hit, lock_post, file) values('" . $username . "','" . $userpw . "','" . $title . "','" . $content . "','" . $date . "', '0','".$lo_post."', '".$o_name."')");
    echo "<script>
    alert('글쓰기 완료되었습니다.');
    location.href='index.php';</script>";
} else {
    echo "<script>
    alert('글쓰기에 실패했습니다.');
    history.back();</script>";
}
?>