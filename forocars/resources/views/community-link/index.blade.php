@extends('layouts.app')

@section('template_title')
    Community Link
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <div style="display: flex; justify-content: space-between; align-items: center;">

                            <span id="card_title">
                                {{ __('Community Link') }}
                            </span>

                             <div class="float-right">
                                <a href="{{ route('community-links.create') }}" class="btn btn-primary btn-sm float-right"  data-placement="left">
                                  {{ __('Create New') }}
                                </a>
                              </div>
                        </div>
                    </div>
                    @if ($message = Session::get('success'))
                        <div class="alert alert-success">
                            <p>{{ $message }}</p>
                        </div>
                    @endif

                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped table-hover">
                                <thead class="thead">
                                    <tr>
                                        <th>No</th>
                                        
										<th>User Id</th>
										<th>Channel Id</th>
										<th>Title</th>
										<th>Link</th>
										<th>Approved</th>

                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($communityLinks as $communityLink)
                                        <tr>
                                            <td>{{ ++$i }}</td>
                                            
											<td>{{ $communityLink->user_id }}</td>
											<td>{{ $communityLink->channel_id }}</td>
											<td>{{ $communityLink->title }}</td>
											<td>{{ $communityLink->link }}</td>
											<td>{{ $communityLink->approved }}</td>

                                            <td>
                                                <form action="{{ route('community-links.destroy',$communityLink->id) }}" method="POST">
                                                    <a class="btn btn-sm btn-primary " href="{{ route('community-links.show',$communityLink->id) }}"><i class="fa fa-fw fa-eye"></i> {{ __('Show') }}</a>
                                                    <a class="btn btn-sm btn-success" href="{{ route('community-links.edit',$communityLink->id) }}"><i class="fa fa-fw fa-edit"></i> {{ __('Edit') }}</a>
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm"><i class="fa fa-fw fa-trash"></i> {{ __('Delete') }}</button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                {!! $communityLinks->links() !!}
            </div>
        </div>
    </div>
@endsection
