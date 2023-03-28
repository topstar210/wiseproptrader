
<!-- BEGIN SIDEBAR -->
<div class="page-sidebar-wrapper">
  <div class="page-sidebar navbar-collapse collapse">
      <ul class="page-sidebar-menu " data-keep-expanded="false" data-auto-scroll="true" data-slide-speed="200">
          <li class="sidebar-toggler-wrapper">
              <!-- BEGIN SIDEBAR TOGGLER BUTTON -->
              <div class="sidebar-toggler">
              </div>
              <!-- END SIDEBAR TOGGLER BUTTON -->
          </li>

          <li class="{{ in_array(\Request::path(), ['admin', 'admin/clients', 'admin/bank_trans', 'admin/payments', 'admin/identify', 'admin/withdraw', 'admin/traders']) ? 'active open' : '' }}" style="margin-top: 30px;">
              <a href="javascript:;">
                  <i class="icon-home"></i>
                  <span class="title">Manager</span>
                  <span class="arrow "></span>
              </a>
              <ul class="sub-menu">
                  <li class="{{ \Request::is('admin') ?: 'active' }}">
                      <a href="{{ url('/admin') }}">
                          Orders</a>
                  </li>
                  <li class="{{ \Request::is('admin/clients') ?: 'active' }}">
                      <a href="{{ url('/admin/clients') }}">
                          Clients</a>
                  </li>
                  <li class="{{ \Request::is('admin/bank_trans') ?: 'active' }}">
                      <a href="{{ url('/admin/bank_trans') }}">
                          Bank Transferts</a>
                  </li>
                  <li class="{{ \Request::is('admin/payments') ?: 'active' }}">
                      <a href="{{ url('/admin/payments') }}">
                          Payments</a>
                  </li>
                  <li class="{{ \Request::is('admin/identify') ?: 'active' }}">
                      <a href="{{ url('/admin/identify') }}">
                          Identify</a>
                  </li>
                  <li class="{{ \Request::is('admin/withdraw') ?: 'active' }}">
                      <a href="{{ url('/admin/withdraw') }}">
                          WithDraws</a>
                  </li>
                  {{-- <li class="{{ \Request::is('admin/traders') ?: 'active' }}">
                      <a href="{{ url('/admin/traders') }}">
                          Traders Approvals</a>
                  </li> --}}

              </ul>
          </li>

          @if(auth()->user()->role == 1)
            <li class="{{ in_array(\Request::path(), ['admin/bankSetting', 'admin/tradingSetting', 'admin/spread-settings', 'admin/emailSetting', 'admin/IDSetting', 'admin/LeverageSetting','admin/package']) ? 'active open' : '' }}">
                <a href="javascript:;">
                    <i class="icon-settings"></i>
                    <span class="title">Admin</span>
                    <span class="arrow "></span>
                </a>
                <ul class="sub-menu">
                    <li class="{{ \Request::is('admin/emailSetting') ?: 'active' }}">
                        <a href="{{ url('/admin/emailSetting') }}">
                            App Settings</a>
                    </li>
                    <li class="{{ \Request::is('admin/bankSetting') ?: 'active' }}">
                        <a href="{{ url('/admin/bankSetting') }}">
                            Payment Settings</a>
                    </li>
                    <li class="{{ \Request::is('admin/tradingSetting') ?: 'active' }}">
                        <a href="{{ url('/admin/tradingSetting') }}">
                            Trading Settings</a>
                    </li>
                    <li class="{{ \Request::is('admin/spread-settings') ?: 'active' }}">
                        <a href="{{ url('/admin/spread-settings') }}">
                            Spread Settings</a>
                    </li>
                    <li class="{{ \Request::is('admin/IDSetting') ?: 'active' }}">
                        <a href="{{ url('/admin/IDSetting') }}">
                            Identify Setting</a>
                    </li>
                    <li class="{{ \Request::is('admin/LeverageSetting') ?: 'active' }}">
                        <a href="{{ url('/admin/LeverageSetting') }}">
                            Leverage Setting</a>
                    </li>
                    <li class="{{ \Request::is('admin/package') ?: 'active' }}">
                        <a href="{{ url('/admin/package') }}">
                            Plan Setting</a>
                    </li>
                    

                </ul>
            </li>

            <li class="{{ in_array(\Request::path(), ['super_manager/showManagers', 'admin/showClients']) ? 'active open' : '' }}">
                <a href="javascript:;">
                    <i class="icon-user"></i>
                    <span class="title">Users</span>
                    <span class="arrow "></span>
                </a>
                <ul class="sub-menu">
                    <li class="{{ \Request::is('admin/showManagers') ?: 'active' }}">
                        <a href="{{ url('/super_manager/showManagers') }}">
                            Managers</a>
                    </li>
                    <li class="{{ \Request::is('admin/showClients') ?: 'active' }}">
                        <a href="{{ url('/admin/showClients') }}">
                            Clents</a>
                    </li>
                </ul>

            </li>
            <li class="{{ in_array(\Request::path(), ['admin/repports']) ? 'active open' : '' }}">
                <a href="javascript:;">
                    <i class="icon-bar-chart"></i>
                    <span class="title">Repports</span>
                    <span class="arrow "></span>
                </a>
                <ul class="sub-menu">
                <li><a href="{{ url('/admin/repports') }}">Withdraw/Deposit</a></li>
                </ul>
            </li>
            
          @endif
          {{-- <li>
              <a href="{{ url('/admin/mailBox') }}">
                  <i class="icon-envelope"></i>
                  <span class="title">Mail Box</span>
              </a>

          </li>

          <li>
              <a href="{{ url('/admin/notification') }}">
                  <i class="icon-bell"></i>
                  <span class="title">Notifications</span>
              </a>

          </li> --}}


      </ul>
  </div>
</div>
<!-- END SIDEBAR -->