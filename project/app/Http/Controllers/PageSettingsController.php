<?php

namespace App\Http\Controllers;

use App\Brand;
use App\FAQ;
use App\PageSettings;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class PageSettingsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $brands = Brand::where('type','brand')->get();
        $banners = Brand::where('type','banner')->get();
        $faqs = FAQ::all();
        $pagedata = PageSettings::find(1);
        return view('admin.pagesettings',compact('pagedata','faqs','brands','banners'));
    }

    //Banner Add,Edit,Update
    public function addbanner()
    {
        return view('admin.banneradd');
    }

    public function bannerdelete($id)
    {
        Brand::findOrFail($id)->delete();
        return redirect('admin/pagesettings')->with('message','Banner Deleted Successfully.');
    }

    public function banneredit($id)
    {
        $banner = Brand::findOrFail($id);
        return view('admin.banneredit',compact('banner'));
    }

    public function bannersave(Request $request)
    {
        $brand = new Brand();
        $brand->fill($request->all());
        $brand->type='banner';
        if ($file = $request->file('blogo')){
            $photo_name = time().$request->file('blogo')->getClientOriginalName();
            $file->move('assets/images/brands',$photo_name);
            $brand['image'] = $photo_name;
        }
        $brand->save();
        Session::flash('message', 'New Banner Added Successfully.');
        return redirect('admin/pagesettings');
    }

    public function bannerupdate(Request $request,$id)
    {
        $brand = Brand::findOrFail($id);
        $data = $request->all();
        $data['type']='banner';
        if ($file = $request->file('blogo')){
            $photo_name = time().$request->file('blogo')->getClientOriginalName();
            $file->move('assets/images/brands',$photo_name);
            $data['image'] = $photo_name;
        }
        $brand->update($data);
        Session::flash('message', 'Banner Updated Successfully.');
        return redirect('admin/pagesettings');
    }

    //Brand Logo Add,Edit,Update
    public function addbrand()
    {
        return view('admin.brandadd');
    }

    public function branddelete($id)
    {
        Brand::findOrFail($id)->delete();
        return redirect('admin/pagesettings')->with('message','Brand Deleted Successfully.');
    }

    public function brandedit($id)
    {
        $brand = Brand::findOrFail($id);
        return view('admin.brandedit',compact('brand'));
    }

    public function brandsave(Request $request)
    {
        $brand = new Brand();
        $brand->fill($request->all());
        $brand->type='brand';
        if ($file = $request->file('blogo')){
            $photo_name = time().$request->file('blogo')->getClientOriginalName();
            $file->move('assets/images/brands',$photo_name);
            $brand['image'] = $photo_name;
        }
        $brand->save();
        Session::flash('message', 'New Brand Logo Added Successfully.');
        return redirect('admin/pagesettings');
    }
    //Large Banner
    public function largebanner(Request $request)
    {
        $page = PageSettings::findOrFail(1);
        $input = $request->all();

        if ($file = $request->file('large_banner')) {
            $banner = $request->file('large_banner');
            $name = time().$banner->getClientOriginalName();
            $banner->move('assets/images', $name);
            $input['large_banner'] = $name;
        }
        $page->update($input);
        Session::flash('message', 'Large Banner Updated Successfully.');
        return redirect('admin/pagesettings');
    }

    public function brandupdate(Request $request,$id)
    {
        $brand = Brand::findOrFail($id);
        $data = $request->all();
        $brand->update($data);
        Session::flash('message', 'Brand Updated Successfully.');
        return redirect('admin/pagesettings');
    }

    //FAQ Page Add,Edit,Update
    public function addfaq()
    {
        return view('admin.faqadd');
    }

    public function faqdelete($id)
    {
        FAQ::findOrFail($id)->delete();
        return redirect('admin/pagesettings')->with('message','FAQ Deleted Successfully.');
    }

    public function faqedit($id)
    {
        $faq = FAQ::findOrFail($id);
        return view('admin.faqedit',compact('faq'));
    }

    public function faqsave(Request $request)
    {
        $faq = new FAQ();
        $faq->fill($request->all());
        $faq->save();
        Session::flash('message', 'New FAQ Added Successfully.');
        return redirect('admin/pagesettings');
    }

    public function faqupdate(Request $request,$id)
    {
        $faq = FAQ::findOrFail($id);
        $data = $request->all();
        $faq->update($data);
        Session::flash('message', 'FAQ Updated Successfully.');
        return redirect('admin/pagesettings');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    //Upadte About Page Section Settings
    public function about(Request $request)
    {
        $page = PageSettings::findOrFail(1);
        $input = $request->all();
        if ($request->a_status == ""){
            $input['a_status'] = 0;
        }
        $page->update($input);
        Session::flash('message', 'About Us Page Content Updated Successfully.');
        return redirect('admin/pagesettings');
    }

    //Upadte FAQ Page Section Settings
    public function faq(Request $request)
    {
        $page = PageSettings::findOrFail(1);
        $input = $request->all();
        if ($request->f_status == ""){
            $input['f_status'] = 0;
        }
        $page->update($input);
        Session::flash('message', 'FAQ Page Content Updated Successfully.');
        return redirect('admin/pagesettings');
    }

    //Upadte Contact Page Section Settings
    public function contact(Request $request)
    {
        $page = PageSettings::findOrFail(1);
        $input = $request->all();
        if ($request->c_status == ""){
            $input['c_status'] = 0;
        }
        $page->update($input);
        Session::flash('message', 'Contact Page Content Updated Successfully.');
        return redirect('admin/pagesettings');
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
