<?php
namespace PageBlockIframe;

return [
    'block_layouts' => [
        'invokables' => [
            'iFrame' => Site\BlockLayout\IFrame::class
        ],
    ],
    'form_elements' => [
        'invokables' => [
            Form\IFrameFieldset::class => Form\IFrameFieldset::class,
        ],
    ],
];
