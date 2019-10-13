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
    <style type="text/css">.layui-table-fixed-r td{height:58px!important;}
.layui-table-fixed-r th{height:58px!important;}
.layui-table img {
 max-width: 50px;min-height: 48px;
}


.laytable-cell-3-wx_headimg ,.laytable-cell-1-wx_headimg,.laytable-cell-2-wx_headimg,.laytable-cell-3-wx_headimg,.laytable-cell-4-wx_headimg,.laytable-cell-5-wx_headimg,.laytable-cell-6-wx_headimg,.laytable-cell-7-wx_headimg,.laytable-cell-8-wx_headimg,.laytable-cell-9-wx_headimg,.laytable-cell-10-wx_headimg,.laytable-cell-11-wx_headimg,.laytable-cell-12-wx_headimg,.laytable-cell-13-wx_headimg,.laytable-cell-14-wx_headimg{
 width: 48px!important;;padding:0px!important;height: 48px!important;;
 line-height: 48px!important;;
}

</style>
</head>
<body class="layui-view-body">
    <div class="layui-content">
        <div class="layui-page-header">
            <div class="pagewrap">
                <span class="layui-breadcrumb">
                  <a href="">首页</a>
                  <a href="">我的博客</a>
                  <a><cite>关于作者</cite></a>
                </span>
                <h2 class="title">作者列表</h2>
            </div>
        </div>
        <div class="layui-row">
            <div class="layui-card">
                <div class="layui-card-body">
                    <div class="form-box">
                        <a href="{{url('admin/author/add')}}" class="layui-btn layui-btn-blue"><i class="layui-icon">&#xe654;</i>新增</a>
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
          {field: 'id', title: 'ID', width: 80, sort: true}
          ,{field: 'author_name', title: '模板名称', width: 120}
          ,{field: 'name', title: '作者姓名', width: 150}
          ,{field: 'img', title: '头像', width: 150}
          ,{field: 'introduce', title: '简介', width: 260}
          ,{field: 'address', title: '地址', width: 80}
          ,{field: 'phone', title: 'QQ', width: 150}
          ,{field: 'email', title: '邮箱', width: 180}
          ,{field: 'gitee', title: '码云', width: 250,sort:true}
          ,{field: 'operation', title: '操作', width: 200}
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
        var _this = $(this)
        var token= "{{csrf_token()}}";
        $.ajax({
            type:"post",
            data:{
                '_token':token,
                'field':'del',
                'id':id
            },
            url:"{{url('admin/author/del')}}",
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