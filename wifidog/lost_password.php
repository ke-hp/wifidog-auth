<?php
  // $Id$
  /********************************************************************\
   * This program is free software; you can redistribute it and/or    *
   * modify it under the terms of the GNU General Public License as   *
   * published by the Free Software Foundation; either version 2 of   *
   * the License, or (at your option) any later version.              *
   *                                                                  *
   * This program is distributed in the hope that it will be useful,  *
   * but WITHOUT ANY WARRANTY; without even the implied warranty of   *
   * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the    *
   * GNU General Public License for more details.                     *
   *                                                                  *
   * You should have received a copy of the GNU General Public License*
   * along with this program; if not, contact:                        *
   *                                                                  *
   * Free Software Foundation           Voice:  +1-617-542-5942       *
   * 59 Temple Place - Suite 330        Fax:    +1-617-542-2652       *
   * Boston, MA  02111-1307,  USA       gnu@gnu.org                   *
   *                                                                  *
   \********************************************************************/
  /**@file
   * Login page
   * @author Copyright (C) 2004 Benoit Gr�goire et Philippe April
   */
define('BASEPATH','./');
require_once BASEPATH.'include/common.php';
require_once BASEPATH.'classes/SmartyWifidog.php';
require_once BASEPATH.'classes/Security.php';

$smarty = new SmartyWifidog;
$session = new Session;

include BASEPATH.'include/language.php';
include BASEPATH.'include/mgmt_helpers.php';

if (isset($_REQUEST["submit"])) {
    $user_info = null;
    if ($_REQUEST["username"]) {
	    $db->ExecSqlUniqueRes("SELECT * FROM users WHERE user_id='$username'", $user_info, false);
	    if ($user_info == null) {
            $smarty->assign("error", _("Unable to find ") . $_REQUEST["username"] . _(" in the database."));
	    } else {
            send_lost_password_email($user_info["email"]);
        }
    } else if ($_REQUEST["email"]) {
	    $db->ExecSqlUniqueRes("SELECT * FROM users WHERE email='$email'", $user_info, false);
	    if ($user_info == null) {
            $smarty->assign("error", _("Unable to find ") . $_REQUEST["email"] . _(" in the database."));
	    } else {
            send_lost_password_email($user_info["email"]);
        }
    } else {
        $smarty->assign("error", _("Please specify a username or email address"));
    }
}

$smarty->display("templates/lost_password.html");
?>
