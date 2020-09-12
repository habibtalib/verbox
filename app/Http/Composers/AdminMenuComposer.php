<?php

namespace App\Http\Composers;

use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Support\Collection;
use Illuminate\View\View;
use Varbox\Helpers\MenuHelper;
use Varbox\Menu\MenuItem;

class AdminMenuComposer
{
    /**
     * @var Authenticatable
     */
    protected $user;

    /**
     * @var Collection
     */
    protected $permissions;

    /**
     * @param Authenticatable $user
     */
    public function __construct(Authenticatable $user)
    {
        $this->user = $user;
    }

    /**
     * Construct the admin menu.
     *
     * @param View $view
     */
    public function compose(View $view)
    {
        $menu = menu()->make(function (MenuHelper $menu) {
            $menu->add(function (MenuItem $item) {
                $item->name('Home')->url(route('admin'))->data('icon', 'fa-home')->active('admin');
            });

            $menu->add(function ($item) use ($menu) {
                $auth = $item->name('Access Control')->data('icon', 'fa-sign-in-alt')
                    ->permissions('users-list', 'admins-list', 'roles-list', 'permissions-list')
                    ->active('admin/users/*', 'admin/admins/*', 'admin/roles/*', 'admin/permissions/*');

                $menu->child($auth, function (MenuItem $item) {
                    $item->name('Users')->url(route('admin.users.index'))->permissions('users-list')->active('admin/users/*');
                });

                $menu->child($auth, function (MenuItem $item) {
                    $item->name('Admins')->url(route('admin.admins.index'))->permissions('admins-list')->active('admin/admins/*');
                });

                $menu->child($auth, function (MenuItem $item) {
                    $item->name('Roles')->url(route('admin.roles.index'))->permissions('roles-list')->active('admin/roles/*');
                });

                $menu->child($auth, function (MenuItem $item) {
                    $item->name('Permissions')->url(route('admin.permissions.index'))->permissions('permissions-list')->active('admin/permissions/*');
                });
            });

            $menu->add(function ($item) use ($menu) {
                $blog = $item->name('Blog Area')->data('icon', 'fa-blog')
                    ->permissions('posts-list')
                    ->active('admin/posts/*');

                $menu->child($blog, function (MenuItem $item) {
                    $item->name('Posts')
                        ->url(route('admin.posts.index'))
                        ->permissions('posts-list')
                        ->active('admin/posts/*');
                });
            });

            $menu->add(function ($item) use ($menu) {
                $media = $item->name('Media Library')->data('icon', 'fa-copy')
                    ->permissions('uploads-list')
                    ->active('admin/uploads/*');

                $menu->child($media, function (MenuItem $item) {
                    $item->name('Uploads')->url(route('admin.uploads.index'))->permissions('uploads-list')->active('admin/uploads/*');
                });
            });
        })->filter(function (MenuItem $item) {
            return $this->user->isSuper() || $this->userHasAnyMenuPermission($item->permissions());
        });

        $view->with('menu', $menu);
    }

    /**
     * Determine if the user has any of the given permissions.
     *
     * @param array $permissions
     * @return bool
     */
    protected function userHasAnyMenuPermission(array $permissions = [])
    {
        if (empty($permissions)) {
            return true;
        }

        if (!$this->permissions) {
            $this->permissions = $this->user->getPermissions()->pluck('name');
        }

        foreach ($permissions as $permission) {
            if ($this->permissions->contains($permission)) {
                return true;
            }
        }

        return false;
    }
}