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
                <div class="layui-card-header">编辑古今</div>
                <form class="layui-form layui-card-body" action="javascript:">
                  <input type="hidden" name="historyid" value="<?php echo $data['historyid']; ?>">
                  <?php foreach($data['content'] as $k=>$v): ?>
                    <?php if($k==0): ?>
                    <div class="add">
                      <div class="layui-form-item"> <!-- 注意：这一层元素并不是必须的 -->
                        <label class="layui-form-label">古今时间</label>
                        <div class="layui-input-inline">
                          <input type="text" value="{{$v->time}}" name='time' lay-verify="required" placeholder="请输入时间" autocomplete="off" class="layui-input" id="<?php echo 'test'.++$k; ?>" >
                        </div>
                          <button class="layui-btn layui-btn-blue" id="zt" lay-submit lay-filter="formDemo">添加记录</button>
                      </div>

                      <div class="layui-form-item">
                        <label class="layui-form-label">古今内容</label>
                        <div class="layui-input-block">
                          <input type="text" value="{{$v->content}}" name="content" value="" required  lay-verify="required" placeholder="请输入古今内容" autocomplete="off" class="layui-input">
                        </div>
                      </div>
                    </div>
                  <?php else: ?>
                    <div class="add">
                      <div class="layui-form-item"> <!-- 注意：这一层元素并不是必须的 -->
                        <label class="layui-form-label">古今时间</label>
                        <div class="layui-input-inline">
                          <input type="text" value="{{$v->time}}" name='time' lay-verify="required" placeholder="请输入时间" autocomplete="off" class="layui-input" id = "<?php echo 'test'.++$k; ?>">
                        </div>
                          <button class="layui-btn layui-btn-blue" onclick="dd(this)" style="background:red" lay-submit lay-filter="formDemo">删除记录</button>
                      </div>

                      <div class="layui-form-item">
                        <label class="layui-form-label">古今内容</label>
                        <div class="layui-input-block">
                          <input type="text" value="{{$v->content}}" name="content" value="" required  lay-verify="required" placeholder="请输入古今内容" autocomplete="off" class="layui-input">
                        </div>
                      </div>
                    </div>
                  <?php endif; ?>  
                  <?php endforeach; ?>    

                 
                  <div class="layui-form-item">
                    <label class="layui-form-label">所属账户</label>
                    <div class="layui-input-block">
                      <select name="user" lay-verify="required">
                        <option value="0"></option>
                          <?php foreach($user as $v): ?>
                            <option <?php if($data['user_id'] == $v['userid']) echo 'selected = "selected"'; ?> value="{{$v['userid']}}">{{$v['username']}}</option>
                          <?php endforeach; ?>
                      </select>
                    </div>
                  </div>

              
                  <div class="layui-form-item">
                    <div class="layui-input-block">
                      <button class="layui-btn layui-btn-blue" id='tj' lay-submit lay-filter="formDemo">立即提交</button>
                      <a href="{{url('admin/history/list')}}" type="reset" class="layui-btn layui-btn-primary">返回</a>
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
      for (var i = 1; i <= <?php echo count($data['content']); ?>; i++) {
        
         layui.use('laydate', function(){
          var laydate = layui.laydate;
          //执行一个laydate实例
          laydate.render({
            elem: '#test'+i //指定元素
          });
        });
      }
        
      var num = <?php echo count($data['content']) ?>;  
     
    </script>
</body>
<script>
    //添加记录按钮
    $('#zt').bind('click',function(){
        num++;
        var html = '<div><div class="layui-form-item">';
            html += '<label class="layui-form-label"></label>';
            html += '<div class="layui-input-inline">';
            html += '<input type="text" lay-verify="required" name="time" placeholder="请输入时间" autocomplete="off" class="layui-input" id="test'+num+'">';
            html += '</div>';
            html += '<button class="layui-btn layui-btn-blue" onclick="dd(this)" style="background:red" lay-submit lay-filter="formDemo">删除记录</button>';
            html += '</div>';
            html += '<div class="layui-form-item">';
            html += '<label class="layui-form-label"></label>';
            html += '<div class="layui-input-block">';
            html += '<input type="text" name="content" required  lay-verify="required" placeholder="请输入古今内容" autocomplete="off" class="layui-input">';
            html += ' </div></div></div>';
            $("div[class=add]:last").append(html);

            layui.use('laydate', function(){
              var laydate = layui.laydate;
              //执行一个laydate实例
              laydate.render({
                elem: '#test'+num //指定元素
              });
            });
    })    

  //删除记录按钮
  function dd(a){
    var html = $(a).parent().parent()
    html.remove()
  }        



  $('#tj').on('click',function(){

    var token= "{{csrf_token()}}"
    var user = $("[name='user']").val(); 
    var historyid = $("[name='historyid']").val(); 
    var contentArr = new Array();
    var timeArr = new Array();
    $("[name='content']").each(function(){
        contentArr.push($(this).val())
     })
    $("[name='time']").each(function(){
        timeArr.push($(this).val())
     })

    var arr = [];
    for(var j = 0; j < contentArr.length;j++){
      var obj = {};
      obj.content =  contentArr[j];
      obj.time =  timeArr[j];
      arr.push(obj);
    }
    //账户为空,内容为空
    if(user == '' || arr == ''){
      return;
    } 

    $.ajax({
        type:"post",
        data:{
          '_token':token,
          'user':user,
          'content':arr,
          'historyid':historyid
        },
        url:"{{url('admin/history/upd')}}",
        dataType:'json',
        success:function(data){
          if(data.status == 200){
            layer.alert(data.msg,{
              icon:1,
              skin:'layer-ext-yourskin'
            })
            location="{{url('admin/history/list')}}";
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

