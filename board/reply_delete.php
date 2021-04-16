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
$rno = $_POST['rno'];
$sql = mq("select * from reply where idx='".$rno."'");//reply테이블에서 idx가 rno변수에 저장된 값을 찾음
$reply = $sql->fetch_array();

$bno = $_POST['b_no'];
$sql2 = mq("select * from board where idx='".$bno."'");//board테이블에서 idx가 bno변수에 저장된 값을 찾음
$board = $sql2->fetch_array();

$pwk = $_POST['pw'];
$bpw = $reply['pw'];

if(password_verify($pwk, $bpw))
{
    $sql = mq("delete from reply where idx='".$rno."'"); ?>
	<script type="text/javascript">alert('댓글이 삭제되었습니다.'); location.replace("read.php?idx=<?php echo $board["idx"]; ?>");</script>
	<?php 
	}else{ ?>
		<script type="text/javascript">alert('비밀번호가 틀립니다');history.back();</script>
	<?php } ?>