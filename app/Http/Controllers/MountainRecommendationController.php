<?php

namespace App\Http\Controllers;

use App\Models\Gear;
use App\Models\Mountain;
use App\Models\MountainRecommendation;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\DB;

class MountainRecommendationController extends Controller
{
    public function index(Request $request)
    {
        $query = MountainRecommendation::with(['mountain', 'gear'])
            ->when($request->search, function ($q, $search) {
                $q->whereHas('mountain', function ($q) use ($search) {
                    $q->where('name', 'like', "%{$search}%");
                })
                ->orWhereHas('gear', function ($q) use ($search) {
                    $q->where('name', 'like', "%{$search}%");
                });
            })
            ->latest();

        $recommendations = $query->get();

        // Gabungkan recommendation berdasarkan gunung
        $grouped = $recommendations
            ->groupBy('mountain_id')
            ->map(function ($items) {
                $first = $items->first();

                $first->recommended_gears = $items
                    ->pluck('gear.name')
                    ->implode(', ');

                return $first;
            })
            ->values();

        // Pagination setelah data digabung
        $page = LengthAwarePaginator::resolveCurrentPage();
        $perPage = 10;

        $items = new LengthAwarePaginator(
            $grouped->forPage($page, $perPage),
            $grouped->count(),
            $perPage,
            $page,
            [
                'path' => request()->url(),
                'query' => request()->query(),
            ]
        );

        return view('admin.resources.index', [
            'items' => $items,
            'resource' => 'recommendations',
            'title' => 'Mountain recommendations',
        ]);
    }

    public function create()
    {
        return $this->form(
            new MountainRecommendation(),
            'Add recommendation'
        );
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'mountain_id' => ['required', 'exists:mountains,id'],
            'gear_ids' => ['required', 'array', 'min:1'],
            'gear_ids.*' => ['required', 'exists:gears,id'],
        ], [
            'mountain_id.required' => 'Mountain wajib dipilih.',
            'gear_ids.required' => 'Minimal pilih satu gear.',
            'gear_ids.min' => 'Minimal pilih satu gear.',
        ]);

        DB::transaction(function () use ($data) {
            foreach ($data['gear_ids'] as $gearId) {
                MountainRecommendation::firstOrCreate([
                    'mountain_id' => $data['mountain_id'],
                    'gear_id' => $gearId,
                ]);
            }
        });

        return to_route('admin.recommendations.index')
            ->with('success', 'Recommendations created successfully.');
    }

    public function edit(MountainRecommendation $recommendation)
    {
        $recommendation->load('mountain');

        return $this->form(
            $recommendation,
            'Edit recommendation'
        );
    }

    public function update(
        Request $request,
        MountainRecommendation $recommendation
    ) {
        $data = $request->validate([
            'mountain_id' => ['required', 'exists:mountains,id'],
            'gear_ids' => ['required', 'array', 'min:1'],
            'gear_ids.*' => ['required', 'exists:gears,id'],
        ], [
            'mountain_id.required' => 'Mountain wajib dipilih.',
            'gear_ids.required' => 'Minimal pilih satu gear.',
            'gear_ids.min' => 'Minimal pilih satu gear.',
        ]);

        DB::transaction(function () use ($data, $recommendation) {
            // Hapus semua recommendation lama
            MountainRecommendation::where(
                'mountain_id',
                $recommendation->mountain_id
            )->delete();

            // Buat recommendation baru berdasarkan checkbox
            foreach ($data['gear_ids'] as $gearId) {
                MountainRecommendation::create([
                    'mountain_id' => $data['mountain_id'],
                    'gear_id' => $gearId,
                ]);
            }
        });

        return to_route('admin.recommendations.index')
            ->with('success', 'Recommendations updated successfully.');
    }

    public function destroy(MountainRecommendation $recommendation)
    {
        // Hapus semua gear recommendation untuk gunung tersebut
        MountainRecommendation::where(
            'mountain_id',
            $recommendation->mountain_id
        )->delete();

        return to_route('admin.recommendations.index')
            ->with('success', 'Recommendations deleted successfully.');
    }

    private function form($item, $title)
    {
        // Gear yang sudah dipilih untuk gunung ini
        $selectedGearIds = [];

        if ($item->exists) {
            $selectedGearIds = MountainRecommendation::where(
                'mountain_id',
                $item->mountain_id
            )
                ->pluck('gear_id')
                ->toArray();
        }

        return view(
            'admin.resources.form',
            compact(
                'item',
                'title',
                'selectedGearIds'
            ) + [
                'resource' => 'recommendations',
                'mountains' => Mountain::orderBy('name')->get(),
                'gear' => Gear::orderBy('name')->get(),
            ]
        );
    }
}