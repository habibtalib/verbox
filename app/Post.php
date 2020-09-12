<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
// use Varbox\Options\ActivityOptions;
// use Varbox\Traits\HasActivity;
use Varbox\Options\OrderOptions;
use Varbox\Traits\HasUploads;
use Varbox\Traits\IsCsvExportable;
use Varbox\Traits\IsFilterable;
use Varbox\Traits\IsOrderable;
use Varbox\Traits\IsSortable;

class Post extends Model
{
    // use HasActivity;
    use IsFilterable;
    use IsSortable;
    use IsOrderable;
    use IsCsvExportable;
    use HasUploads;

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
        'image',
        'pdf',
    ];

    /**
     * Get the heading columns for the csv.
     *
     * @return array
     */
    public function getCsvColumns()
    {
        return [
            'Title', 'User', 'Created At', 'Last Modified At',
        ];
    }

    /**
     * Get the specific upload config parts for this model.
     *
     * @return array
     */
    public function getUploadConfig()
    {
        return [
            'images' => [
                'styles' => [
                    'image' => [
                        'square' => [
                            'width' => '200',
                            'height' => '200',
                            'ratio' => true,
                        ],
                        'landscape' => [
                            'width' => '200',
                            'height' => '100',
                            'ratio' => true,
                        ],
                    ],
                ],
            ],
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
            $this->title,
            $this->user && $this->user->exists ? $this->user->email : 'None',
            $this->created_at->format('Y-m-d H:i:s'),
            $this->updated_at->format('Y-m-d H:i:s'),
        ];
    }

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