<?php

namespace Database\Seeders;

use App\Models\Article;
use App\Models\Event;
use App\Models\Expert;
use App\Models\Program;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        User::firstOrCreate(
            ['email' => 'admin@eastaxis.test'],
            [
                'name' => 'EastAxis Admin',
                'password' => Hash::make('password'),
                'is_admin' => true,
            ]
        );

        if (Article::count() === 0) {
            Article::create([
                'title' => 'The AI Labor Debate: Three Views on the Future of Work in South Asia',
                'type' => 'Paper',
                'image' => 'https://images.unsplash.com/photo-1518186285589-2f7649de83e0?q=80&w=700&auto=format&fit=crop',
                'excerpt' => 'Our economists model how automation and AI adoption will reshape employment across manufacturing and services over the next decade.',
                'body' => 'Full research content goes here...',
                'is_featured' => true,
            ]);

            Article::create([
                'title' => 'Implementing a Regional Strategy for Semiconductor Resilience',
                'type' => 'Report',
                'image' => 'https://images.unsplash.com/photo-1526304640581-d334cdbbf45e?q=80&w=700&auto=format&fit=crop',
                'excerpt' => 'A practical roadmap for governments seeking to reduce dependency risk while attracting long-term industrial investment.',
                'body' => 'Full report content goes here...',
            ]);

            Article::create([
                'title' => 'Climate Finance Must Respond to Entrenched Instability',
                'type' => 'Article',
                'image' => 'https://images.unsplash.com/photo-1497215728101-856f4ea42174?q=80&w=700&auto=format&fit=crop',
                'excerpt' => 'On-the-ground research on how climate financing mechanisms perform in fragile and conflict-affected economies.',
                'body' => 'Full article content goes here...',
            ]);
        }

        if (Program::count() === 0) {
            $programs = [
                'Trade & Economic Policy',
                'Technology & Digital Governance',
                'Climate & Energy Security',
                'South Asia Practice',
                'Southeast Asia Practice',
                'Africa Practice',
                'Governance & Public Institutions',
                'Strategic Risk & Security',
                'Sustainable Development',
            ];
            foreach ($programs as $i => $title) {
                Program::create(['title' => $title, 'sort_order' => $i]);
            }
        }

        if (Event::count() === 0) {
            Event::create([
                'title' => 'Roundtable: The Next Decade of Indo-Pacific Trade',
                'image' => 'https://images.unsplash.com/photo-1591115765373-5207764f72e7?q=80&w=500&auto=format&fit=crop',
                'event_date' => now()->addDays(4)->setTime(17, 0),
                'speakers' => 'Ananya Krishnan, Daniel Osei',
            ]);

            Event::create([
                'title' => 'Panel: Financing Climate Resilience in South Asia',
                'image' => 'https://images.unsplash.com/photo-1560439514-4e9645039924?q=80&w=500&auto=format&fit=crop',
                'event_date' => now()->addDays(11)->setTime(15, 0),
                'speakers' => 'Sara Lindqvist, Vikram Nair',
            ]);

            Event::create([
                'title' => 'Briefing: Semiconductor Supply Chains After the Realignment',
                'image' => 'https://images.unsplash.com/photo-1475721027785-f74eccf877e2?q=80&w=500&auto=format&fit=crop',
                'event_date' => now()->addDays(18)->setTime(11, 0),
                'speakers' => 'Rahul Mehta',
            ]);
        }

        if (Expert::count() === 0) {
            Expert::create(['name' => 'Ananya Krishnan', 'role' => 'Senior Fellow, Trade Policy', 'sort_order' => 0]);
            Expert::create(['name' => 'Rahul Mehta', 'role' => 'Director, Technology Practice', 'sort_order' => 1]);
            Expert::create(['name' => 'Sara Lindqvist', 'role' => 'Fellow, Climate & Energy', 'sort_order' => 2]);
        }
    }
}
