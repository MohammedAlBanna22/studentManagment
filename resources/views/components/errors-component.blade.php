    @if($errors->any())
    <div class="{{ $className }}" style="color: red; border: 1px solid red; padding: 10px; margin-bottom: 10px;">
        <ul>
            @foreach ($errors->all() as $error)

                 <li>
                    {{ $error }}
                </li>
            @endforeach

        </ul>
    </div>

    @endif
