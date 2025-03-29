<?php

namespace App\Http\Controllers;

use Exception;
use PDOException;
use Illuminate\Http\Request;
use App\Models\Transaction;
use Illuminate\Support\Facades\Log;

class TransactionController extends Controller
{

    protected string $notFound = "transaction not found";
    protected $channel;

    public function __construct()
    {
        $this->channel = Log::build(['driver' => 'single', 'path' => storage_path('logs/notifications.log')]);
    }

    public function index()
    {   
        $transactions = Transaction::where('user_id', auth()->id())->orderBy('id', 'DESC')->paginate(10);
        
        return view('transactions.index', compact('transactions'));
    }

    public function create()
    {
        try {
            
            $validateData = request()->validate([
                'title' => 'string|required',
                'amount' => 'integer',
                'category' => 'string',
                'type' => 'in:income,expense',
                'date' => 'date',
                'description' => 'string'
            ]);
            
            $validateData['user_id'] = auth()->id();

            $transaction = Transaction::create($validateData);

            Log::stack(['stack' => $this->channel])->info(
                "You have a new '". $validateData['type'] 
                ."' transaction with category '"
                . $validateData['category'] 
                . "' and the amount is " . $validateData['amount'], 
                ['user' => auth()->id() ]
            );

            return response(['status' => 200, 'message' => 'Transaction add successful 👍🏼', 'data' => $transaction], 200);

            // return to_route('transactions.index')->with('success', 'Transaction add successful 👍🏼');

        } catch(Exception $e) {
            return response(['status' => 404, 'message' => 'failed', 'error' => $e->getMessage()], 404);
        }
    }

    
    public function show(int $id)
    {
        try {

            $transaction = Transaction::find($id);
            
            if($transaction && $transaction->user_id == auth()->id()) 
            {
                $transaction->user = $transaction->user->name;
                return response(['status' => 200, 'message' => 'success', 'data' => $transaction], 200);

            } else {
                return response(['status' => 404, 'message' => 'failed', 'error' => $this->notFound], 404);
            }
        } catch (PDOException $e) {
            return response(['status' => 404, 'message' => 'failed', 'error' => $e->getMessage()], 404);
        } catch (Exception $e) {
            return response(['status' => 404, 'message' => 'failed', 'error' => $e->getMessage()], 404);
        }
    }

    
    public function edit(string $id) 
    {
        try {
            return view('transactions.edit', ['transaction' => Transaction::find($id)]);    
        } catch (Exception $e) {
            return $e->getMessage();
        }
        
    }

    public function update(Request $request, int $id)
    {
        try {

            $validateData = request()->validate([
                'title' => 'string',
                'amount' => 'integer',
                'category' => 'string',
                'type' => 'in:income,expense',
                'description'   => 'string'
            ]);
            
            $validateData['user_id'] = auth()->id();

            $transaction = Transaction::find($id);

            if($transaction && $transaction->user_id == auth()->id()) {
                $transaction->update($validateData);
                return to_route('transactions.index')->with('success', 'Transaction updated successful 👍✅');

            } else {
                return response(['status' => 404, 'message' => 'success', 'error' => $this->notFound], 404);
            }
        } catch (PDOException $e) {
            return response(['status' => 404, 'message' => 'failed', 'error' => $e->getMessage()], 404);
        } catch (Exception $e) {
            return response(['status' => 404, 'message' => 'failed', 'error' => $e->getMessage()], 404);
        }
    }

    public function deletePage(int $id) 
    {
        return view('transactions.delete', ['transaction' => Transaction::find($id)]);
    }

    public function delete($id)
    {
        try {

            $transaction = Transaction::find($id);
            
            if($transaction && $transaction->user_id == auth()->id()) {
                $transaction->delete();
                return to_route('transactions.index');
                // return response(['status' => 200, 'message' => 'success'], 200);
            } else {
                return response(['status' => 404, 'message' => 'success', 'error' => $this->notFound], 404);
            }
        } catch (PDOException $e) {
            return response(['status' => 404, 'message' => 'failed', 'error' => $e->getMessage()], 404);
        } catch (Exception $e) {
            return response(['status' => 404, 'message' => 'failed', 'error' => $e->getMessage()], 404);
        }
    }

    public function transactionsByType(String $type) {

        try {
            if(!in_array($type, ['expense', 'income']) ) {
                return response(['status' => 404, 'message' => 'failed', 'error' => 'invalid transaction type'], 404);
            } else {
                $transactions = Transaction::where('type', trim($type))->where('user_id', auth()->id())->paginate(15);
                return response(['status' => 200, 'message' => 'success', 'data' => $transactions], 200);
            }
        } catch (Exception $e) {
            return response(['status' => 404, 'message' => 'failed', 'error' => $e->getMessage()], 404);
        }

    }

    public function transactionsByDate(String $date) 
    {

        try {
            if(!in_array($date, ['today', 'week', 'month', 'year']) ) {
                return response(['status' => 404, 'message' => 'failed', 'error' => 'invalid transaction date'], 404);
            } else {
                if($date == 'today') {
                    $transactions = Transaction::whereBetween('created_at', [now()->startOfDay(), now()->endOfDay()])->where('user_id', auth()->id())->paginate(15);
                } else if($date == 'week') {
                    $transactions = Transaction::whereBetween('created_at', [now()->startOfWeek(), now()->endOfWeek()])->where('user_id', auth()->id())->paginate(15);
                } else if($date == 'month') {
                    $transactions = Transaction::whereBetween('created_at', [now()->startOfMonth(), now()->endOfMonth()])->where('user_id', auth()->id())->paginate(15);
                } else if($date == 'year') {
                    $transactions = Transaction::whereBetween('created_at', [now()->startOfYear(), now()->endOfYear()])->where('user_id', auth()->id())->paginate(15);
                }
                return response(['status' => 200, 'message' => 'success', 'data' => $transactions], 200);
            }
        } catch (Exception $e) {
            return response(['status' => 404, 'message' => 'failed', 'error' => $e->getMessage()], 404);
        }

    }

    public function findTransactionByDate() 
    {
        try {
            $transaction = Transaction::whereDate('created_at', request('date'))->where('user_id', auth()->id())->paginate(15); 
            if($transaction) {
                return response(['status' => 200, 'message' => 'success', 'data' => $transaction], 200);   
            } else {
                return response(['status' => 404, 'message' => 'success', 'error' => $this->notFound], 404);
            }
        } catch (Exception $e) {
            return response(['status' => 404, 'message' => 'failed', 'error' => $e->getMessage()], 404);
        }
    }

    public function weeklyExpensesAmounts() 
    {
        return response()->json(Transaction::selectRaw('SUM(amount) as amount, date')            
                    ->whereBetween('date', [now()->startOfWeek(), now()->endOfWeek()])
                    ->where('type', 'expense')
                    ->orderBy('amount', 'DESC')
                    ->where('user_id', auth()->id())
                    ->groupBy('date')
                    ->limit(7)
                    ->get()
            );
    }
}
