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
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($questions as $question)
                        <tr>
                            <td><th><input type="checkbox" class="tocheck flat"></th></td>
                            <td><a href="{{ route('admin_page', ['users', 'edit', $question->user->id]) }}">{{ $question->user->full_name }}</a></td>
                            <td>{{ $question->question }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

@endsection
