<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Repository;
use Illuminate\Http\Request;

class RepositoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Repository::get();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'site_name' => 'required',
            'url'       => 'required|url',
            'image'     => 'required|url',
        ]);

        return Repository::create([
            'site_name' => $request->site_name,
            'url'       => $request->url,
            'image'     => $request->image,
            'locale'    => $request->input('locale') ?? null,
        ]);
    }

    /**
     * @param Repository $repository
     */
    public function destroy(Repository $repository)
    {
        $repository->delete();

        return [
            'status'  => 'success',
            'message' => 'Repo deleted'
        ];
    }
}
