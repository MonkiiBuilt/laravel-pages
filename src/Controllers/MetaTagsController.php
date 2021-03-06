<?php
/**
 * @author Jonathon Wallen
 * @date 20/6/17
 * @time 2:01 PM
 * @copyright 2008 - present, Monkii Digital Agency (http://monkii.com.au)
 */

namespace MonkiiBuilt\LaravelPages\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use MonkiiBuilt\LaravelPages\Models\Page;
use MonkiiBuilt\LaravelPages\Models\PageMetaTag;

class MetaTagsController extends Controller
{
    // to use the package registry we first need to inject it into the controller
    public function __construct(\MonkiiBuilt\LaravelAdministrator\PackageRegistry $packageRegistry)
    {
        $this->packageRegistry = $packageRegistry;
    }

    public function create(Request $request, $pageId)
    {
        $page = Page::findOrFail($pageId);
        $tabs = $this->packageRegistry->getTabs('editPage', $pageId);

        return view('pages::meta.create', [
            'page' => $page,
            'tabs' => $tabs,
        ]);
    }

    public function edit(Request $request, $id)
    {
        $meta = PageMetaTag::findOrFail($id);
        $tabs = $this->packageRegistry->getTabs('editPage', $id);

        return view('pages::meta.edit', [
            'meta' => $meta,
            'tabs' => $tabs,
        ]);
    }

    public function store(Request $request, $pageId)
    {
        $page = Page::findOrFail($pageId);

        $input = $request->input();

        $meta = new PageMetaTag($input);

        $page->metaTags()->save($meta);

        return \Redirect::route('laravel-administrator-pages-meta', ['pageId' => $pageId]);
    }

    public function update(Request $request, $id)
    {
        $meta = PageMetaTag::findOrFail($id);

        $input = $request->input();

        $meta->update($input);

        return \Redirect::route('laravel-administrator-pages-meta', ['pageid' => $meta->page->id]);
    }

    public function delete(Request $request, $id)
    {
        $meta = PageMetaTag::findOrFail($id);

        $meta->delete();

        return \Redirect::route('laravel-administrator-pages-meta', ['pageId' => $meta->page->id]);
    }
}
