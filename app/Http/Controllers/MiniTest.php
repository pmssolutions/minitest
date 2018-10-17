<?php

namespace App\Http\Controllers;

use App\City;
use Illuminate\Http\Request;

class MiniTest extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // url
        $url = "https://www.metaweather.com/api";
        
        $options = array(
            CURLOPT_RETURNTRANSFER => true,   // return web page
            CURLOPT_HEADER         => false,  // don't return headers
            CURLOPT_FOLLOWLOCATION => true,   // follow redirects
            CURLOPT_MAXREDIRS      => 10,     // stop after 10 redirects
            CURLOPT_ENCODING       => "",     // handle compressed
            CURLOPT_USERAGENT      => "test", // name of client
            CURLOPT_AUTOREFERER    => true,   // set referrer on redirect
            CURLOPT_CONNECTTIMEOUT => 120,    // time-out on connect
            CURLOPT_TIMEOUT        => 120,    // time-out on response
            CURLOPT_HTTPHEADER => array(      // cache header
                "cache-control: no-cache"
            )
        ); 

        $curl = curl_init($url."/location/1047378/");
        curl_setopt_array($curl, $options);

        $response = json_decode(curl_exec($curl),true);
        
        if(!empty($response)) {
            $data = $response;
        }else{
            $data = curl_error($curl);
        }

        curl_close($curl);

        return view('minitest',[
            'datas' => $data,
            'cities' => City::all()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        $query = str_replace(" ","+",$request->input('city'));
        
        // url
        $url = "https://www.metaweather.com/api/location/search/?query=";

        $options = array(
            CURLOPT_RETURNTRANSFER => true,   // return web page
            CURLOPT_HEADER         => false,  // don't return headers
            CURLOPT_FOLLOWLOCATION => true,   // follow redirects
            CURLOPT_MAXREDIRS      => 10,     // stop after 10 redirects
            CURLOPT_ENCODING       => "",     // handle compressed
            CURLOPT_USERAGENT      => "test", // name of client
            CURLOPT_AUTOREFERER    => true,   // set referrer on redirect
            CURLOPT_CONNECTTIMEOUT => 120,    // time-out on connect
            CURLOPT_TIMEOUT        => 120,    // time-out on response
            CURLOPT_HTTPHEADER => array(      // cache header
                "cache-control: no-cache"
            )
        ); 

        $curl = curl_init($url.$query);
        curl_setopt_array($curl, $options);

        $response = json_decode(curl_exec($curl),true);
        
        if(!empty($response)) {

            curl_close($curl);

            $is_exist = City::where('city', $response[0]['title'])->count();
            if(!$is_exist) {
                $city = new City;
                $city->city = $response[0]['title'];
                $city->save();
            }

            // url
            $url = "https://www.metaweather.com/api/location/";
            
            $curl = curl_init($url.$response[0]['woeid']);
            curl_setopt_array($curl, $options);

            $response = json_decode(curl_exec($curl),true);

            if(!empty($response)) {
                $data = $response;
            }else{
                $data = curl_error($curl);
            }

        }else{
            // $data = curl_error($curl);
            return redirect('/');
        }

        curl_close($curl);

        return view('minitest',[
            'datas' => $data,
            'cities' => City::all()
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
