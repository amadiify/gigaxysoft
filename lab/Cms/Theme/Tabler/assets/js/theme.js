require(['datatables', 'jquery'], function(datatable, $) {
    $('.datatable').DataTable();
});

require(['jquery', 'selectize'], function ($, selectize) {
    $(document).ready(function () {
        $('#input-tags').selectize({
            delimiter: ',',
            persist: false,
            create: function (input) {
                return {
                    value: input,
                    text: input
                }
            }
        });

        $('#select-beast').selectize({});
    });
});

require(['jquery','froala_editor'], function($, FroalaEditor) {

  // check for create
  var create = $('.text-create');

  if (create != null)
  {
    new FroalaEditor('.text-create', {
      // Set image buttons, including the name
      // of the buttons defined in customImageButtons.
      imageEditButtons: ['imageDisplay', 'imageAlign', 'imageInfo', 'imageRemove'],
      height: 400,
      toolbarSticky: false
    });
  }
  else
  {
    new FroalaEditor('#edit', {
      // Set image buttons, including the name
      // of the buttons defined in customImageButtons.
      imageEditButtons: ['imageDisplay', 'imageAlign', 'imageInfo', 'imageRemove'],
      height: 400,
      toolbarSticky: false
    });
  }

});