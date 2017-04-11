<?php
/**
 * @author Jonathon Wallen
 * @date 11/4/17
 * @time 11:05 AM
 * @copyright 2008 - present, Monkii Digital Agency (http://monkii.com.au)
 */

namespace MonkiiBuilt\LaravelPages\Models;

use Eloquent;
use Illuminate\Database\Eloquent\SoftDeletes;
use MonkiiBuilt\LaravelUrlAlias\Traits\UrlAlias;

class Page extends Eloquent {

    use SoftDeletes;

    use UrlAlias;

    protected $table = 'pages';

    /**
     * @var array
     */
    protected $fillable = [
        'title',
        'slug',
        'published',
        'created_by',
        'updated_by',
        'created_at',
        'updated_at',
        'page_types_id'
    ];

    /**
     * @var array
     */
    protected $dates = ['deleted_at', 'created_at', 'updated_at'];

    /**
     * @return mixed
     */
    public function createdBy()
    {
        return $this->belongsTo('App\User', 'created_by');
    }

    /**
     * @return mixed
     */
    public function updatedBy()
    {
        return $this->belongsTo('App\User', 'updated_by');
    }

    public function sections()
    {
        return $this->hasMany('MonkiiBuilt\LaravelPages\Models\PageSection', 'pages_id')->orderBy('delta');
    }

    public function metatags()
    {
        return $this->hasMany('MonkiiBuilt\LaravelPages\Models\PageMetaTag', 'pages_id');
    }

    public function type()
    {
        return $this->belongsTo('MonkiiBuilt\LaravelPages\Models\PageType', 'page_types_id');
    }

    public function getUrlAttribute()
    {
        return secure_url($this->urlAlias->path);
    }

    public function scopeIsPublished($query)
    {
        return $query->where('published', '=', 1);
    }

    public function getTemplateAttribute()
    {
        return $this->type->template;
    }
}