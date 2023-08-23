<?php

declare(strict_types=1);

/*
 * This file is part of Contao Simple Podcast.
 *
 * (c) Hamid Peywasti 2023 <hamid@respinar.com>
 *
 * @license MIT
 */

use Contao\Controller;

use Respinar\GlossaryBundle\Controller\FrontendModule\GlossaryController;

$GLOBALS['TL_DCA']['tl_module']['palettes'][GlossaryController::TYPE] = '
    {title_legend},name,headline,type;
	{config_legend},glossary,glossary_term_order;
    {template_legend:hide},customTpl,glossary_term_template;
    {image_legend:hide},imgSize;
    {protected_legend:hide},protected;
    {expert_legend:hide},guests,cssID;
';

$GLOBALS['TL_DCA']['tl_module']['fields']['glossary'] = array
(
	'exclude'                 => true,
	'inputType'               => 'select',
	'foreignKey'              => 'tl_glossary.title',
	'eval'                    => array('multiple'=>false, 'foreignTable' => 'tl_glossary', 'mandatory'=>true, 'tl_class'=>'w50'),
	'sql'                     => "int(10) NULL"
);

$GLOBALS['TL_DCA']['tl_module']['fields']['glossary_term_order'] = array
(
	'exclude'                 => true,
	'inputType'               => 'select',
	'options'                 => array('order_term_asc', 'order_term_desc'),
	'reference'               => &$GLOBALS['TL_LANG']['tl_module'],
	'eval'                    => array('tl_class'=>'w50'),
	'sql'                     => "varchar(32) COLLATE ascii_bin NOT NULL default 'order_term_asc'"
);

$GLOBALS['TL_DCA']['tl_module']['fields']['glossary_term_template'] = array
(
	'exclude'                 => true,
	'inputType'               => 'select',
	'options_callback' => static function ()
	{
		return Controller::getTemplateGroup('glossary_term_');
	},
	'eval'                    => array('includeBlankOption'=>true, 'chosen'=>true, 'tl_class'=>'w50'),
	'sql'                     => "varchar(64) COLLATE ascii_bin NOT NULL default ''"
);