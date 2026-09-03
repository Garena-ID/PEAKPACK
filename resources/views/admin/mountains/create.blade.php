<!-- {{-- @extends('layouts.admin')

@section('content')
<div class="mb-8">
    <a href="{{ route('admin.mountains.index') }}" class="link text-xs block mb-2">
        ← Kembali ke Daftar Gunung
    </a>
    <h2 class="text-3xl font-black text-forest">Tambah Gunung Baru</h2>
</div>

<div class="card p-6 lg:p-8 max-w-4xl">
    <form method="POST" action="{{ route('admin.mountains.store') }}" class="space-y-6">
        @csrf

        <div class="grid gap-6 md:grid-cols-2">
            <div>
                <label for="name" class="field">
                    <span>Nama Gunung *</span>
                    <input type="text" id="name" name="name" value="{{ old('name') }}" placeholder="Contoh: Gunung Ciremai" class="input" required />
                </label>
                @error('name')
                    <p class="mt-1 text-xs font-bold text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="elevation" class="field">
                    <span>Ketinggian (mdpl) *</span>
                    <input type="number" id="elevation" name="elevation" value="{{ old('elevation') }}" placeholder="Contoh: 3078" min="0" class="input" required />
                </label>
                @error('elevation')
                    <p class="mt-1 text-xs font-bold text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="location" class="field">
                    <span>Lokasi / Kabupaten *</span>
                    <input type="text" id="location" name="location" value="{{ old('location') }}" placeholder="Contoh: Kuningan / Majalengka" class="input" required />
                </label>
                @error('location')
                    <p class="mt-1 text-xs font-bold text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="province" class="field">
                    <span>Provinsi *</span>
                    <input type="text" id="province" name="province" value="{{ old('province') }}" placeholder="Contoh: Jawa Barat" class="input" required />
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
                        <option value="Easy" @selected(old('difficulty') === 'Easy')>Easy (Pemula)</option>
                        <option value="Medium" @selected(old('difficulty') === 'Medium')>Medium (Menengah)</option>
                        <option value="Hard" @selected(old('difficulty') === 'Hard')>Hard (Tingkat Lanjut / Sulit)</option>
                    </select>
                </label>
                @error('difficulty')
                    <p class="mt-1 text-xs font-bold text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="estimated_duration" class="field">
                    <span>Estimasi Durasi Pendakian *</span>
                    <input type="text" id="estimated_duration" name="estimated_duration" value="{{ old('estimated_duration') }}" placeholder="Contoh: 2 Hari 1 Malam" class="input" required />
                </label>
                @error('estimated_duration')
                    <p class="mt-1 text-xs font-bold text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="latitude" class="field">
                    <span>Latitude (Opsional)</span>
                    <input type="text" id="latitude" name="latitude" value="{{ old('latitude') }}" placeholder="Contoh: -6.892300" class="input" />
                </label>
                @error('latitude')
                    <p class="mt-1 text-xs font-bold text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="longitude" class="field">
                    <span>Longitude (Opsional)</span>
                    <input type="text" id="longitude" name="longitude" value="{{ old('longitude') }}" placeholder="Contoh: 108.407600" class="input" />
                </label>
                @error('longitude')
                    <p class="mt-1 text-xs font-bold text-red-600">{{ $message }}</p>
                @enderror
            </div>
        </div>

        <div>
            <label for="description" class="field">
                <span>Deskripsi Gunung (Opsional)</span>
                <textarea id="description" name="description" rows="4" placeholder="Jelaskan karakteristik trek..." class="input">{{ old('description') }}</textarea>
            </label>
            @error('description')
                <p class="mt-1 text-xs font-bold text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <div class="pt-4 border-t border-primary/10 flex items-center justify-end gap-3">
            <a href="{{ route('admin.mountains.index') }}" class="btn-ghost">
                Batal
            </a>
            <button type="submit" class="btn-primary">
                Simpan Gunung
            </button>
        </div>
    </form>
</div> -->
<!-- @endsection --}} -->
@extends('layouts.admin')

{{-- =========================================================
LEAFLET CSS
========================================================= --}}
@push('styles')
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
@endpush

@section('content')

{{-- =====================================================
     HEADER
====================================================== --}}
<div class="mb-8">
    <a href="{{ route('admin.mountains.index') }}" class="link mb-2 block text-xs">
        ← Kembali ke Daftar Gunung
    </a>
    <h2 class="text-3xl font-black text-forest">
        Tambah Gunung Baru
    </h2>
</div>

{{-- =====================================================
     FORM
====================================================== --}}
<div class="card max-w-4xl p-6 lg:p-8">
<form
    method="POST"
    action="{{ route('admin.mountains.store') }}"
    enctype="multipart/form-data"
    class="space-y-6"
>        @csrf

        {{-- =================================================
             DATA GUNUNG
        ================================================== --}}
        <div class="grid gap-6 md:grid-cols-2">

            {{-- Nama Gunung --}}
            <div>
                <label for="name" class="field">
                    <span>Nama Gunung *</span>
                    <input type="text" id="name" name="name" value="{{ old('name') }}" placeholder="Contoh: Gunung Ciremai" class="input" required />
                </label>
                @error('name')
                    <p class="mt-1 text-xs font-bold text-red-600">{{ $message }}</p>
                @enderror
            </div>

            {{-- Ketinggian --}}
            <div>
                <label for="elevation" class="field">
                    <span>Ketinggian (mdpl) *</span>
                    <input type="number" id="elevation" name="elevation" value="{{ old('elevation') }}" placeholder="Contoh: 3078" min="0" class="input" required />
                </label>
                @error('elevation')
                    <p class="mt-1 text-xs font-bold text-red-600">{{ $message }}</p>
                @enderror
            </div>

            {{-- Lokasi --}}
            <div>
                <label for="location" class="field">
                    <span>Lokasi / Kabupaten *</span>
                    <input type="text" id="location" name="location" value="{{ old('location') }}" placeholder="Contoh: Kuningan / Majalengka" class="input" required />
                </label>
                @error('location')
                    <p class="mt-1 text-xs font-bold text-red-600">{{ $message }}</p>
                @enderror
            </div>

            {{-- Provinsi --}}
            <div>
                <label for="province" class="field">
                    <span>Provinsi *</span>
                    <input type="text" id="province" name="province" value="{{ old('province') }}" placeholder="Contoh: Jawa Barat" class="input" required />
                </label>
                @error('province')
                    <p class="mt-1 text-xs font-bold text-red-600">{{ $message }}</p>
                @enderror
            </div>

            {{-- Tingkat Kesulitan --}}
            <div>
                <label for="difficulty" class="field">
                    <span>Tingkat Kesulitan *</span>
                    <select id="difficulty" name="difficulty" class="input" required>
                        <option value="">-- Pilih Tingkat Kesulitan --</option>
                        <option value="Easy" @selected(old('difficulty') === 'Easy')>Easy (Pemula)</option>
                        <option value="Medium" @selected(old('difficulty') === 'Medium')>Medium (Menengah)</option>
                        <option value="Hard" @selected(old('difficulty') === 'Hard')>Hard (Tingkat Lanjut / Sulit)</option>
                    </select>
                </label>
                @error('difficulty')
                    <p class="mt-1 text-xs font-bold text-red-600">{{ $message }}</p>
                @enderror
            </div>

            {{-- Durasi --}}
            <div>
                <label for="estimated_duration" class="field">
                    <span>Estimasi Durasi Pendakian *</span>
                    <input type="text" id="estimated_duration" name="estimated_duration" value="{{ old('estimated_duration') }}" placeholder="Contoh: 2 Hari 1 Malam" class="input" required />
                </label>
                @error('estimated_duration')
                    <p class="mt-1 text-xs font-bold text-red-600">{{ $message }}</p>
                @enderror
            </div>

            {{-- Latitude --}}
            <div>
                <label for="latitude" class="field">
                    <span>Latitude (Opsional)</span>
                    <input type="text" id="latitude" name="latitude" value="{{ old('latitude') }}" placeholder="Klik peta untuk memilih" class="input" />
                </label>
                @error('latitude')
                    <p class="mt-1 text-xs font-bold text-red-600">{{ $message }}</p>
                @enderror
            </div>

            {{-- Longitude --}}
            <div>
                <label for="longitude" class="field">
                    <span>Longitude (Opsional)</span>
                    <input type="text" id="longitude" name="longitude" value="{{ old('longitude') }}" placeholder="Klik peta untuk memilih" class="input" />
                </label>
                @error('longitude')
                    <p class="mt-1 text-xs font-bold text-red-600">{{ $message }}</p>
                @enderror
            </div>

        </div>

        {{-- =================================================
             PETA & PENCARIAN LOKASI
        ================================================== --}}
        <div class="pt-4 border-t border-primary/10">
            <div class="mb-3">
                <h3 class="text-lg font-black text-forest">
                    Pilih Lokasi Gunung
                </h3>
                <p class="mt-1 text-xs text-primary/60">
                </p>
            </div>

            <div class="mb-4 flex gap-2">
                <input 
                    type="text" 
                    id="map-search-input" 
                    placeholder="Cari lokasi (contoh: Gunung Ciremai)..." 
                    class="input flex-1"
                />
                <button 
                    type="button" 
                    id="map-search-btn" 
                    class="btn-primary px-5 py-2.5 text-sm shrink-0"
                >
                    Cari
                </button>
            </div>

            {{-- MAP (Diberi border-radius, shadow tipis, dan pembatas agar terlihat bersih) --}}
            <div
                id="mountain-map"
                class="shadow-sm"
                style="
                    width: 100%;
                    height: 420px;
                    border-radius: 1rem;
                    overflow: hidden;
                    border: 1px solid rgba(0, 0, 0, 0.08);
                    z-index: 1;
                "
            ></div>
        </div>

        {{-- =================================================
             UPLOAD GAMBAR
        ================================================== --}}
        <div> 
            <label for="image" class="field"> 
                <span>Gambar Gunung (Opsional)</span> 

                <input
                    type="file"
                    id="image"
                    name="image"
                    accept=".jpg,.jpeg,.png,.webp"
                    class="input"
                /> 

                <p class="mt-1 text-xs text-primary/60"> 
                    Format yang diizinkan: jpg, jpeg, png, webp. Ukuran maksimal: 2MB. 
                </p> 
            </label> 

            @error('image') 
                <p class="mt-1 text-xs font-bold text-red-600">
                    {{ $message }}
                </p> 
            @enderror 
        </div>

        {{-- =================================================
             DESKRIPSI
        ================================================== --}}
        <div>
            <label for="description" class="field">
                <span>Deskripsi Gunung (Opsional)</span>
                <textarea id="description" name="description" rows="4" placeholder="Jelaskan karakteristik trek..." class="input">{{ old('description') }}</textarea>
            </label>
            @error('description')
                <p class="mt-1 text-xs font-bold text-red-600">{{ $message }}</p>
            @enderror
        </div>

        {{-- =================================================
             BUTTON
        ================================================== --}}
        <div class="flex items-center justify-end gap-3 border-t border-primary/10 pt-4">
            <a href="{{ route('admin.mountains.index') }}" class="btn-ghost">
                Batal
            </a>
            <button type="submit" class="btn-primary">
                Simpan Gunung
            </button>
        </div>

    </form>
</div>

@endsection

{{-- =========================================================
LEAFLET JAVASCRIPT & SEARCH NOMINATIM
========================================================= --}}
@push('scripts')
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>

<script>
    document.addEventListener('DOMContentLoaded', function () {

        const latitudeInput = document.getElementById('latitude');
        const longitudeInput = document.getElementById('longitude');
        const mapElement = document.getElementById('mountain-map');
        const searchInput = document.getElementById('map-search-input');
        const searchBtn = document.getElementById('map-search-btn');

        if (!mapElement) {
            return;
        }

        // Lokasi default: Bandung
        const defaultLatitude = -6.914744;
        const defaultLongitude = 107.609810;

        // Membuat peta
        const map = L.map('mountain-map').setView(
            [defaultLatitude, defaultLongitude],
            10
        );

        // Tile OpenStreetMap
        L.tileLayer(
            'https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png',
            {
                attribution: '&copy; OpenStreetMap contributors'
            }
        ).addTo(map);

        let marker = null;

        // Fungsi untuk memperbarui posisi marker & input
        function updateMarker(lat, lng, popupText = null) {
            latitudeInput.value = lat.toFixed(6);
            longitudeInput.value = lng.toFixed(6);

            if (marker) {
                map.removeLayer(marker);
            }

            marker = L.marker([lat, lng]).addTo(map);

            if (popupText) {
                marker.bindPopup(popupText).openPopup();
            } else {
                marker.bindPopup(`
                    <strong>Lokasi Gunung</strong><br>
                    Latitude: ${lat.toFixed(6)}<br>
                    Longitude: ${lng.toFixed(6)}
                `).openPopup();
            }
        }

        // Jika sebelumnya sudah ada koordinat (dari old input)
        const oldLatitude = parseFloat(latitudeInput.value);
        const oldLongitude = parseFloat(longitudeInput.value);

        if (!isNaN(oldLatitude) && !isNaN(oldLongitude)) {
            map.setView([oldLatitude, oldLongitude], 13);
            updateMarker(oldLatitude, oldLongitude);
        }

        // Klik pada peta
        map.on('click', function (e) {
            updateMarker(e.latlng.lat, e.latlng.lng);
        });

        // Fitur Pencarian menggunakan Nominatim API
        function performSearch() {
            const query = searchInput.value.trim();
            if (!query) return;

            const url = `https://nominatim.openstreetmap.org/search?format=json&q=${encodeURIComponent(query)}`;

            fetch(url)
                .then(response => response.json())
                .then(data => {
                    if (data && data.length > 0) {
                        const lat = parseFloat(data[0].lat);
                        const lon = parseFloat(data[0].lon);
                        
                        map.setView([lat, lon], 13);
                        updateMarker(lat, lon, `<strong>${data[0].display_name}</strong>`);
                    } else {
                        alert('Lokasi tidak ditemukan. Coba kata kunci lain.');
                    }
                })
                .catch(error => {
                    console.error('Error searching location:', error);
                    alert('Terjadi kesalahan saat mencari lokasi.');
                });
        }

        searchBtn.addEventListener('click', performSearch);
        
        searchInput.addEventListener('keypress', function (e) {
            classNames = e.key;
            if (e.key === 'Enter') {
                e.preventDefault();
                performSearch();
            }
        });

    });
</script>
@endpush