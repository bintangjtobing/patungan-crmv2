<?php

namespace App\Helper;


use Filament\Notifications\Notification;

class SendMessage
{
    protected $apiUrl = 'https://api.fonnte.com/send';
    protected $apiToken;

    public function __construct()
    {
        $this->apiToken = env("TOKEN_FONTE", 'PfwWgQsgThTLanYC7E-6');
    }

    public function send($phone, $message)
    {
        $message .= "\n\nJika Anda butuh bantuan, silakan balas pesan ini.\n\nTerima kasih telah mempercayai PatunganYuk IDN! Kami menghargai masukan Anda untuk meningkatkan layanan kami. Beri kami ulasan di: https://g.page/r/CSM658ow_9wxEBM/review";

        return $this->sendMessage($phone, $message);
    }

    public function sendForAdmin($phone, $message)
    {
        $message = 'Notifikasi for Admin ' . "\n\n" . $message;
        return $this->sendMessage($phone, $message);
    }

    protected function sendMessage($phone, $message)
    {
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => $this->apiUrl,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => array(
                'target' => $phone,
                'message' => $message,
                'countryCode' => '62', // Sesuaikan dengan kode negara yang sesuai
            ),
            CURLOPT_HTTPHEADER => array(
                'Authorization: ' . $this->apiToken,
            ),
        ));

        $response = curl_exec($curl);

        if (curl_errno($curl)) {
            $error_msg = curl_error($curl);
            curl_close($curl);
            $this->handleError($error_msg);
            return false;
        }

        curl_close($curl);
        return $this->handleResponse($response);
    }

    protected function handleError($error_msg)
    {
        notify()->success("Failed to send message: {$error_msg}");
    }

    protected function handleResponse($response)
    {

        notify()->success('The message has been successfully sent via Fonnte.');

        return $response;
    }
}