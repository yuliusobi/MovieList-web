<?php

namespace Database\Seeders;

use App\Models\Actor;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ActorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Actor::create([
            'name' => 'Gal Gadot',
            'bio' => "Gal Gadot is an Israeli actress, singer, martial artist, and model. She was born in Rosh Ha'ayin, Israel. Her parents are Irit, a teacher, and Michael, an engineer. She served in the IDF for two years, and won the Miss Israel title in 2004. Gal made her film debut in the fourth film of the Fast and Furious franchise, Fast & Furious (2009), as Gisele. Her role was expanded in the sequels Fast Five (2011) and Fast & Furious 6 (2013), in which her character was romantically linked to Han Seoul-Oh (Sung Kang).",
            'gender' => 'Female',
            'dob' => Carbon::parse('1985-04-30'),
            'place_of_birth' => 'Israel',
            'popularity' => 10,
            'img' => 'actor-images/galgadot.png'
        ]);

        Actor::create([
            'name' => 'Johnny Deep',
            'bio' => "John Christopher 'Johnny' Depp II was born on June 9, 1963 in Owensboro, Kentucky, to Betty Sue Palmer (née Wells), a waitress, and John Christopher Depp, a civil engineer. He was raised in Florida. He dropped out of school when he was 15, and fronted a series of music-garage bands, including one named 'The Kids'. When he married Lori A. Depp, he took a job as a ballpoint-pen salesman to support himself and his wife. A visit to Los Angeles, California, with his wife, however, happened to be a blessing in disguise, when he met up with actor Nicolas Cage, who advised him to turn to acting, which culminated in Depp's film debut in the low-budget horror film, A Nightmare on Elm Street (1984), where he played a teenager who falls prey to dream-stalking demon Freddy Krueger.",
            'gender' => 'Male',
            'dob' => Carbon::parse('1963-06-09'),
            'place_of_birth' => 'USA',
            'popularity' => 9,
            'img' => 'actor-images/johnny.png'
        ]);

        Actor::create([
            'name' => 'Leonardo DiCaprio',
            'bio' => "Few actors in the world have had a career quite as diverse as Leonardo DiCaprio's. DiCaprio has gone from relatively humble beginnings, as a supporting cast member of the sitcom Growing Pains (1985) and low budget horror movies, such as Critters 3 (1991), to a major teenage heartthrob in the 1990s, as the hunky lead actor in movies such as Romeo + Juliet (1996) and Titanic (1997), to then become a leading man in Hollywood blockbusters, made by internationally renowned directors such as Martin Scorsese and Christopher Nolan.",
            'gender' => 'Male',
            'dob' => Carbon::parse('1974-11-11'),
            'place_of_birth' => 'USA',
            'popularity' => 9,
            'img' => 'actor-images/leonardo.png'
        ]);

        Actor::create([
            'name' => 'Keira Knightley',
            'bio' => 'Keira Christina Knightley was born March 26, 1985 in the South West Greater London suburb of Richmond. She is the daughter of actor Will Knightley and actress turned playwright Sharman Macdonald. An older brother, Caleb Knightley, was born in 1979. Her father is English, while her Scottish-born mother is of Scottish and Welsh origin. Brought up immersed in the acting profession from both sides - writing and performing - it is little wonder that the young Keira asked for her own agent at the age of three. She was granted one at the age of six and performed in her first TV role as "Little Girl" in Screen One: Royal Celebration (1993), aged seven.',
            'gender' => 'Female',
            'dob' => Carbon::parse('1985-03-26'),
            'place_of_birth' => 'United Kingdom',
            'popularity' => 5,
            'img' => 'actor-images/keira.jpg'
        ]);
    }
}
