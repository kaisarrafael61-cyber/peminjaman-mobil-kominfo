@extends('layouts.app')

@section('content')
<div class="mb-6">
    <h1 class="text-2xl font-bold text-slate-800">Lokasi & Antar Jemput Mobil Dinas</h1>
    <p class="text-sm text-slate-500">Pantau posisi armada mobil dinas Diskominfo yang sedang aktif di lapangan secara real-time.</p>
</div>

<div class="flex flex-col-reverse lg:flex-row gap-6">

    <div class="w-full lg:w-1/3 bg-white p-4 rounded-xl shadow-md border border-slate-100 h-[400px] lg:h-[500px] overflow-y-auto">
        <h3 class="font-semibold text-lg border-b pb-2 mb-3">Armada Aktif</h3>
        
        @forelse($mobilDinas as $mobil)
            <div class="p-3 mb-2 bg-slate-50 rounded-lg border border-slate-200">
                <p class="font-bold text-blue-600">{{ $mobil->nama_mobil }} ({{ $mobil->plat_nomor }})</p>
                <p class="text-xs text-slate-600 mt-1">Sopir/Karyawan: <span class="font-semibold text-slate-800">{{ $mobil->dibawa_oleh }}</span></p>
                <p class="text-[10px] text-slate-400 mt-2">Koordinat: {{ $mobil->latitude }}, {{ $mobil->longitude }}</p>
            </div>
        @empty
            <p class="text-sm text-slate-400 text-center py-8">Tidak ada mobil dinas yang beroperasi saat ini.</p>
        @endforelse
    </div>

    <div class="w-full lg:w-2/3 bg-white p-2 rounded-xl shadow-md border border-slate-100 h-[350px] sm:h-[400px] lg:h-[500px]">
        <div id="map" class="w-full h-full rounded-lg z-0"></div>
    </div>

</div>
@endsection

@push('scripts')
<script>
    // Inisialisasi Peta Leaflet
    var map = L.map('map').setView([-0.502106, 117.153709], 13);

    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '&copy; OpenStreetMap contributors'
    }).addTo(map);

    // Marker Mobil Dinas
    @foreach($mobilDinas as $mobil)
        L.marker([{{ $mobil->latitude }}, {{ $mobil->longitude }}])
            .addTo(map)
            .bindPopup(`
                <div style="font-family: sans-serif;">
                    <b style="color: #2563eb;">{{ $mobil->nama_mobil }}</b><br>
                    <small>Plat: {{ $mobil->plat_nomor }}</small><br>
                    <p style="margin: 0; font-size: 12px; margin-top: 4px;"><b>Pengguna:</b> {{ $mobil->dibawa_oleh }}</p>
                </div>
            `);
    @endforeach
</script>
@endpush