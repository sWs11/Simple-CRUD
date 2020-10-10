<?php

namespace App\Http\Controllers;

use App\Http\Requests\SaveStudentRequest;
use App\Models\Group;
use App\Models\Student;
use Illuminate\Http\Request;

class StudentsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index(Request $request)
    {
        $filter_data = [
            'students.first_name' => $request->get('first_name'),
            'students.last_name' => $request->get('last_name'),
            'students.middle_name' => $request->get('middle_name'),
            'students.group_id' => $request->get('group_id'),
        ];

        $students_query = Student::select([
                'students.*',
                'groups.number',
                'groups.course',
                'groups.faculty_name',
            ])
            ->leftJoin('groups', 'students.group_id', 'groups.id');

        foreach ($filter_data as $field => $value) {
            if(!empty($value))
                $students_query->where($field, $value);
        }


        $students = $students_query->paginate(10);

        $groups_by_courses = Group::getGroupsByCourses();

        debug($students);

        return view('students.index', ['students' => $students, 'groups_by_courses' => $groups_by_courses]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function create()
    {
        $groups_by_courses = Group::getGroupsByCourses();

        return view('students.create', ['courses' => $groups_by_courses]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(SaveStudentRequest $request)
    {
        $student_data = $request->validated();

        Student::create($student_data);

        return redirect()->route('students.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function edit($id)
    {
        $student = Student::whereId($id)->firstOrFail();
        $groups_by_courses = Group::getGroupsByCourses();

        return view('students.edit', ['student' => $student, 'groups_by_courses' => $groups_by_courses]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(SaveStudentRequest $request, $id)
    {
        $student = Student::whereId($id)->firstOrFail();

        $student->fill($request->validated())->save();

        return redirect()->route('students.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        Student::whereId($id)->delete();

        return back();
    }
}
