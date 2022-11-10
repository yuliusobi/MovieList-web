<?php

namespace Database\Seeders;

use App\Models\Movie;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MovieSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Movie::create([
            'title' => 'Wonder Woman',
            'desc' => 'Diana, princess of the Amazons, trained to be an unconquerable warrior. Raised on a sheltered island paradise, when a pilot crashes on their shores and tells of a massive conflict raging in the outside world, Diana leaves her home, convinced she can stop the threat. Fighting alongside man in a war to end all wars, Diana will discover her full powers and her true destiny.',
            'director' => 'Patty Jenkins',
            'released_date' => Carbon::parse('2017-06-02'),
            'thumb_img' => 'movie-images/ww.jpg',
            'bg_img' => 'bg-images/ww.jpg'
        ]);

        Movie::create([
            'title' => 'Pirates of the Caribbean: The Curse of the Black Pearl',
            'desc' => "This swash-buckling tale follows the quest of Captain Jack Sparrow, a savvy pirate, and Will Turner, a resourceful blacksmith, as they search for Elizabeth Swann. Elizabeth, the daughter of the governor and the love of Will's life, has been kidnapped by the feared Captain Barbossa. Little do they know, but the fierce and clever Barbossa has been cursed. He, along with his large crew, are under an ancient curse, doomed for eternity to neither live, nor die. That is, unless a blood sacrifice is made.",
            'director' => 'Gore Verbinski',
            'released_date' => Carbon::parse('2003-07-09'),
            'thumb_img' => 'movie-images/pirate.jpg',
            'bg_img' => 'bg-images/pirate.jpg'
        ]);

        Movie::create([
            'title' => 'Titanic',
            'desc' => '84 years later, a 100 year-old woman named Rose DeWitt Bukater tells the story to her granddaughter Lizzy Calvert, Brock Lovett, Lewis Bodine, Bobby Buell and Anatoly Mikailavich on the Keldysh about her life set in April 10th 1912, on a ship called Titanic when young Rose boards the departing ship with the upper-class passengers and her mother, Ruth DeWitt Bukater, and her fiancé, Caledon Hockley. Meanwhile, a drifter and artist named Jack Dawson and his best friend Fabrizio De Rossi win third-class tickets to the ship in a game. And she explains the whole story from departure until the death of Titanic on its first and last voyage April 15th, 1912 at 2:20 in the morning.',
            'director' => 'James Cameron',
            'released_date' => Carbon::parse('1997-12-19'),
            'thumb_img' => 'movie-images/titanic.jpg',
            'bg_img' => 'bg-images/titanic.jpg'
        ]);

        Movie::create([
            'title' => 'Red Notice',
            'desc' => "When an Interpol-issued Red Notice the highest level warrant to hunt and capture the world's most wanted goes out, the FBI's top profiler John Hartley (Dwayne Johnson) is on the case. His global pursuit finds him smack dab in the middle of a daring heist where he's forced to partner with the world's greatest art thief Nolan Booth (Ryan Reynolds) in order to catch the world's most wanted art thief, \"The Bishop\" (Gal Gadot). The high-flying adventure that ensues takes the trio around the world, across the dance floor, trapped in a secluded prison, into the jungle and, worst of all for them, constantly into each other's company.",
            'director' => 'Rawson Marshall Thurber',
            'released_date' => Carbon::parse('2021-11-12'),
            'thumb_img' => 'movie-images/red.jpg',
            'bg_img' => 'bg-images/red.jpg'
        ]);

    }
}
