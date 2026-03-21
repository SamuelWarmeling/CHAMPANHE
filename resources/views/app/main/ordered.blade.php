<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
  <title>Meus Pedidos – EMI</title>
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
    .stat-grid{display:grid;grid-template-columns:repeat(3,1fr);gap:8px;text-align:center}
    .stat-box{background:#F8F6F2;border:1px solid #E8DCC8;border-radius:8px;padding:10px 6px}
    .stat-box .s{font-weight:700;color:#C8A96A;font-size:14px}
    .stat-box .n{font-size:11px;color:#6B6B6B;margin-top:2px}
    .tag{background:#F5EDD8;color:#8A6C2A;border-radius:6px;padding:2px 8px;font-size:11px;font-weight:600}
    .divider{border:none;border-top:1px solid #E8DCC8;margin:12px 0}

    /* Tab bar */
    .tab-bar{display:flex;background:#fff;border-bottom:1px solid #E8DCC8}
    .tab-item{flex:1;text-align:center;padding:13px 0;font-size:14px;font-weight:600;color:#9A9087;cursor:pointer;border-bottom:3px solid transparent;transition:all .2s}
    .tab-item.nav_active{color:#C8A96A;border-bottom-color:#C8A96A;background:#FFFDF9}

    .order-list{padding:16px}

    /* Status badges */
    .status-active{background:#EBF8E8;color:#3A7D2A;border-radius:20px;padding:3px 10px;font-size:11px;font-weight:600}
    .status-inactive{background:#F5EDD8;color:#8A6C2A;border-radius:20px;padding:3px 10px;font-size:11px;font-weight:600}
    .status-pending{background:#F0F0F0;color:#6B6B6B;border-radius:20px;padding:3px 10px;font-size:11px;font-weight:600}

    /* Accent left border */
    .card-accent-active{border-left:4px solid #5A9A3A}
    .card-accent-pending{border-left:4px solid #C8A96A}
    .card-accent-inactive{border-left:4px solid #D0C8BC}

    /* Info rows */
    .info-row{display:flex;justify-content:space-between;align-items:center;padding:5px 0}
    .info-row .lbl{font-size:12px;color:#6B6B6B}
    .info-row .val{font-size:13px;font-weight:600;color:#1C1C1C}
    .info-row .val.gold{color:#C8A96A}

    /* Empty */
    .empty-state{text-align:center;padding:60px 20px}
    .empty-state p{color:#9A9087;font-size:14px;margin:8px 0 0}
  </style>
</head>
<body>

<div class="emi-header">
  <a href="javascript:history.back(-1)" class="emi-back">
    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" style="width:18px;height:18px"><path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7"/></svg>
    Meus Pedidos
  </a>
</div>

{{-- Tab bar --}}
<div class="tab-bar">
  <div class="tab-item nav_active" data-type="">Todos</div>
  <div class="tab-item" data-type="normal">Ativo</div>
  <div class="tab-item" data-type="finish">Concluído</div>
</div>

{{-- Order list --}}
<div class="order-list" id="order_list">
  @php
    use Carbon\Carbon;
    use App\Models\Purchase;
    $purchases = Purchase::where('user_id', auth()->id())
      ->with('package')
      ->orderByDesc('id')
      ->get();
  @endphp

  @forelse($purchases as $purchase)
    @php
      $package    = $purchase->package;
      $daysPassed = Carbon::parse($purchase->created_at)->diffInDays(now());
      $dailyIncome = $purchase->daily_income ?? 0;
      $totalIncome = $dailyIncome * $daysPassed;
      $statusRaw   = $purchase->status;
      $statusLabel = $statusRaw === 'active' ? 'Ativo' : ($statusRaw === 'pending' ? 'Pendente' : 'Concluído');
      $statusClass = $statusRaw === 'active' ? 'status-active' : ($statusRaw === 'pending' ? 'status-pending' : 'status-inactive');
      $accentClass = $statusRaw === 'active' ? 'card-accent-active' : ($statusRaw === 'pending' ? 'card-accent-pending' : 'card-accent-inactive');
      $dataStatus  = $statusRaw === 'active' ? 'normal' : 'finish';
    @endphp

    <div class="emi-card {{ $accentClass }}" data-status="{{ $dataStatus }}">

      {{-- Header row --}}
      <div class="flex-between" style="margin-bottom:10px">
        <div style="font-family:'Playfair Display',serif;font-size:15px;font-weight:700;color:#1C1C1C;flex:1;min-width:0;padding-right:8px">
          {{ $package->name ?? 'Plano' }}
        </div>
        <span class="{{ $statusClass }}">{{ $statusLabel }}</span>
      </div>

      <hr class="divider" style="margin:8px 0">

      {{-- Key info rows --}}
      <div class="info-row">
        <span class="lbl">Data de Compra</span>
        <span class="val">{{ $purchase->created_at->format('d/m/Y') }}</span>
      </div>
      <div class="info-row">
        <span class="lbl">Valor Pago</span>
        <span class="val gold">{{ price($purchase->amount) }}</span>
      </div>
      <div class="info-row">
        <span class="lbl">Renda Diária</span>
        <span class="val gold">{{ price($dailyIncome) }}</span>
      </div>
      <div class="info-row">
        <span class="lbl">Renda Gerada</span>
        <span class="val gold">{{ price($totalIncome) }}</span>
      </div>
      <div class="info-row">
        <span class="lbl">Validade</span>
        <span class="val">{{ $purchase->validity }}</span>
      </div>
      <div class="info-row">
        <span class="lbl">Categoria</span>
        <span class="val">{{ ucfirst($purchase->category) }}</span>
      </div>
      @if($purchase->note)
      <div class="info-row">
        <span class="lbl">Nota</span>
        <span class="val">{{ $purchase->note }}</span>
      </div>
      @endif

    </div>
  @empty
    <div class="empty-state">
      <svg width="64" height="64" viewBox="0 0 24 24" fill="none" stroke="#E8DCC8" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/></svg>
      <p>Nenhum pedido encontrado.</p>
    </div>
  @endforelse
</div>

<script>
document.addEventListener('DOMContentLoaded', function () {
  const tabs  = document.querySelectorAll('.tab-item');
  const cards = document.querySelectorAll('#order_list [data-status]');

  tabs.forEach(tab => {
    tab.addEventListener('click', () => {
      tabs.forEach(t => t.classList.remove('nav_active'));
      tab.classList.add('nav_active');
      const type = tab.getAttribute('data-type');
      cards.forEach(card => {
        const s = card.getAttribute('data-status');
        card.style.display = (type === '' || type === s) ? 'block' : 'none';
      });
    });
  });
});
</script>

</body>
</html>
