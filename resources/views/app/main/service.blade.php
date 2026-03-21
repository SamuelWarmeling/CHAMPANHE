<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
  <title>Central de Suporte – EMI</title>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400;0,600;0,700;1,400&family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="/v2/layui/css/layui.css">
  <link rel="stylesheet" href="/v2/css/common.css">
  <link rel="stylesheet" href="/v2/css/emi-theme.css">
  <style id="ss-chat-custom-css">.ss-chat-body{overflow:hidden !important}</style>
  <style>
    *{font-family:'Inter',sans-serif;box-sizing:border-box}
    body{background:#F8F6F2;color:#1C1C1C;margin:0;padding:0 0 80px}
    h1,h2,h3,.playfair{font-family:'Playfair Display',serif}
    .emi-header{background:linear-gradient(135deg,#C8A96A 0%,#D6A86B 100%);padding:14px 16px;color:#fff}
    .emi-back{display:flex;align-items:center;gap:8px;color:#fff;text-decoration:none;font-size:15px;font-weight:600}
    .emi-gold{color:#C8A96A}
    .page-wrap{padding:16px;}

    .support-hero{
      background:linear-gradient(135deg,#C8A96A 0%,#D6A86B 100%);
      border-radius:12px;padding:24px 20px;margin-bottom:16px;color:#fff;
      text-align:center;
    }
    .support-hero h2{
      font-family:'Playfair Display',serif;
      font-size:20px;font-weight:600;margin:0 0 8px;
    }
    .support-hero p{font-size:14px;margin:0;opacity:0.9;line-height:1.6;}

    .support-item{
      background:#fff;border:1px solid #E8DCC8;border-radius:12px;
      box-shadow:0 2px 8px rgba(200,169,106,.1);
      display:flex;align-items:center;gap:14px;
      padding:16px;margin-bottom:10px;
      text-decoration:none;color:#1C1C1C;
      transition:box-shadow 0.2s;cursor:pointer;
    }
    .support-item:hover{box-shadow:0 4px 14px rgba(200,169,106,.2);}
    .support-item-icon{
      width:48px;height:48px;border-radius:12px;flex-shrink:0;
      background:linear-gradient(135deg,#C8A96A,#D6A86B);
      display:flex;align-items:center;justify-content:center;
    }
    .support-item-icon img{width:28px;height:28px;object-fit:contain;border-radius:50%;}
    .support-item-icon svg{width:24px;height:24px;color:#fff;}
    .support-item-body{flex:1;min-width:0;}
    .support-item-title{font-size:15px;font-weight:600;color:#1C1C1C;margin-bottom:3px;}
    .support-item-desc{font-size:13px;color:#6B6B6B;line-height:1.5;}
    .support-chev{color:#E8DCC8;flex-shrink:0;}
    .support-chev svg{width:18px;height:18px;}
  </style>
</head>
<body>
  <div class="emi-header">
    <a href="javascript:history.back(-1)" class="emi-back">
      <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
        <polyline points="15 18 9 12 15 6"/>
      </svg>
      Central de Suporte
    </a>
  </div>

  <div class="page-wrap">

    <div class="support-hero">
      <h2>Central de Atendimento</h2>
      <p>Estamos com você sempre que precisar.<br>Escolha o canal de suporte abaixo.</p>
    </div>

    <a href="https://t.me/profelartech" class="support-item">
      <div class="support-item-icon">
        <img src="/v2/img/help/recharge.png" alt="Depósito" style="background:#fff;">
      </div>
      <div class="support-item-body">
        <div class="support-item-title">Problemas com Depósito?</div>
        <div class="support-item-desc">Se o seu saldo não chegou após o depósito, entre em contato e nossa equipe irá auxiliá-lo.</div>
      </div>
      <div class="support-chev">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
          <polyline points="9 18 15 12 9 6"/>
        </svg>
      </div>
    </a>

    <div class="support-item service" style="cursor:pointer;">
      <div class="support-item-icon">
        <img src="/v2/img/help/service.png" alt="Atendimento">
      </div>
      <div class="support-item-body">
        <div class="support-item-title">Atendimento Online</div>
        <div class="support-item-desc">Horário de atendimento: 09:00 – 16:30</div>
      </div>
      <div class="support-chev">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
          <polyline points="9 18 15 12 9 6"/>
        </svg>
      </div>
    </div>

    <a href="{{setting('telegram')}}" class="support-item">
      <div class="support-item-icon">
        <img src="/v2/img/help/telegram.png" alt="Telegram">
      </div>
      <div class="support-item-body">
        <div class="support-item-title">Telegram Oficial</div>
        <div class="support-item-desc">Siga nosso canal para receber novidades e benefícios exclusivos.</div>
      </div>
      <div class="support-chev">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
          <polyline points="9 18 15 12 9 6"/>
        </svg>
      </div>
    </a>

  </div>

  @include('app.layout.menu')

  {{-- Salesmartly chat widget (preserved exactly) --}}
  <div id="ss-chat-p">
    <audio id="sspSoundNotice" preload="metadata" style="width:0;height:0;" src="https://client.salesmartly.com/setting/sounds/ling.mp3"></audio>
    <iframe title="Contact us" id="s-chat-plugin" style="
      display:none;border:none;position:fixed;opacity:1;
      background:none transparent !important;margin:0px;
      max-height:100vh;max-width:100vw;transform:translateY(0px);
      transition:all .5s ease 0s !important;visibility:visible;
      z-index:999999999 !important;color-scheme:none;
      width:100px;height:90px;border-radius:16px;
      top:auto;right:0;bottom:15px;left:auto
    "></iframe>
    <ssp-widget id="sspWidget" style="
      position:fixed;color-scheme:none;font-family:Roboto,sans-serif;
      top:auto;right:12px;bottom:10px;left:auto;
      z-index:999999999 !important;
    "></ssp-widget>
    <iframe title="Preview Popup" id="s-chat-popup" style="
      display:none;width:100%;height:100%;position:fixed;
      top:0px;left:0px;z-index:2147483003;border:0px;color-scheme:none;
    "></iframe>
  </div>

  <script src="/v2/layui/layui.js"></script>
  <script>
    layui.use(function(){
      var $ = layui.jquery;
      var layer = layui.layer;
      var form = layui.form;
      var laydate = layui.laydate;
      var slider = layui.slider;
      var element = layui.element;

      // Idioma configurado: pt (português)
      ssq.push('setLoginInfo', {
        user_id: "{{ md5(auth()->id()) }}",
        user_name: '{{ auth()->user()->nickname ?? auth()->user()->phone }}',
        language: 'pt',
        phone: '{{ auth()->user()->phone ?? "" }}',
        email: '{{ auth()->user()->email ?? "" }}',
        description: 'ID: {{ auth()->user()->ref_id ?? "" }}',
      });

      $('.service').click(function(){
        ssq.push('chatOpen');
      });
    });
  </script>
</body>
</html>
