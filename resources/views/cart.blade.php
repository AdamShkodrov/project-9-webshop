<x-base-layout>
<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Winkelwagen</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 font-sans text-gray-800">

    <div class="container mx-auto p-6">
        <h1 class="text-3xl font-bold text-center mb-6">Jouw Winkelwagen</h1>

        @if(session('cart') && count(session('cart')) > 0)
            <table class="min-w-full bg-white shadow-md rounded-lg overflow-hidden">
                <thead>
                    <tr class="bg-gray-200 text-gray-700">
                        <th class="py-3 px-6 text-left">Productnaam</th>
                        <th class="py-3 px-6 text-left">Prijs</th>
                        <th class="py-3 px-6 text-left">Aantal</th>
                        <th class="py-3 px-6 text-left">Subtotaal</th>
                        <th class="py-3 px-6 text-left">Acties</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $total = 0;
                        $cart = session('cart');
                    @endphp
                    @foreach($cart as $id => $item)
                        @php
                            $subtotal = $item['price'] * $item['quantity'];
                            $total += $subtotal;
                        @endphp
                        <tr class="border-b border-gray-200 hover:bg-gray-50">
                            <td class="py-4 px-6">{{ $item['name'] }}</td>
                            <td class="py-4 px-6">€{{ number_format($item['price'], 2) }}</td>
                            <td class="py-4 px-6">
                                <form action="{{ route('cart.updateItem', $id) }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <input type="number" name="quantity" value="{{ $item['quantity'] }}" min="1" class="w-16 text-center py-2 px-3 border border-gray-300 rounded-md">
                                    <button type="submit" class="ml-2 bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600 transition duration-200">Update</button>
                                </form>
                            </td>
                            <td class="py-4 px-6">€{{ number_format($subtotal, 2) }}</td>
                            <td class="py-4 px-6">
                                <form action="{{ route('cart.destroy', $id) }}" method="POST" onsubmit="return confirm('Weet je zeker dat je dit item wilt verwijderen?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="bg-red-500 text-white px-4 py-2 rounded-md hover:bg-red-600 transition duration-200">Verwijderen</button>
                                </form>                            
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <div class="mt-6 bg-white p-6 rounded-lg shadow-lg">
                <p class="text-lg font-semibold">Totaal: €{{ number_format($total, 2) }}</p>
            
                @php
                    // Voorbeeld berekening van verzendkosten: als totaal < €50 dan €5, anders gratis
                    $shippingCost = $total < 50 ? 5.00 : 0.00;
                @endphp
                <p class="text-lg font-semibold">Verzendkosten: €{{ number_format($shippingCost, 2) }}</p>
                <p class="text-xl font-bold mt-2">Totaal met verzendkosten: €{{ number_format($total + $shippingCost, 2) }}</p>
            </div>
            


            <div class="mt-6 text-center">
                <a href="{{ route('checkout.index') }}">
                    <button type="button" class="bg-green-500 text-white px-6 py-3 rounded-md hover:bg-green-600 transition duration-200">Ga naar de kassa</button>
                </a>
            </div>
        @else
            <p class="text-center text-gray-600">Je winkelwagen is leeg.</p>
        @endif
    </div>

        @php
            // als totaal < €50 dan €5, anders gratis
            $shippingCost = $total < 50 ? 5.00 : 0.00;
        @endphp
        <p><strong>Verzendkosten: €{{ number_format($shippingCost, 2) }}</strong></p>
        <p><strong>Totaal met verzendkosten: €{{ number_format($total + $shippingCost, 2) }}</strong></p>


</body>
</html>
</x-base-layout>