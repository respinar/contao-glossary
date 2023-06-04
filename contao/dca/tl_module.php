<?php

declare(strict_types=1);

use Contao\Controller;

use Respinar\GlossaryBundle\Controller\FrontendModule\GlossaryController;

$GLOBALS['TL_DCA']['tl_module']['palettes'][GlossaryController::TYPE] = '
    {title_legend},name,headline,type;
    {template_legend:hide},customTpl;
    {protected_legend:hide},protected;
    {expert_legend:hide},guests,cssID;
';
