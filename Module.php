<?php

namespace PageBlockOpenseadragon;

use Omeka\Module\AbstractModule;

class Module extends AbstractModule
{
    public function getConfig()
    {
        return array_merge_recursive(
            include __DIR__ . '/config/module.config.php',
            [
                'view_manager' => [
                    'template_path_stack' => [
                        __DIR__ . '/view',
                    ],
                ],
            ]
        );
    }
    public function getServiceConfig()
    {
    return [
        'factories' => [
            \PageBlockOpenseadragon\Form\OpenseadragonFieldset::class => function ($formElementManager) {
                $fieldset = new \PageBlockOpenseadragon\Form\OpenseadragonFieldset();
                $fieldset->setName('openseadragon');
                return $fieldset;
            },
        ],
    ];
}
}
