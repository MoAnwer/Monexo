<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;

class AssistantController extends Controller
{
    
    public function chat() 
    {
        return view('admin.ai-chat');
    } 

    public function sendMessageToQwen(Request $request)
    {
        try {
            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . config('services.qwen.api_key'),
                'Content-Type' => 'application/json',
            ])->post('https://dashscope.aliyuncs.com/api/v1/services/aigc/text-generation/generation', [
                'model' => 'qwen-turbo',
                'input' => [
                    'messages' => [
                        [
                            'role' => 'user',
                            'content' => $request->message
                        ]
                    ]
                ]
            ]);

            if ($response->successful()) {
                return response()->json([
                    'success' => true,
                    'message' => $response->json()['output']['text']
                ]);
            }

            return response()->json([
                'success' => false,
                'message' => 'Failed to get response from Qwen'
            ], 500);

        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ], 500);
        }
    }

}
