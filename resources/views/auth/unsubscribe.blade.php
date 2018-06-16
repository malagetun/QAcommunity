
<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="utf-8">
    <title>退订邮件</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        html,
        body,
        p,
        ul,
        li {
            font-family: 'Helvetica Neue', Arial, 'Liberation Sans', FreeSans, 'Hiragino Sans GB', sans-serif;
            margin: 0;
            padding: 0;
            font-size: 14px;
        }
        body {
            width: 100%;
            height: 100%;
            background: #FFFFFF;
        }
        .wrapper {
            margin: 20px auto;
        }
        .brand {
            width: 480px;
            margin: 0 auto;
        }
        .brand a {
            display: inline-block;
            padding-bottom: 15px;
        }
        .content {
            background: #fff;
            width: 480px;
            margin: 0 auto;
            border-radius: 8px;
            -webkit-box-shadow: 0 2px 2px rgba(204, 197, 185, 0.5);
            box-shadow: 0 2px 2px rgba(204, 197, 185, 0.5);
        }
        .content-header {
            border-bottom: 1px solid #eee;
        }
        .unsub-title {
            padding: 20px;
            margin: 0;
            color: #494949;
        }
        .content-body {
            padding: 25px 25px 25px 15px;
            border-bottom: 1px solid #eee;
        }
        .content-footer {
            padding: 15px;
        }
        .select-reason {
            margin-bottom: 20px;
        }
        .select-reason {
            width: 600px;
        }
        .select-reason label {
            display: block;
            margin-bottom: 10px;
            cursor: pointer;
        }
        .btn {
            display: inline-block;
            padding: 8px 25px;
            border-radius: 4px;
            text-align: center;
            text-decoration: none;
            border-color: transparent;
            cursor: pointer;
        }
        .btn-highlight {
            color: #fff;
            background: #00adb5;
            margin-right: 10px;
        }
        .btn-highlight:hover {
            background: #286090;
        }
        .btn-default {
            background: #fff;
            color: #464646;
            border: 1px solid #ddd;
        }
        .btn-default:hover {
            background: #eee;
        }
    </style>
</head>
<body>
<div class="wrapper">
    <div class="brand">

    </div>
    <div class="content">
        <div id="showBox">
            <div class="content-header">
                <h2 class="unsub-title">您确定要取消订阅吗 (Are you sure to unsubscribe) </h2>
            </div>
            <div class="content-body">
                <div class="select-reason">
                    <label>
                        <input type="radio" name="reason" value="0">我不想再收到此类邮件 (I don't want to receive such email anymore)
                    </label>
                    <label>
                        <input type="radio" name="reason" value="1"> 这不是我订阅的 (I didn't subscribe it)
                    </label>
                    <label>
                        <input type="radio" name="reason" value="2"> 这是垃圾邮件 (This is a spam email)
                    </label>
                    <label>
                        <input type="radio" name="reason" value="3"> 这是欺诈邮件, 我要举报 (This is a fraud email, i want to report it)
                    </label>
                </div>
            </div>
            <div class="content-footer">
                <button onclick="sure()" class="btn btn-highlight">确定 (Yes) </button>
                <button onclick="closeWin()" class="btn btn-default">取消 (No) </button>
            </div>
        </div>
        <div id="showAlert" style="padding:30px;display:none;">
            <p>取消订阅成功！(Unsubscribe success!)</p>
        </div>
        <div id="showErro" style="padding:30px;display:none;">
            <p>取消订阅失败！(Unsubscribe failed!)</p>
        </div>
    </div>
</div>
<script type="text/javascript">
    function getCheckValue() {
        var radiobox = document.getElementsByName('reason');
        for (var i = 0; i < radiobox.length; i++) {
            if (radiobox[i].checked) {
                return radiobox[i].value;
            }
        }
        return;
    }
    function sure() {
        var reason = getCheckValue();
        if(!reason) {alert('请选择取消订阅的原因(please choose one reason)'); return;}
        var surl = "/track/unsubscribe-confirm.do?p=eyJ1c2VyX2lkIjogMzQwMTEsICJ0YXNrX2lkIjogIiIsICJlbWFpbF9pZCI6ICIxNTA3NTUwMjY2MTI2XzM0MDExXzc5NTNfNzY5OC5zYy0xMF85XzRfNDAtaW5ib3VuZDAkNDU3MTUyMDg0QHFxLmNvbSIsICJzaWduIjogIjc2ZTQ1YjAyNGQzYjMxMmQ3MjRhMmJiOThmMzE5YmY1IiwgInVzZXJfaGVhZGVycyI6IHt9LCAibGFiZWwiOiAwLCAicmVjZWl2ZXIiOiAiNDU3MTUyMDg0QHFxLmNvbSIsICJjYXRlZ29yeV9pZCI6IDExNTY2N30=&reason=" + reason;
        var xhr = new XMLHttpRequest();
        xhr.onreadystatechange = function() {
            if (xhr.readyState === 4 && xhr.status === 200) {
                document.getElementById('showBox').style.display = 'none';
                document.getElementById('showAlert').style.display = 'block'
            }
            else if(xhr.readyState === 4 && xhr.status === 400){
                document.getElementById('showBox').style.display = 'none';
                document.getElementById('showError').style.display = 'block';
            }
        }
        xhr.open('get', surl);
        xhr.send();
    }
    function closeWin() {
        window.opener = null;
        window.open("", "_self");
        window.close();
    }
</script>
</body>
</html>
