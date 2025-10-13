<?php

namespace PageBlockOpenseadragon\Site\BlockLayout;

use Omeka\Api\Representation\SiteRepresentation;
use Omeka\Api\Representation\SitePageRepresentation;
use Omeka\Api\Representation\SitePageBlockRepresentation;
use Omeka\Entity\SitePageBlock;
use Omeka\Site\BlockLayout\AbstractBlockLayout;
use Omeka\Stdlib\ErrorStore;
use Laminas\View\Renderer\PhpRenderer;

class Openseadragon extends AbstractBlockLayout
{
    public function getLabel()
    {
        return 'Openseadragon block'; // @translate
    }

    public function form(
        PhpRenderer $view,
        SiteRepresentation $site,
        SitePageRepresentation $page = null,
        SitePageBlockRepresentation $block = null
    ) {
        // Factory is not used to make rendering simpler.
        $services = $site->getServiceLocator();
        $formElementManager = $services->get('FormElementManager');
        $blockFieldset = \PageBlockOpenseadragon\Form\OpenseadragonFieldset::class;

        // Set form values
        $data = $block ? $block->data() : [];

        $dataForm = [];
        foreach ($data as $key => $value) {
            $dataForm['o:block[__blockIndex__][o:data][' . $key . ']'] = $value;
        }

        $fieldset = $formElementManager->get($blockFieldset);
        $fieldset->populateValues($dataForm);

        return $view->formCollection($fieldset);
    }

    public function render(PhpRenderer $view, SitePageBlockRepresentation $block, $templateViewScript = null)
    {
        // Use the admin-selected block template if present,
        // else fall back to block’s own saved data,
        // else fall back to the module’s default.
        $template = $templateViewScript
            ?: $block->dataValue('template')
            ?: 'common/block-layout/openseadragon';

        return $view->partial($template, [
            'data' => $block->data(),
            'block' => $block,
        ]);
    }
}
