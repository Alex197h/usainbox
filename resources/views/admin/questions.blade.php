@extends('layouts.admin')
@section('title', 'Liste des Commentaires')

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
                            <th>Auteur</th>
                            <th>Message</th>
                            <th>Transport</th>
                            <th>Date</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($questions as $question)
                        <tr data-line="{{ $question->id }}">
                            <td><th><input type="checkbox" class="tocheck flat"></th></td>
                            <td><a href="{{ route('admin_page', ['users', 'edit', $question->user->id]) }}">{{ $question->user->full_name }}</a></td>
                            <td>{{ $question->question }}</td>
                            <td>{{ $question->transport_offer_id }}</td>
                            <td>{{ $question->created_at->format('d/m/Y à H:i:s') }}</td>
                            <td><i class="rmquestion btn btn-danger fa fa-remove"></i></td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                <div id="result"></div>
                <script>
                    $('.rmquestion').on('click', function(){
                        var line = $(this).parents('tr');
                        
                        $.ajax({
                            url: '{{ route('admin_page', ['comments', 'rem']) }}/'+(line.attr('data-line')),
                            method: 'POST',
                            dataType: 'json',
                            data: {
                                _token: '{{ csrf_token() }}',
                            },
                            success: function(result){
                                if(result.success){
                                    line.remove();
                                    Notif('Succès', 'Le commentaire a bien été supprimé !');
                                } else {
                                    Notif('Erreur', 'Erreur lors de la suppression !', 'error');
                                }
                            }
                        });
                    });
                </script>
            </div>
        </div>
    </div>
</div>

@endsection
