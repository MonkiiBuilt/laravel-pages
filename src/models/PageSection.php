<?php
/**
 * @author Jonathon Wallen
 * @date 11/4/17
 * @time 11:33 AM
 * @copyright 2008 - present, Monkii Digital Agency (http://monkii.com.au)
 */

namespace MonkiiBuilt\LaravelPages\Models;

use Eloquent;

class PageSection extends Eloquent {

    protected $table = 'page_sections';

    protected $fillable = [
        'type',
        'data',
        'delta',
        'pages_id',
        'created_at',
        'updated_at',
    ];

    public function page()
    {
        return $this->belongsTo('MonkiiBuilt\LaravelPages\Models\Page', 'pages_id');
    }

    public function setDataAttribute($value)
    {
        $this->attributes['data'] = serialize($value);
    }

    public function getDataAttribute($value)
    {
        if (false === ($value = unserialize($value))) {
            $value = [];
        }
        return $value;
    }

}