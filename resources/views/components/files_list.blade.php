@if(!$files->isEmpty())
    <div>
        @foreach($files as $file)
            @php($mime = $file->mime_type)
            @if(preg_match('/^image\//', $mime))
                <a href="{{$file->getUrl()}}" data-fancybox="gallery">
                    <img src="{{$file->getUrl()}}" alt="" width="75">
                </a>
            @elseif(preg_match('/^video\//', $mime))
                <a href="{{$file->getUrl()}}" data-fancybox="gallery">
                    <video width="75">
                        <source src="{{$file->getUrl()}}">
                    </video>
                </a>
            @else
                @if(!$loop->first)
                    <br>
                @endif
                <a href="{{$file->getUrl()}}" target="_blank">Файл</a>
            @endif
        @endforeach
    </div>
@endif
