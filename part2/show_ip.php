<?php
$online_log='count.txt';//保存在线人数数据的文件, 
$entries=file($online_log);//将文件作为一个数组返回，数组中的每个单元都是文件中相应的一行，包括换行符在内
$temp=array();
for($i=0;$i<count($entries);$i++){
	$entry=explode(',',trim($entries[$i]));
	if($entry[4]>time())
	{
		array_push($temp,$entry[0].','.$entry[1].','.$entry[2].','.$entry[3].','.$entry[4]."\n");//取出其他浏览者的信息,并去掉超时者,保存进$temp 
	}
}

$users_online=count($temp);//计算在线人数
foreach ($temp as $key => $value) 
{ 
	$key_1 = $key+1;
	echo "The ".$key_1."th :<br>";
	$value = explode(",",$value);
	foreach ($value as $key_2 => $value_2) 
	{
		if($key_2 == 0)
		{
			echo "ip地址: ";
		}
		else if($key_2 == 1)
		{
			echo "国家: ";
		}
		else if($key_2 == 2)
		{
			echo "省份: ";
		}
		else if($key_2 == 3)
		{
			echo "城市: ";
		}
		else if($key_2 == 4)
		{
			echo "访问时间: ";
			$value_2 = date('Y-m-d H:i:s',$value_2-45);
		}
		echo $value_2."<br>";
	}
echo "<br>";
} 
echo "<br>";
echo '当前有'.$users_online.'人在线';
?>
<br>
<button id="first" onclick="return_main()">返回主界面</button>
<script>
	function return_main()
	{
		window.location.href="../index.php";	
	}
</script>
