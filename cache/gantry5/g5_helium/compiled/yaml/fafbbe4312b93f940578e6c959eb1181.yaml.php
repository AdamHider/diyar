<?php
return [
    '@class' => 'Gantry\\Component\\File\\CompiledYamlFile',
    'filename' => 'W:/iSell/www/diyar/templates/g5_helium/custom/config/14/layout.yaml',
    'modified' => 1584945590,
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
                    0 => 'system-messages-1962'
                ],
                1 => [
                    0 => 'logo-5571 20',
                    1 => 'menu-6097 80'
                ]
            ],
            '/header/' => [
                0 => [
                    0 => 'custom-7115'
                ],
                1 => [
                    0 => 'owlcarousel-8554'
                ],
                2 => [
                    0 => 'custom-6963'
                ],
                3 => [
                    0 => 'position-module-5365'
                ]
            ],
            '/intro/' => [
                0 => [
                    0 => 'custom-7643'
                ]
            ],
            '/features/' => [
                0 => [
                    0 => 'custom-8640'
                ],
                1 => [
                    0 => 'logo-4015'
                ],
                2 => [
                    0 => 'position-module-3433'
                ]
            ],
            'utility' => [
                
            ],
            'above' => [
                
            ],
            '/testimonials/' => [
                0 => [
                    0 => 'custom-3267'
                ]
            ],
            'expanded' => [
                
            ],
            '/container-main/' => [
                0 => [
                    0 => [
                        'aside 25' => [
                            
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
                    0 => 'custom-2297'
                ],
                1 => [
                    0 => 'custom-7183 30',
                    1 => 'spacer-5222 5',
                    2 => 'custom-3360 30',
                    3 => 'spacer-4416 5',
                    4 => 'custom-7504 30'
                ],
                2 => [
                    0 => 'custom-3748'
                ]
            ],
            'offcanvas' => [
                0 => [
                    0 => 'logo-2999'
                ],
                1 => [
                    0 => 'mobile-menu-7896'
                ]
            ]
        ],
        'structure' => [
            'navigation' => [
                'type' => 'section',
                'attributes' => [
                    'boxed' => '',
                    'class' => 'diyar-main-navigation home-navigation',
                    'variations' => ''
                ]
            ],
            'header' => [
                'attributes' => [
                    'boxed' => '',
                    'class' => 'background-image-section home-header parallax-background',
                    'variations' => ''
                ]
            ],
            'intro' => [
                'type' => 'section',
                'attributes' => [
                    'boxed' => '0',
                    'class' => 'about-us-home',
                    'variations' => ''
                ]
            ],
            'features' => [
                'type' => 'section',
                'attributes' => [
                    'boxed' => '',
                    'class' => 'lugat-container home-lugat-searchbar',
                    'variations' => 'nomarginall nopaddingall'
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
                'attributes' => [
                    'boxed' => '2',
                    'class' => '',
                    'variations' => ''
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
                'inherit' => [
                    'outline' => '9',
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
                'attributes' => [
                    'position' => 'g-offcanvas-left',
                    'class' => '',
                    'extra' => [
                        
                    ],
                    'swipe' => '1',
                    'css3animation' => '1'
                ]
            ]
        ],
        'content' => [
            'system-messages-1962' => [
                'inherit' => [
                    'outline' => 'default',
                    'include' => [
                        0 => 'attributes',
                        1 => 'block'
                    ],
                    'particle' => 'system-messages-4409'
                ]
            ],
            'logo-5571' => [
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
            'menu-6097' => [
                'attributes' => [
                    'menu' => 'enter-russianmenu',
                    'mobileTarget' => '1',
                    'forceTarget' => '1'
                ],
                'block' => [
                    'class' => 'home-menu'
                ]
            ],
            'custom-7115' => [
                'title' => 'Header Greetings',
                'attributes' => [
                    'html' => '<div class="benefit-content  header-text revealOnScroll" data-animation="fadeIn" data-timeout="100">
        <h1>Добро пожаловать!</h1>




</div>'
                ],
                'block' => [
                    'class' => 'header-info-block'
                ]
            ],
            'owlcarousel-8554' => [
                'title' => 'Header Carousel',
                'attributes' => [
                    'enabled' => 0,
                    'class' => 'home-header-image',
                    'items' => [
                        0 => [
                            'class' => '',
                            'image' => 'gantry-media://headers/1598836_original.jpg',
                            'title' => '',
                            'desc' => '',
                            'link' => '',
                            'linktext' => '',
                            'buttonclass' => 'button-outline',
                            'disable' => '0',
                            'name' => 'Image1'
                        ]
                    ]
                ]
            ],
            'custom-6963' => [
                'title' => 'Header Icons',
                'attributes' => [
                    'html' => '<div class="head-icon-container">
<img class="tamga-icon" src="/images/icons/Tamga_Vector_Icon.png"/>
<img class="arrow-icon" src="/images/icons/Tamga_Vector_Icon_Arrow.png"/>
</div>'
                ],
                'block' => [
                    'class' => 'head-icon-block'
                ]
            ],
            'position-module-5365' => [
                'title' => 'Complex Header',
                'attributes' => [
                    'module_id' => '108',
                    'key' => 'complex-header'
                ],
                'block' => [
                    'class' => 'complex-header',
                    'variations' => 'nomarginall nopaddingall'
                ]
            ],
            'custom-7643' => [
                'title' => 'About Us',
                'attributes' => [
                    'html' => '<div class="main-text">Diyar - это современный крымскотатарский веб-сайт, посвященный языку, истории и культуре крымских татар. </div>
<div class="additional-text"> Здесь мы собираем по крупицам всё, что касается крымскотатарского народа: от учебников и словарей - до исторических летописей и автобиографий. </br> Если Вы имеете возможность пополнить нашу коллекцию своими материалами, обращайтесь <a href="/index.php/ru/свяжитесь_с_нами">сюда</a>. Любой Ваш вклад очень ценен для нас.
</div>
<a  href="/index.php/ru/прочее/о_нас"  class="button button-white">Подробнее</a>'
                ],
                'block' => [
                    'class' => 'about-us-block'
                ]
            ],
            'custom-8640' => [
                'title' => 'Features',
                'inherit' => [
                    'outline' => 'default',
                    'include' => [
                        0 => 'attributes',
                        1 => 'block'
                    ],
                    'particle' => 'custom-3119'
                ]
            ],
            'logo-4015' => [
                'title' => 'Logo / Image',
                'attributes' => [
                    'image' => 'gantry-media://headers/Lugat_Image1.png',
                    'link' => '0',
                    'svg' => '',
                    'class' => 'lugat-searchbar-image'
                ],
                'block' => [
                    'class' => 'lugat-searchbar-image-block',
                    'variations' => 'nomarginall nopaddingall',
                    'fixed' => '1'
                ]
            ],
            'position-module-3433' => [
                'title' => 'Module Instance',
                'inherit' => [
                    'outline' => 'default',
                    'include' => [
                        0 => 'attributes',
                        1 => 'block'
                    ],
                    'particle' => 'position-module-2306'
                ]
            ],
            'custom-3267' => [
                'title' => 'Join Us',
                'attributes' => [
                    'html' => '<div class="main">
<div class="image-container">
<img class="layer-background" src="/images/headers/join_us/Diyar_Join_Us_Back1.jpg"/>
<img class="layer-base" src="/images/headers/join_us/Diyar_Join_Us_layer_base.png"/>
<img class="layer-1" src="/images/headers/join_us/Diyar_Join_Us_layer1.png"/>
<img class="layer-2" src="/images/headers/join_us/Diyar_Join_Us_layer2.png"/>
<img class="layer-3" src="/images/headers/join_us/Diyar_Join_Us_layer3.png"/>
<img class="layer-4" src="/images/headers/join_us/Diyar_Join_Us_layer4.png"/>
<img class="layer-db1" src="/images/headers/join_us/Diyar_Join_Us_db_1.png"/>
<img class="layer-db2" src="/images/headers/join_us/Diyar_Join_Us_db_2.png"/>
<div class="text">
<h1>Присоединяйся к нам!</h1>
<p>Наш проект постоянно развивается, поэтому нам пригодится Ваша помощь.</p>
</div>

</div>
<div class="animation-trigger"></div>
</div>'
                ],
                'block' => [
                    'class' => 'join-us-block'
                ]
            ],
            'custom-2297' => [
                'title' => 'Social',
                'attributes' => [
                    'html' => ''
                ]
            ],
            'custom-7183' => [
                'title' => 'Logo And Descrıptıon',
                'attributes' => [
                    'html' => '<a href="/" target="_self"  rel="home" class="g-logo g-logo-helium">
                        <img src="/images/logos/diyar_logo_footer.png" >
            </a>
<div class="logo-text">
<p>Мы команда простых инициативных людей, главная цель которых - сделать информацию о крымских татарах доступной для каждого в интернете. Наша деятельность ни в коем случае не преследует коммерческих интересов.
</p>
</div>'
                ]
            ],
            'custom-3360' => [
                'title' => 'Footer Menu',
                'attributes' => [
                    'html' => '<div class="footer-menu">
    <h4>Сайт</h4>
    <div class="list-block">
        
          
        <a class="collapsed menu-item" data-toggle="collapse" href="#collapseLanguage" role="button" aria-expanded="false" aria-controls="collapseLanguage">
          Язык
        <i class="fa fa-chevron-right"></i></a>
        <div class="collapse" id="collapseLanguage">
            <div class="card card-body">
              <ul>
                <li>
                    <a href="https://diyar.im/index.php/ru/язык/словарь">Словарь</a>
                </li>
                <li>
                    <a href="https://diyar.im/index.php/ru/язык/образование/грамматика">Грамматика</a>
                </li>
                <li>
                    <a href="https://diyar.im/index.php/ru/язык/образование/произношение">Произношение</a>
                </li>
                <li>
                    <a href="https://diyar.im/index.php/ru/язык/образование/лексика">Лексика</a>
                </li>
            </ul>
            </div>
        </div>
        
    </div>
    <div class="list-block">
        <a class="collapsed menu-item" data-toggle="collapse" href="#collapseHistory" role="button" aria-expanded="false" aria-controls="collapseHistory">
            История
        <i class="fa fa-chevron-right"></i></a>
        <div class="collapse" id="collapseHistory">
            <div class="card card-body">
                <ul>
                    <li>
                        <a href="https://diyar.im/index.php/ru/история/древние_тюрки">Древние Тюрки</a>
                    </li>
                    <li>
                        <a href="https://diyar.im/index.php/ru/история/золотая_орда">Золотая Орда</a>
                    </li>
                    <li>
                        <a href="https://diyar.im/index.php/ru/история/крымское_ханство">Крымское Ханство</a>
                    </li>
                    <li>
                        <a href="https://diyar.im/index.php/ru/история/послеханский_период">Послеханский Период</a>
                    </li>
                    <li>
                        <a href="https://diyar.im/index.php/ru/история/советский_период">Советский период</a>
                    </li>
                    <li>
                        <a href="https://diyar.im/index.php/ru/история/xxi_век">XXI Век</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <div class="list-block">
        <a class="collapsed menu-item" data-toggle="collapse" href="#collapseCulture" role="button" aria-expanded="false" aria-controls="collapseCulture">
            Культура
        <i class="fa fa-chevron-right"></i></a>
        <div class="collapse" id="collapseCulture">
            <div class="card card-body">
                <ul>
                    <li>
                        <a href="https://diyar.im/index.php/ru/культура/традиции">Традиции</a>
                    </li>
                    <li>
                        <a href="https://diyar.im/index.php/ru/культура/быт">Быт</a>
                    </li>
                    <li>
                        <a href="https://diyar.im/index.php/ru/культура/музыка">Музыка</a>
                    </li>
                    <li>
                        <a href="https://diyar.im/index.php/ru/культура/литература">Литература</a>
                    </li>
                    <li>
                        <a href="https://diyar.im/index.php/ru/культура/живопись">Живопись</a>
                    </li>
                    <li>
                        <a href="https://diyar.im/index.php/ru/культура/религия">Религия</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <div class="list-block">
        <a class="collapsed menu-item" data-toggle="collapse" href="#collapseBooks" role="button" aria-expanded="false" aria-controls="collapseBooks">
            Книги
        <i class="fa fa-chevron-right"></i></a>
        <div class="collapse" id="collapseBooks">
            <div class="card card-body">
                <ul>
                    <li>
                        <a href="https://diyar.im/index.php/ru/книги/учебная_литература">Учебная литература</a>
                    </li>
                    <li>
                        <a href="https://diyar.im/index.php/ru/книги/историческая_литература">Историческая литература</a>
                    </li>
                    <li>
                        <a href="https://diyar.im/index.php/ru/книги/книги_о_культуре">Книги о культуре</a>
                    </li>
                    <li>
                        <a href="https://diyar.im/index.php/ru/книги/детская_литература">Детская литература</a>
                    </li>
                    <li>
                        <a href="https://diyar.im/index.php/ru/книги/художественная_литература">Художественная Литература</a>
                    </li>
                    <li>
                        <a href="https://diyar.im/index.php/ru/книги/биографии">Биографии</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <div class="list-block">
        <a class="collapsed menu-item" data-toggle="collapse" href="#collapseOther" role="button" aria-expanded="false" aria-controls="collapseOther">
            Прочее
        <i class="fa fa-chevron-right"></i></a>
        <div class="collapse" id="collapseOther">
            <div class="card card-body">
                <ul>
                    <li>
                        <a href="https://diyar.im/index.php/ru/прочее/обсуждения">Обсуждения</a>
                    </li>
                    <li>
                        <a href="https://diyar.im/index.php/ru/прочее/загрузки">Загрузки</a>
                    </li>
                    <li>
                        <a href="https://diyar.im/index.php/ru/прочее/галерея">Галерея</a>
                    </li>
                    <li>
                        <a href="https://diyar.im/index.php/ru/прочее/партнеры">Партнеры</a>
                    </li>
                    <li>
                        <a href="https://diyar.im/index.php/ru/прочее/о_нас">О нас</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>'
                ],
                'block' => [
                    'class' => 'menu-block'
                ]
            ],
            'custom-7504' => [
                'title' => 'Contact',
                'attributes' => [
                    'html' => '<div class="footer-contact">
    <h4>Обратная связь</h4>
    <div class="content">
<p>Если у вас есть какие-либо вопросы или предложения по поводу сайта, вы всегда можете сообщить нам об этом, написав нам. </p>
<div>
<b>Email:</b> <a href="/index.php/ru/свяжитесь_с_нами">info@diyar.im</a> 
</div>
<p>Мы всегда рады узнать ваше мнение.</p>
</div>
</div>'
                ]
            ],
            'custom-3748' => [
                'title' => 'Copyright and Policies',
                'attributes' => [
                    'html' => '<p>
2019 © Все права защищены 
<a href="/index.php/ru/пользовательское_соглашение">Пользовательское соглашение</a>
|
<a href="/index.php/ru/политика_конфиденциальности">Политика конфеденциальности</a>

</p>'
                ],
                'block' => [
                    'class' => 'policies-block'
                ]
            ],
            'logo-2999' => [
                'title' => 'Logo / Image',
                'inherit' => [
                    'outline' => 'default',
                    'include' => [
                        0 => 'attributes',
                        1 => 'block'
                    ],
                    'particle' => 'logo-9504'
                ]
            ]
        ]
    ]
];
