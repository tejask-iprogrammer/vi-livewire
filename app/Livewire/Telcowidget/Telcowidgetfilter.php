<?php

namespace App\Livewire\Telcowidget;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\BannerScreen;
use App\Models\Tab;
use App\Models\AppVersion;
use App\Models\Banners;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Facades\Auth;
use DB;
use App\Models\TelcoWidgetBannerModel;


class Telcowidgetfilter extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $banner_title;
    public $lob;
    public $postpaid_persona;
    public $brand;
    public $loginType;
    public $circle;
    public $appversion;
    public $screen;
    public $os;
    public $rank;
    public $status;
    public $Byperpage=10;
    public $checkselect=[];
    public $tempdelete=[];
    public $analytics_tag;
    public $rail_title;
    public $is_pack_expiry_near;
    public $is_data_exhausted;
    public $pack_type;
    protected $listeners = [
        'group_delete' => "groupDelete",
        'group_copy' => "groupCopy",
        'group_status' =>"groupStatus",
        "deleteRow"=>"deleteRowData",
    ];
    public function render()
    {
        $this->bannerscreenModel = new BannerScreen;
     
        $this->BannersModel = new Banners;
        $this->tablistModel = new Tab;
        $this->appversionModel = new AppVersion;
        $this->screenList = $this->bannerscreenModel->bannerScreenData();

        //  $query =  Banners::Join($this->bannerscreenModel->getTable(), 'banners.banner_screen', '=', $this->bannerscreenModel->getTable() . '.id')
        //  ->select(['banners.*', 'screen_title','banner_screens.id as screen_id'])
        //  ->orderBy($this->BannersModel->getTable() . '.updated_at','desc');
         $query = TelcoWidgetBannerModel::orderBy('updated_at','desc');

        $lobList = ['Prepaid' => 'Prepaid', 'Postpaid' => 'Postpaid', 'Both' => 'Both'];
        $postpaidPersonaList = ['All' => 'All', 'COCP' => 'COCP', 'IOIP' => 'IOIP', 'COIP' => 'COIP', 'Individual' => 'Individual'];
        $brandList = ['Idea' => 'Idea', 'Vodafone' => 'Vodafone', 'Brandx' => 'Brandx'];
        $loginTypeList = ['Primary' => 'Primary', 'Secondary' => 'Secondary', 'Both' => 'Both'];
        $circleList = ["0000" => 'All Circle',"0001" => 'Andhra Pradesh','0002' => 'Chennai','0003' => 'Delhi','0004' => 'Uttar Pradesh East','0005' => 'Gujarat','0006' => 'Haryana','0007' => 'Karnataka','0008' => 'Kolkata','0009' => 'Mumbai','0010' => 'Rajastan','0011' => 'West Bengal','0012' => 'Punjab','0013' => 'Uttar Pradesh West','0014' => 'Maharashtra','0015' => 'Tamil Nadu','0016' => 'Kerala','0017' => 'Orissa','0018' => 'Assam','0019' => 'North East','0020' => 'Bihar','0021' => 'Madhya Pradesh','0022' => 'Himachal Pradesh','0023' => 'Jammu And Kashmir'];
        $tabsList = $this->tablistModel->listTabData();
        $appVersionList = $this->appversionModel->listTabData();
        $screenList = $this->bannerscreenModel->bannerScreenData();
        $osList = ["android" => 'android','ios' => 'ios', 'Both' => 'Both'];
        $rankList = ['1'=>'1','2'=>'2','3'=>'3','4'=>'4','5'=>'5','6'=>'6','7'=>'7','8'=>'8','9'=>'9','10'=>'10','11'=>'11','12'=>'12','13'=>'13','14'=>'14','15'=>'15','16'=>'16','17'=>'17','18'=>'18','19'=>'19','20'=>'20'];
        $packType = ['UL' => 'UL','HERO_UL' => 'HERO_UL','COMBO'=>'COMBO','NO_PACK'=>'NO_PACK','ALL'=>'ALL'];

        $query->when($this->banner_title != "", function($q){
            return $q->where('banner_title', 'like', "%$this->banner_title%");
        });
        $query->when($this->analytics_tag != "", function($q){
            return $q->where('analytics_tag', 'like', "%$this->analytics_tag%");
        });
        $query->when($this->rail_title != "", function($q){
            return $q->where('rail_title', 'like', "%$this->rail_title%");
        });
        // $query->when($this->lob != "", function($q){
        //     return $q->whereIn('lob',["Both", $this->lob]);
        // });
        // $query->when($this->postpaid_persona != "", function($q){
        //     // return $q->whereIn('postpaid_persona', ["All",$this->postpaid_persona]);
        //     return $q->whereRaw('(FIND_IN_SET("'.$this->postpaid_persona.'", postpaid_persona) OR FIND_IN_SET("All", postpaid_persona))');

        // });
        // $query->when($this->brand != "", function($q){
        //     return $q->whereIn('brand', ["Brandx",$this->brand]);
        // });
        $query->when($this->loginType != "", function($q){
            return $q->whereIn('login_type',["Both",$this->loginType]);
        });

        $query->when($this->circle != "", function($q){
            // return $q->whereIn('circle', ["0000",$this->circle]);
            // return $q->whereRaw('FIND_IN_SET(?, circle)', [$this->circle]);
            return $q->whereRaw('(FIND_IN_SET("'.$this->circle.'", circle) OR FIND_IN_SET("0000", circle))');
        });

        $query->when($this->appversion != "", function($q){
            // return $q->whereIn('app_version', ["All Versions",$this->appversion]);
            // return $q->whereRaw('FIND_IN_SET(?, app_version)', [$this->appversion]);
            return $q->whereRaw('(FIND_IN_SET("'.$this->appversion.'", app_version) OR FIND_IN_SET("All Versions", app_version))');
        });
        $query->when($this->pack_type != "", function($q){
            // return $q->whereIn('app_version', ["All Versions",$this->appversion]);
            // return $q->whereRaw('FIND_IN_SET(?, app_version)', [$this->appversion]);
            return $q->whereRaw('(FIND_IN_SET("'.$this->pack_type.'", pack_type) OR FIND_IN_SET("ALL", pack_type))');
        });

        // $query->when($this->screen != "", function($q){
        //     return $q->where('banner_screen', $this->screen);
        // });

        $query->when($this->os != "", function($q){
            return $q->whereIn('device_os', ['Both',$this->os]);
        });

        $query->when($this->rank != "", function($q){
            return $q->where('banner_rank', $this->rank);
        });

        $query->when($this->status != "", function($q){
            return $q->where('status', $this->status);
        });
        $query->when($this->is_pack_expiry_near != "", function($q){
            return $q->where('is_pack_expiry_near', $this->is_pack_expiry_near);
        });
        $query->when($this->is_data_exhausted != "", function($q){
            return $q->where('is_data_exhausted', $this->is_data_exhausted);
        });
        $totalCount = $query->count();
        
        $TelcoWidgetData = $query->paginate($this->Byperpage);
        foreach ($TelcoWidgetData as $fetchCircle) {
            if($fetchCircle->circle != NULL){
                $circleList = ["0000" => 'All Circle',"0001" => 'Andhra Pradesh','0002' => 'Chennai','0003' => 'Delhi','0004' => 'Uttar Pradesh East','0005' => 'Gujarat','0006' => 'Haryana','0007' => 'Karnataka','0008' => 'Kolkata','0009' => 'Mumbai','0010' => 'Rajastan','0011' => 'West Bengal','0012' => 'Punjab','0013' => 'Uttar Pradesh West','0014' => 'Maharashtra','0015' => 'Tamil Nadu','0016' => 'Kerala','0017' => 'Orissa','0018' => 'Assam','0019' => 'North East','0020' => 'Bihar','0021' => 'Madhya Pradesh','0022' => 'Himachal Pradesh','0023' => 'Jammu And Kashmir'];
                    $circle = 'NA';
                    if($fetchCircle->circle != NULL){
                        $circleArr = explode(',',$fetchCircle->circle);
                        $circleTextArr = [];
                        foreach ($circleArr as $key => $value) {
                            if (array_key_exists($value, $circleList)) {
                                $circleTextArr[$key] = $circleList[$value];
                            }
                        }
                        $fetchCircle->circle = implode(", ",$circleTextArr);
                    }
            }
        }
        // $querylast = (DB::getQueryLog()); 
        // $querylast = $query->toSql();
        // addJavascriptFile('assets/js/custom/manageBanner.js');
        return view('livewire.telcowidget.telcowidgetfilter',compact('TelcoWidgetData','lobList','postpaidPersonaList','brandList','loginTypeList','circleList','appVersionList','screenList','osList','rankList','totalCount','packType'));
    }

    function groupCopy($copyArray){
        if(!(count($copyArray['ids']))){
            $this->dispatch('error', 'Please select minimun one record');
            return;
        }
        foreach ($copyArray['ids'] as $key => $value) {
            $TelcoWidgetDetails = TelcoWidgetBannerModel::find($value);
            if (!empty($TelcoWidgetDetails)) {
                $TelcoWidgetDetails['status'] = 0;
                // $TelcoWidgetDetails['banner_name'] = '';
                // $TelcoWidgetDetails['notified_banner'] = '';
                $newBanner = $TelcoWidgetDetails->replicate()->save();                        
            }
        }
        $this->dispatch('success', __('Telco Widget Banners Copied'));
    }
    public function groupDelete(array $deleteArray){
        if(!(count($deleteArray['ids']))){
            $this->dispatch('error', 'Please select minimun one record');
            return;
        }
        foreach ($deleteArray["ids"] as $key => $bannerId) {
            $TelcoWidgetDetails = TelcoWidgetBannerModel::find($bannerId);
            if(Redis::keys('getTelcoWidgetBanners_*')){  Redis::del(Redis::keys('getTelcoWidgetBanners_*')); }

            
            if (!empty($TelcoWidgetDetails)) {
                // $delete = ImageHelper::deleteS3File($bannerScreenDetails->banner_name);
                $TelcoWidgetDetails->delete();
            }
            // $resultStatus = true;
        }
        // $update = Banner::orderBy('id', 'DESC')->first();
        // if(!empty($update)){
        //     $update['updated_at'] = date("Y-m-d H:i:s");
        //     $result = $update->save();
        // }     
        $this->dispatch('success', __('Telco Widget Banners Deleted'));
    }
    public function groupstatus(array $statusArray){
        if(!(count($statusArray['ids']))){
            $this->dispatch('error', 'Please select minimun one record');
            return;
        }
        foreach ($statusArray["ids"] as $key => $value) {
            $TelcoWidgetDetails = TelcoWidgetBannerModel::find($value);
                      
            if(Redis::keys('getTelcoWidgetBanners_*')){  Redis::del(Redis::keys('getTelcoWidgetBanners_*')); }

            
            if (!empty($TelcoWidgetDetails)) {
                switch ($statusArray["status"]) {
                    case '1': $TelcoWidgetDetails->status = 1;
                        break;
                    case '0': $TelcoWidgetDetails->status = 0;
                        break;
                }
                $TelcoWidgetDetails->save();
                $resultStatus = true;
            }
        }
        $this->dispatch('success', __('Telco Widget Banner status Updated'));
    }

    function deleteRowData($deleteDataID){
        $TelcoWidgetDetails = TelcoWidgetBannerModel::find($deleteDataID);
        if(Redis::keys('getTelcoWidgetBanners_*')){  Redis::del(Redis::keys('getTelcoWidgetBanners_*')); }
        // Prevent deletion of current user
        if ($deleteDataID == Auth::id()) {
            $this->dispatch('error', 'Telco Widget Banner cannot be deleted');
            return;
        }
        // Delete the user record with the specified ID
        TelcoWidgetBannerModel::destroy($deleteDataID);
        // Emit a success event with a message
        $this->dispatch('success', 'Telco Widget Banner successfully deleted');
    }
}
