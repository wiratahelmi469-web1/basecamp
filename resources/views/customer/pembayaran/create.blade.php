@extends('customer.layouts.app')

@section('content')

<div class="max-w-3xl mx-auto px-6 py-10">

    <div class="bg-white rounded-2xl shadow p-8">

        <h1 class="text-3xl font-bold mb-6">
            Pembayaran Sewa
        </h1>

        <div class="mb-8">

            <p>
                Kode Sewa :
                <strong>
                    {{ $sewa->kode_sewa }}
                </strong>
            </p>

            <p class="mt-2">
                Total Tagihan :
                <strong class="text-green-600">
                    Rp {{ number_format(
                        $sewa->total_harga + $sewa->total_deposit,
                        0,
                        ',',
                        '.'
                    ) }}
                </strong>
            </p>

        </div>

        <form
            method="POST"
            action="{{ route('pembayaran.store',$sewa->id) }}"
            enctype="multipart/form-data">

            @csrf

            <div class="mb-5">

                <label class="block mb-2">
                    Metode Pembayaran
                </label>

                <select
                    name="metode"
                    class="w-full border rounded-xl p-3">

                    <option value="transfer_bank">
                        Transfer Bank
                    </option>

                    <option value="qris">
                        QRIS
                    </option>

                    <option value="ewallet">
                        E-Wallet
                    </option>

                </select>

            </div>

            <div class="mb-5">

                <label class="block mb-2">
                    Bukti Pembayaran
                </label>

                <input
                    type="file"
                    name="bukti_bayar"
                    class="w-full border rounded-xl p-3">

            </div>

            <div class="mb-5">

                <label class="block mb-2">
                    Catatan
                </label>

                <textarea
                    name="catatan"
                    rows="4"
                    class="w-full border rounded-xl p-3"></textarea>

            </div>

            <button
                class="w-full bg-green-600 hover:bg-green-700 text-white py-3 rounded-xl">

                Kirim Pembayaran

            </button>

        </form>

    </div>

</div>

@endsection
