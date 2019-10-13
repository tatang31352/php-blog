<div class="layui-col-md4 qf_blog_content_right">
        <div class="layui-col-md12 qf_blog_index_carousel_right_my">
            <h2>我的名片</h2>
            <ul>
                <li>网名 : {{$home['net']}}</li>
                <li>职业 : {{$home['occupation']}}</li>
                <li>邮箱 : {{$home['email']}}</li>
                <li>爱好 : {{$home['hobby']}}</li>
                <li>座右铭 : {{$home['motto']}}</li>
            </ul>
        </div>
    <div class="layui-col-md12 qf_blog_content_right_tag" >
        <h2>文章标签</h2>
       
        <?php foreach($article_tag_list as $v){ ?>
            <a href="{{url('?tag='.$v['label_id'])}}" ><span style="{{$v['color']}}" class="layui-badge">{{$v['label_name']}}</span></a>
        <?php } ?>
      
    </div>
    <div class="layui-col-md12 qf_blog_content_right_file" >
        <h2>文章归档</h2>
        <ol>
            <?php foreach($article_archiving as $v){ ?>
            <li><a href="{{url('?date='.$v['date'])}}" title="{{$v['date_show']}}">{{$v['date_show']}}</a></li>
            <?php } ?>
        </ol>
    </div>
    <div class="layui-col-md12 qf_blog_content_right_hot_article" >
        <h2>热门文章</h2>
        <ol>
            <?php foreach($recommon_article as $k=>$v){ ?>
                <li><a href="{{url('home/article?id=').$v['article_id']}}">{{$v['title']}}</a></li>
            <?php }?>
        </ol>
    </div>
    <div class="layui-col-md12 qf_blog_content_right_link" >
        <h2>友情链接</h2>
        <ol>
            <?php foreach($friendship_link as $k=>$v){ ?> 
                <li><a href="{{$link_address[$k]}}" target="_blank">{{$v}}</a></li>
            <?php } ?> 
        </ol>
    </div>
    <div class="layui-col-md12 qf_blog_content_right_count" >
        <h2>网站统计</h2>
        <ul>
            <li>建站日期 : <?php echo $web_count['create_date']; ?></li>
            <li>文章总数 : <?php echo $web_count['article_count']; ?></li>
            <li>运行天数 : <?php echo $web_count['diff_date']; ?> 天</li>
            <li>标签总数 : <?php echo $web_count['label_count']; ?>个</li>
            <li>最后更新 : <?php echo $web_count['last_update_time']; ?></li>
            <li></li>
        </ul>
    </div>

</div>