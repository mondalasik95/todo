<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
//using DB Facade
use Illuminate\Support\Facades\DB;

class TodoController extends Controller
{
    public function getAllTodos(){
        $todos = DB::table('users')
        ->join('todos','users.user_id','=','todos.user_id')
        ->select('users.name','todos.*')
        ->get();
       // dd($todos);
       //traditional php approach of converting php array into json object.
       // return json_encode($todos);
       //laravelic way of type casting into json object.
       return response()->json($todos); 
    }

    public function getTodoById($todo_id,Request $req){
      if($req->isMethod('GET')){
        $todo = DB::table('todos')->where('todo_id',$todo_id)->get();
        //dd($todo[0]);
        return response()->json($todo[0]);
      }
    }
    //getiing todo by its title.
    public function getTodoByTitle(Request $req){
      $title = $req->input('xyz');
      $todos = DB::table('todos')
               ->join('users','users.user_id','=','todos.user_id')
               ->select('users.name','todos.*')
               ->where('title','like','%'.$title.'%')
               ->orWhere('description','like','%'.$title.'%')
               ->get();
      return response()->json($todos);
    }

    public function makeSort(Request $req){
      $sortColumnName = $req->input('s1');
      $sortType       = $req->input('s2');
      $todos          = DB::table('users')
                        ->join('todos','users.user_id','=','todos.user_id')
                        ->select('users.name','todos.*')
                        ->orderBy($sortColumnName,$sortType)
                        ->get();
      return response()->json($todos);
    }

   //Data Add : POST
    public function addTodo(Request $req){
      //  dd($req->all());
      $req->validate([
            'title'        => 'required',
            'desc'         => 'required',
            'user_id'      => 'required',
        ]);

          $dataToInsert =[
              'title'       => $req->input('title'),
              'description' => $req->input('desc'),
              'user_id'     => $req->input('user_id')
          ];
          $affectedRows = DB::table('todos')->insert($dataToInsert);
         if($affectedRows ==1)
            return response()->json(['message'=>'One todo has been Added']);
         else 
            return response()->json(['message'=>'Unable to add todo']);
    }

   //Data :put[single]/patch[Bulk]
   public function updateTodo($todo_id,Request $req){
         if($req->isMethod('PUT') || $req->isMethod('PATCH')){
                
            //dd($req->all());
            $editTitle = $req->input('title');
            $editDesc  = $req->input('description');
            $editCreated=$req->input('created');

            $affectedRows =DB::table('todos')->where('todo_id',$todo_id)->update([
                          'title'      => $editTitle,
                          'description'=> $editDesc,
                          'created'    => $editCreated,
                          ]);
            if($affectedRows==1)
               return response()->json(['message'=>'One todo Info has been Updated']);
            else 
               return response()->json(['message'=>'Unable to Update Now']);
         }else{
            return response()->json(['message'=>$req->__METHOD__.' is not supported']);
         }
   }  

   //DELETE: Method Data delete from Database
     public function deleteTodo($todo_id){
          $affectedRows =DB::table('todos')
                           ->where('todo_id',$todo_id)
                           ->delete();
         if($affectedRows==1)
            return response()->json(['message'=>'One Todo Info has been Deleted']);
         else 
            return response()->json(['message'=>'Unable to Delete Info']);
     }
}
