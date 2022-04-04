<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Command;

class ApiController extends Controller
{
    public function get_resources(Request $request){
        $memory = (memory_get_usage(true))/1048576;

        $data = array(
            "memory" => $memory,
        );

        return $data;
   }

    public function add_command(Request $request){
        $command = new Command();
        $command->command = $request->get("command");
        $command->description = $request->get("description");
        $command->result = $request->get("result");

        $command->save();

        return $command;
    }

    public function get_commands(){
        $commands = Command::get();
        return $commands;
    }

    public function delete_command(Request $request){
        $command = Command::find($request->id);
        $command->delete();
    }

    public function edit_command(Request $request){
        $command = Command::find($request->id);

        $command->command = $request->command;
        $command->description = $request->description;
        $command->result = $request->result;

        $command->save();

        return $command;
    }

    public function process_command(Request $request){
        
        if(!$request->command){
            $postdata = file_get_contents("php://input");
            $request = json_decode($postdata);
        }


        if($request->command == "help"){
            $command = Command::select('command', 'description')->orderBy('command', 'asc')->get();
        }else{
            $command = Command::select('command', 'result')->where('command', $request->command)->get();
            
            if($command->isEmpty()){
                $command[0] = ["command" => $request->command, "description"=>"The command does not exist"];
            }
        }
        
        
        
        return $command;
    }

    public function authenticate(Request $request){
        
        $credentials = [
            'email' => $request->email,
            'password' => $request->password
        ];

        //var_dump(Auth::check());
        if(Auth::check()){
            $response = [
                "0"=> [
                    "command" => "You are already loged in",
                    "result" => ""
                ]
            ];
        }else if(Auth::attempt($credentials)){
        //if(Auth::attempt($credentials)){
            //return redirect()->intended('commands');
            $response = [
                "0"=> [
                    "command" => "Welcome " . Auth::user()->name,
                    "result" => "Now you can edit the commands go to /commands",
                ]
            ];
        }else{
            $response = [
                "0" => [
                    "command" => "Error",
                    "result" => "The credentials are wrong, try again"
                ]
            ];
        }

        echo json_encode($response);
    }
}
