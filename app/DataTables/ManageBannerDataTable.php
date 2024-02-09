<?php

namespace App\DataTables;

use App\Models\Banner;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Services\DataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;

class ManageBannerDataTable extends DataTable
{
    /**
     * Build the DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->rawColumns(['banner_screen'])
            // ->editColumn('banner_screen', function (Banner $banner) {
            //     return view('pages/apps.banner-management.managebanner.columns._user', compact('banner'));
            // })
            // ->editColumn('role', function (Banner $banner) {
            //     return ucwords($banner->roles->first()?->name);
            // })
            ->editColumn('circle', function (Banner $banner) {
                return sprintf('<div class="badge badge-light fw-bold">%s</div>', $banner->last_login_at ? $banner->last_login_at->diffForHumans() : $banner->updated_at->diffForHumans());
            })
            ->editColumn('created_at', function (Banner $banner) {
                return $banner->created_at->format('d M Y, h:i a');
            })
            ->addColumn('action', function (Banner $banner) {
                return view('pages/apps.banner-management.managebanner.columns._actions', compact('banner'));
            })
            ->setRowId('id');
    }


    /**
     * Get the query source of dataTable.
     */
    public function query(Banner $model): QueryBuilder
    {
        return $model->newQuery();
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
            ->setTableId('users-table')
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
            Column::make('user')->addClass('d-flex align-items-center')->name('name'),
            Column::make('role')->searchable(false),
            // Column::make('username')->title('username'),
            // Column::make('last_login_at')->title('Last Login'),
            Column::make('created_at')->title('Joined Date')->addClass('text-nowrap'),
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
