<html>
<head>
    <!-- Load TensorFlow.js -->
    <script src="https://cdn.jsdelivr.net/npm/@tensorflow/tfjs@0.9.0"> </script>

    <!-- Place your code in the script tag below. You can also use an external .js file -->
    <script>
        // Notice there is no 'import' statement. 'tf' is available on the index-page
        // because of the script tag above.

        // Define a model for linear regression.
        const model = tf.sequential();
        model.add(tf.layers.dense({units: 1, inputShape: [1]}));

        // Prepare the model for training: Specify the loss and the optimizer.
        model.compile({loss: 'meanSquaredError', optimizer: 'sgd'});

        // Generate some synthetic data for training.
        const xs = tf.tensor2d([1, 2, 3, 4], [4, 1]);
        const ys = tf.tensor2d([1, 3, 5, 7], [4, 1]);

        // Train the model using the data.
        model.fit(xs, ys).then(() => {
            // Use the model to do inference on a data point the model hasn't seen before:
            // Open the browser devtools to see the output
            model.predict(tf.tensor2d([5], [1, 1])).print();
        });
    </script>
</head>
<script>
    var video = document.getElementById('video');
    var canvas = document.getElementById('canvas');
    var context = canvas.getContext('2d');

    function getUserMediaToPhoto(constraints, success, error) {
        if (navigator.mediaDevices.getUserMedia) {
            //最新标准API
            navigator.mediaDevices.getUserMedia(constraints).then(success).catch(error);
        } else if (navigator.webkitGetUserMedia) {
            //webkit核心浏览器
            navigator.webkitGetUserMedia(constraints, success, error);
        } else if (navigator.mozGetUserMedia) {
            //firefox浏览器
            navigator.mozGetUserMedia(constraints, success, error);
        } else if (navigator.getUserMedia) {
            //旧版API
            navigator.getUserMedia(constraints, success, error);
        }
    }

    //成功回调函数
    function success(stream) {
        //兼容webkit核心浏览器
        var CompatibleURL = window.URL || window.webkitURL;
        //将视频流转化为video的源
        video.src = CompatibleURL.createObjectURL(stream);
        video.play();//播放视频
        //将视频绘制到canvas上
        postFace()
    }

    function error(error) {
        console.log('访问用户媒体失败：', error.name, error.message);
    }

    if (navigator.mediaDevices.getUserMedia || navigator.webkitGetUserMedia || navigator.mozGetUserMedia || navigator.getUserMedia) {
        getUserMediaToPhoto({video: {width: 480, height: 320}}, success, error);
    } else {
        alert('你的浏览器不支持访问用户媒体设备');

    }


    function postFace() {
        setTimeout(function () {
            context.drawImage(video, 0, 0, 480, 320);
            img = canvas.toDataURL('image/jpg')
            {
                #获取完整的base64编码
                #
            }
            img = img.split(',')[1]
            //将照片以base64用ajax传到后台
            $.post({
                url: '/upload',
                data: {
                    message: img
                },
                success: function (callback) {
                    if (!callback.data) {
                        postFace()
                    } else {
                        window.location.href = callback
                    }
                },
                error: function (callback) {
                    postFace()
                }
            })
        }, 300)
    }
</script>
</html>