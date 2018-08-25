<?php
//error_reporting(E_ALL); 
//ini_set('display_errors', '1'); 
if(!defined('InEmpireCMS'))
{
	exit();
}
 
function site_nmnk($input){
	if($input=="telnum"){ 
		switch ($_SERVER['HTTP_HOST'])
		{
		case "4g.jlccbyby.com":  $telnum='0431-81035693';  break;
		case "3g.jlccbyby.com":  $telnum='0431-81035693';  break;
		case "sm.jlccbyby.com":  $telnum='0431-81035693';  break;
		case "4g.jltlbyby.com":  $telnum='0431-81035693';  break;
		case "3g.jltlbyby.com":  $telnum='0431-81035693';  break;
		case "sm.jltlbyby.com":  $telnum='0431-81035693';  break;
		case "wap.jlccbyby.com": $telnum='0431-81035693';  break;
		case "4g.nmgsdnk.com":	 $telnum='400-6222-120';  break;
		
		case "m.nmgsd120.com":	 	$telnum='400-6222-120';  break;
		case "m.nmgszyy.com":	 	$telnum='400-6222-120';  break;
		case "m.nmgsdszyy.com":	 	$telnum='400-6222-120';  break;
		case "sg.nmgsd120.com":	 	$telnum='400-6222-120';  break;
		case "sg.nmgszyy.com":	 	$telnum='400-6222-120';  break;
		case "sm.nmgszyy.com":	 	$telnum='400-6222-120';  break;
		case "sm.nmgsdszyy.com":	$telnum='400-6222-120';  break;
		 
		 
		//default: $pagetitle=$public_r['add_sitetitlenmnk'];
		}
		return $telnum;	
	}elseif($input=="city"){
		switch ($_SERVER['HTTP_HOST'])
		{
		case "4g.jlccbyby.com":  $city='长春市';  break;
		case "3g.jlccbyby.com":  $city='长春市';  break;
		case "sm.jlccbyby.com":  $city='长春市';  break;
		case "4g.jltlbyby.com":  $city='长春市';  break;
		case "3g.jltlbyby.com":  $city='长春市';  break;
		case "sm.jltlbyby.com":  $city='长春市';  break;
		case "wap.jlccbyby.com": $city='长春市';  break;
		case "4g.nmgsdnk.com":	 $city='呼市';  break;
		case "m.nmgsd120.com":	 $city='呼市';  break;
		case "m.nmsd120.com":	 $city='呼市';  break;
		case "sg.nmgsd120.com":	 $city='呼市';  break;
		//default: $pagetitle=$public_r['add_sitetitlenmnk'];
		}
		return $city;
		
	}elseif($input=="xianluchaxun"){
		switch ($_SERVER['HTTP_HOST'])
		{
		case "4g.jlccbyby.com":  $xianluchaxun='/show-13-41.html';  break;
		case "3g.jlccbyby.com":  $xianluchaxun='/show-13-41.html';  break;
		case "sm.jlccbyby.com":  $xianluchaxun='/show-13-41.html';  break;
		case "4g.jltlbyby.com":  $xianluchaxun='/show-13-41.html';  break;
		case "3g.jltlbyby.com":  $xianluchaxun='/show-13-41.html';  break;
		case "sm.jltlbyby.com":  $xianluchaxun='/show-13-41.html';  break;
		case "wap.jlccbyby.com": $xianluchaxun='/show-13-41.html';  break;
		case "4g.nmgsdnk.com":	 $xianluchaxun='/show-13-236.html';  break;
		case "m.nmgsd120.com":	 $xianluchaxun='/show-13-236.html';  break;
		case "m.nmsd120.com":	 $xianluchaxun='/show-13-236.html';  break;
		case "sg.nmgsd120.com":	 $xianluchaxun='/show-13-236.html';  break;
		//default: $pagetitle=$public_r['add_sitetitlenmnk'];
		}
		return $xianluchaxun;
		
	}else{
		if($_SERVER['HTTP_HOST']=="4g.nmgsdnk.com" || $_SERVER['HTTP_HOST']=="m.nmgsd120.com" || $_SERVER['HTTP_HOST']=="m.nmsd120.com" || $_SERVER['HTTP_HOST']=="sg.nmgsd120.com" || $_SERVER['HTTP_HOST']=="cctlsj.nmgsd120.com"  || $_SERVER['HTTP_HOST']=="m.nmgszyy.com" || $_SERVER['HTTP_HOST']=="m.nmgsdszyy.com"){return true;}
		else{return false;}
	}
}
//-------- 编码转换
function DoWapIconvVal($str){
	global $ecms_config,$iconv,$pr;
	if($ecms_config['sets']['pagechar']!='utf-8')
	{
		$char=$ecms_config['sets']['pagechar']=='big5'?'BIG5':'GB2312';
		$targetchar=$pr['wapchar']?'UTF8':'UNICODE';
		$str=$iconv->Convert($char,$targetchar,$str);
	}
	return $str;
}

//-------- 提示信息
function DoWapShowMsg($error,$returnurl='index.php',$ecms=0){
	global $empire,$public_r;
	$gotourl=str_replace('&amp;','&',$returnurl);
	if(strstr($gotourl,"(")||empty($gotourl))
	{
		if(strstr($gotourl,"(-2"))
		{
			$gotourl_js="history.go(-2)";
			$gotourl="javascript:history.go(-2)";
		}
		else
		{
			$gotourl_js="history.go(-1)";
			$gotourl="javascript:history.go(-1)";
		}
	}
	else
	{$gotourl_js="self.location.href='$gotourl';";}
	if($ecms==9)//弹出对话框
	{
		echo"<script>alert('".$error."');".$gotourl_js."</script>";
	}
	elseif($ecms==7)//弹出对话框并关闭窗口
	{
		echo"<script>alert('".$error."');window.close();</script>";
	}
	else
	{
		@include(ECMS_PATH.'e/wap/message.php');
	}
	db_close();
	$empire=null;
	exit();
}

//-------- 头部
function DoWapHeader($title){
	global $ecms_config;
	ob_start();
	//header("Content-type: text/vnd.wap.wml; charset=utf-8"); 
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="gb2312">
<meta name="viewport" content="width=device-width,initial-scale=1.0,maximum-scale=1.0,minimum-scale=1.0,user-scalable=no"/>
<meta http-equiv="pragma" content="no-cache" />
<meta name="format-detection" content="telephone=no" />
<title><?=$title?> <?=ewap_ReturnSiteName()?></title>
<link href="/css/phonecommon.css?a=11" type="text/css" rel="stylesheet"/> 


<base target="_blank">
</head>

<body>

<header>
    <div align="center"><img src="/images/top.png"></div>
    <nav>
        <ul>
            <li><a href="/">首页</a></li>
            <li><a href="/yy/jj/">医院介绍</a></li>
            <li><a href="/yy/zj/">专家团队</a></li>
            <li><a href="javascript:void(0)" style="cursor:pointer;" onClick="openZoosUrl('chatwin','');return false;">病情分析</a></li>
            <li><a href="javascript:void(0)" style="cursor:pointer;" onClick="openZoosUrl('chatwin','');return false;">联系我们</a></li>
        </ul>
    </nav>
    <div class="banner" id="banner">
        <div class="ban_t"><span></span><span></span><span></span><span></span><span></span></div>
        <div class="ban_c">  
            <div align="center"><a href="javascript:void(0)" style="cursor:pointer;" onClick="openZoosUrl('chatwin','');return false;"><img src="http://m.nmgsd120.com/images/banner_bp.jpg"></a></div>		
            <div align="center"><a href="javascript:void(0)" style="cursor:pointer;" onClick="openZoosUrl('chatwin','');return false;"><img src="http://m.nmgsd120.com/images/banner_knk51.jpg"></a></div>		   
		    <div align="center"><a href="javascript:void(0)" style="cursor:pointer;" onClick="openZoosUrl('chatwin','');return false;"><img src="http://m.nmgsd120.com/img/banner_2018.jpg"></a></div>	
            <div align="center"><a href="/yy/jj/"><img src="/images/banner_613_2.jpg"></a></div>

            <!--<div align="center"><a href="/yy/zj/"><img src="/images/banner2.jpg"></a></div>

            <div align="center"><a href="/banner/view-62-285.html"><img src="/images/banner1.jpg"></a></div>-->

			<div align="center"><a href="javascript:void(0)" style="cursor:pointer;" onClick="openZoosUrl('chatwin','');return false;"><img src="/img/ban2.jpg"></a></div> 
			
			<!--<div align="center"><a href="javascript:void(0)" style="cursor:pointer;" onClick="openZoosUrl('chatwin','');return false;"><img src="/img/ban1.jpg"></a></div> -->
        </div>
    </div>

</header>
	<script language="javascript">
document.writeln('<script src="/js/jquery.js"><\/script>                                                                ');
document.writeln('<script type="text/javascript" src="/js/query.php" charset="utf-8"><\/script>                         ');
document.writeln('<script src="/js/phonecommon.js"><\/script>                                                           ');
document.writeln('<script type="text/javascript" src="/js/main.js"><\/script>                                           ');
//document.writeln('<script language="javascript" src="http://pht.zoosnet.net/JS/LsJS.aspx?siteid=PHT47524954"><\/script>');
</script> 
    <script type="text/javascript">
		phonecommon({
			id: "#banner",
			titkj: ".ban_t span",
			contkj: ".ban_c",
			xiaoguo: "leftauto",
			autoplay: true,
			cxtime: 200,
			jgtime: 3000,
			morenindex: 0,
			tjclass: "hover",
			autopage: false,
			leftarr: "",
			rightarr: "",
			showpage: ".showpage",
			arrauto: "false",
			startfn: null,
			endfn: null,
			changeload: null		
		});
	</script> 
<?php
}

//-------- 尾部
function pub_keshijieshao(){
?>

<div class="remen_wt">
<h1 class="xz_gybiaoti"><a  href="javascript:void(0)"  onclick="openswt();return false;"   target="_blank">在线咨询&gt;&gt;</a><span><img src="/template/1/images/mingyizj_pic1.png"></span>科室介绍</h1>

<div class="bzlb_kesjs">
<div class="titleinfo">
<?php if($_SERVER['HTTP_HOST']=="sm.jlccbyby.com" || $_SERVER['HTTP_HOST']=="sm.jltlbyby.com" || $_SERVER['HTTP_HOST']=="wap.jlccbyby.com" || $_SERVER['HTTP_HOST']=="4g.jlccbyby.com" || $_SERVER['HTTP_HOST']=="3g.jlccbyby.com" || $_SERVER['HTTP_HOST']=="4g.jltlbyby.com" || $_SERVER['HTTP_HOST']=="3g.jltlbyby.com"){ ?>
	<img src="/template/1/images/listimg.jpg">
<?php }elseif(site_nmnk('')){ ?>
<img src="/template/1/img_nmnk/listimg.jpg">
<?php } ?>
	<p><?php echo ewap_ReturnSiteName(); ?>是经卫生部门批准成立的男性疾病科研医院，集治疗、科研、预防、保健、康复为一体的两性疾病医院。医院设立阳痿、早泄、性交障碍
	<a href="/show-3-1.html" target="_blank">...详细</a></p>
	
</div>

<div class="listzxicon">
<a  href="javascript:void(0)"  onclick="openswt();return false;"   target="_blank"><div class="listicon1">费用估算</div></a>
<a  href="javascript:void(0)"  onclick="openswt();return false;"   target="_blank" ><div class="listicon2">病情查询</div></a>
<a href="tel:<?=ewap_ReturnTelNum()?>"><div class="listicon3">电话问诊</div></a>
<a href="<?=site_nmnk('xianluchaxun');?>" target="_blank" ><div class="listicon4">线路查询</div></a>
</div>

</div>

</div>
<div class="blank2"></div>
<div class="blank"></div>
<div class="bzlb_pdbq">
<h1 class="xz_gybiaoti"><span><img src="/template/1/images/mingyizj_pic1.png"></span>性功能障碍主诊专家</h1>

		<?php if($_SERVER['HTTP_HOST']=="sm.jlccbyby.com" || $_SERVER['HTTP_HOST']=="sm.jltlbyby.com" || $_SERVER['HTTP_HOST']=="wap.jlccbyby.com" || $_SERVER['HTTP_HOST']=="4g.jlccbyby.com" || $_SERVER['HTTP_HOST']=="3g.jlccbyby.com" || $_SERVER['HTTP_HOST']=="4g.jltlbyby.com" || $_SERVER['HTTP_HOST']=="3g.jltlbyby.com"){ ?>
<div class="zj_list">
	<div class="zj_list_1">
		<a href="/show-4-132.html" target="_blank" ><img src="/template/1/images/zjlist1.png"></a>
		<p>纪伟宁 主任</p>
		<p>中国性学会理事</p>
		<div class="zjlist_zx"><a  href="javascript:void(0)"  onclick="openswt();return false;"   target="_blank">在线咨询</a></div>
	</div>
	<div class="zj_list_1 marg">
		<a href="/show-4-133.html" target="_blank" ><img src="/template/1/images/zjlist2.png"></a>
		<p>黄栋 主任</p>
		<p>中国性学会理事</p>
		<div class="zjlist_zx bjblue"><a href="tel:<?=ewap_ReturnTelNum()?>">电话问诊</a></div>
	</div>
</div>
		<?php }elseif(site_nmnk('')){ ?>
<div class="zj_list">
	<div class="zj_list_1">
		<a href="/show-60-236.html" target="_blank" ><img src="/template/1/img_nmnk/zj1.jpg"></a>
		<p>李龙榜 主任</p>
		<p>中国性学会理事</p>
		<div class="zjlist_zx"><a  href="javascript:void(0)"  onclick="openswt();return false;"   target="_blank" >在线咨询</a></div>
	</div>
	<div class="zj_list_1 marg">
		<a href="/show-60-237.html" target="_blank" ><img src="/template/1/img_nmnk/zj2.jpg"></a>
		<p>石永胜 主任</p>
		<p>中国性学会理事</p>
		<div class="zjlist_zx bjblue"><a href="tel:<?=ewap_ReturnTelNum()?>">电话问诊</a></div>
	</div>
</div>
		<?php }else{ ?>
		 
<div class="zj_list">
	<div class="zj_list_1">
		<a href="/show-4-132.html" target="_blank" ><img src="/template/1/images/zjlist1.png"></a>
		<p>纪伟宁 主任</p>
		<p>中国性学会理事</p>
		<div class="zjlist_zx"><a href="javascript:void(0)"  onclick="openswt();return false;"   target="_blank">在线咨询</a></div>
	</div>
	<div class="zj_list_1 marg">
		<a href="/show-4-133.html" target="_blank" ><img src="/template/1/images/zjlist2.png"></a>
		<p>黄栋 主任</p>
		<p>中国性学会理事</p>
		<div class="zjlist_zx bjblue"><a href="tel:<?=ewap_ReturnTelNum()?>">电话问诊</a></div>
	</div>
</div>
		<?php } ?> 

</div>

<div class="blank"></div>

<h1 class="xz_gybiaoti"><span><img src="/template/1/images/mingyizj_pic1.png"></span>
<?php if($_SERVER['HTTP_HOST']=="sm.jlccbyby.com" || $_SERVER['HTTP_HOST']=="sm.jltlbyby.com" || $_SERVER['HTTP_HOST']=="wap.jlccbyby.com" || $_SERVER['HTTP_HOST']=="4g.jlccbyby.com" || $_SERVER['HTTP_HOST']=="3g.jlccbyby.com" || $_SERVER['HTTP_HOST']=="4g.jltlbyby.com" || $_SERVER['HTTP_HOST']=="3g.jltlbyby.com"){ ?>
学术荣誉·引领东北地区学术巅峰
<?php }elseif(site_nmnk('')){ ?>
学术荣誉·引领男科学术巅峰
<?php } ?>


</h1>
<div class="bzlb_rongyu">

<?php if($_SERVER['HTTP_HOST']=="sm.jlccbyby.com" || $_SERVER['HTTP_HOST']=="sm.jltlbyby.com" || $_SERVER['HTTP_HOST']=="wap.jlccbyby.com" || $_SERVER['HTTP_HOST']=="4g.jlccbyby.com" || $_SERVER['HTTP_HOST']=="3g.jlccbyby.com" || $_SERVER['HTTP_HOST']=="4g.jltlbyby.com" || $_SERVER['HTTP_HOST']=="3g.jltlbyby.com"){ ?>
<div class="yw_ry"><img src="/template/1/images/yw_ry1.jpg"></div>
<div class="yw_ry"><img src="/template/1/images/yw_ry2.jpg"></div>
<div class="yw_ry1">
	<div class="yw_ry1_1"><img src="/template/1/images/yw_ry3.jpg"> <p>2013年中国男科医学大会<br>阳痿三度分型疗法</p> </div>
	<div class="yw_ry1_1"><img src="/template/1/images/yw_ry4.jpg"><p>CUA2015全国微创<br>泌尿外科专题会议</p> </div>
	<div class="yw_ry1_1" style="margin-right:0;"><img src="/template/1/images/yw_ry5.jpg"> <p>2013长春 · 台湾男科诊疗<br>技术新进展研讨会</p> </div>
</div>
<?php }elseif(site_nmnk('')){ ?>
<div class="yw_ry"><img src="/template/1/img_nmnk/yw_ry1.jpg"></div>
<div class="yw_ry"><img src="/template/1/img_nmnk/yw_ry2.jpg"></div>
<div class="yw_ry1">
	<div class="yw_ry1_1"><img src="/template/1/images/yw_ry3.jpg"> <p>2013年中国男科医学大会<br>阳痿三度分型疗法</p> </div>
	<div class="yw_ry1_1"><img src="/template/1/images/yw_ry4.jpg"><p>CUA2015全国微创<br>泌尿外科专题会议</p> </div>
	<div class="yw_ry1_1" style="margin-right:0;"><img src="/template/1/images/yw_ry5.jpg"> <p>2013呼市 · 台湾男科诊疗<br>技术新进展研讨会</p> </div>
</div>
<?php } ?>

<div class="swttel_tel"><!--<img src="/template/1/images/yw_zx2.jpg" style="margin:0.5rem auto 1rem auto;    background: url(images/yw_zx2.jpg) center no-repeat; height: 71px;">-->
<a href="javascript:void(0);" onclick="openswt();return false;" class="s_dw_tel1"></a>
<a href="tel:<?=ewap_ReturnTelNum()?>" class="s_dw_tel2"></a>
</div>
</div>

<div class="blank"></div>
<div class="zzghtl"><a href="javascript:void(0)"  onclick="openswt();return false;"   target="_blank"> <img src="/template/1/images/zzgh.jpg"></a></div>

<div class="ghpt_list">
    <div class="yw_yylg"
	<?php if($_SERVER['HTTP_HOST']=="sm.jlccbyby.com" || $_SERVER['HTTP_HOST']=="sm.jltlbyby.com"){ ?>
		style="background: url(/template/1/images/yygh2.jpg) 0px 0.1rem no-repeat;background-size: 24.25rem 6.2rem;"
	<?php }elseif(site_nmnk('')){ ?>
		style="background: url(/template/1/img_nmnk/yygh1.jpg) 0px 0.1rem no-repeat;background-size: 24.25rem 6.2rem;"
		<?php } ?>>
	</div>
 
   <div class="zxgh">
      <ul>
        <li><a href="tel:<?=ewap_ReturnTelNum()?>" class="dhzxts">电话咨询</a></li>
        <li><a onclick="openswt();return false;" href="javascript:void(0);return false;" class="zxzxts">在线咨询</a></li>
        <li><a href="javascript:void(0);return false;" onclick="openswt();return false;" class="yyghts">预约挂号</a></li>
      </ul>
    </div>
    <div class="bddh">
      <p>手机打字不方便吗？输入手机号免费电话沟通</p>
      <div class="bddhs">
        <input name="vtel" id="vtel" placeholder="请输入手机号码" class="telinput" value="" type="text">
        <input name="cbBtn" id="cbBtn" value="" class="submit1" type="button">
      </div>
      <div class="dunpai">
        <p><span style="color:#0B6FD3;">该网页已加密</span>,请准确填写您的电话号码。<br>
          我院严格执行保密机制,<span style="color:#ff9900;">保证患者隐私安全。</span></p>
      </div>
    </div>
</div>

<?php
}
function btm_zj(){
?>

        <div class="sx_box"><div class="sx_title"><img src="/images/nr/sx_title3.png"/></div></div>
        <div class="sx_xg" id="sx_xg">
            <div class="sx_xg_tit">
                <ul>
                    <li>赵明</li>
                    <li>张友成</li>
                    <li>李永福</li>
                    <li>杨睿</li>
                </ul>
            </div>
            <div class="sx_xg_con">
                <ul>
                    <li> <i><img src="/images/yy/sx_xg_pic1.jpg"/></i>
                        <h2><span>赵明</span>主治医师</h2>
                        <p><span>状态：<b>在线</b></span>访问率：<b>8652</b></p>
                        <p>临床经验：10余年</p>
                        <p class="aaaaaa">擅长：前列腺炎、前列腺增生等。</p>
                        <h3><a href="tel:400-6222-120">专家热线：400-6222-120</a></h3>
                    </li>
                    <li> <i><img src="/img/zjabc.jpg"/></i>
                        <h2><span>张友成</span>主治医师</h2>
                        <p><span>状态：<b>在线</b></span>访问率：<b>7874</b></p>
                        <p>临床经验：20余年</p>
                        <p class="aaaaaa">擅长：泌尿系感染、前列腺疾病等。</p>
                        <h3><a href="tel:400-6222-120">专家热线：400-6222-120</a></h3>
                    </li>
                    <li> <i><a href="/yy/zj/view-60-255.html"><img src="/img/zj2.jpg"/></a></i>
                        <h2><span>李永福</span>主治医师</h2>
                        <p><span>状态：<b>在线</b></span>访问率：<b>7635</b></p>
                        <p>临床经验：20余年</p>
                        <p class="aaaaaa">擅长：男性生殖感染、前列腺炎等。</p>
                        <h3><a href="tel:400-6222-120">专家热线：400-6222-120</a></h3>
                    </li>
                    <li> <i><img src="/images/nr/sx_xg_pic4.jpg"/></i>
                        <h2><span>杨睿</span>主治医师</h2>
                        <p><span>状态：<b>在线</b></span>访问率：<b>7239</b></p>
                        <p>临床经验：20余年</p>
                        <p class="aaaaaa">擅长：性功能障碍、前列腺炎等。</p>
                        <h3><a href="tel:400-6222-120">专家热线：400-6222-120</a></h3>
                    </li>
                </ul>
            </div>
        </div>
        <script type="text/javascript">
		phonecommon({
			id: "#sx_xg",
			titkj: ".sx_xg_tit li",
			contkj: ".sx_xg_con ul",
			xiaoguo: "leftauto",
			autoplay: true,
			cxtime: 200,
			jgtime: 300000,
			morenindex: 0,
			tjclass: "hover",
			autopage: false,
			leftarr: "",
			rightarr: "",
			showpage: ".showpage",
			arrauto: "false",
			startfn: null,
			endfn: null,
			changeload: null		
		});
	</script>
        <div class="sx_bot">
            <ul>
                <li><a href="javascript:void(0)" style="cursor:pointer;" onClick="openZoosUrl('chatwin','');return false;"><i><img src="/images/nr/sx_bot_ic1.png"/></i>
                    <p>私密解答</p>
                    </a></li>
                <li><a href="tel:400-6222-120"><i><img src="/images/nr/sx_bot_ic2.png"/></i>
                    <p>电话预约</p>
                    </a></li>
                <li><a href="javascript:void(0)" style="cursor:pointer;" onClick="openZoosUrl('chatwin','');return false;"><i><img src="/images/nr/sx_bot_ic3.png"/></i>
                    <p>网上挂号 </p>
                    </a></li>
            </ul>
        </div>


<?php
}
function DoWapGuahao(){
?>
	


        	<script>
			function ignoreSpaces(string){var temp="";string=''+string;splitstring=string.split(" ");for(i=0;i<splitstring.length;i++)temp+=splitstring[i];return temp}
			function $iv(id){return document.getElementById(id).value;}
			function $id(id){return document.getElementById(id);}			
			function check() {		
				if ($iv("name")==""||$iv("name")=="输入您的真实姓名"){alert("请输入您的真实姓名");$id("name").focus();return false}
				if ($iv("contacts")==""||$iv("contacts")=="输入您的手机号码"){alert("请输入您的手机号码");$id("contacts").focus();return false}
				if(!$iv("contacts").match(/^^\d{11}$/)) {alert('手机号码输入有误');return false;}			
			}
			</script>
            <form id="gh_form" name="gh_form" onSubmit="javascript:return check();" target="_blank" autocomplete="off" method="post" action="/plus/mail/">
                <ul>
                    <li>
                        <p class="mt20">
                            <label>*</label>
                            就诊姓名</p>
                        <p class="mt10">
                            <input type="text" name="name" id="name" placeholder="请输入您的姓名" onBlur="this.value=ignoreSpaces(this.value);" />
                        </p>
                    </li>
                    <li>
                        <p class="mt20">
                            <label>*</label>
                            联系电话</p>
                        <p class="mt10">
                            <input type="text" id="contacts" name="contacts"  placeholder="请输入您的联系电话" onBlur="this.value=ignoreSpaces(this.value);" />
                        </p>
                    </li>
                    <li>
                        <p class="mt20">
                            <label>*</label>
                            病情描述</p>
                        <p class="mt10">
                            <textarea rows="3" id="remarks" name="remarks"  placeholder="请输入您要描述的病情"></textarea>
                        </p>
                    </li>
                    <li>
                        <p class="txc mt10">
                            <label>注：本网站已加密，较好保障个人隐私。</label>
                        </p>
                    </li>
                    <li>
                        <p class="txc">
                            <input type="hidden" name="webname" value="内蒙首大男科新手激战" />
                            <input type="hidden" name="weburl" id="weburl" value="/">
                            <script type="text/javascript">var weburl = document.domain; document.getElementById("weburl").value = "http://"+weburl;</script>
                            <input type="reset" value="重新填写" class="tjan2" />
                            <input type="submit" value="加密提交" class="tjan"  id=gh_submit name=gh_submit />
                        </p>
                    </li>
                </ul>
            </form>
 
	
	
<?php	
}


//-------- 尾部
function DoWapFooter(){
?>
 

<footer>
	<div class="fot">
		<h3><p>诊断时间： <br>
 08:00-17:30 </p></h3>
		<h3><p>来院地址： <br>
 呼和浩特市赛罕区锡林郭勒南路90号 </p></h3>
		<h3><p>医疗广告审查证明文号：<br>
 (呼市)医广【2017】第01-03-02号 </p></h3>
 <!--		<h4><span><a href="/view-13-236.html"><img src="/images/fot_pic1.png"></a></span><span><a href="/yy/jj/"><img src="/images/fot_pic2.png"></a></span></h4> -->
	</div>
	<div style="color:#666;text-align:center;"><h3><p>统一社会信用代码:1150105MA0MYPN58Y<br><a href="/pub_res/nmsdnk/yingyezhizhao.jpg" target="_blank">【营业执照】</a> </p></h3></div>

</footer> 
<style type="text/css">
/* position: fixed; bottom: 0;  */
  .swt_b{position:relative;width: 100%;min-width:320px;max-width:640px;left: 50%; transform:translate(-50%,0);-webkit-transform:translate(-50%,0);-moz-transform:translate(-50%,0);-ms-transform:translate(-50%,0);-o-transform:translate(-50%,0);  z-index: 100; }
  .swt_b img{display: block;width: 100%;}
  .swt_b a{position: absolute;display: block;bottom: 0;height: 100%;}
  .swt_b a:nth-of-type(1){width: 25%;left: 0;}
  .swt_b a:nth-of-type(2){width: 25%;left: 25%;}
  .swt_b a:nth-of-type(3){width: 25%;right: 25%;}
  .swt_b a:nth-of-type(4){width: 25%;right: 0;}
  .swt_b a .swtIcon_Counter{width: 100%;height: 100%;display: block;font-size: 100%;text-align:left;padding-left: 24%;padding-top: 6%;color: #fff;}
</style>
<!-- <div class="swt_b">
  <img src="/swt/img_nmnk/swt_btm.gif">
  <a href="javascript:void(0)" onclick="openZoosUrl();return false;"></a>
  <a href="tel:400-6222-120"></a>
  <a href="javascript:void(0)" onclick="showDiv();"></a>
  <a href="/"></a>
</div> -->
<script type="text/javascript" src="/swt/swt_nmnk.js?a=2"></script>
 
</body>
</html>
<?php
	$str=ob_get_contents();
	ob_end_clean();
	echo DoWapIconvVal($str);
}

//-------- 分页
function DoWapListPage($num,$line,$page,$search,$classid){
//<div class="lby_news_but_l"><a href="javascript:void(0)" onclick="openZoosUrl();return false;" target="_blank">上一页</a></div>
//<div class="lby_news_but_c">1/200</div>
//<div class="lby_news_but_r"><a href="javascript:void(0)" onclick="openZoosUrl();return false;" target="_blank">下一页</a></div>
	if(empty($num))
	{
		return '';
	}
	$str='';
	$pagenum=ceil($num/$line);
	$search=RepPostStr($search,1);
	$phpself=eReturnSelfPage(0);
 
		//$str.="<li><a href=\"".$phpself."?page=0".$search."\">首页</a></li>";
		  $str.="<li><a href=\"list-".$classid."-0.html"."\">首页</a></li>";
 
	if($page)
	{
		//$str.="<li><a href=\"".$phpself."?page=".($page-1).$search."\">上一页</a></li>";  //静态化前list.php?page=1&classid=1
		  $str.="<li><a href=\"list-".$classid."-".($page-1).".html"."\">上一页</a></li>";
	} 
	$str.="<li style='text-align:center;line-height: 2em;color:#333'>".($page+1)."/".$pagenum."</li>";
 
	if($page!=$pagenum-1)
	{
		//$str.="<li><a href=\"".$phpself."?page=".($page+1).$search."\">下一页</a></li>";		
		  $str.="<li><a href=\"list-".$classid."-".($page+1).".html"."\">下一页</a></li>";
	} 
		//$str.="<li><a href=\"".$phpself."?page=".($pagenum-1).$search."\">尾页</a></li>";	
		  $str.="<li><a href=\"list-".$classid."-".($pagenum-1).".html"."\">尾页</a></li>";
	return $str;
}

//-------- 替换<p> --------
function DoWapRepPtags($text){	
	if($_SERVER['HTTP_HOST']=='sm.jlccbyby.com' || $_SERVER['HTTP_HOST']=='sm.jltlbyby.com'){
	$text=str_replace(array('"/d/file','"http://jlccbyby.com/d/file','长春天伦性功能康复研究院','长春天伦医院'),array('"http://baidu.jlccbyby.com/d/file','"http://baidu.jlccbyby.com/d/file','长春天伦不孕不育医院','长春天伦不孕不育医院'),$text); 
	}elseif($_SERVER['HTTP_HOST']=="wap.jlccbyby.com" || $_SERVER['HTTP_HOST']=="4g.jlccbyby.com" || $_SERVER['HTTP_HOST']=="3g.jlccbyby.com" || $_SERVER['HTTP_HOST']=="4g.jltlbyby.com" || $_SERVER['HTTP_HOST']=="3g.jltlbyby.com"){
	$text=str_replace(array('"/d/file','"http://jlccbyby.com/d/file','长春天伦性功能康复研究院'),array('"http://baidu.jlccbyby.com/d/file','"http://baidu.jlccbyby.com/d/file','长春天伦医院'),$text); 		
	}else{//内蒙首大生殖医院
	$text=str_replace(array('"/d/file','"http://jlccbyby.com/d/file','/images/listimg.jpg','长春天伦性功能康复研究院','长春天伦医院','长春市','0431-81035693','3191815403'),array('"http://nmnk.nmgsd120.com/d/file','"http://nmnk.nmgsd120.com/d/file','/img_nmnk/listimg.jpg','呼和浩特首大生殖专科医院','呼和浩特首大生殖专科医院','呼市','400-6222-120','1204711199'),$text); 		
	}
	//$text=str_replace(array('<p>','<P>','</p>','</P>'),array('','','<br />','<br />'),$text);
	//$preg_str="/<(p|P) (.+?)>/is";
	//$text=preg_replace($preg_str,"",$text);
	return $text;
}

//-------- 字段属性 --------
function DoWapRepField($text,$f,$field){
	global $modid,$emod_r;
	$modid=(int)$modid;
	if(strstr($emod_r[$modid]['tobrf'],','.$f.','))//加br
	{
		$text=nl2br($text);
	}
	if(!strstr($emod_r[$modid]['dohtmlf'],','.$f.','))//去除html
	{
		$text=ehtmlspecialchars($text);
	}
	return $text;
}

//-------- 去除html代码 --------
function DoWapClearHtml($text){
	$text=stripSlashes($text);
	$text=ehtmlspecialchars(strip_tags($text));
	return $text;
}

//-------- 替换字段内容
function DoWapRepF($text,$f,$field){
	$text=stripSlashes($text);
	$text=DoWapRepPtags($text);
	$text=DoWapRepField($text,$f,$field);
	return $text;
}

//-------- 替换文章内容字段
function DoWapRepNewstext($text){
	$text=stripSlashes($text);
	$text=DoWapRepPtags($text);	
	//$text=DoWapRepIMGsrc($text);
	//$text=preg_replace('/file.*/','ffiillee',$text);
	//$text=preg_replace('/(w+) (d+), (d+)/i','http://jlccbyby.com${1},$3',$text);
	//$text=preg_replace('file\/','jlccbyby.com-fileeeeeeeeee',$text);
	return $text;
}

//-------- 特殊字符去除
function DoWapCode($string){
	$string=str_replace(array('&', '"', '<', '>'), array('&amp;', '&quot;', '&lt;', '&gt;'), $string);
	return $string;
}

//-------- 返回使用模板
function ReturnWapStyle($add,$style){
	global $empire,$dbtbpre,$pr,$class_r;
	$style=(int)$style;
	$styleid=$pr['wapdefstyle'];
	$classid=0;
	if(WapPage=='index')
	{
		$classid=(int)$add['bclassid'];
	}
	
	elseif(WapPage=='list_zj')
	{
		$classid=(int)$add['classid'];
	}
	elseif(WapPage=='list')
	{
		$classid=(int)$add['classid'];
	}
	elseif(WapPage=='show')
	{
		$classid=(int)$add['classid'];
	}
	if($classid&&$class_r[$classid]['tbname'])
	{
		$cr=$empire->fetch1("select wapstyleid from {$dbtbpre}enewsclass where classid='$classid'");
		if($cr['wapstyleid'])
		{
			$styleid=$cr['wapstyleid'];
		}
	}
	if($style&&$styleid==$pr['wapdefstyle'])
	{
		$styleid=$style;
	}
	$sr=$empire->fetch1("select path from {$dbtbpre}enewswapstyle where styleid='$styleid'");
	$wapstyle=$sr['path'];
	if(empty($wapstyle))
	{
		$wapstyle=1;
	}
	return $wapstyle;
}


//----------------- 模板调用区 ------------------

//返回sql语句
function ewap_ReturnBqQuery($classid,$line,$enews=0,$do=0,$ewhere='',$eorder=''){
	global $empire,$public_r,$class_r,$class_zr,$navclassid,$dbtbpre,$fun_r,$class_tr,$emod_r,$etable_r,$eyh_r;
	$navclassid=(int)$navclassid;
	if($enews==24)//按sql查询
	{
		$query_first=substr($classid,0,7);
		if(!($query_first=='select '||$query_first=='SELECT '))
		{
			return "";
		}
		$classid=RepSqlTbpre($classid);
		$sql=$empire->query1($classid);
		if(!$sql)
		{
			echo"SQL Error: ".ReRepSqlTbpre($classid);
		}
		return $sql;
	}
	if($enews==0||$enews==1||$enews==2||$enews==9||$enews==12||$enews==15)//栏目
	{
		if(strstr($classid,','))//多栏目
		{
			$son_r=sys_ReturnMoreClass($classid,1);
			$classid=$son_r[0];
			$where=$son_r[1];
		}
		else
		{
			if($classid=='selfinfo')//显示当前栏目信息
			{
				$classid=$navclassid;
			}
			if($class_r[$classid][islast])
			{
				$where="classid='$classid'";
			}
			else
			{
				$where=ReturnClass($class_r[$classid][sonclass]);
			}
		}
		$tbname=$class_r[$classid][tbname];
		$mid=$class_r[$classid][modid];
		$yhid=$class_r[$classid][yhid];
    }
	elseif($enews==6||$enews==7||$enews==8||$enews==11||$enews==14||$enews==17)//专题
	{
		echo"Error：Change to use e:indexloop";
		return false;
	}
	elseif($enews==25||$enews==26||$enews==27||$enews==28||$enews==29||$enews==30)//标题分类
	{
		if(strstr($classid,','))//多标题分类
		{
			$son_r=sys_ReturnMoreTT($classid);
			$classid=$son_r[0];
			$where=$son_r[1];
		}
		else
		{
			if($classid=='selfinfo')//显示当前标题分类信息
			{
				$classid=$navclassid;
			}
			$where="ttid='$classid'";
		}
		$mid=$class_tr[$classid][mid];
		$tbname=$emod_r[$mid][tbname];
		$yhid=$class_tr[$classid][yhid];
	}
	$query='';
	$qand=' and ';
	if($enews==0)//栏目最新
	{
		$query=' where ('.$where.')';
		$order='newstime';
		$yhvar='bqnew';
    }
	elseif($enews==1)//栏目热门
	{
		$query=' where ('.$where.')';
		$order='onclick';
		$yhvar='bqhot';
    }
	elseif($enews==2)//栏目推荐
	{
		$query=' where ('.$where.') and isgood>0';
		$order='newstime';
		$yhvar='bqgood';
    }
	elseif($enews==9)//栏目评论排行
	{
		$query=' where ('.$where.')';
		$order='plnum';
		$yhvar='bqpl';
    }
	elseif($enews==12)//栏目头条
	{
		$query=' where ('.$where.') and firsttitle>0';
		$order='newstime';
		$yhvar='bqfirst';
    }
	elseif($enews==15)//栏目下载排行
	{
		$query=' where ('.$where.')';
		$order='totaldown';
		$yhvar='bqdown';
    }
	elseif($enews==3)//所有最新
	{
		$qand=' where ';
		$order='newstime';
		$tbname=$public_r[tbname];
		$mid=$etable_r[$tbname][mid];
		$yhvar='bqnew';
		$yhid=$etable_r[$tbname][yhid];
    }
	elseif($enews==4)//所有点击排行
	{
		$qand=' where ';
		$order='onclick';
		$tbname=$public_r[tbname];
		$mid=$etable_r[$tbname][mid];
		$yhvar='bqhot';
		$yhid=$etable_r[$tbname][yhid];
    }
	elseif($enews==5)//所有推荐
	{
		$query=' where isgood>0';
		$order='newstime';
		$tbname=$public_r[tbname];
		$mid=$etable_r[$tbname][mid];
		$yhvar='bqgood';
		$yhid=$etable_r[$tbname][yhid];
    }
	elseif($enews==10)//所有评论排行
	{
		$qand=' where ';
		$order='plnum';
		$tbname=$public_r[tbname];
		$mid=$etable_r[$tbname][mid];
		$yhvar='bqpl';
		$yhid=$etable_r[$tbname][yhid];
    }
	elseif($enews==13)//所有头条
	{
		$query=' where firsttitle>0';
		$order='newstime';
		$tbname=$public_r[tbname];
		$mid=$etable_r[$tbname][mid];
		$yhvar='bqfirst';
		$yhid=$etable_r[$tbname][yhid];
    }
	elseif($enews==16)//所有下载排行
	{
		$qand=' where ';
		$order='totaldown';
		$tbname=$public_r[tbname];
		$mid=$etable_r[$tbname][mid];
		$yhvar='bqdown';
		$yhid=$etable_r[$tbname][yhid];
    }
	elseif($enews==18)//各表最新
	{
		$qand=' where ';
		$order='newstime';
		$tbname=$classid;
		$mid=$etable_r[$tbname][mid];
		$yhvar='bqnew';
		$yhid=$etable_r[$tbname][yhid];
	}
	elseif($enews==19)//各表热门
	{
		$qand=' where ';
		$order='onclick';
		$tbname=$classid;
		$mid=$etable_r[$tbname][mid];
		$yhvar='bqhot';
		$yhid=$etable_r[$tbname][yhid];
	}
	elseif($enews==20)//各表推荐
	{
		$query=' where isgood>0';
		$order='newstime';
		$tbname=$classid;
		$mid=$etable_r[$tbname][mid];
		$yhvar='bqgood';
		$yhid=$etable_r[$tbname][yhid];
	}
	elseif($enews==21)//各表评论排行
	{
		$qand=' where ';
		$order='plnum';
		$tbname=$classid;
		$mid=$etable_r[$tbname][mid];
		$yhvar='bqpl';
		$yhid=$etable_r[$tbname][yhid];
	}
	elseif($enews==22)//各表头条信息
	{
		$query=' where firsttitle>0';
		$order="newstime";
		$tbname=$classid;
		$mid=$etable_r[$tbname][mid];
		$yhvar='bqfirst';
		$yhid=$etable_r[$tbname][yhid];
	}
	elseif($enews==23)//各表下载排行
	{
		$qand=' where ';
		$order='totaldown';
		$tbname=$classid;
		$mid=$etable_r[$tbname][mid];
		$yhvar='bqdown';
		$yhid=$etable_r[$tbname][yhid];
	}
	elseif($enews==25)//标题分类最新
	{
		$query=' where ('.$where.')';
		$order='newstime';
		$yhvar='bqnew';
    }
	elseif($enews==26)//标题分类点击排行
	{
		$query=' where ('.$where.')';
		$order='onclick';
		$yhvar='bqhot';
    }
	elseif($enews==27)//标题分类推荐
	{
		$query=' where ('.$where.') and isgood>0';
		$order='newstime';
		$yhvar='bqgood';
    }
	elseif($enews==28)//标题分类评论排行
	{
		$query=' where ('.$where.')';
		$order='plnum';
		$yhvar='bqpl';
    }
	elseif($enews==29)//标题分类头条
	{
		$query=' where ('.$where.') and firsttitle>0';
		$order='newstime';
		$yhvar='bqfirst';
    }
	elseif($enews==30)//标题分类下载排行
	{
		$query=' where ('.$where.')';
		$order='totaldown';
		$yhvar='bqdown';
    }
	//优化
	$yhadd='';
	if(!empty($eyh_r[$yhid]['dobq']))
	{
		$yhadd=ReturnYhSql($yhid,$yhvar);
		if(!empty($yhadd))
		{
			$query.=$qand.$yhadd;
			$qand=' and ';
		}
	}
	//不调用
	if(!strstr($public_r['nottobq'],','.$classid.','))
	{
		$notbqwhere=ReturnNottoBqWhere();
		if(!empty($notbqwhere))
		{
			$query.=$qand.$notbqwhere;
			$qand=' and ';
		}
	}
	//图片信息
	if(!empty($do))
	{
		$query.=$qand.'ispic=1';
		$qand=' and ';
    }
	//附加条件
	if(!empty($ewhere))
	{
		$query.=$qand.'('.$ewhere.')';
		$qand=' and ';
	}
	//中止
	if(empty($tbname))
	{
		echo "ClassID=<b>".$classid."</b> Table not exists.(DoType=".$enews.")";
		return false;
	}
	//排序
	$addorder=empty($eorder)?$order.' desc':$eorder;
	$query='select '.ReturnSqlListF($mid).' from '.$dbtbpre.'ecms_'.$tbname.$query.' order by '.ReturnSetTopSql('bq').$addorder.' limit '.$line;
	$sql=$empire->query1($query);
	if(!$sql)
	{
		echo"SQL Error: ".ReRepSqlTbpre($query);
	}
	return $sql;
}

//灵动标签：返回SQL内容函数
function ewap_eloop($classid=0,$line=10,$enews=3,$doing=0,$ewhere='',$eorder=''){
	return ewap_ReturnBqQuery($classid,$line,$enews,$doing,$ewhere,$eorder);
}

//灵动标签：返回特殊内容函数
function ewap_eloop_sp($r){
	global $class_r;
	$sr['titleurl']=ewap_ReturnTitleUrl($r);
	$sr['classname']=$class_r[$r[classid]][bname]?$class_r[$r[classid]][bname]:$class_r[$r[classid]][classname];
	$sr['classurl']=ewap_ReturnClassUrl($r);
	return $sr;
}

//返回wap内容页地址
function ewap_ReturnTitleUrl($r){
	global $public_r,$class_r,$ecmsvar_mbr,$wapstyle;
	if(empty($r['isurl']))
	{
		$titleurl='show.php?classid='.$r[classid].'&amp;id='.$r[id].'&amp;style='.$wapstyle.'&amp;bclassid='.$class_r[$r[classid]][bclassid].'&amp;cid='.$r[classid].'&amp;cpage=0';
	}
	else
	{
		if($public_r['opentitleurl'])
		{
			$titleurl=$r['titleurl'];
		}
		else
		{
			$titleurl=$public_r['newsurl'].'e/public/jump/?classid='.$r['classid'].'&amp;id='.$r['id'];
		}
	}
	return $titleurl;
}

//返回栏目页地址
function ewap_ReturnClassUrl($r){
	global $public_r,$class_r,$ecmsvar_mbr,$wapstyle;
	//外部栏目
	if($class_r[$r[classid]][wburl])
	{
		$classurl=$class_r[$r[classid]][wburl];
	}
	else
	{
		$classurl='list.php?classid='.$r[classid].'&amp;style='.$wapstyle.'&amp;bclassid='.$class_r[$r[classid]][bclassid];
	}
	return $classurl;
}

//返回联系电话
function ewap_ReturnTelNum(){
	global $public_r;
	switch ($_SERVER['HTTP_HOST'])
	{
	case "4g.jlccbyby.com":  $telnum='0431-81035693';  break;
	case "3g.jlccbyby.com":  $telnum='0431-81035693';  break;
	case "sm.jlccbyby.com":  $telnum='0431-81035693';  break;
	case "4g.jltlbyby.com":  $telnum='0431-81035693';  break;
	case "3g.jltlbyby.com":  $telnum='0431-81035693';  break;
	case "sm.jltlbyby.com":  $telnum='0431-81035693';  break;
	case "wap.jlccbyby.com": $telnum='0431-81035693';  break;
	case "4g.nmgsdnk.com":	 $telnum='400-6222-120';  break;
	case "sg.nmgsd120.com":	 $telnum='400-6222-120';  break;
	case "m.nmgsd120.com":	 $telnum='400-6222-120';  break;
	case "m.nmsd120.com":	 $telnum='400-6222-120';  break; 
	default: $pagetitle=$public_r['add_sitetitlenmnk'];
	}
	return $telnum;
}

//返回网站名称
function ewap_ReturnSiteName(){
	global $public_r;
	//if($_SERVER['HTTP_HOST']=='sm.jlccbyby.com' || $_SERVER['HTTP_HOST']=='sm.jltlbyby.com')
	//{
	//	$sitename=$public_r['add_sitename2'];
	//}
	//else
	//{
	//	$sitename=$public_r['sitename'];
	//}
	  switch ($_SERVER['HTTP_HOST'])
{
case "4g.jlccbyby.com":  $sitename=$public_r['sitename'];  break;
case "3g.jlccbyby.com":  $sitename=$public_r['sitename'];  break;
case "sm.jlccbyby.com":  $sitename=$public_r['add_sitename2'];  break;
case "4g.jltlbyby.com":  $sitename=$public_r['sitename'];  break;
case "3g.jltlbyby.com":  $sitename=$public_r['sitename'];  break;
case "sm.jltlbyby.com":  $sitename=$public_r['add_sitename2'];  break;
case "wap.jlccbyby.com": $sitename=$public_r['sitename'];  break;
case "4g.nmgsdnk.com":	 $sitename=$public_r['add_sitetitlenmnk'];  break;
case "sg.nmgsd120.com":	 $sitename=$public_r['add_sitetitlenmnk'];  break;
case "m.nmgsd120.com":	 $sitename=$public_r['add_sitetitlenmnk'];  break;
case "m.nmsd120.com":	 $sitename=$public_r['add_sitetitlenmnk'];  break;
case "m.nmgszyy.com":	 $sitename=$public_r['add_sitetitlenmnk'];  break; 
case "m.nmgsdszyy.com":	 $sitename=$public_r['add_sitetitlenmnk'];  break;
case "m8.nmsd120.com":	 $sitename=$public_r['add_sitetitlenmnk'];  break;
case "m8.nmgsd120.com":	 $sitename=$public_r['add_sitetitlenmnk'];  break;
case "m8.nmgszyy.com":	 $sitename=$public_r['add_sitetitlenmnk'];  break;
case "m8.nmsdszyy.com":	 $sitename=$public_r['add_sitetitlenmnk'];  break;
default: $pagetitle=$public_r['add_sitetitlenmnk'];
}
	return $sitename;
}
//链接附加参数
function ewap_UrlAddCs(){
	global $ecmsvar_mbr;
	$wapstyle=(int)$ecmsvar_mbr['wapstyle'];
	$fbclassid=(int)$ecmsvar_mbr['fbclassid'];
	$fclassid=(int)$ecmsvar_mbr['fclassid'];
	$fcpage=(int)$ecmsvar_mbr['fcpage'];
	$addcs='';
	if($wapstyle)
	{
		$addcs.='&amp;style='.$wapstyle;
	}
	if($fbclassid)
	{
		$addcs.='&amp;bclassid='.$fbclassid;
	}
	if($fclassid)
	{
		$addcs.='&amp;cid='.$fclassid;
	}
	if($fcpage)
	{
		$addcs.='&amp;cpage='.$fcpage;
	}
	return $addcs;
}


$pr=$empire->fetch1("select wapopen,wapdefstyle,wapshowmid,waplistnum,wapsubtitle,wapshowdate,wapchar from {$dbtbpre}enewspublic limit 1");

//导入编码文件
$iconv='';
if($ecms_config['sets']['pagechar']!='utf-8')
{
	@include_once("../class/doiconv.php");
	$iconv=new Chinese('');
}

if(empty($pr['wapopen']))
{
	DoWapShowMsg('网站没有开启WAP功能','index.php');
}

$wapstyle=intval($_GET['style']);
//返回使用模板
$usewapstyle=ReturnWapStyle($_GET,$wapstyle);
if(!file_exists('template/'.$usewapstyle))
{
	$usewapstyle=1;
}
?>