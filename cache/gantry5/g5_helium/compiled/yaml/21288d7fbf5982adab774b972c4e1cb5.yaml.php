<?php
return [
    '@class' => 'Gantry\\Component\\File\\CompiledYamlFile',
    'filename' => 'W:/iSell/www/diyar/templates/g5_helium/blueprints/styles/accent.yaml',
    'modified' => 1584945590,
    'data' => [
        'name' => 'Accent Colors',
        'description' => 'Accent colors for the Helium theme',
        'type' => 'core',
        'form' => [
            'fields' => [
                'color-1' => [
                    'type' => 'input.colorpicker',
                    'label' => 'Accent Color 1',
                    'default' => '#4db2b3'
                ],
                'color-2' => [
                    'type' => 'input.colorpicker',
                    'label' => 'Accent Color 2',
                    'default' => '#8f4dae'
                ]
            ]
        ]
    ]
];
