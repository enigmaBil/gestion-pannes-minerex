@extends('layouts.admin')

@section('content')

@endsection

@section('js')
    <script>
        $(document).ready(function() {
            $('#editStockForm').on('submit', function(event) {
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
