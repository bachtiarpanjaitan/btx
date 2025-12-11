<?php
return [
     'database' => 'sqlite',
     'language' => [
          'id',
          'en'
     ],
     'base_file_path' => 'public',
     'max_query_limit' => 1000,
     "ai_platform" => env('AI_PLATFORM', 'openai'),
     "ai_model" => env('AI_MODEL', 'gpt-5-nano'),
     "ai_api_key" => env('AI_API_KEY', ''),
     "ai_base_url" => env('AI_BASE_URL', 'https://api.openai.com/v1'),
];
