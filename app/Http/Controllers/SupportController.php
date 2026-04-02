<?php

namespace App\Http\Controllers;

use App\Models\SupportTicket;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

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

        // generate a short unique ticket id (e.g. TKT8F4A1B2)
        do {
            $ticketId = 'TKT' . strtoupper(Str::random(8));
        } while (SupportTicket::where('ticket_id', $ticketId)->exists());

        SupportTicket::create([
            'user_id' => auth()->id(),
            'ticket_id' => $ticketId,
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
