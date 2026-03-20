<html>
 <head> 
  <meta charset="utf-8"> 
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1"> 
  <title>withdraw</title> 
  <link rel="stylesheet" href="/v2/layui/css/layui.css"> 
  <link rel="stylesheet" href="/v2/css/common.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/layui/2.5.7/css/layui.min.css">
  <style>
    .layui-input{
        height: 44px;line-height: 44px;background: #FFFFFF;border-radius: 8px 8px 8px 8px;border: 1px solid #DEDEDE;
    }

    </style> 
 </head>
 <body class="common_background" style="   background-image: url(/v2/img/user/recharge_bg.png);">
<div class="common_header">
    <a href="javascript:history.back(-1)" class="back position">
        <p class="btn"><i class="layui-icon layui-icon-left layui-font-20"></i></p>
        withdraw    </a>
</div>
<script id="BalanceTpl" type="text/html">
    <div class="common_margin_10 common_padding_10" >
        <div class="label" style="color: #DEEFFF">Balance</div>
        <div class="value commission_amount common_margin_top_10" style="font-weight: 700;font-size: 22px;color: #FFFFFF;"></div>
    </div>
</script>
<div class="common_margin_15" id="balance_card" style="margin-top: 0"> <div class="common_margin_10 common_padding_10"> <div class="label" style="color: #DEEFFF">Balance</div> <div class="value commission_amount common_margin_top_10" style="font-weight: 700;font-size: 22px;color: #FFFFFF;">{{ price(auth()->user()->balance) }}</div> </div> </div>
<!-- <div class="common_card position" id="bank_card" style="margin: 15px;margin-top: 0px"> <input type="hidden" name="user_bank_id" id="user_bank_id" value="">  <a href="/bankCardInfo"   -->
  <div class="common_margin_15" id="balance_card" style="margin-top: 0">
  </div> 
  <!-- <div class="common_card position" id="bank_card" style="margin: 15px;margin-top: 0px"> <input type="hidden" name="user_bank_id" id="user_bank_id" value="">  <a href="/bankCardInfo" class="user_bank_card_bg"> <div class="card_number"></div> <div class="holder_name">Cardholder Name</div> <div class="card_holder_name"></div> </a>  </div> -->
  <div class="common_card position" style="margin: 15px;"> 
   <div class="common_card_content" style="background: #FFFFFF;"> 
    <form class="layui-form" method="post" action="{{route('user.withdraw.request')}}">
        @csrf
     <div class="demo-login-container"> 
      <div class="flex_space"> 
       <div class="input_title">
        Amount
       </div>
      </div>
      <div class="layui-form-item"> 
       <div class="layui-input-wrap"> 
        <input type="number" name="amount" id="withdrawal_amount" min="{{ $minWithdraw }}" max="{{ $maxWithdraw }}" value="" lay-verify="required" placeholder="Withdrawal amount  {{ $minWithdraw }}-{{ $maxWithdraw }}" autocomplete="off" class="layui-input"> 
       </div> 
      </div> 
      <div class="input_title">
       Transaction password
      </div> 
      <div class="layui-form-item"> 
       <div class="layui-input-wrap"> 
        <input style="" type="password" name="trade_password" value="" lay-verify="required" placeholder="Transaction password" lay-reqtext="trade password" autocomplete="off" class="layui-input" lay-affix="eye">
        <div class="layui-input-affix layui-input-suffix">
         <i class="layui-icon layui-icon-eye-invisible"></i>
        </div> 
       </div> 
      </div> 
      <div class="usdt_content hide"> 
       <div class="common_label" style="margin-top:20px;font-weight:700">
        USDT TRC-20
       </div> 
       <div class="layui-form-item"> 
        <div class="layui-form-mid" id="usdt"></div> 
       </div> 
      </div> 
      <!--                <div class="input_title">Pay Type</div>--> 
      <!--                <div class="layui-form-item">--> 
      <!--                    <input type="radio" name="is_usdt" value="0" title="₹" checked>--> 
      <!--                    <input type="radio" name="is_usdt" value="1" title="USDT" >--> 
      <!--                </div>--> 
      <div class="fixed_bottom"> 
       <div style="padding: 10px 15px;"> 
        <div class="layui-form-item" style="margin-bottom: 0px;"> 
         <button class="layui-btn layui-btn-lg layui-btn-fluid layui-btn-radius withdraw_btn" id="withdraw" lay-submit="" lay-filter="withdraw">Apply Withdrawal</button> 
        </div> 
       </div> 
      </div> 
      <a href="/withdraw/history" class="fixed_top_right" style="margin-top: 30px"> Record &gt; </a> 
     </div> 
    </form> 
   </div> 
  </div> 
  <div class="common_card position" style="margin: 15px;padding-bottom: 90px;"> 
   <div class="common_card_content"> 
    <div class="demo-login-container" style=""> 
     <p class="common_explain">Explain</p> 
     <div class="common_content"> 
      <p style="margin-bottom:10px;"> 1. Daily withdrawal time 09:00:00 - 16:30:00 </p> 
      <p style="margin-bottom:10px;"> 2. Withdraw an amount between {{ price($minWithdraw) }} and  {{ price($maxWithdraw) }} </p> 
      <p style="margin-bottom:10px;"> 3. To facilitate financial settlement, you can only request withdrawal 1 times per day </p> 
      <p style="margin-bottom:10px;"> 4. Withdrawal rate: {{ $withdrawCharge }} percent </p> 
     </div> 
    </div> 
   </div> 
  </div>
  @include('alert-message')
  <img style="position: fixed; display: none; top: 50%; left: 50%; transform: translate(-50%, -50%); width: 100%;" src="{{asset('public/loading.gif')}}" class="loading" alt="">
  <script src="https://cdnjs.cloudflare.com/ajax/libs/layui/2.5.7/layui.min.js"></script>
  <script>
    function submitWithdraw() {
      document.querySelector('.loading').style.display = 'block';
      document.querySelector('form').submit();
    }
  </script>
</body>
</html>
 