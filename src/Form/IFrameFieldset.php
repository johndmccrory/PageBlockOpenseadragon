<?php
namespace PageBlockIframe\Form;

use Laminas\Form\Element;
use Laminas\Form\Fieldset;

class IFrameFieldset extends Fieldset
{
    public function init()
    {
        $this
            ->add([
                'name' => 'o:block[__blockIndex__][o:data][src]',
                'type' => Element\Url::class,
                'options' => [
                    'label' => 'URL', // @translate
                ],
                'attributes' => [
                    'id' => 'iframe-src',
                    'pattern' => 'https?://.+'
                ],
            ])
            ->add([
                'name' => 'o:block[__blockIndex__][o:data][width]',
                'type' => Element\Text::class,
                'options' => [
                    'label' => 'Width', // @translate
                    'info' => 'The width of the container in percentage (e.g., 100%) or in pixels (e.g., 600).', // @translate
                ],
                'attributes' => [
                    'id' => 'iframe-width',
                    'size' => 10,
                    'maxlength' => 10,
                    'pattern' => '[0-9]+%?'
                ],
            ])
            ->add([
                'name' => 'o:block[__blockIndex__][o:data][height]',
                'type' => Element\Text::class,
                'options' => [
                    'label' => 'Height', // @translate
                    'info' => 'The height of the container in percentage (e.g., 100%) or in pixels (e.g., 600).', // @translate
                ],
                'attributes' => [
                    'id' => 'iframe-height',
                    'size' => 10,
                    'maxlength' => 10,
                    'pattern' => '[0-9]+%?'
                ],
            ])
        ;
    }
}
