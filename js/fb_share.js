window.fbAsyncInit = function() {
  FB.init({
    appId      : '868502176588122',
    xfbml      : true,
    version    : 'v2.5'
  });
  
  FB.ui({
    method: 'share_open_graph',
    action_type: 'og.likes',
    action_properties: JSON.stringify({
      object:'https://developers.facebook.com/docs/',
    })
  }, function(response){
    // Debug response (optional)
    console.log(response);
  });
};
    
