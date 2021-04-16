<?php
header('Content-Type: text/html; charset=utf-8'); // utf-8인코딩

// localhost = DB주소, web=DB계정아이디, 1234=DB계정비밀번호, post_board="DB이름"
$db = new mysqli("localhost","root","kosea2019a","world");
$db->set_charset("utf8");

function mq($sql)
{
    global $db;
    return $db->query($sql);
}

$bno = $_GET['idx'];
$userpw = password_hash($_POST['dat_pw'], PASSWORD_DEFAULT);

if($bno && $_POST['dat_user'] && $userpw && $_POST['content']){
    $sql = mq("insert into reply(con_num,name,pw,content) values('".$bno."','".$_POST['dat_user']."','".$userpw."','".$_POST['content']."')");
    echo "<script>alert('댓글이 작성되었습니다.');
        location.href='read.php?idx=$bno';</script>";
}else{
    echo "<script>alert('댓글 작성에 실패했습니다.');
        history.back();</script>";
}

?>