<html>
 <head> 
  <meta charset="utf-8"> 
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1"> 
  <title>Histórico de Saques – EMI</title> 
  <link rel="stylesheet" href="/v2/layui/css/layui.css"> 
  <link rel="stylesheet" href="/v2/css/common.css">
  <link rel="stylesheet" href="/v2/css/emi-theme.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/layui/2.5.7/css/layui.min.css">
  <style>
        .layui-layer-page {
            background-color: #FFFFFf;
        }
        .common_card{background:#FFFFFf }
        .layui-input{background: none}

        .layui-collapse{ border-radius: 15px;}
        .layui-colla-item{ }
        .layui-colla-title{
            font-family: Arial, Arial;
            font-weight: 700;
            font-size: 16px;
            color: #1C1C1C;
        }
        .layui-colla-title .success{color: #A3B18A;}
        .layui-colla-title .progress{color: #C8A96A;}
        .layui-colla-title .returned{color: #D6A86B;}
        .layui-colla-content,.layui-colla-item {
            border-top: 1px solid #dddddd;
        }
        .layui-colla-item .label {
            color: #ffffff;
        }
        .layui-colla-item .value {
            font-weight: 700;
            font-size: 16px;
            color: #ffffff;
            padding-left: 10px;
        }
        .padding{ padding: 10px 0}
        .bottom_order{
            border-bottom: 1px solid #EBEAEA;
        }
        .label{
            color: #666666 !important;
        }
        .value{
            color: #1C1C1C !important;font-weight: 700;
        }
    </style> 
 </head> 
 <body class="common_background" style="background-image: url(/v2/img/order/bg1.png);"> 
  <div class="common_header"> 
   <a href="javascript:history.back(-1)" class="back position"> <p class="btn"><i class="layui-icon layui-icon-left layui-font-20"></i></p> Histórico de Saques </a> 
  </div> 
  <div style="margin: 15px"> 
   <div class="common_card " style="background: #FFFFFF;"> 
    <p class="value" style="font-family: Arial, Arial;font-weight: 700;font-size: 18px;color:#333333;line-height: 21px;"> {{ price(auth()->user()->balance) }}</p> 
    <p class="label" style="font-family: Arial, Arial;font-weight: 400;font-size: 14px;color: #444444;line-height: 21px;"> Saldo da Conta </p> 
   </div> 
   <div style="margin-top:20px">
           @foreach(\App\Models\Withdrawal::where('user_id', auth()->id())->orderByDesc('id')->get() as $element)
    @php
        $statusColor = match($element->status) {
            'approved' => '#A3B18A',
            'progress' => '#C8A96A',
            'rejected' => '#B05030',
            default => '#D6A86B'
        };
    @endphp
    <a ref="/rechargeDetails/68202" class="common_card position" style="display:block"> 
     <div class="flex_space padding bottom_order"> 
      <p class="label">Status do Saque</p> 
      <p class="value"> <span style="color: {{ $statusColor }}">{{ ucfirst($element->status) }}</span> </p> 
     </div> 
     <div href="/withdrawRecordDetails/68202" class="flex_space padding bottom_order"> 
      <p class="label">Valor do Saque</p> 
      <p class="value position"> <span></span>{{ price($element->amount) }} </p> 
     </div> 
     <div href="/withdrawRecordDetails/68202" class="flex_space padding bottom_order"> 
      <p class="label">Valor Recebido</p> 
      <p class="value position"> <span></span>{{ price($element->final_amount) }}</p> 
     </div> 
     <div href="/withdrawRecordDetails/68202" class="flex_space padding bottom_order"> 
      <p class="label">Valor da Taxa</p> 
      <p class="value position"> <span></span> {{ price($element->charge_amount) }}</p> 
     </div> 
     <div href="/withdrawRecordDetails/68202" class="flex_space padding bottom_order"> 
      <p class="label">Data de Solicitação</p> 
      <p class="value position"> {{ $element->created_at }} </p> 
     </div> </a> @endforeach
     
   </div> 
  </div> 
 </body>
</html>