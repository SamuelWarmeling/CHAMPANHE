<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8"> 
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1"> 
  <title>Redeem Code</title> 
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/layui/2.5.7/css/layui.min.css">
  <link rel="stylesheet" href="/v2/layui/css/layui.css"> 
  <link rel="stylesheet" href="/v2/css/common.css"
  <link rel="stylesheet" href="/v2/css/emi-theme.css">> 
  <style>
    body {
      background: #f2f5fa;
      font-family: 'Arial', sans-serif;
    }

    .common_header {
      background: #183b78;
      color: #fff;
    }

    .common_header a {
      color: #fff;
      font-weight: bold;
    }

    .redeem_card {
      background: #ffffff;
      border-radius: 16px;
      padding: 25px;
      margin: 20px 15px;
      box-shadow: 0 4px 12px rgba(0,0,0,0.08);
      text-align: center;
      position: relative;
    }

    .vip-badge {
      position: absolute;
      top: -15px;
      right: -15px;
      background: linear-gradient(45deg, #FFD700, #FF8C00);
      color: white;
      padding: 6px 12px;
      border-radius: 30px;
      font-size: 12px;
      font-weight: bold;
      box-shadow: 0 2px 8px rgba(0,0,0,0.1);
    }

    .redeem_title {
      font-size: 20px;
      font-weight: bold;
      color: #1C1C1C;
    }

    .redeem_subtitle {
      font-size: 14px;
      color: #777;
      margin-top: 8px;
      margin-bottom: 20px;
    }

    .layui-input {
      background: #f9f9f9;
      border-radius: 8px;
      font-size: 16px;
    }

    .layui-btn {
      width: 100%;
      border-radius: 8px;
      font-weight: bold;
      margin-top: 15px;
      background: #3262BE;
    }

    .layui-btn:hover {
      background: #2a55a0;
    }

    .msg {
      text-align: center;
      font-size: 14px;
      margin-top: 10px;
    }

    .msg.success { color: #28a745; }
    .msg.error { color: #f44336; }

    #confetti {
      position: fixed;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      pointer-events: none;
      z-index: 9999;
      display: none;
    }

    canvas {
      width: 100% !important;
      height: 100% !important;
    }

    #service {
      position: fixed;
      bottom: 20px;
      right: 20px;
      z-index: 999;
    }
  </style>
</head>
<body class="common_body">

  <div class="common_header">
    <a href="javascript:history.back(-1)" class="back position">
      <p class="btn"><i class="layui-icon layui-icon-left layui-font-20"></i></p> Redeem Code
    </a>
  </div>

  <div class="redeem_card">
    <div class="vip-badge">VIP+</div>
    <p class="redeem_title">🎁 Redeem Your Bonus</p>
    <p class="redeem_subtitle">Enter your code and receive exclusive rewards</p>

    <form class="layui-form" id="redeem-form">
      <div class="layui-form-item">
        <input type="text" name="bonus_code" required placeholder="Enter your bonus code" class="layui-input">
      </div>
      <button class="layui-btn layui-btn-normal" lay-submit lay-filter="submitBonus">Redeem Now</button>
    </form>

    <div class="msg" id="messageBox"></div>
  </div>

  <a href="/help" target="_blank" id="service">
    <img src="/v2/img/common/service.png" style="width: 40px;height: 40px">
  </a>

  <div id="confetti">
    <canvas id="canvas"></canvas>
  </div>

  <script src="https://cdnjs.cloudflare.com/ajax/libs/layui/2.5.7/layui.min.js"></script>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/canvas-confetti@1.5.1/dist/confetti.browser.min.js"></script>
  <script>
    layui.use(['form', 'layer'], function(){
      var form = layui.form;
      var layer = layui.layer;

      form.on('submit(submitBonus)', function(data){
        layer.load(1, {shade: [0.1,'#fff']});
        $('#messageBox').text('').removeClass('success error');

        $.ajax({
          url: "{{ route('user.submit-bonus') }}",
          method: "POST",
          headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          },
          data: data.field,
          success: function(res){
            layer.closeAll('loading');
            if(res.status === 1){
              $('#messageBox').text(res.message).addClass('msg success');
              layer.msg(res.message, {icon: 1});
              showConfetti();
            } else {
              $('#messageBox').text(res.message).addClass('msg error');
              layer.msg(res.message, {icon: 2});
            }
          },
          error: function(){
            layer.closeAll('loading');
            $('#messageBox').text("An error occurred.").addClass('msg error');
          }
        });

        return false;
      });
    });

    function showConfetti() {
      const duration = 2 * 1000;
      const animationEnd = Date.now() + duration;
      const confettiSettings = { startVelocity: 30, spread: 360, ticks: 60, zIndex: 1000 };

      const interval = setInterval(function() {
        if (Date.now() > animationEnd) {
          return clearInterval(interval);
        }

        confetti(Object.assign({}, confettiSettings, {
          particleCount: 50,
          origin: { x: Math.random(), y: Math.random() - 0.2 }
        }));
      }, 200);
    }
  </script>
</body>
</html>
