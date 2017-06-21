<?php
/**
 * @author Jonathon Wallen
 * @date 11/4/17
 * @time 11:33 AM
 * @copyright 2008 - present, Monkii Digital Agency (http://monkii.com.au)
 */

namespace MonkiiBuilt\LaravelPages\Models;

use Eloquent;

class PageMetaTag extends Eloquent {

    protected $table = 'page_metatags';

    protected $fillable = [
        'name',
        'content',
        'pages_id',
        'created_at',
        'updated_at',
    ];

    public function page()
    {
        return $this->belongsTo('MonkiiBuilt\LaravelPages\Models\Page', 'pages_id');
    }
}