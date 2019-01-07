<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport"
              content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <meta name="keywords" content="神奇的山洞, 山洞, 山洞平台,文创产品">
        <title>探宝笔记-神奇的山洞</title>

        <link rel="stylesheet" href="/styles/common.css">
        <link rel="stylesheet" href="/styles/personal.css">
    </head>
    <body>
        <div class="header">
            <div class="header-left"><a href="/wap/personal"></a></div>
            <div class="header-right btn-title-text" id="edit-del"></div>
            <div class="header-right" id="btn-dz-link"><a href="/wap/thumbs_up"></a></div>
            <h3>探宝笔记</h3>
        </div>
        <div class="content-box">
            <ul class="note-list-box">
            </ul>
        </div>
        <div class="write-note">
            <a href="write-note.html">
                <span>写笔记</span>
                <div class="write-img-box"></div>
            </a>
        </div>
        <div class="btn-del-box">
            <input type="checkbox" id="all-check"><label for="all-check">全选</label>
            <button id="btn-all-del" onclick = deleteNoteAll()>删除</button>
            <button id="cancel">取消</button>
            <span id="list-note"></span>
        </div>
    </body>
    <script src="/js/jquery-3.0.0.min.js"></script>
    <script src="/js/common.js"></script>
    <script>
        $(function () {
            var noteHtml = '';
            $.get("/getMyNoteList", {}, function (data) {
                if (data.status) {
                    $.each(data.data, function (k, v) {
                        noteHtml += '<li>';
                        noteHtml += '<label class="choice"><input name="choice" type="checkbox" value="'+v.id+'"></label>';
                        noteHtml += '<div class="note-img"><img class="common-img" src="' + v.image_one_url + '"></div>';
                        noteHtml += '<div class="note-list-right">';
                        noteHtml += '<h3>' + v.title + '<span>' + v.created_at + '</span></h3>';
                        noteHtml += '<p>' + v.content + '</p>';
                        noteHtml += '<div class="btn-notes btn-pl-list"><i></i>评论(' + v.commentNum + ')</div>';
                        noteHtml += '<div class="btn-notes btn-zf"><i></i>转发(' + v.forwardNum + ')</div>';
                        noteHtml += '<div class="btn-notes btn-zan"><i></i>赞(' + v.likeNum + ')</div>';
                        noteHtml += '</div>';
                        noteHtml += '<label class="btn-del"><button onclick="deleteNote(' + v.id + ')">删除</button></label>'
                        noteHtml += '</li>'
                    })
                    $(".note-list-box").html(noteHtml)
                }
            });


        });

        function deleteNote(id) {
            $.post("/deleteNote", {'note_id': id}, function (data) {
                if (data.status) {
                    alert('删除成功')
                    window.location.reload()
                } else {
                    alert('删除失败')
                }
            })
        }

        function deleteNoteAll(){
            var ids = '';
            $("input:checkbox[name=choice]:checked").each(function(){
                ids += $(this).val()+','
            })
            $.post("/deleteNoteNotOnly", {'note_ids': ids}, function (data) {
                if (data.status) {
                    alert('删除成功')
                    window.location.reload()
                } else {
                    alert('删除失败')
                }
            })
        }
    </script>
</html>