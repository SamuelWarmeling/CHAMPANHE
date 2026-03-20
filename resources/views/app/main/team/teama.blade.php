<html>
 <head> 
  <meta charset="utf-8"> 
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1"> 
  <title>Team 1 Member</title> 
  <link rel="stylesheet" href="/v2/layui/css/layui.css"> 
  <link rel="stylesheet" href="/v2/css/common.css"> 
  <link rel="stylesheet" href="/v2/css/swiper-bundle.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/layui/2.5.7/css/layui.min.css">
  <style>
        .team_card{
            margin-top: 25px;
            background-color: #ffffff;
            height: 166px;
            padding: 0 17px;
            border-radius: 20px;
        }
        .member_card{
            padding: 10px;
            background: #FFFFFF;
            border-radius: 12px 12px 12px 12px;
            margin-bottom: 10px;
        }
        .active_card{
            width: 80px;
            height: 24px;
            line-height: 24px;
            background: linear-gradient( 180deg, #4A6DEB 0%, #5C7DF5 100%);
            border-radius: 0px 12px 0px 12px;
            font-family: PingFang SC, PingFang SC;
            font-weight: 400;
            font-size: 13px;
            color: #FFFFFF;
            text-align: center;
            position: absolute;
            right: 0px;
            top: 0px;
        }
    </style> 
 </head> 
 <body class="common_background" style="background-image: url(/v2/img/order/bg1.png);"> 
  <div class="common_header"> 
   <a href="javascript:history.back(-1)" class="back position"> <p class="btn"><i class="layui-icon layui-icon-left layui-font-20"></i></p> Team 1 Member </a> 
  </div> 
  <div style="margin: 15px;margin-top:20px;background: #ffffff;border-radius: 16px;"> 
   <div class="common_nav_menu flex_space" style="background: none;border-bottom: 1px solid #E8E8E8;border-radius: 0px;"> 
    <a href="/member/1" class="nav nav_active position" style="text-align: center;width: 32%;" data-type="" data-image="all"> <p class="title">Level 1</p> </a> 
    <a href="/member/2" class="nav position " style="text-align: center;width: 32%" data-image="normal"> <p class="title">Level 2</p> </a> 
    <a href="/member/3" class="nav position " style="text-align: center;width: 32%" data-type="2" data-image="finish"> <p class="title">Level 3</p> </a> 
   </div> 
   <div class="flex_left" style=""> 
    <div style="width: 50%;padding: 15px"> 
     <div class="common_item_title">
      {{$first_level_users->count()}}
     </div> 
     <div class="common_item_desc">
      Total invite
     </div> 
    </div> 
    <div style="width: 50%;padding: 15px"> 
     <div class="common_item_title">
      {{$first_level_users->where('investor', 1)->count()}}
     </div> 
     <div class="common_item_desc">
      Active
     </div> 
    </div> 
   </div> 
  </div> 
  <div style="margin: 15px;border-radius: 16px;">
      @foreach ($first_level_users as $user)
   <div class="member_card position"> 
    <div class="flex_left"> 
     <img src="{{setting('logo')}}" style="width: 50px;height: 50px;border-radius: 50%;margin-right: 5px;"> 
     <div> 
      <div class="common_item_title">
       {{ substr($user->phone, 0, 2) }}******{{ substr($user->phone, -2) }}
      </div> 
      <div class="common_item_desc">
       register time:{{ $user->created_at }}
      </div> 
     </div> 
    </div> 
   </div>@endforeach
   <!--<
   </div>-->
  </div> 
  <!--	底部内容-开始	  --> 
  <!--<a href="/help"  id="service">--> 
  <!--  <img src="/public/v1/img/common/service.png" style="width: 40px;height: 40px">--> 
  <!--</a>--> 
  <!--	底部内容-结束	  --> 
  <!-- body 末尾处引入 layui --> 
  <script>

</script> 
  <script>
    layui.use(function(){
        var $ = layui.jquery;
        var layer = layui.layer;
        var form = layui.form;
        var laydate = layui.laydate;
        var slider = layui.slider;
        var element = layui.element;
        var swiper = new Swiper(".mySwiper", {
            slidesPerView: "auto",
            centeredSlides: true,
            initialSlide :1,
            spaceBetween: 30,
            pagination: {
                el: ".swiper-pagination",
                clickable: true,
            },
            dynamicBullets: true,
            on: {
                slideChangeTransitionStart: function(){
                    // layui.layer.msg(this.activeIndex)
                    var level = this.activeIndex
                    $('.team_contents').removeClass('layui-show').addClass('layui-hide')
                    $('.team_'+level).removeClass('layui-hide').addClass('layui-show')
                },
            }
        });
    });
</script> 
 </body>
</html>