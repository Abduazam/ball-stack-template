<?php

return [

    'nav' => [
        'dashboard' => 'Dashboard',
        'overview' => 'Overview',

        'languages' => 'Languages',

        'users' => "Users",
        'roles' => "Roles",
        'permissions' => "Permissions",

        'profile' => 'Profile',
        'settings' => 'Settings',
        'import' => 'Import',

        'headings' => [
            'information' => 'Information',
            'management' => 'Management',
            'settings' => 'Settings',
        ],
    ],

    'blocks' => [
        'titles' => [
            'user_profile' => 'User Profile',
            'user_password' => 'User Password',
            'users' => "Users List",
            'user_information' => 'User Info',
            'roles' => "Roles List",
            'role_information' => 'Role Info',
            'permissions' => "Permissions List",
            'permission_information' => 'Permission Info',
            'import' => 'Import Files',
            'languages' => "Languages List",
            'language_information' => 'Language Info',
        ],

        'descriptions' => [
            'user_profile' => 'Your account’s vital info. Your username will be publicly visible.',
            'user_password' => 'Changing your sign in password is an easy way to keep your account secure.',
            'user_information' => 'New user information. Within these info user will access as administrator.',
            'role_information' => 'New role information. Within these info users will assign to the role.',
            'permission_information' => 'New permission information. It defines all information that permission has.',
            'import_information' => "Import your new data into the database. This page provides elegant importing.",
            'language_information' => "A language information. This page provides information about a language.",
        ],
    ],

    'columns' => [
        'general' => [
            'id' => "ID",
            'action' => "Action",
            'status' => "Status",
            'created_at' => "Created at",
            'updated_at' => "Updated at",
        ],

        'language' => [
            'language' => "Language",
            'slug' => "Slug",
            'title' => "Title",
        ],

        'user' => [
            'user' => "User",
            'name' => "Name",
            'email' => "Email",
            'password' => 'Password',
            'email_verified_at' => 'Email verified at',
            'image' => "User Avatar",
            'role' => "Role",
        ],

        'role' => [
            'role' => "Role",
            'name' => "Name",
            'users' => "Users",
            'user_count' => "Users Count",
            'permissions' => "Permissions",
            'permission_count' => "Permissions Count",
        ],

        'permission' => [
            'permission' => "Permissions",
            'name' => "Name",
            'description' => "Description",
            'is_default' => "Default",
            'roles' => "Roles",
            'role_count' => "Roles Count",
        ],

        'import' => [
            'section' => "Section",
            'file' => "File",
        ],
    ],

    'placeholders' => [
        'profile' => [
            'name' => 'Enter your new name',
            'email' => 'Enter your new email',
            'password' => 'Enter your new password',
        ],

        'user' => [
            'name' => 'Enter user name',
            'email' => 'Enter user email',
            'password' => 'Enter user password',
            'role' => 'Select user role',
        ],

        'role' => [
            'name' => 'Enter role name',
            'permissions' => 'Select permissions',
        ]
    ],

    'buttons' => [
        'index' => "Index",
        'show' => "Show",
        'edit' => "Edit",
        'create' => 'Create',
        'update' => 'Update',
        'delete' => 'Delete',
        'restore' => 'Restore',
        'destroy' => 'Destroy',
        'back' => 'Back',
        'close' => 'Close',
        'export' => 'Export',
        'import' => 'Import',

        // FOR TRANSLATION
        'welcome' => "Main page",
        'profile' => "Profile",
        'locale' => "Change language",
    ],

    'filters' => [
        // WITH TRASHED
        'active' => 'Active',
        'inactive' => 'Inactive',

        // SELECT
        'all' => 'All',
        'choose' => "Choose",

        // PAGINATION
        'showing' => 'Showing',
        'from' => 'from',
        'data' => "data",

        // INPUTS
        'search' => "Search",

        // DEFAULTS
        'default' => "Default",
        'not_default' => "Not Default",
    ],

    'actions' => [
        'buttons' => [
            'create' => 'Create new :model',
        ],

        'imports' => [
            # Information
            'languages' => "Importing languages",
            # Management
            'users' => "Importing users",
            'roles' => "Importing roles",
            'permissions' => "Importing permissions",
        ]
    ]
];
