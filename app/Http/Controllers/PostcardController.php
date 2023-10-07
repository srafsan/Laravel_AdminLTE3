<?php

namespace App\Http\Controllers;

use App\Postcard;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class PostcardController extends Controller
{

    public function index()
    {
        //$postcardService = new PostcardService("us", 23, 10);
        //$postcardService->hello('Hello from World', 'rafsan@gmail.com');
        Postcard::hello('hello', 'rafsan@gmail.com');
    }

    /**
     * @return Response
     */
    public function create()
    {
        //
    }

    /**
     * @param Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * @param Request $request
     * @param  int  $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        //
    }
}
