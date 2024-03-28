<?php

namespace App\Livewire\Telcowidget;

use Livewire\Component;

use App\Models\User;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use App\Helpers\ImageHelper;
use Cache;
use File;
use Illuminate\Support\Facades\Redis;
use App\Models\Tab;
use App\Models\AppVersion;
use App\Models\TelcoWidgetBannerModel;
use \Carbon\Carbon;
class Telcowidget extends Component
{
    use WithFileUploads;

   public $record_id;
    // public $banner_screen;
    public $circle;
    public $login_type;
    public $brand;
    public $plan;
    public $prepaid_persona;
    public $banner_title;
    public $analytics_tag;
    public $mrp;
    public $link_type;
    public $internal_link;
    public $external_link;
    public $device_os;
    public $app_version;
    public $banner_rank;
    public $status="1";
    public $is_pack_expiry_near="1";
    public $is_data_exhausted="1";
    public $rail_title;
    public $rail_view_all;
    public $edit_mode = false;
    public $saved_avatar;
    public $pack_type;
    public $banner_name;
    protected $listeners = [
        'update_banner' => 'updateBanner',
    ];
    protected $rules = [
        'circle'=> 'required',
        'brand'=>'required',
        'banner_title'=> 'required',
        'analytics_tag'=>'required',
        'device_os'=>'required',
        'app_version' => 'required',
        'banner_rank'=> 'required',
        'status'=>'required',
        'login_type'=>'required',
        'plan'=>'required',
        'prepaid_persona'=>'required',
        'mrp'=>'required',
        'rail_title'=>'required',
        'rail_view_all'=>'required',
        'status'=>'required',
        'is_pack_expiry_near'=>'required',
        'is_data_exhausted'=>'required',

    ];
    protected $messages = [
        'circle.required' => 'Circle cannot be empty.',
        'brand.required' => 'brand cannot be empty.',
        'banner_title.required' => 'Banner Title cannot be empty.',
        'analytics_tag.required' => 'Analytics tag cannot be empty.',
        'device_os.required' => 'Device OS cannot be empty.',
        'app_version.required' => 'App version cannot be empty.',
        'banner_rank.required' => 'Banner Rank  cannot be empty.',
        'status.required' => 'Please select status.',
        'is_pack_expiry_near.required' => 'Please select is_pack expiry near.',
        'is_data_exhausted.required' => 'Please select is_ data exhausted.',
        'login_type.required' => 'Please select login type.',
        'plan.required' => 'Please select Plan.',
        'prepaid_persona.required' => 'Please select prepaid persona.',
        'mrp.required' => 'mrp cannot be empty.',
        'rail_title.required' => 'rail title cannot be empty.',
        'rail_view_all.required' => 'View All Rail Redirection cannot be empty.',
    ];
    public function __construct()
    {
        // $this->bannerscreenModel = new BannerScreen;
        // $this->tablistModel = new Tab;
        $this->appversionModel = new AppVersion;

    }
    public function render()
    {
        $circleList = ["0000" => 'All Circle',"0001" => 'Andhra Pradesh','0002' => 'Chennai','0003' => 'Delhi','0004' => 'Uttar Pradesh East','0005' => 'Gujarat','0006' => 'Haryana','0007' => 'Karnataka','0008' => 'Kolkata','0009' => 'Mumbai','0010' => 'Rajastan','0011' => 'West Bengal','0012' => 'Punjab','0013' => 'Uttar Pradesh West','0014' => 'Maharashtra','0015' => 'Tamil Nadu','0016' => 'Kerala','0017' => 'Orissa','0018' => 'Assam','0019' => 'North East','0020' => 'Bihar','0021' => 'Madhya Pradesh','0022' => 'Himachal Pradesh','0023' => 'Jammu And Kashmir'];
        $loginTypeList = ['Primary' => 'Primary', 'Secondary' => 'Secondary', 'Both' => 'Both'];
        $brandList = ['Idea' => 'Idea', 'Vodafone' => 'Vodafone', 'Brandx' => 'Brandx'];
        $planList = ['L'=>'Limited','UL'=>'Unlimited','Both'=>'Both'];
        $prepaidPersonaList = ['All' => 'All', 'Youth' => 'Youth', 'Nonyouth' => 'Nonyouth'];
        $linkTypeList = ['1' => 'Internal Link','2' => 'External Link'];
        $osList = ["android" => 'android','ios' => 'ios', 'Both' => 'Both'];
        $rankList = ['1'=>'1','2'=>'2','3'=>'3','4'=>'4','5'=>'5','6'=>'6','7'=>'7','8'=>'8','9'=>'9','10'=>'10','11'=>'11','12'=>'12','13'=>'13','14'=>'14','15'=>'15','16'=>'16','17'=>'17','18'=>'18','19'=>'19','20'=>'20'];
        $packType = ['UL' => 'UL','HERO_UL' => 'HERO_UL','COMBO'=>'COMBO','NO_PACK'=>'NO_PACK','ALL'=>'ALL'];
        $appVersionList = $this->appversionModel->listTabData();
        return view('livewire.telcowidget.telcowidget', compact('circleList','loginTypeList','brandList','appVersionList','planList','osList','prepaidPersonaList','packType','rankList','linkTypeList'));
    }

    public function submit(){
        $this->validate();

        DB::transaction(function () {
           
        
            if($this->banner_name == "" && !($this->edit_mode)){
                $this->validate([
                   'banner_name' => 'required',
                 ]);
            }
            if(($this->saved_avatar == "" && $this->banner_name == "") && ($this->edit_mode)){
                $this->validate([
                   'banner_name' => 'required',
                 ]);
            }
            
            if($this->circle){
                $data['circle'] = implode(',', $this->circle);
            }
            if($this->login_type){
                $data['login_type'] = $this->login_type;
            }
            
            if($this->device_os){
                $data['device_os'] = $this->device_os;
            }
            if($this->mrp){
                $data['mrp'] = $this->mrp;
            }else{
                $data['mrp'] = "";
            }
            if($this->pack_type){
                $data['pack_type'] = $this->pack_type;
            }else{
                $data['pack_type'] = "";
            }
            if($this->banner_title){
                $data['banner_title'] = $this->banner_title;
            }
            if($this->rail_title){
                $data['rail_title'] = $this->rail_title;
            }else{
                $data['rail_title'] = "";
            }
            if($this->rail_view_all){
                $data['rail_view_all'] = $this->rail_view_all;
            }else{
                $data['rail_view_all'] = "";
            }

            // $image=new Image();
            if(isset($this->banner_name)){
                $image_path = public_path('uploads/livewire-tmp/'.$this->banner_name->getFilename());
                $imageName = carbon::now()->timestamp.'.'.$this->banner_name->extension();
                $tempdata = $this->banner_name->storeAs('astro',$imageName,'s3');
                $data['banner_name'] = $tempdata;
                unlink($image_path);
            }

            if($this->banner_rank){
                $data['banner_rank'] = $this->banner_rank;
            }
            if($this->prepaid_persona){
                $data['prepaid_persona'] = implode(',', $this->prepaid_persona);
            }else{
                $data['prepaid_persona'] = "";
            }
            
            if($this->app_version){
                $data['app_version'] = implode(',', $this->app_version);
            }
            if($this->brand){
                $data['brand'] = $this->brand;
            }
          
            if($this->plan){
                $data['plan'] = $this->plan;
            }
            if($this->analytics_tag){
                $data['analytics_tag'] = $this->analytics_tag;
            }
            if($this->internal_link){
                $data['internal_link'] = $this->internal_link;
            }
            else{
                $data['internal_link'] = "";
            }
            if($this->external_link){
                $data['external_link'] = $this->external_link;
            }else{
                $data['external_link'] = "";
            }
            
            
            if($this->is_pack_expiry_near !=""){
                $data['is_pack_expiry_near'] = $this->is_pack_expiry_near;
            }

            if($this->is_data_exhausted !=""){
                $data['is_data_exhausted'] = $this->is_data_exhausted;
            }

            if($this->status !=""){
                $data['status'] = $this->status;
            }

            
            $TelcoWidgetBannerModel = TelcoWidgetBannerModel::find($this->record_id) ?? TelcoWidgetBannerModel::create($data);
            if(Redis::keys('getTelcoWidgetBanners_*')){  Redis::del(Redis::keys('getTelcoWidgetBanners_*')); }

            // if ($this->edit_mode) {
                foreach ($data as $k => $v) {
                    $TelcoWidgetBannerModel->$k = $v;
                }
                $TelcoWidgetBannerModel->save();
            // }else{

            // }
      
            if ($this->edit_mode) {
                // Assign selected role for user

                // Emit a success event with a message
                
                // if(isset($previous_image->banner_name)){
                //     $data = [];
                //     $data['banner_name'] = $previous_image->banner_name;
                //      DB::table('banner_history')->insert($data);
                // }
                $this->dispatch('success', __('Telco widgets updated'));
            } else {
                // Assign selected role for user
                // $banners->assignRole($this->role);

                // Emit a success event with a message
                $this->dispatch('success', __('Telco widgets Created'));
                
                // $this->dispatchBrowserEvent("CloseAddBannerModal");
            }
        });
        // Reset the form fields after successful submission
        $this->reset();
    }
    public function updateBanner($id)
    {
        $this->edit_mode = true;

        $TelcoWidgetData = TelcoWidgetBannerModel::find($id);
        $this->record_id = $TelcoWidgetData->id;
        $this->circle = explode(',', $TelcoWidgetData->circle);
        $this->login_type = $TelcoWidgetData->login_type;
        $this->brand = $TelcoWidgetData->brand;
        $this->plan = $TelcoWidgetData->plan;
        $this->prepaid_persona = explode(',', $TelcoWidgetData->prepaid_persona);
        $this->banner_title = $TelcoWidgetData->banner_title;
        $this->analytics_tag = $TelcoWidgetData->analytics_tag;
        $this->app_version = explode(',',$TelcoWidgetData->app_version);
        $this->mrp = $TelcoWidgetData->mrp;
        $this->internal_link = $TelcoWidgetData->internal_link;
        $this->external_link = $TelcoWidgetData->external_link;
        $this->device_os = $TelcoWidgetData->device_os;
        $this->banner_rank = $TelcoWidgetData->banner_rank;
        $this->status = $TelcoWidgetData->status;
        $this->is_pack_expiry_near = $TelcoWidgetData->is_pack_expiry_near;
        $this->is_data_exhausted = $TelcoWidgetData->is_data_exhausted;
        $this->rail_title = $TelcoWidgetData->rail_title;
        $this->rail_view_all = $TelcoWidgetData->rail_view_all;
        $this->saved_avatar = $TelcoWidgetData->banner_name;
        $this->pack_type = $TelcoWidgetData->pack_type;
        if($TelcoWidgetData->internal_link){
            $this->link_type = "1";
        }else if($TelcoWidgetData->external_link){
            $this->link_type = "2";
        }
        else{
            $this->link_type = "";            
        }
    }
}
