<?php

return [
    /*
     * --------------------------------------------------------------------------
     * Define configuration groups
     * --------------------------------------------------------------------------
     * Each configuration group will be rendered as a TAB page
     */
    'admin_config_groups' => [
        'site' => 'Основные данные',
        'mails' => 'Почта',
        'contacts' => 'Контакты',
        'moy_sklad' => 'Мой склад',
        'sale' => 'Скидки',
    ],
    /*
     * --------------------------------------------------------------------------
     * Define configuration permissions
     * --------------------------------------------------------------------------
     * Each configuration group will be visible to all roles if not specified or empty array.
     * Example: ['role1', 'role2']
     */
    'admin_config_permissions' => [
        'sample' => [],
        'sample2' => [],
    ],
    /**
     * --------------------------------------------------------------------------
     * Define configuration items
     * --------------------------------------------------------------------------
     * access：config('sample') config('sample.value')
     */

    'contacts'=>[
        'develop' => [
            'type'=>'text',
            'Сайт разработчика',
            'placeholder'=>'Сайт разработчика'
        ],
        'address'=>[
            'type'=>'textarea',
            'Адрес',
            'placeholder'=>'Адрес'
        ],
        'time'=>[
            'type'=>'textarea',
            'Время работы',
            'placeholder'=>'Время работы'
        ],
        'instagram'=>[
            'type'=>'text',
            'instagram',
            'placeholder'=>'instagram'
        ],
        'email'=>[
            'type'=>"text",
            'Email',
            'placeholder'=>'Email'
        ],
        'phone' => [
            'type' => 'text',
            'Телефон',
            'placeholder'=>'Телефон'
        ]

    ],

    'site' => [

        'title'=>[
            'type'=>'text',
            'SEO-title',
            'placeholder'=>'Введите заголовок сайта'
        ],
        'description'=>[
            'type'=>'text',
            'SEO-description',
            'placeholder'=>'Введите описание сайта'
        ],
        'keywords'=>[
            'type'=>'text',
            'SEO-keywords',
            'placeholder'=>'Введите клюючевые слова'
        ],
        'favicon'=>[
            'type'=>'image',
            'favicon',
            'placeholder'=>'загрузите favicon для сайта'
        ],
        'logo'=>[
            'type'=>'image',
            'Логотип',
            'placeholder'=>'загрузите Логотип для сайта'
        ],



    ],
    'mails' => [
        'from'=>[
            'type'=>'text',
            'От кого',
            'placeholder'=>'От кого'
        ],
        'to'=>[
            'type'=>'tags',
            'Кому',
            'placeholder'=>'Кому'
        ],
    ],
    'moy_sklad' => [
        'login'=>[
            'type'=>'text',
            'Логин',
            'placeholder'=>'Логин'
        ],
        'password'=>[
            'type'=>'text',
            'Пароль',
            'placeholder'=>'Пароль'
        ],
        'conterparty'=>[
            'type'=>'text',
            'Контрагент',
            'placeholder'=>'Контрагент'
        ],
    ],


];
