<?php

namespace App\Http\Controllers;

use App\Events\StudentRegisterEvent;
use App\Http\Requests\StudentAddRequest;
use App\Http\Requests\StudentEditRequest;
use App\Models\images;

use App\Models\student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Storage;

class studentController extends Controller
{
    protected $name;
    protected $age;
    public function __construct() {
        $this->name = 'myname';
        $this->age = 20;
    }
    //
    public function index(Request $request){
       // return student::with('subjects')->get();


    //$student= student::with('className')->get();
    // return $student;
 //return student::with('teacher')->get();



        $students=student::with('images')->
        when($request->search,function($query)use($request){
            return $query->whereAny([
                'name',
                'age',
                'email',
                'date_of_birth',
                'score',
                'gender',
                ],'like','%'.$request->search.'%');
        })->paginate(10);

    return view('student.index',compact('students'));


    }
    public function aboutUs($id,$name){
        return view('aboutus',compact('id','name'));
    }
    public function privateexcute(){
        return  $this->name."".$this->age;

    }
    public function addstudent(){
        $student= new student() ;
        $student->name='mb';
        $student->age= 15;
        $student->gender= 'm';
        $student->date_of_birth = date('1999-10-8');
        $student->email="moh@gmail.com";
        $student->save();
        return("add student successfully");
    }
public function getstudents(){
    //$student= student::all();
    $students= student::select("id","name")
   // ->where('id', 201) //for search any colum
   ->findOrFail(200)//for serch id
    //->get();
    ->first();
    return $students;
}

public function updateStudent (){
    $student = student::findOrFail(200);
    $student->name= "updatestudent";
    $student->age= 60;
    $student->update();
    $updatestd= student::find(200);
    return($updatestd);
}
public function deleteStudent(){
$student=student::findOrFail(199);//add or fail to find to add 404 if notfound
$student->delete();
return ("item delete succsfully");

}
public function wherecondition(){
    $students= student::where('score','>',50)
    ->where(function($query){
        $query->where('age','<',20)
        ->orWhere('age','>',30);

    })  ->get();

    //anoth soloutin
    //there many type of where ->where.. orwhere .. wherebetween..where any ..whereIn.. where all to search colum
    $std= student::whereBetween('age',[10,30])->get();
    $std1= student::whereIn('age',[25,50])->get();
    $std2= student::whereNotIn('age',[25,50])->get();
    $std3= student::whereAny(['age','score'],'=','50')->get();
    $std4= student::whereAll(['id','age','score'],'=','101')->get();



    return $std4;

    }

    public function queryscope(){
        $query = student::male(25)->get();
        return $query;
    }
    public function secondquery(){
         $query = student::female()->get();
        return $query;

    }
    public function softdel(){
        $student=student::find(200);
        $student->delete();
        return 'soft delete succssfully';
    }
    public function getstd(){
        $stdwithoutdel= student::withTrashed()->find(200);//all std
         $std= student::find(200);//currntly std
        $tracheditem= student::onlyTrashed()->get();//get delet stds
         $returnDelStd =student::withTrashed()->find(200)->restore();//return delstd
         $forcedel = student::find(198)->forceDelete();
        //return 'force del successfuly';
        return $std;

    }
    public function create(StudentAddRequest $request){
        $imagePath=null;
        if ($request->hasFile('image')){
            $imagePath = $request->file('image')->store('photos','public');
        }
        $student= new student();
        $student->name=$request->name;
        $student->email=$request->email;
        $student->date_of_birth=$request->date_of_birth;
        $student->age=$request->age;
        $student->gender=$request->gender;
        $student->score=$request->score;
       // $student->image=$imagePath;
       // $student->user_id=24;
         event(new StudentRegisterEvent($student));
       // $student->save();





        $images = new images();
        $images->path=$imagePath;
        $images->imageable_id=$student->id;
        $images->imageable_type=student::class;
        $images->save();

        session()->flash('success','student added successfully');
        return redirect('student');


    }
    public function edit($id){
        $student=student::findOrFail($id);
        Gate::authorize('updateStudents',$student);
        return view('student.edit',compact('student'));

    }

    public function update(StudentEditRequest $request ,$id){
        $student=student::findOrFail($id);
        Gate::authorize('updateStudents',$student);

        $student->name=$request->name;
        $student->email=$request->email;
        $student->date_of_birth=$request->date_of_birth;
        $student->age=$request->age;
        $student->gender=$request->gender;
        $student->score=$request->score;
        $student->update();
         session()->flash('success','student updated successfully');
        return redirect('student');


    }
    public function destroy($id){
    $student=student::findOrFail($id);

    if ($student->image){
        Storage::disk('public')->delete($student->image);
    }

    $student->delete();
     session()->flash('success','student deleted successfully');
     return redirect()->back()->with('success', 'Student deleted successfully');

    }


    public function profile($id){
        $student= student::findOrFail($id);
    return view('student.profile',compact('student'));
    }





    public function removeSubject(student $student, $subject_id)
{
    // remove relation only (not delete subject)
    $student->subjects()->detach($subject_id);

    return back()->with('success', 'Subject removed successfully');
}



}