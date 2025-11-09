<h1>Edit Event</h1>
    <form action="{{ route('events.update', $event->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="title">Title:</label>
            <input type="text" name="title" id="title" class="form-control" value="{{ $event->title }}">
        </div>
        <div class="form-group">
            <label for="description">Description:</label>
            <textarea name="description" id="description" class="form-control">{{ $event->description }}</textarea>
        </div>
        <div class="form-group">
            <label for="capacity">Capacity:</label>
            <select name="capacity" id="capacity" class="form-control">
                <option @if ($event->capacity == 1) selected @endif >1</option>
                <option @if ($event->capacity == 2) selected @endif >2</option>
                <option @if ($event->capacity == 3) selected @endif >3</option>
                <option @if ($event->capacity == 4) selected @endif >4</option>
                <option @if ($event->capacity == 5) selected @endif >5</option>
            </select>
        </div>
        <button type="submit" class="btn btn-success">Save</button>
    </form>