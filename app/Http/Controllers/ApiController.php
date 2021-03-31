<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Mail\WelcomeMail;
use App\Jobs\JobWelcome;
use MainRepository, Validator, Auth, Mail;

class ApiController extends Controller
{
    //
    public function createcategory(Request $request){
        $validation = Validator::make($request->all(), [
            'name'      => 'required|string'
        ]);

        if($validation->fails()){
            return response()->json([
                'response'      => false,
                'message'       => $validation->messages()->first()
            ], 422);
        }

        return response()->json([
            'response'          => true,
            'data'              => MainRepository::insertcategory($request)
        ], 200);
    }

    public function getcategories($item = null){
        if($item > ''){
            return response()->json([
                'response'      => true,
                'data'          => MainRepository::getcategory($item)
            ], 200);
        }
        return response()->json([
            'response'      => true,
            'data'          => MainRepository::getcategory()
        ], 200);
    }

    public function editcategory($id = null, Request $request){
        $validation = Validator::make($request->all(),[
            'name'          => 'required|string'
        ]);

        if($validation->fails()){
            return response()->json([
                'response'      => false,
                'message'       => $validation->messages()->first()
            ], 422);
        }

        return response()->json([
            'response'      => true,
            'data'          => MainRepository::edititem($id, $request)
        ], 200);
    }

    public function deletecategory($id){
        return response()->json([
            'response'      => true,
            'data'          => MainRepository::deleteitem($id)
        ], 200);
    }

    /**
     * API Call for item(s)
     */
    public function createitem(Request $request){
        $validation = Validator::make($request->all(), [
            'name'          => 'required|string',
            'category_id'   => 'required|numeric'
        ]);

        if($validation->fails()){
            return response()->json([
                'response'  => false,
                'message'   => $validation->messages()->first()
            ], 422);
        }

        return response()->json([
            'response'      => true,
            'data'          => MainRepository::createitem($request)
        ], 200);
    }

    public function getitems($item = null){
        if($item > ''){
            return response()->json([
                'response'      => true,
                'data'          => MainRepository::getitems($item)
            ], 200);
        }

        return response()->json([
            'response'      => true,
            'data'          => MainRepository::getitems()
        ], 200);
    }

    public function edititem($id, Request $request){
        $validation = Validator::make($request->all(), [
            'name'          => 'required|string',
            'category_id'   => 'required|numeric'
        ]);
        
        if($validation->fails()){
            return response()->json([
                'response'      => false,
                'message'       => $validation->message()->first()
            ], 422);
        }

        return response()->json([
            'response'          => true,
            'data'              => MainRepository::edititembyid($id, $request)
        ], 200);

    }

    public function deleteitem($id){
        return response()->json([
            'response'      => true,
            'data'          => MainRepository::deleteitemviaid($id)
        ], 200);
    }

    public function userregistration(Request $request){
        $validation = Validator::make($request->all(), [
            'name'      => 'required|string',
            'email'     => 'required|email|unique:users,email',
            'password'  => 'required|string'
        ]);

        if($validation->fails()){
            return response()->json([
                'response'      => false,
                'message'       => $validation->messages()->first()
            ], 422);
        }

        $data = MainRepository::userregister($request);

        if($data){
            // Mail::to($data->email)->send(new WelcomeMail());
            $sendwelcome = new JobWelcome($data->email);
            dispatch($sendwelcome);
            return response()->json([
                'response'      => true,
                'message'       => "Succesful"
            ], 200);
        }

        return response()->json([
            'response'      => false,
            'message'       => "Something went wrong.."
        ], 422);

        // return response()->json([
        //     'response'      => true,
        //     'data'          => MainRepository::userregister($request)
        // ], 200);
    }

    public function sendemail($email){
        Mail::to($email)->send(new WelcomeMail());
    }

    public function userlogin(Request $request){

        $validation = Validator::make($request->all(),[
            'email'     => 'required|email',
            'password'  => 'required|string'
        ]);

        if($validation->fails()){
            return response()->json([
                'response'      => false,
                'message'       => $validation->messages()->first()
            ], 422);
        }

        $data = Auth::attempt([
            'email'     => $request->email,
            'password'  => $request->password
        ]);

        if($data){
            return response()->json([
                'response'      => true,
                'data'          => MainRepository::issuetoken(Auth::user())
            ], 200);
        }

        return response()->json([
            'response'          => false,
            'message'           => "Something went wrong.."
        ], 422);
    }

    public function logout(){
        $data = Auth::user();
        // $request->user()->currentAccessToken()->delete();
        return $data->currentAccessToken()->delete();
    }
}
