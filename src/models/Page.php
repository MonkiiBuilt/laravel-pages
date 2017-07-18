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

class Page extends Eloquent {

    use SoftDeletes;

    protected $table = 'pages';

    /**
     * @var array
     */
    protected $fillable = [
        'title',
        'published',
        'page_type',
        'promoted',
        'promoted_delta',
        'delta',
        'created_by',
        'updated_by',
        'created_at',
        'updated_at',
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

    public function getPageTypeConfigAttribute()
    {
        return config('laravel-administrator.pageTypes.' . $this->page_type);
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

    /**
     * @param array $sections
     */
    public function syncSections(array $sections)
    {
        $children = $this->sections;
        $sections = collect($sections);

        /**
         * delete any page sections that are not in the incoming
         * sections array.
         */
        $deleted_ids = $children->filter(
            function ($child) use ($sections) {
                return empty(
                    $sections->where('id', $child->id)->first()
                );
            }
        )->map(function ($child) {
            $id = $child->id;
            $child->delete();
            return $id;
        });

        /**
         * Update existing sections with any new data
         */
        $attachments = $sections->filter(
            function ($section) {
                return !empty($section['id']);
            }
        )->map(function ($section) {

            $model = \MonkiiBuilt\LaravelPages\Models\PageSection::find($section['id']);

            return $model->update($section);
        });

        // TODO need to add logic to create any new sections that currently do not exist.

    }
}
