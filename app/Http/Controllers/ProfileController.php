<?php

namespace App\Http\Controllers;

use App\Models\KycDocument;
use App\Models\Profile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    public function edit()
    {
        $user = auth()->user();
        $profile = $user->profile ?? Profile::create(['user_id' => $user->id]);
        $kycDocs = $user->kycDocuments;
        return view('profile.edit', compact('user', 'profile', 'kycDocs'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'business_name' => 'nullable|string|max:255',
            'shop_name' => 'nullable|string|max:255',
            'address' => 'nullable|string',
            'city' => 'nullable|string|max:100',
            'state' => 'nullable|string|max:100',
            'pincode' => 'nullable|string|max:10',
        ]);

        auth()->user()->update(['name' => $request->name]);

        $profile = auth()->user()->profile;
        if ($profile) {
            $profile->update($request->only('business_name', 'shop_name', 'address', 'city', 'state', 'pincode', 'pan_number', 'gst_number'));
        }

        return back()->with('success', 'Profile updated successfully.');
    }

    public function uploadKyc(Request $request)
    {
        $request->validate([
            'document_type' => 'required|in:aadhaar,pan,voter_id,bank_statement',
            'document_number' => 'required|string|max:100',
            'document' => 'required|file|max:5120|mimes:jpg,jpeg,png,pdf',
        ]);

        $path = $request->file('document')->store('kyc_documents', 'public');

        KycDocument::create([
            'user_id' => auth()->id(),
            'document_type' => $request->document_type,
            'document_path' => $path,
            'document_number' => $request->input('document_number'),
            'status' => 'pending',
        ]);

        return back()->with('success', 'KYC document uploaded. Awaiting verification.');
    }

    public function updatePassword(Request $request)
    {
        $request->validate([
            'current_password' => 'required|string',
            'password' => 'required|string|min:6|confirmed',
        ]);

        $user = auth()->user();

        if (! Hash::check($request->current_password, $user->password)) {
            return back()->withErrors(['current_password' => 'Current password is incorrect.']);
        }

        $user->update(['password' => Hash::make($request->password)]);

        return back()->with('success', 'Password updated successfully.');
    }
}
