<?php
/**
 * @author Jonathon Wallen
 * @date 19/4/17
 * @time 2:08 PM
 * @copyright 2008 - present, Monkii Digital Agency (http://monkii.com.au)
 */

namespace MonkiiBuilt\LaravelPages\Controllers;


use App\Http\Controllers\Controller;
use MonkiiBuilt\LaravelPages\Models\Page;
use Illuminate\Http\Request;

class PagesAdminController extends Controller
{

    public function index(Request $request)
    {

        return view('pages::admin.index');
    }

    public function create(Request $request)
    {

        return view('pages::admin.create');
    }

    public function edit(Request $request, $id)
    {
        $page = Page::findOrFail($id);

        return view('pages::admin.edit', ['page' => $page]);
    }

    public function store(Request $request)
    {

        return \Redirect('laravel-administrator-pages');
    }

    public function update(Request $request, $id)
    {
        $page = Page::findOrFail($id);

        return \Redirect('laravel-administrator-pages');
    }

    public function destroy(Request $request, $id)
    {
        $page = Page::findOrFail($id);

        return \Redirect('laravel-administrator-pages');
    }
}