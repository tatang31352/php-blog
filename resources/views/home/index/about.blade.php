<!DOCTYPE html>
<html lang="en">
<head>
    @include('home/public/header')

    <link rel="stylesheet" href="/static/blog/css/about.css">
    <script src="/admin/home/jquery-1.10.2.js"></script>  
</head>
<body>

<!--引入nav文件-->
@include('home/public/nav')

<div class="layui-container qf_blog_about_content">
    <div class="layui-row">
            <!-- 这个一般才是真正的主体内容 -->
            <div class="blog-container">
                <blockquote class="layui-elem-quote" style="background-color: white">
            <span class="layui-breadcrumb">
            <a><cite>首页</cite></a>
          <a><cite>关于</cite></a>
           </span>
                </blockquote>
                <div class="blog-main">
                    <div class="layui-tab layui-tab-brief shadow" lay-filter="tabAbout">
                        <ul class="layui-tab-title">
                            <li lay-id="1" class="layui-this">关于博客</li>
                            <li lay-id="2">关于作者</li>
                        </ul>
                        <div class="layui-tab-content">
                            <div class="layui-tab-item layui-show">
                                <div class="aboutinfo">
                                    <div class="aboutinfo-figure">
                                        <img src="/static/blog/images/logo2.png" alt="zuoqy博客" width="150px" height="150px"/>
                                    </div>
                                    <p class="aboutinfo-introduce"><?php echo $blog['title'];?></p>
                                    <p class="aboutinfo-location"><i class="fa fa-link"></i>&nbsp;&nbsp;<a id='url' target="_blank" href="https://www.zqfirst.top"></a></p>
                                    <hr />
                                    <div class="aboutinfo-contact">
                                        <a title="网站首页" href="{{url('/')}}"><i class="fa fa-home fa-2x" style="font-size:2.5em;position:relative;top:3px"></i></a>
                                        <a title="留言" href="{{url('home/message')}}"><i class="fa fa-commenting fa-2x"></i></a>
                                        <a title="古今" href="{{url('home/history')}}"><i class="fa fa-hourglass-half fa-2x"></i></a>
                                        <!--<a title="点点滴滴" href="timeline.html"><i class="fa fa-hourglass-half fa-2x"></i></a>-->
                                    </div>

                                    <fieldset class="layui-elem-field layui-field-title">
                                        <legend>简介</legend>
                                        <div class="layui-field-box aboutinfo-abstract">
                                            <?php echo $blog['content'];?>
                                            <h1 style="text-align:center;">The End</h1>
                                        </div>
                                    </fieldset>
                                </div>
                            </div><!--关于网站End-->
                            <div class="layui-tab-item">
                                <div class="aboutinfo">
                                    <div class="aboutinfo-figure">
                                        <img src="{{$author['img']}}" alt="Absolutely" width="100px" height="100px"/>
                                    </div>
                                    <p class="aboutinfo-nickname"><?php echo $author['name']; ?></p>
                                    <p class="aboutinfo-introduce">{{$author['introduce']}}</p>
                                    <p class="aboutinfo-location"><i class="fa fa-location-arrow"></i>&nbsp;{{$author['address']}}</p>
                                    <hr />
                                    <div class="aboutinfo-contact">
                                        <a target="_blank" title="QQ交流" href="http://sighttp.qq.com/msgrd?v=1&uin={{$author['phone']}}"><i class="fa fa-qq fa-2x"></i></a>
                                        <a target="_blank" title="给我写信" href="http://mail.qq.com/cgi-bin/qm_share?t=qm_mailme&email={{$author['email']}}" ><i class="fa fa-envelope fa-2x"></i></a>
                                        <a target="_blank" title="gitLab" href="{{$author['gitee']}}"><i class="fa fa-soundcloud fa-2x"></i></a>
                                    </div>
                                    <fieldset class="layui-elem-field layui-field-title">
                                        <legend>简介</legend>
                                        <div class="layui-field-box aboutinfo-abstract abstract-bloger">
                                            <?php echo $author['content']; ?>
                                            <h1 style="text-align:center;">The End</h1>
                                        </div>
                                    </fieldset>
                                </div>
                            </div><!--关于作者End-->
                        </div>
                    </div>
                </div>
                <div class="clear"></div>
            </div>

    </div>
</div>
<!--引入底部文件-->
@include('home/public/footer')
<div class="qf_blog_mask  layui-hide">
</div>
<script>
    window.onload = function(){ 
       var http = window.location.protocol;
       var url = window.location.host;
       $('#url').attr('href',http+'//'+url);
       $('#url').text(url);
　　} 
</script>

</body>
</html>