<?php

namespace Varbox\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Foundation\Auth\User;
use Illuminate\Support\Arr;
use Illuminate\Support\Collection;
use Varbox\Contracts\PermissionModelContract;
use Varbox\Traits\IsCacheable;
use Varbox\Traits\IsCsvExportable;
use Varbox\Traits\IsFilterable;
use Varbox\Traits\IsSortable;

class Permission extends Model implements PermissionModelContract
{
    use IsFilterable;
    use IsSortable;
    use IsCacheable;
    use IsCsvExportable;

    /**
     * The database table.
     *
     * @var string
     */
    protected $table = 'permissions';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'guard',
        'group',
        'label',
    ];

    /**
     * Permission has and belongs to many users.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function users()
    {
        $user = config('varbox.bindings.models.user_model', User::class);

        return $this->belongsToMany($user, 'user_permission')->withTimestamps();
    }

    /**
     * Permission has and belongs to many roles.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function roles()
    {
        $role = config('varbox.bindings.models.role_model', Role::class);

        return $this->belongsToMany($role, 'role_permission')->withTimestamps();
    }

    /**
     * Get a permission.
     *
     * @param string|array|PermissionModelContract|\Illuminate\Database\Eloquent\Collection $permission
     * @return mixed
     */
    public function getPermission($permission)
    {
        if (is_numeric($permission)) {
            return static::findOrFail($permission);
        }

        if (is_string($permission)) {
            return static::findByName($permission);
        }

        return $permission;
    }

    /**
     * Get permissions.
     *
     * @param array $permissions
     * @return Collection
     */
    public static function getPermissions($permissions)
    {
        return static::whereIn(
            is_numeric(Arr::first($permissions)) ? 'id' : 'name', $permissions
        )->get();
    }

    /**
     * Get a permission by it's name.
     *
     * @param string $name
     * @return \Illuminate\Database\Eloquent\Model|static
     * @throws ModelNotFoundException
     */
    public static function findByName($name)
    {
        try {
            return static::whereName($name)->firstOrFail();
        } catch (ModelNotFoundException $e) {
            throw new ModelNotFoundException('Permission "' . $name . '" does not exist!');
        }
    }

    /**
     * Get permissions as array grouped by the "group" column.
     *
     * @param string $guard
     * @return Collection
     */
    public static function getGrouped($guard)
    {
        return static::whereGuard($guard)->get()->groupBy('group');
    }

    /**
     * Get the heading columns for the csv.
     *
     * @return array
     */
    public function getCsvColumns()
    {
        return [
            'Name', 'Guard', 'Group', 'Label', 'Created At', 'Last Modified At',
        ];
    }

    /**
     * Get the values for a row in the csv.
     *
     * @return array
     */
    public function toCsvArray()
    {
        return [
            $this->name,
            $this->guard,
            $this->group,
            $this->label,
            $this->created_at->format('Y-m-d H:i:s'),
            $this->updated_at->format('Y-m-d H:i:s'),
        ];
    }
}
