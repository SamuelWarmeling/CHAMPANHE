<?php
use App\Models\Package;
$packages = Package::where('status', 'active')->get();
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
  <title>Níveis VIP – EMI</title>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;600;700&family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="/v2/layui/css/layui.css">
  <link rel="stylesheet" href="/v2/css/swiper-bundle.min.css">
  <link rel="stylesheet" href="/v2/css/common.css?t=1.2">
  <link rel="stylesheet" href="/v2/css/emi-theme.css">
  <style>
    *{font-family:'Inter',sans-serif;box-sizing:border-box}
    body{background:#F8F6F2;color:#1C1C1C;margin:0;padding:0 0 80px}
    h1,h2,h3,.playfair{font-family:'Playfair Display',serif}
    .emi-header{background:linear-gradient(135deg,#C8A96A 0%,#D6A86B 100%);padding:14px 16px;color:#fff}
    .emi-back{display:flex;align-items:center;gap:8px;color:#fff;text-decoration:none;font-size:15px;font-weight:600}
    .emi-card{background:#fff;border:1px solid #E8DCC8;border-radius:12px;box-shadow:0 2px 8px rgba(200,169,106,.15);padding:16px;margin-bottom:12px}
    .emi-btn{background:#C8A96A;color:#fff;border:none;border-radius:8px;padding:10px 20px;font-weight:600;font-size:14px;cursor:pointer;display:block;width:100%;text-align:center;text-decoration:none}
    .emi-btn:hover{background:#D6A86B}
    .emi-label{font-size:12px;color:#6B6B6B}
    .emi-value{font-size:15px;font-weight:700;color:#1C1C1C}
    .emi-gold{color:#C8A96A}
    .flex-between{display:flex;justify-content:space-between;align-items:center}
    .flex-left{display:flex;align-items:center;gap:10px}
    .stat-grid{display:grid;grid-template-columns:repeat(3,1fr);gap:8px;text-align:center}
    .stat-box{background:#F8F6F2;border:1px solid #E8DCC8;border-radius:8px;padding:10px 6px}
    .stat-box .s{font-weight:700;color:#C8A96A;font-size:14px}
    .stat-box .n{font-size:11px;color:#6B6B6B;margin-top:2px}
    .tag{background:#F5EDD8;color:#8A6C2A;border-radius:6px;padding:2px 8px;font-size:11px;font-weight:600}
    .divider{border:none;border-top:1px solid #E8DCC8;margin:12px 0}

    .product-list{padding:16px}

    /* Product card with overlay */
    .product-list .emi-card{position:relative;overflow:hidden;cursor:pointer;transition:transform .15s,box-shadow .15s}
    .product-list .emi-card:hover{transform:translateY(-2px);box-shadow:0 6px 18px rgba(200,169,106,.25)}

    /* VIP badge */
    .vip-badge{position:absolute;top:0;right:0;background:linear-gradient(135deg,#C8A96A,#D6A86B);color:#fff;font-size:11px;font-weight:700;padding:4px 10px;border-radius:0 12px 0 8px}

    /* Product photo */
    .pkg-photo{width:56px;height:56px;border-radius:10px;object-fit:cover;border:2px solid #E8DCC8;flex-shrink:0}
    .pkg-name{font-family:'Playfair Display',serif;font-size:15px;font-weight:700;color:#1C1C1C;margin:0 0 2px}

    /* Info rows */
    .info-row{display:flex;justify-content:space-between;align-items:center;padding:4px 0}
    .info-row .lbl{font-size:12px;color:#6B6B6B}
    .info-row .val{font-size:13px;font-weight:600;color:#1C1C1C}
    .info-row .val.gold{color:#C8A96A}

    /* Modal overlay */
    .lay{position:fixed;left:0;top:0;background:rgba(0,0,0,.5);width:100%;height:100%;z-index:998;display:none}

    /* Product dialog */
    #accd{position:fixed;top:50%;left:50%;transform:translate(-50%,-50%);width:92%;max-width:420px;background:#fff;border-radius:16px;z-index:999;box-shadow:0 12px 40px rgba(200,169,106,.25);overflow:hidden;display:none}
    .dialog-header{background:linear-gradient(135deg,#C8A96A 0%,#D6A86B 100%);padding:16px;position:relative}
    .dialog-header-inner{display:flex;align-items:center;gap:12px}
    .product_dialog_image{width:56px;height:56px;border-radius:10px;object-fit:cover;border:2px solid rgba(255,255,255,.4)}
    .product_title{font-family:'Playfair Display',serif;font-size:16px;font-weight:700;color:#fff;margin:0 0 4px}
    .vip_level{background:rgba(255,255,255,.25);color:#fff;border-radius:6px;padding:2px 8px;font-size:11px;font-weight:600}
    .dialog-body{padding:16px}
    .dialog-row{display:flex;justify-content:space-between;align-items:center;padding:9px 0;border-bottom:1px solid #F0EAD8}
    .dialog-row:last-of-type{border-bottom:none}
    .dialog-row .lbl{font-size:13px;color:#6B6B6B}
    .dialog-row .val{font-size:14px;font-weight:700;color:#C8A96A}
    .buy_btn{background:#C8A96A;color:#fff;border:none;border-radius:8px;padding:12px;font-weight:700;font-size:15px;width:100%;cursor:pointer;margin-top:4px}
    .buy_btn:hover{background:#D6A86B}
    .dialog-close{position:absolute;top:12px;right:14px;background:rgba(255,255,255,.25);border:none;color:#fff;border-radius:50%;width:28px;height:28px;font-size:16px;cursor:pointer;display:flex;align-items:center;justify-content:center}

    .hide{display:none}
    .product_list{display:none}
    .product_list.active{display:block}
  </style>
</head>
<body>

{{-- Overlay --}}
<div class="lay" onclick="closeModal()"></div>

{{-- Product Dialog --}}
<div id="accd">
  <input type="hidden" id="product_id" name="product_id" value="">
  <div class="dialog-header">
    <div class="dialog-header-inner">
      <img src="" class="product_dialog_image" alt="">
      <div>
        <div class="product_title">–</div>
        <span class="vip_level">VIP0</span>
      </div>
    </div>
    <button class="dialog-close" onclick="closeModal()">✕</button>
  </div>
  <div class="dialog-body">
    <div class="dialog-row"><span class="lbl">Preço Unitário</span><span class="val product_price">–</span></div>
    <div class="dialog-row"><span class="lbl">Duração</span><span class="val product_days">–</span></div>
    <div class="dialog-row"><span class="lbl daily_income_text">Renda Diária</span><span class="val product_daily_income">–</span></div>
    <div class="dialog-row"><span class="lbl">Renda Total</span><span class="val product_total_income">–</span></div>
    <div class="dialog-row"><span class="lbl">Máximo</span><span class="val product_maximum_share">–</span></div>
    <hr class="divider">
    <div class="dialog-row"><span class="lbl">Valor a Pagar</span><span class="val product_pay_money">–</span></div>
    <div class="dialog-row"><span class="lbl">Rendimento Estimado</span><span class="val product_pay_total_income">–</span></div>
    <button class="buy_btn" onclick="buyConfirm()">Investir Agora</button>
  </div>
</div>

{{-- Header --}}
<div class="emi-header">
  <div style="font-family:'Playfair Display',serif;font-size:20px;font-weight:700">Níveis VIP</div>
  <div style="font-size:12px;opacity:.85;margin-top:2px">Desbloqueie benefícios exclusivos</div>
</div>

{{-- Tab nav --}}
<div style="display:flex;background:#fff;border-bottom:1px solid #E8DCC8">
  <div class="nav nav_active" style="flex:1;text-align:center;padding:13px 0;font-size:14px;font-weight:600;color:#C8A96A;border-bottom:3px solid #C8A96A;cursor:pointer" data-type="1" data-image="fixed" onclick="setActiveTab(1)">Fixo</div>
  <div class="nav" style="flex:1;text-align:center;padding:13px 0;font-size:14px;font-weight:600;color:#9A9087;border-bottom:3px solid transparent;cursor:pointer;transition:all .2s" data-type="2" data-image="welfare" onclick="setActiveTab(2)">Welfare</div>
  <div class="nav" style="flex:1;text-align:center;padding:13px 0;font-size:14px;font-weight:600;color:#9A9087;border-bottom:3px solid transparent;cursor:pointer;transition:all .2s" data-type="3" data-image="activity" onclick="setActiveTab(3)">Premium</div>
</div>

<div class="product-list" style="padding:16px">

  <div class="product_type_1 product_list active" id="fixed_fund">
    @foreach ($packages as $package)
      @if ($package->category == 'fixed')
        <a onclick="window.location.href='{{ route('vip.details', $package->id) }}'" class="emi-card" style="display:block;text-decoration:none;cursor:pointer;position:relative">
          <div class="vip-badge">VIP{{ $package->vip_level ?? 0 }}</div>
          <div class="flex-left" style="margin-bottom:12px;padding-right:50px">
            <img class="pkg-photo" src="{{ asset($package->photo) }}" alt="">
            <div>
              <div class="pkg-name">{{ $package->name }}</div>
              <div style="font-size:18px;font-weight:700;color:#C8A96A">{{ price($package->price) }}</div>
            </div>
          </div>
          <div class="stat-grid" style="grid-template-columns:repeat(3,1fr)">
            <div class="stat-box">
              <div class="s">{{ $package->validity }}d</div>
              <div class="n">Duração</div>
            </div>
            <div class="stat-box">
              <div class="s">{{ price($package->commission_with_avg_amount / $package->validity) }}</div>
              <div class="n">Diário</div>
            </div>
            <div class="stat-box">
              <div class="s">{{ price($package->commission_with_avg_amount) }}</div>
              <div class="n">Total</div>
            </div>
          </div>
        </a>
      @endif
    @endforeach
    <div class="none_data hide" style="text-align:center;padding:40px 0;color:#9A9087">
      <p>Nenhum item disponível</p>
    </div>
  </div>

  <div class="product_type_2 product_list" id="welfare_fund">
    @foreach ($packages as $package)
      @if ($package->category == 'welfare')
        <a onclick="window.location.href='{{ route('vip.details', $package->id) }}'" class="emi-card" style="display:block;text-decoration:none;cursor:pointer;position:relative">
          <div class="vip-badge">VIP{{ $package->vip_level ?? 0 }}</div>
          <div class="flex-left" style="margin-bottom:12px;padding-right:50px">
            <img class="pkg-photo" src="{{ asset($package->photo) }}" alt="">
            <div>
              <div class="pkg-name">{{ $package->name }}</div>
              <div style="font-size:18px;font-weight:700;color:#C8A96A">{{ price($package->price) }}</div>
            </div>
          </div>
          <div class="stat-grid" style="grid-template-columns:repeat(3,1fr)">
            <div class="stat-box">
              <div class="s">{{ $package->validity }}d</div>
              <div class="n">Duração</div>
            </div>
            <div class="stat-box">
              <div class="s">{{ price($package->commission_with_avg_amount / $package->validity) }}</div>
              <div class="n">Diário</div>
            </div>
            <div class="stat-box">
              <div class="s">{{ price($package->commission_with_avg_amount) }}</div>
              <div class="n">Total</div>
            </div>
          </div>
        </a>
      @endif
    @endforeach
    <div class="none_data hide" style="text-align:center;padding:40px 0;color:#9A9087">
      <p>Nenhum item disponível</p>
    </div>
  </div>

  <div class="product_type_3 product_list" id="activity_fund">
    @foreach ($packages as $package)
      @if ($package->category == 'activity')
        <a onclick="window.location.href='{{ route('vip.details', $package->id) }}'" class="emi-card" style="display:block;text-decoration:none;cursor:pointer;position:relative">
          <div class="vip-badge">VIP{{ $package->vip_level ?? 0 }}</div>
          <div class="flex-left" style="margin-bottom:12px;padding-right:50px">
            <img class="pkg-photo" src="{{ asset($package->photo) }}" alt="">
            <div>
              <div class="pkg-name">{{ $package->name }}</div>
              <div style="font-size:18px;font-weight:700;color:#C8A96A">{{ price($package->price) }}</div>
            </div>
          </div>
          <div class="stat-grid" style="grid-template-columns:repeat(3,1fr)">
            <div class="stat-box">
              <div class="s">{{ $package->validity }}d</div>
              <div class="n">Duração</div>
            </div>
            <div class="stat-box">
              <div class="s">{{ price($package->commission_with_avg_amount / $package->validity) }}</div>
              <div class="n">Diário</div>
            </div>
            <div class="stat-box">
              <div class="s">{{ price($package->commission_with_avg_amount) }}</div>
              <div class="n">Total</div>
            </div>
          </div>
        </a>
      @endif
    @endforeach
    <div class="none_data hide" style="text-align:center;padding:40px 0;color:#9A9087">
      <p>Nenhum item disponível</p>
    </div>
  </div>

</div>

{{-- CSRF for AJAX --}}
<meta name="csrf-token" content="{{ csrf_token() }}">

{{-- Footer nav --}}
<div class="footer_menu">
  <div class="content">
    <a href="/" class="item"><img src="/v2/img/footer/home.png"><p>Início</p></a>
    <a href="/product" class="item active"><img src="/v2/img/footer/invest_active.png"><p>Investir</p></a>
    <a href="/invitation" class="item"><img src="/v2/img/footer/invite.png" style="width:80px;height:80px;margin-top:-25px"></a>
    <a href="/blog" class="item"><img src="/v2/img/footer/blog.png"><p>Blog</p></a>
    <a href="/my" class="item"><img src="/v2/img/footer/account.png"><p>Conta</p></a>
  </div>
</div>

<script src="/v2/layui/layui.js"></script>
<script>
function closeModal() {
  document.getElementById('accd').style.display = 'none';
  document.querySelector('.lay').style.display = 'none';
}
document.querySelector('.lay').addEventListener('click', closeModal);

function setActiveTab(type) {
  document.querySelectorAll('.nav').forEach(function(nav) {
    nav.classList.remove('nav_active');
    nav.style.color = '#9A9087';
    nav.style.borderBottomColor = 'transparent';
  });
  var activeNav = document.querySelector('.nav[data-type="' + type + '"]');
  activeNav.classList.add('nav_active');
  activeNav.style.color = '#C8A96A';
  activeNav.style.borderBottomColor = '#C8A96A';

  document.querySelectorAll('.product_list').forEach(function(list) {
    list.classList.remove('active');
  });
  var map = {1: 'fixed_fund', 2: 'welfare_fund', 3: 'activity_fund'};
  var el = document.getElementById(map[type]);
  if (el) el.classList.add('active');
}
</script>

</body>
</html>
