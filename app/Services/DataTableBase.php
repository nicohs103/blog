<?php 

namespace App\Services;

use Illuminate\Contracts\View\Factory;
use Illuminate\Database\Query\Builder;
use DataTables;
use Yajra\Datatables\CollectionDataTable;
use Yajra\DataTables\Services\DataTable;
use Yajra\DataTables\EloquentDataTable;

class DataTableBase extends DataTable {

    /*
     * The reason why this class exists is that Yajra/Datatables requires this service class for export methods to work
     * properly.
     */

    /** @var Builder The query that will be used to get the data from the db. */
    private $mQuery;

    /** @var array An array of columns */
    private $mColumns;

    /** @var BaseEngine The DataTable */
    private $mDataTable;

    /**
     * @param            $query
     * @param BaseEngine $dataTable
     * @param array      $columns
     */
    public function __construct($query, CollectionDataTable $dataTable, $columns = null) {
       // parent::__construct(app(Datatables::class), app(Factory::class));

        $this->mQuery = $query;
        $this->mColumns = $columns ? $columns : array_keys ((array)$dataTable->collection->first());
        $this->mDataTable = $dataTable;
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function ajax() {
        return $this->mDataTable->make(true);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Builder|\Illuminate\Database\Query\Builder|\Illuminate\Support\Collection
     */
    public function query() {
        return $this->mQuery;
    }

    public function html() {
        return $this->builder()->minifiedAjax()->columns($this->mColumns);
    }

}