<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;

class WorkoutUserController extends Controller
{
    public function attach(Request $request)
    {

        try {
            $user = User::findOrFail($request->user_id);
            $user->workouts()->attach($request->input('workout_id'));
            return response()->json(['message' => 'Categories attached successfully'], 200);
        } catch (ModelNotFoundException $e) {
            return response()->json(['error' => 'user not found'], 404);
        }
    }

        public
        function detach(Request $request)
        {

            try {
                $user = User::findOrFail($request->user_id);
                $user->workouts()->detach($request->input('workout_id'));
                if ($user) {
                    return response()->json(['message' => 'Categories detached successfully'], 200);
                }
            } catch (ModelNotFoundException $e) {
                return response()->json(['error' => 'user not found'], 404);
            }

        }

        public
        function sync(Request $request)
        {
            try {
                $user = User::findOrFail($request->user_id);
                $user->workouts()->sync($request->input('workout_id'));
                if ($user) {
                    return response()->json(['message' => 'Categories synced successfully'], 200);
                }
            } catch (ModelNotFoundException $e) {
                return response()->json(['error' => 'Product not found'], 404);
            }

        }
    public function showUserWorkouts(Request $request)
    {

        try {
            $user = User::with('workouts')->findOrFail($request->user_id);
            return response()->json($user, 200);
        } catch (ModelNotFoundException $e) {
            return response()->json(['error' => 'user not found'], 404);
        }

    }

}
