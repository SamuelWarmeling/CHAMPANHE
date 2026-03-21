<html>
 <head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
  <title>{{ $package->name }}</title>
  <link rel="stylesheet" href="/v2/layui/css/layui.css">
  <link rel="stylesheet" href="/v2/css/common.css">
  <link rel="stylesheet" href="/v2/css/emi-theme.css">
  <style>
    .product_details_card { margin: 12px 15px; }
    .product_details_item {
      display: flex;
      justify-content: space-between;
      align-items: center;
      padding: 10px 0;
      border-bottom: 1px solid #EDE8DF;
    }
    .product_details_item:last-child { border-bottom: none; }
    .product_details_name {
      font-weight: 700;
      font-size: 16px;
      color: #1C1C1C;
      padding: 0 0 12px 0;
      border-left: 4px solid #C8A96A;
      padding-left: 10px;
      margin-bottom: 12px;
    }
    .label { font-size: 13px; color: #6B5B3E; margin: 0; }
    .value { font-size: 15px; font-weight: 600; color: #1C1C1C; margin: 0; }
    .unit  { color: #C8A96A; margin-right: 2px; }
    .buy-btn {
      display: block;
      width: 100%;
      background: linear-gradient(135deg, #C8A96A, #D6A86B);
      color: #1C1C1C !important;
      font-size: 16px;
      font-weight: 700;
      border: none;
      border-radius: 14px;
      height: 50px;
      line-height: 50px;
      text-align: center;
      margin-top: 18px;
      box-shadow: 0 6px 16px rgba(200,169,106,.35);
      cursor: pointer;
    }
    .hero-box {
      background: linear-gradient(135deg, #C8A96A 0%, #D6A86B 100%);
      border-radius: 16px;
      padding: 16px;
    }
    .info-box {
      background: #FFFFFF;
      border-radius: 16px;
      padding: 15px;
      border: 1px solid #EDE8DF;
    }
    .desc-box {
      background: #FDF6EC;
      border-radius: 16px;
      padding: 15px;
      border: 1px solid #EDE8DF;
      font-size: 14px;
      color: #6B5B3E;
      line-height: 22px;
    }
    .desc-box p { margin-bottom: 8px; }
  </style>
 </head>
 <body class="common_body">
  <div class="common_header">
   <a href="javascript:history.back(-1)" class="back position">
    <p class="btn"><i class="layui-icon layui-icon-left layui-font-20"></i></p>
    {{ $package->name }}
   </a>
  </div>
  @php $user = auth()->user(); @endphp

  <div class="product_details_main">

   {{-- Hero image --}}
   <div class="product_details_card">
    <div class="hero-box">
     <img src="{{ asset($package->photo) }}" style="width:100%;height:auto;border-radius:12px;">
    </div>
   </div>

   {{-- Quick stats --}}
   <div class="product_details_card">
    <div class="info-box">
     <div class="product_details_item">
      <p class="label">Price</p>
      <p class="value"><span class="unit">MIL</span>{{ number_format($package->price, 2) }}</p>
     </div>
     <div class="product_details_item">
      <p class="label">Duration</p>
      <p class="value">{{ $package->validity }} Days</p>
     </div>
     <div class="product_details_item">
      <p class="label">Daily Income</p>
      <p class="value"><span class="unit">MIL</span><span class="daily_income">{{ number_format($package->commission_with_avg_amount / $package->validity, 2) }}</span></p>
     </div>
     <div class="product_details_item">
      <p class="label">Total Return</p>
      <p class="value"><span class="unit">MIL</span>{{ number_format($package->price + $package->commission_with_avg_amount, 2) }}</p>
     </div>
     <div class="product_details_item">
      <p class="label">Total Profit</p>
      <p class="value"><span class="unit">MIL</span>{{ number_format($package->commission_with_avg_amount, 2) }}</p>
     </div>
     <div class="product_details_item">
      <p class="label">Required Level</p>
      <p class="value">VIP {{ $package->vip_level ?? 0 }}</p>
     </div>

     <div class="buy-btn" onclick="buyConfirm()">Invest Now</div>
    </div>
   </div>

   {{-- Description --}}
   <div class="product_details_card">
    <div class="desc-box">
     <div class="product_details_name">{{ $package->name }}</div>
     <p>Access: <strong>MIL {{ number_format($package->price, 2) }}</strong></p>
     <p>Period: <strong>{{ $package->validity }} Days</strong></p>
     <p>Daily income: <strong>MIL {{ number_format($package->commission_with_avg_amount / $package->validity, 2) }}</strong></p>
     <p>Total income: <strong>MIL {{ number_format($package->commission_with_avg_amount, 2) }}</strong></p>
     <p>Total return (access + profit): <strong>MIL {{ number_format($package->price + $package->commission_with_avg_amount, 2) }}</strong></p>
    </div>
   </div>

  </div>

  <!-- Loader -->
  <div class="loading" style="display:none;position:fixed;top:50%;left:50%;transform:translate(-50%,-50%);z-index:999;">
   <img src="{{ asset('public/loading.gif') }}" style="width:80px;" alt="Loading">
  </div>

  @include('alert-message')

  <script src="/v2/layui/layui.js"></script>
  <script>
   function buyConfirm(){
     document.querySelector('.loading').style.display = 'block';
     window.location.href = '{{ url('purchase/confirmation/'.$package->id) }}';
   }
  </script>
 </body>
</html>
