<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="stylesheet" href="/admin/home/assets/css/layui.css">
    <link rel="stylesheet" href="/admin/home/assets/css/view.css"/>
    <script src="/admin/home/jquery-1.10.2.js"></script>  
    <title></title>
</head>
<body class="layui-view-body">
    <div class="layui-content">
        <div class="layui-row">
            <div class="layui-card">
                <div class="layui-card-header">表单</div>
                <form class="layui-form layui-card-body" action="javascript:">
                  <div class="layui-form-item">
                    <label class="layui-form-label">账号</label>
                    <div class="layui-input-block">
                      <input type="text" name="username" required  lay-verify="required" placeholder="请输入手机号" autocomplete="off" class="layui-input">
                    </div>
                  </div>

                  <div class="layui-form-item">
                    <label class="layui-form-label">昵称</label>
                    <div class="layui-input-block">
                      <input type="text" name="nickname" required  lay-verify="required" placeholder="请输入网名" autocomplete="off" class="layui-input">
                    </div>
                  </div>

                  <div class="layui-form-item">
                    <label class="layui-form-label">密码</label>
                    <div class="layui-input-block">
                      <input type="password" name="password" required  lay-verify="required" placeholder="请输入密码" autocomplete="off" class="layui-input">
                    </div>
                  </div>

                  <!-- logo图回显 -->
                  <div class="layui-form-item">
                    <div class="layui-input-block" id='logn-img'>
                        <!-- <img  height="150" width="150" src="http://blog.com/static/upload/logo1543658284.png">  -->
                    </div>
                  </div>
                  <div class="layui-form-item">
                    <div class="layui-input-block">
                        <button type="button" class="layui-btn" name='logo'  id="logo">
                        <i tyle='file' class="layui-icon">&#xe67c;</i>上传头像
                      </button>
                    </div>
                  </div>
                 
                  <div class="layui-form-item">
                    <div class="layui-input-block">
                      <button class="layui-btn layui-btn-blue" id='btn' lay-submit lay-filter="formDemo">立即提交</button>
                      <a type="reset" href="{{url('admin/user/list')}}" class="layui-btn layui-btn-primary">返回</a>
                    </div>
                  </div>
                </form>  
            </div>
        </div>
    </div>
    <script src="/admin/home/assets/layui.all.js"></script>
    <script>
      var form = layui.form
        ,layer = layui.layer;

      //上传logo图片,执行实例
      layui.use('upload', function(){
        var upload = layui.upload;
        
        //上传logo图片,执行实例
        var uploadInst = upload.render({
          elem: '#logo' //绑定元素
          ,url: "{{url('common/common/upload')}}" //上传接口
          ,field:'logo'
          ,done: function(res){

            var html = '<img  height="150" name="logo" width="150" src="' + res.url + '">';
            $('#logn-img').html(html);
          }
          ,error: function(){
            //请求异常回调
          }
        });
      });

      //提交按钮
      $('#btn').on('click',function(){
          var username = $("input[name='username']").val();//账号
          var password = $("input[name='password']").val();//昵称
          var nickname = $("input[name='nickname']").val();//密码
          var logo = $("[name='logo']").attr("src");
          
          if(username == '' || !logo || logo == '' || password == '' || nickname == ''){
            return;
          }
          var token= "{{csrf_token()}}"
          if(!(/^1[34578]\d{9}$/.test(username))){ 
            layer.alert('账号只能是手机号',{
                  icon:2,
                  time:1000,
                  skin:'layer-ext-yourskin'
                })  
            return false; 
          } 
          $.ajax({
              type:"post",
              url:"{{url('admin/user/add')}}",
              data:{
                username:username, 
                nickname:nickname, 
                password:password, 
                logo:logo, 
                _token:token,
              },
              dataType:'json',
              success:function(data){
                  if(data.code == 200){
                  layer.alert(data.msg,{
                      icon:3,
                      time:2000,
                      skin:'layer-ext-yourskin'
                    })
                    location="{{url('admin/user/list')}}";
                  }else{
                    layer.alert(data.msg,{
                      icon:2,
                      time:3000,
                      skin:'layer-ext-yourskin'
                    })
                  }
              }
          });
      });
    </script>
</body>
</html>