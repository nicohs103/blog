<?php

namespace App\Console\Commands;

use App\Post;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;


class GetExternalPosts extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'GetExternalPosts';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Import posts created in a external blogging web';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return boolean
     */
    public function handle()
    {
        $response = $this->guzzleGetPosts();

        if (empty($response) || empty($response->data)) {
            return false;
        }

        foreach ($response->data as $data) {
            $this->createAdminPost($data);
        }

        return true;
    }

    /**
     * guzzleGetPosts
     *
     * @return object
     */
    private function guzzleGetPosts()
    {
        $externalBlogUrl = config('helper.EXTERNAL_BLOG_URL');
        $response = Http::get($externalBlogUrl);

        if ($response->successful()) {
            return json_decode($response->body());
        }

        return;
    }

    /**
     * createAdminPost
     *
     * @param object $data
     * @return void
     */
    private function createAdminPost($data)
    {
        if (empty($data)) {
            return;
        }

        $data->created_by = config('helper.ADMIN_ID');
        $post = new Post((array)  $data);
        $post->save();

        return;
    }
}
