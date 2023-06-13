<?php

declare(strict_types=1);

namespace Respinar\GlossaryBundle\Controller\FrontendModule;

use Contao\CoreBundle\Controller\FrontendModule\AbstractFrontendModuleController;
use Contao\CoreBundle\DependencyInjection\Attribute\AsFrontendModule;
use Contao\ModuleModel;
use Contao\Template;
use Contao\System;
use Contao\StringUtil;
use Contao\FrontendTemplate;
use Respinar\GlossaryBundle\Model\GlossaryModel;
use Respinar\GlossaryBundle\Model\GlossaryTermModel;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

#[AsFrontendModule(category: "miscellaneous")]
class GlossaryController extends AbstractFrontendModuleController
{
    public const TYPE = 'glossary';

    protected function getResponse(Template $template, ModuleModel $model, Request $request): Response
    {


        // Determine sorting
		$t = GlossaryTermModel::getTable();
		$arrOptions = array();

		switch ($model->glossary_term_order)
		{
			case 'order_term_asc':
				$arrOptions['order'] = "$t.term";
				break;

			case 'order_term_desc':
				$arrOptions['order'] = "$t.term DESC";
				break;

			default:
				$arrOptions['order'] = "$t.term";
		}

        $objTerms = GlossaryTermModel::findBy('pid', $model->glossary, $arrOptions);

        $arrElements = array();

        foreach($objTerms as $objTerm) {            
 
            $arrElements[] = $this::parseTerm($objTerm, $model);
        }

        $template->arrElements = $arrElements;

        return $template->getResponse();
    }


    static public function parseTerm ($objTerm, $model)
    {
        $objTemplate = new FrontendTemplate($model->glossary_term_template);

		$objTemplate->setData($objTerm->row());
        

        $objTemplate->link = $objTerm->url;

        

        if ($objTerm->imgSRC)
        {
            //$imgSize = $objArticle->size ?: null;

			// Override the default image size
			if ($model->imgSize)
			{
				$size = StringUtil::deserialize($model->imgSize);

				if ($size[0] > 0 || $size[1] > 0 || is_numeric($size[2]) || ($size[2][0] ?? null) === '_')
				{
					$imgSize = $model->imgSize;
				}
			}

            $figureBuilder = System::getContainer()
                ->get('contao.image.studio')
                ->createFigureBuilder()
                ->setSize($imgSize)
                ->from($objTerm->imgSRC);
            $figure = $figureBuilder->build();
        }

        if (null !== $figure)
		{
			$figure->applyLegacyTemplateData($objTemplate);
		}

        return $objTemplate->parse();
    }
}
