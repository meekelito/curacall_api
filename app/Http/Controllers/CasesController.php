<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\User;
use App\Cases;
use App\Keys;
use Validator;


class CasesController extends Controller
{

  public function index(Request $request)
  {
    return "Baby girl!";
  }

  public function newCase(Request $request)
  {
    $validator = Validator::make($request->all(),[ 
    	'case_id' => 'required|unique:cases,case_id', 
    	'case_message' => 'required',
      'api_key' => 'required'
    ]);

    if( $validator->fails() ){
    	return json_encode(array( 
        "status"=>0,
        "response"=>"error", 
        "message"=>$validator->errors()
      ));
    }

    $key_status = Keys::where('api_key',$request->api_key)
                ->where('status','active')
                ->get();

    if ( $key_status->isEmpty() ){
      return json_encode(array(
        "status" => 0,
        "response" => "failed", 
        "message" => "Error in connection."
      ));
    }
      

    $res = Cases::create($request->all());

    if($res){
    	return json_encode(array(
        "status" => 1,
        "response" => "success", 
        "message" => "Successfully sent."
      ));
    }else{
    	return json_encode(array(
        "status" => 0,
        "response" => "failed", 
        "message" => "Error in connection."
      ));
    }
  }

  public function deleteCase(Request $request)
  {

    $validator = Validator::make($request->all(),[ 
      'case_id' => 'required', 
      'api_key' => 'required'
    ]);

    if( $validator->fails() ){
      return json_encode(array( 
        "status"=>0,
        "response"=>"error", 
        "message"=>$validator->errors()
      ));
    }

    $res = Cases::where('id', $request->case_id)->where('is_read', 0)->delete(); 

    if($res){
      return json_encode(array(
        "status" => 1,
        "response" => "success", 
        "message" => "Successfully deleted."
      ));
    }else{
      return json_encode(array(
        "status" => 0,
        "response" => "failed", 
        "message" => "Error in connection."
      ));
    }
  }


}
