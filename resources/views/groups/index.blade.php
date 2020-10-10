@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">{{ __('Groups') }}</div>

                    <div class="card-body">
                        <div class="row">
                            <div class="col">
                                <a href="{{ route('groups.create') }}" class="btn btn-success mb-2">New Group</a>
                            </div>
                        </div>

                        @empty($groups->items())
                            <h2 class="mt-4">Groups no found...</h2>
                        @else
                            <table class="table">
                                <thead>
                                <tr>
                                    <th>id</th>
                                    <th>Number</th>
                                    <th>Course</th>
                                    <th>Faculty Name</th>
                                    <th>Action</th>
                                </tr>
                                </thead>

                                <tbody>
                                @foreach($groups as $group)
                                    <tr>
                                        <td>{{ $group->id }}</td>
                                        <td>{{ $group->number }}</td>
                                        <td>{{ $group->course }}</td>
                                        <td>{{ $group->faculty_name }}</td>
                                        <td>
                                            <a href="{{ route('groups.edit', $group->id) }}" class="btn btn-warning">Edit</a>
                                            <form action="{{ route('groups.destroy', $group->id) }}" class="d-inline delete_group_form" method="post">
                                                @csrf
                                                @method('DELETE')
                                                <button class="btn btn-danger delete_group_btn">Delete</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>

                            <div class="row">
                                <div class="col-12">
                                    {!! $groups->links() !!}
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
        $('.delete_group_btn').on('click', beforeDeleteGroup);

        function beforeDeleteGroup(event) {


            if(confirm('Are you sure?'))
                $(this).closest('.delete_group_form').submit();
            else
                event.preventDefault();
        }
    })
</script>
@endpush
