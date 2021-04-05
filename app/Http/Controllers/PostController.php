<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use App\Services\DataTableBase;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\DataTables as DataTables;
use Carbon\Carbon;
use Laracasts\Flash\Flash as Flash;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.post.index');
    }

    public function getPostsDatatable(Request $request)
    {
        $posts = Post::where('created_by', Auth::id())->get();

        $dataTable = DataTables::of($posts);

        $dataTable->editColumn('description', function ($post) {
            $max = 50;
            $string = substr($post['description'], 0, $max);

            return $string . '...';
        });

        $dataTable->editColumn('publication_date', function ($post) {
            if ($post->publication_date) {
                return Carbon::create($post->publication_date)->format('d-m-Y H:m:s');
            }

            return '';
        });

        $columns = ['title', 'description', 'publication_date'];
        $base = new DataTableBase($posts, $dataTable, $columns);

        return $base->render(null);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.post.show');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $this->validate($request, [
            'title' => 'required',
            'description' => 'required'
        ]);

        $post = new Post;
        $post->title = ucfirst($request->title);
        $post->description = $request->description;
        $post->publication_date = Carbon::now();
        $post->created_by = Auth::id();
        $post->save();

        Flash::success(trans('app.created_successfully'));

        return redirect(url('admin/post'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $post = Post::find($id);

        if (empty($post)) {
            Flash::error(trans('app.not_found'));
            return redirect(url('admin/post'));
        }

        return view('admin.post.show', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
    }
}
