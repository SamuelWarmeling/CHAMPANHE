<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Meus Pedidos – EMI</title>
  <link rel="stylesheet" href="/v2/layui/css/layui.css">
  <link rel="stylesheet" href="/v2/css/common.css">
  <link rel="stylesheet" href="/v2/css/emi-theme.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/layui/2.5.7/css/layui.min.css">
  <style>
    body {
      background-image: url('/v2/img/order/bg.png');
    }
    .nav {
      text-align: center;
      width: 32%;
      padding: 10px 0;
      cursor: pointer;
    }
    .nav_active .title {
      font-weight: bold;
      color: #C8A96A;
      border-bottom: 3px solid #C8A96A;
    }
    .product_details_card {
      background: #fff;
      border-radius: 8px;
      margin: 15px;
      padding: 15px;
      box-shadow: 0 2px 6px rgba(0,0,0,0.05);
    }
    .product_details_item {
      display: flex;
      justify-content: space-between;
      padding: 5px 0;
    }
    .product_details_name {
      font-weight: bold;
      color: #1C1C1C;
    }
    .product_details_status {
      font-size: 14px;
      padding-left: 10px;
    }
    .normal {
      color: #C8A96A;
    }
    .label {
      color: #666;
    }
    .value {
      color: #1C1C1C;
    }
    .price {
      color: #C8A96A;
    }
    .order_details {
      background: #fff;
      border: 1px solid #ccc;
      border-radius: 100px;
      padding: 3px 15px;
      font-size: 14px;
      color: #666;
      text-decoration: none;
    }
  </style>
</head>
<body class="common_background">

  <div class="common_header">
    <a href="javascript:history.back(-1)" class="back position">
      <p class="btn"><i class="layui-icon layui-icon-left layui-font-20"></i></p>
      Meus Pedidos
    </a>
  </div>

  <!-- Tabs -->
  <div class="common_nav_menu flex_space" style="margin-top: 20px; background: #ffffff">
    <div class="nav nav_active" data-type="">
      <p class="title">Todos</p>
    </div>
    <div class="nav" data-type="normal">
      <p class="title">Ativo</p>
    </div>
    <div class="nav" data-type="finish">
      <p class="title">Concluído</p>
    </div>
  </div>

<!-- Order List -->
<div class="common_main">
    <div id="order_list">
        @php
            use Carbon\Carbon;
            use App\Models\Purchase;

            $purchases = Purchase::where('user_id', auth()->id())
                ->with('package')
                ->orderByDesc('id')
                ->get();
        @endphp

        @forelse($purchases as $purchase)
            @php
                $package = $purchase->package;
                $daysPassed = Carbon::parse($purchase->created_at)->diffInDays(now());
                $dailyIncome = $purchase->daily_income ?? 0;
                $totalIncome = $dailyIncome * $daysPassed;
                $status = $purchase->status === 'active' ? 'Active' : ($purchase->status === 'pending' ? 'Pending' : 'Inactive');
            @endphp

            <div class="product_card">
                <div class="product_card_header">
                    <div class="product_name">{{ $package->name }}</div>
                    <div class="product_status {{ strtolower($status) }}">{{ $status }}</div>
                </div>
                <div class="product_card_body">
                    <div class="product_info">
                        <p class="label">Data de Compra</p>
                        <p class="value">{{ $purchase->created_at->format('Y-m-d') }}</p>
                    </div>
                    <div class="product_info">
                        <p class="label">Valor</p>
                        <p class="value price">{{ price($purchase->amount) }}</p>
                    </div>
                    <div class="product_info">
                        <p class="label">Renda Diária</p>
                        <p class="value price">{{ price($dailyIncome) }}</p>
                    </div>
                    <div class="product_info">
                        <p class="label">Renda Total</p>
                        <p class="value price">{{ price($totalIncome) }}</p>
                    </div>
                    <div class="product_info">
                        <p class="label">Validade</p>
                        <p class="value">{{ $purchase->validity }}</p>
                    </div>
                    <div class="product_info">
                        <p class="label">Categoria</p>
                        <p class="value">{{ ucfirst($purchase->category) }}</p>
                    </div>
                    @if($purchase->note)
                    <div class="product_info">
                        <p class="label">Nota</p>
                        <p class="value">{{ $purchase->note }}</p>
                    </div>
                    @endif
                </div>
            </div>
        @empty
            <div class="product_card empty_card">
                <img src="/v2/img/order/none_order.png" class="empty_img">
                <p class="empty_text">Nenhum Pedido</p>
            </div>
        @endforelse
    </div>
</div>

<!-- Modern CSS -->
<style>
.common_main {
    padding: 15px;
    display: flex;
    flex-direction: column;
    gap: 20px;
}

.product_card {
    background: #fff;
    border-radius: 16px;
    padding: 20px;
    color: #1C1C1C;
    box-shadow: 0 4px 12px rgba(0,0,0,0.07);
    transition: transform 0.2s ease, box-shadow 0.2s ease;
    border-left: 4px solid #C8A96A;
}

.product_card:hover {
    transform: translateY(-3px);
    box-shadow: 0 8px 20px rgba(200,169,106,0.2);
}

.product_card_header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 15px;
}

.product_name {
    font-size: 18px;
    font-weight: 600;
}

.product_status {
    padding: 5px 10px;
    border-radius: 12px;
    font-size: 12px;
    text-transform: uppercase;
    font-weight: 500;
}

.product_status.active {
    background-color: rgba(163,177,138,0.2);
    color: #5a7c4a;
}

.product_status.pending {
    background-color: rgba(200,169,106,0.2);
    color: #8a6c2a;
}

.product_status.inactive {
    background-color: rgba(180,120,80,0.15);
    color: #8a4a30;
}

.product_card_body {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(120px, 1fr));
    gap: 15px;
}

.product_info .label {
    font-size: 12px;
    color: #888;
}

.product_info .value {
    font-size: 14px;
    font-weight: 600;
    color: #1C1C1C;
}

.product_info .price {
    color: #C8A96A;
}

.empty_card {
    display: flex;
    flex-direction: column;
    align-items: center;
    background: transparent;
    box-shadow: none;
}

.empty_img {
    width: 160px;
}

.empty_text {
    font-weight: bold;
    font-size: 18px;
    margin-top: 15px;
    color: #888;
}
</style>


  <!-- Pure JS Tab Filter -->
  <script>
    document.addEventListener("DOMContentLoaded", function () {
      const tabs = document.querySelectorAll(".nav");
      const cards = document.querySelectorAll(".product_details_card");

      tabs.forEach(tab => {
        tab.addEventListener("click", () => {
          tabs.forEach(t => t.classList.remove("nav_active"));
          tab.classList.add("nav_active");

          const type = tab.getAttribute("data-type");

          cards.forEach(card => {
            const status = card.getAttribute("data-status");
            if (type === "" || type === status) {
              card.style.display = "block";
            } else {
              card.style.display = "none";
            }
          });
        });
      });
    });
  </script>

</body>
</html>
