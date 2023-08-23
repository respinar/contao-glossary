<?php

declare(strict_types=1);

/*
 * This file is part of Contao Simple Podcast.
 *
 * (c) Hamid Peywasti 2023 <hamid@respinar.com>
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
$GLOBALS['TL_DCA']['tl_glossary_term'] = array(
    'config'      => array(
        'dataContainer'    => DC_Table::class,
        'ptable'           => 'tl_glossary',
        'enableVersioning' => true,
        'switchToEdit'     => true,
        'markAsCopy'       => 'term',
        'sql'              => array(
            'keys' => array(
                'id' => 'primary'
            )
        ),
    ),
    'list'        => array(
        'sorting'           => array(
            'mode'        => DataContainer::MODE_SORTABLE,
            'fields'      => array('term'),
            'flag'        => DataContainer::SORT_INITIAL_LETTER_ASC,
            'panelLayout' => 'filter;search,limit'
        ),
        'label'             => array(
            'fields' => array('term'),
            'format' => '%s',
        ),
        'global_operations' => array(
            'all' => array(
                'href'       => 'act=select',
                'class'      => 'header_edit_all',
                'attributes' => 'onclick="Backend.getScrollOffset()" accesskey="e"'
            )
        ),
        'operations'        => array(
            'edit'   => array(
                'href'  => 'act=edit',
                'icon'  => 'edit.svg'
            ),
            'copy'   => array(
                'href'  => 'act=copy',
                'icon'  => 'copy.svg'
            ),
            'delete' => array(
                'href'       => 'act=delete',
                'icon'       => 'delete.svg',
                'attributes' => 'onclick="if(!confirm(\'' . ($GLOBALS['TL_LANG']['MSC']['deleteConfirm'] ?? null) . '\'))return false;Backend.getScrollOffset()"'
            ),
            'show'   => array(
                'href'       => 'act=show',
                'icon'       => 'show.svg',
                'attributes' => 'style="margin-right:3px"'
            ),
        )
    ),

    // Palettes
    'palettes' => array
	(
		'__selector__'                => array(),
		'default'                     => '
            {term_legend},term,url;
            {definition_legend},definition;
            {image_legend},imgSRC;
			{publish_legend},published,start,stop'
	),

	// Subpalettes
	'subpalettes' => array
	(
		'protected'                   => 'groups',
	),
    'fields' => array(
        'id' => array(
            'sql' => "int(10) unsigned NOT NULL auto_increment"
        ),
        'pid' => array
		(
			'foreignKey' => 'tl_glossary.title',
			'sql'        => "int(10) unsigned NOT NULL default 0",
			'relation'   => array('type'=>'belongsTo', 'load'=>'lazy')
		),
        'tstamp' => array(
            'sql' => "int(10) unsigned NOT NULL default '0'"
        ),
        'term' => array(
            'exclude'   => true,
			'search'    => true,
			'inputType' => 'text',
			'eval'      => array('mandatory'=>true, 'maxlength'=>255, 'tl_class'=>'w50'),
			'sql'       => "varchar(255) NOT NULL default ''"
        ),
        'definition'=> array(
            'exclude'   => true,
			'search'    => true,
			'inputType' => 'textarea',
			'eval'      => array('rte'=>'tinyMCE', 'tl_class'=>'clr'),
			'sql'       => "text NULL"
        ),
        'url' => array
		(
			'exclude'                 => true,
			'search'                  => true,
			'inputType'               => 'text',
			'eval'                    => array('mandatory'=>false, 'rgxp'=>'url', 'decodeEntities'=>true, 'maxlength'=>2048, 'dcaPicker'=>true, 'tl_class'=>'w50'),
			'sql'                     => "varchar(2048) NOT NULL default ''"
		),
        'imgSRC' => array
		(
			'exclude'                 => true,
			'inputType'               => 'fileTree',
			'eval'                    => array( 'mandatory'=>false, 'fieldType'=>'radio', 'filesOnly'=>true, 'extensions'=>'%contao.image.valid_extensions%'),
			'sql'                     => "binary(16) NULL"
		),
        'published' => array
		(
			'exclude'                 => true,
			'toggle'                  => true,
			'filter'                  => true,
			'flag'                    => DataContainer::SORT_INITIAL_LETTER_ASC,
			'inputType'               => 'checkbox',
			'eval'                    => array('doNotCopy'=>true),
			'sql'                     => "char(1) NOT NULL default ''"
		),
		'start' => array
		(
			'exclude'                 => true,
			'inputType'               => 'text',
			'eval'                    => array('rgxp'=>'datim', 'datepicker'=>true, 'tl_class'=>'w50 wizard'),
			'sql'                     => "varchar(10) NOT NULL default ''"
		),
		'stop' => array
		(
			'exclude'                 => true,
			'inputType'               => 'text',
			'eval'                    => array('rgxp'=>'datim', 'datepicker'=>true, 'tl_class'=>'w50 wizard'),
			'sql'                     => "varchar(10) NOT NULL default ''"
		)

    )
);