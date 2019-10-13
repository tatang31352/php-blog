<!--导航-->
<div class="qf_blog_header">
    <div class="layui-container">
        <div class="layui-row">
            <div class="layui-col-md2 qf_blog_nav_logo">
                <a href="{{url('/')}}"><img style="width:120px;padding-top: 10px"  src="/static/blog/images/logo.png"></a>
            </div>
            <i class="layui-icon qf_blog_nav_more" style="display: none;">&#xe671;</i>
            <div class="layui-col-md7 qf_blog_nav">
                <ul class="layui-nav" >
                    <li class="layui-nav-item"><a style="padding:0px 16px" href="{{url('')}}">首页</a></li>

                    <?php if($category['programmer'] == 1){ ?> 
                      <li class="layui-nav-item">
                          <a href="javascript:;" style="padding:0px 16px">编程</a>
                          <dl class="layui-nav-child">
                              <?php foreach($category['noLife'] as $v){ ?> 
                                  <dd><a href="{{url('?typeid=').$v['category_id']}}" style="text-align: center;padding: 0px 16px">{{$v['category']}}</a></dd>
                              <?php } ?>
                          </dl>
                      </li>
                    <?php } ?>  

                    <li class="layui-nav-item">
                        <a href="javascript:;" style="padding:0px 16px">生活</a>
                        <dl class="layui-nav-child">
                            <?php foreach($category['life'] as $v){ ?> 
                                  <dd><a href="{{url('?typeid=').$v['category_id']}}" style="text-align: center;padding: 0px 16px">{{$v['category']}}</a></dd>
                              <?php } ?>
                        </dl>
                    </li>

                    <li class="layui-nav-item"><a style="padding:0px 16px" href="{{url('home/history')}}">古今</a></li>
                    <li class="layui-nav-item"><a style="padding:0px 16px" href="{{url('home/message')}}">留言</a></li>
                    <li class="layui-nav-item"><a  style="padding:0px 16px" href="/music" target="_blank">音乐</a></li>
                    <li class="layui-nav-item"><a style="padding:0px 16px" href="{{url('home/about')}}">关于</a></li>
                </ul>
            </div>
            <div class="layui-col-md2 qf_blog_nav_right">
                <?php if(empty($user)){ ?>
                <a onclick="layer.msg('正在登陆', {icon:16, shade: 0.1, time:0})"  href="{{url('home/login')}}"  class="login">登陆</a>
                <?php }else{ ?>
                <div class="user_id" style="display: none;">{{$user['id']}}</div>
              <img class=""  src="{{$user['headurl']}}">
              <!-- <a   href="javascript:void(0);" class="loginout">{$user['nickname']}</a> -->
                <ul class="layui-nav qf_blog_my_info" >
                <li class="layui-nav-item">
                    <a   href="javascript:void(0);" class="nickname" title="{{$user['nickname']}}" > {{$user['nickname']}}</a>
                    <dl class="layui-nav-child">
                       <!-- <dd><a href="javascript:void(0);" class="loginout" style="text-align: center;">主页</a></dd>-->
                        <dd><a href="javascript:void(0);" class="loginout" style="text-align: center;">退出登录</a></dd>
                    </dl>
                </li>
                </ul>
                <?php } ?>
            </div>
           <div class="layui-col-md1 qf_blog_nav_search">
                <!--搜索-->
            </div>
            <div class="qf_blog_nav_search_show layui-hide" >
                <form class="layui-form">
                  {{-- <!--   <input id="article_search" style="width: 240px; height: 36px;" type="text" name="search"  {{if condition="(!empty($article_search))"}}  value="{$article_search}" {{/if}}   placeholder="请输入关键字" class="layui-input"> --> --}}
                </form>
            </div>
        </div>
    </div>
</div>



  <div style="display: none;" id="bind_email_view">
          <div class="layui-field-box">
              <form method="post" class="layui-form" action="" >
                  <div class="layui-form-item">
                      <label style="width:40px; text-align: left;" class="layui-form-label">邮箱 *</label>
                      <div class="layui-input-block"  style="margin-left: 80px;" >
                          <input type="email" name="email" lay-verify="email"  autocomplete="off" placeholder="请输入绑定的邮箱" class="layui-input">
                      </div>
                  </div>
                  <div class="layui-form-item" style="">
                      <label style="width:40px;text-align: right;" class="layui-form-label">密码 *</label>
                      <div class="layui-input-block"  style="margin-left: 80px; ">
                          <input  type="password" name="bind_user_password" lay-verify="bind_user_password"   autocomplete="off" placeholder="用于登录的密码" class="layui-input">
                      </div>
                  </div>
                  <div class="layui-form-item" >
                      <div class="layui-input-block">
                          <button style=" margin-left: 20%; " class="layui-btn" lay-submit="" lay-filter="bind_email">提交</button>
                      </div>
                  </div>
              </form>
          </div>
  </div>