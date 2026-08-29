<?php
namespace App\Http\Controllers;
use App\Http\Requests\GearRequest; use App\Models\Gear; use App\Models\GearCategory; use Illuminate\Http\Request;
class GearController extends Controller {
 public function index(Request $request){$items=$this->query($request)->paginate(10)->withQueryString();return view('admin.resources.index',compact('items')+['resource'=>'gear','title'=>'Gear inventory']);}
 public function catalog(Request $request){$gear=$this->query($request)->where('stock','>',0)->paginate(12)->withQueryString();$categories=GearCategory::orderBy('name')->get();return view('catalog.gear',compact('gear','categories'));}
 public function create(){return view('admin.resources.form',['resource'=>'gear','title'=>'Add gear','item'=>new Gear,'categories'=>GearCategory::orderBy('name')->get()]);}
 public function store(GearRequest $request){Gear::create($request->validated());return to_route('admin.gear.index')->with('success','Gear created successfully.');}
 public function edit(Gear $gear){return view('admin.resources.form',['resource'=>'gear','title'=>'Edit gear','item'=>$gear,'categories'=>GearCategory::orderBy('name')->get()]);}
 public function update(GearRequest $request,Gear $gear){$gear->update($request->validated());return to_route('admin.gear.index')->with('success','Gear updated successfully.');}
 public function destroy(Gear $gear){if($gear->rentalItems()->exists())return back()->with('error','Gear with rental history cannot be deleted.');$gear->delete();return to_route('admin.gear.index')->with('success','Gear deleted successfully.');}
 private function query(Request $r){return Gear::with('category')->when($r->search,fn($q,$s)=>$q->where('name','like',"%$s%"))->when($r->category_id,fn($q,$id)=>$q->where('category_id',$id))->orderBy($r->get('sort','name'),$r->get('direction')==='desc'?'desc':'asc');}
}
