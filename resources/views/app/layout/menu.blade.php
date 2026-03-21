@include('alert-message')

@php
  $path = request()->path();
  $homeActive    = ($path === '/' || $path === '');
  $vipActive     = str_contains($path, 'vip') || str_contains($path, 'product') || str_contains($path, 'fund');
  $inviteActive  = str_contains($path, 'invite') || str_contains($path, 'task');
  $blogActive    = str_contains($path, 'withdrawal-proof') || str_contains($path, 'notice');
  $accountActive = str_contains($path, 'profile') || str_contains($path, 'mine');
@endphp

<style>
@import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&display=swap');

.footer_menu {
  position: fixed; z-index: 9999; bottom: 0; left: 0; right: 0;
  background: #FFFFFF;
  box-shadow: 0 -2px 12px rgba(200,169,106,0.12);
  padding-bottom: env(safe-area-inset-bottom, 0px);
}
.footer_menu .content {
  display: flex; width: 100%; align-items: flex-end;
  background: #FFFFFF; position: relative;
}
.footer_menu .content a {
  color: #999999 !important; text-decoration: none;
  font-family: 'Inter', sans-serif; font-weight: 500;
}
.footer_menu .content .item {
  flex: 1; padding: 10px 0 8px; text-align: center;
  display: flex; flex-direction: column; align-items: center; gap: 3px;
}
.footer_menu .content .item svg { width: 22px; height: 22px; }
.footer_menu .content .item p {
  margin: 0; font-size: 11px; color: #999; font-family: 'Inter', sans-serif;
}
.footer_menu .content .item.active svg { color: #C8A96A !important; }
.footer_menu .content .item.active p  { color: #C8A96A !important; }
.footer_menu .content .center-item {
  flex: 1; text-align: center; padding: 0 0 8px; position: relative;
  display: flex; flex-direction: column; align-items: center; gap: 3px;
}
.center-fab {
  display: inline-flex; align-items: center; justify-content: center;
  width: 50px; height: 50px; border-radius: 50%;
  background: linear-gradient(135deg, #C8A96A 0%, #D6A86B 100%);
  box-shadow: 0 4px 14px rgba(200,169,106,0.4);
  margin-top: -20px; color: #fff;
}
.center-fab svg { width: 24px; height: 24px; color: #fff; }
.center-item p {
  margin: 0; font-size: 11px; font-family: 'Inter', sans-serif;
}
.center-item.active p { color: #C8A96A !important; }
.center-item p { color: #999; }

#service {
  position: fixed; z-index: 9999; bottom: 90px; right: 0;
  width: 42px; height: 42px; padding: 9px;
  box-shadow: 0 4px 10px rgba(200,169,106,0.3);
  background: linear-gradient(135deg, #C8A96A 0%, #D6A86B 100%);
  border-radius: 12px 0 0 12px;
  display: flex; align-items: center; justify-content: center;
}
#service svg { width: 22px; height: 22px; color: #fff; }
</style>

<div class="footer_menu">
  <div class="content">

    {{-- Início --}}
    <a href="/" class="item {{ $homeActive ? 'active' : '' }}">
      <svg viewBox="0 0 24 24" fill="currentColor"><path d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z"/></svg>
      <p>Início</p>
    </a>

    {{-- Investir --}}
    <a href="/vip" class="item {{ $vipActive ? 'active' : '' }}">
      <svg viewBox="0 0 24 24" fill="currentColor"><path d="M3 13h2v7H3v-7zm4-5h2v12H7V8zm4-3h2v15h-2V5zm4 5h2v10h-2v-10zm4-3h2v13h-2V7z"/></svg>
      <p>Investir</p>
    </a>

    {{-- Center FAB --}}
    <a href="/invite" class="center-item {{ $inviteActive ? 'active' : '' }}">
      <span class="center-fab">
        <svg viewBox="0 0 24 24" fill="currentColor"><path d="M20 12v10H4V12H2v-2h20v2h-2zM6 12v8h12v-8H6zm2-6a2 2 0 0 0 0 4h4V6a2 2 0 0 0-4 0zm8 0a2 2 0 0 0-4 0v4h4a2 2 0 0 0 0-4z"/></svg>
      </span>
      <p>Tarefas</p>
    </a>

    {{-- Blog --}}
    <a href="/withdrawal-proofs" class="item {{ $blogActive ? 'active' : '' }}">
      <svg viewBox="0 0 24 24" fill="currentColor"><path d="M14 2H6a2 2 0 00-2 2v16a2 2 0 002 2h12a2 2 0 002-2V8l-6-6zm-1 1.5L18.5 9H13V3.5zM8 13h8v1.5H8V13zm0 3h8v1.5H8V16zm0-6h4v1.5H8V10z"/></svg>
      <p>Blog</p>
    </a>

    {{-- Conta --}}
    <a href="/profile" class="item {{ $accountActive ? 'active' : '' }}">
      <svg viewBox="0 0 24 24" fill="currentColor"><path d="M12 12c2.7 0 4.8-2.1 4.8-4.8S14.7 2.4 12 2.4 7.2 4.5 7.2 7.2 9.3 12 12 12zm0 2.4c-3.2 0-9.6 1.6-9.6 4.8v2.4h19.2v-2.4c0-3.2-6.4-4.8-9.6-4.8z"/></svg>
      <p>Conta</p>
    </a>

  </div>
</div>

{{-- Service / support floating button --}}
<a href="/help" id="service">
  <svg viewBox="0 0 24 24" fill="currentColor"><path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm1 17h-2v-2h2v2zm2.07-7.75l-.9.92C13.45 12.9 13 13.5 13 15h-2v-.5c0-1.1.45-2.1 1.17-2.83l1.24-1.26c.37-.36.59-.86.59-1.41 0-1.1-.9-2-2-2s-2 .9-2 2H8c0-2.21 1.79-4 4-4s4 1.79 4 4c0 .88-.36 1.68-.93 2.25z"/></svg>
</a>

<textarea style="height: 1px; opacity: 0; position: absolute; pointer-events: none;" name="copyTxt" id="copyTxt" readonly></textarea>

<script>
  layui.use(function(){
    var $ = layui.jquery;
    var layer = layui.layer;

    $('#copy').click(function () {
      var copyText = document.getElementById("copyTxt");
      copyText.select();
      document.execCommand("Copy");
      layer.msg('copy success');
    });

    $('#poster').click(function () {
      var json_data = [{"alt":"Qrcode","pid":1,"src":"https:\/\/www.elsewedyelectricnf.cc\/public\/uploads\/poster\/h5\/poster_888978_1.jpg"}];
      layer.photos({
        photos: {
          "title": "Photos Demo",
          "start": 0,
          "data": json_data
        }
      });
    });
  });
</script>
