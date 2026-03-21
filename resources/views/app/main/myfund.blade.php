<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
  <title>Meus Fundos – EMI</title>
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
    .emi-btn{background:#C8A96A;color:#fff;border:none;border-radius:8px;padding:10px 20px;font-weight:600;font-size:14px;cursor:pointer;display:block;width:100%;text-align:center}
    .emi-btn:hover{background:#D6A86B}
    .emi-label{font-size:12px;color:#6B6B6B}
    .emi-value{font-size:15px;font-weight:700;color:#1C1C1C}
    .emi-gold{color:#C8A96A}
    .flex-between{display:flex;justify-content:space-between;align-items:center}
    .flex-left{display:flex;align-items:center;gap:10px}
    .stat-grid{display:grid;grid-template-columns:repeat(4,1fr);gap:8px;text-align:center}
    .stat-box{background:#F8F6F2;border:1px solid #E8DCC8;border-radius:8px;padding:10px 6px}
    .stat-box .s{font-weight:700;color:#C8A96A;font-size:13px}
    .stat-box .n{font-size:10px;color:#6B6B6B;margin-top:2px}
    .tag{background:#F5EDD8;color:#8A6C2A;border-radius:6px;padding:2px 8px;font-size:11px;font-weight:600}
    .divider{border:none;border-top:1px solid #E8DCC8;margin:12px 0}

    .fund-list{padding:16px}
    .fund-photo{width:54px;height:54px;border-radius:10px;object-fit:cover;border:2px solid #E8DCC8}
    .fund-name{font-family:'Playfair Display',serif;font-size:16px;font-weight:700;color:#1C1C1C;margin:0 0 4px}
    .badge-active{display:inline-flex;align-items:center;gap:5px;background:#F5EDD8;color:#8A6C2A;border-radius:20px;padding:4px 10px;font-size:11px;font-weight:600}
    .badge-dot{width:7px;height:7px;background:#C8A96A;border-radius:50%;animation:pulse 1.4s infinite}
    @keyframes pulse{0%,100%{opacity:1}50%{opacity:.4}}

    .emi-btn-disabled{background:#EDE8DF;color:#9A9087;border:none;border-radius:8px;padding:10px 20px;font-weight:600;font-size:14px;cursor:default;display:block;width:100%;text-align:center}

    /* Empty state */
    .empty-state{text-align:center;padding:60px 20px}
    .empty-state svg{color:#E8DCC8;margin-bottom:14px}
    .empty-state p{color:#9A9087;font-size:14px;margin:0}
  </style>
</head>
<body>

<div class="emi-header">
  <a href="javascript:history.back(-1)" class="emi-back">
    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" style="width:18px;height:18px"><path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7"/></svg>
    Meus Fundos
  </a>
</div>

<div class="fund-list">
  <?php
  $myFund = \App\Models\FundInvest::where('user_id', auth()->id())->where('status', 'active')->pluck('fund_id')->toArray();
  ?>

  @forelse(\App\Models\Fund::whereIn('id', $myFund)->get() as $element)
    <?php
    $activeFund = \App\Models\FundInvest::where('fund_id', $element->id)->where('status', 'active')->first();
    ?>
    <div class="emi-card">

      {{-- Header --}}
      <div class="flex-left" style="margin-bottom:12px">
        <img src="{{ asset($element->photo) }}" class="fund-photo" alt="">
        <div style="flex:1;min-width:0">
          <div class="fund-name">{{ $element->name }}</div>
          <div style="font-size:12px;color:#6B6B6B;margin-top:2px">
            Vencimento: <strong style="color:#C8A96A">{{ $activeFund->validity_expired }}</strong>
          </div>
        </div>
        <div class="badge-active">
          <span class="badge-dot"></span>Ativo
        </div>
      </div>

      <hr class="divider">

      {{-- Stats --}}
      <div class="stat-grid" style="margin-bottom:14px">
        <div class="stat-box">
          <div class="s">{{ price($element->minimum_invest) }}</div>
          <div class="n">Investimento</div>
        </div>
        <div class="stat-box">
          <div class="s">{{ price($element->commission / $element->validity) }}</div>
          <div class="n">Rend. Diário</div>
        </div>
        <div class="stat-box">
          <div class="s">{{ price($element->commission) }}</div>
          <div class="n">Rend. Total</div>
        </div>
        <div class="stat-box">
          <div class="s">{{ $element->validity }}d</div>
          <div class="n">Período</div>
        </div>
      </div>

      <button class="emi-btn-disabled" disabled>Em Andamento</button>
    </div>
  @empty
    <div class="empty-state">
      <svg width="64" height="64" viewBox="0 0 24 24" fill="none" stroke="#E8DCC8" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/></svg>
      <p>Nenhum fundo ativo no momento.</p>
      <a href="{{ url('fund') }}" class="emi-btn" style="margin-top:16px;max-width:200px;margin-left:auto;margin-right:auto">Ver Fundos</a>
    </div>
  @endforelse
</div>

</body>
</html>
