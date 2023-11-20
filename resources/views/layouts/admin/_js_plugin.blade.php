<script src="{{ asset('assets/admin/js/app.js') }}"></script>
<script src="{{ asset('assets/admin/js/main.js') }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.0/sweetalert.min.js"></script>

<script type="text/javascript">

    $('.confirm-delete-button').click(function(event) {
        var form =  $(this).closest("form");
        event.preventDefault();

        swal({
            title: `Apakah anda yakin ingin menghapus data ini?`,
            text: "Data yang dihapus akan masuk ke keranjang sampah",
            icon: "warning",
            buttons: true,
            dangerMode: true,
        })
            .then((willDelete) => {
                if (willDelete) {
                    form.submit();
                }
            });
    });

    $('.form-menu-ids').change(function(e) {
        var $this = $(this);
        var id = e.target.id;
        var isChecked = $(`#${id}`).is(':checked');
        var parent = $this.parent();
        var permission = parent.children().last().find('.form-menu-permission-ids');

        if (isChecked) {
            permission.prop('checked', true);
        } else {
            permission.prop('checked', false);
        }

    });

</script>

<script>
    tinymce.init({
      selector: 'textarea',
      plugins: 'anchor autolink charmap codesample emoticons image link lists advlist media searchreplace table visualblocks wordcount insertdatetime pagebreak autosave directionality emoticons fullscreen',
      toolbar: 'undo redo | blocks fontfamily fontsize | bold italic underline strikethrough | link image media mergetags | addcomment showcomments | spellcheckdialog a11ycheck typography | align lineheight | checklist numlist bullist indent outdent | emoticons charmap | removeformat | insertdatetime | pagebreak | restoredraft | ltr rtl | emoticons | fullscreen | table tabledelete | tableprops tablerowprops tablecellprops | tableinsertrowbefore tableinsertrowafter tabledeleterow | tableinsertcolbefore tableinsertcolafter tabledeletecol | visualblocks | wordcount',
      tinycomments_mode: 'embedded',
      tinycomments_author: 'Author name',
      mergetags_list: [
        { value: 'First.Name', title: 'First Name' },
        { value: 'Email', title: 'Email' },
      ],
    });
</script>
