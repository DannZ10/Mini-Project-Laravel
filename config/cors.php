<?php

return [
    'paths' => ['api/*'],
    'allowed_methods' => ['*'],
    'allowed_origins' => [
        'http://localhost:3000',
        'http://localhost:5173', // Vite default
        'http://localhost:8080', // Fallback
        // Add Vercel domains later: 'https://your-frontend.vercel.app'
    ],
    'allowed_origins_patterns' => [
        '#https://.*\.vercel\.app$#', // Match any Vercel preview/production domain
    ],
    'allowed_headers' => ['*'],
    'exposed_headers' => [],
    'max_age' => 0,
    'supports_credentials' => true,
];
