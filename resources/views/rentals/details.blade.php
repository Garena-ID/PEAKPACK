<div class="mb-7 flex items-start justify-between">

<div>
    <a
        class="link text-sm"
        href="{{ auth()->user()->isAdmin()
            ? route('admin.rentals.index')
            : route('rentals.index') }}"
    >
        ← Kembali ke Penyewaan
    </a>

    <h2 class="mt-2 text-3xl font-black">
        {{ $rental->rental_code }}
    </h2>

    <p class="text-primary/60">
        {{ $rental->rental_date->format('d M Y') }}
        —
        {{ $rental->due_date->format('d M Y') }}
    </p>
</div>

<span class="badge">
    {{ $rental->status }}
</span>

</div>

<div class="card max-w-3xl p-6">

<h3 class="font-bold">
    Daftar Perlengkapan
</h3>

<div class="mt-4 space-y-3">

    @foreach($rental->rentalItems as $item)

        <div
            class="flex justify-between border-b border-primary/10 pb-3"
        >
            <span>
                <b>
                    {{ $item->gear->name }}
                </b>

                <small class="block">
                    {{ $item->qty }}
                    ×
                    Rp {{ number_format($item->price, 0, ',', '.') }}
                </small>
            </span>

            <b>
                Rp {{ number_format($item->subtotal, 0, ',', '.') }}
            </b>
        </div>

    @endforeach

</div>

<div class="mt-5 flex justify-between text-lg">
    <b>
        Total
    </b>

    <b>
        Rp {{ number_format($rental->total_price, 0, ',', '.') }}
    </b>
</div>

</div>
