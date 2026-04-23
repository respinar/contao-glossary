<?php

declare(strict_types=1);

/*
 * This file is part of Contao Simple Glossary.
 *
 * (c) Hamid Peywasti
 *
 * @license MIT
 */

namespace Respinar\GlossaryBundle\Controller\ContentElement;

use Contao\ContentModel;
use Contao\CoreBundle\Controller\ContentElement\AbstractContentElementController;
use Contao\CoreBundle\DependencyInjection\Attribute\AsContentElement;
use Contao\CoreBundle\Twig\FragmentTemplate;
use Respinar\GlossaryBundle\Model\GlossaryTermModel;
use Respinar\GlossaryBundle\Renderer\GlossaryTermRenderer;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

#[AsContentElement(type: GlossaryController::TYPE, category: 'miscellaneous')]
final class GlossaryController extends AbstractContentElementController
{
    public const string TYPE = 'glossary';

    public function __construct(private readonly GlossaryTermRenderer $renderer)
    {
    }

    protected function getResponse(FragmentTemplate $template, ContentModel $model, Request $request): Response
    {
        $t = GlossaryTermModel::getTable();

        $arrOptions = match ($model->glossary_term_order) {
            'order_term_desc' => [
                'order' => "$t.term DESC",
            ],
            default => [
                'order' => "$t.term",
            ],
        };

        $objTerms = GlossaryTermModel::findBy(
            'pid',
            $model->glossary,
            $arrOptions,
        );

        $template->set(
            'arrElements',
            $this->renderer->render($objTerms, $model),
        );

        return $template->getResponse();
    }
}
