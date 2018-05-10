<?php
/**
 * @author Jonathon Wallen
 * @date 1/5/17
 * @time 10:53 AM
 * @copyright 2008 - present, Monkii Digital Agency (http://monkii.com.au)
 */
return [

    'page-class' => \MonkiiBuilt\LaravelPages\Models\Page::class,

    'menu' => [
        'main' => [
            'laravel-administrator-pages' => [
                'label' => 'Pages',
                'classes' => [],
                'children' => [
                    'laravel-administrator-pages-create',
                    'laravel-administrator-pages-edit',
                ]
            ]
        ]
    ],

    /**
     * Define available page sections here, allows users to add a content section
     * to an existing page in addition to any predefined sections for that page type.
     *
     * eg:
         'body' => [
            'machine_name' => 'body',
            'label' => 'Body',
            'type' => 'plain_text',
            'class' => 'MonkiiBuilt\LaravelPageSectionsText\Models\PageSectionText',
        ],
     */
    'availablePageSections' => [],

    /**
     * Define your page types here.
     *
     */
    'pageTypes' => [
        'standard_page' => [
            'machine_name' => 'standard_page',
            'label' => 'Standard page',
            'template' => 'pages.standard_page',
            'sections' => [
                [
                    'class' => 'MonkiiBuilt\LaravelPageSectionsText\Models\PageSectionText',
                    'type' => 'plain_text',
                    'label' => 'Body',
                    'machine_name' => 'body',
                ]
            ]
        ],
    ]
];
