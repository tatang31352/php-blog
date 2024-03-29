<!DOCTYPE html>
<html lang="en">
<head>
    @include('home/public/header')
</head>

<body>
<!--引入nav文件-->
@include('home/public/nav')

<div class="layui-container qf_blog_said_content">
    <div class="layui-row">
        <div class="layui-col-md8 qf_blog_said_content_left">
            <blockquote class="layui-elem-quote" style="background-color: white">
            <span class="layui-breadcrumb">
            <a><cite>首页</cite></a>
          <a><cite>古今</cite></a>
           </span>
            </blockquote>
            <div class="said">
                <fieldset class="layui-elem-field layui-field-title" style="margin-top: 20px;">
                    <legend>我的一生</legend>
                </fieldset>
                <ul class="layui-timeline" id="said" style="height: auto">
                </ul>
            </div>
        </div>
        <!--引入右边公用文件-->
        @include('home/public/right')

    </div>
</div>
<div class="qf_blog_mask  layui-hide">
</div>

<!--引入底部文件-->
@include('home/public/footer')


<script>
    layui.use('flow', function () {
        var flow = layui.flow
            , $ = layui.jquery;
        flow.load({
            elem: '#said' //流加载容器
            , scrollElem: '#said' //滚动条所在元素，一般不用填，此处只是演示需要。
            , isAuto: false
            , isLazyimg: true
            , done: function (page, next) { //加载下一页
                var lis = [];
                $.post("{{url('home/history')}}", {'page': page}, function (res) {
                    res = JSON.parse(res);
                    var data = res.data;
                    for (var i = 0; i < data.length; i++) {
                        $html = '<li class="layui-timeline-item"> <i class="layui-icon layui-timeline-axis"></i> ' +
                            '<div class="layui-timeline-content layui-text">'+
                            ' <h3 class="layui-timeline-title qf_blog_said_index_h3_time">' + data[i].time + '</h3>' +
                            ' <!--<div class="qf_blog_said_index_zan"><i class="layui-icon">&#xe6c6;</i> <span> 100</span></div> -->' +
                            ' <p>' + data[i].content + '</p> </div></li>';
                        lis.push($html);
                    }
                    next(lis.join(''), page < res.pageCount); //假设总页数为 6
                });
            }
        });
    });
</script>


</body>
</html>