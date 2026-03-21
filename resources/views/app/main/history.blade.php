<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
  <title>Histórico – EMI</title>
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
    .divider{border:none;border-top:1px solid #E8DCC8;margin:12px 0}

    /* Tab bar */
    .tab-bar{display:flex;background:#fff;border-bottom:1px solid #E8DCC8;position:sticky;top:0;z-index:10}
    .tab-item{flex:1;text-align:center;padding:13px 0;font-size:14px;font-weight:600;color:#9A9087;cursor:pointer;border-bottom:3px solid transparent;transition:all .2s}
    .tab-item.nav_active{color:#C8A96A;border-bottom-color:#C8A96A;background:#FFFDF9}

    .history-wrap{padding:16px}

    /* History row card */
    .history-card{background:#fff;border:1px solid #E8DCC8;border-radius:12px;box-shadow:0 2px 8px rgba(200,169,106,.1);padding:14px 16px;margin-bottom:10px;border-left:4px solid #E8DCC8}
    .history-card.in{border-left-color:#C8A96A}
    .history-card.out{border-left-color:#D0C8BC}

    .history-top{display:flex;justify-content:space-between;align-items:center}
    .history-title{font-size:14px;font-weight:600;color:#1C1C1C}
    .history-amount{font-size:15px;font-weight:700}
    .history-amount.in{color:#C8A96A}
    .history-amount.out{color:#9A9087}

    .history-bottom{display:flex;justify-content:space-between;margin-top:6px;font-size:11px;color:#9A9087}

    /* Status dot */
    .status-dot{display:inline-block;width:7px;height:7px;border-radius:50%;margin-right:4px;background:#C8A96A;vertical-align:middle}

    /* Type pill */
    .type-pill{background:#F5EDD8;color:#8A6C2A;border-radius:20px;padding:2px 8px;font-size:10px;font-weight:600}
    .type-pill.out{background:#F0EEEB;color:#9A9087}

    /* Empty */
    .empty-state{text-align:center;padding:60px 20px;display:none}
    .empty-state p{color:#9A9087;font-size:14px;margin:8px 0 0}
  </style>
</head>
<body>

<div class="emi-header">
  <a href="javascript:history.back()" class="emi-back">
    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" style="width:18px;height:18px"><path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7"/></svg>
    Histórico
  </a>
</div>

{{-- Tabs --}}
<div class="tab-bar">
  <div class="tab-item nav_active" data-type="all">Todos</div>
  <div class="tab-item" data-type="recharge">Depósito</div>
  <div class="tab-item" data-type="withdrawal">Saque</div>
</div>

{{-- History list --}}
<div class="history-wrap" id="Balance_details">

  {{-- User Ledger --}}
  @foreach(\App\Models\UserLedger::where('user_id', auth()->id())->orderByDesc('id')->get() as $row)
    @php $credit = $row->amount >= 0; @endphp
    <div class="history-card {{ $credit ? 'in' : 'out' }}" data-type="ledger">
      <div class="history-top">
        <div>
          <div class="history-title">{{ $row->reason }}</div>
          <span class="type-pill {{ $credit ? '' : 'out' }}">{{ $credit ? 'Crédito' : 'Débito' }}</span>
        </div>
        <div class="history-amount {{ $credit ? 'in' : 'out' }}">
          {{ $credit ? '+' : '-' }}{{ price(abs($row->amount)) }}
        </div>
      </div>
      <div class="history-bottom">
        <span>{{ $row->created_at }}</span>
        <span><span class="status-dot"></span>{{ ucfirst($row->status) }}</span>
      </div>
    </div>
  @endforeach

  {{-- Recharge / Deposit --}}
  @foreach(\App\Models\Deposit::where('user_id', auth()->id())->orderByDesc('id')->get() as $row)
    <div class="history-card in" data-type="recharge">
      <div class="history-top">
        <div>
          <div class="history-title">Depósito</div>
          <span class="type-pill">Entrada</span>
        </div>
        <div class="history-amount in">+{{ price($row->amount) }}</div>
      </div>
      <div class="history-bottom">
        <span>{{ $row->created_at }}</span>
        <span>{{ $row->method ?? 'Pagamento' }}</span>
      </div>
    </div>
  @endforeach

  {{-- Withdrawal --}}
  @foreach(\App\Models\Withdrawal::where('user_id', auth()->id())->orderByDesc('id')->get() as $row)
    <div class="history-card out" data-type="withdrawal">
      <div class="history-top">
        <div>
          <div class="history-title">Saque</div>
          <span class="type-pill out">Saída</span>
        </div>
        <div class="history-amount out">-{{ price($row->amount) }}</div>
      </div>
      <div class="history-bottom">
        <span>{{ $row->created_at }}</span>
        <span><span class="status-dot" style="background:#D0C8BC"></span>{{ ucfirst($row->status) }}</span>
      </div>
    </div>
  @endforeach

  {{-- Empty fallback (shown via JS if needed) --}}
  <div class="empty-state" id="empty-msg">
    <svg width="56" height="56" viewBox="0 0 24 24" fill="none" stroke="#E8DCC8" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/></svg>
    <p>Nenhuma transação encontrada.</p>
  </div>

</div>

<script>
document.querySelectorAll('.tab-item').forEach(tab => {
  tab.addEventListener('click', () => {
    const type = tab.getAttribute('data-type');
    document.querySelectorAll('.tab-item').forEach(t => t.classList.remove('nav_active'));
    tab.classList.add('nav_active');

    let visible = 0;
    document.querySelectorAll('.history-card').forEach(card => {
      const show = type === 'all' || card.getAttribute('data-type') === type;
      card.style.display = show ? 'block' : 'none';
      if (show) visible++;
    });
    document.getElementById('empty-msg').style.display = visible === 0 ? 'block' : 'none';
  });
});
</script>

</body>
</html>
