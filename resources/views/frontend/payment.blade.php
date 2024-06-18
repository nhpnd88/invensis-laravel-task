@extends('layouts.app')

@section('content')
<div class="container">
    <h1>{{ $page->title }}</h1>
    @if ($page->image_url)
        <img src="{{ $page->image_url }}" alt="{{ $page->title }}">
    @endif
    <p>{{ $page->description }}</p>

    @if ($page->isPaymentPage())
        <form id="payment-form">
            <div id="card-element">
                <!-- A Stripe Element will be inserted here. -->
            </div>
            <button id="submit">Pay</button>
        </form>
        <div id="payment-result"></div>

        <script src="https://js.stripe.com/v3/"></script>
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                const stripe = Stripe('{{ env('STRIPE_KEY') }}');
                const elements = stripe.elements();
                const cardElement = elements.create('card');
                cardElement.mount('#card-element');

                const form = document.getElementById('payment-form');
                form.addEventListener('submit', async (event) => {
                    event.preventDefault();

                    const {error, paymentMethod} = await stripe.createPaymentMethod({
                        type: 'card',
                        card: cardElement,
                    });

                    if (error) {
                        document.getElementById('payment-result').textContent = error.message;
                        return;
                    }

                    const response = await fetch("{{ route('payment.intent') }}", {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        },
                        body: JSON.stringify({
                            payment_method_id: paymentMethod.id,
                            amount: {{ $page->price * 100 }}, // amount in cents
                            currency: '{{ $page->currency }}'
                        })
                    });

                    const result = await response.json();

                    if (result.error) {
                        document.getElementById('payment-result').textContent = result.error.message;
                    } else {
                        stripe.confirmCardPayment(result.clientSecret, {
                            payment_method: {
                                card: cardElement
                            }
                        }).then((result) => {
                            if (result.error) {
                                document.getElementById('payment-result').textContent = result.error.message;
                            } else if (result.paymentIntent.status === 'succeeded') {
                                window.location.href = "{{ route('payment.success') }}";
                            } else {
                                window.location.href = "{{ route('payment.failure') }}";
                            }
                        });
                    }
                });
            });
        </script>
    @endif
</div>
@endsection
