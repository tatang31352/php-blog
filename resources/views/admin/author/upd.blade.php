<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="stylesheet" href="/admin/home/assets/css/layui.css">
    <link rel="stylesheet" href="/admin/home/assets/css/view.css"/>
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
                <div class="layui-card-header">关于作者</div>
                <form class="layui-form layui-card-body" action="javascript:">
                  <input type="hidden" name="id"  value="<?php echo $data['id']; ?>">
                  <div class="layui-form-item">
                    <label class="layui-form-label">模板名称</label>
                    <div class="layui-input-block">
                      <input type="text" name="author_name"  value="<?php echo $data['author_name']; ?>" required  lay-verify="required" placeholder="请输入模板名称" autocomplete="off" class="layui-input">
                    </div>
                  </div>

                  <div class="layui-form-item">
                    <label class="layui-form-label">作者姓名</label>
                    <div class="layui-input-block">
                      <input type="text" name="name" value="<?php echo $data['name']; ?>" required  lay-verify="required" placeholder="请输入作者姓名" autocomplete="off" class="layui-input">
                    </div>
                  </div>
                    <!-- logo图回显 -->
                  <div class="layui-form-item">
                    <div class="layui-input-block" id='logn-img'>
                        <img  height="150" width="150" src="<?php echo $data['img']; ?>"> 
                    </div>
                  </div>
                  <div class="layui-form-item">
                    <div class="layui-input-block">
                        <button type="button" class="layui-btn" name='logo'  id="logo">
                        <i tyle='file' class="layui-icon">&#xe67c;</i>上传头像
                      </button>
                    </div>
                  </div>
               <!--    <div class="layui-form-item">
                    <label class="layui-form-label">头像地址</label>
                    <div class="layui-input-block">
                      <input type="text" name="img" required  lay-verify="required" placeholder="可以使用下方的富文本编辑器上传图片获取图片地址" autocomplete="off" class="layui-input">
                    </div>
                  </div> -->

                  <div class="layui-form-item">
                    <label class="layui-form-label">作者简介</label>
                    <div class="layui-input-block">
                      <input type="text" name="introduce"  value="<?php echo $data['introduce']; ?>" required  lay-verify="required" placeholder="请输入作者简介" autocomplete="off" class="layui-input">
                    </div>
                  </div>  

                  <div class="layui-form-item">
                    <label class="layui-form-label">QQ</label>
                    <div class="layui-input-block">
                      <input type="text" name="phone"  value="<?php echo $data['phone']; ?>" required  lay-verify="required" placeholder="请输入QQ" autocomplete="off" class="layui-input">
                    </div>
                  </div>  

                  <div class="layui-form-item">
                    <label class="layui-form-label">地址</label>
                    <div class="layui-input-block">
                      <input type="text" name="address"  value="<?php echo $data['address']; ?>" required  lay-verify="required" placeholder="请输入地址" autocomplete="off" class="layui-input">
                    </div>
                  </div>

                  <div class="layui-form-item">
                    <label class="layui-form-label">邮箱</label>
                    <div class="layui-input-block">
                      <input type="text" name="email"  value="<?php echo $data['email']; ?>" required  lay-verify="required" placeholder="请输入博客标题" autocomplete="off" class="layui-input">
                    </div>
                  </div>

                  <div class="layui-form-item">
                    <label class="layui-form-label">gitLab</label>
                    <div class="layui-input-block">
                      <input type="text" name="gitee"  value="<?php echo $data['gitee']; ?>" required  lay-verify="required" placeholder="gitLab地址" autocomplete="off" class="layui-input">
                    </div>
                  </div>

                    
                    <div class="layui-form-item">
                    <div class="layui-input-block">
                    <label >博客详介</label>
                   
                    <script id="editor" type="text/plain" name='content' style="width:1024px;height:500px;padding-left: 45px"></script>
                    <div id="btns">
                        <div style="padding-left: 45px;padding-top: 5px;">
                            <button onclick="getAllHtml()">获得整个html的内容</button>
                            <button onclick="getContent()">获得内容</button>
                            <!-- <button onclick="setContent()">写入内容</button> -->
                            <!-- <button onclick="setContent(true)">追加内容</button> -->
                            <button onclick="getContentTxt()">获得纯文本</button>
                        <!--     <button onclick="getPlainTxt()">获得带格式的纯文本</button>
                            <button onclick="hasContent()">判断是否有内容</button>
                            <button onclick="setFocus()">使编辑器获得焦点</button> -->
                         <!--    <button onmousedown="isFocus(event)">编辑器是否获得焦点</button>
                            <button onmousedown="setblur(event)" >编辑器失去焦点</button> -->
                      <!--   </div>
                        <div> -->
                            <!-- <button onclick="getText()">获得当前选中的文本</button> -->
                            <!-- <button onclick="insertHtml()">插入给定的内容</button> -->
                            <button id="enable" onclick="setEnabled()">可以编辑</button>
                            <button onclick="setDisabled()">不可编辑</button>
                            <button onclick=" UE.getEditor('editor').setHide()">隐藏编辑器</button>
                            <button onclick=" UE.getEditor('editor').setShow()">显示编辑器</button>
                            <button onclick=" UE.getEditor('editor').setHeight(300)">设置高度为300默认关闭了自动长高</button>
                        </div>
<!-- 
                    <div>
                        <button onclick="getLocalData()" >获取草稿箱内容</button>
                        <button onclick="clearLocalData()" >清空草稿箱</button>
                    </div> -->

                    </div>
                    </div>
                  </div>

                  <div class="layui-form-item">
                    <div class="layui-input-block">
                      <button class="layui-btn layui-btn-blue" id="btn" lay-submit lay-filter="formDemo">立即提交</button>
                      <a type="reset" href="{{url('admin/author/list')}}" class="layui-btn layui-btn-primary">返回</a>
                    </div>
                  </div>
                </form>  
                    
            </div>
        </div>
    </div>


    
   




<script src="/admin/home/assets/layui.all.js" charset="utf-8"></script>
<script>
  var form = layui.form
    ,layer = layui.layer;
</script>
<script type="text/javascript">

    //实例化编辑器
    //建议使用工厂方法getEditor创建和引用编辑器实例，如果在某个闭包下引用该编辑器，直接调用UE.getEditor('editor')就能拿到相关的实例
    var ue = UE.getEditor('editor');


    // function isFocus(e){
    //     alert(UE.getEditor('editor').isFocus());
    //     UE.dom.domUtils.preventDefault(e)
    // }
    // function setblur(e){
    //     UE.getEditor('editor').blur();
    //     UE.dom.domUtils.preventDefault(e)
    // }
    // function insertHtml() {
    //     var value = prompt('插入html代码', '');
    //     UE.getEditor('editor').execCommand('insertHtml', value)
    // }
    // function createEditor() {
    //     enableBtn();
    //     UE.getEditor('editor');
    // }
    function getAllHtml() {
        alert(UE.getEditor('editor').getAllHtml())
    }
    function getContent() {
        var arr = [];
        // arr.push("使用editor.getContent()方法可以获得编辑器的内容");
        // arr.push("内容为：");
        arr.push(UE.getEditor('editor').getContent());
        alert(arr.join("\n"));
    }
    // function getPlainTxt() {
    //     var arr = [];
    //     arr.push("使用editor.getPlainTxt()方法可以获得编辑器的带格式的纯文本内容");
    //     arr.push("内容为：");
    //     arr.push(UE.getEditor('editor').getPlainTxt());
    //     alert(arr.join('\n'))
    // }
    // function setContent(isAppendTo) {
    //     var arr = [];
    //     arr.push("使用editor.setContent('欢迎使用ueditor')方法可以设置编辑器的内容");
    //     UE.getEditor('editor').setContent('欢迎使用ueditor', isAppendTo);
    //     alert(arr.join("\n"));
    // }
    function setDisabled() {
        UE.getEditor('editor').setDisabled('fullscreen');
        disableBtn("enable");
    }

    function setEnabled() {
        UE.getEditor('editor').setEnabled();
        enableBtn();
    }

    // function getText() {
    //     //当你点击按钮时编辑区域已经失去了焦点，如果直接用getText将不会得到内容，所以要在选回来，然后取得内容
    //     var range = UE.getEditor('editor').selection.getRange();
    //     range.select();
    //     var txt = UE.getEditor('editor').selection.getText();
    //     alert(txt)
    // }

    function getContentTxt() {
        var arr = [];
        // arr.push("使用editor.getContentTxt()方法可以获得编辑器的纯文本内容");
        // arr.push("编辑器的纯文本内容为：");
        arr.push(UE.getEditor('editor').getContentTxt());
        alert(arr.join("\n"));
    }
    // function hasContent() {
    //     var arr = [];
    //     arr.push("使用editor.hasContents()方法判断编辑器里是否有内容");
    //     arr.push("判断结果为：");
    //     arr.push(UE.getEditor('editor').hasContents());
    //     alert(arr.join("\n"));
    // }
    // function setFocus() {
    //     UE.getEditor('editor').focus();
    // }
    // function deleteEditor() {
    //     disableBtn();
    //     UE.getEditor('editor').destroy();
    // }
    // function disableBtn(str) {
    //     var div = document.getElementById('btns');
    //     var btns = UE.dom.domUtils.getElementsByTagName(div, "button");
    //     for (var i = 0, btn; btn = btns[i++];) {
    //         if (btn.id == str) {
    //             UE.dom.domUtils.removeAttributes(btn, ["disabled"]);
    //         } else {
    //             btn.setAttribute("disabled", "true");
    //         }
    //     }
    // }
    // function enableBtn() {
    //     var div = document.getElementById('btns');
    //     var btns = UE.dom.domUtils.getElementsByTagName(div, "button");
    //     for (var i = 0, btn; btn = btns[i++];) {
    //         UE.dom.domUtils.removeAttributes(btn, ["disabled"]);
    //     }
    // }

/*    function getLocalData () {
        alert(UE.getEditor('editor').execCommand( "getlocaldata" ));
    }

    function clearLocalData () {
        UE.getEditor('editor').execCommand( "clearlocaldata" );
        alert("已清空草稿箱")
    }*/
</script>


<script type="text/javascript">
      // //富文本回显
      // window.onload=function (){
      //       var content = '<?php echo $data['content']; ?>';
      //       UE.getEditor('editor').setContent(content);
      // }
      ue.ready(function(){//监听编辑器实例化完成的事件
        var content = '<?php echo $data['content']; ?>';
        UE.getEditor('editor').setContent(content);
      })

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

    //点击提交按钮发送请求
    $('#btn').on('click',function(){
       var token = "{{csrf_token()}}";
       var name = $("[name='name']").val();
       var id = $("[name='id']").val();
       var img = $("[name='logo']").attr("src");
       var introduce = $("[name='introduce']").val();
       var address = $("[name='address']").val();
       var phone = $("[name='phone']").val();
       var email = $("[name='email']").val();
       var sina = $("[name='sina']").val();
       var gitee = $("[name='gitee']").val();
       var author_name = $("[name='author_name']").val();
       var content = UE.getEditor('editor').getContent();

       if(name == '' || img == '' || address == '' || phone == '' || email == '' || sina == '' || gitee == '' || author_name == '' || introduce == '' || content == ''){
            return;
       } 

       $.ajax({
           type:"post",
           url:"{{url('admin/author/upd')}}",
           data:{
                _token:token,
                id:id,
                name:name,
                img:img,
                introduce:introduce,
                address:address,
                phone:phone,
                email:email,
                sina:sina,
                gitee:gitee,
                author_name:author_name,
                content:content
            },    
           dataType:'json',
           success:function(data){
                 if(data.status == 200){
                    layer.alert(data.msg,{
                      icon:1,
                      skin:'layer-ext-yourskin'
                    })
                    location="{{url('admin/author/list')}}";
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