@extends('layouts.admin')

@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Ajouter un Stock</h1>
                        @if (session('success'))
                            <div class="alert alert-success alert-dismissible fade show mt-2" role="alert">
                                <strong>Succès: </strong> {{ session('success') }}
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        @endif
                        @if ($errors->any())
                            <div class="alert alert-danger alert-dismissible fade show mt-2" role="alert">
                                <strong>Erreurs: </strong><br>
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        @endif
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a class="text-success" href="{{ route('dashboard') }}">Accueil</a></li>
                            <li class="breadcrumb-item"><a class="text-success" href="{{ route('stock.index') }}">Stocks</a></li>
                            <li class="breadcrumb-item active">Ajouter un Stock</li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <!-- Card pour le formulaire de création -->
                <div class="card card-default">
                    <div class="card-header">
                        <h3 class="card-title">Ajout d'un Stock</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <form id="createStockForm" method="POST" action="{{ route('stock.store') }}">
                            @csrf
                            <!-- Row for Product Name and Quantity -->
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="product_name">Designation <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control @error('product_name') is-invalid @enderror" id="product_name" name="product_name" placeholder="Entrer le nom du produit" value="{{ old('product_name') }}" required>
                                        @error('product_name')
                                        <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                        <span class="invalid-feedback" role="alert" id="product_name_error"></span>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="quantity">Quantité <span class="text-danger">*</span></label>
                                        <input type="number" class="form-control @error('quantity') is-invalid @enderror" id="quantity" name="quantity" placeholder="Entrer la quantité" min="0" value="{{ old('quantity') }}" required>
                                        @error('quantity')
                                        <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                        <span class="invalid-feedback" role="alert" id="quantity_error"></span>
                                    </div>
                                </div>
                            </div>
                            <!-- Row for Description and Location -->
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="description">Description</label>
                                        <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description" placeholder="Entrer la description du produit">{{ old('description') }}</textarea>
                                        @error('description')
                                        <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                        <span class="invalid-feedback" role="alert" id="description_error"></span>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="location">Emplacement</label>
                                        <input type="text" class="form-control @error('location') is-invalid @enderror" id="location" name="location" placeholder="Entrer l'emplacement du stock" value="{{ old('location') }}">
                                        @error('location')
                                        <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                        <span class="invalid-feedback" role="alert" id="location_error"></span>
                                    </div>
                                </div>
                            </div>
                            <!-- Submit Button -->
                            <div class="row">
                                <div class="col-md-6">
                                    <button type="submit" class="btn btn-success">Enregistrer</button>
                                    <a href="{{ route('stock.index') }}" class="btn btn-secondary">Retour</a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <!-- /.card -->
            </div>
            <!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>
@endsection

@section('js')
    <script>
        $(document).ready(function() {
            $('#createStockForm').on('submit', function(event) {
                console.log('Événement de soumission intercepté');
                // Empêche la soumission par défaut
                event.preventDefault();

                // Validation du formulaire
                if (validateForm()) {
                    // Soumettre le formulaire si tout est correct
                    this.submit();
                }
            });

            function validateForm() {
                let valid = true;
                // Clear previous errors and classes
                $('.invalid-feedback').html('');
                $('.form-control').removeClass('is-invalid').removeClass('is-valid');

                // Validate product_name
                const productName = $('#product_name').val().trim();
                if (productName === '') {
                    $('#product_name_error').html('Le nom du produit est obligatoire.');
                    $('#product_name').addClass('is-invalid');
                    valid = false;
                } else {
                    $('#product_name').addClass('is-valid');
                }

                // Validate quantity
                const quantity = $('#quantity').val();
                if (quantity === '' || quantity < 0) {
                    $('#quantity_error').html('La quantité doit être un nombre positif.');
                    $('#quantity').addClass('is-invalid');
                    valid = false;
                } else {
                    $('#quantity').addClass('is-valid');
                }

                // Validate description (optional)
                const description = $('#description').val().trim();
                if (description.length > 500) { // Exemple de limite
                    $('#description_error').html('La description ne doit pas dépasser 500 caractères.');
                    $('#description').addClass('is-invalid');
                    valid = false;
                } else {
                    if (description !== '') {
                        $('#description').addClass('is-valid');
                    }
                }

                // Validate location (optional)
                const location = $('#location').val().trim();
                if (location.length > 255) { // Exemple de limite
                    $('#location_error').html('L\'emplacement ne doit pas dépasser 255 caractères.');
                    $('#location').addClass('is-invalid');
                    valid = false;
                } else {
                    if (location !== '') {
                        $('#location').addClass('is-valid');
                    }
                }

                return valid;
            }
        });
    </script>
@endsection
