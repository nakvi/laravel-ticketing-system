<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Ticket;
use App\Models\User;
use Illuminate\Database\Seeder;

class TicketSeeder extends Seeder
{
    public function run(): void
    {
        $customers = User::whereIn('email', [
            'zain@example.com',
            'sarah@example.com',
            'mike@example.com'
        ])->get();

        $categories = Category::all()->pluck('id')->toArray();

        $statuses = ['open', 'in-progress', 'resolved', 'closed'];

        foreach ($customers as $customer) {
            // Create 3–6 tickets per customer
            for ($i = 0; $i < rand(3, 6); $i++) {
                $status = $statuses[array_rand($statuses)];

                $ticket = Ticket::create([
                    'user_id' => $customer->id,
                    'category_id' => $categories[array_rand($categories)],
                    'title' => $this->fakeTicketTitle(),
                    'description' => fake()->paragraphs(2, true),
                    'priority' => ['low', 'medium', 'high'][rand(0, 2)],
                    'status' => $status,
                    // Add feedback to some closed tickets
                    'rating' => $status === 'closed' && rand(0, 3) === 0
                        ? ['excellent', 'good', 'average', 'poor'][rand(0, 3)]
                        : null,
                    'feedback_comment' => $status === 'closed' && rand(0, 3) === 0
                        ? fake()->sentence()
                        : null,
                    'is_reopened' => rand(0, 10) === 0, // ~10% reopened
                    'reopened_at' => rand(0, 10) === 0 ? now()->subDays(rand(1, 14)) : null,
                    'created_at' => now()->subDays(rand(1, 60)),
                    'updated_at' => now()->subDays(rand(0, 30)),
                ]);

                // Create 0–5 comments per ticket
                $commentCount = rand(0, 5);
                for ($c = 0; $c < $commentCount; $c++) {
                    $ticket->comments()->create([
                        'user_id' => $customer->id,
                        'content' => fake()->paragraph(),
                        'created_at' => $ticket->created_at->addHours(rand(1, 72)),
                    ]);
                }
            }
        }
    }

    private function fakeTicketTitle(): string
    {
        $prefixes = ['Cannot', 'Issue with', 'Error when', 'Login problem', 'Payment failed', 'Feature request:', 'Bug in', 'Question about'];
        $topics = ['login', 'dashboard', 'payment', 'profile', 'reports', 'mobile app', 'email notifications', 'subscription', 'export function', 'dark mode'];

        return $prefixes[array_rand($prefixes)] . ' ' . $topics[array_rand($topics)];
    }
}