<form action="select.php" method="post">
	请选择学校:
	<select name = "school[]" id="school">
		<option name="s_all" selected="selected">all</option>
		<option name="s_cqupt">cqupt</option>
		<option name="s_cqu">cqu</option>
		<option name="s_swu">swu</option>
		<option name="s_pku">pigking university</option>
	</select>
	</br>
	请选择专业: 
	<select name = "major[]" id = "major">
		<option name="m_all" selected="selected">all</option>
		<option name="m_sci">sci</option>
		<option name="m_com">Communication</option>
		<option name="m_auto">Automation</option>
		<option name="m_eng">English</option>
	</select>
	</br>
	请选择学位: 
	<select name = "degree[]" id = "degree">
		<option name="d_all" selected="selected">all</option>
		<option name="d_under">undergraduate</option>
		<option name="d_doctor">doctor</option>
	</select>
	</br>
	是否完成问卷: 
	<select name = "finish[]" id = "finish">
		<option name="f_all" selected="selected">all</option>
		<option name="f_y">Y</option>
		<option name="f_n">N</option>
	</select>
	</br>
	<input type="submit" name="submit"  value="查询" />
</form>
<button id="first" onclick="return_main()">返回主界面</button>
<script>
	function return_main()
	{
		window.location.href="../index.php";	
	}
</script>
