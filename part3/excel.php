<?php

include '../PHPExcel/Classes/PHPExcel.php';
$excel = new PHPExcel();
$letter = array('A','B','C','D','E','F','F','G');
$tableheader = array('name','email','token','completed','deadline','university','major','degree');
for($i = 0;$i < count($tableheader);$i++) {
	$excel->getActiveSheet()->setCellValue("$letter[$i]1","$tableheader[$i]");
}

//表格数组
$data = unserialize(base64_decode($_POST['array']));

$data_2 = array();
for ($i = 0;$i <= count($data) - 1;$i++) 
{
	for($j = 0;$j<=count($data[$i])-2;$j++)
	{
		if($j == 0)
		{
			$data_2[$i][$j] = $data[$i][0].$data[$i][1];
		}
		else
		{
			$data_2[$i][$j] = $data[$i][$j+1];
		}
	}
}



//填充表格信息
for ($i = 2;$i <= count($data_2) + 1;$i++) 
{
	$j = 0;
	foreach($data_2[$i - 2] as $key=>$value)
	{
		$excel->getActiveSheet()->setCellValue("$letter[$j]$i","$value");
		$j++;
	}
}

//创建Excel输入对象
$write = new PHPExcel_Writer_Excel5($excel);
header("Pragma: public");
header("Expires: 0");
header("Cache-Control:must-revalidate, post-check=0, pre-check=0");
header("Content-Type:application/force-download");
header("Content-Type:application/vnd.ms-execl");
header("Content-Type:application/octet-stream");
header("Content-Type:application/download");;
header('Content-Disposition:attachment;filename="testdata.xls"');
header("Content-Transfer-Encoding:binary");
$write->save('php://output');
?>
