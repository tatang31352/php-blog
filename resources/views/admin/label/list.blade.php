<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <link rel="stylesheet" href="/admin/home/assets/css/layui.css">
    <link rel="stylesheet" href="/admin/home/assets/css/view.css"/>
    <link rel="icon" href="/favicon.ico">
    <script src="/admin/home/jquery-1.10.2.js"></script>  
    <title>管理后台</title>
</head>
<body class="layui-view-body">
    <div class="layui-content">
        <div class="layui-page-header">
            <div class="pagewrap">
                <span class="layui-breadcrumb">
                  <a href="">首页</a>
                  <a href="">我的文章</a>
                  <a><cite>关于便签</cite></a>
                </span>
                <h2 class="title">标签列表</h2>
            </div>
        </div>
        <div class="layui-row">
            <div class="layui-card">
                <div class="layui-card-body">
                    <div class="form-box">
                        <a href="{{url('admin/label/add')}}" class="layui-btn layui-btn-blue"><i class="layui-icon">&#xe654;</i>新增</a>
                        <table id="demo"></table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="/admin/home/assets/layui.all.js"></script>
    <script>
      var element = layui.element;
      var table = layui.table;
      var form = layui.form;
  
      //展示已知数据
      table.render({
        elem: '#demo'
        ,cols: [[ //标题栏
          {field: 'label_id', title: 'ID', width: 180, sort: true}
          ,{field: 'label_name', title: '标签名称', width: 350}
          ,{field: 'color', title: '颜色', width: 350}
          ,{field: 'create_time', title: '修改时间', width:350}
          ,{field: 'operation', title: '操作', width: 360}
        ]]
        ,data: <?php echo $data; ?>
        ,skin: 'line' //表格风格
        ,even: true
        ,page: true //是否显示分页
        ,limits: [5, 7, 10]
        ,limit: 10 //每页默认显示的数量
      });

      //删除按钮
      $('.del').on('click',function() {
        if(!confirm('确定删除?')){
          return;
        }
        var id= $(this).parents("tr").find("div").html();
        var token= "{{csrf_token()}}";
        var _this = $(this);

        $.ajax({
            type:"post",
            data:{
                '_token':token,
                'id':id
            },
            url:"{{url('admin/label/del')}}",
            dataType:'json',
            success:function(data){
                if(data.status == 200){
                  _this.parent().parent().parent().remove();
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
</body>
</html>