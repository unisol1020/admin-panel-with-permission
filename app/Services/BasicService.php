<?php


namespace App\Services;

class BasicService
{
    private $updateResponse = ['code' => 204 , 'message' => []];
    private $deleteResponse = ['code' => 200 , 'message' => []];

    public function getResponse(string $type): array
    {
        return $this->{$type.'Response'};
    }

    public function setResponse(string $type , ?int $code, ?string $message): void
    {
        $responseArray = $this->{$type.'Response'};

        if (!empty($code)) {
            $responseArray['code'] = $code;
        }

        if (!empty($message)) {
            $responseArray['message'] = $message;
        }
    }
}
