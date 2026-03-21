<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
  <title>Resgatar Código de Bônus – EMI</title>
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400;0,600;0,700;1,400&family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="/v2/layui/css/layui.css">
  <link rel="stylesheet" href="/v2/css/common.css">
  <link rel="stylesheet" href="/v2/css/emi-theme.css">
  <style>
    *{font-family:'Inter',sans-serif;box-sizing:border-box}
    body{background:#F8F6F2;color:#1C1C1C;margin:0;padding:0 0 80px}
    h1,h2,h3,.playfair{font-family:'Playfair Display',serif}
    .emi-header{background:linear-gradient(135deg,#C8A96A 0%,#D6A86B 100%);padding:14px 16px;color:#fff}
    .emi-back{display:flex;align-items:center;gap:8px;color:#fff;text-decoration:none;font-size:15px;font-weight:600}
    .emi-gold{color:#C8A96A}
    .page-wrap{padding:16px;}

    .bonus-card{
      background:#fff;border:1px solid #E8DCC8;border-radius:12px;
      box-shadow:0 2px 8px rgba(200,169,106,.15);
      padding:28px 20px;text-align:center;position:relative;
      overflow:hidden;
    }
    .bonus-card::before{
      content:'';position:absolute;top:-40px;right:-40px;
      width:120px;height:120px;border-radius:50%;
      background:radial-gradient(circle, rgba(200,169,106,0.12) 0%, transparent 70%);
    }

    .gift-icon-wrap{
      width:72px;height:72px;border-radius:50%;margin:0 auto 16px;
      background:linear-gradient(135deg,#C8A96A,#D6A86B);
      display:flex;align-items:center;justify-content:center;
      box-shadow:0 4px 16px rgba(200,169,106,0.35);
    }
    .gift-icon-wrap svg{width:36px;height:36px;color:#fff;}

    .bonus-title{
      font-family:'Playfair Display',serif;
      font-size:20px;font-weight:600;color:#1C1C1C;margin:0 0 8px;
    }
    .bonus-subtitle{font-size:14px;color:#6B6B6B;margin:0 0 24px;line-height:1.6;}

    .field-label{font-size:13px;font-weight:500;color:#6B6B6B;margin-bottom:6px;display:block;text-align:left;}
    .field-wrap{
      display:flex;align-items:center;
      background:#F8F6F2;border:1px solid #E8DCC8;
      border-radius:10px;height:48px;overflow:hidden;
      transition:border-color 0.2s;margin-bottom:16px;
    }
    .field-wrap:focus-within{border-color:#C8A96A;}
    .field-wrap .layui-input{
      flex:1;border:none !important;background:transparent !important;
      padding:0 14px !important;font-size:15px !important;color:#1C1C1C !important;
      outline:none;height:48px !important;line-height:48px !important;
      font-family:'Inter',sans-serif !important;text-align:center;letter-spacing:2px;
    }
    .field-wrap .layui-input::placeholder{
      color:#BBBBBB !important;letter-spacing:0;font-style:italic;
    }

    .btn-redeem{
      display:block;width:100%;padding:14px;
      background:linear-gradient(135deg,#C8A96A 0%,#D6A86B 100%);
      color:#fff;font-size:16px;font-weight:700;
      border:none;border-radius:10px;cursor:pointer;
      letter-spacing:0.5px;transition:opacity 0.2s;
    }
    .btn-redeem:active{opacity:0.88;}

    .msg-box{
      text-align:center;font-size:14px;margin-top:14px;
      min-height:20px;font-weight:500;
    }
    .msg-box.success{color:#2E7D32;}
    .msg-box.error{color:#C62828;}

    #confetti{
      position:fixed;top:0;left:0;width:100%;height:100%;
      pointer-events:none;z-index:9999;display:none;
    }
    canvas{width:100% !important;height:100% !important;}
  </style>
</head>
<body>
  <div class="emi-header">
    <a href="javascript:history.back(-1)" class="emi-back">
      <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
        <polyline points="15 18 9 12 15 6"/>
      </svg>
      Resgatar Código de Bônus
    </a>
  </div>

  <div class="page-wrap">
    <div class="bonus-card">
      <div class="gift-icon-wrap">
        <svg viewBox="0 0 24 24" fill="currentColor">
          <path d="M20 12v10H4V12H2v-2h20v2h-2zM6 12v8h12v-8H6zm5-10a2 2 0 0 0-2 2c0 1.1.9 2 2 2h1V4a2 2 0 0 0-1 0zm4 0a2 2 0 0 1 0 4h-1V4a2 2 0 0 1 1-2zm-5 4H4v4h7V6zm2 0v4h7V6h-7z"/>
        </svg>
      </div>

      <h2 class="bonus-title">Resgate seu Bônus</h2>
      <p class="bonus-subtitle">Insira seu código exclusivo e desbloqueie<br>recompensas especiais da EMI.</p>

      <form class="layui-form" id="redeem-form">
        <label class="field-label">Código de Bônus</label>
        <div class="field-wrap">
          <input type="text" name="bonus_code" required
                 placeholder="Digite seu código" class="layui-input" autocomplete="off">
        </div>
        <button class="btn-redeem layui-btn" lay-submit lay-filter="submitBonus">
          Resgatar Agora
        </button>
      </form>

      <div class="msg-box" id="messageBox"></div>
    </div>
  </div>

  <div id="confetti">
    <canvas id="canvas"></canvas>
  </div>

  @include('app.layout.menu')

  <script src="/v2/layui/layui.js"></script>
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
              $('#messageBox').text(res.message).addClass('success');
              layer.msg(res.message, {icon: 1});
              showConfetti();
            } else {
              $('#messageBox').text(res.message).addClass('error');
              layer.msg(res.message, {icon: 2});
            }
          },
          error: function(){
            layer.closeAll('loading');
            $('#messageBox').text('Ocorreu um erro. Tente novamente.').addClass('error');
          }
        });

        return false;
      });
    });

    function showConfetti() {
      var duration = 2 * 1000;
      var animationEnd = Date.now() + duration;
      var confettiSettings = {
        startVelocity: 30, spread: 360, ticks: 60, zIndex: 1000,
        colors: ['#C8A96A', '#D6A86B', '#F5EDD8', '#fff', '#E8DCC8']
      };
      var interval = setInterval(function() {
        if (Date.now() > animationEnd) return clearInterval(interval);
        confetti(Object.assign({}, confettiSettings, {
          particleCount: 50,
          origin: { x: Math.random(), y: Math.random() - 0.2 }
        }));
      }, 200);
    }
  </script>
</body>
</html>
