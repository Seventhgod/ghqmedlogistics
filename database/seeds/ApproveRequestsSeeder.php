<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Permission;
class ApproveRequestsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //module
        $moduleId = DB::table('modules')->insertGetId([
            'name' => 'requests',
            'display_name' => 'Requests',
            'icon' => 'icon-people'
        ]);

        // Permissions
        DB::table('permissions')->insert([
            [
                'name' => 'read-request-approval',
                'display_name' => 'Read Request Approvals',
                'guard_name' => 'web',
                'module_id' => $moduleId
            ],
            [
                'name' => 'create-request-approval',
                'display_name' => 'Approve Request',
                'guard_name' => 'web',
                'module_id' => $moduleId
            ],
            [
                'name' => 'update-request-approval',
                'display_name' => 'Update Request Status',
                'guard_name' => 'web',
                'module_id' => $moduleId
            ],
            [
                'name' => 'delete-request',
                'display_name' => 'Delete Approved Request',
                'guard_name' => 'web',
                'module_id' => $moduleId
            ]
        ]);
        $admin = Role::findByName('admin');
        $admin->givePermissionTo(Permission::all());
    }
}
