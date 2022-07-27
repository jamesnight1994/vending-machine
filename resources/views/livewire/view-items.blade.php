<div>
    <table class="table table-dark">
    <thead>
        <tr>
            @foreach($cols as $key => $col)
                <th scope="col">{{ $key }}</th>
                
            @endforeach
        </tr>
    </thead>
    <tbody>
        @foreach($rows as $row_key => $row)
        <tr>
        @foreach($cols as $col_key => $col)
        <td>
            <strong style="text-align:center">{{ $col[0]['item']['name'] }}</strong><br><br>
            <img style="text-align:center" src="{{ $col[0]['item']['image'] }}" alt=""><br><br>
            Slot:{{ $row_key.$col_key }}
            Price: {{ $col[0]['item']['price'] }}
            <button wire:click="selectItem({{ json_encode($col[0]['item']) }})">
                Select Item
            </button>
        </td>
        @endforeach
        </tr>
        @endforeach
    </tbody>
    </table><br><br><br>
    <div class="container">
        <ul class="list-group">
            @foreach($denoms as $denom)
            <li wire:click="collectCash({{ json_encode($denom) }})" class="list-group-item" aria-current="true">
                {{ $denom['value'].$denom['type'] }}
            </li>
            @endforeach
        </ul>

    </div>
    {{ $collectedCash }}


</div>
