<table>
    @php
       $last = count($data) - 1;
    @endphp
    <tbody>
        @if (count($data))
            <tr>
                @foreach (@$data[0] as $seperates )
                <td>{{ $seperates['Key'] }}</td>
                
                @endforeach
            </tr>
                @foreach ($data as $item )
                    
                    <tr>
                        @foreach ($item as $seperates )
                        <td>{{ $seperates['Value'] }}</td>
                        @endforeach
            
                    </tr>
                    
                @endforeach
            
        @endif
    </tbody>
</table>
