<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{route('index')}}" class="brand-link">
        <img src="{{asset('img/logo.png')}}" alt="NDKILogo" class="brand-image img-circle elevation-3"
             style="opacity: .8">
        <span class="brand-text font-weight-light">{{config('app.name')}}</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="info">
                <a href="#" class="d-block">{{auth()->user()->full_name}}</a>
            </div>
        </div>


        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
                     with font-awesome or any other icon font library -->
                <li class="nav-item {{is_route($pages['users_group'], 'group')}}">
                    <a href="#" class="nav-link  {{is_route($pages['users_group'], 'link')}}">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                            Фойдаланувчилар
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{route('users.index')}}" class="nav-link {{is_route($pages['users'], 'link')}}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Рўйҳат</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{route('users.create')}}"
                               class="nav-link {{is_route($pages['users_create'], 'link')}}">
                                <i class="fas fa-plus-circle nav-icon"></i>
                                <p>Янги</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item {{is_route($pages['phd_group'], 'group')}}">
                    <a href="#" class="nav-link  {{is_route($pages['phd_group'], 'link')}}">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                            Фан номзоди (PhD)
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{route('phd_doctors.index')}}"
                               class="nav-link {{is_route($pages['phd'], 'link')}}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Рўйҳат</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{route('phd_doctors.create')}}"
                               class="nav-link {{is_route($pages['phd_create'], 'link')}}">
                                <i class="fas fa-plus-circle nav-icon"></i>
                                <p>Янги</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item {{is_route($pages['dsc_group'], 'group')}}">
                    <a href="#" class="nav-link  {{is_route($pages['dsc_group'], 'link')}}">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                            Фан номзоди (DSc)
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{route('dsc_doctors.index')}}"
                               class="nav-link {{is_route($pages['dsc'], 'link')}}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Рўйҳат</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{route('dsc_doctors.create')}}"
                               class="nav-link {{is_route($pages['dsc_create'], 'link')}}">
                                <i class="fas fa-plus-circle nav-icon"></i>
                                <p>Янги</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item {{is_route($pages['article_citation_group'], 'group')}}">
                    <a href="#" class="nav-link  {{is_route($pages['article_citation_group'], 'link')}}">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                            Илмий мақолаларига иқтибослар
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{route('article_citation.index')}}"
                               class="nav-link {{is_route($pages['article_citation'], 'link')}}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Рўйҳат</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{route('article_citation.create')}}"
                               class="nav-link {{is_route($pages['article_citation_create'], 'link')}}">
                                <i class="fas fa-plus-circle nav-icon"></i>
                                <p>Янги</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item {{is_route($pages['article_group'], 'group')}}">
                    <a href="#" class="nav-link {{is_route($pages['article_group'], 'link')}}">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                            Илмий мақолалар
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{route('scientific_article.index')}}"
                               class="nav-link {{is_route($pages['article'], 'link')}}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Рўйҳат</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{route('scientific_article.create')}}"
                               class="nav-link {{is_route($pages['article_create'], 'link')}}">
                                <i class="fas fa-plus-circle nav-icon"></i>
                                <p>Янги</p>
                            </a>
                        </li>
                    </ul>
                </li>
                {{--                <li class="nav-item">--}}
                {{--                    <a href="pages/widgets.html" class="nav-link">--}}
                {{--                        <i class="nav-icon fas fa-th"></i>--}}
                {{--                        <p>--}}
                {{--                            Widgets--}}
                {{--                            <span class="right badge badge-danger">New</span>--}}
                {{--                        </p>--}}
                {{--                    </a>--}}
                {{--                </li>--}}
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
