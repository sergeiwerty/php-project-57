<?php

namespace App\Http\Controllers;

use App\Models\Label;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class LabelController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View
     *
     *
     */
    public function index(): View|Factory|Application
    {
        $labels = Label::all();
        return view('label.index', compact('labels'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Application|Factory|View|RedirectResponse|Redirector
     */
    public function create(): View|Factory|Redirector|RedirectResponse|Application
    {
        if (Auth::check()) {
            $label = new Label();
            return view('label.create', compact('label'));
        }
        return redirect('/login');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @return RedirectResponse
     * @throws ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        if (Auth::check()) {
            $this->validate($request, [
                'name' => 'required|max:100|unique:App\Models\Label'
            ], [
                'name.required' => __('validation.Field is required'),
                'name.max:100' => __('validation.Exceeded maximum name length of :max characters'),
                'name.unique' => __('validation.The label name has already been taken'),
            ]);

            $label = new Label();
            $label->fill($request->all());
            $label->save();

            if (Label::find($label->id)) {
                flash(__('label.Label has been added successfully'))->success();
            }

            return redirect()->route('labels.index');
        }
        return redirect('/login');
    }

    /**
     * Display the specified resource.
     *
     * @param  Label  $label
     * @return Response
     */
    public function show(Label $label)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Label  $label
     * @return Application|Factory|View|RedirectResponse|Redirector
     */
    public function edit(Label $label): View|Factory|Redirector|RedirectResponse|Application
    {
        if (Auth::check()) {
            $label = Label::findOrFail($label->id);
            return view('label.edit', compact('label'));
        }
        return redirect('/login');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Request  $request
     * @param  Label  $label
     * @return RedirectResponse
     */
    public function update(Request $request, Label $label): RedirectResponse
    {
        if (Auth::check()) {
            $label = Label::findOrFail($label->id);
            $this->validate($request, [
                'name' => 'required|max:100|unique:App\Models\Label',
            ], [
                'name.required' => __('validation.Field is required'),
                'name.max:100' => __('validation.Exceeded maximum name length of :max characters'),
                'name.unique' => __('validation.The label name has already been taken'),
            ]);

            $label->fill($request->all());
            $label->save();

            if (Label::find($label->id)) {
                flash(__('label.Label has been updated successfully'))->success();
            }

            return redirect()->route('labels.index');
        }
        return redirect('/login');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Label  $label
     * @return RedirectResponse
     */
    public function destroy(Label $label)
    {
        if (Auth::check()) {
            if (!$label->tasks()->exists()) {
                $label->delete();
                flash(__('label.Label has been deleted successfully'))->success();
                return redirect()->route('labels.index');
            }

            flash(__('label.Failed to delete label'))->error();
            return redirect()->route('labels.index');
        }
        return redirect('/login');
    }
}
