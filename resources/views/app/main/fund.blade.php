<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
  <title>Fundo de Investimento – EMI</title>
  <link rel="stylesheet" href="/v2/layui/css/layui.css">
  <link rel="stylesheet" href="/v2/css/common.css">
  <link rel="stylesheet" href="/v2/css/emi-theme.css">
  <style>
    .fund-list { padding: 15px; }
    .fund-card {
      background: #fff;
      border-radius: 12px;
      padding: 15px;
      margin-bottom: 15px;
      box-shadow: 0 4px 12px rgba(0,0,0,0.07);
    }
    .fund-header { display: flex; align-items: center; margin-bottom: 12px; }
    .fund-header img { width: 50px; height: 50px; border-radius: 8px; margin-right: 12px; }
    .fund-name { font-weight: 700; font-size: 16px; color: #1C1C1C; }
    .fund-tags { display: flex; gap: 6px; margin-top: 4px; }
    .fund-tag { background: #F8F6F2; border: 1px solid #EDE8DF; border-radius: 4px; padding: 2px 8px; font-size: 12px; color: #888; }
    .fund-stats { display: flex; justify-content: space-between; margin: 10px 0; }
    .fund-stat { text-align: center; }
    .fund-stat .s { font-weight: 700; color: #C8A96A; font-size: 15px; }
    .fund-stat .n { font-size: 12px; color: #888; margin-top: 2px; }
    .fund-btn {
      display: block;
      width: 100%;
      padding: 10px;
      background: linear-gradient(135deg, #C8A96A 0%, #D6A86B 100%);
      color: #1C1C1C;
      font-weight: 700;
      text-align: center;
      border: none;
      border-radius: 8px;
      cursor: pointer;
      font-size: 15px;
    }
    .fund-btn.streaming {
      background: #EDE8DF;
      color: #888;
      cursor: default;
    }
  </style>
</head>
<body class="common_body">

<div class="common_header">
  <a href="{{ route('dashboard') }}" class="back position">
    <p class="btn"><i class="layui-icon layui-icon-left layui-font-20"></i></p>
    Financiamento
  </a>
</div>

<div class="fund-list">
  @foreach(\App\Models\Fund::where('status', 'active')->get() as $element)
    <?php
    $myFund = \App\Models\FundInvest::where('user_id', auth()->id())->where('status', 'active')->where('fund_id', $element->id)->first();
    ?>
    <div class="fund-card">
      <div class="fund-header">
        <img src="{{ asset($element->photo) }}" alt="">
        <div>
          <div class="fund-name">{{ $element->name }}</div>
          <div class="fund-tags">
            <span class="fund-tag">Baixa barreira</span>
            <span class="fund-tag">Amigável para iniciantes</span>
          </div>
        </div>
      </div>
      <div class="fund-stats">
        <div class="fund-stat">
          <div class="s">{{ price($element->minimum_invest) }}</div>
          <div class="n">Faixa de Investimento</div>
        </div>
        <div class="fund-stat">
          <div class="s">{{ price($element->commission / $element->validity) }}</div>
          <div class="n">Rendimento Diário</div>
        </div>
        <div class="fund-stat">
          <div class="s">{{ price($element->commission) }}</div>
          <div class="n">Rendimento Total</div>
        </div>
        <div class="fund-stat">
          <div class="s">{{ $element->validity }} Dias</div>
          <div class="n">Período</div>
        </div>
      </div>
      @if($myFund)
        <button class="fund-btn streaming" disabled>Em Andamento</button>
      @else
        <button class="fund-btn" onclick="buyFund('{{ $element->id }}')">Participar</button>
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

<script>
function buyFund(id) {
  loading();
  window.location.href = '{{ url('fund-invest-confirm') }}' + '/' + id;
}
</script>

</body>
</html>
