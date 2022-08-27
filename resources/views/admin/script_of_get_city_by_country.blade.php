@push('scripts')
    <script>
        jQuery(document).ready(function() {
            jQuery('#country_id').change(function() {
                let country_id = jQuery(this).val();
                // alert(country_id);
                jQuery.ajax({
                    url: '/admin/get_city_by_country',
                    type: 'post',
                    data: 'country_id=' + country_id + '&_token={{ csrf_token() }}',
                    success: function(result) {
                        jQuery('#city_id').html(result)
                    }
                });
                alert(result)
            });
        });
    </script>
@endpush
