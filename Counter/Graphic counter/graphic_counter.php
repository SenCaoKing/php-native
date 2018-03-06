<?php
session_start();
if(!isset($_SESSION['temp'])){ // 判断$_SESSION['temp']==""的值是否为空,其中的temp为自定义的变量
	if(($fp=fopen("counter.txt","r"))==false){
		echo "打开文件失败！";
	}else{
		$counter=fgets($fp,1024);      // 读取文件中数据
		fclose($fp);			       // 关闭文本文件
		$counter++;					   // 计数器增加1
		$fp=fopen("counter.txt","w");  // 以写的方式打开文本文件
		fputs($fp,$counter);		   // 将新的统计数据增加1
		fclose($fp);				   // 关闭文件
	}
	$_SESSION['temp']=1;
}
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf8" />
<title>图形数字计数器</title>
<style type="text/css">
.style1 {
	font-size: 12px;
}
.style2 {
	color: #FF0000;
}
</style>
</head>
<body bgcolor=#fff leftmargin=0 topmargin=0 marginwidth=0 marginheight=0>

<table width=1003 border=0 cellpadding=0 cellspaceing=0>
	<tr>
		<td><img src="images/bg.jpg" width="1003" height="119" /></td>
	</tr>
	<tr>
		<td height="32" background="images/bg1.jpg">
			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			<span class="style1">您是<span class="style2">第
				<?php
					// 以图形的形式输出文本文件中的数据
					if(($fp=fopen("counter.txt","r"))==false){
						echo "打开文件失败";
					}else{
						$counter=fgets($fp,1024);			// 读取文件中数据
						fclose($fp);						// 关闭文本文件
						$len=strlen($counter);				// 获取字符串的长度
						$str=str_repeat("0",6-$len);		// 获取6-$len个数字0
						for($i=0;$i<strlen($str);$i++){     // 获取变量$str的字符串长度
							$result=$str[$i];
							$result='<img src=images/0.gif />';
							echo $result;					// 循环输出$result的结果
						}
						for($i=0;$i<strlen($counter);$i++){ // 获取字符串的长度
							$result=$counter[$i];
							switch($result){
								// 如果值为"0",则输出0.gif图片
								case "0"; $ret[$i]="0.gif";break;
								case "1"; $ret[$i]="1.gif";break;
								case "2"; $ret[$i]="2.gif";break;
								case "3"; $ret[$i]="3.gif";break;
								case "4"; $ret[$i]="4.gif";break;
								case "5"; $ret[$i]="5.gif";break;
								case "6"; $ret[$i]="6.gif";break;
								case "7"; $ret[$i]="7.gif";break;
								case "8"; $ret[$i]="8.gif";break;
								case "9"; $ret[$i]="9.gif";break;
							}
							echo "<img src=images/".$ret[$i]." . />"; // 输出文本文件中存储的数据
						}
					}
				?>
			位</span>访问本系统的人！</span>
		</td>
	</tr>
	<tr>
		<td height="122" align="center" valign="top" background="images/bg3.jpg">
			<table width="1003" border="0" cellspacing="0" cellpadding="0">
				<tr>
					<td height="20">&nbsp;</td>
					<td height="20">&nbsp;</td>
					<td>&nbsp;</td>
				</tr>
				<tr>
		 			<td width="165" height="110">&nbsp;</td>
		            <td width="671" height="420">
			            <p>&nbsp;&nbsp;<span class="style1">吉林省明日科技有限公司是一家以计算机软件技术为核心的高科技型企业，公司创建于2000年12月，是专业的应</span></p>
			            <p class="style1">用软件开发商和服务提供商。多年来始终致力于行业管理软件开发、数字化出版物开发制作、计算机网络系统综合</p>
			            <p class="style1">应用、行业电子商务网站开发等领域，涉及生产、管理、控制、仓贮、物流、营销、服务等行业。公司拥有软件开</p>
			            <p class="style1">发和项目实施方面的资深专家和学习型技术团队，公司的开发团队不仅是开拓进取的技术实践者，更致力于成为技</p>
			            <p class="style1">术的普及和传播者，并以软件工程为指导思想建立了软件研发和销售服务体系。公司基于长期研发投入和丰富的行</p>
			            <p class="style1">业经验，本着   “ 让客户轻松工作，同客户共同成功 ” 的奋斗目标，努力发挥“ 专业、易用、高效 ” 的产品</p>
			            <p class="style1">优势，竭诚为广大用户提供优质的产品和服务。</p>
			            <p class="style1"><strong>企业宗旨</strong>：为企业服务，打造企业智能管理平台，改善企业的管理与运作过程，提高企业效率，降低管理成本，增</p>
			            <p class="style1">强企业核心竞争力。为企业快速发展提供源动力。</p>
			            <p class="style1"><strong>企业精神</strong>：博学、创新、求实、笃行</p>
			            <p class="style1"><strong>公司理念</strong>：以高新技术为依托，战略性地开发具有巨大市场潜力的高价值的产品。</p>
			            <p class="style1"><strong>公司远景</strong>：成为拥有核心技术和核心产品的高科技公司，在某些领域具有领先的市场地位。</p>
			            <p class="style1"><strong>核心价值观</strong>：永葆创业激情、每一天都在进步、容忍失败，鼓励创新、充分信任、平等交流。</p>
		            </td>
		            <td width="167">&nbsp;</td>
				</tr>
				<tr>
		        	<td height="20">&nbsp;</td>
		            <td height="40" align="center"><span class="style2">网站当前访问量：<?php echo $counter;?></span></td>
		            <td>&nbsp;</td>
	            </tr>
			</table>		
		</td>
	</tr>
	<tr>
		<td><img src="images/bg2.jpg" width=1003 height=48 ></td>
	</tr>
</table>
</body>
</html>