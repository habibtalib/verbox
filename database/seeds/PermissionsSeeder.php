<?php

use Illuminate\Database\Seeder;
use Varbox\Contracts\PermissionModelContract;

class PermissionsSeeder extends Seeder
{
    /**
     * Mapping structure of admin permissions.
     *
     * @var array
     */
    protected $permissions = [
        'Users' => [
            'List' => [
                'group' => 'Users',
                'label' => 'List',
                'guard' => 'admin',
                'name' => 'users-list',
            ],
            'Add' => [
                'group' => 'Users',
                'label' => 'Add',
                'guard' => 'admin',
                'name' => 'users-add',
            ],
            'Edit' => [
                'group' => 'Users',
                'label' => 'Edit',
                'guard' => 'admin',
                'name' => 'users-edit',
            ],
            'Delete' => [
                'group' => 'Users',
                'label' => 'Delete',
                'guard' => 'admin',
                'name' => 'users-delete',
            ],
            'Impersonate' => [
                'group' => 'Users',
                'label' => 'Impersonate',
                'guard' => 'admin',
                'name' => 'users-impersonate',
            ],
            'Export' => [
                'group' => 'Users',
                'label' => 'Export',
                'guard' => 'admin',
                'name' => 'users-export',
            ],
        ],
        'Admins' => [
            'List' => [
                'group' => 'Admins',
                'label' => 'List',
                'guard' => 'admin',
                'name' => 'admins-list',
            ],
            'Add' => [
                'group' => 'Admins',
                'label' => 'Add',
                'guard' => 'admin',
                'name' => 'admins-add',
            ],
            'Edit' => [
                'group' => 'Admins',
                'label' => 'Edit',
                'guard' => 'admin',
                'name' => 'admins-edit',
            ],
            'Delete' => [
                'group' => 'Admins',
                'label' => 'Delete',
                'guard' => 'admin',
                'name' => 'admins-delete',
            ],
            'Export' => [
                'group' => 'Admins',
                'label' => 'Export',
                'guard' => 'admin',
                'name' => 'admins-export',
            ],
        ],
        'Roles' => [
            'List' => [
                'group' => 'Roles',
                'label' => 'List',
                'guard' => 'admin',
                'name' => 'roles-list',
            ],
            'Add' => [
                'group' => 'Roles',
                'label' => 'Add',
                'guard' => 'admin',
                'name' => 'roles-add',
            ],
            'Edit' => [
                'group' => 'Roles',
                'label' => 'Edit',
                'guard' => 'admin',
                'name' => 'roles-edit',
            ],
            'Delete' => [
                'group' => 'Roles',
                'label' => 'Delete',
                'guard' => 'admin',
                'name' => 'roles-delete',
            ],
            'Export' => [
                'group' => 'Roles',
                'label' => 'Export',
                'guard' => 'admin',
                'name' => 'roles-export',
            ],
        ],
        'Permissions' => [
            'List' => [
                'group' => 'Permissions',
                'label' => 'List',
                'guard' => 'admin',
                'name' => 'permissions-list',
            ],
            'Add' => [
                'group' => 'Permissions',
                'label' => 'Add',
                'guard' => 'admin',
                'name' => 'permissions-add',
            ],
            'Edit' => [
                'group' => 'Permissions',
                'label' => 'Edit',
                'guard' => 'admin',
                'name' => 'permissions-edit',
            ],
            'Delete' => [
                'group' => 'Permissions',
                'label' => 'Delete',
                'guard' => 'admin',
                'name' => 'permissions-delete',
            ],
            'Export' => [
                'group' => 'Permissions',
                'label' => 'Export',
                'guard' => 'admin',
                'name' => 'permissions-export',
            ],
        ],
        'Uploads' => [
            'List' => [
                'group' => 'Uploads',
                'label' => 'List',
                'guard' => 'admin',
                'name' => 'uploads-list',
            ],
            'Select' => [
                'group' => 'Uploads',
                'label' => 'Select',
                'guard' => 'admin',
                'name' => 'uploads-select',
            ],
            'Upload' => [
                'group' => 'Uploads',
                'label' => 'Upload',
                'guard' => 'admin',
                'name' => 'uploads-upload',
            ],
            'Download' => [
                'group' => 'Uploads',
                'label' => 'Download',
                'guard' => 'admin',
                'name' => 'uploads-download',
            ],
            'Crop' => [
                'group' => 'Uploads',
                'label' => 'Crop',
                'guard' => 'admin',
                'name' => 'uploads-crop',
            ],
            'Delete' => [
                'group' => 'Uploads',
                'label' => 'Delete',
                'guard' => 'admin',
                'name' => 'uploads-delete',
            ],
            'Export' => [
                'group' => 'Uploads',
                'label' => 'Export',
                'guard' => 'admin',
                'name' => 'uploads-export',
            ],
        ],
        'Posts' => [
            'List' => [
                'group' => 'Posts',
                'label' => 'List',
                'guard' => 'admin',
                'name' => 'posts-list',
            ],
            'Add' => [
                'group' => 'Posts',
                'label' => 'Add',
                'guard' => 'admin',
                'name' => 'posts-add',
            ],
            'Edit' => [
                'group' => 'Posts',
                'label' => 'Edit',
                'guard' => 'admin',
                'name' => 'posts-edit',
            ],
            'Delete' => [
                'group' => 'Posts',
                'label' => 'Delete',
                'guard' => 'admin',
                'name' => 'posts-delete',
            ],

            'Export' => [
                'group' => 'Posts',
                'label' => 'Export',
                'guard' => 'admin',
                'name' => 'posts-export',
            ],

            'Draft' => [
                'group' => 'Posts',
                'label' => 'Draft',
                'guard' => 'admin',
                'name' => 'posts-draft',
            ],

            'Publish' => [
                'group' => 'Posts',
                'label' => 'Publish',
                'guard' => 'admin',
                'name' => 'posts-publish',
            ],
        ],
    ];

    /**
     * Run the database seeds.
     *
     * @param PermissionModelContract $permission
     * @return void
     */
    public function run(PermissionModelContract $permission)
    {
        foreach ($this->permissions as $permissions) {
            foreach ($permissions as $data) {
                if ($permission->where('name', $data['name'])->count() == 0) {
                    $permission->create($data);
                }
            }
        }
    }
}