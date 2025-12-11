<?php

namespace App\Services;

use Illuminate\Support\Facades\DB;
use OpenAI;

class LLMService
{
    private $client;
    private $apiKey;
    private $baseUrl;
    private $model;

    public function __construct()
    {
        $this->apiKey  = config('btx.ai_api_key');
        $this->baseUrl = config('btx.ai_base_url');
        $this->model   = config('btx.ai_model');

        $this->client = OpenAI::factory()
            ->withApiKey($this->apiKey)
            ->withBaseUri($this->baseUrl)
            ->make();
    }

    public function ask($prompt)
    {
        $schemaText = $this->getFullSchema();

        $messages = [
            [
                'role' => 'system',
                'content' =>
                "Gunakan HANYA tabel berikut:

                $schemaText

                Ketika user bertanya, jangan minta klarifikasi.
                Langsung hasilkan function run_sql_query."
            ],
            ['role' => 'user', 'content' => $prompt]
        ];

        $functionDefinition = [
            'name' => 'run_sql_query',
            'description' => 'Eksekusi query SQL (hanya SELECT)',
            'parameters' => [
                'type' => 'object',
                'properties' => [
                    'query' => ['type' => 'string']
                ],
                'required' => ['query']
            ]
        ];

        switch (config('btx.ai_platform')) {

            case 'grok':
                return $this->client->chat()->create([
                    'model' => $this->model,
                    'messages' => $messages,
                    'tools' => [
                        [
                            'type' => 'function',
                            'function' => $functionDefinition
                        ]
                    ],
                    'tool_choice' => [
                        'type' => 'function',
                        'function' => ['name' => 'run_sql_query']
                    ]
                ]);

            default:
                return $this->client->chat()->create([
                    'model' => $this->model,
                    'messages' => $messages,
                    'functions' => [$functionDefinition],
                    'function_call' => ['name' => 'run_sql_query']
                ]);
        }
    }

    public function formatAnswer($data)
    {
        return $this->client->chat()->create([
            'model' => config('btx.ai_model'),
            'messages' => [
                ['role' => 'user', 'content' => 'Ringkas data berikut: ' . json_encode($data)]
            ]
        ]);
    }

    public function getTableDefinition($table)
    {
        $schema = DB::getSchemaBuilder();

        if (!$schema->hasTable($table)) {
            return "TABEL: $table (tidak ditemukan)\n\n";
        }

        $columns = $schema->getColumnListing($table);

        $definition = "TABEL: $table\nKolom:\n";

        foreach ($columns as $col) {
            $type     = $schema->getColumnType($table, $col);
            $nullable = DB::getDoctrineColumn($table, $col)->getNotnull() ? 'NO' : 'YES';
            $definition .= "- $col ($type, nullable: $nullable)\n";
        }

        return $definition . "\n";
    }

    public function getFullSchema()
    {
        $connection = DB::connection();
        $schemaBuilder = $connection->getSchemaBuilder();
        $tables = $schemaBuilder->getAllTables();

        $schema = "";

        foreach ($tables as $tableObj) {
            $tableName = $this->extractTableName($tableObj);
            $schema .= $this->getTableDefinition($tableName);
        }

        return $schema;
    }

    private function extractTableName($tableObj)
    {
        $arr = (array) $tableObj;
        return reset($arr);
    }
}
