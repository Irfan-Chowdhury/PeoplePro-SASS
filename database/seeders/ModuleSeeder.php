<?php

namespace Database\Seeders;

use App\Contracts\ModuleDetailContract;
use App\Models\Landlord\Module;
use App\Models\Landlord\ModuleDetail;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ModuleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $moduleData = [
            'language_id'=> 1,
            'heading'=> 'One App, all the features',
            'sub_heading'=> 'SalePro is packed with all the features you will need to seamlessly run your business',
            'image'=> '202308090836551.jpg',
        ];

        $module = Module::create($moduleData);

        $moduleDetailData = [
            [
                'module_id' => $module->id,
                'name' => 'Purchase',
                'description' => 'Create purchase order and automatically update your daily stocks.',
                'icon' => 'fa fa-book',
                'position' => 1
            ],
            [
                'module_id' => $module->id,
                'name' => 'Sales & POS',
                'description' => 'Manage your daily sales from beautifully designed POS page with lots of exclusive features.',
                'icon' => 'fa fa-briefcase',
                'position' => 2
            ],
            [
                'module_id' => $module->id,
                'name' => 'Stock & Inventory',
                'description' => 'Manage standard/combo/digital/service products with variants, IMEI, batches and expiry dates.',
                'icon' => 'fa fa-cubes',
                'position' => 3
            ],
            [
                'module_id' => $module->id,
                'name' => 'Manage accounts, account statement, balance sheet, employees, payroll, attendance, holidays and lots more.',
                'description' => 'Manage standard/combo/digital/service products with variants, IMEI, batches and expiry dates.',
                'icon' => 'fa fa-credit-card-alt',
                'position' => 3
            ],
        ];

        ModuleDetail::insert($moduleDetailData);
    }
}
