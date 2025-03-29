<?php

namespace App\Http\Controllers;

use PDOException;
use Exception;
use Illuminate\Http\Request;
use App\Models\Goal;
use Illuminate\Support\Facades\Log;

class GoalController extends Controller
{
    protected string $notFound = "goal not found";
    protected $channel;

    public function __construct() 
    {
        $this->channel = Log::build(['driver' => 'single', 'path' => storage_path('logs/notifications.log')]);
    }

    public function index()
    {
        return view('goals.goals', ['goals' => Goal::where('user_id', auth()->id())->orderBy('id', 'DESC')->paginate(15)]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        try {
        
            $validateData = request()->validate([
                'name' => 'string|required',
                'target_amount' => 'numeric|required',
                'current_amount' => 'numeric',
                'due_date' => 'date'
            ]);            

            $validateData['user_id'] = auth()->id();

            Goal::create($validateData);

            Log::stack(['stack' => $this->channel])->info('You have a new "' . $validateData['name'] .  '" Goal', ['user' => auth()->id()]);

            return back()->with('success', 'Goal added successful 👍✅');

        } catch(Exception $e) {
            return response(['status' => 404, 'message' => 'failed', 'error' => $e->getMessage()], 404);
        }
    }

    public function show(int $id)
    {
        try {
            
            $goal = Goal::find($id);

            if($goal->user_id == auth()->id()) {

                $remain = $goal->calcRemainingAmount($goal->target_amount, $goal->current_amount);
                $progress = $goal->calcProgress($goal->target_amount, $goal->current_amount);
                $goal->stats = ['remain_amount' => $remain, 'progress' => $progress];

                return response(['status' => 200, 'message' => 'success', 'data' => $goal], 200);

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
            return view('goals.edit', ['goal' => Goal::find($id)]);    
        } catch (Exception $e) {
            return $e->getMessage();
        }
        
    }

    public function update(Request $request, $id)
    {
        try {
            
            $validateData = $request->validate([
                'name' => 'string',
                'target_amount' => 'integer',
                'current_amount' => 'integer',
                'due_date' => 'date'
            ]);
            
            $goal = Goal::find($id);

            if($goal && $goal->user_id == auth()->id()) {
                $goal->update($validateData);

                Log::stack(['stack' => $this->channel])
                        ->info('You updateed a "' . $validateData['name'] .  '" Goal information', ['user' => auth()->id()]);

                return to_route('goals.index')->with('success', 'Goal updated successful ✅');
            } else {

                return response(['status' => 404, 'message' => 'success', 'error' => $this->notFound], 404);
            }

        } catch(Exception $e) {

            Log::stack(['stack' => $this->channel])->error($e->getMessage(), ['user' => auth()->id()]);
            return response(['status' => 404, 'message' => 'failed', 'error' => $e->getMessage()], 404);
        }
    }

    public function deletePage($id)
    {
        return view('goals.delete', ['goal' => Goal::find($id)]);
    }

    public function delete($id)
    {
        try {
            $goal = Goal::find($id);
            if($goal && $goal->user_id == auth()->id()) {
                $goal->delete();
                Log::stack(['stack' => $this->channel])->info('You deleted a "' . $goal->name .  '" Goal', ['user' => auth()->id()]);
                if(request()->expectsJson()) {
                    return response(['status' => 200, 'message' => 'success'], 200);
                }
                return to_route('goals.index')->with('success', 'Goal deleteed successful ✅');

            } else {
                return response(['status' => 404, 'message' => 'success', 'error' => $this->notFound], 404);
            }
        } catch (PDOException $e) {
            return response(['status' => 404, 'message' => 'failed', 'error' => $e->getMessage()], 404);
        } catch (Exception $e) {
            return response(['status' => 404, 'message' => 'failed', 'error' => $e->getMessage()], 404);
        }
    }

    public function search(String $search) 
    {
        try {
            $searchGoal = Goal::where('name', e($search))->get();
            return response(['status' => 200, 'message' => 'success', 'data' => $searchGoal], 200);
        } catch (PDOException $e) {
            return response(['status' => 404, 'message' => 'failed', 'error' => $e->getMessage()], 404);
        } catch (Exception $e) {
            return response(['status' => 404, 'message' => 'failed', 'error' => $e->getMessage()], 404);
        }
    }
}
