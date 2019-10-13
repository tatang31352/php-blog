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
                  <a href="">我的用户</a>
                  <a><cite>管理员</cite></a>
                </span>
                <h2 class="title">管理员列表</h2>
            </div>
        </div>
        <div class="layui-row">
            <div class="layui-card">
                <div class="layui-card-body">
                    <div class="form-box">
                        
                        <a class="layui-btn layui-btn-blue" href="{{url('admin/admin/add')}}">
                        <i class="layui-icon">&#xe654;</i>新增管理员
                        </a>
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
            {field: 'userid', title: 'ID', width: 120, sort: true}
            ,{field: 'username', title: '账户名称', width: 250}
            ,{field: 'programmer', title: '程序猿', width: 250}
            ,{field: 'open', title: '状态', width: 240}
            ,{field: 'sex', title: '性别', width: 250}
            ,{field: 'create_time', title: '创建时间', width: 240}
            ,{field: 'operation', title: '操作', width: 250, sort: true}
            ]]
            ,data: <?php echo $data ?>
            ,skin: 'line' //表格风格
            ,even: true
            ,page: true //是否显示分页
            ,limits: [5, 7, 10]
            ,limit: 5 //每页默认显示的数量
        });

        
       //程序猿,状态,性别
        $(".layui-form-switch").on('click',function(){
            var id= $(this).parents("tr").find("div").html()
            var field = $(this).prev().attr('field')
            var value = $(this).prev().val()
            var token= "{{csrf_token()}}"
            var _this = $(this)

            if(field == 'open'){

                  //不允许关闭
                if(value == 0)
                {
                    _this.addClass('layui-form-onswitch');
                    layer.alert('唯一账号不能关闭,请开启其他账号!',{
                                icon:3,
                                time:1000,
                                skin:'layer-ext-yourskin'
                    }); 
                    return;
                }
                $.ajax({
                    type: 'POST',
                    url:"{{url('admin/admin/open')}}",
                    data:{
                        '_token':token,
                        'field':field,
                        'value':value,
                        'id':id,
                    },
                    success:function(res){
                    res = JSON.parse(res)  
                      if(res.status == 200){
                        // console.log($('input[field="open"]').val())
                            $('input[field="open"]').next().removeClass('layui-form-onswitch');
                            _this.addClass('layui-form-onswitch');
                            $('input[field="open"]').val(1)
                            _this.prev().val(0)
                        }else{
                            _this.removeClass('layui-form-onswitch');
                            layer.alert(res.msg,{
                                icon:3,
                                time:1000,
                                skin:'layer-ext-yourskin'
                            }); 
                        }
                    }          
                });
            }else{
               $.ajax({
                    type:"post",
                    data:{
                        '_token':token,
                        'field':field,
                        'value':value,
                        'id':id
                    },
                    url:"{{url('admin/admin/del')}}",
                    dataType:'json',
                    success:function(data){
                        
                    }
                }) 
            }
        })

        //删除按钮
        $('.del').on('click',function() {
            var id= $(this).parents("tr").find("div").html();
            var token= "{{csrf_token()}}";
            var _this = $(this)
            layer.confirm('确定删除？', {
                    btn: ['确定','取消'] //按钮
                  }, function(){
                    $.ajax({
                       type:"post",
                        data:{
                            '_token':token,
                            'field':'del',
                            'value':1,
                            'id':id
                        },
                        url:"{{url('admin/admin/del')}}",
                        dataType:'json',
                        success:function(res)
                        {
                            _this.parent().parent().parent().remove();
                            layer.msg('删除成功', {icon: 1});
                        }
                    })
                  }, function(){
            });
        })


 

    </script>
</body>
</html>