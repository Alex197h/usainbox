<?php

namespace App\Http\Controllers;

use App\Question;
use App\ShippingOffer;
use App\TransportOffer;
use App\TypeVehicle;
use App\User;
use App\Vehicle;
use DB;
use Illuminate\Http\Request;

class AdminController extends Controller {
    public function __construct(){
        $this->middleware('admin');
    }
    
    public function home(){
        
        $countRegDays = DB::select(
            'SELECT date(created_at) AS day, count(*) AS nb
            FROM users WHERE created_at >= date(:date)
            GROUP BY date(created_at)', ['date' => date('Y-m-d', strtotime(' -7 days'))]);
        $countRegDaysRes = [];
        foreach($countRegDays as $a){
            $countRegDaysRes[$a->day] = $a->nb;
        }
        
        $countVehicles = DB::select(
            'SELECT DISTINCT t.label AS vehicle, COUNT(*) AS nb
            FROM vehicles v JOIN type_vehicles t ON v.type_vehicle_id=t.id
            GROUP BY t.label ORDER BY nb DESC');
        
        $countVehiclesRes = [];
        $totVehicles = 0;
        foreach($countVehicles as $a){
            $countVehiclesRes[$a->vehicle] = $a->nb;
            $totVehicles += $a->nb;
        }
        
        
        return view('admin.home', [
            'colors' => [
                "#BDC3C7", "#9B59B6",
                "#E74C3C", "#26B99A",
                "#3498DB","#F2B968",
                "#2C3E50", "#6A7987",
                "#2C3E50", "#377A88",
            ],
            'stats' => (Object)[
                'countUsers' => User::count(),
                'countDailyUsers' => User::whereDate('created_at', '=', date('Y-m-d'))->count(),
                'countDailyLogUsers' => User::whereDate('updated_at', '=', date('Y-m-d'))->count(),
                'countMales' => User::where('gender', 1)->count(),
                'countFemales' => User::where('gender', 0)->count(),
                'countTOffers' => TransportOffer::whereDate('created_at', '=', date('Y-m-d'))->count(),
                'countTOffersPrev' => TransportOffer::whereDate('created_at', '=', date('Y-m-d', strtotime(' -1 day')))->count(),
                'countEOffers' => ShippingOffer::whereDate('created_at', '=', date('Y-m-d'))->count(),
                'countEOffersPrev' => ShippingOffer::whereDate('created_at', '=', date('Y-m-d', strtotime(' -1 day')))->count(),
                'countAges' => [
                    '- de 20 ans' => User::whereDate('birthday', '>=', date('Y', strtotime(' -19 years')).'-01-01')->count(),
                    '20 - 25 ans' => User::whereDate('birthday', '<=', date('Y', strtotime(' -20 years')).'-01-01')->whereDate('birthday', '>', date('Y', strtotime(' -25 years')).'-01-01')->count(),
                    '25 - 30 ans' => User::whereDate('birthday', '<=', date('Y', strtotime(' -25 years')).'-01-01')->whereDate('birthday', '>', date('Y', strtotime(' -30 years')).'-01-01')->count(),
                    '30 - 35 ans' => User::whereDate('birthday', '<=', date('Y', strtotime(' -30 years')).'-01-01')->whereDate('birthday', '>', date('Y', strtotime(' -35 years')).'-01-01')->count(),
                    '35 - 40 ans' => User::whereDate('birthday', '<=', date('Y', strtotime(' -35 years')).'-01-01')->whereDate('birthday', '>', date('Y', strtotime(' -40 years')).'-01-01')->count(),
                    '40 - 45 ans' => User::whereDate('birthday', '<=', date('Y', strtotime(' -40 years')).'-01-01')->whereDate('birthday', '>', date('Y', strtotime(' -45 years')).'-01-01')->count(),
                    '45 - 50 ans' => User::whereDate('birthday', '<=', date('Y', strtotime(' -45 years')).'-01-01')->whereDate('birthday', '>', date('Y', strtotime(' -50 years')).'-01-01')->count(),
                    '50 - 55 ans' => User::whereDate('birthday', '<=', date('Y', strtotime(' -50 years')).'-01-01')->whereDate('birthday', '>', date('Y', strtotime(' -55 years')).'-01-01')->count(),
                    '55 - 60 ans' => User::whereDate('birthday', '<=', date('Y', strtotime(' -55 years')).'-01-01')->whereDate('birthday', '>', date('Y', strtotime(' -60 years')).'-01-01')->count(),
                    '60 ans et +' => User::whereDate('birthday', '<=', date('Y', strtotime(' -60 years')).'-01-01')->count(),
                ],
                'countRegDays' => $countRegDaysRes,
                'countVehicles' => $totVehicles,
                'countEachVehicles' => $countVehiclesRes,
            ]
        ]);
    }
    
    public function page(Request $request = null, $page, $type = '', $id = null){
        $this->post = $request && $request->isMethod('post');
        if(method_exists($this, $page)) return $this->$page($type, $id, $request);
        else return $this->home();
        
    }
    
    public function users($page = '', $id = null, $request){
        if($page == 'edit'){
            $user = User::find($id);
            if($user){
                $part = session()->has('part') ? session('part') : 'profil';
                
                if($this->post && $request->has('save_user')){
                    $user->last_name = $request->get('last_name');
                    $user->first_name = $request->get('first_name');
                    $user->email = $request->get('email');
                    $user->phone = $request->get('phone');
                    $user->gender = $request->get('gender');
                    $user->birthday = $request->get('birthday');
                    $user->description = $request->get('description');
                    $user->help_charge = $request->get('help_charge') == 1 ? 1 : 0;
                    $user->is_admin = $request->get('is_admin') == 1 ? 1 : 0;
                    
                    if($request->has('password')){
                        $user->password = bcryp($request->get('password'));
                    }
                    
                    if($user->isDirty()){
                        $user->save();
                    }
                    return back()->with('part', 'profil');
                }
                else if($this->post && $request->has('rem_vehicle')){
                    $vehicle = Vehicle::find($request->input('rem_vehicle'));
                    $vehicle->delete();
                    return back()->with('part', 'vehicle');
                }
                else if($this->post && $request->has('save_vehicle')){
                    $vehicle = Vehicle::find($request->input('save_vehicle'));
                    
                    if(!$vehicle){
                        $vehicle = new Vehicle();
                        $vehicle->user_id = $user->id;
                    }
                    
                    $vehicle->car_brand = $request->input('car_brand');
                    $vehicle->car_model = $request->input('car_model');
                    $vehicle->type_vehicle_id = $request->input('type_vehicle_id');
                    
                    $vehicle->max_volume = $request->input('max_volume') ?: 0;
                    $vehicle->max_weight = $request->input('max_weight') ?: 0;
                    $vehicle->max_width = $request->input('max_width') ?: 0;
                    $vehicle->max_length = $request->input('max_length') ?: 0;
                    $vehicle->max_height = $request->input('max_height') ?: 0;
                    
                    if($request->has('default')) $vehicle->setDefault();
                    
                    if($vehicle->isDirty()){
                        $vehicle->save();
                    }
                    return back()->with('part', 'vehicle');
                }
                
                
                $v = new Vehicle();
                $user->vehicles->push($v);
                
                
                return view('admin.edit_user', [
                    'part' => $part,
                    'user' => $user,
                    'vehicles' => $user->vehicles,
                    'type_vehicles' => TypeVehicle::all()
                ]);
            }
        }
        
        $users = User::all();
        return view('admin.users', [
            'users' => $users
        ]);
    }
    
    public function vehicles($page = '', $id = null, $request){
        if($this->post){
            if($page == 'remove'){
                $type = TypeVehicle::find($id);
                if($type && $type->delete()){
                    Vehicle::where('type_vehicle_id', $type->id)->update(['type_vehicle_id' => '1']);
                    return '{"delete": true, "name": "'.$type->label.'"}';
                } else return '{"delete": false}';
            }
            else if($page == 'save'){
                $type = TypeVehicle::find($id);
                $t = 'none';
                $old = $type ? $type->label : '';
                
                if($request->label && $request->label != ''){
                    if(!$type){
                        $type = new TypeVehicle();
                        $t = 'create';
                    }
                    $type->label = $request->label;
                    
                    if($type->isDirty()){
                        $type->save();
                        if($t == 'none') $t = 'update';
                    }
                }
                
                return json_encode([
                    'type' => $t,
                    'id' => $type->id,
                    'label' => ($type ? $type->label : ''),
                    'old' => $old,
                ]);
            }
            else if($page == 'editmodel'){
                foreach($request->models as $k => $a){
                    Vehicle::where('car_model', $k)->update(['car_model' => $a]);
                }
                
                return json_encode([
                    'success' => 'update'
                ]);
            }
            else if($page == 'editbrandname'){
                Vehicle::where('car_brand', $request->old)->update(['car_brand' => $request->new]);
                return json_encode([
                    'success' => 'savedname'
                ]);
            }
        }
        
        
        $res_brands = Vehicle::select('car_brand', 'car_model')->orderBy('car_brand')->distinct()->get();
        
        $brands = [];
        foreach($res_brands as $res){
            $brands[$res->car_brand][] = $res->car_model;
        }
        
        $vehicles = TypeVehicle::orderBy('label')->get();
        return view('admin.vehicles', [
            'part' => 'default',
            'brands' => $brands,
            'types_vehicles' => $vehicles
        ]);
    }
    
    public function transports($page = '', $id = null, $request){
        if($page == 'edit'){
            $part = 'default';
            $transport = TransportOffer::with('vehicle.user', 'steps')->find($id);
            if($transport){
                if($this->post){
                    if($request->has('save_infos')){
                        $transport->date_start = $request->date_start;
                        $transport->max_weight = $request->max_weight ?: 0;
                        $transport->max_volume = $request->max_volume ?: 0;
                        $transport->max_length = $request->max_length ?: 0;
                        $transport->max_width = $request->max_width ?: 0;
                        $transport->max_height = $request->max_height ?: 0;
                        $transport->description = $request->description;
                        $transport->is_regular = $request->is_regular ?: 0;
                        $transport->highway = $request->highway ?: 0;
                        $transport->detour = $request->detour ?: 0;
                        $transport->full = $request->full ?: 0;
                        
                        if($transport->isDirty()){
                            $transport->save();
                        }
                        redirect()->back();
                    }
                    else if($request->has('save_steps')){
                        $part = 'steps';
                    }
                }
                
                return view('admin.edit_transport', [
                    'part' => $part,
                    'transport' => $transport,
                    'user' => $transport->user,
                    'steps' => $transport->steps,
                ]);
            }
        }
        
        return view('admin.transports', [
            'transports' => TransportOffer::with('vehicle.user')->get()
        ]);
    }
    
    public function comments($page = '', $id = null, $request){
        if($page == 'rem'){
            $q = Question::find($id);
            if($q){
                $q->delete();
                return json_encode([
                    'success' => true
                ]);
            } return json_encode([]);
        }
        
        return view('admin.questions', [
            'questions' => Question::with('user')->get()
        ]);
    }
}
