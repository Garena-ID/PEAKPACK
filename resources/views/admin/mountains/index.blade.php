@extends('layouts.admin')

@section('content')
<div class="mb-8 flex flex-wrap items-center justify-between gap-4">
    <div>
        <p class="eyebrow">MASTER DATA</p>
        <h2 class="text-3xl font-black text-forest">Pengelolaan Data Gunung</h2>
    </div>

    <a href="{{ route('admin.mountains.create') }}" class="btn-primary">
        + Tambah Gunung
    </a>
</div>

<!-- Search & Filter Form -->
<form method="GET" action="{{ route('admin.mountains.index') }}" class="card mb-6 grid gap-3 p-4 sm:grid-cols-4 items-center">
    <div class="sm:col-span-2">
        <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari nama gunung, lokasi, atau provinsi..." class="input" />
    </div>

    <div>
        <select name="difficulty" class="input">
            <option value="">Semua Tingkat Kesulitan</option>
            @foreach(['Easy', 'Medium', 'Hard'] as $level)
                <option value="{{ $level }}" @selected(request('difficulty') === $level)>{{ $level }}</option>
            @endforeach
        </select>
    </div>

    <div class="flex gap-2">
        <button type="submit" class="btn-secondary w-full">
            Filter
        </button>
        @if(request()->hasAny(['search', 'difficulty']))
            <a href="{{ route('admin.mountains.index') }}" class="btn-ghost">
                Reset
            </a>
        @endif
    </div>
</form>

<!-- Data Table Card -->
<div class="card p-6 overflow-hidden">
    <div class="overflow-x-auto">
        <table class="w-full text-left text-sm">
            <thead>
                <tr class="border-b border-primary/10 text-xs font-bold uppercase tracking-wider text-primary/60">
                    <th class="py-3">Nama Gunung</th>
                    <th class="py-3">Lokasi & Provinsi</th>
                    <th class="py-3">Ketinggian</th>
                    <th class="py-3">Kesulitan</th>
                    <th class="py-3">Durasi Est.</th>
                    <th class="py-3 text-right">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-primary/5">
                @forelse($mountains as $mountain)
                    <tr>
                        <td class="py-3">
                            <span class="font-bold text-primary block text-base">{{ $mountain->name }}</span>
                        </td>
                        <td class="py-3">
                            <span class="font-semibold text-primary block">{{ $mountain->location }}</span>
                            <span class="text-xs text-primary/60">{{ $mountain->province }}</span>
                        </td>
                        <td class="py-3 font-bold text-primary">
                            {{ number_format($mountain->elevation) }} <span class="text-xs font-normal text-primary/60">mdpl</span>
                        </td>
                        <td class="py-3">
                            <span class="badge">
                                {{ $mountain->difficulty }}
                            </span>
                        </td>
                        <td class="py-3 text-xs font-semibold text-primary/70">
                            ⏱️ {{ $mountain->estimated_duration }}
                        </td>
                        <td class="py-3 text-right">
                            <div class="flex items-center justify-end gap-2">
                                <a href="{{ route('admin.mountains.edit', $mountain) }}" class="btn-ghost text-xs">
                                    Edit
                                </a>
                                <form method="POST" action="{{ route('admin.mountains.destroy', $mountain) }}" onsubmit="return confirm('Apakah Anda yakin ingin menghapus data gunung {{ $mountain->name }}?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn-danger text-xs">
                                        Delete
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="py-8 text-center text-primary/50">
                            Belum ada data gunung. Silakan klik + Tambah Gunung.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    @if($mountains->hasPages())
        <div class="mt-4 pt-4 border-t border-primary/10">
            {{ $mountains->links() }}
        </div>
    @endif
</div>
@endsection
