<!DOCTYPE html>
<html lang="en">
<head>
    @include('home/public/header')
</head>

<style>
    /*辅助*/
    pre{padding: 5px 10px; margin:  5px 0; font-size: 12px; border-left: 3px solid #009688;
        background-color: #F8F8F8; font-family: Courier New; overflow: auto;}
    /* 简易编辑器 */
    .fly-edit{position:relative; display: block; top: 1px; left:0; padding:0 10px; border: 1px solid #e6e6e6;
        border-radius: 2px 2px 0 0; background-color: #FBFBFB;}
    .fly-edit span{cursor:pointer; padding:0 10px; line-height: 38px; color:#009E94;}
    .fly-edit span i{padding-right:6px; font-size: 18px;}
    .fly-edit span:hover{color:#5DB276;}
    body .layui-edit-face{ border:none; background:none;}
    body .layui-edit-face  .layui-layer-content{padding:0; background-color:#fff; color:#666; box-shadow:none}
    .layui-edit-face .layui-layer-TipsG{display:none;}
    .layui-edit-face ul{position:relative; width:372px; padding:10px; border:1px solid #D9D9D9; background-color:#fff; box-shadow: 0 0 20px rgba(0,0,0,.2);}
    .layui-edit-face ul li{cursor: pointer; float: left; border: 1px solid #e8e8e8; height: 22px; width: 26px; overflow: hidden; margin: -1px 0 0 -1px; padding: 4px 2px; text-align: center;}
    .layui-edit-face ul li:hover{position: relative; z-index: 2; border: 1px solid #eb7350; background: #fff9ec;}
</style>


<body>
<!--引入nav文件-->
@include('home/public/nav')

<div class="layui-container qf_blog_message_content">
    <div class="layui-row">
        <input type="hidden" name="csrf-token" value="{{ csrf_token() }}">
        <div class="layui-col-md8 qf_blog_message_content_left" >
            <blockquote class="layui-elem-quote">
            <span class="layui-breadcrumb">
            <a><cite>首页</cite></a>
          <a><cite>留言</cite></a>
           </span>
            </blockquote>
            <div class="message" >
                <textarea id="L_content" name="content"
                          class="layui-textarea  message_editor " style=" height: 150px; "></textarea>
                <button class="layui-btn message_submit">提交留言</button>
            </div>
            <div class="message_list">
                <h2 class="mess_new">凡心博客留言</h2>


                <div class="hidden_message_param" style="display: none"></div>
                <div class="hidden_message_text" style="display: none"></div>

                <div id="message_content">


                </div>


            </div>
        </div>

        <!--引入右边公用文件-->
        @include('home/public/right')

    </div>
</div>


<div class="qf_blog_mask  layui-hide"></div>

<!--引入底部文件-->
@include('home/public/footer')



<script>
    layui.use(['flow','code','form'], function () {
         var flow = layui.flow
            ,form = layui.form
            ,$ = layui.jquery;
             layui.code();

        //流加载数据
        flow.load({
            elem: '#message_content' //流加载容器
            , scrollElem: '#message_content' //滚动条所在元素，一般不用填，此处只是演示需要。
            , isAuto: false
            , isLazyimg: true
            , done: function (page, next) { //加载下一页
                var lis = [];
                $.post("{{url('home/message')}}", {'page': page,'_token':"{{csrf_token()}}"}, function (res) {
                    var res = JSON.parse(res)
                    var data = res.data 
                    for (var i = 0; i < data.length; i++) {
                        var   html = '';
                        var style ='';
                        if(data[i].children.length!=0){
                            var children = data[i].children;
                            style = 'border-bottom: 1px solid #1AA195;';
                            for (var p = 0; p < children.length; p++) {
                                html += '<div class="layui-row message_children"> ' +
                                    '<div class="layui-col-xs2 layui-col-md1 message_children_left"> ' +
                                    '<img  class="" src="'+children[p].headurl+'" /></div> ' +
                                    '<div class="layui-col-xs10 layui-col-md11 message_children_right"> ' +
                                    '<div class="top"><span class="name">'+children[p].nickname+'</span> ' +
                                    '回复 <span class="name">'+children[p].reply_nickname+'</span> ' +
                                    '<span class="time">'+children[p].create_time+'</span>' +
                                    '来自 <span data-id="'+data[i].id+'" class="os">'+children[p].os+'</span> 客户端</div> ' +
                                    '<div class="content">'+children[p].message+'</div> ' +
                                    '<div class="bottom"><span data-id="'+children[p].id+'" class="zan">赞  (<cite>'+children[p].zan+'</cite>)</span> ' +
                                    '<span data-user="'+children[p].id+'"   data-id="'+data[i].id+'"   class="replay">回复</span> <!--<span class="del">删除</span>--></div> </div> </div>';
                            }
                         }else{
                              html ='';
                            style='';
                         }

                        var innerHtml = '  <div class="messages" style="'+style+'">' +
                            '<div class="layui-row message_parent"> ' +
                            '<div class="layui-col-xs2 layui-col-md1 message_parent_left"> ' +
                            '<img  class="" src="'+data[i].headurl+'" /> </div> ' +
                            '<div class="layui-col-xs10 layui-col-md11 message_parent_right"> ' +
                            '<div class="top"><span class="name">'+data[i].nickname+' </span><span class="time">'+data[i].create_time+'</span>' +
                            '来自 <span data-id="'+data[i].id+'" class="os">'+data[i].os+'</span> 客户端</div> ' +
                            '<div class="content">'+data[i].message+'</div>' +
                            '<div class="bottom"><span data-id="'+data[i].id+'" class="zan">赞  (<cite>'+data[i].zan+'</cite>)</span>' +
                            '<span  data-user="'+data[i].id+'"  data-id="'+data[i].id+'" class="replay">回复</span> ' +
                            '<!--<span class="del">删除</span>--></div> </div> </div> '+html+' </div>';
                        lis.push(innerHtml);
                    }
                    next(lis.join(''), page < res.pageCount); //假设总页数为 6
                });
            } 
        });


        //留言点+赞
        $("body").on("click",".zan",function(){
            var _this = $(this);
            var message_id = _this.attr('data-id');
            var user_id =  $('.user_id').html();
            var token = $('[name=csrf-token]').val();
            if("undefined" === typeof(user_id) ){
                layer.msg('请先登录',{
                    icon:2,
                    time:2000
                });
                return false;
            }
             //点赞评论跟留言
            $.post("{{url('home/message/zan')}}",{message_id:message_id,_token:token},function (res) {
                res = JSON.parse(res)
                if(res.code==1){
                    layer.msg(res.msg,{
                        time:1000,
                        icon:1
                    },function () {
                        //处理业务
                        var  zan =   parseInt(_this.children('cite').text());
                        _this.children('cite').text(zan+1);
                    });
                }else {
                    layer.msg(res.msg,{
                        icon:2
                    });
                }

            });

          // layer.msg('该功能待开发');
        });


        //回复
        $("body").on("click",".replay",function(){
            var _this = $(this);
             var nickname =  $(this).parent('div.bottom').siblings().eq(0).children('span.name').eq(0).text();
              text = '@'+ nickname.replace(/\s/g, '')+' ';
            //@的人到输入框中
            $('.message_editor').val(text);
            $('.message_editor').focus();
            //输入框值改变
            $('.message_editor').change(function () {
                 if($(this).val().length==0){
                     $('.hidden_message_param').text('');
                     $('.hidden_message_text').text('');
                 }
            });
            //绑定需要的参数到隐藏div中
            var id =  _this.attr('data-id');
            var reply_id =  _this.attr('data-user');
            $('.hidden_message_param').text(id+','+ reply_id +','+ nickname);
            $('.hidden_message_text').text(text);
           //  $('html,body').animate({scrollTop:$('.message_editor').offset().top-240},100);
            // layer.msg('该功能待开发');
        });




    });
</script>
<script>
   
</script>

</body>
</html>