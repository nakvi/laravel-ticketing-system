<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            ['name' => 'Technical Support', 'description' => 'Issues with software, hardware, login problems, errors'],
            ['name' => 'Billing & Payments', 'description' => 'Invoices, payment issues, refunds, subscription questions'],
            ['name' => 'Account Management', 'description' => 'Profile changes, password reset, account deletion'],
            ['name' => 'Feature Request', 'description' => 'Suggestions for new features or improvements'],
            ['name' => 'Bug Report', 'description' => 'Unexpected behaviour or crashes'],
            ['name' => 'General Inquiry', 'description' => 'Other questions'],
        ];

        foreach ($categories as $category) {
            Category::firstOrCreate(
                ['name' => $category['name']],
                ['description' => $category['description']]
            );
        }
    }
}