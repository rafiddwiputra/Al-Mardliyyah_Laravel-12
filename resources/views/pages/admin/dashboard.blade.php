@extends('layouts.admin')

@section('title', 'Admin Dashboard - Al-Mardliyyah')

@section('content')
<div class="bg-white rounded-2xl border border-gray-100 p-8 shadow-sm">

    {{-- Welcome Message --}}
    <div class="mb-8">
        <h1 class="text-2xl font-bold text-[#1E5631]">Dashboard</h1>
        <p class="text-gray-500 text-sm">Selamat datang di Admin Panel Pondok Pesantren Al-Mardliyyah</p>
    </div>

    {{-- FILTER PERIODE --}}
    <div class="mt-5 mb-6">
        <form method="GET" action="{{ route('admin.dashboard') }}">
            <select name="periode_id"
                onchange="this.form.submit()"
                class="px-4 py-2 text-sm border border-gray-300 rounded-lg bg-white outline-none focus:ring-2 focus:ring-[#1E5631] text-gray-600 min-w-[240px]">
                <option value="">Semua Periode / Tahun</option>
                @foreach($listPeriode as $p)
                    <option value="{{ $p->id_periode }}"
                        {{ request('periode_id') == $p->id_periode ? 'selected' : '' }}>
                        {{ $p->nama_periode }}
                    </option>
                @endforeach
            </select>
        </form>
    </div>

    {{-- Statistik Cards --}}
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-10">
        {{-- Total Pendaftar --}}
        <div class="bg-[#1e4d2b] p-6 rounded-xl shadow-sm text-white flex justify-between items-start">
            <div>
                <p class="text-xs font-bold opacity-80 mb-2">Total Pendaftar</p>
                <h3 class="text-3xl font-bold">{{ $total }}</h3>
            </div>
            <i class="fas fa-users text-2xl opacity-50"></i>
        </div>
        {{-- Santri Diproses --}}
        <div class="bg-[#1e4d2b] p-6 rounded-xl shadow-sm text-white flex justify-between items-start">
            <div>
                <p class="text-xs font-bold opacity-80 mb-2">Santri Diproses</p>
                <h3 class="text-3xl font-bold">{{ $baru }}</h3>
            </div>
            <i class="fas fa-user-plus text-2xl opacity-50"></i>
        </div>
        {{-- Santri Diterima --}}
        <div class="bg-[#1e4d2b] p-6 rounded-xl shadow-sm text-white flex justify-between items-start">
            <div>
                <p class="text-xs font-bold opacity-80 mb-2">Santri Diterima</p>
                <h3 class="text-3xl font-bold">{{ $diterima }}</h3>
            </div>
            <i class="fas fa-user-check text-2xl opacity-50"></i>
        </div>
        {{-- Santri Ditolak --}}
        <div class="bg-[#1e4d2b] p-6 rounded-xl shadow-sm text-white flex justify-between items-start">
            <div>
                <p class="text-xs font-bold opacity-80 mb-2">Santri Ditolak</p>
                <h3 class="text-3xl font-bold">{{ $ditolak }}</h3>
            </div>
            <i class="fas fa-user-times text-2xl opacity-50"></i>
        </div>
    </div>

    {{-- BAGIAN GRAFIK DAN TABEL TERBARU --}}
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mt-8">
    
        <div class="lg:col-span-1 bg-white border border-gray-200 rounded-xl p-6 shadow-sm flex flex-col justify-between">
            <div>
                <h3 class="font-bold text-[#1E5631] mb-4 text-sm">Sumber Informasi Pendaftar</h3>
                <div class="relative w-full" style="height: 220px;">
    <canvas id="sumberInformasiChart"></canvas>
</div>
            </div>

            {{-- KETERANGAN TERBANYAK & TERSEDIKIT --}}
            @if($chartValues->sum() > 0)
            <div class="mt-5 pt-4 border-t border-gray-100">
                <div class="flex justify-between items-center text-sm mb-2">
                    <span class="text-gray-500">Paling Banyak:</span>
                    <span class="font-bold text-[#1E5631]">
                        {{ $sumberTerbanyak->sumber_informasi ?? '-' }} 
                        ({{ $sumberTerbanyak->total ?? 0 }} org)
                    </span>
                </div>
                <div class="flex justify-between items-center text-sm">
                    <span class="text-gray-500">Paling Sedikit:</span>
                    <span class="font-bold text-red-500">
                        {{ $sumberTersedikit->sumber_informasi ?? '-' }} 
                        ({{ $sumberTersedikit->total ?? 0 }} org)
                    </span>
                </div>
            </div>
            @else
            <div class="mt-5 pt-4 border-t border-gray-100 text-center text-sm text-gray-500">
                Belum ada data pendaftar.
            </div>
            @endif
        </div>

        <div class="lg:col-span-2 bg-white border border-gray-200 rounded-xl p-6 shadow-sm flex flex-col">
            <div class="flex justify-between items-center mb-5">
                <h3 class="font-bold text-[#1E5631] text-sm">Pendaftaran Terbaru</h3>
                <a href="{{ route('admin.pendaftar') }}"
                    class="text-xs font-bold px-4 py-2 border border-[#1E5631] rounded-lg text-[#1E5631] hover:bg-[#1E5631] hover:text-white transition">
                    Lihat Semua
                </a>
            </div>
            
            <div class="overflow-x-auto flex-1">
                <table class="w-full border border-[#D9D9D9] border-collapse text-sm">
                    <thead class="border-b border-[#D9D9D9]">
                        <tr class="bg-gray-50">
                            <th class="p-4 text-center font-bold text-black border-r border-[#D9D9D9]">Nama Santri</th>
                            <th class="p-4 text-center font-bold text-black border-r border-[#D9D9D9]">Program Pendidikan</th>
                            <th class="p-4 text-center font-bold text-black border-r border-[#D9D9D9]">Tanggal Daftar</th>
                            <th class="p-4 text-center font-bold text-black border-r border-[#D9D9D9]">Status</th>
                        </tr>
                    </thead>
                    <tbody class="text-gray-700">
                        @forelse($terbaru as $item)
                        <tr class="border-b border-[#D9D9D9] hover:bg-gray-50 transition">
                            <td class="p-3 text-center border-r border-[#D9D9D9]">{{ $item->nama_lengkap }}</td>
                            <td class="p-3 text-center border-r border-[#D9D9D9]">{{ $item->program->nama_program ?? '-' }}</td>
                            <td class="p-3 text-center border-r border-[#D9D9D9]">{{ $item->created_at->format('d/m/Y') }}</td>
                            <td class="p-3 text-center border-r border-[#D9D9D9]">
                                @php
                                $status = ucfirst($item->status ?? 'diproses');
                                $statusColor = match($status) {
                                    'Diproses' => 'bg-[#BFDBFE] text-[#1D4ED8]',
                                    'Diterima' => 'bg-[#DEFFE9] text-[#1E5631]',
                                    'Ditolak'  => 'bg-[#FECACA] text-[#B91C1C]',
                                    default    => 'bg-gray-100 text-gray-600'
                                };
                                @endphp
                                <span class="inline-block w-20 text-center text-xs px-3 py-1.5 rounded-xl font-semibold {{ $statusColor }}">
                                    {{ $status }}
                                </span>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="4" class="p-4 text-center text-gray-500">Belum ada pendaftaran.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
        
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const ctx = document.getElementById('sumberInformasiChart');
        
        if(ctx) {
            new Chart(ctx.getContext('2d'), {
                type: 'doughnut',
                data: {
                    // MENGGUNAKAN ->values()->toJson() AGAR PASTI MENJADI ARRAY []
                    labels: {!! $chartLabels->values()->toJson() !!},
                    datasets: [{
                        data: {!! $chartValues->values()->toJson() !!},
                        backgroundColor: [
                            '#1E5631', '#C6A75E', '#34D399', '#60A5FA', '#F87171', '#A78BFA', '#FBBF24'
                        ],
                        borderWidth: 1,
                        hoverOffset: 4
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            position: 'bottom',
                            labels: {
                                boxWidth: 12,
                                font: { size: 11 }
                            }
                        },
                        tooltip: {
                            callbacks: {
                                label: function(context) {
                                    let label = context.label || '';
                                    let value = context.parsed || 0;
                                    let dataset = context.chart.data.datasets[0].data;
                                    let total = dataset.reduce((a, b) => a + b, 0);
                                    let percentage = total > 0 ? ((value * 100) / total).toFixed(1) + "%" : "0%";
                                    
                                    return ` ${label}: ${value} Pendaftar (${percentage})`;
                                }
                            }
                        }
                    }
                }
            });
        }
    });
</script>
@endsection