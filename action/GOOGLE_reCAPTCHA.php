<?
class GOOGLE_reCAPTCHA {
    public static function GOOGLE_reCAPTCHA_API($key, $g_recaptcha_response) {
        $url = "https://www.google.com/recaptcha/api/siteverify";
        
        $transacData = array('secret' => $key,
                             'response'=>$g_recaptcha_response);
        //$TransacPayload = json_encode($transacData);
        
        $curl = curl_init(); //Initialiaze curl
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $transacData);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);'/cacert.pem');
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
        return $curl;
    }
    
    public static function Execute_Transaction($curl) {
        $response = curl_exec($curl);
        curl_close($curl);
        return $response;
    }
}
?>
