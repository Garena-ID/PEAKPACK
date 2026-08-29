<?php

namespace App\Http\Controllers;

use App\Models\Gear;
use App\Models\Mountain;
use App\Models\Rental;
use App\Models\User;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function index(Request $request)
    {
        $startDate = $request->get('start_date');
        $endDate = $request->get('end_date');
        $status = $request->get('status');

        $query = Rental::with('user', 'rentalItems.gear');

        if ($startDate) {
            $query->whereDate('rental_date', '>=', $startDate);
        }

        if ($endDate) {
            $query->whereDate('rental_date', '<=', $endDate);
        }

        if ($status) {
            $query->where('status', $status);
        }

        $rentals = (clone $query)->latest()->paginate(15)->withQueryString();
        $allFilteredRentals = (clone $query)->get();

        // Metrics
        $totalCustomers = User::where('role', 'customer')->count();
        $totalMountains = Mountain::count();
        $totalGear = Gear::count();
        $totalRentals = Rental::count();
        $filteredRevenue = $allFilteredRentals->where('status', 'Completed')->sum('total_price');

        $statusCounts = [
            'Pending' => Rental::where('status', 'Pending')->count(),
            'On Rent' => Rental::where('status', 'On Rent')->count(),
            'Completed' => Rental::where('status', 'Completed')->count(),
        ];

        return view('admin.reports.index', compact(
            'rentals',
            'totalCustomers',
            'totalMountains',
            'totalGear',
            'totalRentals',
            'filteredRevenue',
            'statusCounts',
            'startDate',
            'endDate',
            'status'
        ));
    }

    public function exportPdf(Request $request)
    {
        $startDate = $request->get('start_date');
        $endDate = $request->get('end_date');
        $status = $request->get('status');

        $query = Rental::with('user', 'rentalItems.gear');

        if ($startDate) {
            $query->whereDate('rental_date', '>=', $startDate);
        }

        if ($endDate) {
            $query->whereDate('rental_date', '<=', $endDate);
        }

        if ($status) {
            $query->where('status', $status);
        }

        $rentals = $query->latest()->get();
        $totalRevenue = $rentals->where('status', 'Completed')->sum('total_price');

        return view('admin.reports.pdf', compact('rentals', 'totalRevenue', 'startDate', 'endDate', 'status'));
    }

    public function exportExcel(Request $request)
    {
        $startDate = $request->get('start_date');
        $endDate = $request->get('end_date');
        $status = $request->get('status');

        $query = Rental::with('user', 'rentalItems.gear');

        if ($startDate) {
            $query->whereDate('rental_date', '>=', $startDate);
        }

        if ($endDate) {
            $query->whereDate('rental_date', '<=', $endDate);
        }

        if ($status) {
            $query->where('status', $status);
        }

        $rentals = $query->latest()->get();

        $filename = 'PeakPack_Laporan_Penyewaan_' . date('Y-m-d_H-i-s') . '.csv';

        $headers = [
            'Content-Type' => 'text/csv; charset=UTF-8',
            'Content-Disposition' => "attachment; filename=\"{$filename}\"",
            'Pragma' => 'no-cache',
            'Cache-Control' => 'must-revalidate, post-check=0, pre-check=0',
            'Expires' => '0',
        ];

        $callback = function () use ($rentals, $startDate, $endDate, $status) {
            $file = fopen('php://output', 'w');
            
            // UTF-8 BOM for Excel compatibility
            fputs($file, "\xEF\xBB\xBF");

            // Header info
            fputcsv($file, ['PEAKPACK OUTDOOR RENTAL PLATFORM']);
            fputcsv($file, ['LAPORAN REKAPITULASI PENYEWAAN']);
            fputcsv($file, ['Periode:', ($startDate ?: 'Awal') . ' s/d ' . ($endDate ?: 'Akhir')]);
            fputcsv($file, ['Filter Status:', $status ?: 'Semua Status']);
            fputcsv($file, ['Tanggal Cetak:', date('d M Y H:i')]);
            fputcsv($file, []);

            // Column Headers
            fputcsv($file, [
                'No',
                'Kode Rental',
                'Nama Customer',
                'Email Customer',
                'Tanggal Sewa',
                'Jatuh Tempo',
                'Tanggal Kembali',
                'Status',
                'Total Biaya (Rp)'
            ]);

            $totalRevenue = 0;
            foreach ($rentals as $index => $r) {
                if ($r->status === 'Completed') {
                    $totalRevenue += $r->total_price;
                }

                fputcsv($file, [
                    $index + 1,
                    $r->rental_code,
                    $r->user->name ?? '-',
                    $r->user->email ?? '-',
                    $r->rental_date ? $r->rental_date->format('Y-m-d') : '-',
                    $r->due_date ? $r->due_date->format('Y-m-d') : '-',
                    $r->return_date ? $r->return_date->format('Y-m-d') : '-',
                    $r->status,
                    $r->total_price
                ]);
            }

            fputcsv($file, []);
            fputcsv($file, ['', '', '', '', '', '', '', 'TOTAL PENDAPATAN (COMPLETED):', $totalRevenue]);

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }
}
