<?php
namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Exception;

class ElasticEmailService
{
    protected $apiKey;

    public function __construct()
    {
        $this->apiKey = env('ELASTIC_EMAIL_API_KEY'); // Make sure to set this in your .env file
    }

    public function sendEmail($fromMail, $fromName, $toMail, $subject, $markdownTemplate, $data)
    {
        $url = 'https://api.elasticemail.com/v2/email/send';

        $message = view($markdownTemplate, $data)->render(); // Render the Markdown template to HTML

        $post = [
            'from' => $fromMail,
            'fromName' => $fromName,
            'apikey' => $this->apiKey,
            'subject' => $subject,
            'to' => $toMail,
            'bodyHtml' => $message,
            'isTransactional' => true,
        ];

        try {
            $response = Http::post($url, $post);

            if ($response->successful()) {
                return true;
            } else {
                Log::error('Email sending failed: ' . $response->body());
                return false;
            }
        } catch (Exception $ex) {
            Log::error('Exception in email sending: ' . $ex->getMessage());
            return false;
        }
    }
}
