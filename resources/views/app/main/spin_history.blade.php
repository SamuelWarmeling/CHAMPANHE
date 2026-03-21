<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
  <title>Histórico de Sorteios – EMI</title>
  <link rel="stylesheet" href="/v2/layui/css/layui.css">
  <link rel="stylesheet" href="/v2/css/common.css">
  <link rel="stylesheet" href="/v2/css/emi-theme.css">
  <style>
    .record-list {
      background: #fff;
      border-radius: 12px;
      margin: 10px 15px;
      padding: 15px;
      box-shadow: 0 4px 12px rgba(0,0,0,0.07);
      display: flex;
      align-items: center;
      gap: 12px;
    }
    .record-icon { width: 40px; height: 40px; border-radius: 8px; }
    .record-info { flex: 1; }
    .record-title { font-weight: 600; color: #1C1C1C; margin-bottom: 4px; }
    .record-time { font-size: 12px; color: #888; }
    .record-amount { font-size: 18px; font-weight: 700; color: #C8A96A; }
  </style>
</head>
<body class="common_body">

<div class="common_header">
  <a href="{{ route('span') }}" class="back position">
    <p class="btn"><i class="layui-icon layui-icon-left layui-font-20"></i></p>
    Histórico de Sorteios
  </a>
</div>

<div style="padding-bottom: 20px;">
  @foreach(\App\Models\UserLedger::where('user_id', auth()->id())->where('reason', 'spin')->orderByDesc('id')->get() as $element)
  <div class="record-list">
    <div class="record-info">
      <div class="record-title">Prêmios do Sorteio</div>
      <div class="record-time">{{ $element->created_at }}</div>
    </div>
    <div class="record-amount">{{ price($element->amount) }}</div>
  </div>
  @endforeach
</div>

</body>
</html>
