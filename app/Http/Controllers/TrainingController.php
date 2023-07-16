<?php

namespace App\Http\Controllers;


use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use App\Models\Training;
use App\Models\User;
use App\Models\User_Role;

class TrainingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = Auth::user();
        $role = User_Role::find($user->user_role_id);

        $count = Training::where('active', True)
            ->count();

        $training = Training::where('active', True)
                ->orderBy('name')
                ->take(10)
                ->get();

        // If user is an employer, show all of their training
        if ($role->hasEmployerPerms == True){
            $count = Training::where('user_id', $user->id)
                ->count();

            $training = Training::where('user_id', $user->id)
                ->orderBy('name')
                ->take(10)
                ->get();
        }

        return view('Training.list', [
            'role'  => $role->name,
            'count' => $count/10, // number of pages of results
            'training'  => $training,
            'page'  => 1    
        ]);    
    }

    /**
     * Display a listing of the resource.
     */
    public function page($pagenum)
    {
        $user = Auth::user();
        $role = User_Role::find($user->user_role_id);

        $count = Training::where('active', True)
        ->count();

        $training = Training::where('active', True)
                ->orderBy('name')
                ->skip($pagenum*10)
                ->take(10)
                ->get();

        // If user is an employer, show all of their jobs
        if ($role->hasEmployerPerms == True){
            $count = Training::where('user_id', $user->id)
                ->count();

            $training = Training::where('user_id', $user->id)
                ->orderBy('name')
                ->skip($pagenum*10)
                ->take(10)
                ->get(); 
        }

        return view('Training.list', [
            'count' => $count/10, // number of pages of results
            'training' => $training,
            'page' => $pagenum   
        ]);    
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('Training.create', []);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string', 'max:1000'],
        ]);

        $user = Auth::user();
        $role = User_Role::find($user->user_role_id);

        if ($role->hasEmployerPerms == True or $role->hasAdminAccess == True){
            $training = Training::Create([
                'name' => $request->name,
                'description' => $request->description,
                'shared' => False,
                'active' => True
            ]);

            return back()->with('status', 'Training Created');
        }

        return back()->with('status', 'Failed - You do not have permission to create this resource');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return view('Training.view', [
            'Training' => Training::find($id),
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        return view('Training.edit', [
            'Training' => Training::find($id),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string', 'max:1000'],
        ]);

        $user = Auth::user();
        $role = User_Role::find($user->user_role_id);

        if ($role->hasEmployerPerms == True or $role->hasAdminAccess == True){
            $training = Training::find($id);

            $training->name = $request->name;
            $training->description = $request->description;
            $training->shared = $request->shared;
            $training->active = $request->active;

            $training->save();
            return back()->with('status', 'Training Updated');
        }

        return back()->with('status', 'Failed - You do not have permission to update this resource');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $training = Training::find($id);
        $training->delete();
    }
}
