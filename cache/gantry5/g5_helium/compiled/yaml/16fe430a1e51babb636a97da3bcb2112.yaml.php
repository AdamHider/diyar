<?php
return [
    '@class' => 'Gantry\\Component\\File\\CompiledYamlFile',
    'filename' => 'W:/Isell/www/diyar/templates/g5_helium/custom/config/9/layout.yaml',
    'modified' => 1568406040,
    'data' => [
        'version' => 2,
        'preset' => [
            'image' => 'gantry-admin://images/layouts/default.png',
            'name' => 'default',
            'timestamp' => 1563522857
        ],
        'layout' => [
            '/navigation/' => [
                0 => [
                    0 => 'system-messages-8776'
                ],
                1 => [
                    0 => 'logo-9531 25',
                    1 => 'menu-4597 36',
                    2 => 'social-6902 15',
                    3 => 'position-module-5240 24'
                ]
            ],
            '/header/' => [
                0 => [
                    0 => 'custom-7115'
                ]
            ],
            'intro' => [
                
            ],
            'features' => [
                
            ],
            'utility' => [
                
            ],
            'above' => [
                
            ],
            'testimonials' => [
                
            ],
            'expanded' => [
                
            ],
            '/container-main/' => [
                0 => [
                    0 => [
                        'aside 25' => [
                            0 => [
                                0 => 'position-position-4734'
                            ]
                        ]
                    ],
                    1 => [
                        'mainbar 50' => [
                            
                        ]
                    ],
                    2 => [
                        'sidebar 25' => [
                            
                        ]
                    ]
                ]
            ],
            '/footer/' => [
                0 => [
                    0 => 'logo-1144 16',
                    1 => 'custom-3748 37',
                    2 => 'horizontalmenu-5487 29',
                    3 => 'totop-3746 18'
                ]
            ],
            'offcanvas' => [
                
            ]
        ],
        'structure' => [
            'navigation' => [
                'type' => 'section',
                'attributes' => [
                    'boxed' => '',
                    'class' => '',
                    'variations' => ''
                ]
            ],
            'header' => [
                'attributes' => [
                    'boxed' => '',
                    'class' => '',
                    'variations' => ''
                ]
            ],
            'intro' => [
                'type' => 'section',
                'inherit' => [
                    'outline' => 'default',
                    'include' => [
                        0 => 'attributes',
                        1 => 'block',
                        2 => 'children'
                    ]
                ]
            ],
            'features' => [
                'type' => 'section',
                'inherit' => [
                    'outline' => 'default',
                    'include' => [
                        0 => 'attributes',
                        1 => 'block',
                        2 => 'children'
                    ]
                ]
            ],
            'utility' => [
                'type' => 'section',
                'inherit' => [
                    'outline' => 'default',
                    'include' => [
                        0 => 'attributes',
                        1 => 'block',
                        2 => 'children'
                    ]
                ]
            ],
            'above' => [
                'type' => 'section',
                'inherit' => [
                    'outline' => 'default',
                    'include' => [
                        0 => 'attributes',
                        1 => 'block',
                        2 => 'children'
                    ]
                ]
            ],
            'testimonials' => [
                'type' => 'section',
                'inherit' => [
                    'outline' => 'default',
                    'include' => [
                        0 => 'attributes',
                        1 => 'block',
                        2 => 'children'
                    ]
                ]
            ],
            'expanded' => [
                'type' => 'section',
                'inherit' => [
                    'outline' => 'default',
                    'include' => [
                        0 => 'attributes',
                        1 => 'block',
                        2 => 'children'
                    ]
                ]
            ],
            'aside' => [
                'attributes' => [
                    'class' => ''
                ],
                'block' => [
                    'fixed' => '1'
                ]
            ],
            'mainbar' => [
                'type' => 'section',
                'subtype' => 'main',
                'inherit' => [
                    'outline' => 'default',
                    'include' => [
                        0 => 'attributes',
                        1 => 'block',
                        2 => 'children'
                    ]
                ]
            ],
            'sidebar' => [
                'type' => 'section',
                'subtype' => 'aside',
                'inherit' => [
                    'outline' => 'default',
                    'include' => [
                        0 => 'attributes',
                        1 => 'block',
                        2 => 'children'
                    ]
                ],
                'block' => [
                    'fixed' => '1'
                ]
            ],
            'container-main' => [
                'attributes' => [
                    'boxed' => ''
                ]
            ],
            'footer' => [
                'attributes' => [
                    'boxed' => '',
                    'class' => '',
                    'variations' => ''
                ]
            ],
            'offcanvas' => [
                'inherit' => [
                    'outline' => 'default',
                    'include' => [
                        0 => 'attributes',
                        1 => 'block',
                        2 => 'children'
                    ]
                ]
            ]
        ],
        'content' => [
            'system-messages-8776' => [
                'inherit' => [
                    'outline' => 'default',
                    'include' => [
                        0 => 'attributes',
                        1 => 'block'
                    ],
                    'particle' => 'system-messages-4409'
                ]
            ],
            'logo-9531' => [
                'title' => 'Logo / Image',
                'inherit' => [
                    'outline' => 'default',
                    'include' => [
                        0 => 'attributes',
                        1 => 'block'
                    ],
                    'particle' => 'logo-8554'
                ]
            ],
            'menu-4597' => [
                'attributes' => [
                    'menu' => 'enter-englismenu'
                ]
            ],
            'social-6902' => [
                'inherit' => [
                    'outline' => 'default',
                    'include' => [
                        0 => 'attributes',
                        1 => 'block'
                    ],
                    'particle' => 'social-5236'
                ]
            ],
            'position-module-5240' => [
                'title' => 'Module Instance',
                'inherit' => [
                    'outline' => 'default',
                    'include' => [
                        0 => 'attributes',
                        1 => 'block'
                    ],
                    'particle' => 'position-module-5422'
                ]
            ],
            'custom-7115' => [
                'title' => 'Custom HTML',
                'attributes' => [
                    'html' => '<div class="benefit-content revealOnScroll" data-animation="fadeIn" data-timeout="100">
        <h1>Configure anything and everything</h1>
<p>When we started the Gantry 5 project, we wanted to think past the concept of Gantry as a framework.</p>
<p>We wanted to create something so <strong>versatile</strong> and <strong>powerful</strong>, that it could stand on its own as a platform, virtually independent of a CMS in concept and implementation.</p>
</div>'
                ]
            ],
            'position-position-4734' => [
                'title' => 'Aside',
                'attributes' => [
                    'key' => 'aside'
                ]
            ],
            'logo-1144' => [
                'title' => 'Logo / Image',
                'inherit' => [
                    'outline' => 'default',
                    'particle' => 'logo-7150',
                    'include' => [
                        0 => 'attributes',
                        1 => 'block'
                    ]
                ]
            ],
            'custom-3748' => [
                'title' => 'Custom HTML',
                'attributes' => [
                    'html' => '<p>Developed by Adam Hider and Diyar Team</p>'
                ]
            ],
            'horizontalmenu-5487' => [
                'title' => 'Horizontal Menu',
                'attributes' => [
                    'items' => [
                        0 => [
                            'text' => 'Dictionary',
                            'link' => 'http://localhost:888/joomla/index.php/dictionary',
                            'name' => 'Dictionary'
                        ]
                    ]
                ]
            ],
            'totop-3746' => [
                'title' => 'To Top'
            ]
        ]
    ]
];
