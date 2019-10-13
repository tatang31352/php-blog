<!DOCTYPE html>
<html>
<head>
  @include('home/public/header')
  <script src="/admin/home/jquery-1.10.2.js"></script>  
</head>
<body>
<!--引入nav文件-->
@include('home/public/nav')

<div class="layui-container qf_blog_reg">
  <div class="fly-panel fly-panel-user" >
    <div class="layui-tab layui-tab-brief">
      <ul class="layui-tab-title" style="text-align: center;">
        <li><a href="{{url('home/login')}}">登陆</a></li>
        <li class="layui-this">注册</li>
      </ul>
      <div class="layui-form layui-tab-content" id="LAY_ucm" style="padding: 20px 0; text-align: center;">
        <div class="layui-tab-item layui-show">
          <div class="layui-form layui-form-pane">
            <!-- <form method="post" action="javascript:"> -->
              {{ csrf_field() }}
              <div class="layui-form-item">
                <label for="L_email" class="layui-form-label">手机号</label>
                <div class="layui-input-inline">
                  <input type="text" id="L_email" name="phone"  lay-verify="phone" autocomplete="off" class="layui-input" placeholder="请填写手机号">
                </div>
                <div class="layui-input-inline">
                    <button class="layui-btn" id='dx' style="background: green">获取短信验证码</button>
                </div>    
              </div>

              <div class="layui-form-item">
                <label for="L_email" class="layui-form-label">短信验证码</label>
                <div class="layui-input-inline">
                  <input type="text" name="phone_code"  autocomplete="off" class="layui-input" placeholder="请填写4位数短信验证码">
                </div>
              </div>

              <div class="layui-form-item">
                <label for="L_nickname" class="layui-form-label">昵称</label>
                <div class="layui-input-inline">
                  <input type="text" id="L_nickname" name="nickname"  lay-verify="user_nikcname" autocomplete="off" class="layui-input" placeholder="请填写昵称">
                </div>
              </div>
              <div class="layui-form-item">
                <label for="L_pass" class="layui-form-label">密码</label>
                <div class="layui-input-inline">
                  <input type="password" id="L_pass" name="password"  lay-verify="user_password" autocomplete="off" class="layui-input" placeholder="请填写密码">
                </div>
             <!--   <div class="layui-form-mid layui-word-aux">6到16个字符</div>-->
              </div>
              <div class="layui-form-item">
                <label for="L_repass" class="layui-form-label">确认密码</label>
                <div class="layui-input-inline">
                  <input type="password" id="L_repass" name="repass"  lay-verify="user_repassword" autocomplete="off" class="layui-input"placeholder="请重复填写密码">
                </div>
              </div>
              <div class="layui-form-item">
                <label for="L_vercode" class="layui-form-label">验证码</label>
                <div class="layui-input-inline">
                  <input type="text" id="L_vercode" name="code"  lay-verify="user_code" placeholder="请输入验证码" autocomplete="off" class="layui-input">
                </div>
                <div class="layui-form-mid">
                     <img src="{{captcha_src()}}" onclick="this.src='{{captcha_src()}}'+Math.random();"
                          style="cursor: pointer;width: 120px; height: 35px; margin-top: -5px;"/>
                </div>
              </div>
              <div class="layui-form-item qf_blog_reg_submit">
                <button class="layui-btn" id='zc' lay-filter="reg_users" lay-submit="">立即注册</button>
              </div>
              <div class="layui-form-item qf_blog_reg_app">
                <span>使用快捷账号登入</span>
                <a href="{:url('index/User/login_qq')}"  onclick="layer.msg('正在通过QQ登入', {icon:16, shade: 0.5, time:500})" class="iconfont icon-qq" title="QQ登入"></a>
              </div>
            <!-- </form> -->
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<!--引入底部文件-->
@include('home/public/footer')


<script type="text/javascript">
  //发送短信接口
  $("#dx").on('click',function(){
      var phone = $('[name=phone]').val();
      var token= "{{csrf_token()}}"
      if(!(/^1[34578]\d{9}$/.test(phone))){ 
        layer.alert('手机号码有误，请重填',{
              icon:2,
              time:1000,
              skin:'layer-ext-yourskin'
            })  
        return false; 
      } 
      //定时器
      var startTime = 60;
      var newTimer = setInterval(function (){
         startTime --;
         if(startTime < 0){
             $('#dx').text('点击获取短信验证码');
             document.getElementById("dx").disabled=false;
             clearInterval(newTimer); //停止定时器
         }else{
              document.getElementById("dx").disabled=true;
              $('#dx').text(`${startTime}s后重新获取`);
              return;
         }
     },1000);

      $.ajax({
          type:"post",
          data:{
            'phone':phone,
            '_token':token,
          },
          url:"{{url('home/sms')}}",
          dataType:'json',
          success:function(data){
            if(data.status == 200){
              layer.alert(data.msg,{
                icon:1,
                time:1000,
                skin:'layer-ext-yourskin'
              }) 
            }else{
              layer.alert(data.msg,{
                icon:2,
                time:1000,
                skin:'layer-ext-yourskin'
              })
              
            }
          }
      });
  })

  //注册接口
  $("#zc").on('click',function(){
      var phone = $('[name=phone]').val();
      var phone_code = $('[name=phone_code]').val();
      var nickname = $('[name=nickname]').val();
      var password = $('[name=password]').val();
      var repass = $('[name=repass]').val();
      var code = $('[name=code]').val();
      var token= "{{csrf_token()}}"

      if(phone_code == ''){
        layer.alert('短信验证码不能为空',{
              icon:2,
              time:1000,
              skin:'layer-ext-yourskin'
          }) 
      }
      if(phone == '' || code == '' || nickname == '' || password == '' || password != repass){
        return;
      }
      $.ajax({
          type:"post",
          data:{
            'phone':phone,
            'phone_code':phone_code,
            'nickname':nickname,
            'password':password,
            'code':code,
            '_token':token,
          },
          url:"{{url('home/register')}}",
          dataType:'json',
          success:function(data){
            if(data.status == 200){
              layer.alert(data.msg,{
                icon:1,
                time:1000,
                skin:'layer-ext-yourskin'
              }) 
            }else{
              layer.alert(data.msg,{
                icon:2,
                time:1000,
                skin:'layer-ext-yourskin'
              })
            }
          }
      });

  })




      
</script>
</body>
</html>