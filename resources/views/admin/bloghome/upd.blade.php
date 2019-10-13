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
                <div class="layui-card-header">編輯模板</div>
                <form class="layui-form layui-card-body" action="javascript:">
                   <input type="hidden" name="id" value=<?php echo $data['id']; ?> >
                  <div class="layui-form-item">
                    <label class="layui-form-label">模板名称</label>
                    <div class="layui-input-block">
                      <input type="text" name="home_name" value=<?php echo $data['home_name']; ?>  required  lay-verify="required" placeholder="请输入模板名称" autocomplete="off" class="layui-input">
                    </div>
                  </div>

                  <div class="layui-form-item">
                    <label class="layui-form-label">网名</label>
                    <div class="layui-input-block">
                      <input type="text" name="net" value=<?php echo $data['net']; ?>  required  lay-verify="required" placeholder="请输入网名" autocomplete="off" class="layui-input">
                    </div>
                  </div>

                  <div class="layui-form-item">
                    <label class="layui-form-label">职业</label>
                    <div class="layui-input-block">
                      <input type="text" name="occupation" value=<?php echo $data['occupation']; ?>  required  lay-verify="required" placeholder="请输入职业" autocomplete="off" class="layui-input">
                    </div>
                  </div>

                  <div class="layui-form-item">
                    <label class="layui-form-label">邮箱</label>
                    <div class="layui-input-block">
                      <input type="text" name="email" value=<?php echo $data['email']; ?>  required  lay-verify="required" placeholder="请输入邮箱" autocomplete="off" class="layui-input">
                    </div>
                  </div>

                  <div class="layui-form-item">
                    <label class="layui-form-label">爱好</label>
                    <div class="layui-input-block">
                      <input type="text" name="hobby" value=<?php echo $data['hobby']; ?>  required  lay-verify="required" placeholder="请输入爱好,多选用逗号隔开" autocomplete="off" class="layui-input">
                    </div>
                  </div>

                  <div class="layui-form-item">
                    <label class="layui-form-label">座右铭</label>
                    <div class="layui-input-block">
                      <input type="text" name="motto" value=<?php echo $data['motto']; ?>  required  lay-verify="required" placeholder="请输入座右铭" autocomplete="off" class="layui-input">
                    </div>
                  </div>

                  <div class="layui-form-item">
                    <label class="layui-form-label">底部座右铭</label>
                    <div class="layui-input-block">
                      <input type="text" name="btm_motto" value=<?php echo $data['btm_motto']; ?>  required  lay-verify="required" placeholder="请输入底部座右铭" autocomplete="off" class="layui-input">
                    </div>
                  </div>

                  <div class="layui-form-item">
                    <label class="layui-form-label">友情链接</label>
                    <div class="layui-input-block">
                      <input type="text" name="friendship_link" value=<?php echo $data['friendship_link']; ?>  required  lay-verify="required" placeholder="多链接用逗号隔开" autocomplete="off" class="layui-input">
                    </div>
                  </div>
                  <div class="layui-form-item">
                    <label class="layui-form-label">链接地址</label>
                    <div class="layui-input-block">
                      <input type="text" name="link_address" value=<?php echo $data['link_address']; ?>  required  lay-verify="required" placeholder="与友情链接对应,用逗号隔开" autocomplete="off" class="layui-input">
                    </div>
                  </div>

                  <div class="layui-form-item">
                    <label class="layui-form-label">首页广播</label>
                    <div class="layui-input-block">
                      <input type="text" name="notice" required value=<?php echo $data['notice']; ?>  lay-verify="required" placeholder="请输入" autocomplete="off" class="layui-input">
                    </div>
                  </div>

                  <!-- logo图回显 -->
                  <div class="layui-form-item">
                    <div class="layui-input-block" id='logn-img'>
                    
                        <!-- <img  height="150" width="150" src="http://blog.com/static/upload/logo1543658284.png">  -->
                        <img  height="150" width="150" name="logo" src=<?php echo $data['logo']; ?>  > 
                    </div>
                  </div>
                  <div class="layui-form-item">
                    <div class="layui-input-block">
                        <button type="button" class="layui-btn" name='logo'  id="logo">
                        <i tyle='file' class="layui-icon">&#xe67c;</i>上传logo
                      </button>
                    </div>
                  </div>

                  <!-- 轮播图回显 -->
                  <div class="layui-form-item" >
                    <div class="layui-input-block" id='banner-img'>
 
                      <?php foreach($data['banner'] as $v): ?>
                        <img  height="150" width="150" class="banner" src=<?php echo $v; ?>  > 
                      <?php endforeach; ?>

                        <!-- <img  height="200" width="200" src="http://www.beishusoft.com/common/common/getcode?action=common/wx/getWxuser?token=c64bb94838416f5dcb0747c3daccf2b5">  -->
                    </div>
                  </div>
                  <div class="layui-form-item">
                    <div class="layui-input-block">
                      <button  type="button" class="layui-btn" id="banner">
                        <i class="layui-icon">&#xe67c;</i>首页轮播
                      </button>
                      <button  type="button" class="layui-btn" id="clean">
                        <i class="layui-icon"></i>清除图片
                      </button>
                    </div>
                  </div>
                 
                  <div class="layui-form-item">
                    <div class="layui-input-block">
                      <button class="layui-btn layui-btn-blue" id='btn' lay-submit lay-filter="formDemo">立即提交</button>
                      <a type="reset" href="{{url('admin/bloghome/list')}}" class="layui-btn layui-btn-primary">返回</a>
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

      //上传轮播图片,执行实例
      layui.use('upload', function(){
        var upload = layui.upload;
        
        //上传图片,执行实例
        var uploadInst = upload.render({
          elem: '#banner' //绑定元素
          ,url: "{{url('common/common/upload')}}" //上传接口
          ,field:'banner'
          ,done: function(res){
            //上传完毕回调
            var html = '<img  height="150" class="banner" name="banner" width="150" src="' + res.url + '">';
            $('#banner-img').append(html);
            console.log(res)
          }
          ,error: function(){
            //请求异常回调
          }
        });
      });

      //清除圖片按鈕
      $("#clean").on('click',function(){
          $('#banner-img').html('');
      });


      //提交按钮
      $('#btn').on('click',function(){
          var id = $("input[name='id']").val();//模板id
          var home_name = $("input[name='home_name']").val();//模板名称
          var net = $("input[name='net']").val();  //网名
          var occupation = $("input[name='occupation']").val();//职业
          var email = $("input[name='email']").val();//邮箱
          var hobby = $("input[name='hobby']").val();//爱好
          var motto = $("input[name='motto']").val();//座右铭
          var btm_motto = $("input[name='btm_motto']").val();//底部座右铭
          var friendship_link = $("input[name='friendship_link']").val();//友情链接
          var link_address = $("input[name='link_address']").val();//链接地址
          var notice = $("input[name='notice']").val();  //首页广播
          var logo = $("[name='logo']").attr("src");
          var banners = $(".banner");
          
          var ishttps = 'https:' == document.location.protocol ? true: false;
          var url = window.location.host;
          if(ishttps){
             url = 'https://' + url;
          }else{
             url = 'http://' + url;
          }
          var banner = new Array();
          $.each(banners,function(i,item){
            banner[i] =  item.src.replace(url,'');
          });

          if(home_name == '' || net == '' || occupation == '' || email == '' || hobby == '' || motto == '' || btm_motto == '' || friendship_link == '' || link_address == '' || notice == '' || logo == '' || banner == ''){
            return;
          }

          var token= "{{csrf_token()}}"

          $.ajax({
              type:"post",
              url:"{{url('admin/bloghome/upd')}}",
              data:{
                id:id,
                home_name:home_name,
                net:net,
                occupation:occupation,
                email:email,
                hobby:hobby,
                motto:motto,
                btm_motto:btm_motto,
                friendship_link:friendship_link,
                link_address:link_address,
                notice:notice,
                logo:logo, 
                banner:banner,
                _token:token,
              },
              dataType:'json',
              success:function(data){
                  if(data.code == 200){
                  layer.alert(data.msg,{
                      icon:1,
                      skin:'layer-ext-yourskin'
                    })
                    location="{{url('admin/bloghome/list')}}";
                  }else{
                    layer.alert(data.msg,{
                      icon:2,
                      skin:'layer-ext-yourskin'
                    })
                  }
              }
          });
       

      });
      







   






    </script>
</body>
</html>