<?php

namespace App\Http\Controllers;


use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use App\Models\Job;
use App\Models\User;
use App\Models\User_Role;

class JobController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = Auth::user();
        $role = User_Role::find($user->user_role_id);

        $count = Job::where('active', True)
            ->count();

        $jobs = Job::where('active', True)
                ->orderBy('name')
                ->take(10)
                ->get();

        // If user is an employer, show all of their jobs
        if ($role->hasEmployerPerms == True){
            $count = Job::where('user_id', $user->id)
                ->count();

            $jobs = Job::where('user_id', $user->id)
                ->orderBy('name')
                ->take(10)
                ->get();
        }

        return view('job.list', [
            'role'  => $role->name,
            'count' => $count/10, // number of pages of results
            'jobs'  => $jobs,
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

        $count = Job::where('active', True)
        ->count();

        $jobs = Job::where('active', True)
                ->orderBy('name')
                ->skip($pagenum*10)
                ->take(10)
                ->get();

        // If user is an employer, show all of their jobs
        if ($role->hasEmployerPerms == True){
            $count = Job::where('user_id', $user->id)
                ->count();

            $jobs = Job::where('user_id', $user->id)
                ->orderBy('name')
                ->skip($pagenum*10)
                ->take(10)
                ->get(); 
        }

        return view('job.list', [
            'count' => $count/10, // number of pages of results
            'jobs' => $jobs,
            'page' => $pagenum   
        ]);    
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('job.create', []);
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
            $job = Job::Create([
                'name' => $request->name,
                'description' => $request->description,
                'filled' => False,
                'active' => True
            ]);

            return back()->with('status', 'Job Created');
        }

        return back()->with('status', 'Failed - You do not have permission to create this resource');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return view('job.view', [
            'job' => Job::find($id),
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        return view('job.edit', [
            'job' => Job::find($id),
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
            $job = Job::find($id);

            $job->name = $request->name;
            $job->description = $request->description;
            $job->filled = $request->filled;
            $job->active = $request->active;

            $job->save();
            return back()->with('status', 'Job Updated');
        }

        return back()->with('status', 'Failed - You do not have permission to update this resource');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $job = Job::find($id);
        $job->delete();
    }
}
