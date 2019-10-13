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
                <div class="layui-card-header">编辑标签</div>
                <form class="layui-form layui-card-body" action="javascript:">
                  <input type="hidden" name="id" value="<?php echo $data['label_id'] ?>">
                  <div class="layui-form-item">
                    <label class="layui-form-label">便签名称</label>
                    <div class="layui-input-block">
                      <input type="text" name="label_name" value="<?php echo $data['label_name']; ?>" required  lay-verify="required" placeholder="请输入分类名称" autocomplete="off" class="layui-input">
                    </div>
                  </div>
       
                  <fieldset class="layui-elem-field layui-field-title" style="margin-top: 30px;">
                    <legend>便签颜色</legend>
                  </fieldset>
                  <div style="margin-left: 30px;">
                    <div id="test8"></div>
                  </div>
                  
                  <div class="layui-form-item">
                    <div class="layui-input-block">
                      <button class="layui-btn layui-btn-blue" id='tj' lay-submit lay-filter="formDemo">立即提交</button>
                      <a href="{{url('admin/label/list')}}" type="reset" class="layui-btn layui-btn-primary">返回</a>
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
    <script>
      //颜色选择器
      layui.use('colorpicker', function(){
        var $ = layui.$
        ,colorpicker = layui.colorpicker;
         
        //预定义颜色项
        colorpicker.render({
          elem: '#test8'
          ,color: '#c71585'
          ,predefine: true // 开启预定义颜色
        });
      });
    </script>
</body>
<script>

   //回显颜色
  $(function(){
    var color = "<?php echo $data['color']; ?>";
    $(".layui-colorpicker-trigger-span").attr("style",color);
  })

  $('#tj').on('click',function(){

    var token= "{{csrf_token()}}"
    var label_name = $("[name='label_name']").val(); 
    var id = $("[name='id']").val(); 
    var color = $(".layui-colorpicker-trigger-span").attr("style");
    //昵称为空 || 密码为空 || 博客为空 || 首页为空 || 作者为空
    if(label_name == '' || color == ''){
      return;
    } 

    $.ajax({
        type:"post",
        data:{
          '_token':token,
          'label_name':label_name,
          'color':color,
          'id':id,
        },
        url:"{{url('admin/label/upd')}}",
        dataType:'json',
        success:function(data){
          if(data.status == 200){
            layer.alert(data.msg,{
              icon:1,
              skin:'layer-ext-yourskin'
            })
            location="{{url('admin/label/list')}}";
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