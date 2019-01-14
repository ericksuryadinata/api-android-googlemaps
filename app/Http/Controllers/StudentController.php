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
        $images1 = 'user.jpg';
        $images2 = 'user.jpg';
        if($request->hasFile('photo')){
            $extension = $request->file('photo')->getClientOriginalExtension();
            $images = $request->nbi.'_photo.'.$extension;
            $destination = 'images';
            $request->file('photo')->move($destination,$images);
        }

        if($request->hasFile('photo1')){
            $extension = $request->file('photo1')->getClientOriginalExtension();
            $images1 = $request->nbi.'_photo1.'.$extension;
            $destination = 'images';
            $request->file('photo1')->move($destination,$images1);
        }

        if($request->hasFile('photo2')){
            $extension = $request->file('photo2')->getClientOriginalExtension();
            $images2 = $request->nbi.'_photo2.'.$extension;
            $destination = 'images';
            $request->file('photo2')->move($destination,$images2);
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
            'tgl_masuk' => $request->tgl_masuk,
            'tgl_keluar' => $request->tgl_keluar,
            'dpp' => $request->dpp,
            'photo' => $images,
            'photo1' => $images1,
            'photo2' => $images2,
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
        $images1 = 'user.jpg';
        $images2 = 'user.jpg';
        if($request->hasFile('photo')){
            $extension = $request->file('photo')->getClientOriginalExtension();
            $images = $request->nbi.'_photo.'.$extension;
            $fileNow = explode('.',$student->photo);
            if($request->nbi == $fileNow[0]){
                Storage::delete($student->photo);
            }
            $destination = 'images';
            $request->file('photo')->move($destination,$images);
        }

        if($request->hasFile('photo1')){
            $extension = $request->file('photo1')->getClientOriginalExtension();
            $images1 = $request->nbi.'_photo1.'.$extension;
            $fileNow = explode('.',$student->photo1);
            if($request->nbi == $fileNow[0]){
                Storage::delete($student->photo1);
            }
            $destination = 'images';
            $request->file('photo1')->move($destination,$images1);
        }

        if($request->hasFile('photo2')){
            $extension = $request->file('photo2')->getClientOriginalExtension();
            $images2 = $request->nbi.'_photo2.'.$extension;
            $fileNow = explode('.',$student->photo2);
            if($request->nbi == $fileNow[0]){
                Storage::delete($student->photo2);
            }
            $destination = 'images';
            $request->file('photo2')->move($destination,$images2);
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
            'tgl_masuk' => $request->tgl_masuk,
            'tgl_keluar' => $request->tgl_keluar,
            'dpp' => $request->dpp,
            'photo' => $images,
            'photo1' => $images1,
            'photo2' => $images2,
            'latitude' => $request->latitude,
            'longitude' => $request->longitude
        ]);

        return response()->json(array("status" => 'success'), 200);
    }

    public function delete($id)
    {
        $student = Student::findOrFail($id);
        Storage::delete([$student->photo, $student->photo1, $student->photo2]);
        $student->delete();
        return response()->json(array("status" => 'success'), 200);
    }
}
