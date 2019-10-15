<div class="card m-3" style="height: 200px;">
        <h3 class="font-normal text-xl py-4 -ml-5 mb-3 border-l-4 border-blue-light pl-4" style="border-left: 4px solid #8ae2fe;">
            <a href="{{ $project->path() }}" class="text-black no-underline">{{ $project->title }}</a>
        </h3>

    <div class="text-grey-dark mb-4">{{ Str::limit($project->description, 100) }}</div>

    <footer>
        <form method="POST" action="{{ $project->path() }}" class="text-right">
            @method('DELETE')
            @csrf
            <button type="submit" class="text-sm">Delete</button>
        </form>
    </footer>
    </div>