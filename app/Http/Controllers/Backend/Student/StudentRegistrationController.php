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
        
    }
}
