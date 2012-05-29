/*
  @author Nils Röhrig
*/
// run self invoking anonymous function
(function($) {

  /*
    figures out if calling labels respective formfield is of type select or comes with a placeholder. if true, label got hid. this function should only be called when placeholders are supported by the current browser.
    @returns undefined if used in wrong context (aka "this" not 
    referring a label-tag)
    @returns true if label got hid
    @retuns false if label didn't change visibility.
  */
  function hideIfAppropriate() {
    if(this.tagName.toUpperCase() === 'LABEL'){
      var $this = $(this),
          formField = $('#' + $this.attr('for'));
      // when formField is a dropdown list or comes with a placeholder, label got hid
      if ( formField[0].tagName.toUpperCase() === 'SELECT' || formField.attr('placeholder') !== undefined ) {
        $this.hide();
      }
      return this;
    }
    else {
      return undefined;
    }
  }

  // get all labels and hide them if appropriate
  if ( Modernizr.input.placeholder ) {
    $('label').each(hideIfAppropriate);
  }
  

  /* 
    transforms radiobuttons bearing the passed variable name into fully functional twitter bootstrap buttons. affected radiobuttons and their respective labels are removed from the dom.
    @param varName variable name of the radiobuttons which should be transformed
    @param buttonClass class generated buttons will get on creation
    @returns undefined when varname is not associated with radiobuttons
    @returns jquery object the created button group when varname is associated with radio buttons
  */
  function radio2BSButton (varName, buttonClass) {
    var radios = $('input:radio[name="' + varName + '"]'),
        // creating a new button group conforming to bootstraps rules
        btnGroup = $('<div></div>', {
          'class': 'btn-group',
          'data-toggle': 'buttons-radio'
        }),
        // creating a new hidden field to store radiobutton value
        hiddenField = $('<input />', {
          'type': 'hidden',
          'name': varName,
          // figure out if one radiobutton is checked already and set value appropriately when true, elsewise to -1
          'value': ((radios.filter(':checked').length > 0) ? radios.filter(':checked').first().val() : -1)
        });

    // when radios' length is lower than or equal zero, there are no radiobuttons bearing varName, so return undefined
    if(radios.length <= 0) return undefined;

    // add created button group to the dom
    btnGroup.insertAfter($(radios[radios.length-1]).closest('label'));

    // insert new hidden field ot the dom right behind the button group
    hiddenField.insertAfter(btnGroup);
    
    // create a bootstrap button for each radio button, add it to the button group, finally remove radio button and label from the dom
    radios.each(function(){
      var $this = $(this),
          button = $('<button></button>', {
            'type': 'button',
            // use respective labels text as button text
            'text': $('label[for="' + this.id + '"]').text(),
            'data-value': $this.val(),
            // figure out if current radio button is checked and set class appropriately following bootstraps rules
            'class': ((this.checked) ? buttonClass + ' active' : buttonClass)
          });
      btnGroup.append(button);
      $this.closest('label').remove();
    });

    // create event handler for click events on buttons inside respective group; set value of hidden field
    return btnGroup.on('click', '.' + buttonClass, function(event) {
      hiddenField.val($(this).data('value'));
    });
  }

  radio2BSButton('start-term', 'btn');

})(jQuery);