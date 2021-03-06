<?php
/**
 *
 * @ WHMCS FULL DECODED & NULLED
 *
 * @ Version  : 5.2.10
 * @ Author   : MTIMER
 * @ Release on : 2013-10-20
 * @ Website  : http://www.mtimer.net
 *
 * */

function totp_config() {
	global $licensing;

	$licensedata = $licensing->getKeyData( "configoptions" );
	$totpenabled = (array_key_exists( "TOTP", $licensedata ) ? $licensedata["TOTP"] : 0);
	$configarray = array( "FriendlyName" => array( "Type" => "System", "Value" => "Time-based HMAC One-Time Password (TOTP)" ), "Description" => array( "Type" => "System", "Value" => "TOTP requires that a user enter a 6 digit code that changes every 30 seconds to complete login. This works with mobile apps such as OATH Token and Google Authenticator.<br /><br />For more information about Time Based Tokens, please <a href=\"http://go.whmcs.com/114/totp\" target=\"_blank\">click here</a>." . ($totpenabled ? "" : "<br /><br /><strong>Just $1.50 per month (unlimited users)</strong>") ), "Licensed" => array( "Type" => "System", "Value" => ($totpenabled ? true : false) ), "SubscribeLink" => array( "Type" => "System", "Value" => "http://go.whmcs.com/114/totp" ) );
	return $configarray;
}


function totp_activate($params) {
	global $whmcs;

	if ($whmcs->get_req_var( "showqrimage" )) {
		if (!isset( $_SESSION["totpqrurl"] )) {
			exit();
		}

		include ROOTDIR . "/modules/security/totp/phpqrcode.php";
		QRcode::png( $_SESSION["totpqrurl"], false, 6, 6 );
		exit();
	}

	$username = $params["user_info"]["username"];
	$tokendata = (isset( $params["user_settings"]["tokendata"] ) ? $params["user_settings"]["tokendata"] : "");
	totp_loadgaclass();
	$gaotp = new MyOauth();
	$username = $whmcs->sanitize( "a-z", $whmcs->get_config( "CompanyName" ) ) . ":" . $username;

	if ($whmcs->get_req_var( "step" ) == "verify") {
		$verifyfail = false;

		if ($whmcs->get_req_var( "verifykey" )) {
			$ans = $gaotp->authenticateUser( $username, $whmcs->get_req_var( "verifykey" ) );

			if ($ans) {
				$output = array();
				$output["completed"] = true;
				$output["msg"] = "Key Verified Successfully!";
				$output["settings"] = array( "tokendata" => $tokendata );
				return $output;
			}

			$verifyfail = true;
		}

		$output = "<h2>Verification Step</h2><p>Enter the security code generated by your mobile authenticator app and we'll make sure it's configured correctly before enabling it.</p>";

		if ($verifyfail) {
			$output .= "<div class=\"errorbox\"><strong>It seem's there's a problem...</strong><br />The code you entered did not match what was expected. Please try again.</div>";
		}

		$output .= "<form onsubmit=\"dialogSubmit();return false\">
<input type=\"hidden\" name=\"2fasetup\" value=\"1\" />
<input type=\"hidden\" name=\"module\" value=\"totp\" />
<input type=\"hidden\" name=\"step\" value=\"verify\" />
<p align=\"center\"><input type=\"text\" name=\"verifykey\" size=\"10\" maxlength=\"6\" style=\"font-size:18px;\" /></p>
<p align=\"center\"><input type=\"button\" value=\"Confirm &raquo;\" class=\"btn btn-primary large\" onclick=\"dialogSubmit()\" /></p>
</form>";
	}
	else {
		$key = $gaotp->setUser( $username, "TOTP" );
		$url = $gaotp->createUrl( $username );
		$_SESSION["totpqrurl"] = $url;
		$output = "<h2>Time-based One-Time Password</h2>
<p>This authentication option get's it's second factor using a time based algorithm.  Your mobile phone can be used to generate the codes.  If you don't already have an app that can do this, we recommend Google Authenticator which is available for iOS, Android and Windows mobile devices.</p>
<p>To configure your authenticator app:</p>
<ul>
<li>Begin by selecting to add a new time based token</li>
<li>Then use your app to scan the barcode below, or alternatively enter this secret key manually: \"" . $gaotp->getKey( $username ) . "\"</li>
</ul>

<div align=\"center\">" . (function_exists( "imagecreate" ) ? "<img src=\"" . $_SERVER["PHP_SELF"] . "?2fasetup=1&module=totp&showqrimage=1\" />" : "<em>GD is missing from the PHP build on your server so unable to generate image</em>") . "</div>

<form onsubmit=\"dialogSubmit();return false\">
<input type=\"hidden\" name=\"2fasetup\" value=\"1\" />
<input type=\"hidden\" name=\"module\" value=\"totp\" />
<input type=\"hidden\" name=\"step\" value=\"verify\" />
<p align=\"center\"><input type=\"button\" value=\"Continue &raquo;\" onclick=\"dialogSubmit()\" class=\"btn btn-primary\" /></p>
</form>

";
	}

	return $output;
}


function totp_challenge($params) {
	$output = "<form method=\"post\" action=\"dologin.php\">
    <div align=\"center\">
        <input type=\"text\" name=\"key\" size=\"10\" style=\"font-size:20px;\" maxlength=\"6\" /> <input type=\"submit\" value=\"Login &raquo;\" class=\"btn\" />
    </div>
</form>";
	return $output;
}


function totp_get_used_otps() {
	global $whmcs;

	$usedotps = $whmcs->get_config( "TOTPUsedOTPs" );
	$usedotps = ($usedotps ? unserialize( $usedotps ) : array());

	if (!is_array( $usedotps )) {
		$usedotps = array();
	}

	return $usedotps;
}


function totp_verify($params) {
	global $whmcs;

	$username = $params["admin_info"]["username"];
	$tokendata = $params["admin_settings"]["tokendata"];
	$key = $params["post_vars"]["key"];
	totp_loadgaclass();
	$gaotp = new MyOauth();
	$gaotp->setTokenData( $tokendata );
	$username = "WHMCS:" . $username;
	$usedotps = totp_get_used_otps();
	
	$hash = md5( $username . $key );

	if (array_key_exists( $hash, $usedotps )) {
		return false;
	}

	$ans = false;
	$ans = $gaotp->authenticateUser( $username, $key );

	if ($ans) {
		$usedotps[$hash] = time();
		$expiretime = time() - 5 * 60;
		foreach ($usedotps as $k => $time) {

			if ($time < $expiretime) {
				unset( $usedotps[$k] );
				continue;
			}

			break;
		}

		$whmcs->set_config( "TOTPUsedOTPs", serialize( $usedotps ) );
	}

	return $ans;
}


function totp_loadgaclass() {
	if (!class_exists( "GoogleAuthenticator" )) {
		include ROOTDIR . "/modules/security/totp/ga4php.php";
		class MyOauth extends GoogleAuthenticator {
			protected $tokendata = "";

			function setTokenData($token) {
				$this->tokendata = $token;
			}


			function getData($username) {
				global $twofa;

				$tokendata = ($this->tokendata ? $this->tokendata : $twofa->getUserSetting( "tokendata" ));
				return $tokendata;
			}


			function putData($username, $data) {
				global $twofa;

				$twofa->saveUserSettings( array( "tokendata" => $data ) );
				return true;
			}


			function getUsers() {
				return false;
			}


		}


	}

}


?>