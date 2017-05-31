<?php
/**
 * @author Jonathon Wallen
 * @date 1/5/17
 * @time 10:53 AM
 * @copyright 2008 - present, Monkii Digital Agency (http://monkii.com.au)
 */
return [
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
     * Define your page types here.
     *
     */
    'pageTypes' => [
        'standard_page' => [
            'name' => 'standard_page',
            'label' => 'Standard page',
            'template' => 'pages.standard_page',
            'sections' => [
                [
                    'class' => 'MonkiiBuilt\LaravelPageSectionsText\Models\PageSectionText',
                    'type' => 'plain_text',
                    'form_element_label' => 'Body',
                    'form_element_name' => 'body',
                ]
            ]
        ],
    ]
];