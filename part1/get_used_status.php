<?php
include("../conn.php");
get_used_status();

 function get_used_status(){
  //get the tasks,cpu and memory information
  $fp_tasks = popen('top -b -n 1 | grep -E "^Tasks"',"r");
  $fp_cpu = popen('top -b -n 1 | grep -E "^%Cpu\(s\)"',"r");
  $fp_mem = popen('top -b -n 1 | grep -E "^KiB Mem"',"r");
  $fp_io = popen('iostat -d -k 1 1 | grep -E "^sda"',"r");
  $fp_sw = popen('swapon -s | grep -E "^/dev"',"r");
/********************************************************************/
  //translate those informations into string
  $rs_tasks = "";
  $rs_cpu = "";
  $rs_mem = "";
  $rs_io = "";
  $rs_sw = "";
  while(!feof($fp_tasks)){
   $rs_tasks .= fread($fp_tasks,1024);
  }
  while(!feof($fp_cpu)){
   $rs_cpu .= fread($fp_cpu,1024);
  }
  while(!feof($fp_mem)){
   $rs_mem .= fread($fp_mem,1024);
  }
  while(!feof($fp_io)){
   $rs_io .= fread($fp_io,1024);
  }
  while(!feof($fp_sw)){
   $rs_sw .= fread($fp_sw,1024);
  }
/************************************************************************/
  //clase those $ which point to file
  pclose($fp_tasks);
  pclose($fp_cpu);
  pclose($fp_mem);
  pclose($fp_io);
  pclose($fp_sw);
  $rs_io = preg_replace("/\s(?=\s)/","\\1",$rs_io);//use one space instead of several space
  $rs_sw = preg_replace("/\s(?=\s)/","\\1",$rs_sw);
  $rs_sw = str_replace(" ",",",$rs_sw);
  $rs_sw = str_replace("	",",",$rs_sw);
/********************************************************************/
//translate those strings into arrays
$tasks_info = explode(",",$rs_tasks);//进程 数组
$cpu_info = explode(",",$rs_cpu);  //CPU占有量  数组
$mem_info = explode(",",$rs_mem); //内存占有量 数组
$io_info = split(" ",$rs_io); //io 数组
$sw_info = explode(",",$rs_sw); //swap space 数组
/********************************************************************/
//split those arrays into single digital information
//get tasks imformation
preg_match('|(\d+)|',$tasks_info[0],$tasks_t);    //get total tasks
preg_match('|(\d+)|',$tasks_info[1],$tasks_r);    //get running tasks
preg_match('|(\d+)|',$tasks_info[2],$tasks_s);    //get sleeping tasks
preg_match('|(\d+)|',$tasks_info[3],$tasks_stop);    //get stopped tasks
preg_match('|(\d+)|',$tasks_info[4],$tasks_z);    //get zombie tasks

//get cpu information
preg_match('/(\d+)\.(\d+)/is',$cpu_info[3],$cpu_a); //get the presentage of available cpu

//get memory information
preg_match('|(\d+)|',$mem_info[0],$mem_t);    //get total memory
preg_match('|(\d+)|',$mem_info[1],$mem_u);    //get using menory
preg_match('|(\d+)|',$mem_info[2],$mem_f);    //get free memory
preg_match('|(\d+)|',$mem_info[3],$mem_b);    //get buffer memory

echo "进程信息<br>";
echo "总进程数: ".$tasks_t[0];
echo "<br>";
echo "正在运行的进程: ".$tasks_r[0];
echo "<br>";
echo "睡眠进程: ".$tasks_s[0];
echo "<br>";
echo "被停止的进程: ".$tasks_stop[0];
echo "<br>";
echo "僵尸进程: ".$tasks_z[0];
echo "<br>";
echo "<br>";

echo "cpu信息<br>";
echo "空闲cpu百分比: ".$cpu_a[0]."%";
echo "<br>";
echo "<br>";

echo "内存信息<br>";
echo "总内存: ".$mem_t[0]."k";
echo "<br>";
echo "使用内存: ".$mem_u[0]."k";
echo "<br>";
echo "空闲内存: ".$mem_f[0]."k";
echo "<br>";
echo "缓冲区内存: ".$mem_b[0]."k";
echo "<br>";
echo "<br>";

echo "io信息<br>";
echo "设备每秒的传输次数: ".$io_info[1];
echo "<br>";
echo "读取速率: ".$io_info[2]."k/s";
echo "<br>";
echo "写入速率: ".$io_info[3]."k/s";
echo "<br>";
echo "读取总量: ".$io_info[4]."k/s";
echo "<br>";
echo "写入总量: ".$io_info[5]."k/s";
echo "<br>";
echo "<br>";

echo "交换空间信息<br>";
echo "类型: ".$sw_info[1];
echo "<br>";
echo "尺寸: ".$sw_info[2]."k";
echo "<br>";
echo "占用: ".$sw_info[3];
echo "<br>";
echo "优先级: ".$sw_info[4];
echo "<br>";
echo "<br>";
/********************************************************************/
//检测时间
$fp = popen("date +'%Y-%m-%d %H:%M'","r");
$rs = fread($fp,1024);
pclose($fp);
$detection_time = trim($rs);
  
      echo "检测时间".$detection_time;
  echo "<br>";
echo "<br>";
  
  
  
  
  return array('tasks_running'=>$tasks_t[0],'tasks_using'=>$tasks_r[0],'tasks_sleeping'=>$tasks_s[0],'tasks_stopping'=>$tasks_stop[0],'tasks_zombie'=>$tasks_z[0],'cpu_presentage'=>$cpu_a[0],'memory_total'=>$mem_t[0],'memory_using'=>$mem_u[0],'memory_free'=>$mem_f[0],'memory_buffer'=>$mem_b[0],'io_tps'=>$io_info[1],'io_kB_read_s'=>$io_info[2],'io_kB_wrtn_s'=>$io_info[3],'io_kB_read'=>$io_info[4],'io_kB_wrtn'=>$io_info[5],'sw_type'=>$sw_info[1],'sw_size'=>$sw_info[2],'sw_used'=>$sw_info[3],'sw_priority'=>$sw_info[4],'time_detection'=>$detection_time);
 }

?>
<button id="first" onclick="return_main()">返回主界面</button>
<script>
	function return_main()
	{
		window.location.href="../index.php";	
	}
</script>
