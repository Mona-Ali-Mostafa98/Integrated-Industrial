@push('scripts')
    <script>
        jQuery(document).ready(function() {
            jQuery('#category_id').change(function() {
                let category_id = jQuery(this).val();
                // alert(category_id);
                jQuery.ajax({
                    url: '/admin/get_subcategory_by_category',
                    type: 'post',
                    data: 'category_id=' + category_id + '&_token={{ csrf_token() }}',
                    success: function(result) {
                        jQuery('#subcategory_id').html(result)
                    }
                });
                alert(result)
            });
        });
    </script>
@endpush
