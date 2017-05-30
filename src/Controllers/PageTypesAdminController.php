<?php
/**
 * @author Jonathon Wallen
 * @date 29/5/17
 * @time 3:00 PM
 * @copyright 2008 - present, Monkii Digital Agency (http://monkii.com.au)
 */

namespace MonkiiBuilt\LaravelPages\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use MonkiiBuilt\LaravelPages\Models\PageSection;
use MonkiiBuilt\LaravelPages\Models\PageType;

class PageTypesAdminController extends Controller
{
    public function index(Request $request)
    {

        return view('pages::admin.page-types.index');
    }

    public function create(Request $request)
    {
        $subClasses = PageSection::getSingleTableSubclasses();

        $availableSections = [];
        foreach ($subClasses as $subClass) {
            $availableSections[$subClass] = $subClass::getSingleTableType();
        }

        return view('pages::admin.page-types.create', ['sections' => $availableSections]);
    }

    public function edit(Request $request, $id)
    {
        $type = PageType::findOrFail($id);

        return view('pages::admin.page-types.edit', ['pageType' => $type]);
    }

    public function store(Request $request)
    {

        return \Redirect::route('page-types.index');
    }

    public function update(Request $request, $id)
    {
        $pageType = PageType::findOrFail($id);

        return \Redirect('laravel-administrator-page-types');
    }

    public function destroy(Request $request, $id)
    {
        $pageType = PageType::findOrFail($id);

        return \Redirect('laravel-administrator-page-types');
    }
}