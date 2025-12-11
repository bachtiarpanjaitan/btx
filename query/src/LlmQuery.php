<?php

namespace Btx\LlmQuery;

use App\Services\LLMService;

class LlmQuery
{
    public function question($question)
    {
        $llm = new LLMService();

        $response = $llm->ask($question);
        $msg = $response->choices[0]->message;

        /*
        =====================================================
        =============== 1. OPENAI-STYLE function_call =======
        =====================================================
        */
        if (!empty($msg->functionCall)) {

            $fn = $msg->functionCall;
            $args = json_decode($fn->arguments, true);

            if (!isset($args['query'])) {
                return 'Function call without query';
            }

            $query = $args['query'];

            if (!$this->isSafeQuery($query)) {
                return 'unsafe query: ' . $query;
            }

            $data = DB::select($query);

            $final = $llm->formatAnswer($data);

            return $final->choices[0]->message->content;
        }

        /*
        =====================================================
        =============== 2. GROK-STYLE tool_calls ============
        =====================================================
        */

        if (!empty($msg->toolCalls) && count($msg->toolCalls) > 0) {

            $tool = $msg->toolCalls[0];  // Grok selalu array

            // Grok struktur:
            // tool_calls -> [{ function: { name, arguments } }]
            if (empty($tool->function)) {
                return 'Tool call without function';
            }

            $fn = $tool->function;

            $args = json_decode($fn->arguments, true);

            if (!isset($args['query'])) {
                return 'Tool call without query';
            }

            $query = $args['query'];

            if (!$this->isSafeQuery($query)) {
                return 'unsafe query: ' . $query;
            }

            $data = DB::select($query);

            $final = $llm->formatAnswer($data);

            return $final->choices[0]->message->content;
        }

        /*
        =====================================================
        ================= 3. TEXT RESPONSE ==================
        =====================================================
        */
        return $msg->content;
    }

    public function isSafeQuery($query)
    {
        $blacklist = [
            '/\bDROP\b/i',
            '/\bDELETE\b/i',
            '/\bUPDATE\b/i',
            '/\bINSERT\b/i',
            '/\bALTER\b/i',
            '/\bTRUNCATE\b/i',
        ];

        foreach ($blacklist as $rule) {
            if (preg_match($rule, $query)) {
                return false;
            }
        }

        return true;
    }
}
