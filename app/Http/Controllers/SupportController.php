<?php

namespace App\Http\Controllers;

use App\Models\SupportTicket;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Database\QueryException;

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
        $ticketId = null;
        try {
            do {
                $ticketId = 'TKT' . strtoupper(Str::random(8));
            } while (SupportTicket::where('ticket_id', $ticketId)->exists());
        } catch (QueryException $e) {
            // likely the column does not exist on this environment (host) — fall back
            // to creating the ticket without ticket_id. Host should run migrations.
            $ticketId = null;
        }

        $payload = [
            'user_id' => auth()->id(),
            'subject' => $request->subject,
            'description' => $request->description,
            'priority' => $request->priority,
        ];
        if ($ticketId) {
            $payload['ticket_id'] = $ticketId;
        }

        SupportTicket::create($payload);

        return redirect()->route('support.index')->with('success', 'Support ticket raised successfully.');
    }

    public function show($id)
    {
        $ticket = SupportTicket::where('user_id', auth()->id())->findOrFail($id);
        return view('support.show', compact('ticket'));
    }
}
