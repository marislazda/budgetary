<?php
namespace Database\Seeders;

use App\Models\Type;
use Illuminate\Database\Seeder;

class TypeTableSeeder extends Seeder {

    const TYPES = [
        'Pārtika',
        'Akcijas',
        'Cigaretes',
        'Saldumi',
        'Patrīcija',
        'Fredis',
        'Maize',
        'Alkohols',
        'Aliexpress',
        'Degviela',
        'Māja',
        'Dāvana',
        'Mašīna',
        'Apģērbs',
        'Sadzīves',
        'Alvis'
    ];

    public function run()
    {
        \DB::table('types')->delete();

        foreach (self::TYPES as $type) {
            Type::create(['name' => $type]);
        }
    }

}
