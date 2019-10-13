<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="stylesheet" href="/admin/home/assets/css/layui.css">
    <link rel="stylesheet" href="/admin/home/assets/css/view.css"/>
    <title></title>
    <script src="/admin/home/jquery-1.10.2.js"></script>
    <script type="text/javascript" charset="utf-8" src="/extend/ueditor/ueditor.config.js"></script>
    <script type="text/javascript" charset="utf-8" src="/extend/ueditor/ueditor.all.min.js"> </script>
    <!--建议手动加在语言，避免在ie下有时因为加载语言失败导致编辑器加载失败-->
    <!--这里加载的语言文件会覆盖你在配置项目里添加的语言类型，比如你在配置项目里配置的是英文，这里加载的中文，那最后就是中文-->
    <script type="text/javascript" charset="utf-8" src="/extend/ueditor/lang/zh-cn/zh-cn.js"></script>  
</head>
<body class="layui-view-body">
    <div class="layui-content">
        <div class="layui-row">
            <div class="layui-card">
                <div class="layui-card-header">新增文章</div>
                <form class="layui-form layui-card-body" action="javascript:">
                  <div class="layui-form-item">
                    <label class="layui-form-label">文章标题</label>
                    <div class="layui-input-block">
                      <input type="text" name="title" required  lay-verify="required" placeholder="请输入文章标题" autocomplete="off" class="layui-input">
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
                        <i tyle='file' class="layui-icon">&#xe67c;</i>上传封面图
                      </button>
                    </div>
                  </div>

                  <div class="layui-form-item">
                    <label class="layui-form-label">是否原创</label>
                    <div class="layui-input-block">
                      <input type="radio" name="original" value="1" title="原创" checked>
                      <input type="radio" name="original" value="0" title="转载">
                    </div>
                  </div>

                  <div class="layui-form-item">
                    <label class="layui-form-label">热门文章</label>
                    <div class="layui-input-block">
                      <input type="radio" name="recommend" value="1" title="推荐" checked>
                      <input type="radio" name="recommend" value="0" title="不推荐">
                    </div>
                  </div>

               
                  <div class="layui-form-item">
                    <label class="layui-form-label">文章标签</label>
                    <div class="layui-input-block">
                      <select name="label_id" lay-verify="required">
                        <option value=""></option>
                        <?php foreach($label as $v): ?>
                          <option value="{{$v['label_id']}}">{{$v['label_name']}}</option>
                        <?php endforeach; ?>
                      </select>
                    </div>
                  </div>

                   <div class="layui-form-item">
                    <label class="layui-form-label">文章分类</label>
                    <div class="layui-input-block">
                      <select name="category_id" lay-verify="required">
                        <option value=""></option>
                        <?php foreach($category as $v): ?>
                          <option value="{{$v['category_id']}}">{{$v['category']}}</option>
                        <?php endforeach; ?>
                      </select>
                    </div>
                  </div>

                  <div class="layui-form-item">
                    <label class="layui-form-label">文章作者</label>
                    <div class="layui-input-block">
                      <select name="author" lay-verify="required">
                        <option value=""></option>
                        <?php foreach($author as $v): ?>
                          <option value="{{$v['name']}}">{{$v['name']}}</option>
                        <?php endforeach; ?>
                      </select>
                    </div>
                  </div>

                  <div class="layui-form-item">
                    <label class="layui-form-label">关联账户</label>
                    <div class="layui-input-block">
                      <select name="user_id" lay-verify="required">
                        <option value=""></option>
                        <?php foreach($user as $v): ?>
                          <option value="{{$v['userid']}}">{{$v['username']}}</option>
                        <?php endforeach; ?>
                      </select>
                    </div>
                  </div>
                 
                    <div class="layui-form-item">
                    <div class="layui-input-block">
                    <label >文章内容</label>
                    <script id="editor" type="text/plain" name='content' style="width:1024px;height:500px;padding-left: 45px"></script>
                    <div id="btns">
                        <div style="padding-left: 45px;padding-top: 5px;">
                            <button onclick="getAllHtml()">获得整个html的内容</button>
                            <button onclick="getContent()">获得内容</button>
                            <button onclick="getContentTxt()">获得纯文本</button>
                            <button id="enable" onclick="setEnabled()">可以编辑</button>
                            <button onclick="setDisabled()">不可编辑</button>
                            <button onclick=" UE.getEditor('editor').setHide()">隐藏编辑器</button>
                            <button onclick=" UE.getEditor('editor').setShow()">显示编辑器</button>
                            <button onclick=" UE.getEditor('editor').setHeight(300)">设置高度为300默认关闭了自动长高</button>
                        </div>
                    </div>
                    </div>
                  </div>


                  <div class="layui-form-item">
                    <div class="layui-input-block">
                      <button class="layui-btn layui-btn-blue" id='tj' lay-submit lay-filter="formDemo">立即提交</button>
                      <a href="{{url('admin/article/list')}}" type="reset" class="layui-btn layui-btn-primary">返回</a>
                    </div>
                  </div>
                </form>  
            </div>
        </div>
    </div>
    <script type="text/javascript">

    //实例化编辑器
    //建议使用工厂方法getEditor创建和引用编辑器实例，如果在某个闭包下引用该编辑器，直接调用UE.getEditor('editor')就能拿到相关的实例
    var ue = UE.getEditor('editor');

    function getAllHtml() {
        alert(UE.getEditor('editor').getAllHtml())
    }
    function getContent() {
        var arr = [];
        arr.push(UE.getEditor('editor').getContent());
        alert(arr.join("\n"));
    }
    function setDisabled() {
        UE.getEditor('editor').setDisabled('fullscreen');
        disableBtn("enable");
    }

    function setEnabled() {
        UE.getEditor('editor').setEnabled();
        enableBtn();
    }


    function getContentTxt() {
        var arr = [];
        arr.push(UE.getEditor('editor').getContentTxt());
        alert(arr.join("\n"));
    }
    </script>
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
    </script>
 
</body>

<script>
  $('#tj').on('click',function(){

    var token = "{{csrf_token()}}";
    var title = $("[name='title']").val(); 
    var img = $("[name='logo']").attr("src");
    var original = $("[name='original']:checked").val();
    var recommend = $("[name='recommend']:checked").val();
    var label_id = $("[name='label_id']").val(); 
    var category_id = $("[name='category_id']").val(); 
    var author = $("[name='author']").val(); 
    var user_id = $("[name='user_id']").val(); 
    var content = UE.getEditor('editor').getContent();
    var content_title = UE.getEditor('editor').getContentTxt();
    //昵称为空 || 密码为空 || 博客为空 || 首页为空 || 作者为空
    if(title == '' || img == '' || original == '' || recommend == '' || label_id == '' || category_id == '' || author == '' || user_id == '' || content == '' || content_title == ''){
      return;
    } 

    $.ajax({
        type:"post",
        data:{
          '_token':token,
          'title':title,
          'img':img,
          'original':original,
          'recommend':recommend,
          'label_id':label_id,
          'category_id':category_id,
          'author':author,
          'user_id':user_id,
          'content':content,
          'content_title':content_title,
        },
        url:"{{url('admin/article/add')}}",
        dataType:'json',
        success:function(data){
          if(data.status == 200){
            layer.alert(data.msg,{
              icon:1,
              skin:'layer-ext-yourskin'
            })
            location="{{url('admin/article/list')}}";
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