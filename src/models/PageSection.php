<?php
/**
 * @author Jonathon Wallen
 * @date 11/4/17
 * @time 11:33 AM
 * @copyright 2008 - present, Monkii Digital Agency (http://monkii.com.au)
 */

namespace MonkiiBuilt\LaravelPages\Models;

use Eloquent;

use Nanigans\SingleTableInheritance\SingleTableInheritanceTrait;

class PageSection extends Eloquent {

    use SingleTableInheritanceTrait;

    protected $table = 'page_sections';

    protected static $singleTableTypeField = 'type';

    protected static $singleTableSubclasses = [];

    protected static $singleTableType;

    protected $fillable = [
        'type',
        'data',
        'form_element_name',
        'form_element_label',
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
        $value = unserialize($value);
        return $value;
    }

    public static function addSingleTableSubclass($className)
    {
        self::$singleTableSubclasses[] = $className;
    }

    public static function getSingleTableSubclasses()
    {
        return self::$singleTableSubclasses;
    }

    public static function getSingleTableType()
    {
        return static::$singleTableType;
    }

    public function getDecorator(){}
}