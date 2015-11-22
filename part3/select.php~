<?php
include("../conn.php");
$conn = new MyConnect();
$conn->connect("localhost","root","864159025","LimeSurvey");

$flag = 1;
$select = "";


if(isset($_POST['submit']))
{

	if($_POST['school'][0] == "all" && $_POST['major'][0] == "all" && $_POST['degree'][0] == "all" && $_POST['finish'][0] == "all")
	{
		$flag = 0;
	}
	else
	{
		if($_POST['school'][0] != "all")
		{
			$select .= "attribute_1='".$_POST['school'][0]."'";
		}
		if($_POST['major'][0] != "all")
		{
			if($select != "")
			{
				$select .= " and attribute_2='".$_POST['major'][0]."'";
			}
			else
			{
				$select .= "attribute_2='".$_POST['major'][0]."'";
			}
		}
		if($_POST['degree'][0] != "all")
		{
			if($select != "")
			{
				$select .= " and attribute_3='".$_POST['degree'][0]."'";
			}
			else
			{
				$select .= "attribute_3='".$_POST['degree'][0]."'";
			}
		}
		if($_POST['finish'][0] != "all")
		{
			if($select != "")
			{
				$select .= " and completed='".$_POST['finish'][0]."'";
			}
			else
			{
				$select .= "completed='".$_POST['finish'][0]."'";
			}
		}
	}
}
else
{ ?>
<script>
	alert("非法访问！");
	window.location.href="jiemian.php";
</script>
<?php }
if($flag == 0)
{
	$select = "";
}
else
{
	$select = " where ".$select;
}

$sql = "select * from lime_tokens_782191".$select;

$array = array();
$result = mysql_query($sql);
?>
<table border="solid">
<th>姓名</th>
<th>操作码</th>
<th>是否完成（完成时间）</th>
<th>截止日期</th>
<th>学校</th>
<th>专业</th>
<th>学历</th>
<th>发邮件</th>
<?php
while($row = mysql_fetch_array($result))
{
?>
<tr>
	<th><?php echo $row['lastname'].$row['firstname'] ?></th>
	<th><?php echo $row['token'] ?></th>
	<th><?php echo $row['completed'] ?></th>
	<th><?php echo $row['validuntil'] ?></th>
	<th><?php echo $row['attribute_1'] ?></th>
	<th><?php echo $row['attribute_2'] ?></th>
	<th><?php echo $row['attribute_3'] ?></th>
	<th><button value="<?php echo $row['email'] ?>" onclick="send_email('<?php echo $row['email'] ?>')" >向ta发送邮件</button></th>
</tr>
<?php
	$array_temp = array();
	array_push($array_temp,$row['lastname'],$row['firstname'],$row['email'],$row['token'],$row['completed'],$row['validuntil'],$row['attribute_1'],$row['attribute_2'],$row['attribute_3']);
	array_push($array,$array_temp);
}
?>
</table>
<form action="excel.php" method="post">
     <input name="array" type="hidden" value="<?php echo base64_encode(serialize($array)) ?>"></div>
     <input type="submit" name="submit" value="导出为excel文件" />
</form>

<button id="first" onclick="return_1()">返回查询界面</button>
<script>
	function return_1()
	{
		window.location.href="jiemian.php";	
	}
	function send_email(email)
	{
		window.location.href="../part4/email_templete_chufa.php?addr="+email;	
	}
</script>
