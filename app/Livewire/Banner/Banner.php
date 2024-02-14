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
    public $socid_include_exclude;
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
    public $status;
    public $isnotified;
    public $edit_mode = false;
    public $saved_avatar;
    public $banner_name;

    // model function calls
    public $bannerscreenModel;
    public $tablistModel;
    public $appVersionModel;
    protected $listeners = [
        'delete_banner' => 'deleteBanner',
        'update_banner' => 'updateBanner',
    ];
    protected $rules = [
        'banner_screen' => 'required',
        'circle'=> 'required',
        'brand'=>'required',
        'lob' => 'required',
        'banner_title'=> 'required',
        'analytics_tag'=>'required',
        'red_hierarchy' => 'required',
        'link_type'=> 'required',
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
        'link_type.required' => 'Link Type cannot be empty.',
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
            if($this->banner_screen){
                $data['banner_screen'] = $this->banner_screen;
            }
            if($this->circle){
                $data['circle'] = $this->circle ;
            }
                $data['login_type'] = $this->login_type;
                $data['socid'] = $this->socid;
                $data['socid_include_exclude'] = $this->socid_include_exclude;
                $data['device_os'] = $this->device_os;
                $data['mrp'] = $this->mrp;
                $data['banner_title'] = $this->banner_title;
                $data['banner_name'] = $this->banner_name;
                $data['banner_rank'] = $this->banner_rank;
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
            }
        });
        // Reset the form fields after successful submission
        $this->reset();
    }

    public function updateBanner($id)
    {
        $this->edit_mode = true;

        $banners = Banners::find($id);

        $this->banner_screen = $banners->banner_screen;
        $this->circle = $banners->circle;
        $this->login_type = $banners->login_type;
        $this->brand = $banners->brand;
        $this->lob = $banners->lob;
        $this->plan = $banners->plan;
        $this->prepaid_persona = $banners->prepaid_persona;
        $this->prepaid_persona = $banners->prepaid_persona;
        $this->socid_include_exclude = $banners->socid_include_exclude;
        $this->socid = $banners->socid;
        $this->banner_title = $banners->banner_title;
        $this->analytics_tag = $banners->analytics_tag;
        $this->subtitle = $banners->subtitle;
        $this->country = $banners->country;
        $this->red_hierarchy = $banners->red_hierarchy;
        $this->mrp = $banners->mrp;
        $this->link_type = $banners->link_type;
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
    public function hydrate()
    {
        $this->resetErrorBag();
        $this->resetValidation();
    }
}
