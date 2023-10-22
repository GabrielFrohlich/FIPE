@extends('layout')

@section('content')
        <div class="container mx-auto flex justify-center align-center h-full">

            <div class="border rounded-xl shadow w-1/2 p-4">
                <h2 class="text-xl mb-2 font-bold">Escolha o veículo que você deseja saber o valor da FIPE:</h2>
                <div class="w-full mb-2 grid grid-cols-2 gap-4">
                    <label for="" class="">Tipo de veículo:</label>
                    <select name="type" id="type" class="w-52">
                        <option value="" disabled selected></option>
                        <option value="carros">{{ __('Cars') }}</option>
                        <option value="motos">{{ __('Motorcycles') }}</option>
                        <option value="caminhoes">{{ __('Trucks') }}</option>
                    </select>
                </div>
                <div class="mb-2 grid grid-cols-2 gap-4">
                    <label for="">Marca do veículo:</label>
                    <select name="brands" id="brands" class="w-52" disabled="disabled"></select>
                </div>
                <div class="mb-2 grid grid-cols-2 gap-4">
                    <label for="">Modelo do veículo:</label>
                    <select name="models" id="models" class="w-52" disabled="disabled"></select>
                </div>
                
                <div class="mb-4 grid grid-cols-2 gap-4">
                    <label for="">Ano do Veículo:</label>
                    <select name="years" id="years" class="w-52" disabled="disabled"></select>
                </div>
                <div>
                    <a class="text-white px-2 py-1 text-md rounded bg-green-300 w-full inline-block text-center" id="search">{{__("Go")}}</a>
                </div>
                
            </div>


        </div>
@endsection

@push('scripts')
<script>
    let type = ""

    $(document).ready(function() {
        $('#type').select2({
            placeholder: 'Selecione um tipo',
        });

        $('#type').on('select2:select', function(e) {
            $('#brands').prop('disabled', false);

            //Defining Ajax with updated url
            $('#brands').select2({
                ajax: {
                    url: `/api/fipe/brands/${$('#type').val()}`,
                    dataType: 'json',
                    delay: 500,
                    data: function(params) {
                        return {
                            q: params.term
                        }
                    },
                    processResults: function(data) {
                        const result = data.map((item) => {
                            return {
                                id: item.codigo,
                                text: item.nome
                            }
                        })

                        return {
                            results: result
                        }
                    }
                }
            });
        });

        $('#brands').select2({
            placeholder: 'Selecione uma marca',
        });

        $('#brands').on('select2:select', function(e) {
            $('#models').prop('disabled', false);

            $('#models').select2({
                ajax: {
                    url: `/api/fipe/models/${$('#type').val()}/${$('#brands').val()}`,
                    dataType: 'json',
                    delay: 250,
                    data: function(params) {
                        return {
                            q: params.term,
                        }
                    },
                    processResults: function(data) {
                        const result = data.map((item) => {
                            return {
                                id: item.codigo,
                                text: item.nome
                            }
                        })

                        return {
                            results: result
                        }
                    }
                }
            })
        });

        $('#models').select2({
            placeholder: 'Selecione um modelo',
        });

        $('#models').on('select2:select', function(){
            $('#years').prop('disabled', false).select2({
                ajax: {
                url: `/api/fipe/models/${$('#type').val()}/${$('#brands').val()}/${$('#models').val()}`,
                dataType: 'json',
                delay: 250,
                data: function(params) {
                    return {
                        q: params.term,
                    }
                },
                processResults: function(data) {
                    const result = data.map((item) => {
                        return {
                            id: item.codigo,
                            text: item.nome
                        }
                    })

                    return {
                        results: result
                    }
                }
            }
            });
        })

        $('#years').select2({
            placeholder: 'Selecione um ano',
        });

        $('#years').on('select2:select', function(){
            $('#search').removeClass('bg-green-300')
            .addClass('bg-green-500')
            .attr('href', `/fipe/${$('#type').val()}/${$('#brands').val()}/${$('#models').val()}/${$('#years').val()}`)
        })
    });
</script>
@endpush
