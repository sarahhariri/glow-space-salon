<?php

namespace App\Http\Controllers;

use App\Models\GiftCard;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class GiftCardController extends Controller
{
    public function giftCards()
    {
        $settings = Setting::firstOrFail();
        return view('gift-cards', compact('settings'));
    }

    public function giftCardsAdmin()
    {
        $giftCards = GiftCard::all();
        return view('admin.giftCards', compact('giftCards'));
    }

    public function updateStatus(Request $request, GiftCard $giftCard)
{
 
   
    $fields = $request->validate([
        'status' => ['required', 'in:pending,paid,sent'],
    ]);

    $giftCard->update([
        'status' => $fields['status'],
    ]);

    return redirect()
        ->route('admin.giftCards')
        ->with('success', 'Gift card status updated successfully.');
}

    public function store(Request $request)
    {
       

        $fields = $request->validate([
            'type' => ['required', 'in:Silver,Gold,Platinum'],
            'amount' => ['required', 'numeric'],
            'sender_name' => ['required', 'string', 'max:100'],
            'recipient_name' => ['required', 'string', 'max:100'],
            'recipient_email' => ['required', 'email', 'max:150'],
            'message' => ['nullable', 'string', 'max:500'],
        ]);

        $prices = [
            'Silver' => 50,
            'Gold' => 100,
            'Platinum' => 200,
        ];

        // Never trust the amount sent from JavaScript.
        $fields['amount'] = $prices[$fields['type']];

        $fields['user_id'] = Auth::check() ? Auth::id() : null;

        $fields['code'] = 'GLOW-' . strtoupper(Str::random(10));

        $fields['status'] = 'pending';

        GiftCard::create($fields);

        return redirect()
            ->route('giftCards')
            ->with('success', 'Your gift card request was submitted successfully.');
    }

    public function deleteGiftCard(GiftCard $giftCard)
{
    $giftCard->delete();

    return redirect()
        ->route('admin.giftCards')
        ->with('success', 'Gift card request deleted successfully.');
}

}
