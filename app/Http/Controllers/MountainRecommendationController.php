<?php
namespace App\Http\Controllers;
use App\Http\Requests\MountainRecommendationRequest; use App\Models\{Gear, Mountain, MountainRecommendation}; use Illuminate\Http\Request;
class MountainRecommendationController extends Controller {
 public function index(Request $request){$items=MountainRecommendation::with(['mountain','gear'])->when($request->search,fn($q,$s)=>$q->whereHas('mountain',fn($q)=>$q->where('name','like',"%$s%"))->orWhereHas('gear',fn($q)=>$q->where('name','like',"%$s%")))->latest()->paginate(10)->withQueryString();return view('admin.resources.index',compact('items')+['resource'=>'recommendations','title'=>'Mountain recommendations']);}
 public function create(){return $this->form(new MountainRecommendation,'Add recommendation');}
 public function store(MountainRecommendationRequest $request){MountainRecommendation::create($request->validated());return to_route('admin.recommendations.index')->with('success','Recommendation created successfully.');}
 public function edit(MountainRecommendation $recommendation){return $this->form($recommendation,'Edit recommendation');}
 public function update(MountainRecommendationRequest $request,MountainRecommendation $recommendation){$recommendation->update($request->validated());return to_route('admin.recommendations.index')->with('success','Recommendation updated successfully.');}
 public function destroy(MountainRecommendation $recommendation){$recommendation->delete();return to_route('admin.recommendations.index')->with('success','Recommendation deleted successfully.');}
 private function form($item,$title){return view('admin.resources.form',compact('item','title')+['resource'=>'recommendations','mountains'=>Mountain::orderBy('name')->get(),'gear'=>Gear::orderBy('name')->get()]);}
}
