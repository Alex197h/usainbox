@extends('layouts.admin')
@section('title', 'Liste des Utilisateurs')

@section('content')

<div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
            <div class="x_title">
                <h2>Utilisateurs</small></h2>
                <div class="clearfix"></div>
            </div>
            <div class="x_content">
                <table id="datatable-checkbox" class="table table-striped table-bordered bulk_action">
                    <thead>
                        <tr>
                            <th>
                                <th><input type="checkbox" id="check-all" class="flat"></th>
                            </th>
                            <th>Nom</th>
                            <th>Email</th>
                            <th>Sexe</th>
                            <th>Admin</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($users as $user)
                        <tr>
                            <td><th><input type="checkbox" class="tocheck flat"></th></td>
                            <td><a href="{{ route('admin_page', ['users', 'edit', $user->id]) }}">{{ $user->full_name }}</a></td>
                            <td>{{ $user->email }}</td>
                            <td><i class="fa fa-{{ $user->gender ? 'mars' : 'venus' }}"></i></td>
                            <td>{!! $user->is_admin ? '<i class="fa fa-user"></i>' : '' !!}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

@endsection

@section('script')
<script>
    var Allchecked = false;
    $('#check-all').on('ifClicked', function(event){
        Allchecked = !Allchecked;
        $('.tocheck.flat').iCheck(Allchecked ? 'check' : 'uncheck');
    });
    
    $(document).on('mouseup', '.paginate_button', function(){
        $(".tocheck.flat").iCheck({
            checkboxClass: "icheckbox_flat-green"
        });
    });
    
    // $('#datatable-checkbox').on('page.dt', function() {
        // $(".tocheck.flat").iCheck({
            // checkboxClass: "icheckbox_flat-green"
        // });
    // }).DataTable();
</script>
@endsection