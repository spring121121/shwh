<!doctype html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport"
              content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>首页-商城首页</title>

        <link rel="stylesheet" href="/styles/shop-header.css">
        <link rel="stylesheet" href="/styles/shop.css">
    </head>
    <body>
        <div class="index-header header">
            <div class="common-header-left share-title-text"><a href="/wap/shop">取消</a></div>
            <div class="common-header-right share-title-text">确定</div>
            <h3>上货</h3>
        </div>
        <div class="content-box">
            <div class="shop-cont">
                <div class="shop-img">
                    <img src="/images/collection-img6.jpg" onerror="this.src='/images/collection-img6.jpg'" class="common-img">
                </div>
                <div class="shop-cont-right">
                    <p><strong>商品名称</strong><span>内容详情内容详情内容详情内容详情内容详情内容详情</span></p>
                </div>
            </div>
            <div class="share-setting">
                <div class="ipt-box">
                    <label>商品分类</label>
                    <div class="ipt-cont-box">
                        <select id="choice-classify">
                            <option>饰品</option>
                            <option>服饰</option>
                            <option>文具</option>
                            <option>书画</option>
                            <option>瓷器</option>
                            <option>家具</option>
                        </select>
                    </div>
                </div>
                <div class="ipt-box">
                    <label for="price">设置售价</label>
                    <div class="ipt-cont-box">
                        <input type="text" id="price" placeholder="52.00">
                    </div>
                </div>
                <div class="ipt-box">
                    <label for="stock">商品库存</label>
                    <div class="ipt-cont-box">
                        <input type="text" id="stock" placeholder="3655">
                    </div>
                </div>
            </div>
        </div>
        </body>
    <script src="/js/jquery-3.0.0.min.js"></script>
    <script src="/js/common.js"></script>
    <script>
        $(function () {
        });
    </script>
</html>