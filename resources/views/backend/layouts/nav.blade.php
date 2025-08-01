<ul class="sidebar-menu scrollable position-relative pt-3" style="background-color: #e9e9e9;">

    @can('dashboard-graph')
        <li class="nav-item dropdown ">
            <a class="nav-link wave-effect " href="{{route('admin-dashboard')}}" style="color: #000;">
              <span class="icon-holder">
                <i class="fas fa-home"></i>
              </span>
                <span class="title">
                   {{__('Configuration::message.DashboardMenuButton')}}
                </span>
            </a>
        </li>
    @endcan

{{--    @canany(['survey-list','survey-create','survey-edit','survey-delete'])--}}
        {{--<li class="nav-item dropdown">
            <a class="nav-link wave-effect" href="{{route('admin.swapno.total.index')}}" style="color: #000;">
          <span class="icon-holder">
              <i class="fas fa-sad-cry"></i>
          </span>
                <span class="title">Total Numbers</span>
            </a>
        </li>--}}
{{--    @endcan--}}

{{--        @canany(['survey-list','survey-create','survey-edit','survey-delete'])--}}

        <li class="nav-item dropdown">
            <a class="nav-link wave-effect" href="{{route('admin.category.index')}}" style="color: #000;">
              <span class="icon-holder">
                  <i class="fas fa-cat"></i>
              </span>
                <span class="title">Categories</span>
            </a>
        </li>

        <li class="nav-item dropdown">
            <a class="nav-link wave-effect" href="{{route('admin.particular.index')}}" style="color: #000;">
              <span class="icon-holder">
                  <i class="fas fa-money-bill"></i>
              </span>
                <span class="title">Particulars</span>
            </a>
        </li>

        <li class="nav-item dropdown">
{{--            <a class="nav-link wave-effect" href="{{route('admin.swapno.index')}}" style="color: #000;">--}}
            <a class="nav-link wave-effect" href="{{route('admin.kpi.index')}}" style="color: #000;">
          <span class="icon-holder">
              <i class="fas fa-paint-roller"></i>
          </span>
                <span class="title">Kpi</span>
            </a>
        </li>

        <li class="nav-item dropdown">
            <a class="nav-link wave-effect" href="{{route('admin.sales.index','all')}}" style="color: #000;">
              <span class="icon-holder">
                  <i class="fas fa-money-bill"></i>
              </span>
                <span class="title">Sales</span>
            </a>
        </li>

        <li class="nav-item dropdown">
            <a class="nav-link wave-effect" href="{{route('admin.gallery.index','all')}}" style="color: #000;">
              <span class="icon-holder">
                  <i class="fas fa-photo-video"></i>
              </span>
                <span class="title">Gallery & Resource</span>
            </a>
        </li>
{{--        @endcan--}}

    @canany(['result-list','result-create','result-edit','result-delete'])
        <li class="nav-item dropdown">
            <a class="nav-link wave-effect" href="{{route('admin.surveyresult.index')}}" style="color: #000;"><span class="icon-holder"><i class="fas fa-award"></i></span>
                <span class="title"> {{__('SurveyResult::message.SurveyResultMenuButton')}}</span>
            </a>
        </li>
    @endcan


    @can('dashboard-graph')
        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" style="color: #000;">
                        <span class="icon-holder">
                        <i class="fas fa-folder-plus"></i>
                        </span>
                <span class="title">Report</span>
                <span class="arrow">
                        <i class="fas fa-angle-right"></i>
                        </span>
            </a>
            <ul class="dropdown-menu">
                <li>
                    <a href="{{route('admin.valuewise.report')}}" style="color: #000;padding: 5px;">Survey Chart</a>
                    <a href="{{route('admin.compare.report')}}" style="color: #000;padding: 5px;">Survey Compare</a>
                    <a href="{{route('admin.surveyresult.index')}}" style="color: #000;padding: 5px;">{{__('SurveyResult::message.SurveyResultMenuButton')}}</a>
                    <a href="{{route('admin.canteen.report')}}" style="color: #000;padding: 5px;">Canteen Wise</a>
                </li>
            </ul>
        </li>
    @endcan

    @canany(['survey-list','survey-create','survey-edit','survey-delete'])
        <li class="nav-item dropdown">
            <a class="nav-link wave-effect" href="{{route('admin.survey.index')}}" style="color: #000;">
      <span class="icon-holder">
          <i class="fas fa-poll-h"></i>
      </span>
                <span class="title"> {{__('Survey::message.SurveyMenuButton')}}</span>
            </a>
        </li>
    @endcan



    @canany(['item-list','item-create','item-edit','item-delete'])
        <li class="nav-item dropdown">
            <a class="nav-link wave-effect" href="{{route('admin.surveyitem.index')}}" style="color: #000;">
      <span class="icon-holder">
          <i class="fas fa-bars"></i>
      </span>
                <span class="title"> {{__('SurveyItem::message.SurveyItemMenuButton')}}</span>
            </a>
        </li>
    @endcan
    @canany(['organization-list','organization-create','organization-edit','organization-delete'])
    <li class="nav-item dropdown">
        <a class="nav-link wave-effect" href="{{route('admin.organization.index')}}" style="color: #000;">
      <span class="icon-holder">
        <i class="fas fa-network-wired"></i>
      </span>
            <span class="title"> {{__('Organization::message.OrganizationMenuButton')}}</span>
        </a>
    </li>
        <li class="nav-item dropdown">
            <a class="nav-link wave-effect" href="{{route('admin.canteen.index')}}" style="color: #000;">
              <span class="icon-holder">
                <i class="fas fa-network-wired"></i>
              </span>
                <span class="title"> {{__('Organization::message.CanteenMenuButton')}}</span>
            </a>
        </li>
        <li class="nav-item dropdown">
            <a class="nav-link wave-effect" href="{{route('admin.device.index')}}" style="color: #000;">
                  <span class="icon-holder">
                    <i class="fas fa-network-wired"></i>
                  </span>
                <span class="title"> {{__('Organization::message.DeviceMenuButton')}}</span>
            </a>
        </li>
        @endcan

    @canany(['user-list','user-create','user-edit','user-delete'])
    <li class="nav-item dropdown">
        <a class="nav-link wave-effect" href="{{route('admin.user.index')}}" style="color: #000;">
      <span class="icon-holder">
        <i class="fas fa-user-tie"></i>
      </span>
            <span class="title">{{__('User::message.UserMenuButton')}}</span>
        </a>
    </li>
    @endcan

    @canany(['role-list','role-create','role-edit','role-delete'])
    <li class="nav-item dropdown">
        <a class="nav-link wave-effect" href="{{route('admin.role.index')}}" style="color: #000;">
      <span class="icon-holder">
        <i class="fas fa-skating"></i>
      </span>
            <span class="title">Role</span>
        </a>
    </li>
    @endcan

    @if(Auth::user()->hasRole('ADMINISTRATOR'))
            <li class="nav-item dropdown">
                <a class="nav-link wave-effect" href="{{route('database.backup')}}" style="color: #000;">
      <span class="icon-holder">
        <i class="fas fa-download"></i>
      </span>
                    <span class="title">DB Backup</span>
                </a>
            </li>
    @endif

    @can('configuration-edit')
    <li class="nav-item dropdown">
        <a class="nav-link wave-effect" href="{{route('admin.configuration.edit',1)}}" style="color: #000;">
      <span class="icon-holder">
        <i class="fas fa-cogs"></i>
      </span>
            <span class="title">{{__('Configuration::message.ConfigurationMenuButton')}}</span>
        </a>
    </li>
    @endcan
</ul>
