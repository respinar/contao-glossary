<?php

declare(strict_types=1);

/*
 * This file is part of Contao Simple Glossary.
 *
 * (c) Hamid Peywasti
 *
 * @license MIT
 */

use Contao\DataContainer;
use Contao\DC_Table;

/*
 * Table tl_glossary
 */
$GLOBALS['TL_DCA']['tl_glossary'] = [
    'config' => [
        'dataContainer' => DC_Table::class,
        'ctable' => ['tl_glossary_term'],
        'enableVersioning' => true,
        'switchToEdit' => true,
        'markAsCopy' => 'title',
        'sql' => [
            'keys' => [
                'id' => 'primary',
            ],
        ],
    ],
    'list' => [
        'sorting' => [
            'mode' => DataContainer::MODE_SORTED,
            'fields' => ['title'],
            'flag' => DataContainer::SORT_INITIAL_LETTER_ASC,
            'panelLayout' => 'search,filter,limit',
            'defaultSearchField' => 'title',
        ],
        'label' => [
            'fields' => ['title'],
            'format' => '%s',
        ],
        'operations' => [
            'edit',
            'children',
            'copy',
            'delete',
            'show',
        ],
    ],

    // Palettes
    'palettes' => [
        '__selector__' => [],
        'default' => '{title_legend},title;',
    ],

    // Subpalettes
    'subpalettes' => [
        'protected' => 'groups',
    ],
    'fields' => [
        'id' => [
            'sql' => 'int(10) unsigned NOT NULL auto_increment',
        ],
        'tstamp' => [
            'sql' => 'int(10) unsigned NOT NULL default 0',
        ],
        'title' => [
            'exclude' => true,
            'search' => true,
            'inputType' => 'text',
            'eval' => ['mandatory' => true, 'maxlength' => 255, 'tl_class' => 'w50'],
            'sql' => "varchar(255) NOT NULL default ''",
        ],
    ],
];
