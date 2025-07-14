<?php

namespace PageBlockOpenseadragon;

return [
    'block_layouts' => [
        'invokables' => [
            'Openseadragon' => Site\BlockLayout\Openseadragon::class
        ],
    ],
    'form_elements' => [
        'invokables' => [
            Form\OpenseadragonFieldset::class => Form\OpenseadragonFieldset::class,
        ],
    ],
];
