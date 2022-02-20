<?php

namespace App\Http\Controllers\Backend\Student;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\AssignStudent;
use App\Models\DiscountStudent;
use App\Models\User;

class StudentRegistrationController extends Controller
{
    public function StudentRegistrationView(){
        $data['allData'] = AssignStudent::all();
        return view('backend.student.student_registration.student_view', $data);
    }

    public function StudentRegistrationAdd(){
        return view('backend.student.student_registration.student_add');
    }
}
