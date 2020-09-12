<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
// use Varbox\Options\ActivityOptions;
// use Varbox\Traits\HasActivity;
// use Varbox\Options\BlockOptions;
use Varbox\Options\OrderOptions;
use Varbox\Options\SlugOptions;
// use Varbox\Traits\HasBlocks;
use Varbox\Traits\HasMetaTags;
use Varbox\Traits\HasSlug;
use Varbox\Traits\HasUploads;
use Varbox\Traits\IsCsvExportable;
use Varbox\Traits\IsDraftable;
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
    use IsDraftable;
    use HasSlug;
    use HasMetaTags;
    // use HasBlocks;

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = [
        'drafted_at',
    ];

    /**
     * The database table.
     *
     * @var string
     */
    protected $table = 'posts';

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'meta' => 'array',
    ];

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
        'slug',
        'meta',
    ];

    /**
     * Set the options for the HasMetaTags trait.
     *
     * @return MetaTagOptions
     */
    public function getMetaTagOptions(): MetaTagOptions
    {
        return MetaTagOptions::instance();
    }

    /**
     * Set the options for the HasBlocks trait.
     *
     * @return BlockOptions
     */
    // public function getBlockOptions()
    // {
    //     return BlockOptions::instance()
    //         ->withLocations(['content', 'sidebar']);
    // }

    /**
     * Get the options for the HasSlug trait.
     *
     * @return SlugOptions
     */
    public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::instance()
            ->generateSlugFrom('title')
            ->saveSlugTo('slug');
    }

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