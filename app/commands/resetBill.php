<?php

use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;

class resetBill extends Command {
    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'bill:reset';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Reset bills';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct() {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function fire() {
        DB::table('member_bonus')
            ->update(array('auto_amount' => 0));
        $this->line('Clear member_bonus');
        DB::table('team_bonus')
            ->update(array(
                'left_left' => 0,
                'right_left' => 0,
                'need_to_up' => false
        ));
        $this->line('Clear team_bonus');
        DB::table('members')
            ->update(array(
                'score' => 0,
                'regency' => ''
        ));
        $this->line('Clear score, regency of members');
        DB::table('second_scores')
            ->truncate();
        $this->line('truncate second_scores');
        DB::table('bills')
            ->truncate();

//        
//        $members = Member::get();
//        foreach ($members as $member) {
//        $random = rand(15, 50);
//        $random = $random / 10 * 50;
//            $bill = new Bill(array(
//                'product_name' => 'mua ' . str_random(10),
//                'price' => $random * 20,
//                'score' => $random,
//                'member_id' => $member->id
//            ));
//            $bill->forceSave();
//        }
    }

    /**
     * Get the console command arguments.
     *
     * @return array
     */
    protected function getArguments() {
        return array(
            //array('example', InputArgument::REQUIRED, 'An example argument.'),
        );
    }

    /**
     * Get the console command options.
     *
     * @return array
     */
    protected function getOptions() {
        return array(
            //array('example', null, InputOption::VALUE_OPTIONAL, 'An example option.', null),
        );
    }

}
