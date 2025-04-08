
<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <title>Afrekenen</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/tailwindcss/dist/tailwind.min.css">
</head>
<body class="bg-gray-100">
    <div class="container mx-auto p-6 bg-white shadow-lg rounded-lg mt-6">
        <h1 class="text-3xl font-bold mb-6">Afrekenen</h1>
        <div class="mb-6">
            <h2 class="text-xl font-semibold">Uw Bestelling</h2>
            <ul>
                @foreach(session('cart', []) as $id => $item)
                    <li class="mb-2">
                        {{ $item['name'] }} – Aantal: {{ $item['quantity'] }} – Prijs: €{{ number_format($item['price'] * $item['quantity'], 2) }}
                    </li>
                @endforeach
            </ul>
            @php
                $total = 0;
                foreach(session('cart', []) as $item) {
                    $total += $item['price'] * $item['quantity'];
                }
                $shippingCost = $total < 50 ? 5.00 : 0.00;
            @endphp
            <p class="mt-4 font-bold">Totaal: €{{ number_format($total, 2) }}</p>
            <p class="font-bold">Verzendkosten: €{{ number_format($shippingCost, 2) }}</p>
            <p class="font-bold">Totaal incl. verzendkosten: €{{ number_format($total + $shippingCost, 2) }}</p>
        </div>
        <form action="{{ route('checkout.process') }}" method="POST" class="space-y-4">
            @csrf
            <div>
                <label for="name" class="block font-medium">Naam:</label>
                <input type="text" id="name" name="name" required class="w-full border-gray-300 rounded-md shadow-sm">
            </div>
            <div>
                <label for="address" class="block font-medium">Adres:</label>
                <input type="text" id="address" name="address" required class="w-full border-gray-300 rounded-md shadow-sm">
            </div>
            <div>
                <label for="city" class="block font-medium">Stad:</label>
                <input type="text" id="city" name="city" required class="w-full border-gray-300 rounded-md shadow-sm">
            </div>
            <div>
                <label for="postal_code" class="block font-medium">Postcode:</label>
                <input type="text" id="postal_code" name="postal_code" required class="w-full border-gray-300 rounded-md shadow-sm">
            </div>
            <div>
                <label for="country" class="block font-medium">Land:</label>
                <input type="text" id="country" name="country" required class="w-full border-gray-300 rounded-md shadow-sm">
            </div>
            <div>
                <label for="payment_method" class="block font-medium">Kies een betaalmethode:</label>
                <select id="payment_method" name="payment_method" required class="w-full border-gray-300 rounded-md shadow-sm">
                    <option value="creditcard">Creditcard</option>
                    <option value="paypal">PayPal</option>
                    <option value="ideal">iDEAL</option>
                </select>
            </div>
        <div class="mb-6">
            <h2 class="text-xl font-semibold">Kortingsbon toepassen</h2>
            <form action="{{ route('checkout.process') }}" method="POST" id="checkout-form">
                @csrf
                <div class="mb-4">
                    <label for="coupon_code" class="block font-medium">Kortingscode:</label>
                    <input type="text" id="coupon_code" name="coupon_code" placeholder="Voer kortingscode in" class="w-full border-gray-300 rounded-md shadow-sm">
                </div>

            <button type="submit" class="bg-blue-500 text-white px-6 py-3 rounded-md hover:bg-blue-600 transition duration-200">
                Betaal Nu
            </button>
        </form>
    </div>
</body>
</html>
