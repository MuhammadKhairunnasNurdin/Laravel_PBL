<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class DataTablesController extends Controller
{
    /**
     * take data in JSON format for datatables list data
     * @throws Exception
     */
    public function list(Request $request): JsonResponse
    {
        /**
         * retrieve class for static call and instance for non-static call function from string class in request
         */
        $class = decrypt($request->model);
        $instance = new $class;

        /**
         * make Query Builder for retrieving data
         */
        $relationships = [];
        foreach ($request->relationships as $item) {
            $relationships[] = decrypt($item);
        }
        $builder = $class::with($relationships);

        /**
         * retrieve data using Query Builder variable, and there is option for filter feature or not
         */
        $data = $request->filterValue === null ? $builder->get() : $builder->where(decrypt($request->filterName), $request->filterValue);

        /**
         * filter data, if 'where' condition is existing
         */
        $data = $request->has('whereName') ? $data->where(decrypt($request->whereName), '=' , decrypt($request->whereValue)) : $data;

        /**
         * retrieve primaryKey model for url in dataTable column
         */
        $idModel = $instance->getKeyName();

        $url = decrypt($request->url);

        return DataTables::of($data)
            ->addIndexColumn()
            ->addColumn('aksi', function ($row) use ($idModel, $url) {
                $aksi = '
                    <div class="gap-[5px]">
                        <form method="POST" action="' . url($url . $row->$idModel) . '">
                            <a href="' . url($url . $row->$idModel) . '" class="bg-blue-400 text-[9px] text-neutral-950 py-[5px] px-2 rounded-sm hover:bg-blue-600">Detail</a>
                            <a href="' . url($url . $row->$idModel . '/edit') . '" class="bg-yellow-400 text-[9px] text-neutral-950 py-[5px] px-2 rounded-sm hover:bg-yellow-500">Ubah</a>'
                                . csrf_field()
                                . method_field('DELETE')
                                . '<a href="" class="bg-red-400 text-[9px] text-neutral-950 py-[5px] px-2 rounded-sm hover:bg-red-600 hover:text-white">Hapus</a>
                        </form>
                    </div>';
                return $aksi;
            })
            ->rawColumns(['aksi'])
            ->make(true);
    }
}
