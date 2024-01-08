<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use Inertia\Inertia;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        // I used userResource method on laravel to help me arranging and setting up format,conditions before passing it to the UI or Request
        $records = User::all();
        return Inertia::render('Admin/Records/Index', [
            'records' => UserResource::collection($records),
            'counts' => $records->count(),
        ]);
    }

    public function destroy(User $record)
    {
        $rec = $record->delete();

        if($rec) {
            return redirect()->route('user-records.index')->with('message','Successfully deleted a user!');
        }
        // or
        // return response()->json([
        //     'message' => __('message.200')
        // ],200)
    }
    public function show(User $record)
    {
        // I used make() method coz its not working with collection() when you're passing an object

        return Inertia::render('Admin/Records/Show', [
            'record' => UserResource::make($record)
        ]);
    }

    public function edit(User $record)
    {
        return Inertia::render('Admin/Records/Edit', [
            'record' => UserResource::make($record)
        ]);
    }

    public function update(User $record,Request $request)
    {
        $upd = $record->update($request->only(
                'email',
                'name',
                'contact_no'
            ));
        if($upd) {
            return redirect()->route('user-records.index')->with('message','Successfully updated user '. $record->name);
        }
    }
}
