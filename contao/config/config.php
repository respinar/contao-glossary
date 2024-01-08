<?php

/*
 * This file is part of Contao Simple Glossary.
 *
 * (c) Hamid Peywasti 2024 <hamid@respinar.com>
 *
 * @license MIT
 */

use Respinar\GlossaryBundle\Model\GlossaryModel;
use Respinar\GlossaryBundle\Model\GlossaryTermModel;

/**
 * Backend modules
 */
$GLOBALS['BE_MOD']['content']['glossary'] = array(
    'tables' => array('tl_glossary','tl_glossary_term')
);

/**
 * Models
 */
$GLOBALS['TL_MODELS']['tl_glossary'] = GlossaryModel::class;
$GLOBALS['TL_MODELS']['tl_glossary_term'] = GlossaryTermModel::class;
