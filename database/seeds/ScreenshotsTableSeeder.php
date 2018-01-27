<?php

use Illuminate\Database\Seeder;

use Illuminate\Support\Facades\Storage;

use Illuminate\Http\File;
use Illuminate\Http\UploadedFile;

class ScreenshotsTableSeeder extends BaseSeeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $games = $this->getGamesNumber();

        foreach (range(1, $games) as $game)
        {

            factory('App\Screenshot')->create([

                'path'=> function () use ($game) {

                    $path = Storage::disk('public')->putFile('screenshots/'.$game, new File('storage/app/capture.png'));

                    return $path;

                },
                'game_id'=> $game

            ]);

        }

    }
}
