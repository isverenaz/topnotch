<div class="main-sidebar">
    <div class="main-menu">
        <ul class="sidebar-menu scrollable">

            <li class="sidebar-item">
                <a role="button" class="sidebar-link-group-title has-sub">@lang('admin.main_page')</a>
                <?php
                    $mainPageRoutes = [
                        'admin.sliders.index',
                        'admin.sliders.create',
                        'admin.useful-link.index',
                        'admin.useful-link.create',
                        'admin.commits.index',
                        'admin.commits.create',
                        'admin.faqs.index',
                        'admin.faqs.create'
                    ]
                ?>
                <ul class="sidebar-link-group" @if(in_array(Route::currentRouteName(),$mainPageRoutes)) style="display: block;!important;" @else style="display: none;!important;" @endif>
                    @can('sliders-view')
                        <li class="sidebar-dropdown-item">
                            <a href="{{ route('admin.sliders.index') }}" class="sidebar-link">
                            <span class="nav-icon">
                                <i class="fa-light fa-filter-list"></i>
                            </span>
                                <span class="sidebar-txt">@lang('admin.slider')</span>
                            </a>
                        </li>
                    @endcan
                    @can('useful-link-view')
                        <li class="sidebar-dropdown-item">
                            <a href="{{ route('admin.useful-link.index') }}" class="sidebar-link">
                            <span class="nav-icon">
                                <i class="fa-light fa-filter-list"></i>
                            </span>
                                <span class="sidebar-txt">@lang('admin.useful_links')</span>
                            </a>
                        </li>
                    @endcan
                    @can('commits-view')
                        <li class="sidebar-dropdown-item">
                            <a href="{{ route('admin.commits.index') }}" class="sidebar-link">
                            <span class="nav-icon">
                                <i class="fa-light fa-filter-list"></i>
                            </span>
                                <span class="sidebar-txt">@lang('admin.commits')</span>
                            </a>
                        </li>
                    @endcan
                    @can('faqs-view')
                        <li class="sidebar-dropdown-item">
                            <a href="{{ route('admin.faqs.index') }}" class="sidebar-link">
                            <span class="nav-icon">
                                <i class="fa-light fa-filter-list"></i>
                            </span>
                                <span class="sidebar-txt">@lang('admin.faqs')</span>
                            </a>
                        </li>
                    @endcan
                </ul>
            </li>

            @can('services-view')
                <li class="sidebar-item">
                    <a role="button" class="sidebar-link-group-title has-sub">@lang('admin.services')</a>
                    <ul class="sidebar-link-group" @if(in_array(Route::currentRouteName(),['admin.service.index','admin.trainings.index'])) style="display: block;!important;" @else style="display: none;!important;" @endif>
                        <li class="sidebar-dropdown-item">
                            <a href="{{ route('admin.service.index') }}" class="sidebar-link">
                                <span class="nav-icon">
                                    <i class="fa-light fa-filter-list"></i>
                                </span>
                                <span class="sidebar-txt">@lang('admin.services')</span>
                            </a>
                        </li>
                    </ul>
                </li>
            @endcan
                <li class="sidebar-item">
                    <a role="button" class="sidebar-link-group-title has-sub">@lang('admin.study_abroads')</a>
                    <?php
                        $studyAbroadsRoutes = [
                            'admin.educational-degrees.index',
                            'admin.educational-degrees.create',
                            'admin.countries.index',
                            'admin.countries.create',
                            'admin.universities.index',
                            'admin.universities.create',
                            'admin.study-abroads.index',
                            'admin.study-abroads.create'
                        ];
                    ?>
                    <ul class="sidebar-link-group" @if(in_array(Route::currentRouteName(),$studyAbroadsRoutes)) style="display: block;!important;" @else style="display: none;!important;" @endif>
                        @can('educational-degrees-view')
                        <li class="sidebar-dropdown-item">
                            <a href="{{ route('admin.educational-degrees.index') }}" class="sidebar-link">
                                <span class="nav-icon">
                                    <i class="fa-light fa-filter-list"></i>
                                </span>
                                <span class="sidebar-txt">@lang('admin.educationalDegrees')</span>
                            </a>
                        </li>
                        @endcan
                        @can('countries-view')
                        <li class="sidebar-dropdown-item">
                            <a href="{{ route('admin.countries.index') }}" class="sidebar-link">
                                <span class="nav-icon">
                                    <i class="fa-light fa-filter-list"></i>
                                </span>
                                <span class="sidebar-txt">@lang('admin.countries')</span>
                            </a>
                        </li>
                        @endcan
                        @can('universities-view')
                        <li class="sidebar-dropdown-item">
                            <a href="{{ route('admin.universities.index') }}" class="sidebar-link">
                                <span class="nav-icon">
                                    <i class="fa-light fa-filter-list"></i>
                                </span>
                                <span class="sidebar-txt">@lang('admin.universities')</span>
                            </a>
                        </li>
                        @endcan
                        @can('study-abroad-view')
                        <li class="sidebar-dropdown-item">
                            <a href="{{ route('admin.study-abroads.index') }}" class="sidebar-link">
                                <span class="nav-icon">
                                    <i class="fa-light fa-filter-list"></i>
                                </span>
                                <span class="sidebar-txt">@lang('admin.study_abroads')</span>
                            </a>
                        </li>
                        @endcan
                    </ul>
                </li>
                <li class="sidebar-item">
                    <a role="button" class="sidebar-link-group-title has-sub">@lang('admin.language_courses')</a>
                    <?php
                      $languageCoursesRoutes = [
                          'admin.positions.index',
                          'admin.positions.create',
                          'admin.teachers.index',
                          'admin.teachers.create',
                          'admin.languages.index',
                          'admin.languages.create',
                          'admin.language-courses.index',
                          'admin.language-courses.create'
                      ];
                    ?>
                    <ul class="sidebar-link-group" @if(in_array(Route::currentRouteName(), $languageCoursesRoutes)) style="display: block;!important;" @else style="display: none;!important;" @endif>
                        @can('positions-view')
                        <li class="sidebar-dropdown-item">
                            <a href="{{ route('admin.positions.index') }}" class="sidebar-link">
                                <span class="nav-icon">
                                    <i class="fa-light fa-filter-list"></i>
                                </span>
                                <span class="sidebar-txt">@lang('admin.positions')</span>
                            </a>
                        </li>
                        @endcan
                        @can('teachers-view')
                            <li class="sidebar-dropdown-item">
                                <a href="{{ route('admin.teachers.index') }}" class="sidebar-link">
                                <span class="nav-icon">
                                    <i class="fa-light fa-filter-list"></i>
                                </span>
                                    <span class="sidebar-txt">@lang('admin.teachers')</span>
                                </a>
                            </li>
                        @endcan
                        @can('languages-view')
                        <li class="sidebar-dropdown-item">
                            <a href="{{ route('admin.languages.index') }}" class="sidebar-link">
                                <span class="nav-icon">
                                    <i class="fa-light fa-filter-list"></i>
                                </span>
                                <span class="sidebar-txt">@lang('admin.languages')</span>
                            </a>
                        </li>
                        @endcan
                        @can('language-courses-view')
                        <li class="sidebar-dropdown-item">
                            <a href="{{ route('admin.language-courses.index') }}" class="sidebar-link">
                                <span class="nav-icon">
                                    <i class="fa-light fa-filter-list"></i>
                                </span>
                                <span class="sidebar-txt">@lang('admin.language_courses')</span>
                            </a>
                        </li>
                        @endcan
                    </ul>
                </li>
            <li class="sidebar-item">
                <a role="button" class="sidebar-link-group-title has-sub">@lang('admin.category_news')</a>
                <ul class="sidebar-link-group" @if(in_array(Route::currentRouteName(),['admin.category.index', 'admin.news.index'])) style="display: block;!important;" @else style="display: none;!important;" @endif>
                    @can('category-view')
                        <li class="sidebar-dropdown-item">
                            <a href="{{ route('admin.category.index') }}" class="sidebar-link">
                            <span class="nav-icon">
                                <i class="fa-light fa-filter-list"></i>
                            </span>
                                <span class="sidebar-txt">@lang('admin.categories')</span>
                            </a>
                        </li>
                    @endcan
                    @can('news-view')
                        <li class="sidebar-dropdown-item">
                            <a href="{{ route('admin.news.index') }}" class="sidebar-link">
                            <span class="nav-icon">
                                <i class="fa-light fa-filter-list"></i>
                            </span>
                                <span class="sidebar-txt">@lang('admin.news')</span>
                            </a>
                        </li>
                    @endcan
                </ul>
            </li>
            <li class="sidebar-item">
                <a role="button" class="sidebar-link-group-title has-sub">@lang('admin.word_translations')</a>
                <ul class="sidebar-link-group" @if(in_array(Route::currentRouteName(),['admin.translations.index', 'admin.site-words.index', 'admin.admin-words.index'])) style="display: block;!important;" @else style="display: none;!important;" @endif>
                    @can('translations-view')
                        <li class="sidebar-dropdown-item">
                            <a href="{{ route('admin.translations.index') }}" class="sidebar-link">
                                <span class="nav-icon">
                                    <i class="fa-light fa-filter-list"></i>
                                </span>
                                <span class="sidebar-txt">@lang('admin.translations')</span>
                            </a>
                        </li>
                    @endcan
                    @can('translations-view')
                        <li class="sidebar-dropdown-item">
                            <a href="{{ route('admin.site-words.index') }}" class="sidebar-link">
                                <span class="nav-icon">
                                    <i class="fa-light fa-filter-list"></i>
                                </span>
                                <span class="sidebar-txt">@lang('admin.site_words')</span>
                            </a>
                        </li>
                    @endcan
                    @can('translations-view')
                        <li class="sidebar-dropdown-item">
                            <a href="{{ route('admin.admin-words.index') }}" class="sidebar-link">
                                <span class="nav-icon">
                                    <i class="fa-light fa-filter-list"></i>
                                </span>
                                <span class="sidebar-txt">@lang('admin.admin_words')</span>
                            </a>
                        </li>
                    @endcan
                </ul>
            </li>
            <li class="sidebar-item">
                <a role="button" class="sidebar-link-group-title has-sub">@lang('admin.contact')</a>
                <ul class="sidebar-link-group" @if(in_array(Route::currentRouteName(),['admin.complaint.index','admin.settings.index'])) style="display: block;!important;" @else style="display: none;!important;" @endif>
                    @can('settings-view')
                        <li class="sidebar-dropdown-item">
                            <a href="{{ route('admin.settings.index') }}" class="sidebar-link  {{ Route::currentRouteName() === 'admin.settings.index' ? 'active' : '' }}">
                            <span class="nav-icon">
                                <i class="fa-light fa-filter-list"></i>
                            </span>
                                <span class="sidebar-txt">@lang('admin.settings')</span>
                            </a>
                        </li>
                    @endcan
                </ul>
            </li>
            <li class="sidebar-item">
                <a role="button" class="sidebar-link-group-title has-sub">@lang('admin.security')</a>
                <ul class="sidebar-link-group" @if(in_array(Route::currentRouteName(),['admin.cms-users.index', 'admin.cms-users.logs', 'admin.roles.index', 'admin.permissions.index', 'admin.settings.index'])) style="display: block;!important;" @else style="display: none;!important;" @endif>
                    @can('cms_users-view')
                    <li class="sidebar-dropdown-item">
                        <a href="{{ route('admin.cms-users.index') }}" class="sidebar-link">
                            <span class="nav-icon">
                                <i class="fa-light fa-filter-list"></i>
                            </span>
                            <span class="sidebar-txt">@lang('admin.cms_users')</span>
                        </a>
                    </li>
                    @endcan
                    @can('logs-view')
                    <li class="sidebar-dropdown-item">
                        <a href="{{ route('admin.cms-users.logs') }}" class="sidebar-link">
                            <span class="nav-icon">
                                <i class="fa-light fa-filter-list"></i>
                            </span>
                            <span class="sidebar-txt">@lang('admin.logs')</span>
                        </a>
                    </li>
                    @endcan
                    @can('roles-view')
                    <li class="sidebar-dropdown-item">
                        <a href="{{ route('admin.roles.index') }}" class="sidebar-link">
                            <span class="nav-icon">
                                <i class="fa-light fa-filter-list"></i>
                            </span>
                            <span class="sidebar-txt">@lang('admin.roles')</span>
                        </a>
                    </li>
                    @endcan
                    @can('permissions-view')
                    <li class="sidebar-dropdown-item">
                        <a href="{{ route('admin.permissions.index') }}" class="sidebar-link">
                            <span class="nav-icon">
                                <i class="fa-light fa-filter-list"></i>
                            </span>
                            <span class="sidebar-txt">@lang('admin.permissions')</span>
                        </a>
                    </li>
                    @endcan
                </ul>
            </li>
        </ul>
    </div>
</div>
