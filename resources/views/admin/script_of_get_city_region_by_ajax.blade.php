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

            jQuery('#city_id').change(function() {
                let city_id = jQuery(this).val();
                // alert(city_id);
                jQuery.ajax({
                    url: '/admin/get_region_by_city',
                    type: 'post',
                    data: 'city_id=' + city_id + '&_token={{ csrf_token() }}',
                    success: function(result) {
                        jQuery('#region_id').html(result)
                    }
                });
                alert(result)
            });

        });
    </script>
@endpush
