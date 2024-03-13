
var checkboxFilter = {

  $filters: null,
  $reset: null,
  groups: [],
  outputArray: [],
  outputString: '',
  

  init: function(){
    var self = this; 
    self.$filters = $('#Filters');
    self.$reset = $('#Reset');
    self.$container = $('#Container');
    self.$Search = $('#input_sr');
    
    self.$filters.find('fieldset').each(function(){
      self.groups.push({
        $inputs: $(this).find('input'),
        active: [],
		    tracker: false
      });
    });
    
    self.bindHandlers();
  },
  

  bindHandlers: function(){
    var self = this;

    
    self.$filters.on('change', function(){
      self.parseFilters();
    });

    self.$reset.on('click', function(e){
      e.preventDefault();
      self.$filters[0].reset();
      self.$filters[0].reset();
      self.parseFilters();
      $('#input_sr').val('');
    });
    
    self.$Search.on('input', function(e){
      e.preventDefault();
      self.$filters[0].reset();
      self.$filters[0].reset();
    });

  },

  parseFilters: function(){
    var self = this;

    for(var i = 0, group; group = self.groups[i]; i++){
      group.active = []; 
      group.$inputs.each(function(){ 
        $(this).is(':checked') && group.active.push(this.value);
      });
	    group.active.length && (group.tracker = 0);
    }
    
    self.concatenate();
  },
  

  concatenate: function(){
    var self = this,
		  cache = '',
		  crawled = false,
      
		  checkTrackers = function(){
        var done = 0;
        console.log(self);
        for(var i = 0, group; group = self.groups[i]; i++){
          (group.tracker === false) && done++;
        }

        return (done < self.groups.length);
      },
      crawl = function(){
        for(var i = 0, group; group = self.groups[i]; i++){
          group.active[group.tracker] && (cache += group.active[group.tracker]);

          if(i === self.groups.length - 1){
            self.outputArray.push(cache);
            cache = '';
            updateTrackers();
          }
        }
      },
      updateTrackers = function(){
        for(var i = self.groups.length - 1; i > -1; i--){
          var group = self.groups[i];

          if(group.active[group.tracker + 1]){
            group.tracker++; 
            break;
          } else if(i > 0){
            group.tracker && (group.tracker = 0);
          } else {
            crawled = true;
          }
        }
      };
    
    self.outputArray = []; 
	  do{
		  crawl();
	  }
	  while(!crawled && checkTrackers());

    self.outputString = self.outputArray.join();
    

    !self.outputString.length && (self.outputString = 'all'); 
    

	  if(self.$container.mixItUp('isLoaded')){
    	self.$container.mixItUp('filter', self.outputString);
	  }
  }
};
  

$(function(){

  checkboxFilter.init();

  $('#Container').mixItUp({

    /*
        "animation": {
            "duration": 0,
            "nudge": false,
            "reverseOut": false,
            "effects": ""
        }
    */

  
  });    
});

// Поиск
$(function() {

  var inputText;
  var $matching = $();

  // Delay function
  var delay = (function(){
    var timer = 0;
    return function(callback, ms){
      clearTimeout (timer);
      timer = setTimeout(callback, ms);
    };
  })();

  $("#input_sr").keyup(function(){
    // Delay function invoked to make sure user stopped typing
    delay(function(){
      inputText = $("#input_sr").val().toLowerCase();
      
      // Check to see if input field is empty
      if ((inputText.length) > 0) {         
        $( '.mix').each(function() {
          
           // add item to be filtered out if input text matches items inside the title   
           if($(this).children('.search_object').text().toLowerCase().match(inputText)) {
            $matching = $matching.add(this);
          }
          else {
            // removes any previously matched item
            $matching = $matching.not(this);
          }
        });
        $(".container").mixItUp('filter', $matching);
      }

      else {
        // resets the filter to show all item if input is empty
        $(".container").mixItUp('filter', 'all');
      }
    }, 200 );
  });
})
