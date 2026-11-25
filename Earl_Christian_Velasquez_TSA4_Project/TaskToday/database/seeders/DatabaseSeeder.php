<?php

namespace Database\Seeders;

use App\Models\Task;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        foreach ([
            ['Prepare project outline', 'Write the first project outline and confirm the required sections.', 'pending'],
            ['Review Laravel validation', 'Review validation rules for task creation and editing.', 'in_progress'],
            ['Set up development environment', 'Install dependencies and verify the local application setup.', 'done'],
            ['Document the application', 'Add setup instructions and explain the mail log workflow.', 'pending'],
            ['Check submission files', 'Confirm the repository contains migrations, seeders, and README.', 'pending'],
        ] as [$title, $description, $status]) {
            Task::create(['title' => $title, 'description' => $description, 'due_date' => now()->addDays(7), 'status' => $status]);
        }
    }
}
