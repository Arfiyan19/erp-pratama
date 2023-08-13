<script>
    $('.btn-success').on('click', function(e) {
        let id = e.target.dataset.id;
        $.ajax({
            url: '<?= base_url($this->uri->segment(1.0) . $this->uri->slash_segment(2.0)) ?>edit',
            data: 'id_role=' + id,
            method: 'post',
            success: function(data) {
                $('.tampil-modal').html(data);
                $('#exampleModal').modal('show');
            }
        });
    });
</script>