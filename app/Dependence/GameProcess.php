<?php


namespace App\Dependence;

use Illuminate\Http\Request;
use Illuminate\Support\Arr;

abstract class GameProcess
{
    protected $form;

    protected $grid;

    private $request;

    private $files = [];

    protected $views = [
        'index' => 'admin.technic.index',
        'create' => 'admin.technic.create',
        'edit' => 'admin.technic.create',
    ];

    public function __construct()
    {
        $this->form = $this->form();

        $request = \request()->all();

        unset($request['_token']);

        $this->request = $request;

    }

    /**
     * Display a listing of the resource.
     *
     */
    public function index()
    {
        //

        return redirect(Arr::get($this->views,'index'));
    }

    /**
     * Show the form for creating a new resource.
     *
     */
    public function create()
    {
        //
        return view(Arr::get($this->views,'create'),['content'=>$this->form]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     */
    public function store(\App\ModernityBase\Requests\Content $request)
    {
       $model =  $this->form->model->create($this->request);

        foreach (\request()->files?:[] as $key=>$file){
            $path = \request($key)->store('images');
            $this->files[$key] = $path;
        }

        $model->update($this->files);

        return redirect()->route($this->form->route('index'));

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id

     */
    public function edit($id)
    {
        //
        $this->form->model($id);

       dd($this->form);

        return view(Arr::get($this->views,'edit'),['content'=>$this->form]);
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
