<!DOCTYPE html>
<html>
<head>
  @include('home/public/header')
  <script src="/admin/home/jquery-1.10.2.js"></script>  
</head>
<body>
<!--引入nav文件-->
@include('home/public/nav')

<div class="layui-container qf_blog_login">
  <div class="fly-panel" >
    <div class="layui-tab layui-tab-brief">
      <ul class="layui-tab-title" style="text-align: center;">
        <li class="layui-this">登陆</li>
        <li><a href="{{url('home/register')}}">注册</a></li>
      </ul>
      <div class="layui-form layui-tab-content"  style="padding: 20px 0; text-align: center;">
        <div class="layui-tab-item layui-show">
          <div class="layui-form layui-form-pane" >
              <div class="layui-form-item">
                <label for="L_email" class="layui-form-label">手机</label>
                <div class="layui-input-inline">
                  <input type="text" id="L_email" name="phone"  lay-verify="phone" autocomplete="off"  placeholder="请填写手机号" class="layui-input">
                </div>
              </div>
              <div class="layui-form-item">
                <label for="L_pass" class="layui-form-label">密码</label>
                <div class="layui-input-inline">
                  <input type="password" id="L_pass" name="password" required lay-verify="user_password"  placeholder="请填写密码" autocomplete="off" class="layui-input">
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
              <div class="layui-form-item qf_blog_login_submit">
                <button class="layui-btn" lay-filter="login_users" id='tj' lay-submit>立即登录</button>
                <span style="padding-left:20px;">
                  <a href="#">忘记密码？</a>
                </span>
              </div>
              <div class="layui-form-item qf_blog_login_app">
                <span>使用快捷账号登入</span>
                <a href="{:url('index/User/login_qq')}" onclick="layer.msg('正在通过QQ登入', {icon:16, shade: 0.1, time:0})" class="iconfont icon-qq" title="QQ登入"></a>
              </div
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<!--遮罩层-->
<div class="qf_blog_mask  layui-hide">
</div>
<!--引入底部文件-->
@include('home/public/footer')
</body>
<script type="text/javascript">
  $('#tj').on('click',function(){
      var phone = $('[name=phone]').val();
      var password = $('[name=password]').val();
      var code = $('[name=code]').val();
      var token= "{{csrf_token()}}";

      if(phone == '' || code == ''  || password == ''){
        return;
      }
      $.ajax({
          type:"post",
          data:{
            'phone':phone,
            'password':password,
            'code':code,
            '_token':token,
          },
          url:"{{url('home/login')}}",
          dataType:'json',
          success:function(data){
            if(data.status == 200){
              layer.alert(data.msg,{
                icon:3,
                time:1000,
                skin:'layer-ext-yourskin'
              }) 
              location = "{{url('/')}}";
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
</html>