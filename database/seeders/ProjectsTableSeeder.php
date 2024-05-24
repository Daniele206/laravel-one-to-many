<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Project;
use App\Models\Type;
use App\Functions\Helper;

class ProjectsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $projects = config('projects');
        foreach($projects as $project){
            $new_project = new Project();
            // $new_project->type_id = Type::inRandomOrder()->first()->id;
            $new_project->type_id = Helper::getTypeId($project['type'], Type::class);
            $new_project->name = $project['name'];
            $new_project->slug = Helper::generateSlug($new_project->name, new Project());

            $new_project->save();
        }
    }
}
