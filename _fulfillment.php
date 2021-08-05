<?php



// log the raw request -- this makes debugging much easier
$filename = time();

//$input = file_get_contents('php://input');
//file_put_contents($filename.'-input', $input);



// parse the request

//$fulfillment = json_decode($input, true);


// log the array format for easier interpreting

//file_put_contents($filename.'-debug', print_r($fulfillment, true));

// data to be posted
$UserName = "ELSFQA";
$Password = "ZLRGVp+ZyjT6hW8Xg1PJBA==";
$Destination = "CAI";
$Dimension = "";
$Origin = "CAI";
$PaymentMethod = "AC";
$ServiceType = "FRG";
$Product = "FRE";
$Weight = 6;
$NoofPeices = 1;





//data to send
$shipmentData['UserName'] = $UserName;
$shipmentData['Password'] = $Password;
$shipmentData['Destination'] = $Destination;
$shipmentData['Dimension'] = $Dimension;
$shipmentData['Origin'] = $Origin;
$shipmentData['PaymentMethod'] = $PaymentMethod;
$shipmentData['ServiceType'] = $ServiceType;
$shipmentData['Product'] = $Product;
$shipmentData['Weight'] = $Weight;
$shipmentData['NoofPeices'] = $NoofPeices;
 
  $json_string = json_encode($shipmentData);

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, "http://82.129.197.86:1929/EGEXPService.svc/RateFinder");
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POST, true);
       // curl_setopt ($ch, CURLOPT_PORT, 1929);
        curl_setopt ($ch, CURLOPT_CONNECTTIMEOUT, 5);
        curl_setopt( $ch, CURLOPT_IPRESOLVE, CURL_IPRESOLVE_V4);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $json_string);
        $output = curl_exec($ch);
        print_r($output) ;
        if(curl_errno($ch)){
                echo 'Curl error: ' . curl_error($ch);
           }
        $info = curl_getinfo($ch);
        

       // $res = json_decode($output);
        print_r($info) ;
        curl_close($ch);


    // log it so we can debug the response
  //   file_put_contents($filename.'-output', $res);





// $url = 'http://82.129.197.86:1929/EGEXPService.svc/RateFinder';
 
// $curl = curl_init();
 

 
// $json_string = json_encode($shipmentData);
 
// curl_setopt($curl, CURLOPT_URL, $url);
// curl_setopt($curl, CURLOPT_POST, TRUE);
// curl_setopt($curl, CURLOPT_POSTFIELDS, $json_string);
// curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));
// curl_setopt($curl, CURLOPT_RETURNTRANSFER, true );
 
// $data = curl_exec($curl);

// echo $data;
 
// curl_close($curl);

// // log it so we can debug the response
// file_put_contents($filename.'-output', $data);





// $server_output = httpPost("http://82.129.197.86:1929/EGEXPService.svc/RateFinder", $shipmentData);
// echo $server_output;

//$response_decode = json_decode($data);

// log it so we can debug the response
//file_put_contents($filename.'-output', $response_decode);






//post request
function httpPost($url, $data){
    $options = array(
        'http' => array(
            'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
            'method'  => 'POST',
            'content' => http_build_query($data)
        ),
        "ssl"=>array(
            "verify_peer"=>false,
            "verify_peer_name"=>false,
        ),
        'socket' => array(
        'bindto' => '82.129.197.86:1929',
        )
    );
    $context  = stream_context_create($options);
    return file_get_contents($url, false, $context);
}

