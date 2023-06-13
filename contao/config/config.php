<?php

/*
 * This file is part of Contao Simple Podcast.
 *
 * (c) Hamid Abbaszadeh 2023 <abbaszadeh.h@gmail.com>
 * @license MIT
 * For the full copyright and license information,
 * please view the LICENSE file that was distributed with this source code.
 * @link https://github.com/respinar/contao-podcast-bundle
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
