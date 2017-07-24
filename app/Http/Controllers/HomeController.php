<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Countries;
use App\States;
use App\Postdatas;
use Illuminate\Support\Facades\Input;
use Validator;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\File;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        return view('crud.crud',[
            'datas'=>Postdatas::get()
            ]);
    }

    public function getadd()
    {
        $Countries=Countries::get();
        return view('crud.add',[
            'Countries'=>$Countries
            ]);
    }

    public function postAdd(Request $request)
    {
       $validator= Validator::make($request->all(), [
            'name' => 'required',
            'country' => 'required',
            'state' => 'required',
            'textarea' => 'required',
            'file' => 'required',
            'checkbox' => 'required',
            'gender' => 'required',
            'input'=> 'required'
        ]);
        if ($validator->fails())
        {
            return back()->withErrors($validator->errors())->withInput(Input::all());
        }
        $checkbox = array_filter($request->checkbox);
        $input = array_filter($request->input);
        $data= new Postdatas();
        $data->name=$request->name;
        $data->country=$request->country;
        $data->state=$request->state;
        $data->textarea=$request->textarea;
        $data->checkbox=implode(',', $checkbox);
        $data->gender=$request->gender;
        $data->input=implode(',', $input);
        $data->save();
        if($data){
            if($request->hasFile('file')){
                $file = Input::file('file');
                $dest = public_path().'/image/';
                $name = str_random(6).'_'. $file->getClientOriginalName();

                $file->move($dest,$name);

                $user      = Postdatas::find($data->id);
                $user->file  = $name;
                $user->save();
            }
        }
            return back()->with(array('success_message'=>'add successfull'));

    }

    public function editcrud(Request $request,Postdatas $Id)
    {
        $Countries=Countries::get();

        return view('crud.edit',[
            'Countries'=>$Countries,
            'data'=>$Id
            ]);
    }

    public function posteditcrud(Request $request,Postdatas $Id){
        $validator= Validator::make($request->all(), [
            'name' => 'required',
            'country' => 'required',
            'state' => 'required',
            'textarea' => 'required',
            //'file' => 'required',
            'checkbox' => 'required',
            'gender' => 'required',
            'input'=> 'required'
        ]);
        if($validator->fails()){
            return back()->withErrors($validator->errors())->withInput(input::all());
        }
        $data=Postdatas::where('id',$Id->id)->first();
        if(count($data) > 0){
            $checkbox = array_filter($request->checkbox);
            $input = array_filter($request->input);

            $data->name=$request->name;
            $data->country=$request->country;
            $data->state=$request->state;
            $data->textarea=$request->textarea;
            $data->checkbox=implode(',', $checkbox);
            $data->gender=$request->gender;
            $data->input=implode(',', $input);
            $data->update();
        }

        if($request->hasFile('file')){
            $file_path = public_path().'/image/'.$data->file;//app_path("public/image/".$data->file); // app_path("public/test.txt");

            if(File::exists($file_path)) {
                File::delete($file_path);
            }
            $file = Input::file('file');
            $dest = public_path().'/image/';
            $name = str_random(6).'_'. $file->getClientOriginalName();

            $file->move($dest,$name);

            $user      = Postdatas::find($Id->id);
            $user->file  = $name;
            $user->save();
        }
        return back()->with(array('success_message'=>'edit successfull'));
        

    }

    public function getdelete(Request $request,Postdatas $Id){
        $file_path = public_path().'/image/'.$Id->file;
            if(File::exists($file_path)) {
                File::delete($file_path);
            }
            Postdatas::where('id',$Id->id)->delete();
            return back()->with(array('success_message','delete successfull'));
    }

    public function getStates(Request $request){
        $state=States::where('country_id',$request->countryId)->get();

        return Response()->json($state);
    }
}