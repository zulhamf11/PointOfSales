<div class="row">
    <div class="col-md-8">
        <div class="card">
            <div class="card-body">
                {{-- <h2 class="font-weight-bold">Product List</h2> --}}
                <div class="row">
                    @foreach ($products as $product)
                        <div class="col-md-3 mb-3">
                            <div class="card">
                                <a wire:click="addItem({{ $product->id }})">
                                    <div class="card-body">
                                        <img src="{{ asset('storage/images/' . $product->image) }}" alt="product"
                                            class="img-fluid">
                                    </div>
                                    <div class="card-footer bg-white">
                                        <h6 class="text-center font-weight-bold">{{ $product->name }}</h6>
                                    </div>
                                </a>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card">
            <div class="card-body">
                <div class="form-group">
                    <button type="button" class="btn-block form-group-chargebtn4 border-0"><span
                            class="font-weight-bold subtotal-span3">Customer</span></button>
                    <button type="button" class="btn-block form-group-chargebtn5 border-0"><span
                            class="font-weight-bold subtotal-span4">editting list</span></button>
                    <h6 class="title-newCustomer  text-center">New Customer</h6>

                </div>
                {{-- <h2 class="font-weight-bold">Cart</h2> --}}
                <table class="table table-sm table-bordered table-striped table-hovered">
                    {{-- <thead>
                        <tr>
                            <th>No</th>
                            <th>Name</th>
                            <th>Price</th>
                        </tr>
                    </thead> --}}
                    <tbody>
                        @forelse ($carts as $index => $cart)
                            <tr>
                                {{-- <td>{{ $index + 1 }}</td> --}}
                                <td>{{ $cart['name'] }} <span class="qty-sp">{{ $cart['qty'] }}</span>
                                </td>
                                <td class="td-price">Rp {{ number_format($cart['price'], 2, ',', '.') }}</td>
                            </tr>
                        @empty
                            <td colspan="3">
                                <h6 class="text-center">Empty Cart</h6>
                            </td>
                        @endforelse
                    </tbody>
                </table>
                <div class="form-group">
                    <button type="submit" class="btn-block form-group-clearbtn">Clear Sale</button>
                </div>
                <div class="form-group mt-2">
                    <h6 class="font-weight-bold ">Sub Total: <span class="subtotal-span">Rp
                            {{ number_format($summary['sub_total'], 2, ',', '.') }}</span>
                    </h6>
                    <h6 class="font-weight-bold ">Total: <span class="subtotal-span">Rp
                            {{ number_format($summary['total'], 2, ',', '.') }}</span>
                    </h6>
                </div>





            </div>
        </div>
        <div class="card px-3 py-2">

            <div class="form-group">
                <button type="button" class="btn-block form-group-savebtn border-0" id="modals">Save Bill</button>
                <button type="button" class="btn-block form-group-printbtn border-0" data-bs-toggle="modal"
                    data-bs-target="myModal">Print Bill</button>

                <div class="form-group">

                </div>
                <div class="form-group">
                    <button type="button" class="btn-block form-group-chargebtn3 border-0"><span
                            class="subtotal-span3">Split Bill</span></button>
                    <button type="button" class="btn-block form-group-chargebtn2 border-0" data-bs-toggle="modal"
                        data-bs-target="#exampleModal"><span class="subtotal-span2">Charge Rp
                            {{ number_format($summary['total'], 2, ',', '.') }}</span> </button>
                </div>

            </div>
        </div>


    </div>


    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Transaction</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <table class="table table-sm table-bordered table-striped table-hovered">
                        {{-- <thead>
                            <tr>
                                <th>No</th>
                                <th>Name</th>
                                <th>Price</th>
                            </tr>
                        </thead> --}}
                        <tbody>
                            @forelse ($carts as $index => $cart)
                                <tr>
                                    {{-- <td>{{ $index + 1 }}</td> --}}
                                    <td>{{ $cart['name'] }} <span class="qty-sp">{{ $cart['qty'] }}</span>
                                    </td>
                                    <td class="td-price">Rp {{ number_format($cart['price'], 2, ',', '.') }}
                                    </td>
                                </tr>
                            @empty
                                <td colspan="3">
                                    <h6 class="text-center">Empty Cart</h6>
                                </td>
                            @endforelse
                        </tbody>
                    </table>
                    <div class="form-group">
                        <button type="submit" wire:click="removeItem('{{ $cart['rowId'] }}')"
                            class="btn-block form-group-clearbtn">Clear Sale</button>
                    </div>




                    <div class="form-group mt-2">

                        <h6 class="font-weight-bold ">Sub Total: <span class="subtotal-span">Rp
                                {{ number_format($summary['sub_total'], 2, ',', '.') }}</span>
                        </h6>
                        <h6 class="font-weight-bold ">Total: <span class="subtotal-span">Rp
                                {{ number_format($summary['total'], 2, ',', '.') }}</span>
                        </h6>
                    </div>

                    <div class="form-group mt-4">
                        <input type="number" class="form-control mt-4" id="payment"
                            placeholder="input customer payment amount">
                        <input type="hidden" id="total" value="{{ $summary['total'] }}">
                    </div>

                    <form wire:submit.prevent="handleSubmit">
                        <div class="mt-2">
                            <label>Payment:</label>
                            <h1 id="paymentText">Rp. 0</h1>
                        </div>

                        <div class="mt-2">
                            <label>Kembalian:</label>
                            <h1 id="kembalian">Rp. 0</h1>
                        </div>

                        <div class="mt-4">
                            <button wire:ignore type="submit" id="saveButton" class="btn btn-success btn-block"
                                id="saveButton"><i class="fas fa-save"></i>Save
                                Transaction</button>
                        </div>
                    </form>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        {{-- <button type="button" class="btn btn-primary">Save changes</button> --}}
                    </div>
                </div>
            </div>
        </div>
        @push('script-custom')
            <script>
                payment.oninput = () => {
                    const paymentAmount = document.getElementById("payment").value
                    const totalAmount = document.getElementById("total").value

                    const kembalian = paymentAmount - totalAmount


                    document.getElementById("kembalian").innerHTML = /* ' Rp ${rupiah(kembalian)},00 ' */ kembalian
                    document.getElementById("paymentText").innerHTML = /* ' Rp ${rupiah(kembalian)},00 ' */ paymentAmount

                    const saveButton = getElementById("saveButton")

                    if (kembalian <= 0) {
                        saveButton.disabled = true;
                    } else {
                        saveButton.disabled = false;
                    }

                }

                const rupiah = (angka) => {
                    const numberString = angka.toString()
                    const split = numberString.split(',')
                    const sisa = split[0].length % 3
                    let rupiah = split[0].substr(0, sisa)
                    const ribuan = split[0].substr(sisa).match(/\d{1,3}/gi)

                    if (ribuan) {
                        const separator = sisa ? '.' : ''
                        rupiah += separator + ribuan.join('.')
                    }

                    return split[1] != undifined ? rupiah + ',' + split[1] : rupiah
                }
            </script>
        @endpush

        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"
                integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous">
        </script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js"
                integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous">
        </script>
        {{-- Sweet Alert --}}
        <script src="https://code.jquery.com/jquery-3.5.0.js"></script>
        <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

        <script>
            $("#modals").click(function() {
                swal("Saved!", "Your Bill was saved!", "success");

            });
        </script>

        <script>
            $("#saveButton").click(function() {
                swal("Success!", "Your payment was successfully!", "success");

            });
        </script>
