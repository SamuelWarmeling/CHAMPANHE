<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
  <title>Avisos – EMI</title>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400;0,600;0,700;1,400&family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="/v2/layui/css/layui.css">
  <link rel="stylesheet" href="/v2/css/common.css">
  <link rel="stylesheet" href="/v2/css/emi-theme.css">
  <style>
    *{font-family:'Inter',sans-serif;box-sizing:border-box}
    body{background:#F8F6F2;color:#1C1C1C;margin:0;padding:0 0 80px}
    h1,h2,h3,.playfair{font-family:'Playfair Display',serif}
    .emi-header{background:linear-gradient(135deg,#C8A96A 0%,#D6A86B 100%);padding:14px 16px;color:#fff}
    .emi-back{display:flex;align-items:center;gap:8px;color:#fff;text-decoration:none;font-size:15px;font-weight:600}
    .emi-gold{color:#C8A96A}
    .page-wrap{padding:16px;}

    .notice-item{
      background:#fff;border:1px solid #E8DCC8;border-radius:12px;
      box-shadow:0 2px 8px rgba(200,169,106,.1);
      padding:16px;margin-bottom:10px;
      display:flex;align-items:center;gap:12px;cursor:pointer;
      transition:box-shadow 0.2s;
    }
    .notice-item:hover{box-shadow:0 4px 14px rgba(200,169,106,.2);}
    .notice-icon{
      width:42px;height:42px;border-radius:50%;flex-shrink:0;
      background:linear-gradient(135deg,#C8A96A,#D6A86B);
      display:flex;align-items:center;justify-content:center;
    }
    .notice-icon svg{width:20px;height:20px;color:#fff;}
    .notice-body{flex:1;min-width:0;}
    .notice-title{
      font-family:'Playfair Display',serif;
      font-size:15px;font-weight:600;color:#1C1C1C;
      overflow:hidden;text-overflow:ellipsis;white-space:nowrap;
      margin-bottom:4px;
    }
    .notice-preview{
      font-size:13px;color:#6B6B6B;line-height:1.5;
      display:-webkit-box;-webkit-box-orient:vertical;-webkit-line-clamp:2;
      overflow:hidden;text-overflow:ellipsis;
    }
    .notice-date{font-size:11px;color:#AAAAAA;margin-top:4px;}
    .notice-chev{color:#E8DCC8;flex-shrink:0;}
    .notice-chev svg{width:18px;height:18px;}

    .empty-state{
      text-align:center;padding:60px 20px;
    }
    .empty-state svg{width:64px;height:64px;color:#E8DCC8;margin-bottom:16px;}
    .empty-state p{font-size:14px;color:#6B6B6B;}

    /* layui modal overrides */
    .layui-panel-window{background:#FFFFFF !important;border-top:none;}
    .notice-modal-title{
      font-family:'Playfair Display',serif;
      font-size:17px;font-weight:600;color:#1C1C1C;
      padding:4px 0 12px;border-bottom:1px solid #E8DCC8;margin-bottom:12px;
    }
    .notice-modal-body{
      font-size:14px;color:#4A4A4A;line-height:1.8;
      border:none;width:100%;resize:none;background:transparent;
    }
  </style>
</head>
<body>
  <div class="emi-header">
    <a href="javascript:history.back(-1)" class="emi-back">
      <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
        <polyline points="15 18 9 12 15 6"/>
      </svg>
      Avisos
    </a>
  </div>

  <div class="page-wrap">
    <div class="mail_main" id="mailList">
      {{-- Notices rendered dynamically by JS / Blade loop if applicable --}}
    </div>
  </div>

  @include('app.layout.menu')

  <script src="/v2/layui/layui.js"></script>
  <script>
    layui.use(function(){
      var $ = layui.jquery;
      var layer = layui.layer;
      var form = layui.form;
      var laydate = layui.laydate;
      var slider = layui.slider;
      var element = layui.element;

      $('.mail').click(function(){
        var title = $(this).attr('data-title');
        var contents = $(this).attr('data-content');
        layer.open({
          type: 1,
          area: ['92%', 'auto'],
          title: false,
          closeBtn: true,
          shadeClose: true,
          content: '<div style="padding:20px;">' +
            '<div class="notice-modal-title">' + title + '</div>' +
            '<textarea class="notice-modal-body" rows="10" readonly>' + contents + '</textarea>' +
            '</div>'
        });
      });
    });
  </script>
</body>
</html>
