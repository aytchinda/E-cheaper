<?php

namespace App\Http\Controllers;

use App\Models\Page;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\PageFormRequest;
use Illuminate\Support\Facades\Storage;

class PageController extends Controller
{
    public function index(): View
    {
        $pages = Page::orderBy('created_at', 'desc')->paginate(5);
        return view('pages/index', ['pages' => $pages]);
    }

    public function show($id): View
    {
        $page = Page::findOrFail($id);

        return view('pages/show', ['page' => $page]);
    }
    public function create(): View
    {
        return view('pages/create');
    }

    public function edit($id): View
    {
        $page = Page::findOrFail($id);
        return view('pages/edit', ['page' => $page]);
    }

    public function store(PageFormRequest $req): RedirectResponse
    {
        $data = $req->validated();

        // Assurez-vous que les valeurs de checkbox sont correctement traitées
        $data['isHead'] = $req->boolean('isHead');
        $data['isFoot'] = $req->boolean('isFoot');

        $page = Page::create($data);
        return redirect()->route('admin.page.show', ['id' => $page->id]);
    }

    public function update(Page $page, PageFormRequest $req)
    {
        $data = $req->validated();

        // Assurez-vous que les valeurs de checkbox sont correctement traitées
        $data['isHead'] = $req->boolean('isHead');
        $data['isFoot'] = $req->boolean('isFoot');

        $page->update($data);

        return redirect()->route('admin.page.show', ['id' => $page->id]);
    }



    public function updateSpeed(Page $page, Request $req)
    {
        $data = $req->all();

        // Assurez-vous que les valeurs de checkbox sont correctement traitées
        if (isset($data['isHead'])) {
            $data['isHead'] = $req->boolean('isHead');
        } else {
            $data['isHead'] = false;
        }

        if (isset($data['isFoot'])) {
            $data['isFoot'] = $req->boolean('isFoot');
        } else {
            $data['isFoot'] = false;
        }

        $page->update($data);

        return [
            'isSuccess' => true,
            'data' => $data
        ];
    }


    public function delete(Page $page)
    {

        $page->delete();

        return [
            'isSuccess' => true
        ];
    }


}
