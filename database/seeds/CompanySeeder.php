<?php

use Illuminate\Database\Seeder;
use App\Models\Company;

/**
 * Class CompanySeeder
 */
class CompanySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Company::insert([
            [
                "name" => "Instituto Neurológico",
                "is_active" => 1
            ],
            [
                "name" => "Colsubsidio",
                "is_active" => 1
            ],
            [
                "name" => "Coco Digital",
                "is_active" => 1
            ]
        ]);
    }
}
