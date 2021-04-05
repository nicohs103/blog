<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Feed as Feed_db;

class readRssJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $rss_urls = [
            'El País' => 'http://ep00.epimg.net/rss/tags/ultimas_noticias.xml',
            'El Mundo' => 'https://e00-elmundo.uecdn.es/elmundo/rss/portada.xml'
        ];
        $limit = 5;


        foreach ($rss_urls as $publicher => $rss_url) {
            $feeds = \Feeds::make($rss_url, $limit, true);
            $i=0;
            foreach ($feeds->get_items() as $item) {
                $feed_db = new Feed_db;
                $feed_db->title = $item->get_title();
                $feed_db->body = $item->get_description();
                $feed_db->source = $item->get_permalink();
                $feed_db->publisher = $publicher;
                $feed_db->save();
 
                $i++;
                if($i==$limit){
                    break;
                }
            }
        }

        return true;
    }
}
