<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
  <title>{{ $package->name }} – EMI</title>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;600;700&family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
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
    .emi-btn{background:#C8A96A;color:#fff;border:none;border-radius:8px;padding:12px 20px;font-weight:700;font-size:15px;cursor:pointer;display:block;width:100%;text-align:center;box-shadow:0 6px 16px rgba(200,169,106,.35)}
    .emi-btn:hover{background:#D6A86B}
    .emi-label{font-size:12px;color:#6B6B6B}
    .emi-value{font-size:15px;font-weight:700;color:#1C1C1C}
    .emi-gold{color:#C8A96A}
    .flex-between{display:flex;justify-content:space-between;align-items:center}
    .flex-left{display:flex;align-items:center;gap:10px}
    .stat-grid{display:grid;grid-template-columns:repeat(2,1fr);gap:8px;text-align:center}
    .stat-box{background:#F8F6F2;border:1px solid #E8DCC8;border-radius:8px;padding:12px 8px}
    .stat-box .s{font-weight:700;color:#C8A96A;font-size:15px}
    .stat-box .n{font-size:11px;color:#6B6B6B;margin-top:3px}
    .tag{background:#F5EDD8;color:#8A6C2A;border-radius:6px;padding:2px 8px;font-size:11px;font-weight:600}
    .divider{border:none;border-top:1px solid #E8DCC8;margin:12px 0}

    .detail-page{padding:16px}

    /* Hero image wrapper */
    .hero-wrap{background:linear-gradient(135deg,#C8A96A 0%,#D6A86B 100%);border-radius:14px;padding:14px;margin-bottom:12px;box-shadow:0 4px 16px rgba(200,169,106,.3)}
    .hero-wrap img{width:100%;height:auto;border-radius:10px;display:block}

    /* Key-value rows */
    .kv-row{display:flex;justify-content:space-between;align-items:center;padding:10px 0;border-bottom:1px solid #F0EAD8}
    .kv-row:last-child{border-bottom:none}
    .kv-row .lbl{font-size:13px;color:#6B6B6B}
    .kv-row .val{font-size:14px;font-weight:700;color:#1C1C1C}
    .kv-row .val.gold{color:#C8A96A}

    /* Description box */
    .desc-box{background:#FFFDF9;border:1px solid #E8DCC8;border-radius:12px;padding:16px;font-size:14px;color:#5A4C36;line-height:1.7}
    .desc-box strong{color:#1C1C1C}
    .desc-title{font-family:'Playfair Display',serif;font-size:16px;font-weight:700;color:#1C1C1C;border-left:4px solid #C8A96A;padding-left:10px;margin-bottom:12px}

    /* Loading */
    .loading{display:none;position:fixed;top:50%;left:50%;transform:translate(-50%,-50%);z-index:999}
  </style>
</head>
<body>

<div class="emi-header">
  <a href="javascript:history.back(-1)" class="emi-back">
    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" style="width:18px;height:18px"><path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7"/></svg>
    {{ $package->name }}
  </a>
</div>

@php $user = auth()->user(); @endphp

<div class="detail-page">

  {{-- Hero image --}}
  <div class="hero-wrap">
    <img src="{{ asset($package->photo) }}" alt="{{ $package->name }}">
  </div>

  {{-- Stats grid --}}
  <div class="emi-card" style="margin-bottom:12px">
    <div class="stat-grid" style="grid-template-columns:repeat(2,1fr);margin-bottom:0">
      <div class="stat-box">
        <div class="s">MIL {{ number_format($package->price, 2) }}</div>
        <div class="n">Preço de Acesso</div>
      </div>
      <div class="stat-box">
        <div class="s">{{ $package->validity }} dias</div>
        <div class="n">Duração</div>
      </div>
      <div class="stat-box">
        <div class="s">MIL {{ number_format($package->commission_with_avg_amount / $package->validity, 2) }}</div>
        <div class="n">Renda Diária</div>
      </div>
      <div class="stat-box">
        <div class="s">MIL {{ number_format($package->commission_with_avg_amount, 2) }}</div>
        <div class="n">Lucro Total</div>
      </div>
    </div>
  </div>

  {{-- Key-value detail rows --}}
  <div class="emi-card" style="margin-bottom:12px">
    <div class="kv-row">
      <span class="lbl">Preço</span>
      <span class="val gold">MIL {{ number_format($package->price, 2) }}</span>
    </div>
    <div class="kv-row">
      <span class="lbl">Duração</span>
      <span class="val">{{ $package->validity }} dias</span>
    </div>
    <div class="kv-row">
      <span class="lbl">Renda Diária</span>
      <span class="val gold">MIL {{ number_format($package->commission_with_avg_amount / $package->validity, 2) }}</span>
    </div>
    <div class="kv-row">
      <span class="lbl">Retorno Total</span>
      <span class="val gold">MIL {{ number_format($package->price + $package->commission_with_avg_amount, 2) }}</span>
    </div>
    <div class="kv-row">
      <span class="lbl">Lucro Total</span>
      <span class="val gold">MIL {{ number_format($package->commission_with_avg_amount, 2) }}</span>
    </div>
    <div class="kv-row">
      <span class="lbl">Nível Requerido</span>
      <span class="val"><span class="tag">VIP {{ $package->vip_level ?? 0 }}</span></span>
    </div>
    <div style="margin-top:14px">
      <button class="emi-btn" onclick="buyConfirm()">Investir Agora</button>
    </div>
  </div>

  {{-- Description --}}
  <div class="desc-box">
    <div class="desc-title">{{ $package->name }}</div>
    <p>Acesso: <strong>MIL {{ number_format($package->price, 2) }}</strong></p>
    <p>Período: <strong>{{ $package->validity }} dias</strong></p>
    <p>Renda diária: <strong>MIL {{ number_format($package->commission_with_avg_amount / $package->validity, 2) }}</strong></p>
    <p>Renda total: <strong>MIL {{ number_format($package->commission_with_avg_amount, 2) }}</strong></p>
    <p>Retorno total (acesso + lucro): <strong>MIL {{ number_format($package->price + $package->commission_with_avg_amount, 2) }}</strong></p>
  </div>

</div>

<div class="loading">
  <img src="{{ asset('public/loading.gif') }}" style="width:80px;" alt="Loading">
</div>

@include('alert-message')

<script src="/v2/layui/layui.js"></script>
<script>
function buyConfirm() {
  document.querySelector('.loading').style.display = 'block';
  window.location.href = '{{ url('purchase/confirmation/'.$package->id) }}';
}
</script>

</body>
</html>
