<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
  <title>Fundo de Investimento – EMI</title>
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
    .fund-tags{display:flex;gap:6px;flex-wrap:wrap}
    .fund-tag{background:#F5EDD8;color:#8A6C2A;border-radius:6px;padding:2px 8px;font-size:10px;font-weight:600}

    /* Progress bar */
    .progress-wrap{margin:12px 0 4px}
    .progress-label{display:flex;justify-content:space-between;font-size:11px;color:#6B6B6B;margin-bottom:4px}
    .progress-bar{background:#F0EAD8;border-radius:99px;height:7px;overflow:hidden}
    .progress-fill{background:linear-gradient(90deg,#C8A96A,#D6A86B);border-radius:99px;height:7px}

    /* Streaming badge */
    .badge-streaming{display:inline-flex;align-items:center;gap:5px;background:#F5EDD8;color:#8A6C2A;border-radius:20px;padding:4px 10px;font-size:11px;font-weight:600;margin-bottom:10px}
    .badge-dot{width:7px;height:7px;background:#C8A96A;border-radius:50%;animation:pulse 1.4s infinite}
    @keyframes pulse{0%,100%{opacity:1}50%{opacity:.4}}

    /* Btn disabled */
    .emi-btn-disabled{background:#EDE8DF;color:#9A9087;border:none;border-radius:8px;padding:10px 20px;font-weight:600;font-size:14px;cursor:default;display:block;width:100%;text-align:center}
  </style>
</head>
<body>

<div class="emi-header">
  <a href="{{ route('dashboard') }}" class="emi-back">
    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" style="width:18px;height:18px"><path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7"/></svg>
    Fundo de Investimento
  </a>
</div>

<div class="fund-list">
  @foreach(\App\Models\Fund::where('status', 'active')->get() as $element)
    <?php
    $myFund = \App\Models\FundInvest::where('user_id', auth()->id())->where('status', 'active')->where('fund_id', $element->id)->first();
    ?>
    <div class="emi-card">

      {{-- Header row --}}
      <div class="flex-left" style="margin-bottom:12px">
        <img src="{{ asset($element->photo) }}" class="fund-photo" alt="">
        <div style="flex:1;min-width:0">
          <div class="fund-name">{{ $element->name }}</div>
          <div class="fund-tags">
            <span class="fund-tag">Baixa barreira</span>
            <span class="fund-tag">Iniciantes</span>
          </div>
        </div>
        @if($myFund)
          <div class="badge-streaming">
            <span class="badge-dot"></span>Streaming
          </div>
        @endif
      </div>

      <hr class="divider">

      {{-- Stats grid --}}
      <div class="stat-grid" style="margin-bottom:14px">
        <div class="stat-box">
          <div class="s">{{ price($element->minimum_invest) }}</div>
          <div class="n">Mín. Invest.</div>
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

      @if($myFund)
        {{-- Active fund: show progress bar --}}
        <div class="progress-wrap">
          <div class="progress-label">
            <span>Progresso</span>
            <span>Em Andamento</span>
          </div>
          <div class="progress-bar">
            <div class="progress-fill" style="width:60%"></div>
          </div>
        </div>
        <div style="margin-top:10px;display:flex;gap:8px">
          <button class="emi-btn-disabled" disabled>Em Andamento</button>
          <button class="emi-btn" onclick="window.location.href='{{ url('my-fund') }}'">Gerenciar</button>
        </div>
      @else
        <button class="emi-btn" onclick="buyFund('{{ $element->id }}')">
          Participar
        </button>
      @endif

    </div>
  @endforeach
</div>

@include('alert-message')
@include('loading')

@if(session()->has('success'))
<script>
  msg('Sucesso!');
  setTimeout(function() { msgOff(); }, 1000);
</script>
@endif

<script src="/v2/layui/layui.js"></script>
<script>
function buyFund(id) {
  loading();
  window.location.href = '{{ url('fund-invest-confirm') }}' + '/' + id;
}
</script>

</body>
</html>
