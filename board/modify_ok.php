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
$username = $_POST['name'];
$userpw = password_hash($_POST['pw'], PASSWORD_DEFAULT);
$title = $_POST['title'];
$content = $_POST['content'];
$sql = mq("update board set name='".$username."',pw='".$userpw."',title='".$title."',content='".$content."' where idx='".$bno."'"); ?>

<script type="text/javascript">alert("수정되었습니다."); </script>
<meta http-equiv="refresh" content="0 url=read.php?idx=<?php echo $bno; ?>">