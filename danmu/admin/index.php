<html>
	<head>
		<meta charset="utf-8"/>
		<title>弹幕控制台</title>
		<script src="../command.js"></script>
		<meta name="viewport" content="width=device-width">
		<style>
			#output{
				position: absolute;
				top:0px;
				left: 0px;
				width: 100%;
				height: calc(100% - 30px);
				font-size: 17px;
				overflow-y: auto;
				word-break:break-word;
				color: #fff;
				margin: 0px;
				background-color: #000;
			}
			#input{
				position: absolute;
				bottom:0px;
				left: 0px;
				width: 100%;
				height: 30px;
				line-height: 30px;
				font-size: 17px;
				color: #fff;
				background-color: #000;
			}
			#output b{
				white-space: pre-line;
			}
			.red{
				color:#ff0000;
			}
			.green{
				color:#00ff00;
			}
			table{
				color: #fff;
				text-align: left;
				word-break: initial;
			}
		</style>
	</head>
	<body>
		<pre id="output"></pre>
		<input id="input" placeholder="在此输入命令" value="addvideo  -t 视频标题 -cv /Upload/Video/1473154249.jpg -url 视频地址 -des 视频描述">
		<script>
		cmd_url="../command.php"; 
		var output=document.querySelector("#output"),
		input=document.querySelector("#input");
		comhistory=[],index=-1;
		function display(con,sign){
			output.innerHTML+=((sign?"":">> ")+con+"\n");
			output.scrollTop = output.scrollHeight;
		}
		var simplecom={
			echo:function(){
				display(transarg(input.value.match(/^echo\s*(.*)$/)[1]));
			},
			clear:function(){
				output.innerHTML="";
			},
			vinfoframe:function(){
				try{
					var id=input.value.match(/^vinfoframe\s(\d+)$/)[1];
					var httpmode=window.location.href.match(/^(.+):\/\//)[1];
					var frameadr=httpmode+"://"+window.location.host+"/videoinfo.php?id="+id;
					display('&lt;iframe src="'+frameadr+'" style="height:60%;width:100%;" allowfullscreen&gt;&lt;/iframe&gt;',true);
				}catch(er){
					display("<span class='red'>参数错误</span>",true);
				}
			}
		}

		function evalcom(){
			//console.log(comhistory)
			var com=input.value;
			index=comhistory.length;
			if(com==""){display("");}
			else{
				comhistory.push(com);
				index++;
				var command=com.split(" ")[0];
				display("<span style='color:#ccc'>"+com+"</span>");
				if(simplecom[command]){
					simplecom[command]();
				}else{
					
					cmd(com,false,function(t){
						display(t,true);
					});
				}
			}
			input.value="";
		}
		display("弹幕简易控制台\n首先使用【login -u 用户名 -p 密码】命令登录，然后可以使用【help】命令查看帮助\n使用【命令 --help】可以看到该命令的用法，但并不是所有命令都写了用法 \n控制台内置命令： \n clear 清空 \n echo 输出字符串 \n vinfoframe 获取某id视频的视频信息页面iframe代码 \n默认服务器命令：(【】中的内容代表适合用在何处) \n adddanmu 【播放器】添加一条弹幕(不建议在控制台使用) \n addvideo 【控制台】添加视频记录 \n backupDB 【控制台】备份数据库 \n cacheplugins 【控制台】合并(更新)插件到缓存文件 \n clearplaycount 【控制台】清除指定id视频的播放数 \n cleardanmu 【控制台】清除某个视频的所有弹幕 \n commands 【控制台】显示所有命令 \n deldanmu 【控制台】使用id删除弹幕 \n delvideo 【控制台】删除视频 \n editvideo 【控制台】修改视频信息 \n findvideo 【控制台】查找视频 \n finddanmu 【控制台】使用正则查找弹幕（谨慎使用 \n getDanmu 【播放器】获取json格式弹幕表 \n getVideo 【播放器】获取视频地址和播放数 \n help 【控制台】查看帮助 \n initdb 【控制台】初始化数据库(表) \n listdanmu 【控制台】列出指定视频的所有弹幕 \n login 【控制台】登录(无help) \n teststr 【控制台】测试命令到服务器后是什么样子(无help) \n updateDB 【控制台】升级数据库");
		input.onkeydown=function(e){
			//console.log(e.keyCode);
			switch(e.keyCode){
				case 13:{
					evalcom();
					break;
				}
				case 40:{
					if(index<comhistory.length-1){
						index++;
						input.value=comhistory[index];
					}
					break;
				}
				case 38:{
					if(index>0){
						index--;
						input.value=comhistory[index];
					}
					break;
				}
			}
		}
		</script>
	</body>
</html>