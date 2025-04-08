<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Coupon;

class CheckoutController extends Controller
{
    public function index()
    {
        $cart = session()->get('cart', []);
        $total = 0;
        foreach($cart as $item) {
            $total += $item['price'] * $item['quantity'];
        }
        $shippingCost = $total < 50 ? 5.00 : 0.00;
        return view('checkout.index', compact('cart', 'total', 'shippingCost'));
    }

    public function process(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'city' => 'required|string|max:255',
            'postal_code' => 'required|string|max:20',
            'country' => 'required|string|max:255',
            'payment_method' => 'required|string|in:creditcard,paypal,ideal',
        ]);
        // Bereken het totaal op basis van de winkelwagen
        $cart = session()->get('cart', []);
        $total = 0;
        foreach($cart as $item) {
            $total += $item['price'] * $item['quantity'];
        }
        // Verzendkosten (voorbeeld)
        $shippingCost = $total < 50 ? 5.00 : 0.00;
        $finalTotal = $total + $shippingCost;
        if (!empty($validated['coupon_code'])) {
            // Zoek de kortingsbon op basis van de code
            $coupon = Coupon::where('code', $validated['coupon_code'])->first();
            if ($coupon) {
                // Controleer of de coupon nog geldig is (bijv. start- en einddatum, gebruikslimiet, etc.)
                // Dit voorbeeld gaat ervan uit dat de coupon geldig is.
                if ($coupon->discount_type == 'percentage') {
                    // Percentage korting
                    $discountAmount = $finalTotal * ($coupon->discount_value / 100);
                } else { // 'fixed'
                    // Vast bedrag korting
                    $discountAmount = $coupon->discount_value;
                }
                // Zorg ervoor dat de korting niet hoger is dan het totaalbedrag
                $discountAmount = min($discountAmount, $finalTotal);
                $finalTotal -= $discountAmount;
            } else {
                // Als de kortingsbon niet bestaat, kun je een foutmelding tonen of gewoon doorgaan zonder korting
                return redirect()->back()->withErrors(['coupon_code' => 'Ongeldige kortingscode.']);
            }
        }

        // Hier de integratie met de gewenste betalingsgateway toevoegen.
        // Bijvoorbeeld: gebruik Stripe, PayPal, of Mollie. Hieronder een dummy-implementatie:

        // Dummy-check: stel dat de betaling altijd succesvol is.
        $paymentSuccess = true;

        if ($paymentSuccess) {
            session()->forget('cart');

            return redirect()->route('/')->with('success', 'Betaling succesvol afgerond!');
        } else {
            return redirect()->back()->withErrors(['payment' => 'Betaling mislukt. Probeer het opnieuw.']);
        }
    }
}
