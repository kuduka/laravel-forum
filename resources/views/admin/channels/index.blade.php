@extends('admin.layout.app')

@section('administration-content')

        <p><a class="btn btn btn-primary" href="{{ route('admin.channels.create') }}">New Channel <span class="fas fa-plus"></span></a></p>
    
        <table class="table">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Slug</th>
                    <th>Description</th>
                    <th>Threads</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
            @forelse($channels as $channel)
                <tr class="{{ $channel->archived ? 'table-info' : '' }}">
                    <td>{{ $channel->name }}</td>
                    <td>{{ $channel->slug }}</td>
                    <td>{{ $channel->description }}</td>
                    <td>{{ $channel->threads_count }}</td>
                    <td>
                        <a href="{{ route('admin.channels.edit', ['channel' => $channel->slug]) }}" class="btn btn-primary btn-xs">Edit</a>
                    </td>
                </tr>
            @empty
                <tr>
                    <td>Nothing here.</td>
                </tr>
            @endforelse
            </tbody>
        </table>
@endsection
