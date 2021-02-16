<h1>Your Order Has Been Placed Successfully</h1>
<h2>Order Details:</h2>
<p>Order ID: {{$order->id}}</p>
<p>Order Currency : {{$order->currencies['iso'])}}}</p>
<p>Total Price: {{($order->total_price)+($order->addresses->countries['shipping_charges'])}} </p>
<p>Total Quantity: {{$order->total_quantity}}</p>
<p>Shipping Charges; {{$order->addresses->countries['shipping_charges']}}{{$order->currencies['iso'])}}}</p>
<p>Payment Method: {{$order->payment_type}}</p><br>

<h2>THANKYOU FOR SHOPPING WITH US! SEE YOU AGAIN :)</h2>

