<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\File;
use Illuminate\Http\UploadedFile;

class ScreenshotsTableSeeder extends BaseSeeder
{
    public function run()
    {
        $games = $this->getGamesNumber();
        $screenshots = $this->getScreenshotsPerGame();

        foreach (range(1, $games) as $game)
        {
            foreach (range(1, array_random($screenshots)) as $screenshot)
            {
                factory('App\Screenshot')->create([
                    'path'=> function () use ($game)
                    {
                        $path = Storage::disk('public')
                            ->putFile('screenshots/'.$game, new File('storage/app/capture.png'));

                        return $path;
                    },
                    'game_id'=> $game
                ]);
            }
        }

        // Seed Skeleton RPG
        $skeleton_game = $games + 1;

        factory('App\Screenshot')->create([
            'path'=> function () use ($skeleton_game)
            {
                $skeleton_path = Storage::disk('public')
                    ->putFile('screenshots/'.$skeleton_game, new File('storage/app/skeleton1.jpg'));

                return $skeleton_path;
            },
            'game_id'=> $skeleton_game
        ]);

        factory('App\Screenshot')->create([
            'path'=> function () use ($skeleton_game)
            {
                $skeleton_path = Storage::disk('public')
                    ->putFile('screenshots/'.$skeleton_game, new File('storage/app/skeleton2.png'));

                return $skeleton_path;
            },
            'game_id'=> $skeleton_game
        ]);
    }

}
