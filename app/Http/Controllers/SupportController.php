<?php

namespace App\Http\Controllers;

use App\Models\SupportTicket;
use Illuminate\Http\Request;

class SupportController extends Controller
{
    public function index()
    {
        $tickets = auth()->user()->supportTickets()->latest()->paginate(20);
        return view('support.index', compact('tickets'));
    }

    public function create()
    {
        return view('support.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'subject' => 'required|string|max:255',
            'description' => 'required|string',
            'priority' => 'required|in:low,medium,high,critical',
        ]);

        SupportTicket::create([
            'user_id' => auth()->id(),
            'subject' => $request->subject,
            'description' => $request->description,
            'priority' => $request->priority,
        ]);

        return redirect()->route('support.index')->with('success', 'Support ticket raised successfully.');
    }

    public function show($id)
    {
        $ticket = SupportTicket::where('user_id', auth()->id())->findOrFail($id);
        return view('support.show', compact('ticket'));
    }
}
