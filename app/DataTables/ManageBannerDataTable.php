<?php

namespace App\DataTables;

use App\Models\Banners;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Services\DataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use App\Models\BannerScreen;

class ManageBannerDataTable extends DataTable
{
    // public $bannerscreenModel;
    /**
     * Build the DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {

        $this->bannerscreenModel = new BannerScreen;
        $this->screenList = $this->bannerscreenModel->bannerScreenData();
        // dd($screenList);
        return (new EloquentDataTable($query))
            ->rawColumns(['banner_screen','status','circle'])
            // ->editColumn('banner_screen', function (Banner $banner) {
            //     return view('pages/apps.banner-management.managebanner.columns._user', compact('banner'));
            // })
            ->editColumn('banner_screen', function (Banners $banner) {
                $banner_screen = ($banner->banner_screen);
                return  array_key_exists($banner_screen,$this->screenList)? $this->screenList[$banner_screen] : "-";

            })
            ->editColumn('status', function (Banners $banner) {
                $status = ($banner->status);
                    // return $status;
                    // return sprintf('<div class="badge badge-light fw-bold">%s</div>', $user->last_login_at ? $user->last_login_at->diffForHumans() : $user->updated_at->diffForHumans());
                    // return  ($banner->status ?  "Active"  :  "Inactve") ;
                    return sprintf($banner->status ? '<div class="badge bg-success text-wrap">Active</div>': '<div class="badge bg-danger text-wrap">Inactive</div>');
                    // return sprintf('<div class="badge bg-success text-wrap">Active</div>');

            })
            ->editColumn('circle', function (Banners $banner) {
                $circleList = ["0000" => 'All Circle',"0001" => 'Andhra Pradesh','0002' => 'Chennai','0003' => 'Delhi','0004' => 'Uttar Pradesh East','0005' => 'Gujarat','0006' => 'Haryana','0007' => 'Karnataka','0008' => 'Kolkata','0009' => 'Mumbai','0010' => 'Rajastan','0011' => 'West Bengal','0012' => 'Punjab','0013' => 'Uttar Pradesh West','0014' => 'Maharashtra','0015' => 'Tamil Nadu','0016' => 'Kerala','0017' => 'Orissa','0018' => 'Assam','0019' => 'North East','0020' => 'Bihar','0021' => 'Madhya Pradesh','0022' => 'Himachal Pradesh','0023' => 'Jammu And Kashmir'];
                    //$circle = $circleList[$banner->circle];
                    
                    $circle = 'NA';
                    if($banner->circle != NULL){
                        $circleArr = explode(',',$banner->circle);
                        $circleTextArr = [];
                        foreach ($circleArr as $key => $value) {
                            if (array_key_exists($value, $circleList)) {
                                $circleTextArr[$key] = $circleList[$value];
                            }
                        }
                        $circle = implode(", ",$circleTextArr);
                    }
                    
                    return $circle;
            })
            ->editColumn('updated_at', function (Banners $banner) {
                return $banner->updated_at->format('d M Y, h:i a');
            })
            ->addColumn('action', function (Banners $banner) {
                return view('pages/apps.banner-management.managebanner.columns._actions', compact('banner'));
            })
            ->setRowId('id');
    }


    /**
     * Get the query source of dataTable.
     */
    public function query(Banners $model): QueryBuilder
    {
        return $model->newQuery();
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
            ->setTableId('banner-table')
            ->columns($this->getColumns())
            ->minifiedAjax()
            ->dom('rt' . "<'row'<'col-sm-12 col-md-5'l><'col-sm-12 col-md-7'p>>",)
            ->addTableClass('table align-middle table-row-dashed fs-6 gy-5 dataTable no-footer text-gray-600 fw-semibold')
            ->setTableHeadClass('text-start text-muted fw-bold fs-7 text-uppercase gs-0')
            ->orderBy(2)
            ->drawCallback("function() {" . file_get_contents(resource_path('views/pages/apps/banner-management/managebanner/columns/_draw-scripts.js')) . "}");
    }

    /**
     * Get the dataTable columns definition.
     */
    public function getColumns(): array
    {
        return [
            // Column::make('user')->addClass('d-flex align-items-center')->name('name'),
            // Column::make('role')->searchable(false),
            // Column::make('username')->title('username'),
            // Column::make('last_login_at')->title('Last Login'),
            Column::make('banner_title')->title('Banner Title')->addClass('text-nowrap'),
            Column::make('lob')->title('LOB')->addClass('text-nowrap'),
            Column::make('prepaid_persona')->title('Prepaid Persona')->addClass('text-nowrap'),
            Column::make('login_type')->title('Login Type')->addClass('text-nowrap'),
            Column::make('brand')->title('Brand')->addClass('text-nowrap'),
            Column::make('circle')->title('circle'),
            Column::make('app_version')->title('Versions'),
            Column::make('banner_screen')->title('Screen')->addClass('text-nowrap'),
            Column::make('device_os')->title('OS')->addClass('text-nowrap'),
            Column::make('banner_rank')->title('Rank')->addClass('text-nowrap'),
            Column::make('updated_at')->title('Updated Date')->addClass('text-nowrap'),
            Column::make('status')->title('status'),
            Column::computed('action')
                ->addClass('text-end text-nowrap')
                ->exportable(false)
                ->printable(false)
                ->width(60)
        ];
    }

    /**
     * Get the filename for export.
     */
    protected function filename(): string
    {
        return 'Users_' . date('YmdHis');
    }
}
