<html>
 <head> 
  <meta charset="utf-8"> 
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1"> 
  <title>Detalhes da Experiência – EMI</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/layui/2.5.7/css/layui.min.css">
  <link rel="stylesheet" href="/public/site/layui/css/layui.css"> 
  <link rel="stylesheet" href="/public/site/css/common.css"> 
 </head> 
 <body class="common_body"> 
  <div class="common_header"> 
   <a href="javascript:history.back(-1)" class="back position"> <p class="btn"><i class="layui-icon layui-icon-left layui-font-20"></i></p> Detalhes da Experiência <p class="service"> <img src="/public/site/img/common/service.png"></p> </a> 
  </div>
  @php
    $user = auth()->user();
@endphp
  <div class="product_details_main"> 
   <div class="product_details_card" style="padding: 15px;"> 
    <div style="background: #C8A96A;border-radius: 16px;padding: 10px"> 
     <img src="{{ asset($package->photo) }}" style="width: 100%;height: auto;border-radius: 16px;"> 
    </div> 
   </div> 
   <div class="product_details_card"> 
    <img class="lianjie lianjie_left" src="/public/site/img/common/lianjie.png"> 
    <img class="lianjie lianjie_right" src="/public/site/img/common/lianjie.png"> 
    <div style="background: #FFFFFF;border-radius: 16px;padding: 15px"> 
     <div class="product_details_item"> 
      <div> 
       <p class="label">Acesso</p> 
       <p class="value price"><span class="unit">R</span>{{ ($package->price) }}</p> 
      </div> 
     </div> 
     <div class="product_details_item"> 
      <div style="width: 50%"> 
       <p class="label">Quantidade</p> 
       <p class="value buy_share">3</p> 
      </div> 
      <div style="width: 50%"> 
       <p class="label">Recompensa Diária</p> 
       <p class="value"><span class="unit">R</span> <span class="daily_income">{{ (($package->commission_with_avg_amount ?? 0) / $package->validity) }}</span></p> 
      </div> 
     </div> 
     <div class="product_details_item"> 
      <!--<div style="font-weight: 700;font-size: 13px;color: #17469F;height: 30px;line-height: 30px">
       MIN{{ $package->min_purchase_limit }}
      </div> 
      <div id="ID-slider-demo-value" style="width: 100%;margin-top: 12px;">
       <div class="layui-slider ">
        <div class="layui-slider-tips" style="left: 9.82659%; display: inline-block;">
         1
        </div>
        <div class="layui-slider-bar" style="background:#0062E1; width:10%;left:0;"></div>
        <div class="layui-slider-wrap" style="left:10%;">
         <div class="layui-slider-wrap-btn" style="border: 2px solid #0062E1;"></div>
        </div>
       </div>
      </div> 
      <div style="width:80px;font-weight: 700;font-size: 13px;color: #17469F;height: 30px;line-height: 30px">
       MAX{{ $package->max_purchase_limit }}
      </div>-->
     </div> 
     <div class="product_details_item"> 
      <p class="value"><span class="label">Total </span> <span class="unit">R</span> <span id="total_money">{{ ($package->price) }}</span></p> 
     </div> 
     <div class="layui-btn layui-btn-lg layui-btn-radius buy-btn layui-btn-fluid buy_btn" onclick="buyConfirm()">
      Participar Agora
     </div> 
    </div> 
   </div> 
   <div class="product_details_card"> 
    <img class="lianjie lianjie_left" src="/public/site/img/common/lianjie.png"> 
    <img class="lianjie lianjie_right" src="/public/site/img/common/lianjie.png"> 
    <div style="background: #F8F6F2;border-radius: 16px;padding: 15px"> 
     <div class="product_details_name">
         {{$package->name}}
      {{--Buy upgrade to VIP{{ $package->is_default == '1' ? '0' : $user->vip_level + 1 }}--}}
     </div> 
     <div class="product_details_item"> 
      <p class="label">Acesso</p> 
      <p class="value price"><span class="unit">R</span>{{ ($package->price) }}</p> 
     </div> 
     <div class="product_details_item"> 
      <p class="label">Revenue days</p> 
      <p class="value">{{ $package->validity }} days</p> 
     </div> 
     <div class="product_details_item"> 
      <p class="label">Recompensa Diária</p> 
      <p class="value"><span class="unit">R</span> {{ (($package->commission_with_avg_amount ?? 0) / $package->validity) }}</p> 
     </div> 
     <div class="product_details_item"> 
      <p class="label">Need Level</p> 
      <p class="value"><img src="/public/site/img/vip/lv{{ $user->vip_level ?? 0 }}.png" style="height: 18px;width: 18px"></p> 
     </div> 
     <div class="product_details_item"> 
      <p class="label">Total Income</p> 
      <p class="value"><span class="unit">R</span> {{ ($package->commission_with_avg_amount) }}</p> 
     </div> 
    </div> 
   </div> 
   <div class="product_details_card"> 
    <img class="lianjie lianjie_left" src="/public/site/img/common/lianjie.png"> 
    <img class="lianjie lianjie_right" src="/public/site/img/common/lianjie.png"> 
    <div style="background: #F8F6F2;border-radius: 16px;padding: 15px"> 
     <div class="product_details_name" style="border-left: 4px solid #EBD8A3 ;padding-left: 10px;">
       Monthly fund 
     </div> 
     <div style="font-family: Arial, Arial;font-weight: 400;font-size: 14px;color: #2A415C;line-height: 22px;"> 
      <p style="margin-bottom: 10px;">The investment amount of this product is as low as {{ price($package->price) }} </p> 
      <p style="margin-bottom: 10px;">Period：{{ $package->validity }} Days</p> 
      <p style="margin-bottom: 10px;">Total income obtained：{{ price($package->commission_with_avg_amount) }}</p> 
     </div> 
    </div> 
   </div> 
  </div> 

 
  <!-- Loader Spinner -->
  <div class="loader loading" style="display: none; position: fixed; top: 50%; left: 50%; transform: translate(-50%, -50%); z-index: 999;">
    <img src="{{ asset('public/loading.gif') }}" style="width: 100px;" alt="Loading">
  </div>

  @include('alert-message')

  <script src="/public/site/layui/layui.js"></script>
  <script>
    layui.use(['slider'], function(){
      var slider = layui.slider;
      let price = parseFloat("{{ $package->price }}");
      let min = parseInt("{{ $package->min_purchase_limit }}");
      let max = parseInt("{{ $package->max_purchase_limit }}");
      let buy_share = 1;

      // Render slider
      slider.render({
        elem: '#ID-slider-demo-value',
        value: 1,
        min: min,
        max: max,
        theme: '#0062E1',
        tips: true,
        tipsAlways: true,
        change: function(value){
          buy_share = value;
          let total_money = price * value;
          document.getElementById('total_money').innerText = total_money.toFixed(2);
          let daily = ({{ $package->commission_with_avg_amount }} / {{ $package->validity }}) * value;
          document.querySelector('.daily_income').innerText = daily.toFixed(2);
          document.querySelector('.buy_share').innerText = value;
        }
      });
    });

    function buyConfirm(){
      document.querySelector('.loading').style.display = 'block';
      window.location.href = '{{ url('purchase/confirmation/'.$package->id) }}';
    }
  </script>
</body>
</html>
