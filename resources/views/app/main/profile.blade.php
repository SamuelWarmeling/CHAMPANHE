<html>
 <head> 
  <meta charset="utf-8"> 
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1"> 
  <title>My</title> 
  <link rel="stylesheet" href="/v2/layui/css/layui.css"> 
  <link rel="stylesheet" href="/v2/css/swiper-bundle.min.css"> 
  <link rel="stylesheet" href="/v2/css/common.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/layui/2.5.7/css/layui.min.css">
  <style>
        .common_body{
            background: #F5F7F8;
            background-image: url("/v2/img/account/bg.png");
            background-size: 100%;
            background-repeat: no-repeat;
        }
    </style> 
 </head> 
 <body class="common_body"> 
  <div class="index_header position" style="background: none;border-radius: 0 0 20px 20px;padding: 20px;height: 100px"> 
   <div class="index_banner flex_space" style="margin-top: 0px"> 
    <div class="flex_left"> 
     <img src="{{setting('logo')}}" class="user_avatar" style=""> 
     <div> 
      <div class="label user_nickname">
      ID: 【 ACTIVE 】
      </div> 
      <div class="title user_username" style="margin-top: 10px">
       {{substr(auth()->user()->phone, 0, 3)}}******{{substr(strrev(auth()->user()->phone), 0, 2)}} 【ID:{{user()->ref_id}}】
      </div> 
     </div> 
    </div> 
    <div class="flex_space"> 
     <a href="#" class="setting" style="width: 30px;height: 30px;line-height:30px;border-radius: 50%;text-align:center;background: rgba(255,255,255,0.8);margin-right: 10px;"> <img src="/v2/img/account/setting.png" style="height: 20px;width: 20px;"> </a> 
     <a href="#" style="width: 30px;height: 30px;line-height:30px;border-radius: 50%;text-align:center;background: rgba(255,255,255,0.8);"> <img src="/v2/img/account/notice.png" style="height:20px;width: 20px;"> </a> 
    </div> 
   </div> 
  </div> 

    @php
    $vipLevel = $user->vip_level ?? 0;
    $totalInvestment = \App\Models\Purchase::where('user_id', auth()->id())->sum('amount');

    $vipTargets = [
        1 => 500,
        2 => 1000,
        3 => 2000,
        4 => 4000,
        5 => 8000,
        6 => 16000,
        7 => 32000,
        8 => 64000,
        9 => 128000,
        10 => 256000,
    ];

    $nextVipLevel = $vipLevel < 10 ? $vipLevel + 1 : 10;
    $nextTarget = $vipTargets[$nextVipLevel] ?? $totalInvestment;

    $progressPercent = $nextTarget > 0 ? min(100, ($totalInvestment / $nextTarget) * 100) : 0;
@endphp
    <div class="user_main"> 
  <a href="/vip" class="user_vip_card position common_margin_15" style="margin-bottom:0px;display: block"> 
    <div class="flex_space"> 
      <div class="user_vip_card_left"> 
        <div class="my_vip flex_left"> 
          <img src="/v2/img/vip/vip_icon.png" style="width: 20px;height: 20px;display: inline"> 
          <p style="font-weight:bold;font-size: 16px;color: #FFE9B5;border-right: 2px solid #FFE9B5;padding-right: 10px;height:20px;line-height: 22px">
            VIP LEVEL
          </p> 
          <div class="user_vip_level" style="border-radius:4px;padding:0 4px;margin-left:10px;width: 40px;height: 20px;line-height:20px;text-align:center;color:#fff;background: linear-gradient(270deg, #83848B 0%, #C2C3C3 100%);">
            VIP {{ $vipLevel }}
          </div> 
        </div> 

        <div> 
          <div class="flex_space"> 
            <div class="layui-progress" lay-filter="demo-filter-progress" style="width: 100%;margin-top: 10px;height: 10px;"> 
              <div class="layui-progress-bar" lay-percent="{{ number_format($totalInvestment, 2) }} / {{ number_format($nextTarget, 2) }}" style="width: {{ number_format($progressPercent, 2) }}%;"></div> 
            </div> 
          </div> 
          <div style="margin-top:5px;color: #ffffff">
            Current progress {{ number_format($totalInvestment, 2) }} / {{ number_format($nextTarget, 2) }}
          </div> 
        </div> 
      </div> 

      <div class="user_vip_card_right">
        <img src="/v2/img/vip/lv{{ $vipLevel }}.png" style="width: 36px;height:36px;">
      </div> 
    </div> 
  </a>  

   <div class="user_balance_card common_margin_15 flex_space" style="margin-top: 0px"> 
    <a href="/recharge" class="flex_center" style="width: 49%;border-right: 2px solid #F5F7F8"> <img src="/v2/img/account/recharge.png" style="width: 26px;height: 26px"> 
     <div class="user_balance_card_right">
       Recharge 
      <i class="layui-icon layui-icon-right"></i>
     </div> </a> 
    <a href="/withdraw" class="flex_center" style="width: 49%"> <img src="/v2/img/account/withdraw.png" style="width: 26px;height: 26px"> 
     <div class="user_balance_card_right">
       Withdrawal 
      <i class="layui-icon layui-icon-right"></i>
     </div> </a> 
   </div> 
   <div class="index_menu common_margin_15"> 
    <a href="/orders" class="nav nav_active"> <img src="/v2/img/account/orders.png" style="width: 30px;height: 30px"> <p class="title">My Orders</p> </a> 
    <a href="/balanceDetails" class="nav nav_active"> <img src="/v2/img/account/balance.png" style="width: 30px;height: 30px"> <p class="title">My Bill</p> </a> 
    <a href="/team" class="nav nav_active"> <img src="/v2/img/account/team.png" style="width: 30px;height: 30px"> <p class="title">My Team</p> </a> 
    <a href="/add-bank" class="nav nav_active"> <img src="/v2/img/account/wallet.png" style="width: 30px;height: 30px"> <p class="title">Bank Card</p> </a> 
   </div> 
   <div class="common_card common_margin_15"> 
    <div style="border-bottom: 1px solid #F6F6F6;padding: 10px 0"> 
     <a href="/balanceDetails" class="flex_space"> 
      <div class="common_item_title">
       My Income
      </div> 
      <div class="common_item_desc" style="margin-top: 0px">
       Income Details &gt;
      </div> </a> 
    </div> 
    <div class="flex_space" style="border-bottom: 1px solid #F6F6F6;padding: 10px 0"> 
     <div> 
      <div class="label" style="margin-top: 0px;color: #888888;text-align: center">
       Recharge Balance
      </div> 
      <div class="value recharge_balance" style="font-size: 18px;color: #5274F0;font-weight: 700;margin-top: 10px;text-align: center">
       {{ price(auth()->user()->balance) }}
      </div> 
     </div> 
     <div> 
      <div class="label" style="margin-top: 0px;color: #888888;text-align: center">
       Withdrawal Balance
      </div> 
      <div class="value withdraw_balance" style="font-size: 18px;color: #5274F0;font-weight: 700;margin-top: 10px;text-align: center">
       {{ price(auth()->user()->balance) }}
      </div> 
     </div> 
    </div> 
    <div class="flex_space" style="border-bottom: 1px solid #F6F6F6;padding: 10px 0"> 
     <div> 
      <div class="label" style="margin-top: 0px;color: #888888;text-align: center">
       Product Income
      </div> 
      <div class="value product_income" style="font-size: 18px;color: #5274F0;font-weight: 700;margin-top: 10px;text-align: center">
       {{ price(\App\Models\UserLedger::where('user_id', auth()->id())->where('reason', 'balance_added')->sum('amount')) }}
      </div> 
     </div> 
     <div> 
      <div class="label" style="margin-top: 0px;color: #888888;text-align: center">
       Order Num
      </div> 
      <div class="value order_num" style="font-size: 18px;color: #5274F0;font-weight: 700;margin-top: 10px;text-align: center">
       {{ \App\Models\Purchase::where('user_id', auth()->id())->count() }}
      </div> 
     </div> 
    </div> 
   </div> 

<div class="user_list">
  <div style="padding: 10px">
    <div class="item_title">
      More Services
    </div>
  </div>

  <div class="cards_container">
    <a href="/vip" class="card">
      <div class="card_content">
        <img src="/v2/img/account/vip.png" alt="VIP">
        <p class="title">VIP</p>
      </div>
    </a>

    <a href="/help" class="card">
      <div class="card_content">
        <img src="/v2/img/account/help.png" alt="Help Center">
        <p class="title">Help Center</p>
      </div>
    </a>

    <a href="https://t.me/profelartech" class="card">
      <div class="card_content">
        <img src="/v2/img/account/telegram.png" alt="Telegram">
        <p class="title">Telegram</p>
      </div>
    </a>

    <a href="/setting" class="card">
      <div class="card_content">
        <img src="/v2/img/account/info.png" alt="Setting">
        <p class="title">Setting</p>
      </div>
    </a>
  </div>
</div>

<style>
.user_list {
  padding: 10px;
}

.item_title {
  font-weight: bold;
  font-size: 16px;
  margin-bottom: 10px;
}

.cards_container {
  display: flex;
  flex-direction: column;
  gap: 12px;
}

.card {
  width: 100%;
  background: #fff;
  border-radius: 12px;
  box-shadow: 0 4px 6px rgba(0,0,0,0.1);
  text-decoration: none;
  transition: transform 0.2s, box-shadow 0.2s;
  overflow: hidden; /* ensures content stays inside card */
}

.card_content {
  display: flex;
  align-items: center;
  padding: 15px;
}

.card img {
  width: 40px;
  height: 40px;
  margin-right: 12px;
  flex-shrink: 0; /* prevent image from shrinking */
}

.card .title {
  font-size: 16px;
  font-weight: 500;
  color: #333;
  margin: 0;
}

.card:hover {
  transform: translateY(-2px);
  box-shadow: 0 6px 12px rgba(0,0,0,0.15);
}
</style>

   <div class="user_list" style="padding: 15px;border-radius:8px;text-align: center;"> 
    <a href="/logout" class="logout"><i class="layui-icon layui-icon-logout"></i> Logout</a> 
   </div> 
  </div> 
   
    <span class="swiper-notification" aria-live="assertive" aria-atomic="true"></span>
   </div> 
  </div> 
  <div class="footer_menu"> 
   <div class="content"> 
    <a href="/" class="item " style="margin-top: 10px;"> <img src="/v2/img/footer/home.png"> <p>Home</p> </a> 
    <a href="/product" class="item " style="margin-top: 10px;"> <img src="/v2/img/footer/invest.png"> <p>Invest</p> </a> 
    <a href="/invitation" class="item" style="padding: 0px;position: relative"> <img src="/v2/img/footer/invite.png" style="width:80px;height: 80px;margin-top: -25px; "> </a> 
    <a href="/blog" class="item " style="margin-top: 10px;"> <img src="/v2/img/footer/blog.png"> <p>Blog</p> </a> 
    <a href="/my" class="item active" style="margin-top: 10px;"> <img src="/v2/img/footer/account_active.png"> <p>Account</p> </a> 
   </div> 
  </div> 
 </body>
</html>