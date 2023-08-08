<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Models\User;
use App\Models\Organizer;
use Illuminate\Support\Facades\Auth;

class CheckOrganizerAccess
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response {

      // This return organizer collection
      $org = $request->route()->parameter('organizer');

      $user = User::find(Auth::id());

      $organizer = Organizer::with('members')->find($org->id);

      // User not an owner or member of this organization return 403 Forbidden
      if ($organizer->owner_id != $user->id && !$organizer->members->contains('id', $user->id)) {
        return abort(403, 'Forbidden');
      }

      $request->merge(['organizer' => $organizer]);
      return $next($request);
    }
}