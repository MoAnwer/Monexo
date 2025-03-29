<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Models\Goal;

class HomeController extends Controller
{
    public function dashboard() 
    {
       $data = [
        'balance'                    => number_format($this->balance()),
        'totalTransactionsAmount'    => number_format($this->totalTransactionsAmount()),
        'monthIncomeTransactions'    => number_format($this->transactionsByType('income')),
        'monthExpenseTransactions'   => number_format($this->transactionsByType('expense')),
        'monthRemanentTransactions'  => number_format($this->transactionsByType('income') - $this->transactionsByType('expense')),
        'expensePercentage'          => $this->monthExpensePercentage(),
        'incomePercentage'           => $this->monthIncomePercentage(),
        'weeklyProfitAmount'         => $this->weeklyProfit(),
        'topIncomeCategories'        => $this->topCategoriesInCurrentMonth('income'),
        'topExpenseCategories'       => $this->topCategoriesInCurrentMonth('expense'),
        'yearTotalTransactions'      => $this->yearTotalTransactions(),
        'latestGoals'                => $this->latestGoals(),
        'goalsProgress'              => $this->goalsProgress(),
        'latestTransactions'         => $this->latestTransactions(),
       ];

       return view('admin.index', $data);
    }

    public function balance()
    {
        return DB::table('transactions')
                ->selectRaw("SUM(CASE WHEN type = 'income' THEN amount ELSE -amount END) as balance")
                ->where('user_id', auth()->id())
                ->value('balance');

    }

    public function totalTransactionsAmount()
    {
        return DB::table('transactions')
                ->whereBetween('date', [now()->startOfMonth(), now()->endOfMonth()])
                ->where('user_id', auth()->id())
                ->sum('amount');
    }

    public function transactionsByType(String $type) 
    {
        if(!in_array($type, ['expense', 'income']) ) {
            return abort(404);
        } else {
            return DB::table('transactions')
                    ->whereBetween('date', [now()->startOfMonth(), now()->endOfMonth()])
                    ->where('type', trim($type))
                    ->where('user_id', auth()->id())
                    ->sum('amount');
        }
    }

    public function weeklyIncome() 
    {
        return DB::table('transactions')
                ->whereBetween('date', [now()->startOfWeek(), now()->endOfWeek()])
                ->where('type', 'income')
                ->where('user_id', auth()->id())
                ->sum('amount');
    }


    public function monthIncome() 
    {
        return DB::table('transactions')
                ->whereBetween('date', [now()->startOfMonth(), now()->endOfMonth()])
                ->where('type', 'income')
                ->where('user_id', auth()->id())
                ->sum('amount');
    }


    public function weeklyExpense() 
    {
        return DB::table('transactions')
                ->whereBetween('date', [now()->startOfWeek(), now()->endOfWeek()])
                ->where('type', 'expense')
                ->where('user_id', auth()->id())
                ->sum('amount');
    }

    public function monthExpense() 
    {
        return DB::table('transactions')
                ->whereBetween('date', [now()->startOfMonth(), now()->endOfMonth()])
                ->where('type', 'expense')
                ->where('user_id', auth()->id())
                ->sum('amount');
    }

    public function monthExpensePercentage() 
    {
        $expsensePercentageChange = 0;

        $thisMonthExpenses = $this->monthExpense();

        $lastMonthExpenses = DB::table('transactions')
                            ->whereBetween('date', [now()->subMonth()->startOfMonth(), now()->subMonth()->endOfMonth()])
                            ->where('type', 'expense')
                            ->where('user_id', auth()->id())
                            ->sum('amount');

        $expsenseDifference = $thisMonthExpenses - $lastMonthExpenses;


        if($lastMonthExpenses > 0) {
            $expsensePercentageChange = round((($thisMonthExpenses - $lastMonthExpenses) / $lastMonthExpenses) * 100, 1);
        } else {
            $expsensePercentageChange = 0;
        }

        return $expsensePercentageChange < 0 ? 100 + $expsensePercentageChange : $expsensePercentageChange;
    }


    public function monthIncomePercentage() 
    {
        $incomePercentage = 0;

        $thisMonthIncome = $this->monthIncome();
        $thisMonthExpense = $this->monthExpense();

        if($thisMonthIncome > 0) {
            $incomePercentage = round((($thisMonthIncome - $thisMonthExpense) /  $thisMonthIncome) * 100, 1);
        } else {
            $incomePercentage = 0;
        }

        return $incomePercentage;
    }

    public function weeklyProfit()
    {
        $weeklyIncome = $this->weeklyIncome();

        $weeklyExpense = $this->weeklyExpense();

        return number_format($weeklyIncome - $weeklyExpense);
    }


    public function topCategoriesInCurrentMonth(String $type) 
    {
        return DB::table('transactions')
                ->where('type', $type)
                ->whereBetween('date', [now()->startOfMonth(), now()->endOfMonth()])
                ->orderBy('amount', 'DESC')
                ->where('user_id', auth()->id())
                ->selectRaw('SUM(amount) as amount, category, COUNT(id) as count')
                ->groupBy('category')
                ->limit(5)
                ->get();
    }

    public function yearTotalTransactions() 
    {
        return DB::table('transactions')->where('user_id', auth()->id())->whereBetween('date', [now()->startOfYear(), now()->endOfYear()])->count();
    }

    public function latestGoals()
    {
        // i used Goal model not DB for using 'calcProgress()' that exist in Goal model

        return Goal::where('user_id', auth()->id())->orderBy('current_amount', 'DESC')->limit(3)->get();
    }

    public function latestTransactions()
    {
        return DB::table('transactions')->where('user_id', auth()->id())->orderBy('date', 'DESC')->limit(7)->get();
    }

    public function goalsProgress() 
    {
        $progress = 0;
        try {
            if($this->latestGoals()->sum('target_amount') > 0 && $this->latestGoals()->sum('current_amount') > 0) {
              return round( ($this->latestGoals()->sum('current_amount') / $this->latestGoals()->sum('target_amount')) * 100, 1);
            }
        } catch(Throwable $e) {
          $progress = 0;
        }

        return $progress;
    }

}
