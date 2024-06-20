<x-app-layout>
    <div class="note-container py-12">
        <a href="{{ route('note.create') }}" class="new-note-btn">
            New Note
        </a>
        <div class="notes">
            @foreach ($notes as $note)
                <div class="note">
                    <div class="note-body">
                        {{ Str::words($note->note, 15) }}<!--Here Str::words extracts 30 words from the param.. -->
                    </div>
                    <div class="note-buttons">
                        <a href="{{ route('note.show', $note) }}" class="note-edit-button">View</a>
                        <a href="{{ route('note.edit', $note) }}" class="note-edit-button">Edit</a>
                        <form action="{{ route('note.destroy', $note) }}" method="POST">
                            @csrf
                            @method('DELETE')<!-- This will overwrite the POST, notice that destroy
                                defines on routes (web.php) uses but delete. Reason why POST is overwriten with DELETE using laravel directive-->
                            <button class="note-delete-button">Delete</button>
                        </form>
                    </div>
                </div>
            @endforeach
        </div>

        <div class="p-6">
            {{ $notes->links() }}
        </div>
    </div>
</x-app-layout>
