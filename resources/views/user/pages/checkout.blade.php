@extends('user.layout.app')

@section('content')
    <section id="checkout">
        <div class="container mt-5">
            <h1 class="h1-form-booking">Invoice</h1>

            {{-- Display success message if any --}}
            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            {{-- Display error message if any --}}
            @if (session('danger'))
                <div class="alert alert-danger">
                    {{ session('danger') }}
                </div>
            @endif

            <div class="checkout-container" style="background-color: #f8f9fa; padding: 20px; border-radius: 8px;">
                {{-- User information --}}
                <div class="row invoice-info">
                    <div class="col-sm-4 invoice-col">
                        <p><strong>From</strong></p>
                        <address>
                            <strong>Admin.</strong><br>
                            Jl. Ir. H. Juanda, <br>
                            Sidoarjo, Jawa Timur<br>
                            Phone: - <br>
                            Email: -
                        </address>
                    </div>

                    <div class="col-sm-4 invoice-col">
                        <p><strong>To</strong></p>
                        <address>
                            <strong>{{ auth()->user()->name }}</strong><br>
                            {{ auth()->user()->address }}<br>
                            Phone: {{ auth()->user()->phone }}<br>
                            Email: <a href="mailto:{{ auth()->user()->email }}">{{ auth()->user()->email }}</a>
                        </address>
                    </div>

                    <div class="col-sm-4 invoice-col">
                        <p><strong>Order Info</strong></p>
                        <b>Order ID:</b> {{ $order_id }}<br>
                    </div>
                </div>

                {{-- Product table --}}
                <div class="row">
                    <div class="col-12 table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Qty</th>
                                    <th>Product</th>
                                    <th>Subtotal</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($details as $detail)
                                    <tr>
                                        <td>{{ $detail->quantity }}</td>
                                        <td>
                                            @if ($detail->product)
                                                {{ $detail->product->name }}
                                            @elseif ($detail->service)
                                                {{ $detail->service->name }}
                                            @else
                                                Product/Service not found
                                            @endif
                                        </td>
                                        <td>
                                            @if ($detail->product)
                                                Rp.{{ number_format($detail->product->price * $detail->quantity, 0, ',', '.') }}
                                            @elseif ($detail->service)
                                                Rp.{{ number_format($detail->service->price * $detail->quantity, 0, ',', '.') }}
                                            @else
                                                N/A
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

                {{-- Payment and Amount Due --}}
                <div class="row">
                    <!-- accepted payments column -->
                    <div class="d-flex justify-content-end">
                        <div class="table-responsive">
                            <table class="table">
                                <tr>
                                    <th style="width:50%">Subtotal:</th>
                                    <td>Rp.{{ number_format($totalPrice, 0, ',', '.') }}</td>
                                </tr>
                                <tr>
                                    <th>Discount:</th>
                                    <td>Rp.0</td>
                                </tr>
                                <tr>
                                    <th>Total:</th>
                                    <td>Rp.{{ number_format($totalPrice, 0, ',', '.') }}</td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>

                {{-- Print, Submit Payment, Generate PDF buttons --}}
                <div class="row no-print">
                    <!-- ... -->
                </div>

                <!-- ... -->

                <div class="row mt-3">
                    <div class="col-12 d-flex justify-content-end">
                        <button id="pay-button" class="btn btn-success"
                            style="background-color: #00a676; border-color: #00a676;">Pay </button>
                        <form action="" id="submit_form" method="POST">
                            @csrf
                            <input type="hidden" name="json" id="json_callback">
                        </form>

                    </div>
                </div>

                <!-- Tambahkan elemen ini di dalam tampilan HTML checkout -->
                <div id="result-display" style="margin-top: 20px; padding: 10px; border: 1px solid #ccc;"></div>




            </div>

            <!-- Include the Snap.js library -->
            <script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="{{ config('midtrans.client_key') }}">
            </script>
            <script src="https://code.jquery.com/jquery-3.6.0.min.js"
                integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>


            <!-- Dynamically set the Snap Token -->
            <script type="text/javascript">
                // For example trigger on button clicked, or any time you need
                var payButton = document.getElementById('pay-button');
                payButton.addEventListener('click', function () {
                    // Trigger snap popup. @TODO: Replace TRANSACTION_TOKEN_HERE with your transaction token
                    window.snap.pay('{{$snapToken}}', {
                        onSuccess: function(result){
                            /* You may add your own implementation here */
                            console.log(result);
                            send_response_to_form(result);
                        },
                        onPending: function(result){
                            /* You may add your own implementation here */
                            console.log(result);
                            send_response_to_form(result);
                        },
                        onError: function(result){
                            /* You may add your own implementation here */
                            console.log(result);
                            send_response_to_form(result);
                        },
                        onClose: function(){
                            /* You may add your own implementation here */
                            alert('you closed the popup without finishing the payment');
                        }
                    })
                });

                function send_response_to_form(result){
                    document.getElementById('json_callback').value = JSON.stringify(result);

                    // Menampilkan hasil di elemen 'result-display'
                    var resultDisplay = document.getElementById('result-display');
                    resultDisplay.innerHTML = '<strong>Result:</strong><pre>' + JSON.stringify(result, null, 2) + '</pre>';

                    $('#submit_form').submit();
                }
            </script>

        </div> <!-- Close the container div -->
    </section> <!-- Close the checkout section -->
@endsection
