<?php
   
namespace App\Http\Controllers\Api;
   
use Illuminate\Http\Request;
use App\Http\Controllers\Api\BaseController as BaseController;
use Validator;
use App\Models\Note;
use App\Http\Resources\Note as NoteResource;
   
class NoteController extends BaseController
{

    public function index()
    {
        $notes = Note::where('user_id', auth()->user()->id)
               ->get();
        return $this->sendResponse(NoteResource::collection($notes), 'Notes fetched.');
    }

    
    public function store(Request $request)
    {
        $input = $request->all();
        $validator = Validator::make($input, [
            'title' => 'required|max:255',
            'description' => 'required'
        ]);
        
        if ($validator->fails()){
            return $this->sendError($validator->errors());       
        }
        
        $note = new Note();
        $note->title = $request->title;
        $note->description = $request->description;
        $note->user_id = auth()->user()->id;
        $note->save();
        
        return $this->sendResponse(new NoteResource($note), 'Note created.');
    }

   
    public function show($id)
    {
        $note = Note::find($id);
        
        if (is_null($note)) {
            return $this->sendError('Note does not exist.');
        }
        return $this->sendResponse(new NoteResource($note), 'Note fetched.');
    }
    

    public function update(Request $request, Note $note)
    {
        $input = $request->all();

        $validator = Validator::make($input, [
            'title' => 'required|max:255',
            'description' => 'required'
        ]);

        if($validator->fails()){
            return $this->sendError($validator->errors());       
        }

        $note->title = $input['title'];
        //$note->title = $request->title;
        $note->description = $input['description'];
        //$note->description = $request->description;
        $note->save();
        
        return $this->sendResponse(new NoteResource($note), 'Note updated.');
    }
   
    public function destroy($id)
    {
        $note = Note::find($id);
        if (is_null($note)) {
            return $this->sendError('Note does not exist.', 'Note NOT deleted.');
        }
        else {
            $note->delete();
            return $this->sendResponse([], 'Note deleted.');
        }
    }
}