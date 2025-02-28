<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MInventorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('m_inventory')->insert([
            [
                'id_inventory' => 'INV001',
                'category' => 'Electronics',
                'name' => 'Smartphone',
                'qty' => 10.0000,
                'unit' => 'pcs',
                'hpp' => 5000000.00,
                'automargin' => 10.00,
                'minsales' => 5500000.00,
                'price_list' => 6000000.00,
                'currency' => 'IDR',
                'last_purch' => 4900000.00,
                'aktif_y_n' => 'Y',
                'ws_price' => 5800000.00,
                'category_2' => 'Gadgets',
                'plu' => 'SM123',
                'w_unit' => 'kg',
                'net_wight' => 0.5,
                'id_supplier' => 1,
            ],
            [
                'id_inventory' => 'INV002',
                'category' => 'Home Appliances',
                'name' => 'Microwave',
                'qty' => 5.0000,
                'unit' => 'pcs',
                'hpp' => 1500000.00,
                'automargin' => 15.00,
                'minsales' => 1700000.00,
                'price_list' => 2000000.00,
                'currency' => 'IDR',
                'last_purch' => 1400000.00,
                'aktif_y_n' => 'Y',
                'ws_price' => 1800000.00,
                'category_2' => 'Kitchen',
                'plu' => 'MW456',
                'w_unit' => 'kg',
                'net_wight' => 8.0,
                'id_supplier' => 2,
            ]
        ]);
    }
}
