<?php

namespace App\Http\Controllers;
use App\Models\User;
use App\Models\Student;
use App\Models\Teacher;
use App\Models\NonTeaching;
use App\Models\Registrar;
use App\Models\Dean;
use App\Models\DeptChair;

use Illuminate\Http\Response;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    //  
    public function getAll(Request $request): JsonResponse
    {                                        
        $students = Student::select('student.*', 'users.status')
            ->join('users', 'student.id', '=', 'users.id')
            ->where('users.status', 'Verified')
            ->orderBy('student.lastname')
            ->get();


        $teachers = Teacher::select('teacher.*', 'users.status')
            ->join('users', 'teacher.id', '=', 'users.id')
            ->where('users.status', 'Verified')
            ->orderBy('teacher.lastname')
            ->get();

        $nonTeachings = NonTeaching::select('non_teaching.*', 'users.status')
            ->join('users', 'non_teaching.id', '=', 'users.id')
            ->where('users.status', 'Verified')
            ->orderBy('non_teaching.lastname')
            ->get();

        $registrars = Registrar::select('registrar.*', 'users.status')
            ->join('users', 'registrar.id', '=', 'users.id')
            ->where('users.status', 'Verified')
            ->orderBy('registrar.lastname')
            ->get();

        $deans = Dean::select('dean.*', 'users.status')
            ->join('users', 'dean.id', '=', 'users.id')
            ->where('users.status', 'Verified')
            ->orderBy('dean.lastname')
            ->get();

        $deptChairs = DeptChair::select('dept_chair.*', 'users.status')
            ->join('users', 'dept_chair.id', '=', 'users.id')
            ->where('users.status', 'Verified')
            ->orderBy('dept_chair.lastname')
            ->get();

        $users = [...$students, ...$teachers, ...$nonTeachings, ...$registrars, ...$deans, ...$deptChairs];    

        return response()->json($users);
    }     

    public function getOne(Request $request, $id): JsonResponse
    {
        $user = User::find($id);
        if($user){
            if($user->user_type === "Student"){
                $userDetails = Student::find($id);
                $userDetails->user_status = $user->status;
                return response()->json($userDetails);
            }else if($user->user_type === "Teacher"){
                $userDetails = Teacher::find($id);
                $userDetails->user_status = $user->status;
                return response()->json($userDetails);
            }else if($user->user_type === "Non Teaching"){
                $userDetails = NonTeaching::find($id);
                $userDetails->user_status = $user->status;
                return response()->json($userDetails);
            }else if($user->user_type === "Registrar"){
                $userDetails = Registrar::find($id);
                $userDetails->user_status = $user->status;
                return response()->json($userDetails);
            }else if($user->user_type === "Dean"){
                $userDetails = Dean::find($id);
                $userDetails->user_status = $user->status;
                return response()->json($userDetails);
            }else if($user->user_type === "DeptChair"){
                $userDetails = DeptChair::find($id);
                $userDetails->user_status = $user->status;
                return response()->json($userDetails);
            }else{
                return response()->json([]);
            }   
        }else{
            return response()->json("{}");
        }   
    }

    public function getRegisteredUsers(Request $request): JsonResponse
    {            
        $users = User::orderBy('user_type')->orderBy('lastname')->get(); 

        return response()->json($users);
    } 

    public function getProfileEditApprovals(Request $request): JsonResponse
    {                                        
        $students = Student::where('status', 'For Approval')->orderBy('lastname')->get();
        $teachers = Teacher::where('status', 'For Approval')->orderBy('lastname')->get();
        $nonTeachings = NonTeaching::where('status', 'For Approval')->orderBy('lastname')->get();
        $registrars = Registrar::where('status', 'For Approval')->orderBy('lastname')->get();
        $deans = Dean::where('status', 'For Approval')->orderBy('lastname')->get();
        $deptChairs = DeptChair::where('status', 'For Approval')->orderBy('lastname')->get();
        $users = [...$students, ...$teachers, ...$nonTeachings, ...$registrars, ...$deans, ...$deptChairs];    

        return response()->json($users);
    }

    public function updateRegisteredUser(Request $request, $id): Response
    {                    
        User::find($id)->update([ 'status'=> $request->status ]);

        return response()->noContent();
    }

    public function updateUserStatus(Request $request, $id): Response
    {               
        $user = User::find($id);
        if($user->user_type === 'Student'){
            Student::find($id)->update([ 'status' => $request->status ]);            
        }else if($user->user_type === 'Teacher') {
            Teacher::find($id)->update([ 'status' => $request->status ]);            
        }else if($user->user_type === 'Non Teaching') {
            NonTeaching::find($id)->update([ 'status' => $request->status ]);            
        }else if($user->user_type === 'Registrar') {
            Registrar::find($id)->update([ 'status' => $request->status ]);            
        }else if($user->user_type === 'Dean') {
            Dean::find($id)->update([ 'status' => $request->status ]);            
        }else if($user->user_type === 'DeptChair') {
            DeptChair::find($id)->update([ 'status' => $request->status ]);            
        }

        return response()->noContent();
    }

    public function updateUserBlockHash(Request $request, $id): Response
    {               
        $user = User::find($id);
        if($user->user_type === 'Student'){
            Student::find($id)->update([ 'block_hash' => $request->block_hash ]);            
        }else if($user->user_type === 'Teacher') {
            Teacher::find($id)->update([ 'block_hash' => $request->block_hash ]);            
        }else if($user->user_type === 'Non Teaching') {
            NonTeaching::find($id)->update([ 'block_hash' => $request->block_hash ]);            
        }else if($user->user_type === 'Registrar') {
            Registrar::find($id)->update([ 'block_hash' => $request->block_hash ]);            
        }else if($user->user_type === 'Dean') {
            Dean::find($id)->update([ 'block_hash' => $request->block_hash ]);            
        }else if($user->user_type === 'DeptChair') {
            DeptChair::find($id)->update([ 'block_hash' => $request->block_hash ]);            
        }

        return response()->noContent();
    }

    public function updateUserDetails(Request $request, $id): Response
    {             
        $user = User::find($id);
        if($user->user_type === "Student"){
            Student::find($id)->update([  
                'lastname' => $request->lastname,
                'firstname' => $request->firstname,
                'middlename' => $request->middlename,
                'extname' => $request->extname,
                'birth_date' => $request->birth_date,
                'birth_place' => $request->birth_place,
                'gender' => $request->gender,
                'house_number' => $request->house_number,
                'street' => $request->street,
                'subdivision' => $request->subdivision,
                'barangay' => $request->barangay,
                'city' => $request->city,
                'province' => $request->province,
                'zipcode' => $request->zipcode,
                'civil_status' => $request->civil_status,
                'contact' => $request->contact,
                'is_cabuyeno' => $request->is_cabuyeno,
                'is_registered_voter' => $request->is_registered_voter,
                'is_fully_vaccinated' => $request->is_fully_vaccinated,
                'father_name' => $request->father_name,
                'father_occupation' => $request->father_occupation,
                'father_contact' => $request->father_contact,
                'is_father_voter_of_cabuyao' => $request->is_father_voter_of_cabuyao,
                'mother_name' => $request->mother_name,
                'mother_occupation' => $request->mother_occupation,
                'mother_contact' => $request->mother_contact,
                'is_mother_voter_of_cabuyao' => $request->is_mother_voter_of_cabuyao,
                'is_living_with_parents' => $request->is_living_with_parents,
                'education_attained' => $request->education_attained,
                'last_school_attended' => $request->last_school_attended,
                'school_address' => $request->school_address,
                'award_received' => $request->award_received,
                'sh_school_strand' => $request->sh_school_strand,  
                'course_id' => $request->course_id,
                'year_level' => $request->year_level,                
                'status'=> 'Uneditable',            
            ]);            
        }else if($user->user_type === "Teacher") {
            Teacher::find($id)->update([  
                'lastname' => $request->lastname,
                'firstname' => $request->firstname,
                'middlename' => $request->middlename,
                'extname' => $request->extname,
                'birth_date' => $request->birth_date,
                'birth_place' => $request->birth_place,
                'gender' => $request->gender,
                'civil_status' => $request->civil_status,
                'citizenship' => $request->citizenship,
                'house_number' => $request->house_number,
                'street' => $request->street,
                'subdivision' => $request->subdivision,
                'barangay' => $request->barangay,
                'city' => $request->city,
                'province' => $request->province,
                'zipcode' => $request->zipcode,
                'gsis' => $request->gsis,
                'pagibig' => $request->pagibig,
                'philhealth' => $request->philhealth,
                'sss' => $request->sss,
                'tin' => $request->tin,
                'agency_employee_no' => $request->agency_employee_no,
                'elementary_school' => $request->elementary_school,
                'elementary_remarks' => $request->elementary_remarks,
                'secondary_school' => $request->secondary_school,
                'secondary_remarks' => $request->secondary_remarks,
                'vocational_school' => $request->vocational_school,
                'vocational_remarks' => $request->vocational_remarks,
                'college_school' => $request->college_school,
                'college_remarks' => $request->college_remarks,
                'graduate_studies_school' => $request->graduate_studies_school,
                'graduate_studies_remarks' => $request->graduate_studies_remarks,
                'work_experiences' => $request->work_experiences,                              
                'status'=> 'Uneditable',            
            ]);            
        }else if($user->user_type === "Non Teaching") {
            NonTeaching::find($id)->update([  
                'lastname' => $request->lastname,
                'firstname' => $request->firstname,
                'middlename' => $request->middlename,
                'extname' => $request->extname,
                'birth_date' => $request->birth_date,
                'birth_place' => $request->birth_place,
                'gender' => $request->gender,
                'civil_status' => $request->civil_status,
                'citizenship' => $request->citizenship,
                'house_number' => $request->house_number,
                'street' => $request->street,
                'subdivision' => $request->subdivision,
                'barangay' => $request->barangay,
                'city' => $request->city,
                'province' => $request->province,
                'zipcode' => $request->zipcode,
                'gsis' => $request->gsis,
                'pagibig' => $request->pagibig,
                'philhealth' => $request->philhealth,
                'sss' => $request->sss,
                'tin' => $request->tin,
                'agency_employee_no' => $request->agency_employee_no,
                'elementary_school' => $request->elementary_school,
                'elementary_remarks' => $request->elementary_remarks,
                'secondary_school' => $request->secondary_school,
                'secondary_remarks' => $request->secondary_remarks,
                'vocational_school' => $request->vocational_school,
                'vocational_remarks' => $request->vocational_remarks,
                'college_school' => $request->college_school,
                'college_remarks' => $request->college_remarks,
                'graduate_studies_school' => $request->graduate_studies_school,
                'graduate_studies_remarks' => $request->graduate_studies_remarks,
                'work_experiences' => $request->work_experiences,                              
                'status'=> 'Uneditable',            
            ]);            
        }else if($user->user_type === "Registrar") {
            Registrar::find($id)->update([  
                'lastname' => $request->lastname,
                'firstname' => $request->firstname,
                'middlename' => $request->middlename,
                'extname' => $request->extname,
                'birth_date' => $request->birth_date,
                'birth_place' => $request->birth_place,
                'gender' => $request->gender,
                'civil_status' => $request->civil_status,
                'citizenship' => $request->citizenship,
                'house_number' => $request->house_number,
                'street' => $request->street,
                'subdivision' => $request->subdivision,
                'barangay' => $request->barangay,
                'city' => $request->city,
                'province' => $request->province,
                'zipcode' => $request->zipcode,
                'gsis' => $request->gsis,
                'pagibig' => $request->pagibig,
                'philhealth' => $request->philhealth,
                'sss' => $request->sss,
                'tin' => $request->tin,
                'agency_employee_no' => $request->agency_employee_no,
                'elementary_school' => $request->elementary_school,
                'elementary_remarks' => $request->elementary_remarks,
                'secondary_school' => $request->secondary_school,
                'secondary_remarks' => $request->secondary_remarks,
                'vocational_school' => $request->vocational_school,
                'vocational_remarks' => $request->vocational_remarks,
                'college_school' => $request->college_school,
                'college_remarks' => $request->college_remarks,
                'graduate_studies_school' => $request->graduate_studies_school,
                'graduate_studies_remarks' => $request->graduate_studies_remarks,
                'work_experiences' => $request->work_experiences,                              
                'status'=> 'Uneditable',            
            ]);            
        }else if($user->user_type === "Dean") {
            Dean::find($id)->update([  
                'lastname' => $request->lastname,
                'firstname' => $request->firstname,
                'middlename' => $request->middlename,
                'extname' => $request->extname,
                'birth_date' => $request->birth_date,
                'birth_place' => $request->birth_place,
                'gender' => $request->gender,
                'civil_status' => $request->civil_status,
                'citizenship' => $request->citizenship,
                'house_number' => $request->house_number,
                'street' => $request->street,
                'subdivision' => $request->subdivision,
                'barangay' => $request->barangay,
                'city' => $request->city,
                'province' => $request->province,
                'zipcode' => $request->zipcode,
                'gsis' => $request->gsis,
                'pagibig' => $request->pagibig,
                'philhealth' => $request->philhealth,
                'sss' => $request->sss,
                'tin' => $request->tin,
                'agency_employee_no' => $request->agency_employee_no,
                'elementary_school' => $request->elementary_school,
                'elementary_remarks' => $request->elementary_remarks,
                'secondary_school' => $request->secondary_school,
                'secondary_remarks' => $request->secondary_remarks,
                'vocational_school' => $request->vocational_school,
                'vocational_remarks' => $request->vocational_remarks,
                'college_school' => $request->college_school,
                'college_remarks' => $request->college_remarks,
                'graduate_studies_school' => $request->graduate_studies_school,
                'graduate_studies_remarks' => $request->graduate_studies_remarks,
                'work_experiences' => $request->work_experiences,                              
                'status'=> 'Uneditable',            
            ]);            
        }else if($user->user_type === "DeptChair") {
            DeptChair::find($id)->update([
                'lastname' => $request->lastname,
                'firstname' => $request->firstname,
                'middlename' => $request->middlename,
                'extname' => $request->extname,
                'birth_date' => $request->birth_date,
                'birth_place' => $request->birth_place,
                'gender' => $request->gender,
                'civil_status' => $request->civil_status,
                'citizenship' => $request->citizenship,
                'house_number' => $request->house_number,
                'street' => $request->street,
                'subdivision' => $request->subdivision,
                'barangay' => $request->barangay,
                'city' => $request->city,
                'province' => $request->province,
                'zipcode' => $request->zipcode,
                'gsis' => $request->gsis,
                'pagibig' => $request->pagibig,
                'philhealth' => $request->philhealth,
                'sss' => $request->sss,
                'tin' => $request->tin,
                'agency_employee_no' => $request->agency_employee_no,
                'elementary_school' => $request->elementary_school,
                'elementary_remarks' => $request->elementary_remarks,
                'secondary_school' => $request->secondary_school,
                'secondary_remarks' => $request->secondary_remarks,
                'vocational_school' => $request->vocational_school,
                'vocational_remarks' => $request->vocational_remarks,
                'college_school' => $request->college_school,
                'college_remarks' => $request->college_remarks,
                'graduate_studies_school' => $request->graduate_studies_school,
                'graduate_studies_remarks' => $request->graduate_studies_remarks,
                'work_experiences' => $request->work_experiences,                                
                'status'=> 'Uneditable',            
            ]);            
        }

        User::find($id)->update([
            'lastname' => $request->lastname,
            'firstname' => $request->firstname,
            'middlename' => $request->middlename,
            'extname' => $request->extname
        ]);

        return response()->noContent();
    }

}
