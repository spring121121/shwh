<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="viewport" content="width=devic-width,initial-scale=1.0,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no" />
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
        <section>   
            <div id="museum_shop">
                <div class="museum_shop_left">
                    <div class="museum_shop_pic">
                        <div onclick="handletowork()">
                           <!-- <a href="designerd/designerd_works.html">-->
                                <img src="/images/a3.jpg" alt="">
                            </a>      
                        </div>
                        <div>
                            <h3>作品名字</h3>
                            <h5>作品描述</h5>
                            <h4>
                                <span><img src="/images/a4.jpg"/></span>
                                <p>
                                    <i>152222</i>
                                    <em class="iconfont icon-dianzan"></em>
                                </p>
                               
                            </h4>
                        </div>
                    </div>
                    <div class="museum_shop_pic">
                        <div onclick="handletowork()">
                            <img src="/images/a3.jpg" alt="">
                        </div>
                        <div>
                            <h3>作品名字</h3>
                            <h5>作品描述</h5>
                            <h4>
                               <span><img src="/images/a4.jpg"/></span>
                                <p>
                                    <i>152222</i>
                                    <em  class="iconfont icon-dianzan"></em>
                                </p>
                                
                            </h4>
                        </div>
                    </div>
                    <div class="museum_shop_pic">
                        <div onclick="handletowork()">
                            <img src="/images/a3.jpg" alt="">
                        </div>
                        <div>
                            <h3>作品名字</h3>
                            <h5>作品描述</h5>
                            <h4>
                               <span><img src="/images/a4.jpg"/></span>
                                <p>
                                    <i>152222</i>
                                    <em  class="iconfont icon-dianzan"></em>
                                </p>
                                
                            </h4>
                        </div>
                    </div>
                    <div class="museum_shop_pic">
                        <div onclick="handletowork()">
                            <img src="/images/a3.jpg" alt="">
                        </div>
                        <div>
                            <h3>作品名字</h3>
                            <h5>作品描述</h5>
                            <h4>
                               <span><img src="/images/a4.jpg"/></span>
                                <p>
                                    <i>152222</i>
                                    <em  class="iconfont icon-dianzan"></em>
                                </p>
                                
                            </h4>
                        </div>
                    </div>
                </div>
                <div class="museum_shop_right">
                    <div class="museum_shop_pic">
                        <div onclick="handletowork()">
                            <img src="/images/a1.jpg" alt="">
                        </div>
                        <div>
                            <h3>作品名字</h3>
                            <h5>作品描述</h5>
                            <h4>
                                <span><img src="/images/a4.jpg"/></span>
                                <p>
                                    <i>152222</i>
                                    <em  class="iconfont icon-dianzan"></em>
                                </p>
                                
                            </h4>
                        </div>
                    </div>
                    <div class="museum_shop_pic">
                        <div onclick="handletowork()">
                            <img src="/images/a1.jpg" alt="">
                        </div>
                        <div>
                            <h3>作品名字</h3>
                            <h5>作品描述</h5>
                            <h4>
                                <span><img src="/images/a4.jpg"/></span>
                                <p>
                                    <i>152222</i>
                                    <em  class="iconfont icon-dianzan"></em>
                                </p>
                                
                            </h4>
                        </div>
                    </div>
                    
                </div>
            </div>
        </section>
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
		function handletowork(){
			window.location.href = "/wap/designW";
			
		}
</script>
</html>


