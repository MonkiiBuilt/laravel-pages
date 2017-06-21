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
        'machine_name',
        'label',
        'rules',
        'messages',
        'delta',
        'pages_id',
        'created_at',
        'updated_at',
    ];

    public function page()
    {
        return $this->belongsTo('MonkiiBuilt\LaravelPages\Models\Page', 'pages_id');
    }

    protected $casts = [
        'data' => 'array',
        'rules' => 'array',
        'messages' => 'array',
    ];

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