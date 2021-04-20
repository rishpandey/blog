<?php

namespace App\Listeners;

use TightenCo\Jigsaw\Jigsaw;

class GenerateIndex
{
    public function handle(Jigsaw $jigsaw)
    {
        $posts = $jigsaw->getCollection('posts');
        $tutorials = $jigsaw->getCollection('tutorials');

        $collection = $posts->concat($tutorials);

        $data = collect($collection->map(function ($page) use ($jigsaw) {
            return [
                'title' => $page->title,
                'description' => $page->description,
                'categories' => $page->categories,
                'link' => rightTrimPath($jigsaw->getConfig('baseUrl')) . $page->getPath(),
                'snippet' => $page->getExcerpt(),
            ];
        })->values());


        file_put_contents($jigsaw->getDestinationPath() . '/index.json', json_encode($data));
    }
}
