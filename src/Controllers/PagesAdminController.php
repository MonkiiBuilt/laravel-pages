<?php
/**
 * @author Jonathon Wallen
 * @date 19/4/17
 * @time 2:08 PM
 * @copyright 2008 - present, Monkii Digital Agency (http://monkii.com.au)
 */

namespace MonkiiBuilt\LaravelPages\Controllers;


use App\Http\Controllers\Controller;
use App\Models\User;
use MonkiiBuilt\LaravelPages\Models\Page;
use Illuminate\Http\Request;
use MonkiiBuilt\LaravelPages\Models\PageSection;
use MonkiiBuilt\LaravelAdministrator\PackageRegistry;


/**
 * Class PagesAdminController
 * @package MonkiiBuilt\LaravelPages\Controllers
 */
class PagesAdminController extends Controller
{
    private $packageRegistry;

    public function __construct(PackageRegistry $packageRegistry)
    {
        $this->packageRegistry = $packageRegistry;
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Request $request)
    {
        $pages = Page::all();

        return view('pages::admin.index', ['pages' => $pages]);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create(Request $request)
    {
        $typesConfig= config('laravel-administrator.pageTypes');

        $types = [];

        foreach ($typesConfig as $type) {
            $types[$type['machine_name']] = $type['label'];
        }

        return view('pages::admin.create', ['types' => $types]);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit(Request $request, $id)
    {
        $page = Page::findOrFail($id);
        $tabs = $this->packageRegistry->getTabs('editPage', $id);

        return view('pages::admin.edit', [
            'page' => $page,
            'tabs' => $tabs,
        ]);
    }

    /**
     * Save the most basic essential info of a page.
     * Make sure it's not published as at this stage there is no content
     * in any of it's required sections.
     *
     * @param \Illuminate\Http\Request $request
     * @return mixed
     */
    public function store(Request $request)
    {

        $data = [
            'title' => $request->input('title'),
            'page_type' => $request->input('page_type'),
            'published' => 0,
            'created_by' => \Auth::user()->id,
            'updated_by' => \Auth::user()->id,
        ];

        $rules = [
            'title' => 'required',
            'page_type' => 'required',
        ];

        $messages = [
            'title.required' => 'Title field is required',
            'page_type.required' => 'Please select a page type',
        ];

        // Make the validator
        $validator = \Validator::make($request->all(), $rules, $messages);

        // Validate the data
        $validator->validate($request, $rules);

        $page = Page::create($data);

        // Create the content sections for the chosen page type
        $typesConfig= config('laravel-administrator.pageTypes');

        $sections = $typesConfig[$data['page_type']]['sections'];

        foreach ($sections as $delta => $sectionConfig) {

            // Check for existence of page section class (package may have not been added)
            if(!class_exists($sectionConfig['class'])) {
              continue;
            }

            // merge default validation rules with any custom ones defined in config

            $section = new $sectionConfig['class'](
                [
                    'delta' => $delta,
                    'machine_name'  => $sectionConfig['machine_name'],
                    'label' => $sectionConfig['label'],
                    'type' => $sectionConfig['type'],
                    'rules' => isset($sectionConfig['rules']) ? $sectionConfig['rules'] : null,
                    'messages' => isset($sectionConfig['messages']) ? $sectionConfig['messages'] : null,
                    'data' => isset($sectionConfig['data']) ? $sectionConfig['data'] : null,
                ]
            );
            $page->sections()->save($section);
        }

        return \Redirect::route('laravel-administrator-pages-edit', ['id' => $page->id]);
    }

    /**
     * Update a page including any sections.
     *
     * @param \Illuminate\Http\Request $request
     * @param $id
     * @return mixed
     */
    public function update(Request $request, $id)
    {
        $page = Page::findOrFail($id);

        $data = $request->input();

        $rules = ['title' => 'required'];

        $messages = ['title.required' => 'Title field is required'];

        $sectionIds = array_keys($data['sections']);

        foreach ($page->sections as $section) {

            /**
             * If a section is missing from the data array then it's
             * being removed on this edit so don't try validating it.
             */
            if (!in_array($section->id, $sectionIds)) {
                continue;
            }

            /**
             * Collect any validation rules page sections may have
             * defined in their models.
             */
            if (is_array($section->rules)) {
                foreach ($section->rules as $name => $rule) {
                    $rules['sections.' . $section->id . '.data.' . $name] = $rule;
                }
            }

            /**
             * Collect any validation custom messages page sections
             * may have defined in their models.
             */
            if (is_array($section->messages)) {
                foreach ($section->messages as $name => $message) {
                    $messages['sections.' . $section->id . '.data.' . $name] = $message;
                }
            }

        }

        // Make the validator
        $validator = \Validator::make($request->all(), $rules, $messages);

        // Validate the data
        $validator->validate($request, $rules);

        // Update the page itself
        $page->update($data);

        // sync the page sections
        $delta = 0;
        foreach ($data['sections'] as $id => $sectionData) {
            $data['sections'][$id]['id'] = $id;
            $data['sections'][$id]['delta'] = $delta;
            $data['sections'][$id]['data'] = $sectionData['data'];
            $delta++;
        }

        $page->syncSections($data['sections']);

        return \Redirect::route('laravel-administrator-pages');
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param $id
     * @return mixed
     */
    public function destroy(Request $request, $id)
    {
        $page = Page::findOrFail($id);

        $page->delete();

        return \Redirect::route('laravel-administrator-pages');
    }

    /**
     * @param $id
     *
     * @return mixed
     */
    public function view($id) {
        $page = Page::findOrFail($id);
        $created_by = null;
        $updated_by = null;

        return view('pages::page.view',
            [
                'page'       => $page,
                'created_by' => $created_by,
                'updated_by'  => $updated_by,
            ]
        );
    }
}
