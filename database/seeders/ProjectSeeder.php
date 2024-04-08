<?php

namespace Database\Seeders;


use App\Models\Project;
use App\Models\Type;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Generator as Faker;
use Illuminate\Support\Str;
class ProjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        $type_id = Type::all()->pluck('id');
        $user_id = User::all()->pluck('id');

        for($i = 0; $i < 20; $i++) {

            $project = new Project;
            $project->user_id = $faker->randomElement($user_id);
            $project->type_id = $faker->randomElement($type_id);
            $project->title = $faker->catchPhrase();
            $project->content = $faker->paragraphs(2, true);
            $project->slug = Str::slug($project->title);
            $project->save();
        }
    }
}
