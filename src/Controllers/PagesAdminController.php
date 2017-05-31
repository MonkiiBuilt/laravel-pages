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
        $typesConfig= config('laravel-administrator.pageTypes');

        $types = [];

        foreach ($typesConfig as $type) {
            $types[$type['name']] = $type['label'];
        }

        return view('pages::admin.create', ['types' => $types]);
    }

    public function edit(Request $request, $id)
    {
        $page = Page::findOrFail($id);

        return view('pages::admin.edit', ['page' => $page]);
    }

    public function store(Request $request)
    {

        $data = [
            'title' => $request->input('title'),
            'page_type' => $request->input('page_type'),
            'created_by' => \Auth::user()->id,
            'updated_by' => \Auth::user()->id,
        ];

        $page = Page::create($data);

        // Create the content sections for the chosen page type
        $typesConfig= config('laravel-administrator.pageTypes');

        $sections = $typesConfig[$data['page_type']]['sections'];

        foreach ($sections as $delta => $sectionConfig) {
            $section = new $sectionConfig['class'](
                [
                    'delta' => $delta,
                    'form_element_name'  => $sectionConfig['form_element_name'],
                    'form_element_label' => $sectionConfig['form_element_label'],
                    'type' => $sectionConfig['type'],
                ]
            );
            $page->sections()->save($section);
        }

        return \Redirect::route('laravel-administrator-pages-edit', ['id' => $page->id]);
    }

    public function update(Request $request, $id)
    {
        $page = Page::findOrFail($id);

        $data = $request->input();

        $page->update([
            'title' => $data['title']
        ]);

        foreach ($page->sections as $section) {
            $section->update([
                'data' => $data['sections'][$section->id],
            ]);
        }

        return \Redirect::route('laravel-administrator-pages');
    }

    public function destroy(Request $request, $id)
    {
        $page = Page::findOrFail($id);

        return \Redirect::route('laravel-administrator-pages');
    }
}