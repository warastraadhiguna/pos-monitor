@include('sweetalert::alert')

<div class="card">
    <div class="card-body">
        <table class="table">
            <tbody>
                <tr>
                    <td class="align-middle" width="10%">Tanggal</td>
                    <td class="align-middle" width="1%">:</td>
                    <td width="5%"><input class="form-control" value="{{ $start_date }}" id="start_date" type="date" />
                    </td>
                    <td class="align-middle" width="1%">:</td>
                    <td width="5%"><input class="form-control" value="{{ $end_date }}" id="end_date" type="date" /></td>
                    <td width="10%"><button onclick="filter_page()" class="btn btn-primary"><i class="fa fa-search"
                                aria-hidden="true"></i> Cari</button></td>
                    <td>
                    </td>
                </tr>
            </tbody>
        </table>

    </div>
</div>

<table id="example1" class="table table-bordered table-striped" width="100%">
    <thead>
        <tr>
            <th width="40px">No</th>
            <th>Kode Barang</th>    
            <th>Nama Barang</th>       
            <th>Jumlah</th>      
            <th>Harga</th>                
            <th>Total Nilai</th>   
        </tr>
    </thead>
    <tbody>
        @foreach($products as $product)
        <tr>
            <td class="align-middle">{{ $loop->iteration }}</td>
            <td class="align-middle">{{ $product->noBarang  }}</td>
            <td class="align-middle">{{ $product->namaBarang  }}</td>
            <td class="align-middle">{{ $product->qty  }}</td>
            <td class="align-middle">{{ $product->hargaProduk  }}</td>
            <td class="align-middle">{{ $product->total  }}</td>                                                
        </tr>
        @endforeach
    </tbody>
</table>


<script>
function filter_page() {
    var start_date = document.getElementById('start_date').value;
    var end_date = document.getElementById('end_date').value;
    var url = window.location + '';
    var index = url.indexOf("?");

    if (index >= 0) {
        url = url.split('?')[0];
    }

    var newUrl = url + '?start_date=' + start_date + '&end_date=' + end_date;

    window.open(newUrl, '_self');
}
</script>