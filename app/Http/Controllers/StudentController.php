<?php

namespace App\Http\Controllers;

use App\Models\Student;
use illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class StudentController extends Controller
{
    public function showAllStudents()
    {
        return response()->json(Student::all());
    }

    public function showOneStudent($id)
    {
        return response()->json(Student::find($id));
    }

    public function create(Request $request)
    {
        $this->validate($request,[
            'nbi' => 'required|unique:students',
            'name' => 'required',
            'latitude' => 'required',
            'longitude' => 'required'
        ]);

        $images = 'user.jpg';
        if($request->hasFile('photo')){
            $extension = $request->file('photo')->getClientOriginalExtension();
            $images = $request->nbi.'.'.$extension;
            $destination = 'images';
            $request->file('photo')->move($destination,$images);
        }

        Student::create([
            'nbi' => $request->nbi,
            'name' => $request->name,
            'place_of_birth' => $request->place_of_birth,
            'date_of_birth' => $request->date_of_birth,
            'phone' => $request->phone,
            'address' => $request->address,
            'faculty' => $request->faculty,
            'major' => $request->major,
            'gender' => $request->gender,
            'hoby' => $request->hoby,
            'nationality' => $request->nationality,
            'photo' => $images,
            'latitude' => $request->latitude,
            'longitude' => $request->longitude
        ]);

        return response()->json(array("status" => 'success'), 200);
    }

    public function update($id, Request $request)
    {
        $this->validate($request,[
            'nbi' => 'required',
            'name' => 'required',
            'latitude' => 'required',
            'longitude' => 'required'
        ]);
        $student = Student::findOrFail($id);
        if($student->nbi != $request->nbi){
            $this->validate($request,[
                'nbi' => 'unique:students'
            ]);
        }

        $images = 'user.jpg';
        if($request->hasFile('photo')){
            $extension = $request->file('photo')->getClientOriginalExtension();
            $images = $request->nbi.'.'.$extension;
            $fileNow = explode('.',$student->photo);
            if($request->nbi == $fileNow[0]){
                Storage::delete($student->photo);
            }
            $destination = 'images';
            $request->file('photo')->move($destination,$images);
        }
        
        $student->update([
            'nbi' => $request->nbi,
            'name' => $request->name,
            'place_of_birth' => $request->place_of_birth,
            'date_of_birth' => $request->date_of_birth,
            'phone' => $request->phone,
            'address' => $request->address,
            'faculty' => $request->faculty,
            'major' => $request->major,
            'gender' => $request->gender,
            'hoby' => $request->hoby,
            'nationality' => $request->nationality,
            'photo' => $images,
            'latitude' => $request->latitude,
            'longitude' => $request->longitude
        ]);

        return response()->json(array("status" => 'success'), 200);
    }

    public function delete($id)
    {
        Student::findOrFail($id)->delete();
        return response()->json(array("status" => 'success'), 200);
    }

    public function anu(Request $request){

        return response()->json(array("status" => 'success'), 200);
    }
}
