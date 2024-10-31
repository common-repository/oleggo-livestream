  <script type="text/javascript">
    TwitterSearch.searchTerm = <?php echo '"'.$t_search.'"' ?>;
	TwitterSearch.refreshRate = <?php echo $t_refresh ?>;
	TwitterSearch.beginText = <?php echo '"'.$t_tweetbegin.'"' ?>;
	

	TwitterSearch.searchPage = <?php echo '"'.$OLEGGO_LIVESTREAM_URI.'/oleggo-twitter/twitter_search.php'.'"'; ?>;
	TwitterSearch.loginPage = <?php echo '"'.$OLEGGO_LIVESTREAM_URI.'/oleggo-twitter/twitter_login.php'.'"'; ?>;
	TwitterSearch.logoutPage = <?php echo '"'.$OLEGGO_LIVESTREAM_URI.'/oleggo-twitter/twitter_logout.php'.'"'; ?>;
	TwitterSearch.updateStatusPage = <?php echo '"'.$OLEGGO_LIVESTREAM_URI.'/oleggo-twitter/twitter_update_status.php'.'"'; ?>;
	
    TwitterSearch.search();
  </script>