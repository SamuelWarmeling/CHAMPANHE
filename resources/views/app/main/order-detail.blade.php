<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
  <title>Detalhes do Pedido – EMI</title>
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
    .stat-grid{display:grid;grid-template-columns:repeat(2,1fr);gap:8px;text-align:center}
    .stat-box{background:#F8F6F2;border:1px solid #E8DCC8;border-radius:8px;padding:12px 8px}
    .stat-box .s{font-weight:700;color:#C8A96A;font-size:15px}
    .stat-box .n{font-size:11px;color:#6B6B6B;margin-top:3px}
    .tag{background:#F5EDD8;color:#8A6C2A;border-radius:6px;padding:2px 8px;font-size:11px;font-weight:600}
    .divider{border:none;border-top:1px solid #E8DCC8;margin:12px 0}

    .detail-page{padding:16px}

    /* Section title */
    .section-title{font-family:'Playfair Display',serif;font-size:15px;font-weight:700;color:#1C1C1C;border-left:4px solid #C8A96A;padding-left:10px;margin:0 0 12px}

    /* Key-value rows */
    .kv-row{display:flex;justify-content:space-between;align-items:center;padding:10px 0;border-bottom:1px solid #F0EAD8}
    .kv-row:last-child{border-bottom:none}
    .kv-row .lbl{font-size:13px;color:#6B6B6B}
    .kv-row .val{font-size:14px;font-weight:600;color:#1C1C1C;text-align:right}
    .kv-row .val.gold{color:#C8A96A;font-weight:700}

    /* Settlement records */
    .settle-row{display:flex;justify-content:space-between;align-items:center;padding:11px 0;border-bottom:1px solid #F0EAD8}
    .settle-row:last-child{border-bottom:none}
    .settle-date{font-size:13px;color:#6B6B6B}
    .settle-val{font-size:14px;font-weight:700;color:#C8A96A}
    .settle-sub{font-size:11px;color:#9A9087;margin-left:4px;font-weight:400}

    /* Income summary bar */
    .income-bar{background:linear-gradient(135deg,#C8A96A 0%,#D6A86B 100%);border-radius:12px;padding:16px;display:flex;justify-content:space-between;align-items:center;margin-bottom:16px}
    .income-bar .lbl{font-size:13px;color:rgba(255,255,255,.8)}
    .income-bar .val{font-size:22px;font-weight:700;color:#fff}
  </style>
</head>
<body>

<div class="emi-header">
  <a href="javascript:history.back(-1)" class="emi-back">
    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" style="width:18px;height:18px"><path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7"/></svg>
    Detalhes do Pedido
  </a>
</div>

@php
  $daysPassed      = \Carbon\Carbon::parse($purchase->created_at)->diffInDays(now());
  $dailyIncome     = $purchase->daily_income ?? 0;
  $totalIncome     = $dailyIncome * $daysPassed;
  $estimatedIncome = $dailyIncome * ($purchase->package->validity ?? 0);
@endphp

<div class="detail-page">

  {{-- Income summary bar --}}
  <div class="income-bar">
    <div>
      <div class="lbl">Renda Gerada</div>
      <div class="val">{{ price($totalIncome) }}</div>
    </div>
    <svg width="36" height="36" viewBox="0 0 24 24" fill="none" stroke="rgba(255,255,255,.6)" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
  </div>

  {{-- Product info card --}}
  <div class="emi-card">
    <div class="section-title">{{ $purchase->package->name ?? 'Produto' }}</div>

    <div class="stat-grid" style="margin-bottom:14px">
      <div class="stat-box">
        <div class="s">{{ price($purchase->amount) }}</div>
        <div class="n">Valor Pago</div>
      </div>
      <div class="stat-box">
        <div class="s">{{ $purchase->package->validity ?? 0 }}d</div>
        <div class="n">Duração</div>
      </div>
      <div class="stat-box">
        <div class="s">{{ price($dailyIncome) }}</div>
        <div class="n">Renda Diária</div>
      </div>
      <div class="stat-box">
        <div class="s">{{ price($estimatedIncome) }}</div>
        <div class="n">Renda Estimada</div>
      </div>
    </div>

    <hr class="divider">

    <div class="kv-row">
      <span class="lbl">Produto</span>
      <span class="val">{{ $purchase->package->name ?? '–' }}</span>
    </div>
    <div class="kv-row">
      <span class="lbl">Valor Pago</span>
      <span class="val gold">{{ price($purchase->amount) }}</span>
    </div>
    <div class="kv-row">
      <span class="lbl">Duração do Rendimento</span>
      <span class="val">{{ $purchase->package->validity ?? 0 }} dias</span>
    </div>
    <div class="kv-row">
      <span class="lbl">Cotas Compradas</span>
      <span class="val">{{ $purchase->share ?? '1' }}</span>
    </div>
    <div class="kv-row">
      <span class="lbl">Renda Gerada</span>
      <span class="val gold">{{ price($totalIncome) }}</span>
    </div>
    <div class="kv-row">
      <span class="lbl">Renda Estimada Total</span>
      <span class="val gold">{{ price($estimatedIncome) }}</span>
    </div>
    <div class="kv-row">
      <span class="lbl">Data de Compra</span>
      <span class="val">{{ $purchase->created_at->format('d/m/Y') }}</span>
    </div>
  </div>

  {{-- Settlement records --}}
  <div class="emi-card">
    <div class="section-title" style="margin-bottom:12px">Registros de Liquidação</div>
    <?php
      $commissions = \App\Models\UserLedger::where('user_id', auth()->id())
        ->where('reason', 'balance_added')
        ->orderByDesc('id')
        ->get();
    ?>
    @forelse($commissions as $element)
      <div class="settle-row">
        <span class="settle-date">{{ \Carbon\Carbon::parse($element->created_at)->format('d/m/Y') }}</span>
        <div>
          <span class="settle-val">{{ price($element->amount) }}</span>
          <span class="settle-sub">renda diária</span>
        </div>
      </div>
    @empty
      <div style="text-align:center;padding:24px 0;color:#9A9087;font-size:13px">
        Nenhum registro de liquidação encontrado.
      </div>
    @endforelse
  </div>

</div>

</body>
</html>
