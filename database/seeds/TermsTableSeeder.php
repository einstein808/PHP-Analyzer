<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;

class TermsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $json_file = Storage::disk('local')->get('terms/terms.json');
        $arr_file = json_decode($json_file, true);
        
        foreach($arr_file as $type => $terms) {
            $color = $type == 'disabled_functions' ? 'red' : 'yellow';
            foreach($terms as $term) {
                DB::table('terms')->insert(
                    [
                        'term' => $term,
                        'term_type' => $type,
                        'color' => $color,
                        'created_at' => date('Y-m-d H:i:s'),
                        'updated_at' => date('Y-m-d H:i:s'),
                    ]
                );
            }
        }
    }
}
