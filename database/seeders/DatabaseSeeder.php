<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Review;
use App\Models\Service;
use App\Models\ServiceRequest;
use App\Models\User;
use App\Models\WorkerProfile;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Categories
        $categoryNames = [
            'Plumbing',
            'Electrical',
            'Carpentry',
            'Painting',
            'HVAC',
            'Cleaning',
            'Landscaping',
            'Appliance repair',
            'Mobile & web development',
            'IT support',
            'Interior design',
            'Moving services',
        ];

        $categories = collect($categoryNames)->map(function (string $name) {
            return Category::firstOrCreate(
                ['slug' => Str::slug($name)],
                ['name' => $name]
            );
        });

        // Users
        $workers = User::factory()
            ->count(10)
            ->create(['role' => 'worker']);

        $customers = User::factory()
            ->count(18)
            ->create(['role' => 'customer']);

        // Worker profiles + services
        $services = collect();

        foreach ($workers as $worker) {
            WorkerProfile::updateOrCreate(
                ['user_id' => $worker->id],
                [
                    'bio' => fake()->paragraphs(2, true),
                    'phone' => fake()->phoneNumber(),
                    'location' => fake()->city() . ', ' . fake()->country(),
                ]
            );

            $serviceCount = fake()->numberBetween(2, 4);
            for ($i = 0; $i < $serviceCount; $i++) {
                $cat = $categories->random();
                $services->push(
                    Service::create([
                        'user_id' => $worker->id,
                        'category_id' => $cat->id,
                        'title' => fake()->sentence(3),
                        'description' => fake()->paragraphs(2, true),
                        'price' => fake()->randomFloat(2, 25, 450),
                    ])
                );
            }
        }

        // Requests
        $requests = collect();
        $statusPool = ['pending', 'accepted', 'completed', 'rejected'];

        for ($i = 0; $i < 40; $i++) {
            $service = $services->random();
            $customer = $customers->random();

            // Avoid edge-case where the same user is both roles in future edits.
            if ($customer->id === $service->user_id) {
                continue;
            }

            $status = fake()->randomElement($statusPool);

            $scheduled = match ($status) {
                'completed' => Carbon::now()->subDays(fake()->numberBetween(1, 20)),
                'rejected' => Carbon::now()->addDays(fake()->numberBetween(1, 20)),
                default => Carbon::now()->addDays(fake()->numberBetween(1, 20)),
            };

            $requests->push(
                ServiceRequest::create([
                    'customer_id' => $customer->id,
                    'service_id' => $service->id,
                    'status' => $status,
                    'description' => fake()->paragraphs(2, true),
                    'scheduled_date' => $scheduled->toDateString(),
                ])
            );
        }

        // Reviews (customers review professionals for completed requests)
        $completed = $requests->where('status', 'completed')->shuffle()->take(18);
        foreach ($completed as $req) {
            Review::firstOrCreate(
                ['service_request_id' => $req->id],
                [
                    'customer_id' => $req->customer_id,
                    'worker_id' => $req->service->user_id,
                    'rating' => fake()->numberBetween(3, 5),
                    'comment' => fake()->boolean(80) ? fake()->sentence(12) : null,
                ]
            );
        }
    }
}