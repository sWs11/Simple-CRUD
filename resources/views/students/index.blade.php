@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">{{ __('Students') }}</div>

                    <div class="card-body">
                        <div class="row">
                            <div class="col">
                                <a href="{{ route('students.create') }}" class="btn btn-success mb-2">New Student</a>
                            </div>
                        </div>
                        <form>
                            <div class="form-row align-items-center">
                                <div class="col-sm-3 my-1">
                                    <label for="first_name">First Name</label>
                                    <input type="text" class="form-control" id="first_name" name="first_name" placeholder="Jane" value="{{ request()->get('first_name') }}">
                                </div>
                                <div class="col-sm-3 my-1">
                                    <label for="last_name">Last Name</label>
                                    <input type="text" class="form-control" id="last_name" name="last_name" placeholder="Doe" value="{{ request()->get('last_name') }}">
                                </div>
                                <div class="col-sm-3 my-1">
                                    <label for="middle_name">Middle Name</label>
                                    <input type="text" class="form-control" id="middle_name" name="middle_name" placeholder="MiddleName" value="{{ request()->get('middle_name') }}">
                                </div>
                                <div class="col-sm-2 my-1">
                                    <label for="inlineFormInputName">Group</label>

                                    <select class="form-control custom-select" name="group_id" id="group_id">
                                        <option @empty(request()->get('group_id')) selected @endempty value="">Select Group</option>
                                        @foreach($groups_by_courses as $course => $groups)
                                            <optgroup label="Course {{ $course }}">
                                                @foreach($groups as $group)
                                                    <option value="{{ $group->id }}" @if(request()->get('group_id') == $group->id) selected @endif>{{ $group->number }} ({{ $group->faculty_name }})</option>
                                                @endforeach
                                            </optgroup>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-auto my-1">
                                    <button type="submit" class="btn btn-primary" style="margin-top: 28px;">Search</button>
                                </div>
                            </div>
                        </form>

                        @empty($students->items())
                            <h2 class="mt-4">Students no found...</h2>
                        @else

                            <table class="table">
                                <thead>
                                <tr>
                                    <th>id</th>
                                    <th>First Name</th>
                                    <th>Last Name</th>
                                    <th>Middle Name</th>
                                    <th>Date Of Birth</th>
                                    <th>Group</th>
                                    <th>Course</th>
                                    <th>Faculty Name</th>
                                    <th>Action</th>
                                </tr>
                                </thead>

                                <tbody>
                                @foreach($students as $student)
                                    <tr>
                                        <td>{{ $student->id }}</td>
                                        <td>{{ $student->first_name }}</td>
                                        <td>{{ $student->last_name }}</td>
                                        <td>{{ $student->middle_name }}</td>
                                        <td>{{ $student->date_of_birth }}</td>
                                        <td>{{ $student->number }}</td>
                                        <td>{{ $student->course }}</td>
                                        <td>{{ $student->faculty_name }}</td>
                                        <td>
                                            <a href="{{ route('students.edit', $student->id) }}" class="btn btn-warning">Edit</a>
                                            <form action="{{ route('students.destroy', $student->id) }}" class="d-inline delete_student_form" method="post">
                                                @csrf
                                                @method('DELETE')
                                                <button class="btn btn-danger delete_student_btn">Delete</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>

                            <div class="row">
                                <div class="col-12">
                                    {!! $students->links() !!}
                                </div>
                            </div>
                        @endempty
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('page_scripts')
    <script>
        $(function () {
            $('.delete_student_btn').on('click', beforeDeleteGroup);

            function beforeDeleteGroup(event) {


                if(confirm('Are you sure?'))
                    $(this).closest('.delete_student_form').submit();
                else
                    event.preventDefault();
            }
        })
    </script>
@endpush
