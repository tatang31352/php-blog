<!DOCTYPE html>
<html lang="en">
<head>
@include('home/public/header')
</head>
<body>
<!--引入nav文件-->
@include('home/public/nav')

<!--首页轮播-->
<div class="layui-container qf_blog_index_carousel">
    <div class="layui-row">
        <div class="layui-col-md8  qf_blog_index_carousel_left" >
           <div class="layui-carousel" id="qf_blog_index_carousel" lay-filter="qf_blog_index_carousel" >
                <div carousel-item="" style="border-radius:10px;margin-top: 10px;">
                    <?php foreach($banner as $k=>$v){?>
                    <div  class="carousel"><img src="<?php echo $v; ?>"></div>
                    <?php }?>
                </div>
            </div>
        </div>
    </div>
    <!-- 网站公告提示 -->
    <div class="home-tips shadow">
                <i style="float:left;line-height:17px;" class="fa fa-volume-up"></i>
                <div class="home-tips-container">
                    <?php foreach($notice as $v){?>
                        <span style="color: #009688">{{$v}}</span>
                    <?php }?>
                    <span style="color: red">如果你觉得网站做得还不错，为凡心加油吧！<!-- <a href="http://fly.layui.com/case/2018/" target="_blank" style="color:#01AAED">点我前往</a></span> -->
                </div>
    </div>
</div>
<div class="layui-container qf_blog_index_content">
    <div class="layui-row">
        <div class="layui-col-md8 qf_blog_index_content_left" >
            <blockquote class="layui-elem-quote" style="background-color: white">
              <span class="layui-breadcrumb">
              <a><cite>首页</cite></a>
              <a><cite>文章列表</cite></a>
                 <!--  {if condition ="(!empty($article_search))"}
                    <a><cite>输入搜索</cite></a>
                  {/if} -->
                    <?php if($tag !=0){ ?>
                        <a><cite>标签搜索</cite></a>
                    <?php } ?> 
                  
                    <?php if($type !=0){ ?>
                    <a><cite>类型搜索</cite></a>
                    <?php } ?>  

                    <?php if($date !=0){ ?>
                        <a><cite>归档搜索</cite></a>
                    <?php } ?>  
              </span>
            </blockquote>
            <!--内容-->

            <ul class="blog_list">
                <?php foreach($article_list as $v){ ?>
                <li class="blog_pic" style="border-radius:10px">
                    <button class="layui-btn layui-btn-mini layui-btn-warm reprint"><?php if($v['original'] == 0){echo '转载';}else{echo '原创';}  ?></button>
                    <h2 class="title">
                        <a href="{{url('home/article?id=').$v['article_id']}}">{{$v['title']}}</a>
                    </h2>
                    <div style="float: left"><img style="border-radius:15px;" src="{{$v['img']}}" width="120px" height="120px"/></div>

                    <div class="desc" style="height: auto;word-wrap: break-word;">
                       {{$v['content_title']}}......
                    </div>
                    <div class="data">
                        <span><i class="layui-icon">&#xe637;</i> {{date('Y-m-d H:i:s',$v['create_time'])}}</span>
                        <span><i class="layui-icon">&#xe612;</i> {{$v['author']}}</span>
                    </div>
                </li>
                <?php } ?>
            </ul>
            <!--分页-->
            <div class="qf_blog_index_page" id="qf_blog_index_page"></div>
        </div>

        <!--引入右边公用文件-->
        @include('home/public/right')

    </div>

</div>





<!--遮罩层-->
<div class="qf_blog_mask  layui-hide">
</div>

<!--引入底部文件-->
@include('home/public/footer')

<script>
    layui.use('laypage', function () {
        var laypage = layui.laypage
            , $ = layui.jquery;
        laypage.render({
            elem: 'qf_blog_index_page' //注意，这里的 test1 是 ID，不用加 # 号
             ,limit:{{$page['pageSize']}}
            ,count: {{$page['pageCount']}}    //数据总数，从服务端得到
            ,curr: {{$page['pageIndex']}}
            ,jump: function(obj, first){
            //首次不执行
            if(!first){
                var url = location.search;
                // var article_search = document.getElementById("article_search").value;
                if(url.indexOf("search")>-1){
                        window.location.href = "/search/"+article_search+"/page/"+obj.curr;
                }else if (url.indexOf("tag")>-1){
                    var position = url.indexOf("tag");//位置
                    var  str = url.substring(position+4,position+5);
                    window.location.href = "?tag="+str+"&page="+obj.curr;
                }else if (url.indexOf("typeid")>-1){
                    var position = url.indexOf("typeid");
                    var  str = url.substring(position+7,position+8);
                    window.location.href = "?typeid="+str+"&page="+obj.curr;
                }else if (url.indexOf("date")>-1){
                    var position = url.indexOf("date");
                    var  str = url.substring(position+5,position+12);
                    window.location.href = "?date="+str+"&page="+obj.curr;
                }else{
                    window.location.href = "?page="+obj.curr;
                }
            }
        }
        });
        
    });
</script>


</body>
</html>