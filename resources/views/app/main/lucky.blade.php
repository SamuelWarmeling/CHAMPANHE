<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
  <title>Sorte da Fortuna – EMI</title>
  <link rel="stylesheet" href="/v2/layui/css/layui.css">
  <link rel="stylesheet" href="/v2/css/common.css">
  <link rel="stylesheet" href="/v2/css/emi-theme.css">
  <style>
    .lucky-container {
      padding: 20px 15px;
      text-align: center;
    }
    .lucky-title {
      font-size: 22px;
      font-weight: 700;
      color: #C8A96A;
      margin-bottom: 20px;
    }
    .lucky-info-card {
      background: #fff;
      border-radius: 12px;
      padding: 15px;
      margin-bottom: 15px;
      box-shadow: 0 4px 12px rgba(0,0,0,0.07);
      text-align: left;
    }
    .lucky-info-card p { margin: 6px 0; color: #555; }
    .lucky-input {
      width: 100%;
      padding: 12px;
      border-radius: 8px;
      border: 1px solid #EDE8DF;
      font-size: 16px;
      margin-bottom: 15px;
      background: #F8F6F2;
      color: #1C1C1C;
    }
    .lucky-btn {
      width: 100%;
      padding: 14px;
      background: linear-gradient(135deg, #C8A96A 0%, #D6A86B 100%);
      color: #1C1C1C;
      font-size: 16px;
      font-weight: 700;
      border: none;
      border-radius: 8px;
      cursor: pointer;
    }
    .history-link {
      display: inline-block;
      margin-top: 15px;
      color: #C8A96A;
      font-weight: 600;
      text-decoration: none;
    }
  </style>
</head>
<body class="common_body">

<div class="common_header">
  <a href="{{ route('dashboard') }}" class="back position">
    <p class="btn"><i class="layui-icon layui-icon-left layui-font-20"></i></p>
    Sorte da Fortuna
  </a>
</div>

<div class="lucky-container">
  <div class="lucky-title">Sorte da Fortuna</div>

  <div class="lucky-info-card">
    <p><strong>Regras:</strong> Você pode ganhar de 1 a 50 usando o Código de Sorte. Depende da sua roda da fortuna.</p>
    <p><strong>Valor da sorte:</strong> 1 – 5</p>
    <p><strong>Número de sorteios acumulados:</strong> 1-1</p>
  </div>

  <input type="text" name="code" class="lucky-input" placeholder="Digite seu código">
  <button class="lucky-btn" onclick="StartLucky()">Obter Oportunidade de Sorteio</button>

  <a href="{{ route('checkin.history') }}" class="history-link">Ver Histórico &gt;</a>

  <p style="margin-top: 20px; color: #888; font-size: 13px;">
    Acompanhe nosso grupo oficial para obter códigos de sorteio!
  </p>
</div>

@include('alert-message')
@include('loading')
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
<script>
  function StartLucky(){
      loading();
      $.ajaxSetup({
          headers: {
              'X-CSRF-TOKEN': '{{csrf_token()}}'
          }
      });

      var code = document.querySelector('input[name="code"]').value;
      if (code == ''){
          loadingOff();
          message('Digite o código de sorteio.');
          return 0;
      }

      $.ajax({
          url: "{{url('submit-bonus-amount')}}"+"/"+code,
          type: 'get',
          dataType: 'json',
          success: function(res) {
              document.querySelector('input[name="code"]').value = '';
              loadingOff();
              if (res.status == true){
                  msg('Sucesso!');
                  setTimeout(function (){
                      msgOff();
                  }, 500);
              }else {
                  message(res.error);
              }
          }
      });
  }
</script>
</body>
</html>
