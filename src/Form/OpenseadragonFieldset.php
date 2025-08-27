<?php

namespace PageBlockOpenseadragon\Form;

use Laminas\Form\Element;
use Laminas\Form\Fieldset;

class OpenseadragonFieldset extends Fieldset
{
    public function init()
    {
        $this
            ->add([
                'name' => 'o:block[__blockIndex__][o:data][template]',
                'type' => Element\Select::class,
                'options' => [
                    'label' => 'Template', // @translate
                    'info' => 'Choose between a full-width image (default) and image alongside title/text.', // @translate
                    'value_options' => [
                        '' => 'Default',
                        'common/block-layout/openseadragon' => 'Full width',
                        'common/block-layout/openseadragon-image-alongside-text' => 'Image alongside text',
                    ],
                ],
            ])
            ->add([
                'name' => 'o:block[__blockIndex__][o:data][tilesource]',
                'type' => Element\Url::class,
                'options' => [
                    'label' => 'IIIF Image location', // @translate
                    'info' => 'Paste a IIIF image location here, ensuring this address ends with /info.json', // @translate
                ],
                'attributes' => [
                    'id' => 'tilesource',
                    'pattern' => 'https?://.+',
                    'placeholder' => "https://luna.manchester.ac.uk/luna/servlet/iiif/Manchester~91~1~448202~299584/info.json",
                ],
            ])
            ->add([
                'name' => 'o:block[__blockIndex__][o:data][title]',
                'type' => Element\Text::class,
                'options' => [
                    'label' => 'Title', // @translate
                    'info' => 'The Title of the page, this text will be displayed over the image', // @translate
                ],
                'attributes' => [
                    'id' => 'title',
                    'size' => 10,
                    'maxlength' => 100,
                ],
            ])
            ->add([
                'name' => 'o:block[__blockIndex__][o:data][subtitle]',
                'type' => Element\Text::class,
                'options' => [
                    'label' => 'Subtitle', // @translate
                    'info' => 'The subtitle (if any) to be displayed under the main image.', // @translate
                ],
                'attributes' => [
                    'id' => 'subtitle',
                    'size' => 10,
                    'maxlength' => 100,
                ],
            ])
            ->add([
                'name' => 'o:block[__blockIndex__][o:data][zoom1]',
                'type' => Element\Text::class,
                'options' => [
                    'label' => 'Zoom level for mobile devices', // @translate
                    'info' => 'Screens under 601px. Recommended value between 1 and 5', // @translate
                ],
                'attributes' => [
                    'id' => 'zoom1',
                    'pattern' => '^\d+(\.\d{1,4})?$',
                    'placeholder' => "2.3",
                ],
            ])
            ->add([
                'name' => 'o:block[__blockIndex__][o:data][zoom2]',
                'type' => Element\Text::class,
                'options' => [
                    'label' => 'Zoom level for small screens', // @translate
                    'info' => 'Screens between 601px and 899px. Recommended value between 1 and 3', // @translate
                ],
                'attributes' => [
                    'id' => 'zoom2',
                    'size' => 10,
                    'maxlength' => 10,
                    'pattern' => '^\d+(\.\d{1,4})?$',
                    'placeholder' => "2",
                ],
            ])
            ->add([
                'name' => 'o:block[__blockIndex__][o:data][zoom3]',
                'type' => Element\Text::class,
                'options' => [
                    'label' => 'Zoom level for medium screens', // @translate
                    'info' => 'Screens between 900px and 1199px. Recommended value between 1 and 2.5', // @translate
                ],
                'attributes' => [
                    'id' => 'zoom3',
                    'size' => 10,
                    'maxlength' => 10,
                    'pattern' => '^\d+(\.\d{1,4})?$',
                    'placeholder' => "1.8",
                ],
            ])
            ->add([
                'name' => 'o:block[__blockIndex__][o:data][zoom4]',
                'type' => Element\Text::class,
                'options' => [
                    'label' => 'Zoom level for large screens.', // @translate
                    'info' => 'Screens over 1200px. Recommended value between 1 and 2.', // @translate
                ],
                'attributes' => [
                    'id' => 'zoom4',
                    'size' => 10,
                    'maxlength' => 10,
                    'pattern' => '^\d+(\.\d{1,4})?$',
                    'placeholder' => "1.4",
                ],
            ])
            ->add([
                'name' => 'o:block[__blockIndex__][o:data][positionx]',
                'type' => Element\Text::class,
                'options' => [
                    'label' => 'Position x', // @translate
                    'info' => 'The x coordinate to orientate the display. Recommended value 0.5', // @translate
                ],
                'attributes' => [
                    'id' => 'positionx',
                    'size' => 10,
                    'maxlength' => 10,
                    'pattern' => '^\d+(\.\d{1,4})?$',
                    'placeholder' => '0.5',
                ],
            ])
            ->add([
                'name' => 'o:block[__blockIndex__][o:data][positiony]',
                'type' => Element\Text::class,
                'options' => [
                    'label' => 'Position y', // @translate
                    'info' => 'The y coordinate to orientate the display. Recommended value 0.5', // @translate
                ],
                'attributes' => [
                    'id' => 'positiony',
                    'size' => 10,
                    'maxlength' => 10,
                    'pattern' => '^\d+(\.\d{1,4})?$',
                    'placeholder' => '0.5',
                ],
            ])
            ->add([
                'name' => 'o:block[__blockIndex__][o:data][alttext]',
                'type' => Element\Text::class,
                'options' => [
                    'label' => 'Alternative text description', // @translate
                    'info' => 'Add descriptive text for the IIIF image.', // @translate
                ],
                'attributes' => [
                    'id' => 'alttext',
                    'size' => 10,
                    'maxlength' => 255,
                    'placeholder' => 'e.g., A group of students examining a map'
                ],
            ])
        ;
    }
}
