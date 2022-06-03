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
                @canany($s_permissions['citations'])
                    <li class="nav-item {{is_route($pages['article_citation_group'], 'group')}}">
                        <a href="#" class="nav-link  {{is_route($pages['article_citation_group'], 'link')}}">
                            <i class="nav-icon fas fa-tachometer-alt"></i>
                            <p>
                                Илмий мақолаларига иқтибослар
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            @can($s_permissions['citations_list'])
                                <li class="nav-item">
                                    <a href="{{route('article_citation.index')}}"
                                       class="nav-link {{is_route($pages['article_citation'], 'link')}}">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Рўйҳат</p>
                                    </a>
                                </li>
                            @endif
                            @can($s_permissions['citations_create'])
                                <li class="nav-item">
                                    <a href="{{route('article_citation.create')}}"
                                       class="nav-link {{is_route($pages['article_citation_create'], 'link')}}">
                                        <i class="fas fa-plus-circle nav-icon"></i>
                                        <p>Янги</p>
                                    </a>
                                </li>
                            @endif
                        </ul>
                    </li>
                @endcanany
                @canany($s_permissions['articles'])
                    <li class="nav-item {{is_route($pages['article_group'], 'group')}}">
                        <a href="#" class="nav-link {{is_route($pages['article_group'], 'link')}}">
                            <i class="nav-icon fas fa-tachometer-alt"></i>
                            <p>
                                Илмий мақолалар
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            @can($s_permissions['articles_list'])
                                <li class="nav-item">
                                    <a href="{{route('scientific_article.index')}}"
                                       class="nav-link {{is_route($pages['article'], 'link')}}">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Рўйҳат</p>
                                    </a>
                                </li>
                            @endcan
                            @can($s_permissions['articles_create'])
                                <li class="nav-item">
                                    <a href="{{route('scientific_article.create')}}"
                                       class="nav-link {{is_route($pages['article_create'], 'link')}}">
                                        <i class="fas fa-plus-circle nav-icon"></i>
                                        <p>Янги</p>
                                    </a>
                                </li>
                            @endcan
                        </ul>
                    </li>
                @endcanany
                @canany($s_permissions['oak_articles'])
                    <li class="nav-item {{is_route($pages['oak_article_group'], 'group')}}">
                        <a href="#" class="nav-link {{is_route($pages['oak_article_group'], 'link')}}">
                            <i class="nav-icon fas fa-tachometer-alt"></i>
                            <p>
                                Илмий мақолалар (ОАК&nbsp;рўйхатидаги)
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            @can($s_permissions['oak_articles_list'])
                                <li class="nav-item">
                                    <a href="{{route('oak_scientific_article.index')}}"
                                       class="nav-link {{is_route($pages['oak_article'], 'link')}}">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Рўйҳат</p>
                                    </a>
                                </li>
                            @endcan
                            @can($s_permissions['oak_articles_create'])
                                <li class="nav-item">
                                    <a href="{{route('oak_scientific_article.create')}}"
                                       class="nav-link {{is_route($pages['oak_article_create'], 'link')}}">
                                        <i class="fas fa-plus-circle nav-icon"></i>
                                        <p>Янги</p>
                                    </a>
                                </li>
                            @endcan
                        </ul>
                    </li>
                @endcanany
                @canany($s_permissions['grant_fund_order'])
                    <li class="nav-item {{is_route($pages['grant_fund_order_group'], 'group')}}">
                        <a href="#" class="nav-link {{is_route($pages['grant_fund_order_group'], 'link')}}">
                            <i class="nav-icon fas fa-tachometer-alt"></i>
                            <p>
                                Грантлар ва илмий фондлар маблағлари
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            @can($s_permissions['grant_fund_order_list'])
                                <li class="nav-item">
                                    <a href="{{route('grant_fund_order.index')}}"
                                       class="nav-link {{is_route($pages['grant_fund_order'], 'link')}}">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Рўйҳат</p>
                                    </a>
                                </li>
                            @endcan
                            @can($s_permissions['grant_fund_order_create'])
                                <li class="nav-item">
                                    <a href="{{route('grant_fund_order.create')}}"
                                       class="nav-link {{is_route($pages['grant_fund_order_create'], 'link')}}">
                                        <i class="fas fa-plus-circle nav-icon"></i>
                                        <p>Янги</p>
                                    </a>
                                </li>
                            @endcan
                        </ul>
                    </li>
                @endcanany
                @canany($s_permissions['research_conduct'])
                    <li class="nav-item {{is_route($pages['scientific_research_conduct_group'], 'group')}}">
                        <a href="#" class="nav-link {{is_route($pages['scientific_research_conduct_group'], 'link')}}">
                            <i class="nav-icon fas fa-tachometer-alt"></i>
                            <p>
                                Илмий тадқиқотлар маблағлари
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            @can($s_permissions['research_conduct_list'])
                                <li class="nav-item">
                                    <a href="{{route('scientific_research_conduct.index')}}"
                                       class="nav-link {{is_route($pages['scientific_research_conduct'], 'link')}}">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Рўйҳат</p>
                                    </a>
                                </li>
                            @endcan
                            @can($s_permissions['research_conduct_create'])
                                <li class="nav-item">
                                    <a href="{{route('scientific_research_conduct.create')}}"
                                       class="nav-link {{is_route($pages['scientific_research_conduct_create'], 'link')}}">
                                        <i class="fas fa-plus-circle nav-icon"></i>
                                        <p>Янги</p>
                                    </a>
                                </li>
                            @endcan
                        </ul>
                    </li>
                @endcanany
                @canany($s_permissions['state_grant_fund'])
                    <li class="nav-item {{is_route($pages['state_grant_fund_group'], 'group')}}">
                        <a href="#" class="nav-link {{is_route($pages['state_grant_fund_group'], 'link')}}">
                            <i class="nav-icon fas fa-tachometer-alt"></i>
                            <p>
                                Давлат грантлари асосида ўтказилган тадқиқотлар маблағлар
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            @can($s_permissions['state_grant_fund_list'])
                                <li class="nav-item">
                                    <a href="{{route('state_grant_fund.index')}}"
                                       class="nav-link {{is_route($pages['state_grant_fund'], 'link')}}">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Рўйҳат</p>
                                    </a>
                                </li>
                            @endcan
                            @can($s_permissions['state_grant_fund_create'])
                                <li class="nav-item">
                                    <a href="{{route('state_grant_fund.create')}}"
                                       class="nav-link {{is_route($pages['state_grant_fund_create'], 'link')}}">
                                        <i class="fas fa-plus-circle nav-icon"></i>
                                        <p>Янги</p>
                                    </a>
                                </li>
                            @endcan
                        </ul>
                    </li>
                @endcanany
                @canany($s_permissions['research_effectiveness'])
                    <li class="nav-item {{is_route($pages['scientific_research_effectiveness_group'], 'group')}}">
                        <a href="#"
                           class="nav-link {{is_route($pages['scientific_research_effectiveness_group'], 'link')}}">
                            <i class="nav-icon fas fa-tachometer-alt"></i>
                            <p>
                                Илмий-тадқиқот ишларининг самарадорлиги
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            @can($s_permissions['research_effectiveness_list'])
                                <li class="nav-item">
                                    <a href="{{route('scientific_research_effectiveness.index')}}"
                                       class="nav-link {{is_route($pages['scientific_research_effectiveness'], 'link')}}">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Рўйҳат</p>
                                    </a>
                                </li>
                            @endcan
                            @can($s_permissions['research_effectiveness_create'])
                                <li class="nav-item">
                                    <a href="{{route('scientific_research_effectiveness.create')}}"
                                       class="nav-link {{is_route($pages['scientific_research_effectiveness_create'], 'link')}}">
                                        <i class="fas fa-plus-circle nav-icon"></i>
                                        <p>Янги</p>
                                    </a>
                                </li>
                            @endcan
                        </ul>
                    </li>
                @endcanany
                @canany($s_permissions['patent'])
                    <li class="nav-item {{is_route($pages['obtained_industrial_sample_patent_group'], 'group')}}">
                        <a href="#"
                           class="nav-link {{is_route($pages['obtained_industrial_sample_patent_group'], 'link')}}">
                            <i class="nav-icon fas fa-tachometer-alt"></i>
                            <p>
                                Профессор-ўқитувчилар томонидан ихтиролари учун олинган патентлар
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            @can($s_permissions['patent_list'])
                                <li class="nav-item">
                                    <a href="{{route('obtained_industrial_sample_patent.index')}}"
                                       class="nav-link {{is_route($pages['obtained_industrial_sample_patent'], 'link')}}">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Рўйҳат</p>
                                    </a>
                                </li>
                            @endcan
                            @can($s_permissions['patent_create'])
                                <li class="nav-item">
                                    <a href="{{route('obtained_industrial_sample_patent.create')}}"
                                       class="nav-link {{is_route($pages['obtained_industrial_sample_patent_create'], 'link')}}">
                                        <i class="fas fa-plus-circle nav-icon"></i>
                                        <p>Янги</p>
                                    </a>
                                </li>
                            @endcan
                        </ul>
                    </li>
                @endcanany
                @canany($s_permissions['copyright'])
                    <li class="nav-item {{is_route($pages['copyright_protected_various_material_information_group'], 'group')}}">
                        <a href="#"
                           class="nav-link {{is_route($pages['copyright_protected_various_material_information_group'], 'link')}}">
                            <i class="nav-icon fas fa-tachometer-alt"></i>
                            <p>
                                Гувоҳномалар, муаллифлик ҳуқуқи билан ҳимоя қилинадиган турли материаллар
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            @can($s_permissions['copyright_list'])
                                <li class="nav-item">
                                    <a href="{{route('copyright_protected_various_material_information.index')}}"
                                       class="nav-link {{is_route($pages['copyright_protected_various_material_information'], 'link')}}">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Рўйҳат</p>
                                    </a>
                                </li>
                            @endcan
                            @can($s_permissions['copyright_create'])
                                <li class="nav-item">
                                    <a href="{{route('copyright_protected_various_material_information.create')}}"
                                       class="nav-link {{is_route($pages['copyright_protected_various_material_information_create'], 'link')}}">
                                        <i class="fas fa-plus-circle nav-icon"></i>
                                        <p>Янги</p>
                                    </a>
                                </li>
                            @endcan
                        </ul>
                    </li>
                @endcanany
                @canany($s_permissions['phd'])
                    <li class="nav-item {{is_route($pages['phd_group'], 'group')}}">
                        <a href="#" class="nav-link  {{is_route($pages['phd_group'], 'link')}}">
                            <i class="nav-icon fas fa-tachometer-alt"></i>
                            <p>
                                Фан номзоди (PhD)
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            @can($s_permissions['phd_list'])
                                <li class="nav-item">
                                    <a href="{{route('phd_doctors.index')}}"
                                       class="nav-link {{is_route($pages['phd'], 'link')}}">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Рўйҳат</p>
                                    </a>
                                </li>
                            @endcan
                            @can($s_permissions['phd_create'])
                                <li class="nav-item">
                                    <a href="{{route('phd_doctors.create')}}"
                                       class="nav-link {{is_route($pages['phd_create'], 'link')}}">
                                        <i class="fas fa-plus-circle nav-icon"></i>
                                        <p>Янги</p>
                                    </a>
                                </li>
                            @endcan
                        </ul>
                    </li>
                @endcanany
                @canany($s_permissions['dsc'])
                    <li class="nav-item {{is_route($pages['dsc_group'], 'group')}}">
                        <a href="#" class="nav-link  {{is_route($pages['dsc_group'], 'link')}}">
                            <i class="nav-icon fas fa-tachometer-alt"></i>
                            <p>
                                Фан номзоди (DSc)
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            @can($s_permissions['dsc_list'])
                                <li class="nav-item">
                                    <a href="{{route('dsc_doctors.index')}}"
                                       class="nav-link {{is_route($pages['dsc'], 'link')}}">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Рўйҳат</p>
                                    </a>
                                </li>
                            @endcan
                            @can($s_permissions['dsc_create'])
                                <li class="nav-item">
                                    <a href="{{route('dsc_doctors.create')}}"
                                       class="nav-link {{is_route($pages['dsc_create'], 'link')}}">
                                        <i class="fas fa-plus-circle nav-icon"></i>
                                        <p>Янги</p>
                                    </a>
                                </li>
                            @endcan
                        </ul>
                    </li>
                @endcanany
                @canany($s_permissions['users'])
                    <li class="nav-item {{is_route($pages['users_group'], 'group')}}">
                        <a href="#" class="nav-link  {{is_route($pages['users_group'], 'link')}}">
                            <i class="nav-icon fas fa-tachometer-alt"></i>
                            <p>
                                Фойдаланувчилар
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            @can($s_permissions['users_list'])
                                <li class="nav-item">
                                    <a href="{{route('users.index')}}"
                                       class="nav-link {{is_route($pages['users'], 'link')}}">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Рўйҳат</p>
                                    </a>
                                </li>
                            @endcan
                            @can($s_permissions['users_create'])
                                <li class="nav-item">
                                    <a href="{{route('users.create')}}"
                                       class="nav-link {{is_route($pages['users_create'], 'link')}}">
                                        <i class="fas fa-plus-circle nav-icon"></i>
                                        <p>Янги</p>
                                    </a>
                                </li>
                            @endcan
                        </ul>
                    </li>
                @endcanany
                @canany($s_permissions['faculty'])
                    <li class="nav-item {{is_route($pages['faculty_group'], 'group')}}">
                        <a href="#" class="nav-link  {{is_route($pages['faculty_group'], 'link')}}">
                            <i class="nav-icon fas fa-tachometer-alt"></i>
                            <p>
                                Факультетлар
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            @can($s_permissions['faculty_list'])
                                <li class="nav-item">
                                    <a href="{{route('faculty.index')}}"
                                       class="nav-link {{is_route($pages['faculty'], 'link')}}">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Рўйҳат</p>
                                    </a>
                                </li>
                            @endcan
                            @can($s_permissions['faculty_create'])
                                <li class="nav-item">
                                    <a href="{{route('faculty.create')}}"
                                       class="nav-link {{is_route($pages['faculty_create'], 'link')}}">
                                        <i class="fas fa-plus-circle nav-icon"></i>
                                        <p>Янги</p>
                                    </a>
                                </li>
                            @endcan
                        </ul>
                    </li>
                @endcanany
                @canany($s_permissions['department'])
                    <li class="nav-item {{is_route($pages['department_group'], 'group')}}">
                        <a href="#" class="nav-link  {{is_route($pages['department_group'], 'link')}}">
                            <i class="nav-icon fas fa-tachometer-alt"></i>
                            <p>
                                Кафедралар
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            @can($s_permissions['department_list'])
                                <li class="nav-item">
                                    <a href="{{route('department.index')}}"
                                       class="nav-link {{is_route($pages['department'], 'link')}}">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Рўйҳат</p>
                                    </a>
                                </li>
                            @endcan
                            @can($s_permissions['department_create'])
                                <li class="nav-item">
                                    <a href="{{route('department.create')}}"
                                       class="nav-link {{is_route($pages['department_create'], 'link')}}">
                                        <i class="fas fa-plus-circle nav-icon"></i>
                                        <p>Янги</p>
                                    </a>
                                </li>
                            @endcan
                        </ul>
                    </li>
                @endcanany
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
