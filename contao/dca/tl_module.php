<?php

declare(strict_types=1);

/*
 * This file is part of Contao Simple Glossary.
 *
 * (c) Hamid Peywasti 2024 <hamid@respinar.com>
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

$GLOBALS['TL_DCA']['tl_module']['fields']['glossary'] = [
	'exclude'    => true,
	'inputType'  => 'select',
	'foreignKey' => 'tl_glossary.title',
	'eval'       => ['multiple'=>false, 'foreignTable' => 'tl_glossary', 'mandatory' => true, 'tl_class' => 'w50'],
	'sql'        => "int(10) NULL"
];

$GLOBALS['TL_DCA']['tl_module']['fields']['glossary_term_order'] = [
	'exclude'    => true,
	'inputType'  => 'select',
	'options'    => ['order_term_asc', 'order_term_desc'],
	'reference'  => &$GLOBALS['TL_LANG']['tl_module'],
	'eval'       => ['tl_class' => 'w50'],
	'sql'        => "varchar(32) COLLATE ascii_bin NOT NULL default 'order_term_asc'"
];

$GLOBALS['TL_DCA']['tl_module']['fields']['glossary_term_template'] = [
	'exclude'    => true,
	'inputType'  => 'select',
	'options_callback' => static function ()
	{
		return Controller::getTemplateGroup('glossary_term_');
	},
	'eval'       => ['includeBlankOption' => true, 'chosen' => true, 'tl_class' => 'w50'],
	'sql'        => "varchar(64) COLLATE ascii_bin NOT NULL default ''"
];