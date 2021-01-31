@php
    $user = Sentinel::getUser();
    $path = explode('/', ltrim(Request::path(), '/'));

    $menu = array('accounts', 'master', 'guides', 'coma-categories', 'advertisements',
                  'access-analysis', 'contents', 'grades', 'collections', 'card-appearance-rates', 'makers',
                  'users', 'notification_settings', 'user-histories', 'certificate_settings',
                  'announcements', 'terms_of_service' , 'xmls', 'import', 'export');
    $active = array();

    foreach ($menu as $item) {
        $active[$item] = ($path[0] == $item) ? 'active' : '';
    }

@endphp
<aside class="main-sidebar">
    <section class="sidebar">
        <ul class="sidebar-menu">
            <li class="header">メインナビゲーション</li>
            @if($user->hasAccess('account.admin'))
            <li class="treeview {{ $active['accounts'] }}">
                <a href="{{ route('accounts.index') }}">
                    <i class="fa fa-user"></i> <span>アカウント管理</span>
                </a>
            </li>
            @endif
            @if($user->hasAccess('master.admin'))
                <li class=" treeview menu-open {{ $active['master'] }} {{ $active['guides'] }}  {{ $active['coma-categories'] }} {{ $active['advertisements'] }} ">
                    <a href="{{route('master.index')}}">
                        <i class="fa fa-dashboard"></i> <span>マスター管理</span>
                        <span class="pull-right-container">
                    <i class="fa fa-angle-left pull-right"></i>
                    </span>
                    </a>
                    <ul class="treeview-menu">
                        <li><a href="{{route('master.index')}}"><i class="fa fa-circle-o"></i> マスター管理</a></li>
                        <li><a href="{{route('guides.index')}}"><i class="fa fa-circle-o"></i> AMEC の使い方</a></li>
                        <li><a href="{{route('coma-categories.index')}}"><i class="fa fa-circle-o"></i> コマカテゴリ管理</a></li>
                        <li><a href="{{route('advertisements.action')}}"><i class="fa fa-circle-o"></i> 広告管理</a></li>
                    </ul>
                </li>
            @endif
            @if($user->hasAccess('access_analysis.admin'))
                <li class=" treeview menu-open {{ $active['access-analysis'] }}">
                    <a href="#">
                        <i class="fa fa-files-o"></i> <span>アクセス解析</span>
                        <span class="pull-right-container">
                    <i class="fa fa-angle-left pull-right"></i>
                    </span>
                    </a>
                    <ul class="treeview-menu">
                        <li><a href="{{route('access-analysis.index')}}"><i class="fa fa-circle-o"></i> 受講者数</a></li>
                    </ul>
                </li>
            @endif
            @if($user->hasAccess('content.admin'))
                <li class=" treeview menu-open {{ $active['contents'] }} {{ $active['grades'] }}">
                    <a href="#">
                        <i class="fa fa-th"></i> <span>コンテンツ管理</span>
                        <span class="pull-right-container">
                    <i class="fa fa-angle-left pull-right"></i>
                    </span>
                    </a>
                    <ul class="treeview-menu">
                        <li><a href="{{route('contents.index')}}"><i class="fa fa-circle-o"></i> コンテンツ管理</a></li>
                    </ul>
                </li>
            @endif
            @if($user->hasAccess('collection.admin'))
                <li class=" treeview menu-open {{ $active['collections'] }} {{ $active['card-appearance-rates'] }}  {{ $active['makers'] }}">
                    <a href="#">
                        <i class="fa fa-laptop"></i> <span>コレクション管理</span>
                        <span class="pull-right-container">
                    <i class="fa fa-angle-left pull-right"></i>
                    </span>
                    </a>
                    <ul class="treeview-menu">
                        <li><a href="{{route('collections.index')}}"><i class="fa fa-circle-o"></i> コレクション管理</a></li>
                        <li><a href="{{route('makers.index')}}"><i class="fa fa-circle-o"></i> メーカー一覧</a></li>
                    </ul>
                </li>
            @endif
            @if($user->hasAccess('user.admin'))
                <li class=" treeview menu-open {{ $active['users'] }} {{ $active['notification_settings'] }} {{ $active['user-histories'] }} {{ $active['certificate_settings'] }}">
                    <a href="#">
                        <i class="fa fa-table"></i> <span>ユーザー管理</span>
                        <span class="pull-right-container">
                    <i class="fa fa-angle-left pull-right"></i>
                    </span>
                    </a>
                    <ul class="treeview-menu">
                        <li><a href="{{route('users.index')}}"><i class="fa fa-circle-o"></i> ユーザー管理</a></li>
                        <li><a href="{{route('notification_settings.index')}}"><i class="fa fa-circle-o"></i> 通知設定</a></li>
                        <li><a href="{{route('certificate-settings.index')}}"><i class="fa fa-circle-o"></i> 認定証設定</a></li>
                    </ul>
                </li>
            @endif
            @if($user->hasAccess('collection.admin'))
                <li class=" treeview menu-open  {{ $active['announcements'] }}">
                    <a href="{{route('announcements.index')}}">
                        <i class="fa fa-folder"></i> <span>おしらせ</span>
                    </a>
                </li>
            @endif
            @if($user->hasAccess('terms_of_service.admin'))
                <li class="treeview {{ $active['terms_of_service'] }}">
                    <a href="{{ route('terms_of_service.index') }}">
                        <i class="fa fa-book"></i> <span>利用規約</span>
                    </a>
                </li>
            @endif
            @if($user->hasAccess('collection.admin'))
                <li class=" treeview menu-open {{ $active['xmls'] }} {{ $active['import'] }}  {{ $active['export'] }}">
                    <a href="#">
                        <i class="fa fa-database"></i> <span>データ管理</span>
                        <span class="pull-right-container">
                    <i class="fa fa-angle-left pull-right"></i>
                    </span>
                    </a>
                    <ul class="treeview-menu">
                        <li>
                            <a href="{{route('xmls.input')}}">
                                <i class="fa fa-circle-o"></i>インポート管理
                            </a>
                        </li>
                        <li>
                            <a href="{{route('xmls.export')}}">
                                <i class="fa fa-circle-o"></i>エクスポート管理
                            </a>
                        </li>
                    </ul>
                </li>
            @endif

            <li class="treeview">
                <a href="{{ route('logout') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                    <i class="fa fa-circle-o"></i> <span>Logout</span>
                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    {{ csrf_field() }}
                </form>
            </li>
        </ul>
    </section>
</aside>