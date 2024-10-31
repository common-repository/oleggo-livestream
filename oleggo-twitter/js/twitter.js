var TwitterSearch = {
  searchTerm:null,
  refreshRate:30,
  beginText:'',
  
  searchPage:null,
  loginPage:null,
  logoutPage:null,
  updateStatusPage:null,
  
  search:function(){
      TwitterSearch.checkForNewTweets(TwitterSearch.searchPage, TwitterSearch.searchTerm);
      new PeriodicalExecuter(function(pe) {
	      TwitterSearch.refreshSearch();
	  }, TwitterSearch.refreshRate);    
  },
  
  refreshSearch: function() {
      TwitterSearch.checkForNewTweets(TwitterSearch.searchPage, TwitterSearch.searchTerm);
  },
  
  checkForNewTweets:function(search_page, search_term){
	 var nonCacheTS = new Date().getTime();
     new Ajax.Request(search_page + '?q=' + escape(search_term) + '&' + nonCacheTS, {
         method: 'get',
		 onComplete: TwitterSearch.parseAndDisplayResults
     });
  },
  
  parseAndDisplayResults:function(response){
      if(response.responseText.isJSON()) {
          TwitterSearch.displayResults(response.responseText.evalJSON());
      }
  },
  
  displayResults:function(results_json){
    var results_container = document.getElementById('oleggo-twitter-results');
    
    var tweetlist = '';
    
    for(var i=0; i<results_json.results.length; i++) {
      var result    = results_json.results[i];
      var text      = this.sanitizeMessageText(result.text);
      var date      = new Date(result.created_at);
      var even_odd  = 'odd';
      if(i%2 == 0) { even_odd = 'even'; }
      
      tweetlist += '<li class="result '+even_odd+'" id="result_'+result.id+'">';
      tweetlist +=   '<div class="avatar"><a target="_blank" href="http://twitter.com/'+result.from_user+'"><img src="'+result.profile_image_url+'"/></a></div>';
      tweetlist +=   '<div class="text"><a target="_blank" href="http://twitter.com/'+result.from_user+'">'+result.from_user+'</a>: <span class="msgtxt '+result.iso_language_code+'" id="msgtxt'+result.id+'">'+text+'</span></div>';
      tweetlist +=   '<div class="info">' + date.time_ago_in_words() + ' ago.</div>';
      tweetlist += '</li>';
    }
    
    results_container.innerHTML= '<ol id="twitter_results">' + tweetlist + '</ol>';
  },
  
  sanitizeMessageText:function(text) {
    text = text.replace('&amp;', '&');
  	
    var link_regex = new RegExp("(([a-zA-Z]+:\/\/)([a-z][a-z0-9_\..-]*[a-z]{2,6})([a-zA-Z0-9\/*-_\?&%]*))", "i");
  	text = text.replace(link_regex, '<a href="$1">$1</a>');
  	
  	var reply_regex = new RegExp("@([a-zA-Z0-9_]+)", "g");
  	text = text.replace(reply_regex, '@<a href="http://twitter.com/$1">$1</a>');
  	
    return(text);
  }
  
};

var TwitterWidget = {
	
	charCounter:function (field, limit){
		if($F(field).length >= limit){
			$(field).value = $F(field).substring(0, limit);
			$('charCounter').update('0');
		} else {	
			$('charCounter').update(limit - $F(field).length);
		}		
	},

    enableFieldText:function (field, defaultValue) {
	    field.removeClassName('unfilled');
	    if(field.value == defaultValue) {
	        field.value = '';
	    }
	},
	
	disableFieldText:function (field, defaultValue) {
	    if(field.value == '') {
		    field.value = defaultValue;
			field.addClassName('unfilled');
		}
	},
	
	authzUser:function() {
		new Ajax.Request(TwitterSearch.loginPage, {
		  parameters: {username: escape($F('usernameField')), password: escape($F('passwordField'))},
		  onComplete: function(response){
		    $('oleggo-twitter-form').update(response.responseText);
			$('tweetText').value = TwitterSearch.beginText + ' ';
		  }
        });
	},
	
	logoutUser:function() {
		new Ajax.Request(TwitterSearch.logoutPage, {
		  onComplete: function(response){$('oleggo-twitter-form').update(response.responseText);}
        });
	},
	
	updateStatus:function() {
		new Ajax.Request(TwitterSearch.updateStatusPage, {
		  parameters: {text: escape($F('tweetText'))},
		  onComplete: function(response){
		    $('oleggo-twitter-form').update(response.responseText);
			TwitterSearch.refreshSearch();
		  }
        });
	}

};

Date.prototype.time_ago_in_words = function() {
    var words;
    distance_in_milliseconds = new Date() - this;
    distance_in_minutes = Math.round(  Math.abs(distance_in_milliseconds / 60000)  );

    if (distance_in_minutes == 0) {
      words = "less than a minute";
    } else if (distance_in_minutes == 1) {
      words = "1 minute";
    } else if (distance_in_minutes < 45) {
      words = distance_in_minutes + " minutes";
    } else if (distance_in_minutes < 90) {
      words = "about 1 hour";
    } else if (distance_in_minutes < 1440) {
      words = "about " + Math.round(distance_in_minutes / 60) + " hours";
    } else if (distance_in_minutes < 2160) {
      words = "about 1 day";
    } else if (distance_in_minutes < 43200) {
      words = Math.round(distance_in_minutes / 1440) + " days";
    } else if (distance_in_minutes < 86400) {
      words = "about 1 month";
    } else if (distance_in_minutes < 525600) {
      words = Math.round(distance_in_minutes / 43200) + " months";
    } else if (distance_in_minutes < 1051200) {
      words = "about 1 year";
    } else {
      words = "over " + Math.round(distance_in_minutes / 525600) + " years";
    }

    return words;
};