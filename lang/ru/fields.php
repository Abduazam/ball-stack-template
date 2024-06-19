<?php

return [

    'nav' => [
        'dashboard' => 'Панель управления',
        'overview' => 'Обзор',

        'languages' => 'Языки',

        'users' => 'Пользователи',
        'roles' => 'Роли',
        'permissions' => 'Разрешения',

        'profile' => 'Профиль',
        'settings' => 'Настройки',
        'import' => 'Импорт',

        'headings' => [
            'information' => 'Информация',
            'management' => 'Управление',
            'settings' => 'Настройки',
        ],
    ],

    'blocks' => [
        'titles' => [
            'user_profile' => 'Профиль пользователя',
            'user_password' => 'Пароль пользователя',
            'users' => 'Список пользователей',
            'user_information' => 'Информация о пользователе',
            'roles' => 'Список ролей',
            'role_information' => 'Информация о роли',
            'permissions' => 'Список разрешений',
            'permission_information' => 'Информация о разрешении',
            'import' => 'Импорт файлов',
            'languages' => "Список языков",
            'language_information' => "Информация о языке",
        ],

        'descriptions' => [
            'user_profile' => 'Основная информация вашего аккаунта. Ваше имя пользователя будет видно всем.',
            'user_password' => 'Смена пароля для входа - простой способ защитить ваш аккаунт.',
            'user_information' => 'Информация о новом пользователе. В рамках этой информации пользователь получит доступ как администратор.',
            'role_information' => 'Информация о новой роли. В рамках этой информации пользователи будут назначены на роль.',
            'permission_information' => 'Информация о новом разрешении. Определяет всю информацию, которая имеется у разрешения.',
            'import_information' => 'Импортируйте новые данные в базу данных. Эта страница обеспечивает удобный импорт.',
            'language_information' => "Информация о языке. Эта страница предоставляет информацию о языке.",
        ],
    ],

    'columns' => [
        'general' => [
            'id' => 'ID',
            'action' => 'Действие',
            'status' => 'Статус',
            'created_at' => 'Создано',
            'updated_at' => 'Обновлено',
        ],

        'language' => [
            'language' => "Язык",
            'slug' => "Слаг",
            'title' => "Название",
        ],

        'user' => [
            'user' => 'Пользователь',
            'name' => 'Имя',
            'email' => 'Email',
            'password' => 'Пароль',
            'email_verified_at' => 'Email подтвержден',
            'image' => 'Аватар пользователя',
            'role' => 'Роль',
        ],

        'role' => [
            'role' => 'Роль',
            'name' => 'Название',
            'users' => 'Пользователи',
            'user_count' => 'Количество пользователей',
            'permissions' => 'Разрешения',
            'permission_count' => 'Количество разрешений',
        ],

        'permission' => [
            'permission' => 'Разрешения',
            'name' => 'Название',
            'guard_name' => 'Имя охранника',
            'description' => 'Описание',
            'is_default' => 'По умолчанию',
            'roles' => 'Роли',
            'role_count' => 'Количество ролей',
        ],

        'import' => [
            'section' => 'Раздел',
            'file' => 'Файл',
        ],
    ],

    'placeholders' => [
        'profile' => [
            'name' => 'Введите ваше новое имя',
            'email' => 'Введите ваш новый email',
            'password' => 'Введите ваш новый пароль',
        ],

        'user' => [
            'name' => 'Введите имя пользователя',
            'email' => 'Введите email пользователя',
            'password' => 'Введите пароль пользователя',
            'role' => 'Выберите роль пользователя',
        ],

        'role' => [
            'name' => 'Введите название роли',
            'permissions' => 'Выберите разрешения',
        ]
    ],

    'buttons' => [
        'index' => 'Индекс',
        'show' => 'Просмотр',
        'edit' => 'Редактировать',
        'create' => 'Создать',
        'update' => 'Обновить',
        'delete' => 'Удалить',
        'restore' => 'Восстановить',
        'destroy' => 'Уничтожить',
        'back' => 'Назад',
        'close' => 'Закрыть',
        'export' => 'Экспортировать',
        'import' => 'Импортировать',

        // FOR TRANSLATION
        'welcome' => 'Главная страница',
        'profile' => 'Профиль',
        'locale' => 'Изменить язык'
    ],

    'filters' => [
        // WITH TRASHED
        'active' => 'Активный',
        'inactive' => 'Неактивный',

        // SELECT
        'all' => 'Все',
        'choose' => 'Выбрать',

        // PAGINATION
        'showing' => 'Показано',
        'from' => 'из',
        'data' => 'данных',

        // INPUTS
        'search' => 'Поиск',

        // DEFAULTS
        'default' => 'По умолчанию',
        'not_default' => 'Не по умолчанию',
    ],

    'actions' => [
        'buttons' => [
            'create' => 'Создать новый :model',
        ],

        'imports' => [
            # Information
            'languages' => 'Импорт языков',
            # Management
            'users' => 'Импорт пользователей',
            'roles' => 'Импорт ролей',
            'permissions' => 'Импорт разрешений',
        ]
    ],
];
