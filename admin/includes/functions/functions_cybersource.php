<?php
function xml2array($contents, $get_attributes=1, $priority = 'tag') {
    if(!$contents) return array();

    if(!function_exists('xml_parser_create')) {
        //print "'xml_parser_create()' function not found!";
        return array();
    }

    //Get the XML parser of PHP - PHP must have this module for the parser to work
    $parser = xml_parser_create('');
    xml_parser_set_option($parser, XML_OPTION_TARGET_ENCODING, "UTF-8"); # http://minutillo.com/steve/weblog/2004/6/17/php-xml-and-character-encodings-a-tale-of-sadness-rage-and-data-loss
    xml_parser_set_option($parser, XML_OPTION_CASE_FOLDING, 0);
    xml_parser_set_option($parser, XML_OPTION_SKIP_WHITE, 1);
    xml_parse_into_struct($parser, trim($contents), $xml_values);
    xml_parser_free($parser);

    if(!$xml_values) return;//Hmm...

    //Initializations
    $xml_array = array();
    $parents = array();
    $opened_tags = array();
    $arr = array();

    $current = &$xml_array; //Refference

    //Go through the tags.
    $repeated_tag_index = array();//Multiple tags with same name will be turned into an array
    foreach($xml_values as $data) {
        unset($attributes,$value);//Remove existing values, or there will be trouble

        //This command will extract these variables into the foreach scope
        // tag(string), type(string), level(int), attributes(array).
        extract($data);//We could use the array by itself, but this cooler.

        $result = array();
        $attributes_data = array();
        
        if(isset($value)) {
            if($priority == 'tag') $result = $value;
            else $result['value'] = $value; //Put the value in a assoc array if we are in the 'Attribute' mode
        }

        //Set the attributes too.
        if(isset($attributes) and $get_attributes) {
            foreach($attributes as $attr => $val) {
                if($priority == 'tag') $attributes_data[$attr] = $val;
                else $result['attr'][$attr] = $val; //Set all the attributes in a array called 'attr'
            }
        }

        //See tag status and do the needed.
        if($type == "open") {//The starting of the tag '<tag>'
            $parent[$level-1] = &$current;
            if(!is_array($current) or (!in_array($tag, array_keys($current)))) { //Insert New tag
                $current[$tag] = $result;
                if($attributes_data) $current[$tag. '_attr'] = $attributes_data;
                $repeated_tag_index[$tag.'_'.$level] = 1;

                $current = &$current[$tag];

            } else { //There was another element with the same tag name

                if(isset($current[$tag][0])) {//If there is a 0th element it is already an array
                    $current[$tag][$repeated_tag_index[$tag.'_'.$level]] = $result;
                    $repeated_tag_index[$tag.'_'.$level]++;
                } else {//This section will make the value an array if multiple tags with the same name appear together
                    $current[$tag] = array($current[$tag],$result);//This will combine the existing item and the new item together to make an array
                    $repeated_tag_index[$tag.'_'.$level] = 2;
                    
                    if(isset($current[$tag.'_attr'])) { //The attribute of the last(0th) tag must be moved as well
                        $current[$tag]['0_attr'] = $current[$tag.'_attr'];
                        unset($current[$tag.'_attr']);
                    }

                }
                $last_item_index = $repeated_tag_index[$tag.'_'.$level]-1;
                $current = &$current[$tag][$last_item_index];
            }

        } elseif($type == "complete") { //Tags that ends in 1 line '<tag />'
            //See if the key is already taken.
            if(!isset($current[$tag])) { //New Key
                $current[$tag] = $result;
                $repeated_tag_index[$tag.'_'.$level] = 1;
                if($priority == 'tag' and $attributes_data) $current[$tag. '_attr'] = $attributes_data;


            } else { //If taken, put all things inside a list(array)
                if(isset($current[$tag][0]) and is_array($current[$tag])) {//If it is already an array...

                    // ...push the new element into that array.
                    $current[$tag][$repeated_tag_index[$tag.'_'.$level]] = $result;
                    
                    if($priority == 'tag' and $get_attributes and $attributes_data) {
                        $current[$tag][$repeated_tag_index[$tag.'_'.$level] . '_attr'] = $attributes_data;
                    }
                    $repeated_tag_index[$tag.'_'.$level]++;

                } else { //If it is not an array...
                    $current[$tag] = array($current[$tag],$result); //...Make it an array using using the existing value and the new value
                    $repeated_tag_index[$tag.'_'.$level] = 1;
                    if($priority == 'tag' and $get_attributes) {
                        if(isset($current[$tag.'_attr'])) { //The attribute of the last(0th) tag must be moved as well
                            
                            $current[$tag]['0_attr'] = $current[$tag.'_attr'];
                            unset($current[$tag.'_attr']);
                        }
                        
                        if($attributes_data) {
                            $current[$tag][$repeated_tag_index[$tag.'_'.$level] . '_attr'] = $attributes_data;
                        }
                    }
                    $repeated_tag_index[$tag.'_'.$level]++; //0 and 1 index is already taken
                }
            }

        } elseif($type == 'close') { //End of tag '</tag>'
            $current = &$parent[$level-1];
        }
    }
    
    return($xml_array);
}  


//-----------------------------------------------------------------------------
function runAuth( $config, $request )
//-----------------------------------------------------------------------------
{

	// send request now
	$reply = array();
	$status = cybs_run_transaction( $config, $request, $reply );
				
	if ($status == CYBS_S_OK)
	{
		
		return $reply[CYBS_SK_XML_DOCUMENT];
		
}	
	else
	{
		handleError( $status, $request, $reply );
		return( '' );
	}
}					

//-----------------------------------------------------------------------------
function handleError( $status, $request, $reply )
//-----------------------------------------------------------------------------
{
	echo "RunTransaction Status: $status\n";

	switch ($status)
	{
		case CYBS_S_PHP_PARAM_ERROR:
			printf( "Please check the parameters passed to cybs_run_transaction for correctness.\n" );
			break;
		
		case CYBS_S_PRE_SEND_ERROR:
			printf(	"The following error occurred before the request could be sent:\n%s\n",
				    $reply[CYBS_SK_ERROR_INFO] );
			break;
		
		case CYBS_S_SEND_ERROR:
			printf( "The following error occurred while sending the request:\n%s\n",
				    $reply[CYBS_SK_ERROR_INFO] );
			break;

		case CYBS_S_RECEIVE_ERROR:
			printf( "The following error occurred while waiting for or retrieving the reply:\n%s\n",
				    $reply[CYBS_SK_ERROR_INFO] );
			handleCriticalError( $status, $request, $reply );
			break;

		case CYBS_S_POST_RECEIVE_ERROR:
			printf(	"The following error occurred after receiving and during processing of the reply:\n%s\n",
				    $reply[CYBS_SK_ERROR_INFO] );
			handleCriticalError( $status, $request, $reply );
			break;		

		case CYBS_S_CRITICAL_SERVER_FAULT:
			printf( "The server returned a CriticalServerError fault:\n%s\n",
					getFaultContent( $reply ) );
			handleCriticalError( $status, $request, $reply );
			break;
		
		case CYBS_S_SERVER_FAULT:
			printf( "The server returned a ServerError fault:\n%s\n",
					getFaultContent( $reply ) );
			break;

		case CYBS_S_OTHER_FAULT:
			printf( "The server returned a fault:\n%s\n",
					getFaultContent( $reply ) );
			break;
 
		Case CYBS_S_HTTP_ERROR:
			printf(	"An HTTP error occurred:\n%s\nResponse Body:\n%s\n",
				    $reply[CYBS_SK_ERROR_INFO], $reply[CYBS_SK_RAW_REPLY] );
			break;
	}
}

//-----------------------------------------------------------------------------
// If an error occurs after the request has been sent to the server, but the
// client can//t determine whether the transaction was successful, then the
// error is considered critical.  If a critical error happens, the transaction
// may be complete in the CyberSource system but not complete in your order
// system.  Because the transaction may have been successfully processed by
// CyberSource, you should not resend the transaction, but instead send the
// error information and the order information (customer name, order number,
// etc.) to the appropriate personnel at your company.  They should use the
// information as search criteria within the CyberSource Transaction Search
// Screens to find the transaction and determine if it was successfully
// processed. If it was, you should update your order system with the
// transaction information. Note that this is only a recommendation; it may not
// apply to your business model.
//-----------------------------------------------------------------------------
function handleCriticalError( $status, $request, $reply )
//-----------------------------------------------------------------------------
{
	$replyType = '';
	$replyText = '';
	
	if ($status == CYBS_S_CRITICAL_SERVER_FAULT)
	{
		$replyType = 'FAULT DETAILS: ';
		$replyText = getFaultContent( $reply );
	}
	else
	{
		$replyText = $reply[CYBS_SK_RAW_REPLY];
		if ($replyText <> '')
			$replyType = 'RAW REPLY: ';
		else
			$replyType = "No Reply available.";
	}

	$messageToSend
		= sprintf( 
			"STATUS: %d\nERROR INFO: %s\nREQUEST: \n%s\n%s\n%s\n",
			$status, $reply[CYBS_SK_ERROR_INFO],
			getArrayContent( $request ), $replyType, $replyText );
		  
	// send $messageToSend to the appropriate personnel at your company
	// using any suitable method, e.g. e-mail, multicast log, etc.
	//
	// This sample code simply sends it to standard output.

	printf( "\nThis is a critical error.  Send the following information to the appropriate personnel at your company: \n%s\n",
			$messageToSend );
}		

				
//-----------------------------------------------------------------------------
function getFaultContent( $reply )
//-----------------------------------------------------------------------------
{
	$requestID = $reply[CYBS_SK_FAULT_REQUEST_ID];
	if ( $requestID == "")
		$requestID = "(unavailable)";
	
	return( sprintf(
		"Fault code: %s\nFault string: %s\nRequestID: %s\nFault document: %s",
		$reply[CYBS_SK_FAULT_CODE], $reply[CYBS_SK_FAULT_STRING],
		$requestID, $reply[CYBS_SK_FAULT_DOCUMENT] ) );
}

//-----------------------------------------------------------------------------
function getArrayContent( $arr )
//-----------------------------------------------------------------------------
{
        $content = '';
        while (list( $key, $val ) = each( $arr ))
        {
                $content = $content . $key . ' => ' . $val . "\n";
        }

        return( $content );
}

//-----------------------------------------------------------------------------
function getFileContent( $filename )
//-----------------------------------------------------------------------------
{
	$handle = fopen( $filename, "r" );
	$content = fread( $handle, filesize( $filename ) );
	fclose($handle);

	return( $content );
}


function writeUserMessage( $status, $reply )
// ----------------------------------------------------------------------------
{	
	
	
	switch( $status )
	{
		// successful transmission (not necessarily a successful transaction)
		case CYBS_S_OK:
			$decision = strtoupper( $reply['decision'] );
			
			if ($decision == "ACCEPT")
				$output = 'Thank you!  Your order has been processed successfully.';
				
			elseif ($decision == "REVIEW")
				$output = 'There was a problem completing your order.  We apologize for the inconvenience.  Please contact customer support to review your order.';
				
			else
			{    // REJECT or ERROR
				 // Here, you can customize the message depending on the
				 // reasonCode.  This sample only handles 204 (Insufficient
				 // funds) specifically and handles the rest generically.
				
				$reasonCode = $reply['reasonCode'];
				
				switch ($reasonCode)
				{
					case '204':
						$output = 'There are insufficient funds in your account.  Please use a different credit card.';
						break;
					default:
						if ($decision == 'REJECT')
							$output = 'Your order could not be completed.  Please review the information you entered and try again.';
						else // ERROR
							$output = 'Your order could not be completed.  We apologize for the inconvenience.  Please try again at a later time.';
				}
			}
			break;

		// non-critical errors			
		case CYBS_S_PHP_PARAM_ERROR:
		case CYBS_S_PRE_SEND_ERROR:
		case CYBS_S_SEND_ERROR:
		case CYBS_S_SERVER_FAULT:
		case CYBS_S_OTHER_FAULT:
		case CYBS_S_HTTP_ERROR:
			$output = 'Your order could not be completed.  We apologize for the inconvenience.  Please try again at a later time.';
			break;
		
		// critical errors
		case CYBS_S_RECEIVE_ERROR:
		case CYBS_S_POST_RECEIVE_ERROR:
		case CYBS_S_CRITICAL_SERVER_FAULT:
			$output = 'There was a problem completing your order.  We apologize for the inconvenience.  Please contact customer support to review your order.';
			break;	
	}
	
return $output;
}

?>