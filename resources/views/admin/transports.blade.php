@extends('layouts.admin')
@section('title', 'Gestion des offres de transport')

@section('content')

<div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
            <div class="x_content">
                <table id="datatable-checkbox" class="table table-striped table-bordered bulk_action">
                    <thead>
                        <tr>
                            <th>
                                <th><input type="checkbox" id="check-all" class="flat"></th>
                            </th>
                            <th>Date</th>
                            <th>Auteur</th>
                            <th>Description</th>
                            <th>Crée le</th>
                            <th>Pleine</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($transports as $transport)
                        <tr>
                            <td><th><input type="checkbox" class="tocheck flat"></th></td>
                            <td>{{ date('d/m/Y', strtotime($transport->date_start)) }}</td>
                            <td><a href="{{ route('admin_page', ['users', 'edit', $transport->user->id]) }}">{{ $transport->user->full_name }}</a></td>
                            <td>{{ str_limit($transport->description, 200, '...') }}</td>
                            <td>{{ $transport->created_at->format('d/m/Y à H:i:s') }}</td>
                            <td><i class="fa fa-{{ $transport->full ? 'check-circle-o' : '' }}"></i></td>
                            <td><a href="{{ route('admin_page', ['transports', 'edit', $transport->id]) }}"><i class="fa fa-eye"></i></a></td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>


@endsection
