<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreWebsiteRequest;
use App\Models\Website;
use App\Service\Analytics;
use Illuminate\Http\Request;

class WebsiteController extends Controller
{
    var $analitics;
    public function __construct(Analytics $analytics)
    {
        $this->analitics=$analytics;
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Analytics $analytics)
    {
        return view('websites.index', [
            'websites' =>  $this->analitics->getWebsites()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('websites.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreWebsiteRequest $request)
    {
        $this->analitics->createWebsite($request->all());
        return redirect()->route('website.index')
            ->withSuccess(_('New website is added successfully.'));
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return view('websites.show', [
            'website' =>  $this->analitics->getWebsite($id)
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        return view('websites.edit', [
            'website' =>   $this->analitics->getWebsite($id)
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreWebsiteRequest $request, string $id)
    {
        $this->analitics->updateWebsite($request->all(),$id);
        return redirect()->back()
            ->withSuccess('Website is updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $this->analitics->deleteWebsite($id);
        return redirect()->route('website.index')
            ->withSuccess('Website is deleted successfully.');
    }
}
