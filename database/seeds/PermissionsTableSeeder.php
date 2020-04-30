<?php

use App\Permission;
use Illuminate\Database\Seeder;

class PermissionsTableSeeder extends Seeder
{
    public function run()
    {
        $permissions = [
            [
                'id'    => '1',
                'title' => 'user_management_access',
            ],
            [
                'id'    => '2',
                'title' => 'permission_create',
            ],
            [
                'id'    => '3',
                'title' => 'permission_edit',
            ],
            [
                'id'    => '4',
                'title' => 'permission_show',
            ],
            [
                'id'    => '5',
                'title' => 'permission_delete',
            ],
            [
                'id'    => '6',
                'title' => 'permission_access',
            ],
            [
                'id'    => '7',
                'title' => 'role_create',
            ],
            [
                'id'    => '8',
                'title' => 'role_edit',
            ],
            [
                'id'    => '9',
                'title' => 'role_show',
            ],
            [
                'id'    => '10',
                'title' => 'role_delete',
            ],
            [
                'id'    => '11',
                'title' => 'role_access',
            ],
            [
                'id'    => '12',
                'title' => 'user_create',
            ],
            [
                'id'    => '13',
                'title' => 'user_edit',
            ],
            [
                'id'    => '14',
                'title' => 'user_show',
            ],
            [
                'id'    => '15',
                'title' => 'user_delete',
            ],
            [
                'id'    => '16',
                'title' => 'user_access',
            ],
            [
                'id'    => '17',
                'title' => 'vehicle_management_access',
            ],
            [
                'id'    => '18',
                'title' => 'vehicle_requisition_access',
            ],
            [
                'id'    => '19',
                'title' => 'employee_management_access',
            ],
            [
                'id'    => '20',
                'title' => 'driver_management_access',
            ],
            [
                'id'    => '21',
                'title' => 'setting_access',
            ],
            [
                'id'    => '22',
                'title' => 'report_access',
            ],
            [
                'id'    => '23',
                'title' => 'expence_history_access',
            ],
            [
                'id'    => '24',
                'title' => 'maintanence_history_access',
            ],
            [
                'id'    => '25',
                'title' => 'driver_create',
            ],
            [
                'id'    => '26',
                'title' => 'driver_edit',
            ],
            [
                'id'    => '27',
                'title' => 'driver_show',
            ],
            [
                'id'    => '28',
                'title' => 'driver_delete',
            ],
            [
                'id'    => '29',
                'title' => 'driver_access',
            ],
            [
                'id'    => '30',
                'title' => 'vehicle_create',
            ],
            [
                'id'    => '31',
                'title' => 'vehicle_edit',
            ],
            [
                'id'    => '32',
                'title' => 'vehicle_show',
            ],
            [
                'id'    => '33',
                'title' => 'vehicle_delete',
            ],
            [
                'id'    => '34',
                'title' => 'vehicle_access',
            ],
            [
                'id'    => '35',
                'title' => 'vehicle_type_create',
            ],
            [
                'id'    => '36',
                'title' => 'vehicle_type_edit',
            ],
            [
                'id'    => '37',
                'title' => 'vehicle_type_show',
            ],
            [
                'id'    => '38',
                'title' => 'vehicle_type_delete',
            ],
            [
                'id'    => '39',
                'title' => 'vehicle_type_access',
            ],
            [
                'id'    => '40',
                'title' => 'requisition_request_create',
            ],
            [
                'id'    => '41',
                'title' => 'requisition_request_edit',
            ],
            [
                'id'    => '42',
                'title' => 'requisition_request_show',
            ],
            [
                'id'    => '43',
                'title' => 'requisition_request_delete',
            ],
            [
                'id'    => '44',
                'title' => 'requisition_request_access',
            ],
            [
                'id'    => '45',
                'title' => 'expense_create',
            ],
            [
                'id'    => '46',
                'title' => 'expense_edit',
            ],
            [
                'id'    => '47',
                'title' => 'expense_show',
            ],
            [
                'id'    => '48',
                'title' => 'expense_delete',
            ],
            [
                'id'    => '49',
                'title' => 'expense_access',
            ],
            [
                'id'    => '50',
                'title' => 'division_create',
            ],
            [
                'id'    => '51',
                'title' => 'division_edit',
            ],
            [
                'id'    => '52',
                'title' => 'division_show',
            ],
            [
                'id'    => '53',
                'title' => 'division_delete',
            ],
            [
                'id'    => '54',
                'title' => 'division_access',
            ],
            [
                'id'    => '55',
                'title' => 'organogram_create',
            ],
            [
                'id'    => '56',
                'title' => 'organogram_edit',
            ],
            [
                'id'    => '57',
                'title' => 'organogram_show',
            ],
            [
                'id'    => '58',
                'title' => 'organogram_delete',
            ],
            [
                'id'    => '59',
                'title' => 'organogram_access',
            ],
            [
                'id'    => '60',
                'title' => 'vehicle_maintenance_access',
            ],
            [
                'id'    => '61',
                'title' => 'driver_allocation_create',
            ],
            [
                'id'    => '62',
                'title' => 'driver_allocation_edit',
            ],
            [
                'id'    => '63',
                'title' => 'driver_allocation_show',
            ],
            [
                'id'    => '64',
                'title' => 'driver_allocation_delete',
            ],
            [
                'id'    => '65',
                'title' => 'driver_allocation_access',
            ],
            [
                'id'    => '66',
                'title' => 'fuel_management_access',
            ],
            [
                'id'    => '67',
                'title' => 'vehicle_part_create',
            ],
            [
                'id'    => '68',
                'title' => 'vehicle_part_edit',
            ],
            [
                'id'    => '69',
                'title' => 'vehicle_part_show',
            ],
            [
                'id'    => '70',
                'title' => 'vehicle_part_delete',
            ],
            [
                'id'    => '71',
                'title' => 'vehicle_part_access',
            ],
            [
                'id'    => '72',
                'title' => 'fuel_create',
            ],
            [
                'id'    => '73',
                'title' => 'fuel_edit',
            ],
            [
                'id'    => '74',
                'title' => 'fuel_show',
            ],
            [
                'id'    => '75',
                'title' => 'fuel_delete',
            ],
            [
                'id'    => '76',
                'title' => 'fuel_access',
            ],
            [
                'id'    => '77',
                'title' => 'employee_create',
            ],
            [
                'id'    => '78',
                'title' => 'employee_edit',
            ],
            [
                'id'    => '79',
                'title' => 'employee_show',
            ],
            [
                'id'    => '80',
                'title' => 'employee_delete',
            ],
            [
                'id'    => '81',
                'title' => 'employee_access',
            ],
            [
                'id'    => '82',
                'title' => 'vehicle_allocation_create',
            ],
            [
                'id'    => '83',
                'title' => 'vehicle_allocation_edit',
            ],
            [
                'id'    => '84',
                'title' => 'vehicle_allocation_show',
            ],
            [
                'id'    => '85',
                'title' => 'vehicle_allocation_delete',
            ],
            [
                'id'    => '86',
                'title' => 'vehicle_allocation_access',
            ],
            [
                'id'    => '87',
                'title' => 'expense_type_create',
            ],
            [
                'id'    => '88',
                'title' => 'expense_type_edit',
            ],
            [
                'id'    => '89',
                'title' => 'expense_type_show',
            ],
            [
                'id'    => '90',
                'title' => 'expense_type_delete',
            ],
            [
                'id'    => '91',
                'title' => 'expense_type_access',
            ],
            [
                'id'    => '92',
                'title' => 'profile_password_edit',
            ],
        ];

        Permission::insert($permissions);

    }
}
