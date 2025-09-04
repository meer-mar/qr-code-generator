<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Faqs;
class FaqsController extends Controller
{
  /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $faqs = Faqs::paginate(10);
        return view("dashboard.admin.faqs.manage", compact('faqs'));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view("dashboard.admin.faqs.create");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'question' => 'required',
            'answer' => 'required',

        ]);


        $data = Faqs::create([

            'question' => $request->question,
            'answer' => $request->answer,


        ]);

        if ($data) {
            return redirect()->route('faqs.manage')->with('success','Faqs Created Successfully.');
        } else {
            return redirect()->route('faqs.manage')->with('error','Something Went Wrong');
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        // $data = $faqs::where('id', $id);
        $faqs  = Faqs::findOrFail($id);
        return view("dashboard.admin.faqs.edit", compact('faqs'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Faqs $faqs, $id)
    {


        $data = [
            'question' => $request->question,
            'answer' => $request->answer,
        ];

        $update = $faqs->where('id', $id)->update($data);


        // $update = $faqs->where('id', $id)->update($data);
        if ($update) {
            return redirect()->route('faqs.manage')->with('success','Faqs Updated Successfully.');
        } else {
            return redirect()->route('faqs.manage')->with('error','Something Went Wrong');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Faqs $faqs, int $id)
    {
        // $success = $faqs->destroy($id);



        $success = $faqs->destroy($id);

        if ($success) {
            return redirect()->route('faqs.manage')->with('success','Faqs Deleted successfully.');
        } else {
            return redirect()->route('faqs.manage')->with('error','Something Went Wrong');
    }
}
}
