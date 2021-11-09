<?php
use App\Category;
use App\Proof;
use App\Invoice;

function categories(){
    $categories = Category::all();
    return $categories;
}

function rajaongkir($url, $type, $data = '')
{
    $curl = curl_init();

    curl_setopt_array($curl, array(
        CURLOPT_URL => $url, //"https://pro.rajaongkir.com/api/subdistrict?city=39"
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 100,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => $type,
        CURLOPT_POSTFIELDS =>  $data,
        CURLOPT_HTTPHEADER => [
            "content-type: application/x-www-form-urlencoded",
            "key: 1cb6ca038ddb281f174dbc4264474df0"
        ],
    ));

    $response = curl_exec($curl);
    $err = curl_error($curl);

    curl_close($curl);

    if ($err) {
        echo "cURL Error #:" . $err;
    } else {
        return json_decode($response, true)['rajaongkir'];
    }
}

function get_courier($origin = '', $destination = '', $weight = '', $courier = '', $originType = 'subdistrict', $destinationType = 'subdistrict')
{
	$curl = curl_init();

	curl_setopt_array($curl, array(
		CURLOPT_URL => "https://pro.rajaongkir.com/api/cost",
		CURLOPT_RETURNTRANSFER => true,
		CURLOPT_ENCODING => "",
		CURLOPT_MAXREDIRS => 10,
		CURLOPT_TIMEOUT => 30,
		CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		CURLOPT_CUSTOMREQUEST => "POST",
		CURLOPT_POSTFIELDS => "origin=" . $origin . "&originType=" . $originType . "&destination=" . $destination . "&destinationType=" . $destinationType . "&weight=" . $weight . "&courier=" . $courier . "",
		CURLOPT_HTTPHEADER => [
			"content-type: application/x-www-form-urlencoded",
			"key: 1cb6ca038ddb281f174dbc4264474df0"
		],
	));

	$response = curl_exec($curl);
	$err = curl_error($curl);

	curl_close($curl);

	if ($err) {
		echo "cURL Error #:" . $err;
	} else {
		$response = json_decode($response, true);
		return $response['rajaongkir']['results'][0]['costs'];
	}
}

function proof(){
    return Proof::where('status', 0)->count();
}
function invoice(){
    return Invoice::whereIn('status', [0,1,2])->count();
}