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
 * Table tl_glossary
 */
$GLOBALS['TL_DCA']['tl_glossary'] = array(
    'config'      => array(
        'dataContainer'    => DC_Table::class,
        'ctabel'           => array('tl_glossary_term'),
        'enableVersioning' => true,
        'switchToEdit'     => true,
        'markAsCopy'       => 'title',
        'sql'              => array(
            'keys' => array(
                'id' => 'primary'
            )
        ),
    ),
    'list'        => array(
        'sorting'           => array(
            'mode'        => DataContainer::MODE_UNSORTED,
            'fields'      => array('title'),
            'panelLayout' => 'filter;search,limit'
        ),
        'label'             => array(
            'fields' => array('title'),
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
                'href'  => 'table=tl_glossary_term',
                'icon'  => 'edit.svg'
            ),
            'editheader'   => array(
                'href'  => 'act=edit',
                'icon'  => 'header.svg'
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
            {title_legend},title;'
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
        'tstamp' => array(
            'sql' => "int(10) unsigned NOT NULL default '0'"
        ),
        'title' => array(
            'exclude'   => true,
			'search'    => true,
			'inputType' => 'text',
			'eval'      => array('mandatory'=>true, 'maxlength'=>255, 'tl_class'=>'w50'),
			'sql'       => "varchar(255) NOT NULL default ''"
        )
    )
);