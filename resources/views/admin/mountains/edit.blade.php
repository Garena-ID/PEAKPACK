@extends('layouts.admin')

@section('content')
<div class="mb-8">
    <a href="{{ route('admin.mountains.index') }}" class="link text-xs block mb-2">
        ← Kembali ke Daftar Gunung
    </a>
    <h2 class="text-3xl font-black text-forest">Edit Data Gunung: {{ $mountain->name }}</h2>
</div>

<div class="card p-6 lg:p-8 max-w-4xl">
    <form method="POST" action="{{ route('admin.mountains.update', $mountain) }}" class="space-y-6">
        @csrf
        @method('PUT')

        <div class="grid gap-6 md:grid-cols-2">
            <div>
                <label for="name" class="field">
                    <span>Nama Gunung *</span>
                    <input type="text" id="name" name="name" value="{{ old('name', $mountain->name) }}" placeholder="Contoh: Gunung Ciremai" class="input" required />
                </label>
                @error('name')
                    <p class="mt-1 text-xs font-bold text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="elevation" class="field">
                    <span>Ketinggian (mdpl) *</span>
                    <input type="number" id="elevation" name="elevation" value="{{ old('elevation', $mountain->elevation) }}" placeholder="Contoh: 3078" min="0" class="input" required />
                </label>
                @error('elevation')
                    <p class="mt-1 text-xs font-bold text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="location" class="field">
                    <span>Lokasi / Kabupaten *</span>
                    <input type="text" id="location" name="location" value="{{ old('location', $mountain->location) }}" placeholder="Contoh: Kuningan / Majalengka" class="input" required />
                </label>
                @error('location')
                    <p class="mt-1 text-xs font-bold text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="province" class="field">
                    <span>Provinsi *</span>
                    <input type="text" id="province" name="province" value="{{ old('province', $mountain->province) }}" placeholder="Contoh: Jawa Barat" class="input" required />
                </label>
                @error('province')
                    <p class="mt-1 text-xs font-bold text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="difficulty" class="field">
                    <span>Tingkat Kesulitan *</span>
                    <select id="difficulty" name="difficulty" class="input" required>
                        <option value="">-- Pilih Tingkat Kesulitan --</option>
                        <option value="Easy" @selected(old('difficulty', $mountain->difficulty) === 'Easy')>Easy (Pemula)</option>
                        <option value="Medium" @selected(old('difficulty', $mountain->difficulty) === 'Medium')>Medium (Menengah)</option>
                        <option value="Hard" @selected(old('difficulty', $mountain->difficulty) === 'Hard')>Hard (Tingkat Lanjut / Sulit)</option>
                    </select>
                </label>
                @error('difficulty')
                    <p class="mt-1 text-xs font-bold text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="estimated_duration" class="field">
                    <span>Estimasi Durasi Pendakian *</span>
                    <input type="text" id="estimated_duration" name="estimated_duration" value="{{ old('estimated_duration', $mountain->estimated_duration) }}" placeholder="Contoh: 2 Hari 1 Malam" class="input" required />
                </label>
                @error('estimated_duration')
                    <p class="mt-1 text-xs font-bold text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="latitude" class="field">
                    <span>Latitude (Opsional)</span>
                    <input type="text" id="latitude" name="latitude" value="{{ old('latitude', $mountain->latitude) }}" placeholder="Contoh: -6.892300" class="input" />
                </label>
                @error('latitude')
                    <p class="mt-1 text-xs font-bold text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="longitude" class="field">
                    <span>Longitude (Opsional)</span>
                    <input type="text" id="longitude" name="longitude" value="{{ old('longitude', $mountain->longitude) }}" placeholder="Contoh: 108.407600" class="input" />
                </label>
                @error('longitude')
                    <p class="mt-1 text-xs font-bold text-red-600">{{ $message }}</p>
                @enderror
            </div>
        </div>

        <div>
            <label for="description" class="field">
                <span>Deskripsi Gunung (Opsional)</span>
                <textarea id="description" name="description" rows="4" placeholder="Jelaskan karakteristik trek..." class="input">{{ old('description', $mountain->description) }}</textarea>
            </label>
            @error('description')
                <p class="mt-1 text-xs font-bold text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <div class="pt-4 border-t border-primary/10 flex items-center justify-end gap-3">
            <a href="{{ route('admin.mountains.index') }}" class="btn-ghost">
                Batal
            </a>
            <button type="submit" class="btn-secondary">
                Perbarui Gunung
            </button>
        </div>
    </form>
</div>
@endsection
