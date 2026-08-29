<?php

namespace App\Http\Controllers;

use App\Http\Requests\MountainRequest;
use App\Models\Mountain;
use Illuminate\Http\Request;

class MountainController extends Controller
{
    public function index(Request $request)
    {
        $query = Mountain::query();

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('province', 'like', "%{$search}%")
                  ->orWhere('location', 'like', "%{$search}%");
            });
        }

        if ($request->filled('difficulty')) {
            $query->where('difficulty', $request->difficulty);
        }

        $mountains = $query->orderBy($request->get('sort', 'name'), $request->get('direction') === 'desc' ? 'desc' : 'asc')
            ->paginate(10)
            ->withQueryString();

        return view('admin.mountains.index', compact('mountains'));
    }

    public function catalog(Request $request)
    {
        $query = Mountain::query();

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('province', 'like', "%{$search}%")
                  ->orWhere('location', 'like', "%{$search}%");
            });
        }

        if ($request->filled('difficulty')) {
            $query->where('difficulty', $request->difficulty);
        }

        $mountains = $query->orderBy('elevation', 'desc')
            ->paginate(9)
            ->withQueryString();

        return view('catalog.mountains', compact('mountains'));
    }

    public function create() 
    { 
        $mountain = new Mountain();
        return view('admin.mountains.create', compact('mountain')); 
    }

    public function store(MountainRequest $request) 
    { 
        Mountain::create($request->validated()); 
        return redirect()->route('admin.mountains.index')->with('success', 'Data gunung berhasil ditambahkan.'); 
    }

    public function edit(Mountain $mountain) 
    { 
        return view('admin.mountains.edit', compact('mountain')); 
    }

    public function update(MountainRequest $request, Mountain $mountain) 
    { 
        $mountain->update($request->validated()); 
        return redirect()->route('admin.mountains.index')->with('success', 'Data gunung berhasil diperbarui.'); 
    }

    public function destroy(Mountain $mountain) 
    { 
        // Check relations if needed
        $mountain->delete(); 
        return redirect()->route('admin.mountains.index')->with('success', 'Data gunung berhasil dihapus.'); 
    }
}
