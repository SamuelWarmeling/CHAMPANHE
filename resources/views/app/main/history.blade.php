<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
<title>Meu Extrato – EMI</title>
<link rel="stylesheet" href="/v2/layui/css/layui.css">
<link rel="stylesheet" href="/v2/css/common.css">
<link rel="stylesheet" href="/v2/css/emi-theme.css">
<style>
body{
  margin:0;
  background:#F8F6F2;
  font-family: Arial, sans-serif;
}

/* Tabs */
.common_nav_menu{
  display:flex;
  justify-content:space-between;
  background:#fff;
  margin:15px;
  border-radius:12px;
  overflow:hidden;
  box-shadow:0 6px 18px rgba(0,0,0,.08);
}
.nav{
  flex:1;
  text-align:center;
  padding:12px 0;
  cursor:pointer;
  font-size:15px;
  color:#666;
}
.nav_active{
  background: linear-gradient(135deg, #C8A96A 0%, #D6A86B 100%);
  color:#fff;
  font-weight:700;
}

/* History List */
.history-wrap{
  padding:15px;
}

/* Card */
.history-card{
  background:#fff;
  border-radius:16px;
  padding:14px 16px;
  margin-bottom:14px;
  box-shadow:0 10px 24px rgba(0,0,0,.07);
  border-left:5px solid transparent;
}

/* Credit / Debit */
.history-card.in{
  border-color:#C8A96A;
}
.history-card.out{
  border-color:#D6A86B;
}

/* Card content */
.history-top{
  display:flex;
  justify-content:space-between;
  align-items:center;
}

.history-title{
  font-size:16px;
  font-weight:700;
  color:#222;
}

.history-amount{
  font-size:17px;
  font-weight:700;
}

.history-amount.in{
  color:#C8A96A;
}

.history-amount.out{
  color:#A3B18A;
}

.history-bottom{
  display:flex;
  justify-content:space-between;
  margin-top:6px;
  font-size:12px;
  color:#888;
}

/* No data */
.none_data{
  text-align:center;
  margin-top:40px;
  color:#888;
  display:none;
}
</style>
</head>

<body>

<!-- HEADER -->
<div class="common_header">
  <a href="javascript:history.back()" class="back position">
    <p class="btn"><i class="layui-icon layui-icon-left layui-font-20"></i></p> Meu Extrato
  </a>
</div>

<!-- FILTER TABS -->
<div class="common_nav_menu">
  <div class="nav nav_active" data-type="all">Todos</div>
  <div class="nav" data-type="recharge">Depósito</div>
  <div class="nav" data-type="withdrawal">Saque</div>
</div>

<!-- HISTORY -->
<div class="history-wrap" id="Balance_details">

  {{-- USER LEDGER --}}
  @foreach(\App\Models\UserLedger::where('user_id',auth()->id())->orderByDesc('id')->get() as $row)
  @php $credit = $row->amount >= 0; @endphp
  <div class="history-card {{ $credit ? 'in' : 'out' }}" data-type="ledger">
    <div class="history-top">
      <div class="history-title">{{ $row->reason }}</div>
      <div class="history-amount {{ $credit ? 'in' : 'out' }}">
        {{ $credit ? '+' : '-' }} {{ price(abs($row->amount)) }}
      </div>
    </div>
    <div class="history-bottom">
      <span>{{ $row->created_at }}</span>
      <span>Status: {{ ucfirst($row->status) }}</span>
    </div>
  </div>
  @endforeach

  {{-- RECHARGE --}}
  @foreach(\App\Models\Deposit::where('user_id',auth()->id())->orderByDesc('id')->get() as $row)
  <div class="history-card in" data-type="recharge">
    <div class="history-top">
      <div class="history-title">Depósito</div>
      <div class="history-amount in">+ {{ price($row->amount) }}</div>
    </div>
    <div class="history-bottom">
      <span>{{ $row->created_at }}</span>
      <span>{{ $row->method ?? 'Pagamento' }}</span>
    </div>
  </div>
  @endforeach

  {{-- WITHDRAWAL --}}
  @foreach(\App\Models\Withdrawal::where('user_id',auth()->id())->orderByDesc('id')->get() as $row)
  <div class="history-card out" data-type="withdrawal">
    <div class="history-top">
      <div class="history-title">Saque</div>
      <div class="history-amount out">- {{ price($row->amount) }}</div>
    </div>
    <div class="history-bottom">
      <span>{{ $row->created_at }}</span>
      <span>Status: {{ ucfirst($row->status) }}</span>
    </div>
  </div>
  @endforeach

</div>

<!-- SCRIPT -->
<script>
document.querySelectorAll('.nav').forEach(tab=>{
  tab.addEventListener('click',()=>{
    let type = tab.getAttribute('data-type');

    document.querySelectorAll('.nav').forEach(t=>t.classList.remove('nav_active'));
    tab.classList.add('nav_active');

    document.querySelectorAll('.history-card').forEach(card=>{
      if(type === 'all' || card.getAttribute('data-type') === type){
        card.style.display = 'block';
      }else{
        card.style.display = 'none';
      }
    });
  });
});
</script>

</body>
</html>
