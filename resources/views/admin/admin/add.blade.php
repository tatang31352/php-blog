<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="stylesheet" href="/admin/home/assets/css/layui.css">
    <link rel="stylesheet" href="/admin/home/assets/css/view.css"/>
    <title></title>
    <script src="/admin/home/jquery-1.10.2.js"></script>  

</head>
<body class="layui-view-body">
    <div class="layui-content">
        <div class="layui-row">
            <div class="layui-card">
                <div class="layui-card-header">新增管理员</div>
                <form class="layui-form layui-card-body" action="javascript:">
                  <div class="layui-form-item">
                    <label class="layui-form-label">账户昵称</label>
                    <div class="layui-input-block">
                      <input type="text" name="username" required  lay-verify="required" placeholder="请输入昵称" autocomplete="off" class="layui-input">
                    </div>
                  </div>
                  <div class="layui-form-item">
                    <label class="layui-form-label">密码</label>
                    <div class="layui-input-inline">
                      <input type="password" name="password" required lay-verify="required" placeholder="请输入密码" autocomplete="true" class="layui-input">
                    </div>
                    <div class="layui-form-mid layui-word-aux">昵称和密码将用于登录</div>
                  </div>
                  <div class="layui-form-item">
                    <label class="layui-form-label">博客首页</label>
                    <div class="layui-input-block">
                      <select name="home" lay-verify="required">
                        <option value=""></option>
                        <?php foreach($homePage as $v): ?>
                          <option value="{{$v['id']}}">{{$v['home_name']}}</option>
                        <?php endforeach; ?>  
                      </select>
                    </div>
                  </div>

                   <div class="layui-form-item">
                    <label class="layui-form-label">关于博客</label>
                    <div class="layui-input-block">
                      <select name="blog" lay-verify="required">
                        <option value=""></option>
                        <?php foreach($blog as $v): ?>
                          <option value="{{$v['id']}}">{{$v['title']}}</option>
                        <?php endforeach; ?>
                      </select>
                    </div>
                  </div>

                   <div class="layui-form-item">
                    <label class="layui-form-label">关于作者</label>
                    <div class="layui-input-block">
                      <select name="author" lay-verify="required">
                        <option value=""></option>
                        <?php foreach($author as $v): ?>
                          <option value="{{$v['id']}}">{{$v['name']}}</option>
                        <?php endforeach; ?>
                      </select>
                    </div>
                  </div>
                 
                  <div class="layui-form-item">
                    <label class="layui-form-label">性别</label>
                    <div class="layui-input-block">
                      <input type="radio" name="sex" value="1" title="男" checked>
                      <input type="radio" name="sex" value="0" title="女">
                    </div>
                  </div>

                   <div class="layui-form-item">
                    <label class="layui-form-label">程序猿</label>
                    <div class="layui-input-block">
                      <input type="radio" name="programmer" value="1" title="是">
                      <input type="radio" name="programmer" value="0" title="否" checked>
                    </div>
                  </div>

                  <div class="layui-form-item layui-form-text">
                    <label class="layui-form-label">备注</label>
                    <div class="layui-input-block">
                      <textarea name="desc" placeholder="请输入内容" class="layui-textarea"></textarea>
                    </div>
                  </div>
                  <div class="layui-form-item">
                    <div class="layui-input-block">
                      <button class="layui-btn layui-btn-blue" id='tj' lay-submit lay-filter="formDemo">立即提交</button>
                      <a href="{{url('admin/admin/list')}}" type="reset" class="layui-btn layui-btn-primary">返回</a>
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
    </script>
</body>
<script>
  $('#tj').on('click',function(){

    var token= "{{csrf_token()}}"
    var username = $("[name='username']").val(); 
    var password = $(":password").val();
    var home = $("[name='home']").val();
    var blog = $("[name='blog']").val();
    var author = $("[name='author']").val();
    var sex = $("[name='sex']:checked").val();
    var programmer = $("[name='programmer']:checked").val();
    var Remarks =  $("[name='desc']").val(); 
    
    //昵称为空 || 密码为空 || 博客为空 || 首页为空 || 作者为空
    if(username == '' || password == '' || home == '' || blog == '' || author == ''){
      return;
    } 

    $.ajax({
        type:"post",
        data:{
          '_token':token,
          'username':username,
          'password':password,
          'home_id':home,
          'blog_id':blog,
          'author_id':author,
          'sex':sex,
          'programmer':programmer,
          'Remarks':Remarks
        },
        url:"{{url('admin/admin/add')}}",
        dataType:'json',
        success:function(data){
          if(data.status == 200){
            layer.alert(data.msg,{
              icon:1,
              skin:'layer-ext-yourskin'
            })
            location="{{url('admin/admin/list')}}";
          }else{
            layer.alert(data.msg,{
              icon:2,
              skin:'layer-ext-yourskin'
            })
          }
        }


    })
   
  })

</script>

</html>