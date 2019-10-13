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
                  <a href="">我的用户</a>
                  <a><cite>普通用户</cite></a>
                </span>
                <h2 class="title">用户列表</h2>
            </div>
        </div>
        <div class="layui-row">
            <div class="layui-card">
                <div class="layui-card-body">
                    <div class="form-box">
                        <a href="{{url('admin/user/add')}}" class="layui-btn layui-btn-blue"><i class="layui-icon">&#xe654;</i>新增</a>
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
      ,{field: 'username', title: '账号', width: 180}
      ,{field: 'nickname', title: '昵称', width: 180}
      ,{field: 'headurl', title: '头像', width: 180}
      ,{field: 'status', title: '开启/冻结', width: 150}
      ,{field: 'is_qq', title: '账号类型', width: 150}
      ,{field: 'create_time', title: '注册时间', width: 160,sort: true}
      ,{field: 'endtime', title: '最后登录时间', width: 180,sort: true}
      ,{field: 'ip', title: 'ip地址', width: 120}
      ,{field: 'operation',align: 'center', title: '操作', width: 220}
    ]]
    ,data: <?php echo $data; ?>
    ,skin: 'line' //表格风格
    ,even: true
    ,page: true //是否显示分页
    ,limits: [5, 7, 10]
    ,limit: 10 //每页默认显示的数量
  });


  //关闭,开启
  $(".layui-form-switch").on('click',function(){
      var id= $(this).parents("tr").find("div").html()
      var value = $(this).prev().val()
      var token= "{{csrf_token()}}"
      var _this = $(this);
      if(value == 1)
      {
        var bal = 0;
      }else if(value == 0){
        var bal = 1;
      }

      $.ajax({
          type:"post",
          data:{
            'id':id,
            'value':value,
            '_token':token
          },
          url:"{{url('admin/user/list')}}",
          dataType:'json',
          success:function(res){
            _this.prev().val(bal)
          }
      });
  })

  //删除按钮
  $('.del').on('click',function() {
    var id= $(this).parents("tr").find("div").html();
    var token= "{{csrf_token()}}";
    var _this=$(this);
    layer.confirm('确定删除？', {
        btn: ['确定','取消'] //按钮
      }, function(){
         layer.msg('删除成功', {icon: 1});
        _this.parent().parent().parent().remove();
        $.ajax({
            type:"post",
            data:{
                '_token':token,
                'id':id
            },
            url:"{{url('admin/user/del')}}",
            dataType:'json',
            success:function(res)
            {
                layer.msg('删除成功', {icon: 1});
            }
        })
      }, function(){
      });

  })
    </script>
</body>
</html>