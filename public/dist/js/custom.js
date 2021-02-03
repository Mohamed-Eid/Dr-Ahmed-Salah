$(document).ready(function () {

  // SELECT PROFILE IMG
  $(".image").on('change', function() {
  if (this.files && this.files[0]) {
    var reader = new FileReader();

    reader.onload = (e) => {
      $('.image-preview').attr('src', e.target.result);
    }

    reader.readAsDataURL(this.files[0]);
  };
});


  // START:: DARK MODE
  // $('.dark-mode').on('click', function() {
  //   $('html').toggleClass('dark');
  //   $('body').css('background', '#232A3B');
  // });
  // START:: DARK MODE

  // START:: SYSTEM THEMES
  $('.color-themes li').on('click', function() {
    localStorage.setItem('--mainBackGround', $(this).data('color'));
    $(':root').css('--mainBackGround', localStorage.getItem('--mainBackGround'));
  });
  
  // END:: SYSTEM THEMES


  // START:: ADD NEW VISIT PAGE
  $('#drug-allergy-comments').css('visibility' , 'hidden');
  $('#smoking-comments').css('visibility' , 'hidden');
  $('#blood-transfusion-comments').css('visibility' , 'hidden');
  $('#alcoholic-comments').css('visibility' , 'hidden');


  $('#prev-sergeries-comments').css('visibility' , 'hidden');
  $('#family-history-comments').css('visibility' , 'hidden');

  $("#drug-allergy").on('change' , () => {
    let DrugAllergyOptionValue = $("#drug-allergy").children('option:checked').val();
    if(DrugAllergyOptionValue == 0) {
      $('#drug-allergy-comments').css('visibility' , "hidden");
    } else if (DrugAllergyOptionValue == 1) {
      $('#drug-allergy-comments').css('visibility' , "visible");
    }
  }); 

  $("#smoking").on('change' , () => {
    let smokingOptionValue = $('#smoking').children('option:checked').val();
    if ( smokingOptionValue == 0 ) {
      $('#smoking-comments').css('visibility' , 'hidden');
    } else if ( smokingOptionValue == 1 ) {
      $('#smoking-comments').css('visibility' , 'visible');
    };
  });

  $("#blood-transfusion").on('change' , () => {
    let bloodTransfusionOptionValue = $('#blood-transfusion').children('option:checked').val();
    if (bloodTransfusionOptionValue == 0) {
      $('#blood-transfusion-comments').css('visibility' , 'hidden');
    } else if ( bloodTransfusionOptionValue == 1 ) {
      $('#blood-transfusion-comments').css('visibility' , 'visible');
    }
  });

  $("#alcoholic").on('change' , () => {
    let alcoholicOptionValue = $("#alcoholic").children('option:checked').val();
    if ( alcoholicOptionValue == 0 ) {
      $('#alcoholic-comments').css('visibility' , 'hidden');
    } else if ( alcoholicOptionValue == 1 ) {
      $('#alcoholic-comments').css('visibility' , 'visible');
    }
  });

  $("#prev-sergeries").on('change' , () => {
    let prevSergOptionValue = $("#prev-sergeries").children('option:checked').val();
    if ( prevSergOptionValue == 0 ) {
      $('#prev-sergeries-comments').css('visibility' , 'hidden');
    } else if ( prevSergOptionValue == 1 ) {
      $('#prev-sergeries-comments').css('visibility' , 'visible');
    }
  });

  $("#family-history").on('change' , () => {
    let familyOptionValue = $("#family-history").children('option:checked').val();
    if ( familyOptionValue == 0 ) {
      $('#family-history-comments').css('visibility' , 'hidden');
    } else if ( familyOptionValue == 1 ) {
      $('#family-history-comments').css('visibility' , 'visible');
    }
  });

  $('.chronic-diseases-selector').on('select2:select', function (e) {
    console.log(e.params.data);
    let myMarkUp = `
    <div class="target grid grid-cols-12 gap-6 col-span-12 lg:flex-row pr-3 pl-3 -mx-5" id="item-${e.params.data.id}">

      <div class="col-span-10">
        <label class="text-gray-600 mb-3 text-lg">Comments</label>
        <textarea class="input w-full border mt-2" name="chronic_diseases[${e.params.data.id}]"   placeholder="Comments" rows="3">${e.params.data.text}</textarea>
      </div>

      <span class="delete col-span-2 button translate-y-3 my-3 mr-2 flex items-center justify-center bg-theme-6 text-white" style="margin-top: 50px; margin-bottom: 25px;"> Remove </span>

    </div>
    `;
    $('.comments-container').append(myMarkUp);

    $('.delete').on('click' , function() {
      $(this).parent().remove();
    });
  });



  $('.chronic-diseases-selector').on('select2:unselecting', function (e) {
    //console.log(e.params.args.data.id); //.params.data.id
    console.log("#item-"+e.params.args.data.id);
    $("#item-"+e.params.args.data.id).remove();
  });

function generateMarkup(containerClass,fieldsName,itemIdPrefix,e){
    let myMarkUp = `
    <div class="target grid grid-cols-12 gap-6 col-span-12 lg:flex-row pr-3 pl-3 -mx-5" id="${itemIdPrefix}-${e.params.data.id}">

      <div class="col-span-10">
        <label class="text-gray-600 mb-3 text-lg">Comments</label>
        <textarea class="input w-full border mt-2" name="${fieldsName}[${e.params.data.id}]"   placeholder="Comments" rows="3">${e.params.data.text}</textarea>
      </div>

      <span class="delete col-span-2 button translate-y-3 my-3 mr-2 flex items-center justify-center bg-theme-6 text-white" style="margin-top: 50px; margin-bottom: 25px;"> X </span>

    </div>
    `;
    $('.'+containerClass).append(myMarkUp);

    $('.delete').on('click' , function() {
      $(this).parent().remove();
    });
}

function deleteMarkUp( itemIdPrefix, e){
  console.log(e);
  // $("."+containerClass).remove($("#"+itemIdPrefix+"-"+e.params.args.data.id));
  $("#"+itemIdPrefix+"-"+e.params.args.data.id).remove();
}


  $('.complaints-selector').on('select2:select', function (e) {
      generateMarkup('complaints-comments-container','complaints','comment',e);
  });

  $('.complaints-selector').on('select2:unselecting', function (e) {
    //console.log(e.params.args.data.id); //.params.data.id
    deleteMarkUp('comment',e);
  });







  $('#basic-info').css('display', 'none');
  $('.toggle-edit-basic-info').on('click', () => {
    $('#basic-info').css('display', 'block');
  });

  $('.remove-img').on('click', () => {
    $('.remove-img').parent().parent().css('display', 'none');
  });

  $('#doctor-info').css('display' , 'none');
  $('.toggle-edit-doctor-info').on('click', () => {
    $('#doctor-info').css('display' , 'block');
  });

  $('#investigations').css('display', 'none');
  $('.toggle-investigation').on('click', () => {
    $('#investigations').css('display', 'block')
  });

  $('#visites').css('display', 'none');
  $('.toggle-visites').on('click', () => {
    $('#visites').css('display', 'block')
  });

  $('#procedure').css('display', 'none');
  $('#procedure-details').css('display', 'none');
  $('#procedures-title').css('display', 'none');
  $('#procedure-financ').css('display', 'none');
  $('.add-procedure').on('click', () => {
    $('.add-procedure').css('display', 'none');
    $('#procedure').css('display', 'block');
    $('#procedure-details').css('display', 'block');
    $('#procedures-title').css('display', 'block');
    $('#procedure-financ').css('display', 'block');
  });



  // END:: ADD NEW VISIT PAGE

  // START:: DOCTOR INFO PAGE


$('.examination-selector').on('select2:select', function (e) {
  generateMarkup('examination-comments-container','examinations','examination',e);
});

$('.examination-selector').on('select2:unselecting', function (e) {
  console.log(e.params.args.data.id); //.params.data.id
  deleteMarkUp('examination',e);
});

$('.diagnosis-selector').on('select2:select', function (e) {
  generateMarkup('diagnosis-comments-container','diagnosis','diagnosis',e);
});

$('.diagnosis-selector').on('select2:unselecting', function (e) {
  console.log(e.params.args.data.id); //.params.data.id
  deleteMarkUp('diagnosis',e);
});

$('.plan-selector').on('select2:select', function (e) {
  generateMarkup('plan-comments-container','plans','plan',e);
});

$('.plan-selector').on('select2:unselecting', function (e) {
  console.log(e.params.args.data.id); //.params.data.id
  deleteMarkUp('plan',e);
});









$('.surgent-selector').on('select2:select', function (e) {
  generateMarkup('main-surgent-comments-container','surgents','surgent',e);
});

$('.surgent-selector').on('select2:unselecting', function (e) {
  console.log(e.params.args.data.id); //.params.data.id
  deleteMarkUp('surgent',e);
});


$('.assistant-selector').on('select2:select', function (e) {
  generateMarkup('assistant-comments-container','assistants','assistant',e);
});

$('.assistant-selector').on('select2:unselecting', function (e) {
  console.log(e.params.args.data.id); //.params.data.id
  deleteMarkUp('assistant',e);
});

$('.anesthesia-selector').on('select2:select', function (e) {
  generateMarkup('anesthesia-comments-container','anesthesia','anesthesia',e);
});

$('.anesthesia-selector').on('select2:unselecting', function (e) {
  console.log(e.params.args.data.id); //.params.data.id
  deleteMarkUp('anesthesia',e);
});







  // END:: DOCTOR INFO PAGE

  // START:: INVESTIGATIONS PAGE
  $('.hamboly').on('select2:select', function (event) {
    event.preventDefault();
    let planMarkUp = `
    <div class="target grid grid-cols-12 gap-6 col-span-12 lg:flex-row pr-3 pl-3 -mx-5" id="investigation-${event.params.data.id}">

      <div class="col-span-12 md:col-span-8">
        <label class="text-gray-600 mb-3 text-lg">Results</label>
        <textarea class="input w-full border mt-2" name="investigations[${event.params.data.id}][data][]" placeholder="Results" rows="3"></textarea>
      </div>

      <div class="col-span-8 md:col-span-3 lg:flex-row pr-3 pl-3 -mx-5">
        <label class="text-gray-600 text-lg">Results Docs</label>
        <input name="investigations[${event.params.data.id}][files][]" type="file" class="input w-full border mt-2" style="padding: 4px;" multiple /> 
      </div>

      <span class="delete-investigation font-black col-span-4 md:col-span-1 button translate-y-3 my-3 mr-2 flex items-center justify-center bg-theme-6 text-white" style="margin-top:35px; margin-bottom: 52px;"> 
        X 
      </span>

    </div>
    `;
    $('.investigation-comments-container').append(planMarkUp);

    $('.delete-investigation').on('click' , function() {
      $(this).parent().remove();
    });
  });


  $('.hamboly').on('select2:unselecting', function (e) {
    console.log(e.params.args.data.id); //.params.data.id
    deleteMarkUp('investigation',e);
  });
  // END:: INVESTIGATIONS PAGE

  // START:: PROCEDURES PAGE


  $('#complications-comments').css('display', 'none');
  $('#complications').on('change', () => {
    let optionValue = $('#complications').children('option:checked').val();
    if ( optionValue == 0 ) {
      $('#complications-comments').css('display', 'none');
    } else if ( optionValue == 1 ) {
      $('#complications-comments').css('display', 'block');
    }
  });
  // END:: PROCEDURES PAGE

  $('#non-surg-proc').css('display', 'none');
$('.add-non-surg-proc').on('click', () => {
  $('#non-surg-proc').css('display', 'block');
});
$('.non-serg-procedure-selector').on('select2:select', function (e) {
  let amount = e.params.data.element.attributes[1]['value'];
  let nonSergProcedureMarkUp = `
  <div class="target grid grid-cols-12 gap-6 col-span-12 lg:flex-row pr-3 pl-3 -mx-5" id="nonsurgery-${e.params.data.id}">

    <div class="col-span-12 md:col-span-4">
      <label class="text-gray-600 mb-3 text-lg">Selected Procedure Amount </label>
      <input type="number" name="nonsurgery[${e.params.data.id}][amount]"  class="the-num input w-full border mt-2" placeholder="Amount" value="1" min="1" max="${amount}"> 
    </div>

    <div class="col-span-12 md:col-span-4">
      <label class="text-gray-600 mb-3 text-lg">Comments</label>
      <input type="text" name="nonsurgery[${e.params.data.id}][comment]" class="input w-full border mt-2" placeholder="Price">
    </div>

    <span class="delete-non-serg-procedure col-span-12 md:col-span-4 button translate-y-3 mb-3 mr-2 flex items-center justify-center bg-theme-6 text-white" style="margin-top: 35px; margin-bottom: 25px;"> Remove </span>

  </div>
  `;
  $('.non-serg-procedure-comments-container').append(nonSergProcedureMarkUp);

  $('.delete-non-serg-procedure').on('click' , function() {
    $(this).parent().remove();
  });
});

  // START:: PRINT BUTTON
  $('.print-tables').on('click', function () {
    window.print();
  });
  // END:: PRINT BUTTON
});
