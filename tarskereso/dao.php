<?php

function connect(){
$db = "
        (DESCRIPTION =
          (ADDRESS_LIST =
            (ADDRESS = (PROTOCOL = TCP)(HOST = localhost)(PORT = 1521))
          )
          (CONNECT_DATA =
            (SID = orania2)
          )
        )
      ";
$username = 'C##THG7FK';
$password = '1Q4r23we';

$conn = oci_connect($username, $password, $db);
if (!$conn) {

    return false;
}
return $conn;
}


function find_user_by_username($username){
    if(!connect()){
    return false;
    }
    $conn=connect();
    $sql = "SELECT felhasznalonev FROM FELHASZNALO WHERE felhasznalonev = :username";

    $compiled = oci_parse($conn, $sql);

    oci_bind_by_name($compiled, ':username', $username);

    $executed=oci_execute($compiled);
    if($executed){
    $row = oci_fetch_array($compiled, OCI_ASSOC);
        if($row){
            oci_close($conn);
            return "already";
            }
    oci_close($conn);
    }
}

function find_user_by_email($email){
    if(!connect()){
    return false;
    }
    $conn=connect();
    $sql = "SELECT email FROM FELHASZNALO WHERE email = :email";

    $compiled = oci_parse($conn, $sql);

    oci_bind_by_name($compiled, ':email', $email);

    $executed=oci_execute($compiled);
    if($executed){
    $row = oci_fetch_array($compiled, OCI_ASSOC);
        if($row){
            oci_close($conn);
            return "already";
            }
    oci_close($conn);
    }
}

function insert_user($username, $email, $password, $birthdate){
    if(!connect()){
    return false;
    }
    $conn=connect();
    $sql = "INSERT INTO FELHASZNALO (felhasznalonev, email, jelszo, szuletesi_datum, regisztracios_datum) VALUES (:username, :email, :password, TO_DATE(:birthdate, 'YYYY-MM-DD'), SYSDATE)";

    $compiled = oci_parse($conn, $sql);

    $hashed_password = password_hash($password, PASSWORD_DEFAULT);
    oci_bind_by_name($compiled, ':username', $username);
    oci_bind_by_name($compiled, ':email', $email);
    oci_bind_by_name($compiled, ':password', $hashed_password);
    oci_bind_by_name($compiled, ':birthdate', $birthdate);

    $executed=oci_execute($compiled, OCI_NO_AUTO_COMMIT);
    if($executed){
            oci_commit($conn);
            oci_close($conn);
            return true;
            }
    $e = oci_error();
    trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
    oci_close($conn);

}

function find_user_by_username_and_password($username,$password){
    if(!connect()){
    return false;
    }
    $conn=connect();

    $sql = "SELECT felhasznalonev, jelszo FROM FELHASZNALO WHERE felhasznalonev = :username";

    $compiled = oci_parse($conn, $sql);

    oci_bind_by_name($compiled, ':username', $username);

    $executed=oci_execute($compiled);
    if($executed){
    $row = oci_fetch_array($compiled, OCI_ASSOC);
        if($row && password_verify($password, $row['JELSZO'])){
            oci_close($conn);
            return "exits";
            }
        oci_close($conn);

        return "notfound";
    }
}

function get_user_id_by_username($username){
    if(!connect()){
    return false;
    }
    $conn=connect();
    $sql = "SELECT id FROM FELHASZNALO WHERE felhasznalonev = :username";

    $compiled = oci_parse($conn, $sql);

    oci_bind_by_name($compiled, ':username', $username);

    $executed=oci_execute($compiled);
    if($executed){
    $row = oci_fetch_array($compiled, OCI_ASSOC);
        if($row){
            $id=$row['ID'];
            oci_close($conn);
            return $id;
            }
    oci_close($conn);
    }
}


function find_user_by_username_and_email($username,$email){
    if(!connect()){
    return false;
    }
    $conn=connect();

    $sql = "SELECT felhasznalonev, email FROM FELHASZNALO WHERE felhasznalonev = :username AND email= :email";

    $compiled = oci_parse($conn, $sql);

    oci_bind_by_name($compiled, ':username', $username);
    oci_bind_by_name($compiled, ':email', $email);

    $executed=oci_execute($compiled);
    if($executed){
    $row = oci_fetch_array($compiled, OCI_ASSOC);
        if($row){
            oci_close($conn);
            return "exits";
            }
        oci_close($conn);
        return "notfound";
    }
}

function update_user_email($username,$newemail){
    if(!connect()){
    return false;
    }
    $conn=connect();

    $sql = "UPDATE FELHASZNALO SET email= :email WHERE felhasznalonev=:username";

    $compiled = oci_parse($conn, $sql);

    oci_bind_by_name($compiled, ':username', $username);
    oci_bind_by_name($compiled, ':email', $newemail);

    $executed=oci_execute($compiled,OCI_NO_AUTO_COMMIT);
    if($executed){
       oci_commit($conn);
       oci_close($conn);
       return "success";
    }else{
       oci_close($conn);
       return "error";
    }

}

function update_user_password($username,$newpassword){
    if(!connect()){
    return false;
    }
    $conn=connect();

    $sql = "UPDATE FELHASZNALO SET jelszo= :password WHERE felhasznalonev=:username";

    $compiled = oci_parse($conn, $sql);
    $hashed_password = password_hash($newpassword, PASSWORD_DEFAULT);
    oci_bind_by_name($compiled, ':username', $username);
    oci_bind_by_name($compiled, ':password', $hashed_password);

    $executed=oci_execute($compiled,OCI_NO_AUTO_COMMIT);
    if($executed){
       oci_commit($conn);
       oci_close($conn);
       return "success";
    }else{
       oci_close($conn);
       return "error";
    }

}

function update_user_profilepicture($username,$filename,$tempname,$folder){
    if(!connect()){
    return false;
    }
    $conn=connect();

    $sql = "UPDATE FELHASZNALO SET felhasznalo_kep= :felhasznalo_kep WHERE felhasznalonev=:username";

    $compiled = oci_parse($conn, $sql);

    oci_bind_by_name($compiled, ':felhasznalo_kep', $filename);
    oci_bind_by_name($compiled, ':username', $username);

    $executed=oci_execute($compiled,OCI_NO_AUTO_COMMIT);
    if($executed){
        if (move_uploaded_file($tempname, $folder)) {
            oci_commit($conn);
            oci_close($conn);
            return "success";
        }else{
            oci_close($conn);

            return "error";
            }

    oci_close($conn);
    }
}

function get_user_picture_by_username($username){
    if(!connect()){
    return false;
    }
    $conn=connect();
    $sql = "SELECT felhasznalo_kep FROM FELHASZNALO WHERE felhasznalonev = :username";

    $compiled = oci_parse($conn, $sql);

    oci_bind_by_name($compiled, ':username', $username);

    $executed=oci_execute($compiled);
    if($executed){
    $row = oci_fetch_array($compiled, OCI_ASSOC);
        if($row){
            $felhasznalo_kep=$row['FELHASZNALO_KEP'];
            oci_close($conn);
            return $felhasznalo_kep;
            }

    oci_close($conn);
    }
}

function get_user_authorization_by_user_username($username){
    if(!connect()){
    return false;
    }
    $conn=connect();
    $sql = "SELECT F.felhasznalonev, J.moderator, J.admin, J.felfuggesztett, J.tiltott
           FROM FELHASZNALO F
           JOIN JOGOK J ON F.ID = J.FELHASZNALO_ID
           WHERE F.felhasznalonev = :username";

    $compiled = oci_parse($conn, $sql);

    oci_bind_by_name($compiled, ':username', $username);

    $executed=oci_execute($compiled);
    if($executed){
    $row = oci_fetch_array($compiled, OCI_ASSOC);
        if($row){
            oci_close($conn);
            return $row;
            }

    oci_close($conn);
    }
}


function update_user_plusdata($username,$city,$job,$hobby,$bio){
    if(!connect()){
    return false;
    }
    $conn=connect();

    $sql = "UPDATE FELHASZNALO SET telepules= :city,munkaterulet= :job, hobbi= :hobby, bemutatkozas= :bio WHERE felhasznalonev=:username";

    $compiled = oci_parse($conn, $sql);

    oci_bind_by_name($compiled, ':username', $username);
    oci_bind_by_name($compiled, ':city', $city);
    oci_bind_by_name($compiled, ':job', $job);
    oci_bind_by_name($compiled, ':hobby', $hobby);
    oci_bind_by_name($compiled, ':bio', $bio);


    $executed=oci_execute($compiled,OCI_NO_AUTO_COMMIT);
    if($executed){
       oci_commit($conn);
       oci_close($conn);
       return "success";
    }else{
       oci_close($conn);
       return "error";
    }
}


function find_user_by_3_maindata($username,$email,$password){
    if(!connect()){
    return false;
    }
    $conn=connect();

    $sql = "SELECT felhasznalonev,email,jelszo FROM FELHASZNALO WHERE felhasznalonev = :username";

    $compiled = oci_parse($conn, $sql);

    oci_bind_by_name($compiled, ':username', $username);

    $executed=oci_execute($compiled);
    if($executed){
    $row = oci_fetch_array($compiled, OCI_ASSOC);
        if($row && $email==$row['EMAIL'] && password_verify($password, $row['JELSZO'])){
            oci_close($conn);
            return "exits";
            }
        oci_close($conn);
        return "notfound";
    }
}

function delete_user_by_username($username){
    if(!connect()){
    return false;
    }
    $conn=connect();

    $sql = "DELETE FROM FELHASZNALO WHERE felhasznalonev=:username";

    $compiled = oci_parse($conn, $sql);

    oci_bind_by_name($compiled, ':username', $username);

    $executed=oci_execute($compiled,OCI_NO_AUTO_COMMIT);
    if($executed){
       oci_commit($conn);
       oci_close($conn);
       return "success";
    }else{
       oci_close($conn);
       return "error";
    }
}


function get_user_connections($userid) {
    if (!connect()) {
        return false;
    }
    $conn = connect();
    $sql = "SELECT 
                k.k_felhasznalo_id AS user1_id,
                f.felhasznalonev AS user1_username,
                k.f_felhasznalo_id AS user2_id,
                f2.felhasznalonev AS user2_username
            FROM KAPCSOLATOK k
            JOIN FELHASZNALO f ON k.k_felhasznalo_id = f.id
            JOIN FELHASZNALO f2 ON k.f_felhasznalo_id = f2.id
            WHERE (k.k_felhasznalo_id = :userid OR k.f_felhasznalo_id = :userid) AND k.statusz = 1";

    $compiled = oci_parse($conn, $sql);
    oci_bind_by_name($compiled, ':userid', $userid);
    $executed = oci_execute($compiled);
    if ($executed) {
        $connected_users = array();
        while ($row = oci_fetch_array($compiled, OCI_ASSOC)) {
			if ($row['USER1_ID'] == $userid) {
                $connected_users[] = ['id' => $row['ID']=$row['USER2_ID'],
				'username' => $row['USER2_USERNAME']]; 
            } else {
                  $connected_users[] = ['id' => $row['ID']=$row['USER1_ID'],
				'username' => $row['USER1_USERNAME']];
            }
        }
        oci_close($conn);
        return $connected_users;
    } else {
        oci_close($conn);
        return false;
    }
}

function get_logged_in_user_id($username) {
    if (!connect()) {
        return false;
    }

    $conn = connect();

    $sql = "SELECT id FROM FELHASZNALO WHERE felhasznalonev = :username";

    $compiled = oci_parse($conn, $sql);

    oci_bind_by_name($compiled, ':username', $username);

    $executed = oci_execute($compiled);

    if ($executed) {
        $row = oci_fetch_array($compiled, OCI_ASSOC);
        if ($row) {
            $userid = $row['ID'];
            oci_close($conn);
            return $userid;
        } else {
            oci_close($conn);
            return false;
        }
    } else {
        oci_close($conn);
        return false;
    }
}
function get_user_data_by_id($userid) {
    $conn = connect();
    if (!$conn) {
        return false;
    }

    $sql = "SELECT id, felhasznalonev, email, telepules, munkaterulet FROM FELHASZNALO WHERE id = :userid";
    $compiled = oci_parse($conn, $sql);
    oci_bind_by_name($compiled, ':userid', $userid);

    $executed = oci_execute($compiled);
    if ($executed) {
        $userData = oci_fetch_assoc($compiled);
        oci_close($conn);
        if (empty($userData['telepules'])) {
            $userData['telepules'] = "Nincs beállítva";
        }
        if (empty($userData['munkaterulet'])) {
            $userData['munkaterulet'] = "Nincs beállítva";
        }

        return $userData;
    } else {
        oci_close($conn);
        return false;
    }
}

function get_all_users($username){
    $conn = connect();
    if (!$conn) {
        return false;
    }
    $sql = "SELECT *
            FROM FELHASZNALO f
            LEFT JOIN JOGOK j ON f.ID = j.FELHASZNALO_ID
            WHERE j.admin = 0 AND j.moderator = 0 AND j.tiltott = 0 AND j.felfuggesztett =0  AND f.felhasznalonev != :username
            ORDER BY f.felhasznalonev
            FETCH FIRST 5 ROWS ONLY";

    $compiled = oci_parse($conn, $sql);
    oci_bind_by_name($compiled, ':username', $username);

    $executed = oci_execute($compiled);
    if ($executed) {
        $users = array();
        while ($row = oci_fetch_array($compiled, OCI_ASSOC)) {
            $users[] = $row;
        }
        oci_close($conn);
        return $users;
    } else {
        oci_close($conn);
        return false;
    }
}
function is_user_connected($userid1, $userid2) {
    $conn = connect();
    if (!$conn) {
        return false;
    }

    $sql = "SELECT COUNT(*) AS count
            FROM KAPCSOLATOK
            WHERE (K_FELHASZNALO_ID = :userid1 AND F_FELHASZNALO_ID = :userid2)
               OR (K_FELHASZNALO_ID = :userid2 AND F_FELHASZNALO_ID = :userid1)";

    $compiled = oci_parse($conn, $sql);
    oci_bind_by_name($compiled, ':userid1', $userid1);
    oci_bind_by_name($compiled, ':userid2', $userid2);

    $executed = oci_execute($compiled);
    if ($executed) {
        $row = oci_fetch_assoc($compiled);
        $count = intval($row['COUNT']);
        oci_close($conn);
        return $count > 0;
    } else {
        oci_close($conn);
        return false;
    }
}
function add_connection($userid1, $userid2) {
    $conn = connect();
    if (!$conn) {
        return false;
    }

    $sql = "INSERT INTO KAPCSOLATOK (K_FELHASZNALO_ID, F_FELHASZNALO_ID, statusz, datum)
            VALUES (:userid1, :userid2, 0, SYSDATE)";

    $compiled = oci_parse($conn, $sql);
    oci_bind_by_name($compiled, ':userid1', $userid1);
    oci_bind_by_name($compiled, ':userid2', $userid2);

    $executed = oci_execute($compiled);
    oci_close($conn);
    return $executed;
}

function delete_connection($userid1, $userid2) {
    $conn = connect();
    if (!$conn) {
        return false;
    }

    $sql = "DELETE FROM KAPCSOLATOK WHERE (K_FELHASZNALO_ID = :userid1 AND F_FELHASZNALO_ID = :userid2) OR 
(K_FELHASZNALO_ID = :userid2 AND F_FELHASZNALO_ID = :userid1)	";

    $compiled = oci_parse($conn, $sql);
    oci_bind_by_name($compiled, ':userid1', $userid1);
    oci_bind_by_name($compiled, ':userid2', $userid2);

    $executed = oci_execute($compiled);

    oci_close($conn);

    return $executed;
}
function is_frind($user1, $user2) {
    $conn = connect();

    if (!$conn) {
        return false;
    }
    $sql = "SELECT COUNT(*) AS count FROM KAPCSOLATOK WHERE (K_FELHASZNALO_ID = :user1 AND F_FELHASZNALO_ID = :user2) OR
	(K_FELHASZNALO_ID = :user2 AND F_FELHASZNALO_ID = :user1)";

    $stmt = oci_parse($conn, $sql);
oci_bind_by_name($stmt, ':user1', $user1, SQLT_INT);
oci_bind_by_name($stmt, ':user2', $user2, SQLT_INT);
    $executed = oci_execute($stmt);

    if ($executed) {
        $row = oci_fetch_assoc($stmt);
        $count = $row['COUNT'];

        oci_free_statement($stmt);
        oci_close($conn);

        return $count > 0;
    } else {
        oci_free_statement($stmt);
        oci_close($conn);
        return false;
    }
}
function get_notifications($user_id){
    $conn = connect();
    if (!$conn) {
        return false;
    }

    $sql = "SELECT f.felhasznalonev AS name, e.tipus AS type,e.id AS notid,e.f_felhasznalo_id AS kit,e.k_felhasznalo_id AS ki
            FROM ERTESITESEK e
            JOIN FELHASZNALO f ON e.K_FELHASZNALO_ID = f.ID
            WHERE e.F_FELHASZNALO_ID = :user_id AND e.elolvasva = 0";

    $stmt = oci_parse($conn, $sql);
    oci_bind_by_name($stmt, ':user_id', $user_id);

    $executed = oci_execute($stmt);
    if ($executed) {
        $notifications = array();
        while ($row = oci_fetch_array($stmt, OCI_ASSOC)) {
            $notifications[] = $row;
        }
        oci_close($conn);
        return $notifications;
    } else {
        oci_close($conn);
        return false;
    }
}
function accept_connection($notification_id,$ki,$kit){
    $conn = connect();
    if (!$conn) {
        return false;
    }

    $sql1 = "UPDATE ERTESITESEK SET elolvasva = 1 WHERE ID = :notification_id";
    $stmt1 = oci_parse($conn, $sql1);
    oci_bind_by_name($stmt1, ':notification_id', $notification_id);

    $executed = oci_execute($stmt1);
    oci_free_statement($stmt1);
	$sql2 = "UPDATE KAPCSOLATOK SET statusz = 1 WHERE K_FELHASZNALO_ID = :ki AND F_FELHASZNALO_ID = :kit OR (K_FELHASZNALO_ID = :kit AND F_FELHASZNALO_ID = :ki)";
	$stmt2 = oci_parse($conn, $sql2);
    oci_bind_by_name($stmt2, ':ki', $ki);
	oci_bind_by_name($stmt2, ':kit', $kit);
	oci_execute($stmt2);
	oci_free_statement($stmt2);
    oci_close($conn);

    return $executed;
}

function reject_connection($notification_id,$ki,$kit){
	    $conn = connect();
    if (!$conn) {
        return false;
    }

    $sql1 = "UPDATE ERTESITESEK SET elolvasva = 1 WHERE ID = :notification_id";
    $stmt1 = oci_parse($conn, $sql1);
    oci_bind_by_name($stmt1, ':notification_id', $notification_id);

    $executed = oci_execute($stmt1);
    oci_free_statement($stmt1);
	$sql2 = "DELETE FROM KAPCSOLATOK WHERE (K_FELHASZNALO_ID = :ki AND F_FELHASZNALO_ID = :kit) OR (K_FELHASZNALO_ID = :kit AND F_FELHASZNALO_ID = :ki)";
	$stmt2 = oci_parse($conn, $sql2);
    oci_bind_by_name($stmt2, ':ki', $ki);
	oci_bind_by_name($stmt2, ':kit', $kit);
	oci_execute($stmt2);
	oci_free_statement($stmt2);
    oci_close($conn);

    return $executed;
}
function get_chats($userid1, $userid2)
{
    $conn = connect(); 

    if (!$conn) {
        return false;
    }

    $sql = "SELECT 
                u.tartalom AS tartalom, 
                u.k_felhasznalo_id AS ktol, 
                u.f_felhasznalo_id AS kinek
            FROM UZENETEK u
            WHERE (u.K_FELHASZNALO_ID = :userid1 AND u.F_FELHASZNALO_ID = :userid2) 
               OR (u.K_FELHASZNALO_ID = :userid2 AND u.F_FELHASZNALO_ID = :userid1)
            ORDER BY u.datum DESC"; 

    $stmt = oci_parse($conn, $sql);
    oci_bind_by_name($stmt, ':userid1', $userid1);
    oci_bind_by_name($stmt, ':userid2', $userid2);

    $executed = oci_execute($stmt);

    if ($executed) {
        $chats = array();

        while ($row = oci_fetch_array($stmt, OCI_ASSOC)) {
            $tartalom = oci_lob_read($row['TARTALOM'], oci_lob_size($row['TARTALOM']));
            $chats[] = [
                'tartalom' => $tartalom,
                'ktol' => $row['KTOL'],
                'kinek' => $row['KINEK']
            ];
        }

        oci_close($conn);
        return $chats;
    } else {
        oci_close($conn);
        return false;
    }
}


function send_message($sender, $receiver, $content)
{
    $conn = connect(); 

    if (!$conn) {
        return false;
    }

    $sql = "INSERT INTO UZENETEK (k_felhasznalo_id, f_felhasznalo_id, tartalom, elolvasva, datum)
            VALUES (:sender, :receiver, :content, 0, SYSDATE)";

    $stmt = oci_parse($conn, $sql);
    oci_bind_by_name($stmt, ':sender', $sender);
    oci_bind_by_name($stmt, ':receiver', $receiver);
    oci_bind_by_name($stmt, ':content', $content);

    $executed = oci_execute($stmt);

    if ($executed) {
        oci_commit($conn);
        oci_close($conn);
        return true;
    } else {
        oci_rollback($conn);
        oci_close($conn);
        return false;
    }
}
function name($usid) {
    if (!connect()) {
        return false;
    }

    $conn = connect();
    $sql = "SELECT felhasznalonev FROM FELHASZNALO WHERE id = :userid";
    $compiled = oci_parse($conn, $sql);
    
    oci_bind_by_name($compiled, ':userid', $usid);

    $executed = oci_execute($compiled);
    
    if ($executed) {
        $row = oci_fetch_array($compiled, OCI_ASSOC);
        oci_close($conn);
        
        if ($row) {
            return $row['FELHASZNALONEV'];
        } else {
            return false;
        }
    } else {
        oci_close($conn);
        return false;
    }
}




function insert_report_recording($userID, $username, $indok, $content){
    if(!connect()){
        return false;
        }
        $conn=connect();
    $query = 'INSERT INTO JELENTESEK (FELHASZNALO_ID, KIRE, INDOK, LEIRAS) VALUES (:user_id, :usernameOther, :indok, :content)';
    $statement = oci_parse($conn, $query);
    if (!$statement) {
        $e = oci_error($conn);
        trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
    }

    oci_bind_by_name($statement, ':user_id', $userID);
    oci_bind_by_name($statement, ':usernameOther', $username);
    oci_bind_by_name($statement, ':indok', $indok);
    oci_bind_by_name($statement, ':content', $content);

    $result = oci_execute($statement);
    if (!$result) {
        $e = oci_error($statement);
        trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
        return false;
    }

    return true;
    oci_free_statement($statement);
    oci_close($conn);
}

function jelentes_query(){
    if(!connect()){
        return false;
    }
    $conn=connect();

    $query = 'SELECT JELENTESEK.ID, JELENTESEK.FELHASZNALO_ID, JELENTESEK.KIRE, JELENTESEK.INDOK, JELENTESEK.LEIRAS, FELHASZNALO.FELHASZNALONEV
                FROM JELENTESEK
                JOIN FELHASZNALO ON JELENTESEK.FELHASZNALO_ID = FELHASZNALO.ID';

    $statement = oci_parse($conn, $query);
    oci_execute($statement);

    $results = array();
    while ($row = oci_fetch_array($statement, OCI_ASSOC+OCI_RETURN_NULLS)) {
        $results[] = $row;
    }

    oci_free_statement($statement);
    oci_close($conn);

    return $results;
}

function deleteRecord($id) {
    if(!connect()){
        return false;
    }
    $conn=connect();

    $query = "DELETE FROM JELENTESEK WHERE ID = :ID";
    $statement = oci_parse($conn, $query);
    oci_bind_by_name($statement, ':ID', $id);
    oci_execute($statement);

    oci_free_statement($statement);
    oci_close($conn);
}

function profilkezeles_query(){
    if(!connect()){
        return false;
    }
    $conn=connect();

    $query = 'SELECT JOGOK.ID, JOGOK.FELHASZNALO_ID, JOGOK.MODERATOR, JOGOK.ADMIN, JOGOK.FELFUGGESZTETT, JOGOK.TILTOTT, FELHASZNALO.FELHASZNALONEV
                FROM JOGOK
                JOIN FELHASZNALO ON JOGOK.FELHASZNALO_ID = FELHASZNALO.ID';

    $statement = oci_parse($conn, $query);
    oci_execute($statement);

    $results = array();
    while ($row = oci_fetch_array($statement, OCI_ASSOC+OCI_RETURN_NULLS)) {
        $results[] = $row;
    }

    oci_free_statement($statement);
    oci_close($conn);

    return $results;
}

function visszaRecord($id) {
    if(!connect()){
        return false;
    }
    $conn=connect();

    $query = "UPDATE JOGOK SET FELFUGGESZTETT=0 WHERE ID = :ID";
    $statement = oci_parse($conn, $query);
    oci_bind_by_name($statement, ':ID', $id);
    oci_execute($statement);

    oci_free_statement($statement);
    oci_close($conn);
}

function visszatiltRecord($id) {
    if(!connect()){
        return false;
    }
    $conn=connect();

    $query = "UPDATE JOGOK SET TILTOTT=0 WHERE ID = :ID";
    $statement = oci_parse($conn, $query);
    oci_bind_by_name($statement, ':ID', $id);
    oci_execute($statement);

    oci_free_statement($statement);
    oci_close($conn);
}

function tiltRecord($id) {
    if(!connect()){
        return false;
    }
    $conn=connect();

    $query = "UPDATE JOGOK SET TILTOTT=1 WHERE ID = :ID";
    $statement = oci_parse($conn, $query);
    oci_bind_by_name($statement, ':ID', $id);
    oci_execute($statement);

    oci_free_statement($statement);
    oci_close($conn);
}

function felfuggesztesRecord($id) {
    if(!connect()){
        return false;
    }
    $conn=connect();

    $query = "UPDATE JOGOK SET FELFUGGESZTETT=1 WHERE ID = :ID";
    $statement = oci_parse($conn, $query);
    oci_bind_by_name($statement, ':ID', $id);
    oci_execute($statement);

    oci_free_statement($statement);
    oci_close($conn);
}

function insert_post($userID, $cim, $leiras){
    if(!connect()){
        return false;
        }
        $conn=connect();
    $query = 'INSERT INTO BEJEGYZESEK (FELHASZNALO_ID, CIM, LEIRAS, DATUM) VALUES (:user_id, :cim, :leiras, SYSDATE)';
    $statement = oci_parse($conn, $query);
    if (!$statement) {
        $e = oci_error($conn);
        trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
    }

    oci_bind_by_name($statement, ':user_id', $userID);
    oci_bind_by_name($statement, ':cim', $cim);
    oci_bind_by_name($statement, ':leiras', $leiras);

    $result = oci_execute($statement);
    if (!$result) {
        $e = oci_error($statement);
        trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
        return false;
    }

    return true;
    oci_free_statement($statement);
    oci_close($conn);
}

function bejegyzes_query(){
    if(!connect()){
        return false;
    }
    $conn=connect();

    $query = 'SELECT *
                FROM BEJEGYZESEK';

    $statement = oci_parse($conn, $query);
    oci_execute($statement);

    $results = array();
    while ($row = oci_fetch_array($statement, OCI_ASSOC+OCI_RETURN_NULLS)) {
        $results[] = $row;
    }

    oci_free_statement($statement);
    oci_close($conn);

    return $results;
}

function deleteBRecord($id) {
    if(!connect()){
        return false;
    }
    $conn=connect();

    $query = "DELETE FROM BEJEGYZESEK WHERE ID = :ID";
    $statement = oci_parse($conn, $query);
    oci_bind_by_name($statement, ':ID', $id);
    oci_execute($statement);

    oci_free_statement($statement);
    oci_close($conn);
}

function update_user_bejegyzespicture($username,$filename,$tempname,$folder){
    if(!connect()){
    return false;
    }
    $conn=connect();

    $sql = "UPDATE BEJEGYZESEK SET KEPEK= :kep WHERE FELHASZNALO_ID=:username";

    $compiled = oci_parse($conn, $sql);

    oci_bind_by_name($compiled, ':kep', $filename);
    oci_bind_by_name($compiled, ':username', $username);

    $executed=oci_execute($compiled,OCI_NO_AUTO_COMMIT);
    if($executed){
        if (move_uploaded_file($tempname, $folder)) {
            oci_commit($conn);
            oci_close($conn);
            return "success";
        }else{
            oci_close($conn);

            return "error";
            }

    oci_close($conn);
    }
}
function get_bejegyzes_picture_by_username($username){
    if(!connect()){
    return false;
    }
    $conn=connect();
    $sql = "SELECT KEPEK FROM BEJEGYZESEK WHERE FELHASZNALO_ID = :username";

    $compiled = oci_parse($conn, $sql);

    oci_bind_by_name($compiled, ':username', $username);

    $executed=oci_execute($compiled);
    if($executed){
    $row = oci_fetch_array($compiled, OCI_ASSOC);
        if($row){
            $bejegyzes_kep=$row['KEPEK'];
            oci_close($conn);
            return $bejegyzes_kep;
            }

    oci_close($conn);
    }
}

function update_post($userID, $cim, $leiras){
    if(!connect()){
        return false;
        }
        $conn=connect();
    $sql = 'UPDATE BEJEGYZESEK SET CIM= :cim, LEIRAS= :leiras, DATUM= SYSDATE WHERE FELHASZNALO_ID=:user_id';
    $statement = oci_parse($conn, $sql);
    if (!$statement) {
        $e = oci_error($conn);
        trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
    }

    oci_bind_by_name($statement, ':user_id', $userID);
    oci_bind_by_name($statement, ':cim', $cim);
    oci_bind_by_name($statement, ':leiras', $leiras);

    $result = oci_execute($statement);
    if (!$result) {
        $e = oci_error($statement);
        trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
        return false;
    }

    oci_free_statement($statement);
    oci_close($conn);
    return true;
}

