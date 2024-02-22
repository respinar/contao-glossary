<?php

declare(strict_types=1);

/*
 * This file is part of Contao Simple Glossary.
 *
 * (c) Hamid Peywasti 2024 <hamid@respinar.com>
 *
 * @license MIT
 */

use Contao\Backend;
use Contao\DataContainer;
use Contao\DC_Table;
use Contao\Input;

/**
 * Table tl_glossary
 */
$GLOBALS['TL_DCA']['tl_glossary'] = [
    'config' => [
        'dataContainer'    => DC_Table::class,
        'ctabel'           => ['tl_glossary_term'],
        'enableVersioning' => true,
        'switchToEdit'     => true,
        'markAsCopy'       => 'title',
        'sql'              => [
            'keys' => [
                'id' => 'primary'
            ]
        ],
    ],
    'list' => [
        'sorting' => [
            'mode'        => DataContainer::MODE_UNSORTED,
            'fields'      => ['title'],
            'panelLayout' => 'filter;search,limit'
        ],
        'label' => [
            'fields' => ['title'],
            'format' => '%s',
        ],
        'global_operations' => [
            'all' => [
                'href'       => 'act=select',
                'class'      => 'header_edit_all',
                'attributes' => 'onclick="Backend.getScrollOffset()" accesskey="e"'
            ]
        ],
        'operations' => [
            'edit' => [
                'href'  => 'table=tl_glossary_term',
                'icon'  => 'edit.svg'
            ],
            'editheader' => [
                'href'  => 'act=edit',
                'icon'  => 'header.svg'
            ],
            'copy' => [
                'href'  => 'act=copy',
                'icon'  => 'copy.svg'
            ],
            'delete' => [
                'href'       => 'act=delete',
                'icon'       => 'delete.svg',
                'attributes' => 'onclick="if(!confirm(\'' . ($GLOBALS['TL_LANG']['MSC']['deleteConfirm'] ?? null) . '\'))return false;Backend.getScrollOffset()"'
            ],
            'show'   => [
                'href'       => 'act=show',
                'icon'       => 'show.svg',
                'attributes' => 'style="margin-right:3px"'
            ],
        ]
    ],

    // Palettes
    'palettes' => [
		'__selector__' => [],
		'default' => '{title_legend},title;'
	],

	// Subpalettes
	'subpalettes' => [
		'protected' => 'groups',
	],
    'fields' => [
        'id' => [
            'sql' => "int(10) unsigned NOT NULL auto_increment"
        ],
        'tstamp' => [
            'sql' => "int(10) unsigned NOT NULL default 0"
        ],
        'title' => [
            'exclude'   => true,
			'search'    => true,
			'inputType' => 'text',
			'eval'      => ['mandatory' => true, 'maxlength' => 255, 'tl_class' => 'w50'],
			'sql'       => "varchar(255) NOT NULL default ''"
        ]
    ]
];