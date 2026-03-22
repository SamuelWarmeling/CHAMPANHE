<?php
use App\Models\Package;
$packages = Package::where('status', 'active')->get();
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
  <title>Planos de Investimento – EMI</title>
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
    .emi-btn{background:#C8A96A;color:#fff;border:none;border-radius:8px;padding:10px 20px;font-weight:600;font-size:14px;cursor:pointer;display:block;width:100%;text-align:center}
    .emi-btn:hover{background:#D6A86B}
    .emi-label{font-size:12px;color:#6B6B6B}
    .emi-value{font-size:15px;font-weight:700;color:#1C1C1C}
    .emi-gold{color:#C8A96A}
    .flex-between{display:flex;justify-content:space-between;align-items:center}
    .flex-left{display:flex;align-items:center;gap:10px}
    .stat-grid{display:grid;grid-template-columns:repeat(2,1fr);gap:8px;text-align:center}
    .stat-box{background:#F8F6F2;border:1px solid #E8DCC8;border-radius:8px;padding:10px 6px}
    .stat-box .s{font-weight:700;color:#C8A96A;font-size:14px}
    .stat-box .n{font-size:11px;color:#6B6B6B;margin-top:2px}
    .tag{background:#F5EDD8;color:#8A6C2A;border-radius:6px;padding:2px 8px;font-size:11px;font-weight:600}
    .divider{border:none;border-top:1px solid #E8DCC8;margin:12px 0}

    /* Tab bar */
    .tab-bar{display:flex;background:#fff;border-bottom:1px solid #E8DCC8;position:sticky;top:0;z-index:10}
    .tab-item{flex:1;text-align:center;padding:13px 0;font-size:14px;font-weight:600;color:#9A9087;cursor:pointer;border-bottom:3px solid transparent;transition:all .2s}
    .tab-item.active{color:#C8A96A;border-bottom-color:#C8A96A;background:#FFFDF9}

    /* Product list wrapper */
    .product-list-wrap{padding:16px}
    .product-list{display:none}
    .product-list.active{display:block}

    /* Product card */
    .pkg-photo{width:56px;height:56px;border-radius:10px;object-fit:cover;border:2px solid #E8DCC8;flex-shrink:0}
    .pkg-name{font-family:'Playfair Display',serif;font-size:15px;font-weight:700;color:#1C1C1C;margin:0 0 4px}
    .pkg-vip{display:inline-flex;align-items:center;gap:4px;background:#F5EDD8;color:#8A6C2A;border-radius:6px;padding:2px 7px;font-size:11px;font-weight:600}

    /* Modal overlay */
    .lay{position:fixed;left:0;top:0;background:rgba(0,0,0,.5);width:100%;height:100%;z-index:998;display:none}

    /* Product dialog */
    #product_dialog{position:fixed;top:50%;left:50%;transform:translate(-50%,-50%);width:92%;max-width:420px;background:#fff;border-radius:16px;z-index:999;box-shadow:0 12px 40px rgba(200,169,106,.25);overflow:hidden;display:none}
    .dialog-header{background:linear-gradient(135deg,#C8A96A 0%,#D6A86B 100%);padding:16px}
    .dialog-header-inner{display:flex;align-items:center;gap:12px}
    .product_dialog_image{width:56px;height:56px;border-radius:10px;object-fit:cover;border:2px solid rgba(255,255,255,.4)}
    .product_title{font-family:'Playfair Display',serif;font-size:16px;font-weight:700;color:#fff;margin:0 0 4px}
    .vip_level{background:rgba(255,255,255,.25);color:#fff;border-radius:6px;padding:2px 8px;font-size:11px;font-weight:600}
    .dialog-body{padding:16px}
    .dialog-row{display:flex;justify-content:space-between;align-items:center;padding:9px 0;border-bottom:1px solid #F0EAD8}
    .dialog-row:last-child{border-bottom:none}
    .dialog-row .lbl{font-size:13px;color:#6B6B6B}
    .dialog-row .val{font-size:14px;font-weight:700;color:#C8A96A}
    .buy_btn{background:#C8A96A;color:#fff;border:none;border-radius:8px;padding:12px;font-weight:700;font-size:15px;width:100%;cursor:pointer;margin-top:4px}
    .buy_btn:hover{background:#D6A86B}
    .dialog-close{position:absolute;top:12px;right:14px;background:rgba(255,255,255,.25);border:none;color:#fff;border-radius:50%;width:28px;height:28px;font-size:16px;cursor:pointer;display:flex;align-items:center;justify-content:center;line-height:1}

    .hide{display:none}
  </style>
</head>
<body>

{{-- Modal overlay --}}
<div class="lay" onclick="closeModal()"></div>

{{-- Product Dialog Modal --}}
<div id="product_dialog" class="layui-form">
  <input type="hidden" id="product_id" name="product_id" value="">
  <div class="dialog-header" style="position:relative">
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
    <div class="dialog-row"><span class="lbl">Duração do Rendimento</span><span class="val product_days">–</span></div>
    <div class="dialog-row"><span class="lbl daily_income_text">Renda Diária</span><span class="val product_daily_income">–</span></div>
    <div class="dialog-row"><span class="lbl">Renda Total</span><span class="val product_total_income">–</span></div>
    <div class="dialog-row"><span class="lbl">Investimento Máximo</span><span class="val product_maximum_share">–</span></div>
    <hr class="divider">
    <div class="dialog-row"><span class="lbl">Valor a Pagar</span><span class="val product_pay_money">–</span></div>
    <div class="dialog-row"><span class="lbl">Rendimento Total Estimado</span><span class="val product_pay_total_income">–</span></div>
    <button class="buy_btn" onclick="buyConfirm()">Investir Agora</button>
  </div>
</div>

{{-- Page header --}}
<div class="emi-header">
  <div style="font-family:'Playfair Display',serif;font-size:20px;font-weight:700">Planos de Investimento</div>
  <div style="font-size:12px;opacity:.85;margin-top:2px">Escolha o plano ideal para você</div>
</div>

{{-- Tab bar --}}
<div class="tab-bar">
  <div class="tab-item active" data-type="1" onclick="setActiveTab(1)">Fixo</div>
  <div class="tab-item" data-type="2" onclick="setActiveTab(2)">Welfare</div>
  <div class="tab-item" data-type="3" onclick="setActiveTab(3)">Premium</div>
</div>

@php
$harmonieThumbs = [
  'Harmonie I – Perrier-Jouët'  => '/images/experiencias/harmonie-1-perrier-jouet.jpg',
  'Harmonie II – Ruinart'       => '/images/experiencias/harmonie-2-ruinart.jpg',
  'Harmonie III – Dom Pérignon' => '/images/experiencias/harmonie-3-dom-perignon.jpg',
  'Harmonie IV – Krug'          => '/images/experiencias/harmonie-4-krug.jpg',
];
@endphp

{{-- Product lists --}}
<div class="product-list-wrap">

  <div id="fixed_fund" class="product-list active">
    @foreach ($packages as $package)
      @if ($package->category == 'fixed')
        <div class="emi-card" onclick="buyDialog(
          '{{ $package->id }}',
          '{{ $package->name }}',
          '{{ $harmonieThumbs[$package->name] ?? asset($package->photo) }}',
          '{{ price($package->price) }}',
          '{{ $package->validity }}',
          '{{ priceDecimal($package->commission_with_avg_amount / $package->validity) }}',
          '{{ priceDecimal($package->commission_with_avg_amount) }}',
          '{{ $package->max_purchase_limit }}',
          '{{ $package->vip_level ?? 0 }}',
          '',
          'Days',
          'Renda Diária'
        )" style="cursor:pointer">
          <div class="flex-left" style="margin-bottom:12px">
            <img src="{{ $harmonieThumbs[$package->name] ?? asset($package->photo) }}" class="pkg-photo" alt="{{ $package->name }}">
            <div style="flex:1;min-width:0">
              <div class="pkg-name">{{ $package->name }}</div>
              <span class="pkg-vip">VIP{{ $package->vip_level ?? 0 }}</span>
            </div>
            <div style="text-align:right">
              <div style="font-size:18px;font-weight:700;color:#C8A96A">{{ price($package->price) }}</div>
              <div style="font-size:11px;color:#6B6B6B">por unidade</div>
            </div>
          </div>
          <div class="stat-grid" style="grid-template-columns:repeat(3,1fr);margin-bottom:12px">
            <div class="stat-box">
              <div class="s">{{ $package->validity }}d</div>
              <div class="n">Duração</div>
            </div>
            <div class="stat-box">
              <div class="s">{{ priceDecimal($package->commission_with_avg_amount / $package->validity) }}</div>
              <div class="n">Renda Diária</div>
            </div>
            <div class="stat-box">
              <div class="s">{{ priceDecimal($package->commission_with_avg_amount) }}</div>
              <div class="n">Total</div>
            </div>
          </div>
          <div class="emi-btn">Investir</div>
        </div>
      @endif
    @endforeach
    <div class="none_data hide" style="text-align:center;padding:40px 0;color:#9A9087">
      <p>Nenhum plano disponível</p>
    </div>
  </div>

  <div id="welfare_fund" class="product-list">
    @foreach ($packages as $package)
      @if ($package->category == 'welfare')
        <div class="emi-card" onclick="buyDialog(
          '{{ $package->id }}',
          '{{ $package->name }}',
          '{{ $harmonieThumbs[$package->name] ?? asset($package->photo) }}',
          '{{ price($package->price) }}',
          '{{ $package->validity }}',
          '{{ priceDecimal($package->commission_with_avg_amount / $package->validity) }}',
          '{{ priceDecimal($package->commission_with_avg_amount) }}',
          '{{ $package->max_purchase_limit }}',
          '{{ $package->vip_level ?? 0 }}',
          '',
          'Days',
          'Renda Diária'
        )" style="cursor:pointer">
          <div class="flex-left" style="margin-bottom:12px">
            <img src="{{ $harmonieThumbs[$package->name] ?? asset($package->photo) }}" class="pkg-photo" alt="{{ $package->name }}">
            <div style="flex:1;min-width:0">
              <div class="pkg-name">{{ $package->name }}</div>
              <span class="pkg-vip">VIP{{ $package->vip_level ?? 0 }}</span>
            </div>
            <div style="text-align:right">
              <div style="font-size:18px;font-weight:700;color:#C8A96A">{{ price($package->price) }}</div>
              <div style="font-size:11px;color:#6B6B6B">por unidade</div>
            </div>
          </div>
          <div class="stat-grid" style="grid-template-columns:repeat(3,1fr);margin-bottom:12px">
            <div class="stat-box">
              <div class="s">{{ $package->validity }}d</div>
              <div class="n">Duração</div>
            </div>
            <div class="stat-box">
              <div class="s">{{ priceDecimal($package->commission_with_avg_amount / $package->validity) }}</div>
              <div class="n">Renda Diária</div>
            </div>
            <div class="stat-box">
              <div class="s">{{ priceDecimal($package->commission_with_avg_amount) }}</div>
              <div class="n">Total</div>
            </div>
          </div>
          <div class="emi-btn">Investir</div>
        </div>
      @endif
    @endforeach
    <div class="none_data hide" style="text-align:center;padding:40px 0;color:#9A9087">
      <p>Nenhum plano disponível</p>
    </div>
  </div>

  <div id="activity_fund" class="product-list">
    @foreach ($packages as $package)
      @if ($package->category == 'activity')
        <div class="emi-card" onclick="buyDialog(
          '{{ $package->id }}',
          '{{ $package->name }}',
          '{{ $harmonieThumbs[$package->name] ?? asset($package->photo) }}',
          '{{ price($package->price) }}',
          '{{ $package->validity }}',
          '{{ priceDecimal($package->commission_with_avg_amount / $package->validity) }}',
          '{{ priceDecimal($package->commission_with_avg_amount) }}',
          '{{ $package->max_purchase_limit }}',
          '{{ $package->vip_level ?? 0 }}',
          '',
          'Days',
          'Renda Diária'
        )" style="cursor:pointer">
          <div class="flex-left" style="margin-bottom:12px">
            <img src="{{ $harmonieThumbs[$package->name] ?? asset($package->photo) }}" class="pkg-photo" alt="{{ $package->name }}">
            <div style="flex:1;min-width:0">
              <div class="pkg-name">{{ $package->name }}</div>
              <span class="pkg-vip">VIP{{ $package->vip_level ?? 0 }}</span>
            </div>
            <div style="text-align:right">
              <div style="font-size:18px;font-weight:700;color:#C8A96A">{{ price($package->price) }}</div>
              <div style="font-size:11px;color:#6B6B6B">por unidade</div>
            </div>
          </div>
          <div class="stat-grid" style="grid-template-columns:repeat(3,1fr);margin-bottom:12px">
            <div class="stat-box">
              <div class="s">{{ $package->validity }}d</div>
              <div class="n">Duração</div>
            </div>
            <div class="stat-box">
              <div class="s">{{ priceDecimal($package->commission_with_avg_amount / $package->validity) }}</div>
              <div class="n">Renda Diária</div>
            </div>
            <div class="stat-box">
              <div class="s">{{ priceDecimal($package->commission_with_avg_amount) }}</div>
              <div class="n">Total</div>
            </div>
          </div>
          <div class="emi-btn">Investir</div>
        </div>
      @endif
    @endforeach
    <div class="none_data hide" style="text-align:center;padding:40px 0;color:#9A9087">
      <p>Nenhum plano disponível</p>
    </div>
  </div>

</div>

@include('alert-message')

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
function buyDialog(id, name, image, price, days, daily, total, max, vip, currency, unit, incomeLabel) {
  document.getElementById('product_id').value = id;
  document.querySelector('.product_dialog_image').src = image;
  document.querySelector('.product_title').innerText = name;
  document.querySelector('.product_price').innerText = price;
  document.querySelector('.product_days').innerText = days + ' ' + unit;
  document.querySelector('.product_daily_income').innerText = daily;
  document.querySelector('.product_total_income').innerText = total;
  document.querySelector('.product_maximum_share').innerText = max;
  document.querySelector('.product_pay_money').innerText = price;
  document.querySelector('.product_pay_total_income').innerText = total;
  document.querySelector('.vip_level').innerText = 'VIP' + vip;
  document.querySelector('.daily_income_text').innerText = incomeLabel;
  document.getElementById('product_dialog').style.display = 'block';
  document.querySelector('.lay').style.display = 'block';
}

function closeModal() {
  document.getElementById('product_dialog').style.display = 'none';
  document.querySelector('.lay').style.display = 'none';
}

function setActiveTab(type) {
  document.querySelectorAll('.tab-item').forEach(t => t.classList.remove('active'));
  document.querySelector('.tab-item[data-type="' + type + '"]').classList.add('active');
  document.getElementById('fixed_fund').style.display = 'none';
  document.getElementById('welfare_fund').style.display = 'none';
  document.getElementById('activity_fund').style.display = 'none';
  if (type === 1) document.getElementById('fixed_fund').style.display = 'block';
  else if (type === 2) document.getElementById('welfare_fund').style.display = 'block';
  else if (type === 3) document.getElementById('activity_fund').style.display = 'block';
}

function buyConfirm() {
  const productId = document.getElementById('product_id').value;
  window.location.href = '/purchase/confirmation/' + productId;
}
</script>

</body>
</html>
