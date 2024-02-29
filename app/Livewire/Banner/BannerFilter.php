<?php

namespace App\Livewire\Banner;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\BannerScreen;
use App\Models\Tab;
use App\Models\AppVersion;
use App\Models\Banners;
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
    public function render()
    {
        // dd($this->Byperpage);
        $this->bannerscreenModel = new BannerScreen;
        $this->tablistModel = new Tab;
        $this->appversionModel = new AppVersion;
        $this->screenList = $this->bannerscreenModel->bannerScreenData();

        $query = Banners::orderBy("updated_at",'desc');
        // $usersCount = Banners::orderBy("updated_at",'desc');
        $totalCount = $query->count();

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
        
        foreach ($query as $fetchStatus) {
            if($fetchStatus->circle != NULL){
                $circleList = ["0000" => 'All Circle',"0001" => 'Andhra Pradesh','0002' => 'Chennai','0003' => 'Delhi','0004' => 'Uttar Pradesh East','0005' => 'Gujarat','0006' => 'Haryana','0007' => 'Karnataka','0008' => 'Kolkata','0009' => 'Mumbai','0010' => 'Rajastan','0011' => 'West Bengal','0012' => 'Punjab','0013' => 'Uttar Pradesh West','0014' => 'Maharashtra','0015' => 'Tamil Nadu','0016' => 'Kerala','0017' => 'Orissa','0018' => 'Assam','0019' => 'North East','0020' => 'Bihar','0021' => 'Madhya Pradesh','0022' => 'Himachal Pradesh','0023' => 'Jammu And Kashmir'];
                $circleArr = explode(',',$fetchStatus->circle);
                $circleTextArr = [];
                foreach ($circleArr as $key => $value) {
                    if (array_key_exists($value, $circleList)) {
                        $circleTextArr[$key] = $circleList[$value];
                    }
                }
                $fetchStatus->circle = implode(", ",$circleTextArr);
            }
        }

        $query->when($this->banner_title != "", function($q){
            return $q->where('banner_title', 'like', $this->banner_title);
        });
        $query->when($this->lob != "", function($q){
            return $q->where('lob', $this->lob);
        });
        $query->when($this->postpaid_persona != "", function($q){
            return $q->where('postpaid_persona', $this->postpaid_persona);
        });
        $query->when($this->brand != "", function($q){
            return $q->where('brand', $this->brand);
        });
        $query->when($this->loginType != "", function($q){
            return $q->where('login_type', $this->loginType);
        });

        $query->when($this->circle != "", function($q){
            return $q->where('circle', $this->circle);
        });

        $query->when($this->appversion != "", function($q){
            return $q->where('app_version', $this->appversion);
        });

        $query->when($this->screen != "", function($q){
            return $q->where('banner_screen', $this->screen);
        });

        $query->when($this->os != "", function($q){
            return $q->where('device_os', $this->os);
        });

        $query->when($this->rank != "", function($q){
            return $q->where('banner_rank', $this->rank);
        });

        $query->when($this->status != "", function($q){
            return $q->where('status', $this->status);
        });
        
        //  $page=10;

        $banners = $query->paginate($this->Byperpage);
        addJavascriptFile('assets/js/custom/temp.js');
        return view('livewire.banner.banner-filter',compact('banners','lobList','postpaidPersonaList','brandList','loginTypeList','circleList','appVersionList','screenList','osList','rankList','totalCount'));
    }
}
