@extends('user.layout.app')
@section('content')
    <section id="booking">
        <div>
            <div class="mt-5">
                <div class="row">
                    <div class="col-7">
                        <h1 class="h1-form-booking">Booking Information</h1>
                        <div class="mt-4">
                            <div class="mb-4">
                                <label for="name" class="form-label label-booking">Name</label>
                                <input name="name" value="{{ $data->User->name }}" placeholder="Yamaha, Honda ..."
                                    type="text" class="form-control input-booking  text-dark w-75" disabled
                                    id="name" aria-describedby="emailHelp">
                            </div>
                            <div class="mb-4">
                                <label for="merk" class="form-label label-booking">Merk</label>
                                <input name="merk" value="{{ $data->Queue->merk }}" placeholder="Yamaha, Honda ..."
                                    type="text" class="form-control input-booking  text-dark w-75" disabled
                                    id="merk" aria-describedby="emailHelp">
                            </div>
                            <div class="mb-4">
                                <label for="type" class="form-label label-booking">Number Plate</label>
                                <input name="number_plate" value="{{ $data->Queue->number_plate }}" placeholder="BL-351-GA"
                                    type="text" class="form-control input-booking text-dark w-75" disabled id="type"
                                    aria-describedby="emailHelp">
                            </div>
                            <div class="mb-4">
                                <label for="tanggal" class="form-label label-booking">Date</label>
                                <input type="date" class="form-control text-dark w-75"
                                    value="{{ \Carbon\Carbon::parse($data->time)->format('Y-m-d') }}" name="date"
                                    disabled id="tanggal" aria-describedby="emailHelp">

                            </div>
                            <div class="mb-4">
                                <label for="permasalahan" class="form-label label-booking">Problem</label>
                                <textarea disabled class="form-control  input-booking text-dark w-75 p-4" name="problem" id="permasalahan"
                                    cols="30" rows="10">{{ $data->Queue->problem }}</textarea>
                            </div>
                        </div>
                    </div>
                    <div class="col-5">
                        <h1 class="h1-form-booking">Transaction</h1>
                        <div class="mt-4">
                            <ul class="list-group">
                                @foreach ($details as $detail)
                                    <li class="list-group-item px-3 py-4 d-flex justify-content-between">
                                        <p class="my-auto">
                                            @if ($detail->product)
                                                {{ $detail->quantity }} x {{ $detail->product->name }}
                                            @elseif ($detail->service)
                                                {{ $detail->quantity }} x {{ $detail->service->name }}
                                            @else
                                                Product/Service not found
                                            @endif
                                        </p>
                                        <h5>
                                            @if ($detail->product)
                                                Rp.{{ number_format($detail->product->price * $detail->quantity, 0, ',', '.') }}
                                            @elseif ($detail->service)
                                                Rp.{{ number_format($detail->service->price * $detail->quantity, 0, ',', '.') }}
                                            @else
                                                N/A
                                            @endif
                                        </h5>
                                    </li>
                                @endforeach
                                <li class="list-group-item px-3 py-4 d-flex justify-content-between total">
                                    <p class="my-auto text-light">Total</p>
                                    <h5 class="text-dark">Rp.{{ number_format($data->total_price, 0, ',', '.') }}</h5>
                                </li>
                                <li class="list-group-item p-0 py-3" style="border: none">
                                    @if ($data->Queue->status === 1)
                                        @if ($data->Queue->transaction->payment_status === 'paid')
                                            <!-- Jika 'Queue' status adalah 1 dan 'Transaction' payment_status adalah 'paid', tampilkan keterangan 'Paid' -->
                                            <button class="btn-booking p-0 w-100"
                                                style="border-radius: 5px; background-color: #28a745; color: #fff;"
                                                disabled>
                                                Paid
                                            </button>
                                        @else
                                            <!-- Jika 'Queue' status adalah 1 dan payment_status bukan 'paid', tampilkan button "Bayar Sekarang" (disabled jika diperlukan) -->
                                            <button id="pay-button" class="btn-booking p-0 w-100"
                                                style="border-radius: 5px">
                                                Pay Now
                                            </button>
                                        @endif
                                    @elseif ($data->Queue->status === 0)
                                        <!-- Jika 'Queue' status adalah 0, tampilkan keterangan 'Pending' -->
                                        <button class="btn-booking p-0 w-100"
                                            style="border-radius: 5px; background-color: #dfa700; color: white;" disabled>
                                            Pending
                                        </button>
                                    @else
                                        <!-- Jika 'Queue' status bukan 0 atau 1, tampilkan keterangan 'Canceled' -->
                                        <button class="btn-booking p-0 w-100"
                                            style="border-radius: 5px; background-color: #dc3545; color: #fff;" disabled>
                                            Canceled
                                        </button>
                                    @endif
                                </li>
                            </ul>
                        </div>
                    </div>

                </div>
            </div>
    </section>
<<<<<<< HEAD
      
     <script type="text/javascript" src="https://app.midtrans.com/snap/snap.js">
=======
    <script type="text/javascript" src="https://app.midtrans.com/snap/v1/transactions"
>>>>>>> 562b7654275ed848d96b497654446c0be45c3669
        data-client-key="{{ config('midtrans.client_key') }}"></script>
    <script type="text/javascript">
        var payButton = document.getElementById('pay-button');
        payButton.addEventListener('click', function() {
            window.snap.pay('{{ $snapToken }}', {
                onSuccess: function(result) {

                    // Redirect to the 'user.payment.finish' route
<<<<<<< HEAD
                     window.location.href = '{{ route('user.payment.finish') }}';
=======
                    window.location.href = '{{ route('user.payment.finish') }}';
>>>>>>> 562b7654275ed848d96b497654446c0be45c3669
                },
                onPending: function(result) {

                    // Redirect to the 'user.payment.unfinish' route
                    window.location.href = '{{ route('user.payment.unfinish') }}';
                },
                onError: function(result) {
                    // Redirect to the 'user.payment.error' route or display an error message
                    window.location.href = '{{ route('user.payment.error') }}';
                },
                onClose: function() {
                    // Handle closure if needed
                }
            });
        });
    </script>



@endsection
