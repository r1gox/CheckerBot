<?php

class CurlRequestHandler {
    private $commonOptions;
    private $ch;
    private $cookies;

    public function __construct() {
        ignore_user_abort(true);
        set_time_limit(0);
        
        $rutaCookies = __DIR__ . '/cookies';
        if (!is_dir($rutaCookies)) {
            mkdir($rutaCookies, 0777, true);
        }
        $this->cookies = $rutaCookies . '/Random_' . uniqid('_Cookie', true) . '.txt';
    
    $this->commonOptions = [
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_SSL_VERIFYPEER => false,
        CURLOPT_SSL_VERIFYHOST => false,
        CURLOPT_COOKIEFILE => $this->cookies,
        CURLOPT_COOKIEJAR => $this->cookies,
        ];
    }

    private function initCurl($url, $headers, $specificOptions) {
        $this->ch = curl_init($url);
        $options = $this->commonOptions + [
            CURLOPT_HTTPHEADER => $headers,
        ];
        curl_setopt_array($this->ch, $specificOptions + $options);
    }

    public function performCurlRequest($url, $requestType, $headers = [], $postFields = null, $specificOptions = []) {
        $options = [];

        if ($requestType === 'POST') {
            $options[CURLOPT_POST] = true;
            $options[CURLOPT_POSTFIELDS] = $postFields;
        } else {
            $options[CURLOPT_CUSTOMREQUEST] = $requestType;
        }

        $this->initCurl($url, $headers, $specificOptions + $options);

        $curlResponse = curl_exec($this->ch);

        if (curl_errno($this->ch)) {
            $error_msg = curl_error($this->ch);
            curl_close($this->ch);
        }

        curl_close($this->ch);

        return $curlResponse;
    }

    public function addCurlOption($option, $value) {
        if (array_key_exists($option, $this->commonOptions)) {
            $this->commonOptions[$option] = $value;
        } else {
            $this->commonOptions[$option] = $value;
        }
    }

    public function RotatingProxies($ipandport = null, $userpass = null){
        $this->commonOptions + [
            CURLOPT_PROXY => $ipandport,
            CURLOPT_PROXYUSERPWD => $userpass
        ];
    }

    public function ch(){
        return $this->ch;
    }

    public function getCookies(){
        return $this->cookies;
    }

    public function capture($string, $start, $end) {
        $parts = explode($start, $string, 2);
        return isset($parts[1]) ? (strpos($parts[1], $end) !== false ? explode($end, $parts[1], 2)[0] : null) : null;
    }

    public function guid(){
        return sprintf('%04X%04X-%04X-%04X-%04X-%04X%04X%04X%04X%04X', mt_rand(0, 65535), mt_rand(0, 65535), mt_rand(0, 65535), mt_rand(16384, 20479), mt_rand(32768, 49151), mt_rand(0, 65535), mt_rand(0, 65535), mt_rand(0, 65535), mt_rand(0, 65535), mt_rand(0, 65535));
    }
    
        public  function obtenerDatoAleatorio($archivo) {
            $rutaBase = __DIR__;
        
            $rutaArchivo = $rutaBase . '/direcciones/' . $archivo;
        
            if (file_exists($rutaArchivo)) {
                $lineas = file($rutaArchivo, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
                $lineaAleatoria = $lineas[array_rand($lineas)];
                $datoAleatorio = json_decode($lineaAleatoria, true);
                return $datoAleatorio;
            } else {
                return ("El archivo '$archivo' no se encontró en la carpeta 'direcciones'.");
            }
        }
        
        public function GenerateCorreo(){
            $data = [];
            $correo = ($names = ['James', 'John', 'Robert', 'Michael', 'William',
            'David', 'Richard', 'Joseph', 'Thomas', 'Charles',
            'Mary', 'Patricia', 'Jennifer', 'Linda', 'Elizabeth',
            'Barbara', 'Susan', 'Jessica', 'Sarah', 'Karen',
            'Christopher', 'Matthew', 'Daniel', 'Donald', 'Anthony',
            'Paul', 'Mark', 'George', 'Steven', 'Kenneth'])[array_rand($names)] . ($last = ['Smith', 'Johnson', 'Williams', 'Brown', 'Jones',
            'Garcia', 'Miller', 'Davis', 'Rodriguez', 'Martinez',
            'Wilson', 'Anderson', 'Taylor', 'Thomas', 'Hernandez',
            'Moore', 'Martin', 'Jackson', 'Thompson', 'White',
            'Lopez', 'Lee', 'Gonzalez', 'Harris', 'Clark',
            'Lewis', 'Robinson', 'Walker', 'Young', 'Allen'])[array_rand($last)] . substr(str_shuffle('AbCcDdEeFf123456789GgHh'), 0, 7) . ($end = ['@gmail.com', '@yahoo.com'])[array_rand($end)];
            $data['correo'] = $correo;
            $data['firstName'] = $names[array_rand($names)];
            $data['lastName'] = $last[array_rand($last)];
            return $data;
        }
}
