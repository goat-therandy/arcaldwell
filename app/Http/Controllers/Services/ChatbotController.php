<?php

namespace App\Http\Controllers\Services;

use App\Http\Controllers\Controller;
use App\Repositories\Chatbot as ChatbotRepo;
use Inertia\Inertia;

class ChatbotController extends Controller{

    protected $chatbot_repo;

    public function __construct(ChatbotRepo $chatbot_repo){
        $this->chatbot_repo = $chatbot_repo;
    }

    public function show($prompt){

        $prompt_reply = $this->chatbot_repo->getResponse($prompt);

        return Inertia::render('Chatbot', [
            'prompt_reply' => $prompt_reply
        ]);

    }

}