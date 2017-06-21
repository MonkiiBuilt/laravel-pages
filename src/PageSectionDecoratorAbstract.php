<?php
/**
 * @author Jonathon Wallen
 * @date 30/5/17
 * @time 4:31 PM
 * @copyright 2008 - present, Monkii Digital Agency (http://monkii.com.au)
 */

namespace MonkiiBuilt\LaravelPages;

use MonkiiBuilt\LaravelPages\Models\PageSection;

abstract class PageSectionDecoratorAbstract {

    protected $wrapped;

    public function __construct(PageSection $section)
    {
        $this->wrapped = $section;
    }

    abstract public function renderForm();
}
