<?php

function send_mail($email) {
        $url = 'http://sendcloud.sohu.com/webapi/mail.send_template.json';

        $vars = json_encode( array("to" => array($email),
                                   "sub" => array("code" => Array('这是一封测试邮件~'))
                                   )
                );

        $API_USER = 'douyu_test_7OK1vV';
        $API_KEY = 'wMiLcq5qtXr4JyQt';
        $param = array(
            'api_user' => $API_USER,
            'api_key' => $API_KEY,
            'from' => 'sendcloud@sendcloud.org',
            'fromname' => '来自乐乐的测试邮件',
            'substitution_vars' => $vars,
            'template_invoke_name' => 'douyu',
            'subject' => '你好，我是程序猿 乐乐',
            'resp_email_id' => 'true'
        );


        $data = http_build_query($param);

        $options = array(
            'http' => array(
                'method' => 'POST',
                'header' => 'Content-Type: application/x-www-form-urlencoded',
                'content' => $data
        ));
        $context  = stream_context_create($options);
        $result = file_get_contents($url, FILE_TEXT, $context);

        return $result;
}
if(isset($_GET['addr']))
{
	$arr = json_decode(send_mail($_GET['addr']));
	if($arr->message == "success")
	{
		echo "邮件发送成功";
	}
	else
	{
		echo "邮件发送失败";
	}
}
else
{
	echo "非法访问！";
}
?>
