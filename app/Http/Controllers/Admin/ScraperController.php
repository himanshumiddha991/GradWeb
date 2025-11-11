<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Goutte\Client;
use App\Models\Game;
class ScraperController extends Controller
{
    public static function scrape($num,$index)
    {
        try {
             $client = new Client();

            $url = 'https://gali-result.in/'; // URL of the webpage you want to scrape

            $crawler = $client->request('GET', $url);

            // Extract the title of the webpage
            $old = $crawler->filter('.old')->eq($num)->text();
            $new = $crawler->filter('.new')->eq($num)->text();

            return $index==0?$old:$new;
        } catch (\Throwable $th) {
            return $th;
        }
       
    }
    public function third_party_result_update(){
        try {
            $games = Game::get();
            $client = new Client();
            $url = 'https://gali-result.in/'; 
            $crawler = $client->request('GET', $url);


            foreach($games as $g){
                if($g->third_party_index !== null){
                    echo $g->third_party_index;
                    echo "<br>";
                    $game = Game::find($g->id);
                    $game->third_party_old_result = $crawler->filter('.old')->eq($g->third_party_index)->text();
                    $game->third_party_new_result = $crawler->filter('.new')->eq($g->third_party_index)->text();
                    $game->save();
                }
              
            }
        } catch (\Throwable $th) {
            return $th;
        }
    }

    public function scrapeApi($num, $index)
    {
        $result = self::scrape($num, $index);

        return response()->json([
            'result' => $result
        ]);
    }
}
