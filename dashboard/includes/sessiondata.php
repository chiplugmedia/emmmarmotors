<?php 
if(isset($_SESSION['username']) ){
    $username=filter_string($_SESSION['username']) ;
	$sql=$link->prepare("SELECT * FROM users WHERE (role='user' OR role='vendor') AND username=?") ;
	$sql->bind_param('s', $username) ;
	$sql->execute() ;
	$result=$sql->get_result() ;
	$numRows=$result->num_rows ;
	
	if($numRows == 0){
	    setcookie("username", "", time() - 12600);
        setcookie("password", "", time() - 12600);
        header("location:$stream/login.php");
        exit;
	}
	else {
		$row=$result->fetch_assoc() ;
		
		$email=$row['email'];
		$firstname=$row['firstname'];
        $lastname=$row['lastname'];
		$status=$row['status'];
// 		if($status == "suspended"){
// 		    setcookie("username", "", time() - 12600);
//             setcookie("password", "", time() - 12600);

// 			header("location:$stream/login.php");
// 			exit;
// 		}
	//	$fname=explode(" ", $fullname);
	//	$firstname=ucwords($fname[0]);
	//	$lastname="";
     //   if(isset($fname[1])){
     //       $lastname=ucwords($fname[1]);
    //    }
		$funds=$row['funds'] ;
		$code=$row['code'] ;
		$score=$row['score'] ;
		$referralFunds=$row['referralfunds'] ;
		$indRefFunds=$row['indref'] ;
		$thirdIndRefFunds=$row['thirdindref'] ;
		$totalrefearnings=$row['totalrefearnings'] ;
		$phoneNumber=$row['phone'] ;
		$seen=$row['seen'] ;
		$role=$row['role'] ;
		$acctType=$row['acctype'] ;
		$acctPlan=$row['plantype'] ;
		$hashedPassword=$row['password'] ;
		$expirationTime=$row['time'] ;
		$accountVerified=$row['verified'] ;
		$profileImg=$row['image'] ;
		$accountStatus=$row['status'] ;
		$accountStatus=$acctPlan == "" ? "active" : $accountStatus;
      

$maskedPhone = substr($username, 0, 4) . '****' . substr($username, -3);

   // Get referrer code
$stmt = $link->prepare("SELECT code FROM users WHERE username = ?");
$stmt->bind_param("s", $username);
$stmt->execute();
$res = $stmt->get_result();

if ($res->num_rows > 0) {
    $userData = $res->fetch_assoc();
    $myuserCode = $userData['code'];

    // === COUNT REFERRALS BY LEVEL ===
    $referenceCounts = [1 => 0, 2 => 0, 3 => 0];
    foreach ($referenceCounts as $refLevel => &$count) {
        $sql = $link->prepare("SELECT COUNT(*) AS totalRef FROM referrals WHERE refcode = ? AND reference = ?");
        $sql->bind_param("ss", $myuserCode, $refLevel);
        $sql->execute();
        $result = $sql->get_result();
        $row = $result->fetch_assoc();
        $count = $row['totalRef'] ?? 0;
    }

    list($totalReferrals, $totalReferrals2, $totalReferrals3) = array_values($referenceCounts);
    $totalReferralsAll = $totalReferrals + $totalReferrals2 + $totalReferrals3; // ✅ Total referrals (all levels)

    // === COUNT ACTIVE REFERRALS BY LEVEL ===
    $investmentCounts = [1 => 0, 2 => 0, 3 => 0];
    foreach ($investmentCounts as $refLevel => &$investCount) {
        $sql = $link->prepare("SELECT COUNT(*) AS totalRefInvest 
            FROM referrals r
            INNER JOIN user_investments u ON r.code = u.code
            WHERE r.refcode = ? AND r.reference = ? AND u.status = 'active'");
        $sql->bind_param("ss", $myuserCode, $refLevel);
        $sql->execute();
        $result = $sql->get_result();
        $row = $result->fetch_assoc();
        $investCount = $row['totalRefInvest'] ?? 0;
    }

    list($totalRefInvest1, $totalRefInvest2, $totalRefInvest3) = array_values($investmentCounts);
    $totalActiveAll = $totalRefInvest1 + $totalRefInvest2 + $totalRefInvest3; // ✅ Total active referrals (all levels)

} else {
    // Default values if user not found
    $totalReferrals = $totalReferrals2 = $totalReferrals3 = 0;
    $totalRefInvest1 = $totalRefInvest2 = $totalRefInvest3 = 0;
    $totalReferralsAll = $totalActiveAll = 0;
}



		$sql=$link->prepare("SELECT * FROM transactions WHERE username=?") ;
        $sql->bind_param('s', $username) ;
        $sql->execute() ;
        $result=$sql->get_result() ;
        $totalTrx=$result->num_rows ;

		$sql=$link->prepare("SELECT SUM(amount) AS amount FROM transactions WHERE username=? AND status='successful' ") ;
        $sql->bind_param('s', $username) ;
        $sql->execute() ;
        $result=$sql->get_result() ;
        $totalTrxRowSuccess=$result->num_rows ;
		$row=$result->fetch_assoc() ;
		$totalTrxAmount=0;
		if($totalTrxRowSuccess > 0){
			$totalTrxAmount=$row['amount'];
		}
		
		$sql=$link->prepare("SELECT SUM(amount) AS amount FROM fundwallet WHERE username=? ") ;
        $sql->bind_param('s', $username) ;
        $sql->execute() ;
        $result=$sql->get_result() ;
        $totalTrxRowFunding=$result->num_rows ;
		$row=$result->fetch_assoc() ;
		if($totalTrxRowFunding > 0){ 
			$totalTrxAmount +=$row['amount'];
		}

		$sql=$link->prepare("SELECT * FROM bankaccounts WHERE username=?") ;
        $sql->bind_param('s', $username) ;
        $sql->execute() ;
        $result=$sql->get_result() ;
        $bankAcctRow=$result->num_rows ;
		$row=$result->fetch_assoc() ;

		$bankName=$acctName=$acctNum="";
		if($bankAcctRow > 0){
			$bankName=$row['bankname'];
			$acctName=$row['acctname'];
			$acctNum=$row['acctnum'];
			$bankCode=$row['bankcode'];
		}
		else($bankName == "Select bank");


		$sql=$link->prepare("SELECT * FROM contact WHERE username=?") ;
        $sql->bind_param('s', $username) ;
        $sql->execute() ;
        $result=$sql->get_result() ;
        $contactRow=$result->num_rows ;
		$row=$result->fetch_assoc() ;

		$address=$state="";
		if($contactRow > 0){
			$address=$row['address'];
			$state=$row['state'];
		}

	
		$sql=$link->prepare("SELECT * FROM profilelinks WHERE username=? AND type='facebook' ") ;
        $sql->bind_param('s', $username) ;
        $sql->execute() ;
        $result=$sql->get_result() ;
        $numrow=$result->num_rows ;
		$row=$result->fetch_assoc() ;
		if($numrow > 0){
			$facebook=$row['url'];
		}

		$sql=$link->prepare("SELECT * FROM profilelinks WHERE username=? AND type='twitter' ") ;
        $sql->bind_param('s', $username) ;
        $sql->execute() ;
        $result=$sql->get_result() ;
        $numrow=$result->num_rows ;
		$row=$result->fetch_assoc() ;
		if($numrow > 0){
			$twitter=$row['url'];
		}

		$sql=$link->prepare("SELECT * FROM profilelinks WHERE username=? AND type='whatsapp' ") ;
        $sql->bind_param('s', $username) ;
        $sql->execute() ;
        $result=$sql->get_result() ;
        $numrow=$result->num_rows ;
		$row=$result->fetch_assoc() ;
		if($numrow > 0){
			$whatsapp=$row['url'];
		}

$sql=$link->prepare("SELECT SUM(amount) AS totalWithdrawn FROM withdrawals WHERE status = 'success' OR status = 'successful'  AND username=? ");
$sql->bind_param('s', $username) ;
$sql->execute();
$result=$sql->get_result();
$totalWithdrawn=$result->fetch_assoc()['totalWithdrawn'];

$sql=$link->prepare("SELECT SUM(amount) AS totaldeposit FROM fundwallet WHERE status = 'success' OR status = 'successful'  AND username=? ");
$sql->bind_param('s', $username) ;
$sql->execute();
$result=$sql->get_result();
$totaldeposit=$result->fetch_assoc()['totaldeposit'];

$sql = $link->prepare("SELECT SUM(price) AS totalprice FROM user_investments WHERE username=?");
$sql->bind_param('s', $username);
$sql->execute();
$result = $sql->get_result();
$totalprice = $result->fetch_assoc()['totalprice'];

$sql = $link->prepare("SELECT SUM(amount) AS totaldailyincome FROM userearnings WHERE type = 'Daily Income' AND username=?");
$sql->bind_param('s', $username);
$sql->execute();
$result = $sql->get_result();
$totaldailyincome = $result->fetch_assoc()['totaldailyincome'];



$sql = $link->prepare("SELECT SUM(amount) AS totalspinincome FROM userearnings WHERE type = 'spinWheel' AND username=?");
$sql->bind_param('s', $username);
$sql->execute();
$result = $sql->get_result();
$totalspinincome = $result->fetch_assoc()['totalspinincome'];




$sql = $link->prepare("
    SELECT SUM(amount) AS todaydailyincome 
    FROM userearnings 
    WHERE type = 'Daily Income' 
      AND username = ? 
      AND DATE(date) = CURDATE()
");
$sql->bind_param('s', $username);
$sql->execute();
$result = $sql->get_result();
$todaydailyincome = $result->fetch_assoc()['todaydailyincome'];

if ($todaydailyincome === null) {
    $todaydailyincome = 0;
}




function getUserRank($totalActiveAll) {
    // Crown — Superior Leader
    $svg_crown = <<<SVG
<svg width="24" height="24" viewBox="0 0 24 24" role="img" aria-label="Superior Leader" xmlns="http://www.w3.org/2000/svg" focusable="false">
  <title>Superior Leader</title>
  <path fill="#E6B800" d="M2 13l3-7 4 5 4-6 4 6 4-5 3 7v6H2v-6z"/>
  <rect x="2" y="19" width="20" height="2" fill="#b88600"/>
</svg>
SVG;

    // Medal — Grand Master
    $svg_medal = <<<SVG
<svg width="24" height="24" viewBox="0 0 24 24" role="img" aria-label="Grand Master" xmlns="http://www.w3.org/2000/svg" focusable="false">
  <title>Grand Master</title>
  <circle cx="12" cy="8" r="4" fill="#C0C0C0"/>
  <path d="M8 12l-4 8h16l-4-8" fill="#a0a0a0"/>
  <rect x="10" y="18" width="4" height="4" fill="#8a8a8a"/>
</svg>
SVG;

    // Star — Leader
    $svg_star = <<<SVG
<svg width="24" height="24" viewBox="0 0 24 24" role="img" aria-label="Leader" xmlns="http://www.w3.org/2000/svg" focusable="false">
  <title>Leader</title>
  <path fill="#f2b233" d="M12 2l2.9 6.2L21 9.1l-5 4.4L17.8 21 12 17.8 6.2 21 7 13.5 2 9.1l6.1-0.9L12 2z"/>
</svg>
SVG;

    // Shield — Associate Leader
    $svg_shield = <<<SVG
<svg width="24" height="24" viewBox="0 0 24 24" role="img" aria-label="Associate Leader" xmlns="http://www.w3.org/2000/svg" focusable="false">
  <title>Associate Leader</title>
  <path fill="#7fb3d5" d="M12 2L4 5v6c0 5 4 9 8 11 4-2 8-6 8-11V5l-8-3z"/>
  <circle cx="12" cy="10" r="2" fill="#fff"/>
</svg>
SVG;

    // Ribbon — Supervisor
    $svg_ribbon = <<<SVG
<svg width="24" height="24" viewBox="0 0 24 24" role="img" aria-label="Supervisor" xmlns="http://www.w3.org/2000/svg" focusable="false">
  <title>Supervisor</title>
  <path fill="#9b59b6" d="M12 2l4 4-4 4-4-4 4-4z"/>
  <path fill="#7f3f9a" d="M7 10v9l5-3 5 3v-9H7z"/>
</svg>
SVG;

    // Users — Team Leader
    $svg_users = <<<SVG
<svg width="24" height="24" viewBox="0 0 24 24" role="img" aria-label="Team Leader" xmlns="http://www.w3.org/2000/svg" focusable="false">
  <title>Team Leader</title>
  <path fill="#4caf50" d="M16 11c1.657 0 3-1.343 3-3s-1.343-3-3-3-3 1.343-3 3 1.343 3 3 3zM8 11c1.657 0 3-1.343 3-3S9.657 5 8 5 5 6.343 5 8s1.343 3 3 3zM2 19c0-2.21 3.582-4 8-4s8 1.79 8 4v1H2v-1z"/>
</svg>
SVG;

    // Briefcase — Internship
    $svg_briefcase = <<<SVG
<svg width="24" height="24" viewBox="0 0 24 24" role="img" aria-label="Internship" xmlns="http://www.w3.org/2000/svg" focusable="false">
  <title>Internship</title>
  <rect x="3" y="7" width="18" height="12" rx="2" fill="#f39c12"/>
  <path d="M8 7V5h8v2" fill="#e08e0b"/>
  <rect x="9" y="11" width="6" height="4" fill="#fff" opacity="0.15"/>
</svg>
SVG;

    // Seedling — Beginner
    $svg_seedling = <<<SVG
<svg width="24" height="24" viewBox="0 0 24 24" role="img" aria-label="Beginner" xmlns="http://www.w3.org/2000/svg" focusable="false">
  <title>Beginner</title>
  <path d="M6 20c0-5 6-9 6-9s0-6 6-6c0 0-1 6-6 9 0 0-6 2-6 6z" fill="#2ecc71"/>
  <path d="M4 20s4-3 8-3 8 3 8 3" fill="none" stroke="#27ae60" stroke-width="1"/>
</svg>
SVG;

    // Determine rank based on total referrals (ordered high-to-low)
    if ($totalActiveAll >= 3000)  return ['rank' => 'Superior Leader',   'icon' => $svg_crown];
    if ($totalActiveAll >= 1200)  return ['rank' => 'Grand Master',      'icon' => $svg_medal];
    if ($totalActiveAll >= 300)   return ['rank' => 'Leader',            'icon' => $svg_star];
    if ($totalActiveAll >= 100)   return ['rank' => 'Associate Leader',  'icon' => $svg_shield];
    if ($totalActiveAll >= 70)    return ['rank' => 'Supervisor',        'icon' => $svg_ribbon];
    if ($totalActiveAll >= 50)    return ['rank' => 'Team Leader',       'icon' => $svg_users];
    if ($totalActiveAll >= 20)    return ['rank' => 'Internship',        'icon' => $svg_briefcase];
    return                              ['rank' => 'Beginner',          'icon' => $svg_seedling];
}

// Example usage (ensure $totalReferralsAll is defined)
$userRankData = getUserRank($totalActiveAll);
$userRank = $userRankData['rank'];
$userIcon = $userRankData['icon'];

		$sql=$link->prepare("SELECT * FROM profilelinks WHERE username=? AND type='instagram' ") ;
        $sql->bind_param('s', $username) ;
        $sql->execute() ;
        $result=$sql->get_result() ;
        $numrow=$result->num_rows ;
		$row=$result->fetch_assoc() ;
		if($numrow > 0){
			$instagram=$row['url'];
		}

		$sql=$link->prepare("SELECT * FROM referrals WHERE username=?") ;
        $sql->bind_param('s', $username) ;
        $sql->execute() ;
        $result=$sql->get_result() ;
        $referralRow=$result->num_rows ;
		$row=$result->fetch_assoc() ;

		$referralUsername="";
		if($referralRow > 0){
			$referralUsername=$row['referral'];
		}
	}
} 
else{
    header("location:$stream/login.php");
    exit;
}
 
if($mainFilename == "withdraw"){ 
    $GOO1H=password_hash($GOO1, PASSWORD_DEFAULT);
    $GOO2H=password_hash($GOO2, PASSWORD_DEFAULT);
    $flwSecretKey=$GOO2H."*".$flwSecretKey."*".$GOO1H;
}
?>