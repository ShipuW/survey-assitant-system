<?php
@include("../conn.php");
header('Content-type: text/html; charset=utf-8');

function write_ip($ip,$country,$province,$city)
{
	$sql = "insert into get_ip(g_id,ip,country,province,city,time)";
	$sql .= " value('','".$ip."','".$country."','".$province."','".$city."','".time()."')";
	$query = mysql_query($sql) or die("SQL 语句执行失败!");

	$online_log='/var/www/html/project/part2/count.txt';//保存在线人数数据的文件, 
	$timeout=45;//45秒内没有动作，则被认识是掉线 
	$entries=file($online_log);//将文件作为一个数组返回，数组中的每个单元都是文件中相应的一行，包括换行符在内

	$temp=array();
	for($i=0;$i<count($entries);$i++){
		$entry=explode(',',trim($entries[$i]));
		if(($entry[0]!=$ip)&&($entry[4]>time())){
			array_push($temp,$entry[0].','.$country.','.$province.','.$city.','.$entry[4]."\n");//取出其他浏览者的信息,并去掉超时者,保存进$temp 
		}
	}

	array_push($temp,$ip.','.$country.','.$province.','.$city.','.(time()+($timeout))."\n");//更新浏览者的时间 

	$entries=implode('',$temp);

	//写入文件 
	$fp=fopen("/var/www/html/project/part2/count.txt",'w');
	flock($fp,LOCK_EX);//注意 flock() 不能在NFS以及其他的一些网络文件系统中正常工作 
echo "<br>";
	fputs($fp,$entries);
	flock($fp,LOCK_UN);
	fclose($fp);
}
