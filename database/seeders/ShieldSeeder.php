<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use BezhanSalleh\FilamentShield\Support\Utils;
use Spatie\Permission\PermissionRegistrar;

class ShieldSeeder extends Seeder
{
    public function run(): void
    {
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        $rolesWithPermissions = '[{"name":"super_admin","guard_name":"web","permissions":["ViewAny:Role","View:Role","Create:Role","Update:Role","Delete:Role","Restore:Role","ForceDelete:Role","ForceDeleteAny:Role","RestoreAny:Role","Replicate:Role","Reorder:Role"]},{"name":"cleaner","guard_name":"web","permissions":[]},{"name":"company_user","guard_name":"web","permissions":["ViewAny:CleanerAttendance","View:CleanerAttendance","ViewAny:CleanerTaskReport","View:CleanerTaskReport","ViewAny:Site","View:Site","ViewAny:InspectionQuestion","View:InspectionQuestion","ViewAny:Task","View:Task","ViewAny:UserEnrollment","View:UserEnrollment"]},{"name":"site_user","guard_name":"web","permissions":[]},{"name":"admin","guard_name":"web","permissions":["ViewAny:CleanerAttendance","View:CleanerAttendance","Create:CleanerAttendance","Update:CleanerAttendance","Delete:CleanerAttendance","Reorder:CleanerAttendance","ViewAny:CleanerTaskReport","View:CleanerTaskReport","Create:CleanerTaskReport","Update:CleanerTaskReport","Delete:CleanerTaskReport","Reorder:CleanerTaskReport","ViewAny:Cleaner","View:Cleaner","Create:Cleaner","Update:Cleaner","Delete:Cleaner","Reorder:Cleaner","ViewAny:Company","View:Company","Create:Company","Update:Company","Delete:Company","Reorder:Company","ViewAny:CompanyUser","View:CompanyUser","Create:CompanyUser","Update:CompanyUser","Delete:CompanyUser","Reorder:CompanyUser","ViewAny:Site","View:Site","Create:Site","Update:Site","Delete:Site","Reorder:Site","ViewAny:InspectionQuestion","View:InspectionQuestion","Create:InspectionQuestion","Update:InspectionQuestion","Delete:InspectionQuestion","Reorder:InspectionQuestion","ViewAny:Task","View:Task","Create:Task","Update:Task","Delete:Task","Reorder:Task","ViewAny:UserEnrollment","View:UserEnrollment","Create:UserEnrollment","Update:UserEnrollment","Delete:UserEnrollment","Reorder:UserEnrollment","ViewAny:User","View:User","Create:User","Update:User","Delete:User","Reorder:User","View:StatsOverview"]}]';
        $directPermissions = '{"72":{"name":"ViewAny:InspectionAnswerOption","guard_name":"web"},"73":{"name":"View:InspectionAnswerOption","guard_name":"web"},"74":{"name":"Create:InspectionAnswerOption","guard_name":"web"},"75":{"name":"Update:InspectionAnswerOption","guard_name":"web"},"76":{"name":"Delete:InspectionAnswerOption","guard_name":"web"},"77":{"name":"Reorder:InspectionAnswerOption","guard_name":"web"},"78":{"name":"View:InspestionReportDetailPage","guard_name":"web"},"79":{"name":"View:InspectionReportWidget","guard_name":"web"}}';

        static::makeRolesWithPermissions($rolesWithPermissions);
        static::makeDirectPermissions($directPermissions);

        $this->command->info('Shield Seeding Completed.');
    }

    protected static function makeRolesWithPermissions(string $rolesWithPermissions): void
    {
        if (! blank($rolePlusPermissions = json_decode($rolesWithPermissions, true))) {
            /** @var Model $roleModel */
            $roleModel = Utils::getRoleModel();
            /** @var Model $permissionModel */
            $permissionModel = Utils::getPermissionModel();

            foreach ($rolePlusPermissions as $rolePlusPermission) {
                $role = $roleModel::firstOrCreate([
                    'name' => $rolePlusPermission['name'],
                    'guard_name' => $rolePlusPermission['guard_name'],
                ]);

                if (! blank($rolePlusPermission['permissions'])) {
                    $permissionModels = collect($rolePlusPermission['permissions'])
                        ->map(fn ($permission) => $permissionModel::firstOrCreate([
                            'name' => $permission,
                            'guard_name' => $rolePlusPermission['guard_name'],
                        ]))
                        ->all();

                    $role->syncPermissions($permissionModels);
                }
            }
        }
    }

    public static function makeDirectPermissions(string $directPermissions): void
    {
        if (! blank($permissions = json_decode($directPermissions, true))) {
            /** @var Model $permissionModel */
            $permissionModel = Utils::getPermissionModel();

            foreach ($permissions as $permission) {
                if ($permissionModel::whereName($permission)->doesntExist()) {
                    $permissionModel::create([
                        'name' => $permission['name'],
                        'guard_name' => $permission['guard_name'],
                    ]);
                }
            }
        }
    }
}
