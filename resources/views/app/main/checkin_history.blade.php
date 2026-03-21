<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
  <title>Histórico de Sorte – EMI</title>
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
    }
    .record-item {
      display: flex;
      justify-content: space-between;
      align-items: center;
    }
    .record-item .record-title { font-weight: 600; color: #1C1C1C; }
    .record-item .record-time { font-size: 12px; color: #888; margin-top: 4px; }
    .record-amount { font-size: 18px; font-weight: 700; color: #C8A96A; }
  </style>
</head>
<body class="common_body">

<div class="common_header">
  <a href="{{ route('lucky') }}" class="back position">
    <p class="btn"><i class="layui-icon layui-icon-left layui-font-20"></i></p>
    Histórico de Sorte
  </a>
</div>

<div style="padding-bottom: 20px;">
  @foreach(\App\Models\BonusLedger::where('user_id', auth()->id())->orderByDesc('id')->get() as $element)
    @if($element->amount > 0)
    <div class="record-list">
      <div class="record-item">
        <div>
          <div class="record-title">Sorte</div>
          <div class="record-time">{{ $element->date }}</div>
        </div>
        <div class="record-amount">{{ price($element->amount) }}</div>
      </div>
    </div>
    @endif
  @endforeach
</div>

</body>
</html>
