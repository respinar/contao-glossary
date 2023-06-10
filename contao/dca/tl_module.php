<?php

declare(strict_types=1);

use Contao\Controller;

use Respinar\GlossaryBundle\Controller\FrontendModule\GlossaryController;

$GLOBALS['TL_DCA']['tl_module']['palettes'][GlossaryController::TYPE] = '
    {title_legend},name,headline,type;
    {template_legend:hide},customTpl,glossary_term_template;
    {image_legend:hide},imgSize;
    {protected_legend:hide},protected;
    {expert_legend:hide},guests,cssID;
';


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