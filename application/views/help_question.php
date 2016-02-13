<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width,height=device-height,inital-scale=1.0,maximum-scale=1.0,user-scalable=no;" />
    <base href="<?=$this->config->item('base_url')?>assets/" />
    <title>91投房</title>
    <script src="js/jquery-1.8.0.min.js" type="text/javascript" charset="utf-8"></script>
    <style>
        body{margin: 0; padding: 0;}
        div{font-family:"微软雅黑"; }
        p{margin: 0;}
        .cj{ text-align: center;font-size: 1.5em; color: #5095b6;}
        .cj-center span{float: left; color: #2c2c2c;}
        .cj-center span:first-child{display: block; height: 1em; width:0.2em; background:url("images/helps/cj-big.png") no-repeat;
            margin-right: 0.3em; margin-top: 0.25em; margin-left: 1em;}
        .cj-all{width: 90%; height: 18em; margin: 0 auto; margin-top: 2.8em; font-size: .9em;}
        .cj-all div{overflow: hidden; margin-bottom: 2em;}
        .cj-all div i:first-child{ background: url("images/helps/cj-small.png") no-repeat center;}
        .cj-all p{line-height:30px;}
        .cj-all span{color: #585858;}
        .change1{display: block; width: 1em; height: 1em; background-size: 100%; float: left; background: url("images/helps/cj-shousuo.png") no-repeat center;}
        .change2{display: none; width: 1em; height: 1em; background-size: 100%; float: left; background: url("images/helps/cj-copy.png") no-repeat center;}
        .cj-all div i{display: block; width: 1em; height: 1em; background-size: 100%; float: left;}
        .cj-all div span{display: block; width: 90%; float: left;}
        .cj-all div p{display: none; color: #888787; margin-top: .5em;}
    </style>
    <script>
        $().ready(function(){
            $(".cj-1").toggle(function(){
                $(".cj-1 p").css("display","block");
                $("#tupian1").removeClass("change1");
                $("#tupian1").addClass("change2");
            },function(){
                $(".cj-1 p").css("display","none");
                $("#tupian1").removeClass("change2");
                $("#tupian1").addClass("change1");
            })
            $(".cj-2").toggle(function(){
                $(".cj-2 p").css("display","block");
                $("#tupian2").removeClass("change1");
                $("#tupian2").addClass("change2");
            },function(){
                $(".cj-2 p").css("display","none");
                $("#tupian2").removeClass("change2");
                $("#tupian2").addClass("change1");
            })
            $(".cj-3").toggle(function(){
                $(".cj-3 p").css("display","block");
                $("#tupian3").removeClass("change1");
                $("#tupian3").addClass("change2");
            },function(){
                $(".cj-3 p").css("display","none");
                $("#tupian3").removeClass("change2");
                $("#tupian3").addClass("change1");
            })
            $(".cj-4").toggle(function(){
                $(".cj-4 p").css("display","block");
                $("#tupian4").removeClass("change1");
                $("#tupian4").addClass("change2");
            },function(){
                $(".cj-4 p").css("display","none");
                $("#tupian4").removeClass("change2");
                $("#tupian4").addClass("change1");
            })
            $(".cj-5").toggle(function(){
                $(".cj-5 p").css("display","block");
                $("#tupian5").removeClass("change1");
                $("#tupian5").addClass("change2");
            },function(){
                $(".cj-5 p").css("display","none");
                $("#tupian5").removeClass("change2");
                $("#tupian5").addClass("change1");
            })
        })
    </script>
</head>
<body>
<div class="cj">常见问题</div>
<hr color="#5095b6">
<div class="cj-center"><span class="cj-juxing"></span><span>常见问题</span></div>
<div class="cj-all">
    <div class="cj-1"><i></i><span>什么是众筹，为什么要在中国发展众筹?</span><i class="change1" id="tupian1"></i>
        <p></br>众筹 起源于国外的 crowd funding，指的是用团购加预购的方式向公众直接募集项目资金，为融资者提供一个直接面向市场，面向散户的集资方式。中国由于幅员辽阔、市场纵深巨大，传统融资方式旷日持久，且现难以实现融资方与大量投资人之间有效的沟通。而随着中国市场对于各种互联网概念的快速接纳和公众日益增长的投资理财需求，使得众筹拥有了得天独厚的发展空间。互联网金融恰好弥补了传统融资与投资渠道门槛过高，信息不透明，沟通困难的问题。目前已有各类网上货币基金与众筹天使投资平台蓬勃发展，股权和物权众筹也在发展之中。</p>
    </div>
    <div class="cj-2"><i></i><span>在众多房产众筹平台为什么选择91投房？</span><i class="change1" id="tupian2"></i>
        <p></br>&nbsp;&nbsp;&nbsp;在选择投资时，需要兼顾风险、收益的均衡性，不能只看收益。在财富管理领域，有一个共识是，高收益往往伴随着高风险。因此，如果单纯考虑收益，而忽略个别机构可能存在的风险，是不理智的行为。在选择收益的同时，更重要的是要选择有实力、风控措施好的公司，这样才能在确保较高收益的同时把所承担的风险降最低。91投房具有自主研发的高精度数据分析系统，由国内外顶尖的风控师评估风险。凡是在网站出现的项目都是我们的专业团队在众多项目中筛选出来的低风险，高收益的项目。 91投房是国内房地产众筹的领头羊，也是将房产证券化的第一人。</p></div>
    <div class="cj-3"><i></i><span>项目所得收益的钱会回到哪个账户？</span><i class="change1" id="tupian3"></i>
        <p></br>所有的资金交易都会显示在在网站绑定的银行账号中。 即所得收益默认回款到绑定的银行账户中。</p></div>
    <div class="cj-4"><i></i><span>项目投资金额会有限制吗？</span><i class="change1" id="tupian4"></i>
        <p></br>针对不同的项目，我们会根据众筹额度均设有上限和下限，详见每个项目的具体说明。</p></div>
    <div class="cj-5"><i></i><span>91投房和开发商有什么关系？</span><i class="change1" id="tupian5"></i>
        <p></br>91投房不代表地产开发商利益，更不是所谓的开发商马甲。91投房坚持四个字：独立中立。独立才能不偏不倚。91投房地是独立中立的平台，没有开发商控股，更不是开发商倾销存货或用房产做短期现金周转的推手。91投房立足于服务投资人，独立进行审核项目，不受项目方干扰，对项目进行风险评级和初选</p></div>
</div>
</body>
</html>