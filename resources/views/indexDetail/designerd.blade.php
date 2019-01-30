<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="viewport" content="width=device-width,initial-scale=1.0,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>山动-设计师</title>
    <link rel="stylesheet" href="/styles/designerd.css">
    <link rel="stylesheet" type="text/css" href="/font/iconfont2.css"/>
    <link rel="stylesheet" type="text/css" href="/font/iconfont3.css"/>
</head>
<body>
    <div id="home">
        <header>
            <ul>
                <li>
                    <!--<a href="../index.html">
                    </a>-->
                    <span onclick="handleToindex()" class="iconfont icon-ffanhui-"></span>
                </li>
                <li>设计师</li>
                <li>
                    <span class="iconfont icon-sousuo" onclick="gotoSerch()"></span>
                </li>
            </ul>
        </header>
        <div class="bigContainer">
            <div id="museum_shop">
               <ul class="designList">
               	<li class="listContent">
               		<div class="listPeople">
               			<div class="peopleImg" onclick="handleTodetail()">
               				<img src="/images/people.jpg"/>
               		    </div>
               			<div class="peopleText">
               			    <p class="peopleName">詹姆斯</p>
               			    <p class="peopleDetail">设计师.<span class="span">天津</span>.粉丝:<span>666</span></p>
               		    </div>
               		    <div class="peopleBtn">关注</div>
               		</div>
               		<div class="workShow">
               			<img src="/images/a3.jpg"/>
               			<img src="/images/a2.jpg"/>
               		</div>
               	</li>
               	
               	<li class="listContent">
               		<div class="listPeople">
               			<div class="peopleImg" onclick="handleTodetail()">
               				<img src="/images/people2.jpg"/>
               		    </div>
               			<div class="peopleText">
               			    <p class="peopleName">约翰</p>
               			    <p class="peopleDetail">设计师.<span class="span">北京</span>.粉丝:<span>1666</span></p>
               		    </div>
               		    <div class="peopleBtn">关注</div>
               		</div>
               		<div class="workShow">
               			<img src="/images/a3.jpg"/>
               			<img src="/images/a2.jpg"/>
               		</div>
               	</li>
               	
               	<li class="listContent">
               		<div class="listPeople">
               			<div class="peopleImg" onclick="handleTodetail()">
               				<img src="/images/people3.jpg"/>
               		    </div>
               			<div class="peopleText">
               			    <p class="peopleName">闰土</p>
               			    <p class="peopleDetail">设计师•<span class="span">上海</span>•粉丝:<span>66</span></p>
               		    </div>
               		    <div class="peopleBtn">关注</div>
               		</div>
               		<div class="workShow">
               			<img src="/images/a3.jpg"/>
               			<img src="/images/a2.jpg"/>
               		</div>
               	</li>
               </ul>  
            </div>
        </div>
    </div>
</body>
<script type="text/javascript" src="/js/jquery-1.11.0.js" ></script>
<script>
	function handleToindex(){
 		window.location.href = "/wap/index";
 	}
		function gotoSerch(){
			window.location.href = "/wap/designSerch";
		}
		function handleTodetail(){
			window.location.href = "/wap/designW";
			
		}
</script>
</html>


