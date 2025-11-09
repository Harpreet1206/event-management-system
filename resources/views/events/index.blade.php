
    @if (session()->has('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif


    <h1>List of Events</h1>
        @if (auth()->user()->role == 'organizer')
            <a href="{{ route('events.create') }}" class="btn btn-primary">Create New Post</a>
        @endif
    <ul>
        @foreach ($events as $event)
            <li>
                <a href="{{ route('events.show', $event->id) }}">Event Title: {{ $event->title }}</a>
                <p>Event Description: {{ $event->description }}</p>


                @if (auth()->user()->role == 'organizer')
                    <a href="{{ route('events.edit', $event->id) }}" class="btn btn-secondary">Edit</a>
                    <form action="{{ route('events.destroy', $event->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Delete</button>
                    </form>
                @else

                    <form action="{{ route('events.booking', $event->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('POST')
                        <input type="hidden" name="event_id" value="{{ $event->id }}">
                        <input type="hidden" name="user_id" value="{{ auth()->user()->id }}">
                        <button type="submit" class="btn btn-danger">Booking Event</button>
                    </form>

                @endif

            </li>
        @endforeach
    </ul>
