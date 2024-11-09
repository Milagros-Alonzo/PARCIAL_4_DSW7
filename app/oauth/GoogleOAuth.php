<?php
//archivo 
class GoogleOAuth {
    private $client_id;
    private $client_secret;
    private $redirect_uri;
    private $token_url = "https://oauth2.googleapis.com/token";
    private $user_info_url = "https://www.googleapis.com/oauth2/v1/userinfo";

    public function __construct($client_id, $client_secret, $redirect_uri) {
        $this->client_id = $client_id;
        $this->client_secret = $client_secret;
        $this->redirect_uri = $redirect_uri;
    }

    // Intercambia el código de autorización por un token de acceso
    public function getAccessToken($code) {
        $post_data = [
            'code' => $code,
            'client_id' => $this->client_id,
            'client_secret' => $this->client_secret,
            'redirect_uri' => $this->redirect_uri,
            'grant_type' => 'authorization_code'
        ];

        $response = $this->makePostRequest($this->token_url, $post_data);
        $token_data = json_decode($response, true);

        if (isset($token_data['access_token'])) {
            $_SESSION['access_token'] = $token_data['access_token'];
            if (isset($token_data['refresh_token'])) {
                $_SESSION['refresh_token'] = $token_data['refresh_token'];
            }
            return $token_data['access_token'];
        }

        return null;
    }

    // Obtiene la información del usuario usando el token de acceso
    public function getUserInfo($access_token) {
        $user_info_url = $this->user_info_url . "?access_token=" . $access_token;
        $response = $this->makeGetRequest($user_info_url);
        return json_decode($response, true);
    }

    // Realiza una solicitud POST a una URL específica
    private function makePostRequest($url, $data) {
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
        curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/x-www-form-urlencoded']);
        $response = curl_exec($ch);
        curl_close($ch);
        return $response;
    }

    // Realiza una solicitud GET a una URL específica
    private function makeGetRequest($url) {
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($ch);
        curl_close($ch);
        return $response;
    }
}

?>
