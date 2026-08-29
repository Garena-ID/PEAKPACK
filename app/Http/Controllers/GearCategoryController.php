<?php
namespace App\Http\Controllers;
use App\Http\Requests\GearCategoryRequest; use App\Models\GearCategory; use Illuminate\Http\Request;
class GearCategoryController extends Controller {
 public function index(Request $request) { $items=GearCategory::withCount('gears')->when($request->search,fn($q,$s)=>$q->where('name','like',"%$s%"))->orderBy('name')->paginate(10)->withQueryString(); return view('admin.resources.index',compact('items')+['resource'=>'gear-categories','title'=>'Gear categories']); }
 public function create(){return view('admin.resources.form',['resource'=>'gear-categories','title'=>'Add category','item'=>new GearCategory]);}
 public function store(GearCategoryRequest $request){GearCategory::create($request->validated());return to_route('admin.gear-categories.index')->with('success','Category created successfully.');}
 public function edit(GearCategory $gearCategory){return view('admin.resources.form',['resource'=>'gear-categories','title'=>'Edit category','item'=>$gearCategory]);}
 public function update(GearCategoryRequest $request,GearCategory $gearCategory){$gearCategory->update($request->validated());return to_route('admin.gear-categories.index')->with('success','Category updated successfully.');}
 public function destroy(GearCategory $gearCategory){if($gearCategory->gears()->exists()) return back()->with('error','A category with gear cannot be deleted.');$gearCategory->delete();return to_route('admin.gear-categories.index')->with('success','Category deleted successfully.');}
}
