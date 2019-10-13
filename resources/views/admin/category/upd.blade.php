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
                  <input type="hidden" name="id" value="<?php echo $data['category_id']; ?>">
                  <div class="layui-form-item">
                    <label class="layui-form-label">分类名称</label>
                    <div class="layui-input-block">
                      <input type="text" name="category" value="<?php echo $data['category']; ?>" required  lay-verify="required" placeholder="请输入昵称" autocomplete="off" class="layui-input">
                    </div>
                  </div>
       
                  <div class="layui-form-item">
                    <label class="layui-form-label">所属大类</label>
                    <div class="layui-input-block">
                      <input type="radio" name="sex" value="1" title="生活" <?php if($data['life'] == 1) echo 'checked'; ?> >
                      <input type="radio" name="sex" value="0" title="编程" <?php if($data['life'] == 0) echo 'checked'; ?> >
                    </div>
                  </div>


                  <div class="layui-form-item">
                    <div class="layui-input-block">
                      <button class="layui-btn layui-btn-blue" id='tj' lay-submit lay-filter="formDemo">立即提交</button>
                      <a href="{{url('admin/cat/list')}}" type="reset" class="layui-btn layui-btn-primary">返回</a>
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
    var id = $("[name='id']").val();
    var category = $("[name='category']").val(); 
    var file = $("[name='sex']:checked").val();
    
    //昵称为空 || 密码为空 || 博客为空 || 首页为空 || 作者为空
    if(category == '' || file == ''){
      return;
    } 

    $.ajax({
        type:"post",
        data:{
          '_token':token,
          'category':category,
          'life':file,
          'id':id,
        },
        url:"{{url('admin/cat/upd')}}",
        dataType:'json',
        success:function(data){
          if(data.status == 200){
            layer.alert(data.msg,{
              icon:1,
              skin:'layer-ext-yourskin'
            })
            location="{{url('admin/cat/list')}}";
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