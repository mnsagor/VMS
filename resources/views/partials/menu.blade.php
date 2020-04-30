<aside class="main-sidebar">
    <section class="sidebar" style="height: auto;">
        <ul class="sidebar-menu tree" data-widget="tree">
            <li>
                <a href="{{ route("admin.home") }}">
                    <i class="fas fa-fw fa-tachometer-alt">

                    </i>
                    {{ trans('global.dashboard') }}
                </a>
            </li>
            @can('user_management_access')
                <li class="treeview">
                    <a href="#">
                        <i class="fa-fw fas fa-users">

                        </i>
                        <span>{{ trans('cruds.userManagement.title') }}</span>
                        <span class="pull-right-container"><i class="fa fa-fw fa-angle-left pull-right"></i></span>
                    </a>
                    <ul class="treeview-menu">
                        @can('permission_access')
                            <li class="{{ request()->is('admin/permissions') || request()->is('admin/permissions/*') ? 'active' : '' }}">
                                <a href="{{ route("admin.permissions.index") }}">
                                    <i class="fa-fw fas fa-unlock-alt">

                                    </i>
                                    <span>{{ trans('cruds.permission.title') }}</span>
                                </a>
                            </li>
                        @endcan
                        @can('role_access')
                            <li class="{{ request()->is('admin/roles') || request()->is('admin/roles/*') ? 'active' : '' }}">
                                <a href="{{ route("admin.roles.index") }}">
                                    <i class="fa-fw fas fa-briefcase">

                                    </i>
                                    <span>{{ trans('cruds.role.title') }}</span>
                                </a>
                            </li>
                        @endcan
                        @can('user_access')
                            <li class="{{ request()->is('admin/users') || request()->is('admin/users/*') ? 'active' : '' }}">
                                <a href="{{ route("admin.users.index") }}">
                                    <i class="fa-fw fas fa-user">

                                    </i>
                                    <span>{{ trans('cruds.user.title') }}</span>
                                </a>
                            </li>
                        @endcan
                    </ul>
                </li>
            @endcan
            @can('vehicle_management_access')
                <li class="treeview">
                    <a href="#">
                        <i class="fa-fw fas fa-cogs">

                        </i>
                        <span>{{ trans('cruds.vehicleManagement.title') }}</span>
                        <span class="pull-right-container"><i class="fa fa-fw fa-angle-left pull-right"></i></span>
                    </a>
                    <ul class="treeview-menu">
                        @can('vehicle_type_access')
                            <li class="{{ request()->is('admin/vehicle-types') || request()->is('admin/vehicle-types/*') ? 'active' : '' }}">
                                <a href="{{ route("admin.vehicle-types.index") }}">
                                    <i class="fa-fw fas fa-cogs">

                                    </i>
                                    <span>{{ trans('cruds.vehicleType.title') }}</span>
                                </a>
                            </li>
                        @endcan
                        @can('vehicle_access')
                            <li class="{{ request()->is('admin/vehicles') || request()->is('admin/vehicles/*') ? 'active' : '' }}">
                                <a href="{{ route("admin.vehicles.index") }}">
                                    <i class="fa-fw fas fa-cogs">

                                    </i>
                                    <span>{{ trans('cruds.vehicle.title') }}</span>
                                </a>
                            </li>
                        @endcan
                        @can('vehicle_allocation_access')
                            <li class="{{ request()->is('admin/vehicle-allocations') || request()->is('admin/vehicle-allocations/*') ? 'active' : '' }}">
                                <a href="{{ route("admin.vehicle-allocations.index") }}">
                                    <i class="fa-fw fas fa-cogs">

                                    </i>
                                    <span>{{ trans('cruds.vehicleAllocation.title') }}</span>
                                </a>
                            </li>
                        @endcan
                        @can('driver_allocation_access')
                            <li class="{{ request()->is('admin/driver-allocations') || request()->is('admin/driver-allocations/*') ? 'active' : '' }}">
                                <a href="{{ route("admin.driver-allocations.index") }}">
                                    <i class="fa-fw fas fa-cogs">

                                    </i>
                                    <span>{{ trans('cruds.driverAllocation.title') }}</span>
                                </a>
                            </li>
                        @endcan
                        @can('expense_access')
                            <li class="{{ request()->is('admin/expenses') || request()->is('admin/expenses/*') ? 'active' : '' }}">
                                <a href="{{ route("admin.expenses.index") }}">
                                    <i class="fa-fw fas fa-arrow-circle-right">

                                    </i>
                                    <span>{{ trans('cruds.expense.title') }}</span>
                                </a>
                            </li>
                        @endcan
                    </ul>
                </li>
            @endcan
            @can('vehicle_maintenance_access')
                <li class="treeview">
                    <a href="#">
                        <i class="fa-fw fas fa-cogs">

                        </i>
                        <span>{{ trans('cruds.vehicleMaintenance.title') }}</span>
                        <span class="pull-right-container"><i class="fa fa-fw fa-angle-left pull-right"></i></span>
                    </a>
                    <ul class="treeview-menu">
                        @can('expense_type_access')
                            <li class="{{ request()->is('admin/expense-types') || request()->is('admin/expense-types/*') ? 'active' : '' }}">
                                <a href="{{ route("admin.expense-types.index") }}">
                                    <i class="fa-fw fas fa-cogs">

                                    </i>
                                    <span>{{ trans('cruds.expenseType.title') }}</span>
                                </a>
                            </li>
                        @endcan
                        @can('vehicle_part_access')
                            <li class="{{ request()->is('admin/vehicle-parts') || request()->is('admin/vehicle-parts/*') ? 'active' : '' }}">
                                <a href="{{ route("admin.vehicle-parts.index") }}">
                                    <i class="fa-fw fas fa-cogs">

                                    </i>
                                    <span>{{ trans('cruds.vehiclePart.title') }}</span>
                                </a>
                            </li>
                        @endcan
                        @can('fuel_access')
                            <li class="{{ request()->is('admin/fuels') || request()->is('admin/fuels/*') ? 'active' : '' }}">
                                <a href="{{ route("admin.fuels.index") }}">
                                    <i class="fa-fw fas fa-cogs">

                                    </i>
                                    <span>{{ trans('cruds.fuel.title') }}</span>
                                </a>
                            </li>
                        @endcan
                    </ul>
                </li>
            @endcan
            @can('vehicle_requisition_access')
                <li class="treeview">
                    <a href="#">
                        <i class="fa-fw fas fa-cogs">

                        </i>
                        <span>{{ trans('cruds.vehicleRequisition.title') }}</span>
                        <span class="pull-right-container"><i class="fa fa-fw fa-angle-left pull-right"></i></span>
                    </a>
                    <ul class="treeview-menu">
                        @can('requisition_request_access')
                            <li class="{{ request()->is('admin/requisition-requests') || request()->is('admin/requisition-requests/*') ? 'active' : '' }}">
                                <a href="{{ route("admin.requisition-requests.index") }}">
                                    <i class="fa-fw fas fa-cogs">

                                    </i>
                                    <span>{{ trans('cruds.requisitionRequest.title') }}</span>
                                </a>
                            </li>
                        @endcan
                    </ul>
                </li>
            @endcan
            @can('employee_management_access')
                <li class="treeview">
                    <a href="#">
                        <i class="fa-fw fas fa-cogs">

                        </i>
                        <span>{{ trans('cruds.employeeManagement.title') }}</span>
                        <span class="pull-right-container"><i class="fa fa-fw fa-angle-left pull-right"></i></span>
                    </a>
                    <ul class="treeview-menu">
                        @can('employee_access')
                            <li class="{{ request()->is('admin/employees') || request()->is('admin/employees/*') ? 'active' : '' }}">
                                <a href="{{ route("admin.employees.index") }}">
                                    <i class="fa-fw fas fa-cogs">

                                    </i>
                                    <span>{{ trans('cruds.employee.title') }}</span>
                                </a>
                            </li>
                        @endcan
                    </ul>
                </li>
            @endcan
            @can('driver_management_access')
                <li class="treeview">
                    <a href="#">
                        <i class="fa-fw fas fa-cogs">

                        </i>
                        <span>{{ trans('cruds.driverManagement.title') }}</span>
                        <span class="pull-right-container"><i class="fa fa-fw fa-angle-left pull-right"></i></span>
                    </a>
                    <ul class="treeview-menu">
                        @can('driver_access')
                            <li class="{{ request()->is('admin/drivers') || request()->is('admin/drivers/*') ? 'active' : '' }}">
                                <a href="{{ route("admin.drivers.index") }}">
                                    <i class="fa-fw fas fa-cogs">

                                    </i>
                                    <span>{{ trans('cruds.driver.title') }}</span>
                                </a>
                            </li>
                        @endcan
                    </ul>
                </li>
            @endcan
            @can('setting_access')
                <li class="treeview">
                    <a href="#">
                        <i class="fa-fw fas fa-cogs">

                        </i>
                        <span>{{ trans('cruds.setting.title') }}</span>
                        <span class="pull-right-container"><i class="fa fa-fw fa-angle-left pull-right"></i></span>
                    </a>
                    <ul class="treeview-menu">
                        @can('division_access')
                            <li class="{{ request()->is('admin/divisions') || request()->is('admin/divisions/*') ? 'active' : '' }}">
                                <a href="{{ route("admin.divisions.index") }}">
                                    <i class="fa-fw fas fa-cogs">

                                    </i>
                                    <span>{{ trans('cruds.division.title') }}</span>
                                </a>
                            </li>
                        @endcan
                        @can('organogram_access')
                            <li class="{{ request()->is('admin/organograms') || request()->is('admin/organograms/*') ? 'active' : '' }}">
                                <a href="{{ route("admin.organograms.index") }}">
                                    <i class="fa-fw fas fa-cogs">

                                    </i>
                                    <span>{{ trans('cruds.organogram.title') }}</span>
                                </a>
                            </li>
                        @endcan
                    </ul>
                </li>
            @endcan
            @can('report_access')
                <li class="treeview">
                    <a href="#">
                        <i class="fa-fw fas fa-cogs">

                        </i>
                        <span>{{ trans('cruds.report.title') }}</span>
                        <span class="pull-right-container"><i class="fa fa-fw fa-angle-left pull-right"></i></span>
                    </a>
                    <ul class="treeview-menu">
                        @can('expence_history_access')
                            <li class="{{ request()->is('admin/expence-histories') || request()->is('admin/expence-histories/*') ? 'active' : '' }}">
                                <a href="{{ route("admin.expence-histories.index") }}">
                                    <i class="fa-fw fas fa-cogs">

                                    </i>
                                    <span>{{ trans('cruds.expenceHistory.title') }}</span>
                                </a>
                            </li>
                        @endcan
                        @can('maintanence_history_access')
                            <li class="{{ request()->is('admin/maintanence-histories') || request()->is('admin/maintanence-histories/*') ? 'active' : '' }}">
                                <a href="{{ route("admin.maintanence-histories.index") }}">
                                    <i class="fa-fw fas fa-cogs">

                                    </i>
                                    <span>{{ trans('cruds.maintanenceHistory.title') }}</span>
                                </a>
                            </li>
                        @endcan
                    </ul>
                </li>
            @endcan
            @if(file_exists(app_path('Http/Controllers/Auth/ChangePasswordController.php')))
                @can('profile_password_edit')
                    <li class="{{ request()->is('profile/password') || request()->is('profile/password/*') ? 'active' : '' }}">
                        <a href="{{ route('profile.password.edit') }}">
                            <i class="fa-fw fas fa-key">
                            </i>
                            {{ trans('global.change_password') }}
                        </a>
                    </li>
                @endcan
            @endif
            <li>
                <a href="#" onclick="event.preventDefault(); document.getElementById('logoutform').submit();">
                    <i class="fas fa-fw fa-sign-out-alt">

                    </i>
                    {{ trans('global.logout') }}
                </a>
            </li>
        </ul>
    </section>
</aside>