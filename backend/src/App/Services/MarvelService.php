<?php

namespace App\Services;

//use PDO;

class MarvelService extends BaseService
{

    public function __construct($app)
    {
        $this->app = $app;
    }
    
    public function getAll(){
        $arr_results = array();
        $hash = md5('1'.MARVEL_PRIVATE_KEY.MARVEL_PUBLIC_KEY);
        $url = 'http://gateway.marvel.com/v1/public/comics?ts=1&apikey='.MARVEL_PUBLIC_KEY.'&hash='.$hash;

        $ch = curl_init($url);
        
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
         
        $result = json_decode(curl_exec($ch));
        curl_close($ch);
        
        foreach($result->data->results as $comic){
            $mycomic = new \stdClass();
            $mycomic->title = $comic->title;
            $mycomic->desc = ($comic->description?$comic->description:'No description');
            $mycomic->pic = $comic->thumbnail->path.'.'.$comic->thumbnail->extension;
            $arr_results[] = $mycomic;                        
        }
        return array('results'=>$arr_results);
    }

}
