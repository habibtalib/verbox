<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
// use Varbox\Options\ActivityOptions;
// use Varbox\Traits\HasActivity;
use Varbox\Options\OrderOptions;
use Varbox\Traits\IsFilterable;
use Varbox\Traits\IsOrderable;
use Varbox\Traits\IsSortable;

class Post extends Model
{
    // use HasActivity;
    use IsFilterable;
    use IsSortable;
    use IsOrderable;

    /**
     * The database table.
     *
     * @var string
     */
    protected $table = 'posts';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'title',
        'subtitle',
        'description',
    ];

    public static function getOrderOptions()
    {
        return OrderOptions::instance();
    }

    /**
     * Set the options for the HasActivity trait.
     *
     * @return ActivityOptions
     */
    // public function getActivityOptions()
    // {
    //     return ActivityOptions::instance()
    //         ->withEntityType('post')
    //         ->withEntityName($this->title)
    //         ->withEntityUrl(route('admin.posts.edit', $this->id));
    // }

    /**
     * A post belongs to a user.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}