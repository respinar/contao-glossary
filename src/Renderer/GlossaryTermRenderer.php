<?php

declare(strict_types=1);

/*
 * This file is part of Contao Simple Glossary.
 *
 * (c) Hamid Peywasti
 *
 * @license MIT
 */

namespace Respinar\GlossaryBundle\Renderer;

use Contao\ContentModel;
use Contao\CoreBundle\Image\Studio\Studio;
use Contao\FrontendTemplate;
use Contao\Model\Collection;
use Contao\StringUtil;
use Respinar\GlossaryBundle\Model\GlossaryTermModel;

final class GlossaryTermRenderer
{
    public function __construct(private readonly Studio $studio)
    {
    }

    /**
     * @return array<string>
     */
    public function render(Collection|null $terms, ContentModel $contentModel): array
    {
        if (!$terms instanceof Collection) {
            return [];
        }

        $elements = [];

        foreach ($terms as $term) {
            if (!$term instanceof GlossaryTermModel) {
                continue;
            }

            $elements[] = $this->renderTerm($term, $contentModel);
        }

        return $elements;
    }

    private function renderTerm(GlossaryTermModel $term, ContentModel $contentModel): string
    {
        $template = new FrontendTemplate($contentModel->glossary_term_template);

        $template->setData($term->row());

        $template->moreDetail = $GLOBALS['TL_LANG']['MSC']['moreDetail'] ?? 'More Details';

        $figure = null;

        if ($term->imgSRC) {
            $imgSize = $contentModel->size ?: null;

            if ($contentModel->size) {
                $size = StringUtil::deserialize($contentModel->size);

                if (
                    ($size[0] > 0)
                    || ($size[1] > 0)
                    || is_numeric($size[2])
                    || (($size[2][0] ?? null) === '_')
                ) {
                    $imgSize = $contentModel->size;
                }
            }

            $figure = $this->studio
                ->createFigureBuilder()
                ->setSize($imgSize)
                ->from($term->imgSRC)
                ->build()
            ;
        }

        $template->figure = $figure;

        return $template->parse();
    }
}
