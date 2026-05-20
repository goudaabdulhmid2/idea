<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Enums\IdeaStatus;
use App\Http\Requests\StoreIdeaRequest;
use App\Http\Requests\UpdateIdeaRequest;
use App\Models\Idea;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class IdeaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
            $user = Auth::user();

            $status = $request->enum('status', IdeaStatus::class);

            $ideas = $user->ideas()
                ->status($status)
                ->latest()
                ->paginate(10);

            return view('idea.index', [
                'ideas' => $ideas,
                'statusCounts' => Idea::statusCounts($user),
            ]);
        }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): void
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreIdeaRequest $request)
    {
        Auth::user()->ideas()->create($request->validated());

        return to_route('ideas')->with('success', 'Idea created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, Idea $idea): View
    {

        return view('idea.show', ['idea' => $idea]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Idea $idea): View
    {
        abort_if($idea->user_id !== Auth::id(), 403);

        return view('idea.edit', ['idea' => $idea]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateIdeaRequest $request, Idea $idea)
    {
        $idea->update($request->validated());

        return to_route('idea.show', $idea)->with('success', 'Idea updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Idea $idea)
    {
        abort_if($idea->user_id !== Auth::id(), 403);

        $idea->delete();

        return to_route('ideas')->with('success', 'Idea deleted successfully.');
    }
}
