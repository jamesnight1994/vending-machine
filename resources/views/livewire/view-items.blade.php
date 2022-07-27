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
            <button wire:click="selectItem(@json($col[0]['item']))">
                Select Item
            </button>
        </td>
        @endforeach
        </tr>
        @endforeach
    </tbody>
    </table><br><br><br>
    <div class="card" style="width: 18rem;">
        <img src="..." class="card-img-top" alt="...">
        <div class="card-body">
            <h5 class="card-title">Card title</h5>
            <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
            <a href="#" class="btn btn-primary">Go somewhere</a>
        </div>
    </div>

    <div class="card" style="width: 18rem;">
        <img src="..." class="card-img-top" alt="...">
        <div class="card-body">
            <h5 class="card-title">Card title</h5>
            <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
            <a href="#" class="btn btn-primary">Go somewhere</a>
        </div>
    </div>


</div>
