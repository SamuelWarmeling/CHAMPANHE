<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
  <title>Comunidade – EMI</title>
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
    .emi-card{background:#fff;border:1px solid #E8DCC8;border-radius:12px;box-shadow:0 2px 8px rgba(200,169,106,.15);padding:16px;margin-bottom:12px}
    .emi-gold{color:#C8A96A}
    .page-wrap{padding:16px;}

    .vip-level-card{
      background:#fff;border:1px solid #E8DCC8;border-radius:12px;
      box-shadow:0 2px 8px rgba(200,169,106,.1);
      padding:16px;margin-bottom:10px;
      display:flex;align-items:center;gap:14px;
    }
    .vip-level-card img{width:56px;height:56px;flex-shrink:0;object-fit:contain;}
    .vip-level-info{flex:1;}
    .vip-level-name{
      font-family:'Playfair Display',serif;
      font-size:15px;font-weight:600;color:#1C1C1C;margin-bottom:4px;
    }
    .vip-level-req{font-size:13px;color:#6B6B6B;line-height:1.5;}
    .vip-level-req strong{color:#C8A96A;font-weight:700;}

    .section-intro{
      background:#fff;border:1px solid #E8DCC8;border-radius:12px;
      box-shadow:0 2px 8px rgba(200,169,106,.1);
      padding:16px;margin-bottom:16px;text-align:center;
    }
    .section-intro h2{
      font-family:'Playfair Display',serif;
      font-size:20px;font-weight:600;color:#1C1C1C;margin:0 0 8px;
    }
    .section-intro p{font-size:14px;color:#6B6B6B;margin:0;line-height:1.6;}
  </style>
</head>
<body>
  <div class="emi-header">
    <a href="javascript:history.back(-1)" class="emi-back">
      <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
        <polyline points="15 18 9 12 15 6"/>
      </svg>
      Comunidade
    </a>
  </div>

  <div class="page-wrap">
    <div class="section-intro">
      <h2>Níveis VIP</h2>
      <p>Invista mais e suba de nível para desbloquear benefícios exclusivos da comunidade EMI.</p>
    </div>

    <div id="vip_contents">
      <div class="vip-level-card">
        <img src="/v2/img/vip/icon_0.png" alt="VIP 0">
        <div class="vip-level-info">
          <div class="vip-level-name">Nível 0</div>
          <div class="vip-level-req">Investimento total: <strong>R$ 0,00</strong></div>
        </div>
      </div>
      <div class="vip-level-card">
        <img src="/v2/img/vip/icon_1.png" alt="VIP 1">
        <div class="vip-level-info">
          <div class="vip-level-name">Nível 1</div>
          <div class="vip-level-req">Investimento total: <strong>R$ 320,00</strong></div>
        </div>
      </div>
      <div class="vip-level-card">
        <img src="/v2/img/vip/icon_2.png" alt="VIP 2">
        <div class="vip-level-info">
          <div class="vip-level-name">Nível 2</div>
          <div class="vip-level-req">Investimento total: <strong>R$ 4.320,00</strong></div>
        </div>
      </div>
      <div class="vip-level-card">
        <img src="/v2/img/vip/icon_3.png" alt="VIP 3">
        <div class="vip-level-info">
          <div class="vip-level-name">Nível 3</div>
          <div class="vip-level-req">Investimento total: <strong>R$ 11.320,00</strong></div>
        </div>
      </div>
      <div class="vip-level-card">
        <img src="/v2/img/vip/icon_4.png" alt="VIP 4">
        <div class="vip-level-info">
          <div class="vip-level-name">Nível 4</div>
          <div class="vip-level-req">Investimento total: <strong>R$ 19.320,00</strong></div>
        </div>
      </div>
      <div class="vip-level-card">
        <img src="/v2/img/vip/icon_5.png" alt="VIP 5">
        <div class="vip-level-info">
          <div class="vip-level-name">Nível 5</div>
          <div class="vip-level-req">Investimento total: <strong>R$ 39.320,00</strong></div>
        </div>
      </div>
      <div class="vip-level-card">
        <img src="/v2/img/vip/icon_6.png" alt="VIP 6">
        <div class="vip-level-info">
          <div class="vip-level-name">Nível 6</div>
          <div class="vip-level-req">Investimento total: <strong>R$ 59.320,00</strong></div>
        </div>
      </div>
      <div class="vip-level-card">
        <img src="/v2/img/vip/icon_7.png" alt="VIP 7">
        <div class="vip-level-info">
          <div class="vip-level-name">Nível 7</div>
          <div class="vip-level-req">Investimento total: <strong>R$ 79.320,00</strong></div>
        </div>
      </div>
      <div class="vip-level-card">
        <img src="/v2/img/vip/icon_8.png" alt="VIP 8">
        <div class="vip-level-info">
          <div class="vip-level-name">Nível 8</div>
          <div class="vip-level-req">Investimento total: <strong>R$ 144.320,00</strong></div>
        </div>
      </div>
    </div>
  </div>

  @include('app.layout.menu')

  <script src="/v2/layui/layui.js"></script>
  <script src="/v2/js/vip.js"></script>
</body>
</html>
