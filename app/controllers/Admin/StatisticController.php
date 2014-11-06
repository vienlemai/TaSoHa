<?php

namespace Admin;

use \Input;
use \DB;
use \View;

class StatisticController extends AdminBaseController {

    public function index() {
        $month = Input::get('month', \Carbon\Carbon::now()->subMonth()->format('m/Y'));
        $start = \Carbon\Carbon::createFromFormat('m/Y', $month)->startOfMonth();
        $end = \Carbon\Carbon::createFromFormat('m/Y', $month)->endOfMonth();
        $count['members'] = \Member::whereBetween('created_at', array($start, $end))->count();
        $count['bills'] = \Bill::whereBetween('created_at', array($start, $end))->count();
        $count['bills_money'] = \Bill::whereBetween('created_at', array($start, $end))->sum('price');
        $months = \Member::getMonthsLog();
        $statistic = DB::table('statistics')
            ->where('month', $month)
            ->first();
        $bonusDetails = null;
        if ($start !== null) {
            $bonusDetails = \MyBonus::getByMonth($month);
        }
        $this->layout->content = View::make('admin.statistic.index', array(
                'month' => $month,
                'months' => $months,
                'statistic' => $statistic,
                'count' => $count,
                'bonusDetails' => $bonusDetails,
        ));
    }

}
