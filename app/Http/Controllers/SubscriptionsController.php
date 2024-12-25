<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Subscriptions;

class SubscriptionsController extends Controller
{
    public function subscribe(Request $request)
    {
        $request->validate([
            'email' => 'required|email|unique:subscriptions,email',
        ]);
        Subscriptions::create([
            'email' => $request->email,
        ]);
        return back()->with('success', 'Thank you for subscribing!');
    }

    public function showSubscriptions()
    {
        $subscriptions = Subscriptions::all();
        return view('admin.subscriptions.subscrip', compact('subscriptions'));
    }

    public function delete($id)
    {
        
        $subscription = Subscriptions::findOrFail($id);
        $subscription->delete();

        
        return redirect()->route('admin.subscriptions')->with('success', 'Subscription deleted successfully!');
    }
}
