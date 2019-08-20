<?php

use Illuminate\Database\Seeder;

use App\Models\Goal;

class GoalSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $goal = new Goal();
        $goal->title = '早起打卡';
        $goal->code = 'morning';
        $goal->start_time = 4;
        $goal->end_time = 10;
        $goal->credits = 10;
        $goal->order_index = 9;
        $goal->repeat = false;
        $goal->save();
        
        $goal = new Goal();
        $goal->title = '晚安打卡';
        $goal->code = 'evening';
        $goal->start_time = 20;
        $goal->end_time = 24;
        $goal->credits = 10;
        $goal->order_index = 8;
        $goal->repeat = true;
        $goal->save();
    }
}
