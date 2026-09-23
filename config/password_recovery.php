<?php

return [
    'login_route' => env('PASSWORD_RECOVERY_LOGIN_ROUTE', 'login'),

    'manual_ttl' => (int) env('PASSWORD_RECOVERY_MANUAL_TTL', 600),

    'max_attempts' => (int) env('PASSWORD_RECOVERY_MAX_ATTEMPTS', 5),

    'decay_seconds' => (int) env('PASSWORD_RECOVERY_DECAY_SECONDS', 300),

    'identity' => [
        'connection' => env('PASSWORD_RECOVERY_IDENTITY_CONNECTION', 'kkh'),
        'table' => env('PASSWORD_RECOVERY_IDENTITY_TABLE', 'tbl_data_hr'),
        'nik_column' => env('PASSWORD_RECOVERY_IDENTITY_NIK_COLUMN', 'Nik'),
        'ktp_column' => env('PASSWORD_RECOVERY_IDENTITY_KTP_COLUMN', 'No_KTP'),
        'dob_column' => env('PASSWORD_RECOVERY_IDENTITY_DOB_COLUMN', 'DOB'),
    ],

    'satu_sims' => [
        'mode' => env('SATU_SIMS_AUTH_MODE', 'database'),

        'database' => [
            'connection' => env('SATU_SIMS_DB_CONNECTION', 'kkh'),
            'table' => env('SATU_SIMS_USER_TABLE', 'web_login'),
            'nik_column' => env('SATU_SIMS_NIK_COLUMN', 'Nik'),
            'password_column' => env('SATU_SIMS_PASSWORD_COLUMN', 'password'),
            'enabled_column' => env('SATU_SIMS_ENABLED_COLUMN', null),
            'enabled_value' => env('SATU_SIMS_ENABLED_VALUE', null),
            'password_scheme' => env('SATU_SIMS_PASSWORD_SCHEME', 'auto'),
        ],

        'api' => [
            'endpoint' => env('SATU_SIMS_AUTH_ENDPOINT'),
            'token' => env('SATU_SIMS_AUTH_TOKEN'),
            'nik_key' => env('SATU_SIMS_API_NIK_KEY', 'nik'),
            'password_key' => env('SATU_SIMS_API_PASSWORD_KEY', 'password'),
            'success_key' => env('SATU_SIMS_API_SUCCESS_KEY', 'valid'),
            'timeout' => (int) env('SATU_SIMS_API_TIMEOUT', 8),
        ],
    ],

    'revoke_database_sessions' => env('PASSWORD_RECOVERY_REVOKE_SESSIONS', true),
];