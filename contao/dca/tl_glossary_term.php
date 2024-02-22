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
 * Table tl_glossary_term
 */
$GLOBALS['TL_DCA']['tl_glossary_term'] = [
    'config' => [
        'dataContainer'    => DC_Table::class,
        'ptable'           => 'tl_glossary',
        'enableVersioning' => true,
        'switchToEdit'     => true,
        'markAsCopy'       => 'term',
        'sql'              => [
            'keys' => [
                'id' => 'primary'
            ]
        ],
    ],
    'list' => [
        'sorting' => [
            'mode'        => DataContainer::MODE_SORTABLE,
            'fields'      => ['term'],
            'flag'        => DataContainer::SORT_INITIAL_LETTER_ASC,
            'panelLayout' => 'filter;search,limit'
        ],
        'label'             => [
            'fields' => ['term'],
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
                'href'  => 'act=edit',
                'icon'  => 'edit.svg'
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
            'show' => [
                'href'       => 'act=show',
                'icon'       => 'show.svg',
                'attributes' => 'style="margin-right:3px"'
            ],
        ]
    ],

    // Palettes
    'palettes' => [
		'__selector__' => [],
		'default' => '{term_legend},term,url;{definition_legend},definition;{image_legend},imgSRC;{publish_legend},published,start,stop'
    ],

	// Subpalettes
	'subpalettes' => [
		'protected' => 'groups',
    ],
    'fields' => [
        'id' => [
            'sql' => "int(10) unsigned NOT NULL auto_increment"
        ],
        'pid' => [
			'foreignKey' => 'tl_glossary.title',
			'sql'        => "int(10) unsigned NOT NULL default 0",
			'relation'   => ['type' => 'belongsTo', 'load' => 'lazy']
        ],
        'tstamp' => [
            'sql' => "int(10) unsigned NOT NULL default 0"
        ],
        'term' => [
            'exclude'   => true,
			'search'    => true,
			'inputType' => 'text',
			'eval'      => ['mandatory' => true, 'maxlength' => 255, 'tl_class' => 'w50'],
			'sql'       => "varchar(255) NOT NULL default ''"
        ],
        'definition' => [
            'exclude'   => true,
			'search'    => true,
			'inputType' => 'textarea',
			'eval'      => ['rte' => 'tinyMCE', 'tl_class' => 'clr'],
			'sql'       => "text NULL"
        ],
        'url' => [
			'exclude'   => true,
			'search'    => true,
			'inputType' => 'text',
			'eval'      => ['mandatory' =>false, 'rgxp' => 'url', 'decodeEntities' => true, 'maxlength' => 2048, 'dcaPicker' => true, 'tl_class' => 'w50'],
			'sql'       => "varchar(2048) NOT NULL default ''"
        ],
        'imgSRC' => [
			'exclude'   => true,
			'inputType' => 'fileTree',
			'eval'      => ['mandatory' => false, 'fieldType' => 'radio', 'filesOnly' => true, 'extensions' => '%contao.image.valid_extensions%'],
			'sql'       => "binary(16) NULL"
        ],
        'published' => [
			'exclude'   => true,
			'toggle'    => true,
			'filter'    => true,
			'flag'      => DataContainer::SORT_INITIAL_LETTER_ASC,
			'inputType' => 'checkbox',
			'eval'      => ['doNotCopy' => true],
			'sql'       => ['type' => 'boolean', 'default' => false]
        ],
		'start' => [
			'exclude'   => true,
			'inputType' => 'text',
			'eval'      => ['rgxp' => 'datim', 'datepicker' => true, 'tl_class' => 'w50 wizard'],
			'sql'       => "varchar(10) NOT NULL default ''"
        ],
		'stop' => [
			'exclude'   => true,
			'inputType' => 'text',
			'eval'      => ['rgxp' => 'datim', 'datepicker' => true, 'tl_class' => 'w50 wizard'],
			'sql'       => "varchar(10) NOT NULL default ''"
        ]
    ]
];