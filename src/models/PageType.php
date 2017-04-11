<?php
/**
 * @author Jonathon Wallen
 * @date 11/4/17
 * @time 11:18 AM
 * @copyright 2008 - present, Monkii Digital Agency (http://monkii.com.au)
 */

namespace MonkiiBuilt\LaravelPages\Models;

use Eloquent;

class PageType extends Eloquent {

    protected $table = 'page_types';

    protected $fillable = [
        'name',
        'template',
        'description',
        'created_at',
        'updated_at',
    ];

    public function pages()
    {
        return $this->hasMany('MonkiiBuilt\LaravelPages\Models\Page', 'page_types_id');
    }

}