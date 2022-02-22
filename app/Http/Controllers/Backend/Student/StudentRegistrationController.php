<?php

namespace App\Http\Controllers\Backend\Student;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\AssignStudent;
use App\Models\DiscountStudent;
use App\Models\User;

use App\Models\StudentYear;
use App\Models\StudentClass;
use App\Models\StudentGroup;
use App\Models\StudentShift;
Use DB;

class StudentRegistrationController extends Controller
{
    public function StudentRegistrationView(){
        $data['allData'] = AssignStudent::all();
        return view('backend.student.student_registration.student_view', $data);
    }

    public function StudentRegistrationAdd(){
        $data['years'] = StudentYear::all();
        $data['classes'] = StudentClass::all();
        $data['groups'] = StudentGroup::all();
        $data['shifts'] = StudentShift::all();
        return view('backend.student.student_registration.student_add', $data);
    }

    public function StudentRegistrationStore(Request $request){
        DB::transaction(function() use($request){
            $checkYear = StudentYear::find($request->year_id)->name;
            $student = User::where('usertype', 'Student')->orderBy('id', 'DESC')->first();
            if ($student == null) {
                $firstReg = 0;
                $studentId = $firstReg + 1;
                if ($studentId <10) {
                    $id_no = '000'.$studentId;
                }
                elseif ($studentId <100) {
                    $id_no = '00'.$studentId;
                }
                elseif ($studentId <1000) {
                    $id_no = '0'.$studentId;
                }
            } // End If
            else {
                $student = User::where('usertype', 'Student')->orderBy('id', 'DESC')->first()->id;
                $studentId = $student+1;
                if ($studentId <10) {
                    $id_no = '000'.$studentId;
                }
                elseif ($studentId <100) {
                    $id_no = '00'.$studentId;
                }
                elseif ($studentId <1000) {
                    $id_no = '0'.$studentId;
                }
            } // End Else

            $final_id_no = $checkYear.$id_no;
            $user = new User();
            $code = rand(0000, 9999);
            $user->id_no = $final_id_no;
            $user->password = bcrypt($code);
            $user->usertype = 'Student';
            $user->code = $code;
            $user->name = $request->name;
            $user->fname = $request->fname;
            $user->mname = $request->mname;
            $user->mobile = $request->mobile;
            $user->address = $request->address;
            $user->gender = $request->gender;
            $user->religion = $request->religion;
            $user->dob = date('Y-m-d', strtime($request->dob));      
                  
            if($request->file('image')){
                $file = $request->file('image');
                $filename = date('YmdHi').$file->getClientOriginalName();
                $file->move(public_path('upload/student_images'), $filename);
                $user['image'] = $filename;
            }
            $user->save();
        });
    }
}
