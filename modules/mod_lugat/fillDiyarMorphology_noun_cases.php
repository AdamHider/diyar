<?php


$noun_cases = [
    
    'nominative' => [
        'group' => 'case',
        'template' => 'noun_case',
        'hard' => [
            'sonorous' => [
                'single_syllable'=>[
                    ['']
                ],
                'multi_syllable'=>[
                    ['']
                ]
            ],
            'vowel' => [
                'single_syllable'=>[
                    ['']
                ],
                'multi_syllable'=>[
                    ['']
                ]
            ],
            'non_sonorous' => [
                'single_syllable'=>[
                    ['']
                ],
                'multi_syllable'=>[
                    ['']
                ]
            ]
        ],
        'soft' => [
            'sonorous' => [
                'single_syllable'=>[
                    ['']
                ],
                'multi_syllable'=>[
                    ['']
                ]
            ],
            'vowel' => [
                'single_syllable'=>[
                    ['']
                ],
                'multi_syllable'=>[
                    ['']
                ]
            ],
            'non_sonorous' => [
                'single_syllable'=>[
                    ['']
                ],
                'multi_syllable'=>[
                    ['']
                ]
            ]
        ]
    ],
    'nominative_possession' => [
        'group' => 'case',
        'template' => 'personilized',
        'hard' => [
            'sonorous' => [
                'single_syllable'=>[
                    ['*ım|*um', '*ıñ|*uñ', '*ı|*u' ],
                    ['ım*ız|um*ız', 'ıñ*ız|uñ*ız', 'ı|u' ]
                ],
                'multi_syllable'=>[
                    ['*ım|*um', '*ıñ|*uñ', '*ı|*u' ],
                    ['ım*ız|um*ız', 'ıñ*ız|uñ*ız', '*ı|*u' ]
                ]
            ],
            'vowel' => [
                'single_syllable'=>[
                    ['m', 'ñ', 's*ı' ],
                    ['m*ız', 'ñ*ız', 's*ı' ]
                ],
                'multi_syllable'=>[
                    ['m', 'ñ', 's*ı' ],
                    ['m*ız', 'ñ*ız', 's*ı' ]
                ]
            ],
            'non_sonorous' => [
                'single_syllable'=>[
                    ['*ım|*um', '*ıñ|*uñ', '*ı|*u' ],
                    ['ım*ız|um*ız', 'ıñ*ız|uñ*ız', '*ı|*u' ]
                ],
                'multi_syllable'=>[
                    ['*ım|*um', '*ıñ|*uñ', '*ı|*u' ],
                    ['ım*ız|um*ız', 'ıñ*ız|uñ*ız', '*ı|*u' ]
                ]
            ]
        ],
        'soft' => [
            'sonorous' => [
                'single_syllable'=>[
                    ['*im|*üm', '*iñ|*üñ', '*i|*ü' ],
                    ['im*iz|üm*iz', 'iñ*iz|üñ*iz', '*i|*ü' ]
                ],
                'multi_syllable'=>[
                    ['*im|*üm', '*iñ|*üñ', '*i|*ü' ],
                    ['im*iz|üm*iz', 'iñ*iz|üñ*iz', '*i|*ü' ]
                ]
            ],
            'vowel' => [
                'single_syllable'=>[
                    ['m', 'ñ', 's*i' ],
                    ['m*iz', 'ñ*iz', 's*i' ]
                ],
                'multi_syllable'=>[
                    ['m', 'ñ', 's*i' ],
                    ['m*iz', 'ñ*iz', 's*i' ]
                ]
            ],
            'non_sonorous' => [
                'single_syllable'=>[
                    ['*im|*üm', '*iñ|*üñ', '*i|*ü' ],
                    ['im*iz|üm*iz', 'iñ*iz|üñ*iz', '*i|*ü' ]
                ],
                'multi_syllable'=>[
                    ['*im|*üm', '*iñ|*üñ', '*i|*ü' ],
                    ['im*iz|üm*iz', 'iñ*iz|üñ*iz', '*i|*ü' ]
                ]
            ]
        ]
    ],
    'genitive' => [
        'group' => 'case',
        'template' => 'noun_case',
        'hard' => [
            'sonorous' => [
                'single_syllable'=>[
                    ['n*ıñ']
                ],
                'multi_syllable'=>[
                    ['n*ıñ']
                ]
            ],
            'vowel' => [
                'single_syllable'=>[
                    ['n*ıñ']
                ],
                'multi_syllable'=>[
                    ['n*ıñ']
                ]
            ],
            'non_sonorous' => [
                'single_syllable'=>[
                    ['n*ıñ']
                ],
                'multi_syllable'=>[
                    ['n*ıñ']
                ]
            ]
        ],
        'soft' => [
            'sonorous' => [
                'single_syllable'=>[
                    ['n*iñ']
                ],
                'multi_syllable'=>[
                    ['n*iñ']
                ]
            ],
            'vowel' => [
                'single_syllable'=>[
                    ['n*iñ']
                ],
                'multi_syllable'=>[
                    ['n*iñ']
                ]
            ],
            'non_sonorous' => [
                'single_syllable'=>[
                    ['n*iñ']
                ],
                'multi_syllable'=>[
                    ['n*iñ']
                ]
            ]
        ]
    ],
    'genitive_possession' => [
        'group' => 'case',
        'template' => 'personilized',
        'hard' => [
            'sonorous' => [
                'single_syllable'=>[
                    ['ımn*ıñ|umn*ıñ', 'ıñn*ıñ|uñn*ıñ', 'ın*ıñ|un*ıñ' ],
                    ['ımızn*ıñ|umızn*ıñ', 'ıñızn*ıñ|uñızn*ıñ', 'ın*ıñ|un*ıñ' ]
                ],
                'multi_syllable'=>[
                    ['ımn**ıñ|umn**ıñ', '*ıñn**ıñ|uñn**ıñ', 'ın**ıñ|un**ıñ' ],
                    ['ımızn**ıñ|umızn**ıñ', '*ıñızn*ıñ|uñızn*ıñ', 'ın*ıñ|un*ıñ' ]
                ]
            ],
            'vowel' => [
                'single_syllable'=>[
                    ['mn*ıñ', 'ñn*ıñ', 'sın*ıñ' ],
                    ['mızn*ıñ', 'ñızn*ıñ', 'sın*ıñ' ]
                ],
                'multi_syllable'=>[
                    ['mn*ıñ', 'ñn*ıñ', 'sın*ıñ' ],
                    ['mızn*ıñ', 'ñızn*ıñ', 'sın*ıñ' ]
                ]
            ],
            'non_sonorous' => [
                'single_syllable'=>[
                    ['ımn*ıñ|umn*ıñ', 'ıñn*ıñ|uñn*ıñ', 'ın*ıñ|un*ıñ' ],
                    ['ımızn*ıñ|umızn*ıñ', 'ıñızn*ıñ|uñızn*ıñ', 'ın*ıñ|un*ıñ' ]
                ],
                'multi_syllable'=>[
                    ['ımn*ıñ|umn*ıñ', 'ıñn*ıñ|uñn*ıñ', 'ın*ıñ|un*ıñ' ],
                    ['ımızn*ıñ|umızn*ıñ', 'ıñızn*ıñ|uñızn*ıñ', 'ın*ıñ|un*ıñ' ]
                ]
            ]
        ],
        'soft' => [
            'sonorous' => [
                'single_syllable'=>[
                    ['imn*iñ|ümn*iñ', 'iñn*iñ|üñn*iñ', 'in*iñ|ün*iñ' ],
                    ['imizn*iñ|ümizn*iñ', 'iñizn*iñ|üñizn*iñ', 'in*iñ|ün*iñ' ]
                ],
                'multi_syllable'=>[
                    ['imn*iñ|ümn*iñ', 'iñn*iñ|üñn*iñ', 'in*iñ|ün*iñ' ],
                    ['imizn*iñ|ümizn*iñ', 'iñizn*iñ|üñizn*iñ', 'in*iñ|ün*iñ' ]
                ]
            ],
            'vowel' => [
                'single_syllable'=>[
                    ['mn*iñ', 'ñn*iñ', 'sin*iñ' ],
                    ['mizn*iñ', 'ñizn*iñ', 'sin*iñ' ]
                ],
                'multi_syllable'=>[
                    ['mn*iñ', 'ñn*iñ', 'sin*iñ' ],
                    ['mizn*iñ', 'ñizn*iñ', 'sin*iñ' ]
                ]
            ],
            'non_sonorous' => [
                'single_syllable'=>[
                    ['imn*iñ|ümn*iñ', 'iñn*iñ|üñn*iñ', 'in*iñ|ün*iñ' ],
                    ['imizn*iñ|ümizn*iñ', 'iñizn*iñ|üñizn*iñ', 'in*iñ|ün*iñ' ]
                ],
                'multi_syllable'=>[
                    ['imn*iñ|ümn*iñ', 'iñn*iñ|üñn*iñ', 'in*iñ|ün*iñ' ],
                    ['imizn*iñ|ümizn*iñ', 'iñizn*iñ|üñizn*iñ', 'in*iñ|ün*iñ' ]
                ]
            ]
        ]
    ],
    'dative' => [
        'group' => 'case',
        'template' => 'noun_case',
        'hard' => [
            'sonorous' => [
                'single_syllable'=>[
                    ['ğ*a']
                ],
                'multi_syllable'=>[
                    ['ğ*a']
                ]
            ],
            'vowel' => [
                'single_syllable'=>[
                    ['ğ*a']
                ],
                'multi_syllable'=>[
                    ['ğ*a']
                ]
            ],
            'non_sonorous' => [
                'single_syllable'=>[
                    ['q*a']
                ],
                'multi_syllable'=>[
                    ['q*a']
                ]
            ]
        ],
        'soft' => [
            'sonorous' => [
                'single_syllable'=>[
                    ['g*e']
                ],
                'multi_syllable'=>[
                    ['g*e']
                ]
            ],
            'vowel' => [
                'single_syllable'=>[
                    ['g*e']
                ],
                'multi_syllable'=>[
                    ['g*e']
                ]
            ],
            'non_sonorous' => [
                'single_syllable'=>[
                    ['k*e']
                ],
                'multi_syllable'=>[
                    ['k*e']
                ]
            ]
        ]
    ],
    
    'dative_possession' => [
        'group' => 'case',
        'template' => 'personilized',
        'hard' => [
            'sonorous' => [
                'single_syllable'=>[
                    ['ım*a|um*a', 'ıñ*a|uñ*a', 'ın*a|un*a' ],
                    ['ımızğ*a|umızğ*a', 'ıñızğ*a|uñızğ*a', 'ın*a|un*a' ]
                ],
                'multi_syllable'=>[
                    ['ım*a|um*a', 'ıñ*a|uñ*a', 'ın*a|un*a' ],
                    ['ımızğ*a|umızğ*a', 'ıñızğ*a|uñızğ*a', 'ın*a|un*a' ]
                ]
            ],
            'vowel' => [
                'single_syllable'=>[
                    ['m*a', 'ñ*a', 'sın*a' ],
                    ['mızğ*a', 'ñızğ*a', 'sın*a' ]
                ],
                'multi_syllable'=>[
                    ['m*a', 'ñ*a', 'sın*a' ],
                    ['mızğ*a', 'ñızğ*a', 'sın*a' ]
                ]
            ],
            'non_sonorous' => [
                'single_syllable'=>[
                    ['ım*a|um*a', 'ıñ*a|uñ*a', 'ın*a|un*a' ],
                    ['ımızğ*a|umızğ*a', 'ıñızğ*a|uñızğ*a', 'ın*a|un*a' ]
                ],
                'multi_syllable'=>[
                    ['ım*a|um*a', 'ıñ*a|uñ*a', 'ın*a|un*a' ],
                    ['ımızğ*a|umızğ*a', 'ıñızğ*a|uñızğ*a', 'ın*a|un*a' ]
                ]
            ]
        ],
        'soft' => [
            'sonorous' => [
                'single_syllable'=>[
                    ['im*e|üm*e', 'iñ*e|üñ*e', 'in*e|ün*e' ],
                    ['imizg*e|ümizg*e', 'iñizg*e|üñizg*e', 'in*e|ün*e' ]
                ],
                'multi_syllable'=>[
                    ['im*e|üm*e', 'iñ*e|üñ*e', 'in*e|ün*e' ],
                    ['imizg*e|ümizg*e', 'iñizg*e|üñizg*e', 'in*e|ün*e' ]
                ]
            ],
            'vowel' => [
                'single_syllable'=>[
                    ['m*e', 'ñ*e', 'sin*e' ],
                    ['mizg*e', 'ñizg*e', 'sin*e' ]
                ],
                'multi_syllable'=>[
                    ['m*e', 'ñ*e', 'sin*e' ],
                    ['mizg*e', 'ñizg*e', 'sin*e' ]
                ]
            ],
            'non_sonorous' => [
                'single_syllable'=>[
                    ['im*e|üm*e', 'iñ*e|üñ*e', 'in*e|ün*e' ],
                    ['imizg*e|ümizg*e', 'iñizg*e|üñizg*e', 'in*e|ün*e' ]
                ],
                'multi_syllable'=>[
                    ['im*e|üm*e', 'iñ*e|üñ*e', 'in*e|ün*e' ],
                    ['imizg*e|ümizg*e', 'iñizg*e|üñizg*e', 'in*e|ün*e' ]
                ]
            ]
        ]
    ],
    'accusative' => [
        'group' => 'case',
        'template' => 'noun_case',
        'hard' => [
            'sonorous' => [
                'single_syllable'=>[
                    ['n*ı']
                ],
                'multi_syllable'=>[
                    ['n*ı']
                ]
            ],
            'vowel' => [
                'single_syllable'=>[
                    ['n*ı']
                ],
                'multi_syllable'=>[
                    ['n*ı']
                ]
            ],
            'non_sonorous' => [
                'single_syllable'=>[
                    ['n*ı']
                ],
                'multi_syllable'=>[
                    ['n*ı']
                ]
            ]
        ],
        'soft' => [
            'sonorous' => [
                'single_syllable'=>[
                    ['n*i']
                ],
                'multi_syllable'=>[
                    ['n*i']
                ]
            ],
            'vowel' => [
                'single_syllable'=>[
                    ['n*i']
                ],
                'multi_syllable'=>[
                    ['n*i']
                ]
            ],
            'non_sonorous' => [
                'single_syllable'=>[
                    ['n*i']
                ],
                'multi_syllable'=>[
                    ['n*i']
                ]
            ]
        ]
    ],
    
    'accusative_possession' => [
        'group' => 'case',
        'template' => 'personilized',
        'hard' => [
            'sonorous' => [
                'single_syllable'=>[
                    ['ımn*ı|umn*ı', 'ıñn*ı|uñn*ı', 'ın*ı|un*ı' ],
                    ['ımızn*ı|umızn*ı', 'ıñızn*ı|uñızn*ı', 'ın*ı|un*ı' ]
                ],
                'multi_syllable'=>[
                    ['ımn*ı|umn*ı', 'ıñn*ı|uñn*ı', 'ın*ı|un*ı' ],
                    ['ımızn*ı|umızn*ı', 'ıñızn*ı|uñızn*ı', 'ın*ı|un*ı' ]
                ]
            ],
            'vowel' => [
                'single_syllable'=>[
                    ['mn*ı', 'ñn*ı', 'sın*ı' ],
                    ['mızn*ı', 'ñızn*ı', 'sın*ı' ]
                ],
                'multi_syllable'=>[
                    ['mn*ı', 'ñn*ı', 'sın*ı' ],
                    ['mızn*ı', 'ñızn*ı', 'sın*ı' ]
                ]
            ],
            'non_sonorous' => [
                'single_syllable'=>[
                    ['ımn*ı|umn*ı', 'ıñn*ı|uñn*ı', 'ın*ı|un*ı' ],
                    ['ımızn*ı|umızn*ı', 'ıñızn*ı|uñızn*ı', 'ın*ı|un*ı' ]
                ],
                'multi_syllable'=>[
                    ['ımn*ı|umn*ı', 'ıñn*ı|uñn*ı', 'ın*ı|un*ı' ],
                    ['ımızn*ı|umızn*ı', 'ıñızn*ı|uñızn*ı', 'ın*ı|un*ı' ]
                ]
            ]
        ],
        'soft' => [
            'sonorous' => [
                'single_syllable'=>[
                    ['imn*i|ümn*i', 'iñn*i|üñn*i', 'in*i|ün*i' ],
                    ['imizn*i|ümizn*i', 'iñizn*i|üñizn*i', 'in*i|ün*i' ]
                ],
                'multi_syllable'=>[
                    ['im|üm', 'iñ|üñ', 'i|ü' ],
                    ['imiz|ümiz', 'iñiz|üñiz', 'i|ü' ]
                ]
            ],
            'vowel' => [
                'single_syllable'=>[
                    ['mn*i', 'ñn*i', 'sin*i' ],
                    ['mizn*i', 'ñizn*i', 'sin*i' ]
                ],
                'multi_syllable'=>[
                    ['mn*i', 'ñn*i', 'sin*i' ],
                    ['mizn*i', 'ñizn*i', 'sin*i' ]
                ]
            ],
            'non_sonorous' => [
                'single_syllable'=>[
                    ['imn*i|ümn*i', 'iñn*i|üñn*i', 'in*i|ün*i' ],
                    ['imizn*i|ümizn*i', 'iñizn*i|üñizn*i', 'in*i|ün*i' ]
                ],
                'multi_syllable'=>[
                    ['imn*i|ümn*i', 'iñn*i|üñn*i', 'in*i|ün*i' ],
                    ['imizn*i|ümizn*i', 'iñizn*i|üñizn*i', 'in*i|ün*i' ]
                ]
            ]
        ]
    ],
    
    'placive' => [
        'group' => 'case',
        'template' => 'noun_case',
        'hard' => [
            'sonorous' => [
                'single_syllable'=>[
                    ['d*a']
                ],
                'multi_syllable'=>[
                    ['d*a']
                ]
            ],
            'vowel' => [
                'single_syllable'=>[
                    ['d*a']
                ],
                'multi_syllable'=>[
                    ['d*a']
                ]
            ],
            'non_sonorous' => [
                'single_syllable'=>[
                    ['t*a']
                ],
                'multi_syllable'=>[
                    ['t*a']
                ]
            ]
        ],
        'soft' => [
            'sonorous' => [
                'single_syllable'=>[
                    ['d*e']
                ],
                'multi_syllable'=>[
                    ['d*e']
                ]
            ],
            'vowel' => [
                'single_syllable'=>[
                    ['d*e']
                ],
                'multi_syllable'=>[
                    ['d*e']
                ]
            ],
            'non_sonorous' => [
                'single_syllable'=>[
                    ['t*e']
                ],
                'multi_syllable'=>[
                    ['t*e']
                ]
            ]
        ]
    ],
    
    'placive_possession' => [
        'group' => 'case',
        'template' => 'personilized',
        'hard' => [
            'sonorous' => [
                'single_syllable'=>[
                    ['ımd*a|umd*a', 'ıñd*a|uñd*a', 'ınd*a|und*a' ],
                    ['ımızd*a|umızd*a', 'ıñızd*a|uñızd*a', 'ınd*a|und*a' ]
                ],
                'multi_syllable'=>[
                    ['ımd*a|umd*a', 'ıñd*a|uñd*a', 'ınd*a|und*a' ],
                    ['ımızd*a|umızd*a', 'ıñızd*a|uñızd*a', 'ınd*a|und*a' ]
                ]
            ],
            'vowel' => [
                'single_syllable'=>[
                    ['md*a', 'ñd*a', 'sınd*a' ],
                    ['mızd*a', 'ñızd*a', 'sınd*a' ]
                ],
                'multi_syllable'=>[
                    ['md*a', 'ñd*a', 'sınd*a' ],
                    ['mızd*a', 'ñızd*a', 'sınd*a' ]
                ]
            ],
            'non_sonorous' => [
                'single_syllable'=>[
                    ['ımd*a|umd*a', 'ıñd*a|uñd*a', 'ınd*a|und*a' ],
                    ['ımızd*a|umızd*a', 'ıñızd*a|uñızd*a', 'ınd*a|und*a' ]
                ],
                'multi_syllable'=>[
                    ['ımd*a|umd*a', 'ıñd*a|uñd*a', 'ınd*a|und*a' ],
                    ['ımızd*a|umızd*a', 'ıñızd*a|uñızd*a', 'ınd*a|und*a' ]
                ]
            ]
        ],
        'soft' => [
            'sonorous' => [
                'single_syllable'=>[
                    ['imd*e|ümd*e', 'iñd*e|üñd*e', 'ind*e|ünd*e' ],
                    ['imizd*e|ümizd*e', 'iñizd*e|üñizd*e', 'ind*e|ünd*e' ]
                ],
                'multi_syllable'=>[
                    ['imd*e|ümd*e', 'iñd*e|üñd*e', 'ind*e|ünd*e' ],
                    ['imizd*e|ümizd*e', 'iñizd*e|üñizd*e', 'ind*e|ünd*e' ]
                ]
            ],
            'vowel' => [
                'single_syllable'=>[
                    ['md*e', 'ñd*e', 'sind*e' ],
                    ['mizd*e', 'ñizd*e', 'sind*e' ]
                ],
                'multi_syllable'=>[
                    ['md*e', 'ñd*e', 'sind*e' ],
                    ['mizd*e', 'ñizd*e', 'sind*e' ]
                ]
            ],
            'non_sonorous' => [
                'single_syllable'=>[
                    ['imd*e|ümd*e', 'iñd*e|üñd*e', 'ind*e|ünd*e' ],
                    ['imizd*e|ümizd*e', 'iñizd*e|üñizd*e', 'ind*e|ünd*e' ]
                ],
                'multi_syllable'=>[
                    ['imd*e|ümd*e', 'iñd*e|üñd*e', 'ind*e|ünd*e' ],
                    ['imizd*e|ümizd*e', 'iñizd*e|üñizd*e', 'ind*e|ünd*e' ]
                ]
            ]
        ]
    ],
    
    'exodive' => [
        'group' => 'case',
        'template' => 'noun_case',
        'hard' => [
            'sonorous' => [
                'single_syllable'=>[
                    ['d*an']
                ],
                'multi_syllable'=>[
                    ['d*an']
                ]
            ],
            'vowel' => [
                'single_syllable'=>[
                    ['d*an']
                ],
                'multi_syllable'=>[
                    ['d*an']
                ]
            ],
            'non_sonorous' => [
                'single_syllable'=>[
                    ['t*an']
                ],
                'multi_syllable'=>[
                    ['t*an']
                ]
            ]
        ],
        'soft' => [
            'sonorous' => [
                'single_syllable'=>[
                    ['d*en']
                ],
                'multi_syllable'=>[
                    ['d*en']
                ]
            ],
            'vowel' => [
                'single_syllable'=>[
                    ['d*en']
                ],
                'multi_syllable'=>[
                    ['d*en']
                ]
            ],
            'non_sonorous' => [
                'single_syllable'=>[
                    ['t*en']
                ],
                'multi_syllable'=>[
                    ['t*en']
                ]
            ]
        ]
    ],
    
    'exodive_possession' => [
        'group' => 'case',
        'template' => 'personilized',
        'hard' => [
            'sonorous' => [
                'single_syllable'=>[
                    ['ımd*an|umd*an', 'ıñd*an|uñd*an', 'ınd*an|ud*an' ],
                    ['ımızd*an|umızd*an', 'ıñızd*an|uñızd*an', 'ıd*an|ud*an' ]
                ],
                'multi_syllable'=>[
                    ['ımd*an|umd*an', 'ıñd*an|uñd*an', 'ınd*an|ud*an' ],
                    ['ımızd*an|umızd*an', 'ıñızd*an|uñızd*an', 'ıd*an|ud*an' ]
                ]
            ],
            'vowel' => [
                'single_syllable'=>[
                    ['md*an', 'ñd*an', 'sıd*an' ],
                    ['mızd*an', 'ñızd*an', 'sıd*an' ]
                ],
                'multi_syllable'=>[
                    ['md*an', 'ñd*an', 'sıd*an' ],
                    ['mızd*an', 'ñızd*an', 'sıd*an' ]
                ]
            ],
            'non_sonorous' => [
                'single_syllable'=>[
                    ['ımd*an|umd*an', 'ıñd*an|uñd*an', 'ınd*an|ud*an' ],
                    ['ımızd*an|umızd*an', 'ıñızd*an|uñızd*an', 'ıd*an|ud*an' ]
                ],
                'multi_syllable'=>[
                    ['ımd*an|umd*an', 'ıñd*an|uñd*an', 'ınd*an|ud*an' ],
                    ['ımızd*an|umızd*an', 'ıñızd*an|uñızd*an', 'ıd*an|ud*an' ]
                ]
            ]
        ],
        'soft' => [
            'sonorous' => [
                'single_syllable'=>[
                    ['imd*en|ümd*en', 'iñd*en|üñd*en', 'ind*en|ünd*en' ],
                    ['imizd*en|ümizd*en', 'iñizd*en|üñizd*en', 'ind*en|ünd*en' ]
                ],
                'multi_syllable'=>[
                    ['imd*en|ümd*en', 'iñd*en|üñd*en', 'ind*en|ünd*en' ],
                    ['imizd*en|ümizd*en', 'iñizd*en|üñizd*en', 'ind*en|ünd*en' ]
                ]
            ],
            'vowel' => [
                'single_syllable'=>[
                    ['md*en', 'ñd*en', 'sind*en' ],
                    ['mizd*en', 'ñizd*en', 'sind*en' ]
                ],
                'multi_syllable'=>[
                    ['md*en', 'ñd*en', 'sind*en' ],
                    ['mizd*en', 'ñizd*en', 'sind*en' ]
                ]
            ],
            'non_sonorous' => [
                'single_syllable'=>[
                    ['imd*en|ümd*en', 'iñd*en|üñd*en', 'ind*en|ünd*en' ],
                    ['imizd*en|ümizd*en', 'iñizd*en|üñizd*en', 'ind*en|ünd*en' ]
                ],
                'multi_syllable'=>[
                    ['imd*en|ümd*en', 'iñd*en|üñd*en', 'ind*en|ünd*en' ],
                    ['imizd*en|ümizd*en', 'iñizd*en|üñizd*en', 'ind*en|ünd*en' ]
                ]
            ]
        ]
    ],
];    
