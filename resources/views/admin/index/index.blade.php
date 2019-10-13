<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <link rel="stylesheet" href="/admin/home/assets/css/layui.css">
    <link rel="stylesheet" href="/admin/home/assets/css/admin.css">
    <link rel="icon" href="/bitbug_favicon.ico">
    <title>管理后台</title>
</head>
<body class="layui-layout-body">
    <div class="layui-layout layui-layout-admin">
        <div class="layui-header custom-header">
            <ul class="layui-nav layui-layout-left">
                <li class="layui-nav-item slide-sidebar" lay-unselect>
                    <a href="javascript:;" class="icon-font"><i class="ai ai-menufold"></i></a>
                </li>
            </ul>
            <ul class="layui-nav layui-layout-right">
                <li class="layui-nav-item">
                    <a href="javascript:;">{{$admin['username']}}</a>
                    <dl class="layui-nav-child">
                        <dd><a target="_blank" href="/">前往博客</a></dd>
                        <dd><a href="{{url('/admin/loginOut')}}">退出登录</a></dd>
                    </dl>
                </li>
            </ul>
        </div>

        <div class="layui-side custom-admin">
            <div class="layui-side-scroll">

                <div class="custom-logo">
                    <img src="/static/blog/images/logo6.png" alt=""/>
                    <h1>{{$admin['username']}}</h1>
                </div>
                <ul id="Nav" class="layui-nav layui-nav-tree">
                    <li class="layui-nav-item">
                        <a href="javascript:;">
                            <i class="layui-icon">&#xe609;</i>
                            <em>主页</em>
                        </a>
                        <dl class="layui-nav-child">
                            <dd><a href="{{url('admin/index/main')}}">控制台</a></dd>
                        </dl>
                    </li>
                    <li class="layui-nav-item">
                        <a href="javascript:;">
                            <i class="layui-icon">&#xe612;</i>
                            <em>我的用户</em>
                        </a>
                        <dl class="layui-nav-child">
                            <dd><a href="{{url('admin/admin/list')}}">管理员</a></dd>
                            <dd><a href="{{url('admin/user/list')}}">普通用户</a></dd>
                        </dl>
                    </li>
                    <li class="layui-nav-item">
                        <a href="javascript:;">
                            <i class="layui-icon">&#xe857;</i>
                            <em>我的博客</em>
                        </a>
                        <dl class="layui-nav-child">
                            <dd><a href="{{url('admin/bloghome/list')}}">博客首页</a></dd>
                            <dd><a href="{{url('admin/blog/list')}}">关于博客</a></dd>
                            <dd><a href="{{url('admin/author/list')}}">关于作者</a></dd>
                        </dl>
                    </li>
                    <li class="layui-nav-item">
                        <a href="javascript:;">
                            <i class="layui-icon">&#xe857;</i>
                            <em>我的文章</em>
                        </a>
                        <dl class="layui-nav-child">
                            <dd><a href="{{url('admin/article/list')}}">文章列表</a></dd>
                            <dd><a href="{{url('admin/cat/list')}}">文章分类</a></dd>
                            <dd><a href="{{url('admin/label/list')}}">关于标签</a></dd>
                            <dd><a href="{{url('admin/comment/list')}}">关于评论</a></dd>
                        </dl>
                    </li>
                    <li class="layui-nav-item">
                        <a href="{{url('admin/history/list')}}">
                            <i class="layui-icon">&#xe857;</i>
                            <em>我的古今</em>
                        </a>
                    </li>
                    <li class="layui-nav-item">
                        <a href="{{url('admin/album/list')}}">
                            <i class="layui-icon">&#xe857;</i>
                            <em>我的留言</em>
                        </a>
                    </li>
                    <!-- <li class="layui-nav-item">
                        <a href="javascript:;">
                            <i class="layui-icon">&#xe857;</i>
                            <em>组件</em>
                        </a>
                        <dl class="layui-nav-child">
                            <dd><a href="{{url('admin/test/from')}}">表单</a></dd>
                            <dd>
                                <a href="javascript:;">页面</a>
                                <dl class="layui-nav-child">
                                    <dd>
                                        <a href="{{url('admin/test/login')}}">登录页</a>
                                    </dd>
                                </dl>
                            </dd>
                        </dl>
                    </li>
                    <li class="layui-nav-item">
                        <a href="javascript:;">
                            <i class="layui-icon">&#xe612;</i>
                            <em>用户</em>
                        </a>
                        <dl class="layui-nav-child">
                            <dd><a href="{{url('admin/test/users')}}">用户组</a></dd>
                            <dd><a href="{{url('admin/test/roles')}}">权限配置</a></dd>
                        </dl>
                    </li> -->
                </ul>

            </div>
        </div>

        <div class="layui-body">
             <div class="layui-tab app-container" lay-allowClose="true" lay-filter="tabs">
                <ul id="appTabs" class="layui-tab-title custom-tab"></ul>
                <div id="appTabPage" class="layui-tab-content"></div>
            </div>
        </div>

        <div class="layui-footer" style="width: 100%;height: 45px;display: block;line-height: 45px;text-align: center;" >
            <!-- <p>© 2018 更多模板：<a href="http://www.mycodes.net/" target="_blank">源码之家</a></p> -->
            <p>三更灯火五更鸡,正是男儿读书时黑发不知勤学早,白首方悔读书迟</p>
        </div>

        <div class="mobile-mask"></div>
    </div>
    <script src="/admin/home/assets/layui.js"></script>
    <script src="/admin/home/index.js" data-main="home"></script>
</body>
</html>