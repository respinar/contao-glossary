<?php

declare(strict_types=1);

namespace Respinar\GlossaryBundle\Controller\FrontendModule;

use Contao\CoreBundle\Controller\FrontendModule\AbstractFrontendModuleController;
use Contao\CoreBundle\DependencyInjection\Attribute\AsFrontendModule;
use Contao\ModuleModel;
use Contao\Template;
use Respinar\GlossaryBundle\Model\GlossaryModel;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

#[AsFrontendModule(category: "miscellaneous")]
class GlossaryController extends AbstractFrontendModuleController
{
    public const TYPE = 'glossary';

    protected function getResponse(Template $template, ModuleModel $model, Request $request): Response
    {

        $objTerms = GlossaryModel::findAll();

        $arrElements = array();

        foreach($objTerms as $objTerm) {
            $arrElement = array();
            $arrElement['term'] = $objTerm->term;
            $arrElement['definition'] = $objTerm->definition;
            $arrElement['image'] = $objTerm->imgSRC;
            $arrElement['link'] = $objTerm->url;

            $arrElements[] = $arrElement;
        }

        $template->arrElemets = $arrElements;

        return $template->getResponse();
    }
}
