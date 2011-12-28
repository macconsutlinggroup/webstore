<?php
	require_once('includes/prepend.inc.php');

    // Ensure we load the database session storage object if needed
    if (_xls_get_conf('SESSION_HANDLER') == 'DB') {
    	QApplication::$ClassFile['xlssessionhandler'] =
    		__XLSWS_INCLUDES__ .
    		'/core/session/XLSDBSessionHandler.class.php';
    	XLSSessionHandler::$CollectionOverridePhp = true;
    }

	if(isset($_GET[session_name()]))
		session_id($_GET[session_name()]);
	
	QApplication::$EncodingType = "UTF-8";
	$_SESSION['admin_auth'] =  true; 
	session_commit();		
	header("Location: xls_admin.php?" . session_name() . "=" . session_id());

?>
