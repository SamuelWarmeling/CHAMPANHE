<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Blog</title>
  <link rel="stylesheet" href="/v2/layui/css/layui.css">
  <link rel="stylesheet" href="/v2/css/common.css">
  <link rel="stylesheet" href="/v2/css/emi-theme.css">
  <style>
    body {
      font-family: 'Segoe UI', sans-serif;
      background: #f4f5f7 url(/v2/img/blog/bg.png) no-repeat center top;
      background-size: cover;
      margin: 0;
      padding-bottom: 80px; /* for footer */
    }

    .blog_btn {
      display: flex;
      align-items: center;
      justify-content: space-between;
      background: #5FB878;
      border-radius: 12px;
      padding: 12px 16px;
      margin: 15px;
      color: #fff;
      cursor: pointer;
      transition: background 0.3s;
      text-decoration: none;
    }
    .blog_btn:hover {
      background: #4aa061;
    }
    .blog_btn img {
      width: 36px;
      height: 36px;
      margin-right: 12px;
    }
    .blog_btn div {
      display: flex;
      flex-direction: column;
    }
    .blog_btn_title {
      font-size: 16px;
      font-weight: 600;
    }
    .blog_btn_desc {
      font-size: 12px;
      opacity: 0.8;
    }

    .blog_contents {
      margin: 0 15px;
    }

    .blog_card {
      background: #fff;
      border-radius: 12px;
      box-shadow: 0 2px 6px rgba(0,0,0,0.1);
      margin-bottom: 20px;
      overflow: hidden;
      cursor: pointer;
      transition: transform 0.2s;
    }
    .blog_card:hover {
      transform: translateY(-2px);
    }

    .blog_card .card_header {
      display: flex;
      align-items: center;
      padding: 12px 16px;
    }
    .blog_card .avatar {
      width: 40px;
      height: 40px;
      border-radius: 50%;
      margin-right: 12px;
    }
    .blog_card .info p {
      margin: 0;
    }
    .blog_card .user_nickname {
      font-weight: 600;
      color: #333;
    }
    .blog_card .user_username {
      font-size: 12px;
      color: #888;
    }

    .blog_card .contents {
      padding: 0 16px 16px 16px;
    }
    .blog_card .contents .text {
      font-size: 14px;
      color: #555;
      margin-bottom: 10px;
    }
    .blog_card .contents .blog_img {
      width: 100%;
      border-radius: 8px;
      object-fit: cover;
      height: 200px;
    }

    .blog_card .footer {
      display: flex;
      justify-content: space-between;
      padding: 12px 16px;
      font-size: 12px;
      color: #888;
      border-top: 1px solid #eee;
    }

    /* Popup */
    #popup {
      position: fixed;
      top: 0; left: 0;
      width: 100%;
      height: 100%;
      background: rgba(0,0,0,0.6);
      display: none;
      justify-content: center;
      align-items: center;
      z-index: 9999;
    }
    #popup_content {
      background: #fff;
      border-radius: 12px;
      max-width: 90%;
      max-height: 90%;
      overflow-y: auto;
      padding: 20px;
      text-align: center;
      position: relative;
    }
    #popup_content img {
      max-width: 100%;
      border-radius: 8px;
      margin-bottom: 15px;
    }
    #popup_close {
      position: absolute;
      top: 10px;
      right: 10px;
      font-size: 18px;
      cursor: pointer;
      color: #888;
    }
  </style>
</head>
<body>

<div class="common_header">
  <a href="javascript:;" class="back position">Blog</a>
</div>

<a href="/postBlog" class="blog_btn">
  <div>
    <img src="/v2/img/blog/publish.png" alt="Publish">
    <div>
      <p class="blog_btn_title">Publish</p>
      <p class="blog_btn_desc">Go publish</p>
    </div>
  </div>
</a>

<div class="blog_contents" id="blog_contents">
  @foreach(\App\Models\WithdrawProof::where('status', 'approved')->orderByDesc('id')->get() as $proof)
  <?php $user = \App\Models\User::find($proof->user_id); ?>
  <div class="blog_card" 
       data-comment="{{ $proof->comment }}" 
       data-image="{{ asset($proof->photo) }}" 
       data-reward="{{ price($proof->reward_amount) }}" 
       data-date="{{ $proof->created_at->format('Y-m-d H:i:s') }}">
    <div class="card_header">
      <img class="avatar" src="{{setting('logo')}}" alt="Avatar">
      <div class="info">
        <p class="user_nickname">User</p>
        <p class="user_username">{{ substr($user->phone ?? '********', 0, 2) }}****{{ substr($user->phone ?? '********', -2) }}</p>
      </div>
    </div>
    <div class="contents">
      <div class="text">{{ $proof->comment }}</div>
      <img class="blog_img" src="{{ asset($proof->photo) }}" alt="Proof Image">
    </div>
    <div class="footer">
      <div>{{ price($proof->reward_amount) }}</div>
      <div>{{ $proof->created_at->format('Y-m-d H:i:s') }}</div>
    </div>
  </div>
  @endforeach
</div>

<!-- Popup -->
<div id="popup">
  <div id="popup_content">
    <span id="popup_close">&times;</span>
    <div class="popup_text"></div>
    <img class="popup_image" src="" alt="Post Image">
    <div class="popup_footer"></div>
  </div>
</div>

<div class="footer_menu">
  <div class="content">
    <a href="/" class="item" style="margin-top: 10px;">
      <img src="/v2/img/footer/home.png">
      <p>Home</p>
    </a>
    <a href="/product" class="item" style="margin-top: 10px;">
      <img src="/v2/img/footer/invest.png">
      <p>Invest</p>
    </a>
    <a href="/invitation" class="item" style="padding: 0px; position: relative;">
      <img src="/v2/img/footer/invite.png" style="width: 80px; height: 80px; margin-top: -25px;">
    </a>
    <a href="/blog" class="item active" style="margin-top: 10px;">
      <img src="/v2/img/footer/blog_active.png">
      <p>Blog</p>
    </a>
    <a href="/my" class="item" style="margin-top: 10px;">
      <img src="/v2/img/footer/account.png">
      <p>Account</p>
    </a>
  </div>
</div>

<script>
  // Popup functionality
  const blogCards = document.querySelectorAll('.blog_card');
  const popup = document.getElementById('popup');
  const popupContent = document.getElementById('popup_content');
  const popupText = popupContent.querySelector('.popup_text');
  const popupImage = popupContent.querySelector('.popup_image');
  const popupFooter = popupContent.querySelector('.popup_footer');
  const popupClose = document.getElementById('popup_close');

  blogCards.forEach(card => {
    card.addEventListener('click', () => {
      popupText.textContent = card.dataset.comment;
      popupImage.src = card.dataset.image;
      popupFooter.textContent = `Reward: ${card.dataset.reward} | Date: ${card.dataset.date}`;
      popup.style.display = 'flex';
    });
  });

  popupClose.addEventListener('click', () => {
    popup.style.display = 'none';
  });

  popup.addEventListener('click', (e) => {
    if(e.target === popup) popup.style.display = 'none';
  });
</script>

</body>
</html>
