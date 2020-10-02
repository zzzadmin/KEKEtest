<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>学生添加</title>
	<style>
		.error{
				color:red;
				font-size:14px;
		}
		.success{
				color:green;
				font-size:14px;
		}
	</style>
</head>
<body>
	<form onsubmit="return check_all(*);" action="student_action.php?action=add" most="post">
		<table>
			<tr>
				<td>学生名称</td>
				<td>
					<input onblur="check_sname();" name="sname" type="text"><span id="nspan"></span>
				</td>
			</tr>
			<tr>
				<td>手机号</td>
				<td>
					<input onblur="check_stel();" name="stel" type="tel"><span id="tspan"></span>
				</td>
			</tr>
			<tr>
				<td>所在班级</td>
				<td>
					<select name="cid">
						<?php
						//链接数据库
						$link=mysqli_connect('127.0.0.1','root','root','practice');
						//检查通信字符
						mysqli_set_charset($link,'utf8');
						$sql="select * from class";
						//处理结果集
						$result=mysqli_query($link,$sql);
						if ($result) {
							while ($row=mysqli_fetch_assoc($result)) {
								echo "<option value='{$row["cid"]}'>{$row['cname']}</option>";
							}
						}
						?>
					</select>
				</td>
			</tr>
			<tr>
				<td>
					<input type="submit" value="学生添加">
				</td>
				<td></td>
			</tr>
		</table>
	</form>
	<script>
		// alert(111);
		//检测用户名的唯一性
		var flag=false;
		function check_sname(){
			//获得输入框
			var sname=document.getElementsByName('sname')[0];
			//获得提示框
			var npan=document.getElementById('nspan');
			//判断是否为空
			if(sname.value=''){
				//为空
				nspan.innerHTML="<i class='error'>不能为空</i>";
				flag=false;
			}else{
				//验证唯一性
				var xhr=new XMLHttpRequest();
				xhr.onreadystatechange=function(){
					if(xhr.status==200 && xhr.readyState==4){
						if(xhr.responseText==1){
							//可用
							nspan.innerHTML="<i class='error'>可以使用</i>";
							flag=true;
						}else{
							nspan.innerHTML="<i>学生名称已存在</i>";
							flag=false;
						}
					}
				};
				xhr.open('get','student_action.php?action=check_sname&sname='+sname.value);
				xhr.send();
			}
		}
	</script>
</body>
</html>