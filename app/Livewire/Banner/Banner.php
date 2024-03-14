<?php

namespace App\Livewire\Banner;

use App\Models\User;
use Livewire\Component;
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
use App\Models\BannerScreen;
use App\Models\Tab;
use App\Models\AppVersion;
use App\Models\Banners;
use \Carbon\Carbon;


class Banner extends Component
{
    use WithFileUploads;

    public $user_id;
    public $banner_screen;
    public $circle;
    public $login_type;
    public $brand;
    public $lob;
    public $plan;
    public $prepaid_persona;
    public $postpaid_persona;
    public $socid_include_exclude="";
    public $socid;
    public $banner_title;
    public $analytics_tag;
    public $subtitle;
    public $country;
    public $red_hierarchy;
    public $mrp;
    public $link_type;
    public $tab_name;
    public $internal_link;
    public $external_link;
    public $campaign_id;
    public $cta_name;
    public $start_date_time;
    public $end_date_time;
    public $device_os;
    public $banner_text_content;
    public $coupon_code;
    public $validity_period;
    public $avatar;
    public $notified_banner;
    public $app_version;
    public $banner_rank;
    public $status="1";
    public $isnotified='1';
    public $edit_mode = false;
    public $saved_avatar;
    public $banner_name;
    public $service_type;
    // model function calls
    public $bannerscreenModel;
    public $tablistModel;
    public $appVersionModel;
    protected $listeners = [
        'delete_banner' => 'deleteBanner',
        'update_banner' => 'updateBanner',
        // 'group_delete' => "groupDelete",
        // 'group_copy' => "groupCopy",
        // 'group_status' =>"groupStatus"
    ];

    protected $rules = [
        'banner_screen' => 'required',
        'circle'=> 'required',
        'brand'=>'required',
        'lob' => 'required',
        'banner_title'=> 'required',
        'analytics_tag'=>'required',
        'red_hierarchy' => 'required',
        // 'link_type'=> 'required',
        'device_os'=>'required',
        'app_version' => 'required',
        'banner_rank'=> 'required',
        'status'=>'required',
        'isnotified' => 'required',
       
    ];
    protected $messages = [
        'banner_screen.required' => 'Select Screen cannot be empty.',
        'circle.required' => 'Circle cannot be empty.',
        'brand.required' => 'brand cannot be empty.',
        'lob.required' => 'lob cannot be empty.',
        'banner_title.required' => 'Banner Title cannot be empty.',
        'analytics_tag.required' => 'Analytics tag cannot be empty.',
        'red_hierarchy.required' => 'Red Hierarchy cannot be empty.',
        // 'link_type.required' => 'Link Type cannot be empty.',
        'device_os.required' => 'Device OS cannot be empty.',
        'app_version.required' => 'App version cannot be empty.',
        'banner_rank.required' => 'Banner Rank  cannot be empty.',
        'status.required' => 'Please select status.',
        'isnotified.required' => 'Please select is notified.',
    ];
    public function __construct()
    {
        $this->bannerscreenModel = new BannerScreen;
        $this->tablistModel = new Tab;
        $this->appversionModel = new AppVersion;

    }
    public function render()
    {
        $roles = Role::all();
        $circleList = ["0000" => 'All Circle',"0001" => 'Andhra Pradesh','0002' => 'Chennai','0003' => 'Delhi','0004' => 'Uttar Pradesh East','0005' => 'Gujarat','0006' => 'Haryana','0007' => 'Karnataka','0008' => 'Kolkata','0009' => 'Mumbai','0010' => 'Rajastan','0011' => 'West Bengal','0012' => 'Punjab','0013' => 'Uttar Pradesh West','0014' => 'Maharashtra','0015' => 'Tamil Nadu','0016' => 'Kerala','0017' => 'Orissa','0018' => 'Assam','0019' => 'North East','0020' => 'Bihar','0021' => 'Madhya Pradesh','0022' => 'Himachal Pradesh','0023' => 'Jammu And Kashmir'];
        $loginTypeList = ['Primary' => 'Primary', 'Secondary' => 'Secondary', 'Both' => 'Both'];
        $brandList = ['Idea' => 'Idea', 'Vodafone' => 'Vodafone', 'Brandx' => 'Brandx'];
        $lobList = ['Prepaid' => 'Prepaid', 'Postpaid' => 'Postpaid', 'Both' => 'Both'];
        $planList = ['L'=>'Limited','UL'=>'Unlimited','Both'=>'Both'];
        $prepaidPersonaList = ['All' => 'All', 'Youth' => 'Youth', 'Nonyouth' => 'Nonyouth'];
        $postpaidPersonaList = ['All' => 'All', 'COCP' => 'COCP', 'IOIP' => 'IOIP', 'COIP' => 'COIP', 'Individual' => 'Individual'];
        $socidIncludeExcludeList = ['1' => 'Include Socid', '2' => 'Exclude Socid'];
        $redHierarchyList = ["All" => 'All',"Primary" => 'Primary','Secondary' => 'Secondary', 'Individual' => 'Individual'];
        $linkTypeList = ['1' => 'Internal Link','2' => 'External Link'];
        $serviceTypeList = ['DXL' => 'DXL','EAI' => 'EAI','SR' => 'SR','ETopUp' => 'ETopUp','EBPP' => 'EBPP'];
        $osList = ["android" => 'android','ios' => 'ios', 'Both' => 'Both'];
        $appVersion = ['1' => 'Include Socid', '2' => 'Exclude Socid'];
        $rankList = ['1'=>'1','2'=>'2','3'=>'3','4'=>'4','5'=>'5','6'=>'6','7'=>'7','8'=>'8','9'=>'9','10'=>'10','11'=>'11','12'=>'12','13'=>'13','14'=>'14','15'=>'15','16'=>'16','17'=>'17','18'=>'18','19'=>'19','20'=>'20'];
        $screenList = $this->bannerscreenModel->bannerScreenData();
        $tabsList = $this->tablistModel->listTabData();
        $appVersionList = $this->appversionModel->listTabData();
        return view('livewire.banner.banner', compact('roles','circleList','loginTypeList','brandList','lobList','planList','prepaidPersonaList','postpaidPersonaList','socidIncludeExcludeList','redHierarchyList','linkTypeList','tabsList','serviceTypeList','osList','appVersion','rankList','screenList','appVersionList'));
    }
    public function submit(){
        // Validate the form input data
        $this->validate();

        DB::transaction(function () {
            // if ($this->avatar) {
            //     $data['profile_photo_path'] = $this->avatar->store('avatars', 'public');
            // } else {
            //     $data['profile_photo_path'] = null;
            // }

            // if (!$this->edit_mode) {
            //     $data['password'] = Hash::make($this->password);
            // }
            if($this->socid_include_exclude == 0){
                $this->socid_include_exclude = "";
            }
            if($this->lob == "Both"){
                 $this->validate([
                    'prepaid_persona' => 'required',
                    'plan' => 'required',
                    'socid' => 'required',
                    'socid_include_exclude' => 'required',
                    'postpaid_persona' => 'required',
                ]);
            }
            if($this->lob == "Prepaid"){
                $this->validate([
                   'prepaid_persona' => 'required',
                   'plan' => 'required',
                //    'socid' => 'required',
                //    'socid_include_exclude' => 'required',
                //    'postpaid_persona' => 'required',
               ]);
           }
           if($this->lob == "Postpaid"){
            $this->validate([
            //    'prepaid_persona' => 'required',
            //    'plan' => 'required',
               'socid' => 'required',
               'socid_include_exclude' => 'required',
               'postpaid_persona' => 'required',
             ]);
            }
            
            $data['start_date_time'] = $this->start_date_time;
            $data['end_date_time'] = $this->end_date_time;
            
            if($this->banner_screen){
                $data['banner_screen'] = $this->banner_screen;
            }
            if($this->circle){
                $data['circle'] = implode(',', $this->circle);
            }
            if($this->login_type){
                $data['login_type'] = $this->login_type;
            }
            if($this->socid){
                $data['socid'] = $this->socid;
            }else{
                $data['socid'] = "";
            }
            if($this->socid_include_exclude){
                $data['socid_include_exclude'] = $this->socid_include_exclude;
            }
            if($this->device_os){
                $data['device_os'] = $this->device_os;
            }
            if($this->mrp){
                $data['mrp'] = $this->mrp;
            }
            if($this->banner_title){
                $data['banner_title'] = $this->banner_title;
            }

            // $image=new Image();
            // dd($this->banner_name);
            $imageName = carbon::now()->timestamp.'.'.$this->banner_name->extension();
            $tempdata = $this->banner_name->store('astro',$imageName,'s3');
            echo "<pre>";
            print_r($tempdata);
            die();
            if($this->banner_name){
                $data['banner_name'] = $tempdata;
            }
            if($this->banner_rank){
                $data['banner_rank'] = $this->banner_rank;
            }
            if($this->prepaid_persona){
                $data['prepaid_persona'] = implode(',', $this->prepaid_persona);
            }else{
                $data['prepaid_persona'] = "";
            }
            if($this->postpaid_persona){
                $data['postpaid_persona'] = implode(',', $this->postpaid_persona);
            }else{
                $data['postpaid_persona'] = "";
            }
            if($this->red_hierarchy){
                $data['red_hierarchy'] = implode(',', $this->red_hierarchy);
            }
            if($this->service_type){
                $data['service_type'] = implode(',', $this->service_type);
            }
            if($this->app_version){
                $data['app_version'] = implode(',', $this->app_version);
            }
            if($this->brand){
                $data['brand'] = $this->brand;
            }
            if($this->lob){
                $data['lob'] = $this->lob;
            }
            if($this->plan){
                $data['plan'] = $this->plan;
            }
            if($this->analytics_tag){
                $data['analytics_tag'] = $this->analytics_tag;
            }
            if($this->subtitle){
                $data['subtitle'] = $this->subtitle;
            }
            if($this->country){
                $data['country'] = $this->country;
            }
            // if($this->link_type){
            //     $data['link_type'] = $this->link_type;
            // }
            if($this->tab_name){
                $data['tab_name'] = $this->tab_name;
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
            
            if($this->campaign_id){
                $data['campaign_id'] = $this->campaign_id;
            }
            if($this->banner_text_content){
                $data['banner_text_content'] = $this->banner_text_content;
            }
            if($this->coupon_code){
                $data['coupon_code'] = $this->coupon_code;
            }
            if($this->status !=""){
                $data['status'] = $this->status;
            }

            if($this->validity_period){
                $data['validity_period'] =  $this->validity_period;
            }
            if($this->isnotified != ""){
                $data['is_notified'] = $this->isnotified;
            }
            // dd($data);
            // Update or Create a new user record in the database
            if(Redis::keys('Temp*')){  Redis::del(Redis::keys('Temp*')); }
            $banners = Banners::find($this->user_id) ?? Banners::create($data);
            if ($this->edit_mode) {
                foreach ($data as $k => $v) {
                    $banners->$k = $v;
                }
                $banners->save();
            }
      
            if ($this->edit_mode) {
                // Assign selected role for user

                // Emit a success event with a message
                $this->dispatch('success', __('Manage Banner updated'));
            } else {
                // Assign selected role for user
                // $banners->assignRole($this->role);

                // Emit a success event with a message
                $this->dispatch('success', __('Manage Banner Created'));
                
                // $this->dispatchBrowserEvent("CloseAddBannerModal");
            }
        });
        // Reset the form fields after successful submission
        $this->reset();
    }

    public function updateBanner($id)
    {
        $this->edit_mode = true;

        $banners = Banners::find($id);
        // dd($banners->banner_screen);
        $this->banner_screen = $banners->banner_screen;
        $this->user_id = $banners->id;
        $this->circle = explode(',', $banners->circle);
        $this->login_type = $banners->login_type;
        $this->brand = $banners->brand;
        $this->lob = $banners->lob;
        $this->plan = $banners->plan;
        $this->prepaid_persona = explode(',', $banners->prepaid_persona);
        $this->postpaid_persona = explode(',', $banners->postpaid_persona);
        $this->socid_include_exclude = $banners->socid_include_exclude;
        $this->socid = $banners->socid;
        $this->banner_title = $banners->banner_title;
        $this->analytics_tag = $banners->analytics_tag;
        $this->subtitle = $banners->subtitle;
        $this->country = $banners->country;
        $this->red_hierarchy = explode(',',$banners->red_hierarchy);
        $this->service_type = explode(',',$banners->service_type);
        $this->app_version = explode(',',$banners->app_version);
        $this->mrp = $banners->mrp;
        if($banners->internal_link){
            $this->link_type = "1";
        }else if($banners->external_link){
            $this->link_type = "2";
        }
        else{
            $this->link_type = "";            
        }
        $this->tab_name = $banners->tab_name;
        $this->internal_link = $banners->internal_link;
        $this->external_link = $banners->external_link;
        $this->campaign_id = $banners->campaign_id;
        $this->cta_name = $banners->cta_name;
        $this->start_date_time = $banners->start_date_time;
        $this->end_date_time = $banners->end_date_time;
        $this->device_os = $banners->device_os;
        $this->banner_text_content = $banners->banner_text_content;
        $this->coupon_code = $banners->coupon_code;
        $this->validity_period = $banners->validity_period;
        $this->banner_rank = $banners->banner_rank;
        $this->status = $banners->status;
        $this->isnotified = $banners->is_notified;
        $this->start_date_time = $banners->start_date_time;
        $this->end_date_time = $banners->end_date_time;
        $this->banner_name = $banners->banner_name;
    }
    public function deleteBanner($id)
    {
        if(Redis::keys('Temp*')){  Redis::del(Redis::keys('Temp*')); }
        // Prevent deletion of current user
        if ($id == Auth::id()) {
            $this->dispatch('error', 'banner cannot be deleted');
            return;
        }
        // Delete the user record with the specified ID
        Banners::destroy($id);
        // Emit a success event with a message
        $this->dispatch('success', 'Banner successfully deleted');
    }
    // public function groupDelete(array $deleteArray){
    //     foreach ($deleteArray["ids"] as $key => $bannerId) {
    //         $bannerDetails = Banners::find($bannerId);
    //         // $bannerScreenDetails = BannerScreen::find($bannerDetails->banner_screen);
            
    //         // $this->cacheDelete(explode(',',$bannerDetails->circle),$bannerScreenDetails->screen_name);
            
    //         if (!empty($bannerDetails)) {
    //             // $delete = ImageHelper::deleteS3File($bannerScreenDetails->banner_name);
    //             $bannerDetails->delete();
    //         }
    //         // $resultStatus = true;
    //     }
    //     // $update = Banner::orderBy('id', 'DESC')->first();
    //     // if(!empty($update)){
    //     //     $update['updated_at'] = date("Y-m-d H:i:s");
    //     //     $result = $update->save();
    //     // }     
    //     $this->dispatch('success', __('Banners Deleted'));
    // }

    // public function groupCopy(array $copyArray){
    //     foreach ($copyArray as $key => $value) {
    //         $bannerDetails = Banners::find($value);
    //         if (!empty($bannerDetails)) {
    //             $bannerDetails['status'] = 0;
    //             $bannerDetails['banner_name'] = '';
    //             $bannerDetails['notified_banner'] = '';
    //             $newBanner = $bannerDetails->replicate()->save();                        
    //         }
           
    //     }
    //     $this->dispatch('success', __('Banners Copied'));
    //     // return;
    // }
    // public function groupstatus(array $statusArray){
    //     foreach ($statusArray["ids"] as $key => $value) {
    //         $bannerDetails = Banners::find($value);
    //         // $bannerScreenDetails = BannerScreen::find($bannerDetails->banner_screen);
          
    //         // $this->cacheDelete(explode(',',$bannerDetails->circle),$bannerScreenDetails->screen_name);
            
    //         if (!empty($bannerDetails)) {
    //             switch ($statusArray["status"]) {
    //                 case '1': $bannerDetails->status = 1;
    //                     break;
    //                 case '0': $bannerDetails->status = 0;
    //                     break;
    //             }
    //             $bannerDetails->save();
    //             $resultStatus = true;
    //         }
    //     }
    //     // $this->dispatchBrowserEvent("CloseAddBannerModal");
    //     $this->dispatch('success', __('Banners status Updated'));
    // }
    
    public function hydrate()
    {
        $this->resetErrorBag();
        $this->resetValidation();
    }
}
