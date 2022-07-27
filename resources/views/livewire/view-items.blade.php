<div>
    <div class="container-fluid">

        <div class="row content">

            <div class="col-sm-3 sidenav">
                <h4>Vending Machine</h4>
                <ul class="nav nav-pills nav-stacked">
                    <li wire:click="buy" class="active"><a class="btn btn-success btn-sm" href="#">Purchase: </a>
                    <strong>{{ $selectedItem['name']??"none" }}</strong></li>
                    
                </ul><br>
                <ul class="nav nav-pills nav-stacked">

                    <li>Cash Collected: ${{ $collectedCash }}</li>
                </ul><br>
                
                <h6>Status</h6>
                <ul class="nav nav-pills nav-stacked">
                    <li>{{ $status??"Pending" }}</li>
                </ul><br>

                <h6>Select to insert cash->...</h6>
                <ul class="nav nav-pills nav-stacked list-group">
                        @foreach($denoms as $denom)
                        <a href="#" wire:click="collectCash({{ json_encode($denom) }})" class="list-group-item list-group-item-action" aria-current="true">
                            {{ $denom['value']." ".$denom['type'] }}
                        </a>
                        @endforeach
                </ul>


            </div>

            <div class="col-sm-9">
                
                <div class="row">
                    <table class="table table-dark col-sm-8">
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
                                <img style="text-align:center; height: 50;" src="{{ $col[0]['item']['image'] }}" alt=""><br><br>
                                Slot:{{ $row_key.$col_key }} <br>
                                Price: {{ $col[0]['item']['price'] }} <br>
                                <button wire:click="selectItem({{ json_encode($col[0]['item']) }})">
                                    Select Item
                                </button>
                            </td>
                            @endforeach
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    
                </div>
            </div>

        </div>
        
    </div>


</div>
