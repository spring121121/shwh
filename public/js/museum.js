window.onload=function () {
    var nav=document.getElementById('nav');
    var bot=nav.getElementsByTagName('li');
    var sections = document.getElementsByTagName("section");
    console.log(sections)
    var len = bot.length;
    for(let i=0;i<len;i++){
        var bin = bot[i]
        bin.onclick = function(){
            console.log(1111)
            for(let j=0;j<len;j++){
                bot[j].className = "" //	清楚所有按钮的样式
                sections[j].className = "" //清楚所有div的样式
            }
            //当备点击按钮时进行更新
            bot[i].className = "on"
            //当备点击div时进行更新
            sections[i].className = "b"
        }
    }
}