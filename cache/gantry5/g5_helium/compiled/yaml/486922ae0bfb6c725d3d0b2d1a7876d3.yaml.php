<?php
return [
    '@class' => 'Gantry\\Component\\File\\CompiledYamlFile',
    'filename' => 'W:\\iSell\\www\\diyar/templates/g5_helium/particles/example_particle.yaml',
    'modified' => 1584945590,
    'data' => [
        'name' => 'Example',
        'description' => 'Displays a Title, Image, and Text on the front end.',
        'type' => 'particle',
        'form' => [
            'fields' => [
                'enabled' => [
                    'type' => 'input.checkbox',
                    'label' => 'Enabled',
                    'description' => 'Globally enable to the particles.',
                    'default' => true
                ],
                'title' => [
                    'type' => 'input.text',
                    'label' => 'Title',
                    'description' => 'Customize the section title text.'
                ],
                'image' => [
                    'type' => 'input.imagepicker',
                    'label' => 'Image',
                    'description' => 'Select the main image.'
                ],
                'description' => [
                    'type' => 'textarea.textarea',
                    'label' => 'Text / HTML',
                    'description' => 'Create or modify your description.'
                ],
                'css.class' => [
                    'type' => 'input.text',
                    'label' => 'Class',
                    'description' => 'CSS class name for the particle.'
                ]
            ]
        ]
    ]
];
