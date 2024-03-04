<?php

namespace App\Livewire\Banner;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\BannerScreen;
use App\Models\Tab;
use App\Models\AppVersion;
use App\Models\Banners;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Facades\Auth;

class BannerFilter extends Component
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
    protected $listeners = [
        'group_delete' => "groupDelete",
        'group_copy' => "groupCopy",
        'group_status' =>"groupStatus",
        "deleteRow"=>"deleteRowData",
    ];
    public function render()
    {
        // dd($this->Byperpage);
        $this->bannerscreenModel = new BannerScreen;
        $this->tablistModel = new Tab;
        $this->appversionModel = new AppVersion;
        $this->screenList = $this->bannerscreenModel->bannerScreenData();
        
        $query = Banners::orderBy("updated_at",'desc');
        // $usersCount = Banners::orderBy("updated_at",'desc');

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

        $query->when($this->banner_title != "", function($q){
            return $q->where('banner_title', 'like', "%$this->banner_title%");
        });
        $query->when($this->lob != "", function($q){
            return $q->whereIn('lob',["Both", $this->lob]);
        });
        $query->when($this->postpaid_persona != "", function($q){
            return $q->whereIn('postpaid_persona', ["All",$this->postpaid_persona]);
        });
        $query->when($this->brand != "", function($q){
            return $q->whereIn('brand', ["Brandx",$this->brand]);
        });
        $query->when($this->loginType != "", function($q){
            return $q->whereIn('login_type',["Both",$this->loginType]);
        });

        $query->when($this->circle != "", function($q){
            return $q->whereIn('circle', ["0000",$this->circle]);
        });

        $query->when($this->appversion != "", function($q){
            return $q->where('app_version', ["All Versions",$this->appversion]);
        });

        $query->when($this->screen != "", function($q){
            return $q->where('banner_screen', $this->screen);
        });

        $query->when($this->os != "", function($q){
            return $q->whereIn('device_os', ['Both',$this->os]);
        });

        $query->when($this->rank != "", function($q){
            return $q->where('banner_rank', $this->rank);
        });

        $query->when($this->status != "", function($q){
            return $q->where('status', $this->status);
        });
        $totalCount = $query->count();
        
        $banners = $query->paginate($this->Byperpage);
        foreach ($banners as $fetchCircle) {
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
        addJavascriptFile('assets/js/custom/temp.js');
        return view('livewire.banner.banner-filter',compact('banners','lobList','postpaidPersonaList','brandList','loginTypeList','circleList','appVersionList','screenList','osList','rankList','totalCount'));
    }
    function groupCopy($copyArray){
        foreach ($copyArray['ids'] as $key => $value) {
            $bannerDetails = Banners::find($value);
            if (!empty($bannerDetails)) {
                $bannerDetails['status'] = 0;
                $bannerDetails['banner_name'] = '';
                $bannerDetails['notified_banner'] = '';
                $newBanner = $bannerDetails->replicate()->save();                        
            }
        }
        $this->dispatch('success', __('Banners Copied'));
    }
    public function groupDelete(array $deleteArray){
        foreach ($deleteArray["ids"] as $key => $bannerId) {
            $bannerDetails = Banners::find($bannerId);
            // $bannerScreenDetails = BannerScreen::find($bannerDetails->banner_screen);
            
            // $this->cacheDelete(explode(',',$bannerDetails->circle),$bannerScreenDetails->screen_name);
            
            if (!empty($bannerDetails)) {
                // $delete = ImageHelper::deleteS3File($bannerScreenDetails->banner_name);
                $bannerDetails->delete();
            }
            // $resultStatus = true;
        }
        // $update = Banner::orderBy('id', 'DESC')->first();
        // if(!empty($update)){
        //     $update['updated_at'] = date("Y-m-d H:i:s");
        //     $result = $update->save();
        // }     
        $this->dispatch('success', __('Banners Deleted'));
    }

    public function groupstatus(array $statusArray){
        foreach ($statusArray["ids"] as $key => $value) {
            $bannerDetails = Banners::find($value);
            // $bannerScreenDetails = BannerScreen::find($bannerDetails->banner_screen);
          
            // $this->cacheDelete(explode(',',$bannerDetails->circle),$bannerScreenDetails->screen_name);
            
            if (!empty($bannerDetails)) {
                switch ($statusArray["status"]) {
                    case '1': $bannerDetails->status = 1;
                        break;
                    case '0': $bannerDetails->status = 0;
                        break;
                }
                $bannerDetails->save();
                $resultStatus = true;
            }
        }
        $this->dispatch('success', __('Banners status Updated'));
    }

    function deleteRowData($deleteDataID){
        if(Redis::keys('Temp*')){  Redis::del(Redis::keys('Temp*')); }
        // Prevent deletion of current user
        if ($deleteDataID == Auth::id()) {
            $this->dispatch('error', 'banner cannot be deleted');
            return;
        }
        // Delete the user record with the specified ID
        Banners::destroy($deleteDataID);
        // Emit a success event with a message
        $this->dispatch('success', 'Banner successfully deleted');
    }
    
}
