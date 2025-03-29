<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Saving;

class SavingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $boxs = Saving::where('user_id', auth()->id())->paginate(15);

        return view('saving.index', compact('boxs'));
    }

    public function create(Request $request)
    {
        try {

            $validateData = $request->validate([
                'name'          => 'string|required',
                'type'          => 'in:deposit,withdrawal',
                'amount'        => 'numeric',
                'description'   => 'string|nullable'
            ]);
            
            $validateData['user_id'] = auth()->id();

            Saving::create($validateData);

            return to_route('saving.index')->with('success', 'Saving box created successful 👍✅');

        } catch (Exception $e) {

            return $e->getMessage();

        }

    }

    public function edit(int $id)
    {
        $box = Saving::findOrFail($id);

        return view('saving.edit', compact('box'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, int $id)
    {
        try {

            $validateData = $request->validate([
                'name'          => 'string|required',
                'type'          => 'in:deposit,withdrawal',
                'amount'        => 'numeric',
                'description'   => 'string|nullable'
            ]);
            
            Saving::where('user_id', auth()->id())->where('id', $id)->update($validateData);

          return to_route('saving.index')->with('success', 'Saving box created successful 👍✅');


        } catch (Exception $e) {

            echo $e->getMessage();

        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function deletePage(int $id)
    {
        return view('saving.delete', ['box' => Saving::findOrFail($id)]);
    }

    public function delete($id)
    {
        Saving::where('user_id', auth()->id())->where('id', $id)->delete();
        return to_route('saving.index')->with('success', 'Saving box deleted successful 👍✅');
    }
}
