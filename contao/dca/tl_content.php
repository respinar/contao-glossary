<?php

declare(strict_types=1);

/*
 * This file is part of Contao Simple Glossary.
 *
 * (c) Hamid Peywasti
 *
 * @license MIT
 */

use Contao\Controller;
use Respinar\GlossaryBundle\Controller\ContentElement\GlossaryController;

$GLOBALS['TL_DCA']['tl_content']['palettes'][GlossaryController::TYPE] = '
    {title_legend},name,headline,type;
	  {config_legend},glossary,glossary_term_order;
    {template_legend:hide},customTpl,glossary_term_template;
    {image_legend:hide},size;
    {protected_legend:hide},protected;
    {expert_legend:hide},guests,cssID;
';

$GLOBALS['TL_DCA']['tl_content']['fields']['glossary'] = [
    'exclude' => true,
    'inputType' => 'select',
    'foreignKey' => 'tl_glossary.title',
    'eval' => ['multiple' => false, 'foreignTable' => 'tl_glossary', 'mandatory' => true, 'tl_class' => 'w50'],
    'sql' => 'int(10) NULL',
];

$GLOBALS['TL_DCA']['tl_content']['fields']['glossary_term_order'] = [
    'exclude' => true,
    'inputType' => 'select',
    'options' => ['order_term_asc', 'order_term_desc'],
    'reference' => &$GLOBALS['TL_LANG']['tl_content'],
    'eval' => ['tl_class' => 'w50'],
    'sql' => "varchar(32) COLLATE ascii_bin NOT NULL default 'order_term_asc'",
];

$GLOBALS['TL_DCA']['tl_content']['fields']['glossary_term_template'] = [
    'exclude' => true,
    'inputType' => 'select',
    'options_callback' => static fn () => Controller::getTemplateGroup('glossary_term'),
    'eval' => ['includeBlankOption' => true, 'chosen' => true, 'tl_class' => 'w50'],
    'sql' => "varchar(64) COLLATE ascii_bin NOT NULL default ''",
];
