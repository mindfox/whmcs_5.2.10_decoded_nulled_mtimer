ALTER TABLE `tblannouncements` CHANGE `date` `date` DATETIME NULL DEFAULT NULL ;
ALTER TABLE `tblaccounts` CHANGE `id` `id` INT( 10 ) NOT NULL AUTO_INCREMENT , CHANGE `userid` `userid` INT( 10 ) NOT NULL,CHANGE `invoiceid` `invoiceid` INT( 10 ) NOT NULL DEFAULT '0'  ;
CREATE INDEX invoiceid ON tblaccounts (invoiceid);
CREATE INDEX userid ON tblaccounts (userid);
CREATE INDEX date ON tblaccounts (date);
CREATE INDEX transid ON tblaccounts (transid(32));
ALTER TABLE `tblactivitylog` CHANGE `id` `id` INT( 10 ) NOT NULL AUTO_INCREMENT ;
ALTER TABLE `tbladdons` CHANGE `id` `id` INT( 10 ) NOT NULL AUTO_INCREMENT ;
CREATE INDEX name ON tbladdons (name(32));
ALTER TABLE `tbladminlog` CHANGE `id` `id` INT( 10 ) NOT NULL AUTO_INCREMENT ;
CREATE INDEX logouttime ON tbladminlog (logouttime);
CREATE INDEX roleid_permid ON tbladminperms (roleid,permid);
ALTER TABLE `tbladmins` CHANGE `id` `id` INT( 10 ) NOT NULL AUTO_INCREMENT ;
CREATE INDEX username ON tbladmins (username(32));
ALTER TABLE `tblaffiliates` CHANGE `clientid` `clientid` INT( 10 ) NOT NULL ;
CREATE INDEX affiliateid ON tblaffiliates (id);
CREATE INDEX clientid ON tblaffiliates (clientid);
ALTER TABLE `tblaffiliates` DROP PRIMARY KEY;
ALTER TABLE `tblaffiliatesaccounts` CHANGE `id` `id` INT( 1 ) NOT NULL AUTO_INCREMENT ;
ALTER TABLE `tblaffiliatesaccounts` CHANGE `affiliateid` `affiliateid` INT( 10 ) NOT NULL ;
CREATE INDEX affiliateid ON tblaffiliatesaccounts (affiliateid);
ALTER TABLE `tblaffiliateshistory` CHANGE `id` `id` INT( 10 ) NOT NULL AUTO_INCREMENT ,CHANGE `affiliateid` `affiliateid` INT( 10 ) NOT NULL , CHANGE `affaccid` `affaccid` INT( 10 ) NOT NULL ;
CREATE INDEX affiliateid ON tblaffiliateshistory (affiliateid);
ALTER TABLE `tblaffiliatespending` CHANGE `id` `id` INT( 10 ) NOT NULL AUTO_INCREMENT , CHANGE `affaccid` `affaccid` INT( 10 ) NOT NULL DEFAULT '0' ;
CREATE INDEX clearingdate ON tblaffiliatespending (clearingdate);
ALTER TABLE `tblannouncements` CHANGE `id` `id` INT( 10 ) NOT NULL AUTO_INCREMENT ;
CREATE INDEX date ON tblannouncements (date);
ALTER TABLE `tblbannedemails` CHANGE `id` `id` INT( 10 ) NOT NULL AUTO_INCREMENT ,CHANGE `count` `count` INT( 10 ) NOT NULL DEFAULT '0' ;
CREATE INDEX domain ON tblbannedemails (domain(64));
ALTER TABLE `tblbannedips` CHANGE `id` `id` INT( 10 ) NOT NULL AUTO_INCREMENT ;
CREATE INDEX ip ON tblbannedips (ip(32));
ALTER TABLE `tblbrowserlinks` CHANGE `id` `id` INT( 10 ) NOT NULL AUTO_INCREMENT ;
CREATE INDEX name ON tblbrowserlinks (name(32));
ALTER TABLE `tblcalendar` CHANGE `id` `id` INT( 10 ) NOT NULL AUTO_INCREMENT , CHANGE `adminid` `adminid` INT( 10 ) NOT NULL ;
CREATE INDEX day_month_year ON tblcalendar (day(2),month(2),year(4));
ALTER TABLE `tblcancelrequests` CHANGE `id` `id` INT( 10 ) NOT NULL AUTO_INCREMENT , CHANGE `relid` `relid` INT( 10 ) NOT NULL ;
CREATE INDEX serviceid ON tblcancelrequests (relid);
ALTER TABLE `tblclients` CHANGE `id` `id` INT( 10 ) NOT NULL AUTO_INCREMENT , CHANGE `billingcid` `billingcid` INT( 10 ) NOT NULL ;
CREATE INDEX firstname_lastname ON tblclients (firstname(32),lastname(32));
CREATE INDEX email ON tblclients (email(64));
CREATE INDEX setting ON tblconfiguration (setting(32));
CREATE INDEX userid_firstname_lastname ON tblcontacts (userid,firstname(32),lastname(32));
ALTER TABLE `tblcontacts` CHANGE `id` `id` INT( 10 ) NOT NULL AUTO_INCREMENT , CHANGE `userid` `userid` INT( 10 ) NOT NULL ;
CREATE INDEX email ON tblcontacts (email(64));
ALTER TABLE `tblcredit` CHANGE `id` `id` INT( 10 ) NOT NULL AUTO_INCREMENT , CHANGE `clientid` `clientid` INT( 10 ) NOT NULL ;
ALTER TABLE `tblcustomfields` CHANGE `id` `id` INT( 10 ) NOT NULL AUTO_INCREMENT , CHANGE `relid` `relid` INT( 10 ) NOT NULL ;
CREATE INDEX serviceid ON tblcustomfields (relid);
ALTER TABLE `tblcustomfieldsvalues` CHANGE `fieldid` `fieldid` INT( 10 ) NOT NULL , CHANGE `relid` `relid` INT( 10 ) NOT NULL ;
CREATE INDEX fieldid_relid ON tblcustomfieldsvalues (fieldid,relid);
ALTER TABLE `tbldomainpricing` CHANGE `id` `id` INT( 10 ) NOT NULL AUTO_INCREMENT ;
CREATE INDEX extension_registrationperiod ON tbldomainpricing (extension(32),registrationperiod);
CREATE INDEX `order` ON tbldomainpricing (`order`);
ALTER TABLE `tbldomains` CHANGE `id` `id` INT( 10 ) NOT NULL AUTO_INCREMENT , CHANGE `userid` `userid` INT( 10 ) NOT NULL ;
CREATE INDEX userid ON tbldomains (userid);
CREATE INDEX orderid ON tbldomains (orderid);
CREATE INDEX domain ON tbldomains (domain(64));
CREATE INDEX status ON tbldomains (status);
ALTER TABLE `tbldomainsadditionalfields` CHANGE `id` `id` INT( 10 ) NOT NULL AUTO_INCREMENT ,CHANGE `domainid` `domainid` INT( 10 ) NOT NULL ;
CREATE INDEX domainid ON tbldomainsadditionalfields (domainid);
ALTER TABLE `tbldownloadcats` CHANGE `id` `id` INT( 10 ) NOT NULL AUTO_INCREMENT , CHANGE `parentid` `parentid` INT( 10 ) NOT NULL DEFAULT '0' ;
CREATE INDEX parentid ON tbldownloadcats (parentid);
ALTER TABLE `tbldownloads` CHANGE `id` `id` INT( 10 ) NOT NULL AUTO_INCREMENT , CHANGE `category` `category` INT( 10 ) NOT NULL AFTER id , CHANGE `downloads` `downloads` INT( 10 ) NOT NULL DEFAULT '0' ;
CREATE INDEX title ON tbldownloads (title(32));
ALTER TABLE `tbldownloads` ADD INDEX ( `downloads` ) ;
ALTER TABLE `tblemails` CHANGE `id` `id` INT( 10 ) NOT NULL AUTO_INCREMENT , CHANGE `userid` `userid` INT( 10 ) NOT NULL ;
CREATE INDEX userid ON tblemails (userid);
ALTER TABLE `tblemailtemplates` CHANGE `id` `id` INT( 10 ) NOT NULL AUTO_INCREMENT ;
CREATE INDEX type ON tblemailtemplates (type(32));
CREATE INDEX name ON tblemailtemplates (name(64));
ALTER TABLE `tblfraud` CHANGE `id` `id` INT( 10 ) NOT NULL AUTO_INCREMENT ;
CREATE INDEX fraud ON tblfraud (fraud(32));
ALTER TABLE `tblgatewaylog` CHANGE `id` `id` INT( 10 ) NOT NULL AUTO_INCREMENT ;
ALTER TABLE `tblhosting` CHANGE `id` `id` INT( 10 ) NOT NULL AUTO_INCREMENT ,CHANGE `userid` `userid` INT( 10 ) NOT NULL ,CHANGE `orderid` `orderid` INT( 10 ) NOT NULL ,CHANGE `packageid` `packageid` INT( 10 ) NOT NULL AFTER `orderid` ,CHANGE `server` `server` INT( 10 ) NOT NULL AFTER `packageid`;
UPDATE tblhosting SET password=rootpassword WHERE password='' AND rootpassword!='';
ALTER TABLE `tblhosting` DROP `rootpassword` ;
CREATE INDEX serviceid ON tblhosting (id);
CREATE INDEX userid ON tblhosting (userid);
CREATE INDEX orderid ON tblhosting (orderid);
CREATE INDEX productid ON tblhosting (packageid);
CREATE INDEX serverid ON tblhosting (server);
CREATE INDEX domain ON tblhosting (domain(64));
CREATE INDEX domainstatus ON tblhosting (domainstatus);
ALTER TABLE `tblhostingaddons` CHANGE `id` `id` INT( 10 ) NOT NULL AUTO_INCREMENT ,CHANGE `orderid` `orderid` INT( 10 ) NOT NULL ,CHANGE `hostingid` `hostingid` INT( 10 ) NOT NULL ;
ALTER TABLE `tblhostingaddons` ADD INDEX ( `orderid` ) ;
CREATE INDEX serviceid ON tblhostingaddons (hostingid);
CREATE INDEX name ON tblhostingaddons (name(32));
CREATE INDEX status ON tblhostingaddons (status);
ALTER TABLE `tblhostingconfigoptions` CHANGE `id` `id` INT( 10 ) NOT NULL AUTO_INCREMENT ,CHANGE `relid` `relid` INT( 10 ) NOT NULL ,CHANGE `configid` `configid` INT( 10 ) NOT NULL ,CHANGE `optionid` `optionid` INT( 10 ) NOT NULL ;
CREATE INDEX relid_configid ON tblhostingconfigoptions (relid,configid);
ALTER TABLE `tblinvoiceitems` CHANGE `id` `id` INT( 10 ) NOT NULL AUTO_INCREMENT ,CHANGE `invoiceid` `invoiceid` INT( 10 ) NOT NULL DEFAULT '0' , CHANGE `userid` `userid` INT( 10 ) NOT NULL ,CHANGE `relid` `relid` INT( 10 ) NOT NULL ;
ALTER TABLE `tblinvoiceitems` ADD INDEX ( `invoiceid` ) ;
ALTER TABLE `tblinvoices` CHANGE `id` `id` INT( 10 ) NOT NULL AUTO_INCREMENT ,CHANGE `userid` `userid` INT( 10 ) NOT NULL AFTER `id`;
ALTER TABLE `tblinvoices` ADD INDEX ( `userid` ) ;
CREATE INDEX status ON tblinvoices (status(3));
ALTER TABLE `tblknowledgebase` CHANGE `id` `id` INT( 10 ) NOT NULL AUTO_INCREMENT ,CHANGE `category` `category` INT( 10 ) NOT NULL DEFAULT '0',CHANGE `views` `views` INT( 10 ) NOT NULL DEFAULT '0',CHANGE `useful` `useful` INT( 10 ) NOT NULL DEFAULT '0',CHANGE `votes` `votes` INT( 10 ) NOT NULL DEFAULT '0' ;
ALTER TABLE `tblknowledgebasecats` CHANGE `id` `id` INT( 10 ) NOT NULL AUTO_INCREMENT ,CHANGE `parentid` `parentid` INT( 10 ) NOT NULL DEFAULT '0' ;
ALTER TABLE `tblknowledgebasecats` ADD INDEX ( `parentid` ) ;
CREATE INDEX name ON tblknowledgebasecats (name(64));
ALTER TABLE `tbllinks` CHANGE `id` `id` INT( 10 ) NOT NULL AUTO_INCREMENT ,CHANGE `clicks` `clicks` INT( 10 ) NOT NULL ,CHANGE `conversions` `conversions` INT( 10 ) NOT NULL ;
CREATE INDEX name ON tbllinks (name(64));
ALTER TABLE `tblnotes` CHANGE `id` `id` INT( 10 ) NOT NULL AUTO_INCREMENT ,CHANGE `userid` `userid` INT( 10 ) NOT NULL ,CHANGE `adminid` `adminid` INT( 10 ) NOT NULL DEFAULT '0' ;
CREATE INDEX userid ON tblnotes (userid);
ALTER TABLE `tblorders` CHANGE `id` `id` INT( 10 ) NOT NULL AUTO_INCREMENT ,CHANGE `userid` `userid` INT( 10 ) NOT NULL ,CHANGE `contactid` `contactid` INT( 10 ) NOT NULL ,CHANGE `invoiceid` `invoiceid` INT( 10 ) NOT NULL DEFAULT '0' ;
CREATE INDEX ordernum ON tblorders (ordernum);
CREATE INDEX userid ON tblorders (userid);
CREATE INDEX contactid ON tblorders (contactid);
CREATE INDEX date ON tblorders (date);
ALTER TABLE `tblpaymentgateways` CHANGE `id` `id` INT( 10 ) NOT NULL AUTO_INCREMENT ;
CREATE INDEX gateway_setting ON tblpaymentgateways (gateway(32),setting(32));
CREATE INDEX setting_value ON tblpaymentgateways (setting(32),value(32));
ALTER TABLE `tblproductconfigoptions` CHANGE `id` `id` INT( 10 ) NOT NULL AUTO_INCREMENT ,CHANGE `productid` `productid` INT( 10 ) NOT NULL ;
ALTER TABLE `tblproductconfigoptions` ADD INDEX ( `productid` ) ;
ALTER TABLE `tblproductconfigoptionssub` CHANGE `id` `id` INT( 10 ) NOT NULL AUTO_INCREMENT ,CHANGE `configid` `configid` INT( 10 ) NOT NULL ;
CREATE INDEX configid ON tblproductconfigoptionssub (configid);
CREATE INDEX `order` ON tblproductgroups (`order`);
ALTER TABLE `tblproductgroups` CHANGE `id` `id` INT( 10 ) NOT NULL AUTO_INCREMENT ;
ALTER TABLE `tblproducts` CHANGE `id` `id` INT( 10 ) NOT NULL AUTO_INCREMENT ,CHANGE `gid` `gid` INT( 10 ) NOT NULL ,CHANGE `welcomeemail` `welcomeemail` INT( 1 ) NOT NULL DEFAULT '0',CHANGE `qty` `qty` INT( 1 ) NOT NULL DEFAULT '0',CHANGE `defaultserver` `defaultserver` INT( 1 ) NOT NULL DEFAULT '0' ;
CREATE INDEX gid ON tblproducts (gid);
CREATE INDEX name ON tblproducts (name(64));
ALTER TABLE `tblpromotions` CHANGE `id` `id` INT( 10 ) NOT NULL AUTO_INCREMENT ,CHANGE `maxuses` `maxuses` INT( 10 ) NOT NULL DEFAULT '0',CHANGE `uses` `uses` INT( 10 ) NOT NULL DEFAULT '0' ;
CREATE INDEX code ON tblpromotions (code(32));
ALTER TABLE `tblregistrars` CHANGE `id` `id` INT( 10 ) NOT NULL AUTO_INCREMENT ;
CREATE INDEX registrar_setting ON tblregistrars(registrar(32),setting(32));
ALTER TABLE `tblservers` CHANGE `id` `id` INT( 10 ) NOT NULL AUTO_INCREMENT ,CHANGE `maxaccounts` `maxaccounts` INT( 10 ) NOT NULL DEFAULT '0' ;
ALTER TABLE `tbltax` CHANGE `id` `id` INT( 10 ) NOT NULL AUTO_INCREMENT ;
CREATE INDEX state_country ON tbltax (state(32),country(2));
ALTER TABLE `tblticketbreaklines` CHANGE `id` `id` INT( 10 ) NOT NULL AUTO_INCREMENT ;
ALTER TABLE `tblticketdepartments` CHANGE `id` `id` INT( 10 ) NOT NULL AUTO_INCREMENT ;
CREATE INDEX name ON tblticketdepartments (name(64));
ALTER TABLE `tblticketlog` CHANGE `id` `id` INT( 10 ) NOT NULL AUTO_INCREMENT ,CHANGE `tid` `tid` INT( 10 ) NOT NULL ;
CREATE INDEX tid ON tblticketlog (tid);
ALTER TABLE `tblticketmaillog` CHANGE `id` `id` INT( 10 ) NOT NULL AUTO_INCREMENT ;
ALTER TABLE `tblticketnotes` CHANGE `id` `id` INT( 10 ) NOT NULL AUTO_INCREMENT ,CHANGE `ticketid` `ticketid` INT( 10 ) NOT NULL AFTER `id`;
CREATE INDEX ticketid_date ON tblticketnotes (ticketid,date);
ALTER TABLE `tblticketpredefinedcats` CHANGE `id` `id` INT( 10 ) NOT NULL AUTO_INCREMENT ,CHANGE `parentid` `parentid` INT( 10 ) NOT NULL DEFAULT '0' ;
CREATE INDEX parentid_name ON tblticketpredefinedcats (parentid,name(64));
ALTER TABLE `tblticketpredefinedreplies` CHANGE `id` `id` INT( 10 ) NOT NULL AUTO_INCREMENT ,CHANGE `catid` `catid` INT( 10 ) NOT NULL ;
ALTER TABLE `tblticketreplies` CHANGE `id` `id` INT( 10 ) NOT NULL AUTO_INCREMENT ,CHANGE `tid` `tid` INT( 10 ) NOT NULL ,CHANGE `userid` `userid` INT( 10 ) NOT NULL ;
CREATE INDEX tid_date ON tblticketreplies (tid,date);
ALTER TABLE `tbltickets` CHANGE `id` `id` INT( 10 ) NOT NULL AUTO_INCREMENT ,CHANGE `did` `did` INT( 10 ) NOT NULL ,CHANGE `userid` `userid` INT( 10 ) NOT NULL ;
CREATE INDEX tid_c ON tbltickets (tid,c(64));
CREATE INDEX userid ON tbltickets (userid);
CREATE INDEX status ON tbltickets (status(10));
CREATE INDEX date ON tbltickets (date);
ALTER TABLE `tblticketspamfilters` CHANGE `id` `id` INT( 10 ) NOT NULL AUTO_INCREMENT ;
ALTER TABLE `tblticketspamfilters` ADD INDEX ( `type` ) ;
ALTER TABLE `tbltodolist` CHANGE `id` `id` INT( 10 ) NOT NULL AUTO_INCREMENT ,CHANGE `admin` `admin` INT( 10 ) NOT NULL DEFAULT '0' ;
CREATE INDEX duedate ON tbltodolist (duedate);
ALTER TABLE `tblupgrades` CHANGE `id` `id` INT( 10 ) NOT NULL AUTO_INCREMENT ,CHANGE `orderid` `orderid` INT( 10 ) NOT NULL ;
CREATE INDEX orderid ON tblupgrades (orderid);
CREATE INDEX serviceid ON tblupgrades (relid);
ALTER TABLE `tblwhoislog` CHANGE `id` `id` INT( 10 ) NOT NULL AUTO_INCREMENT ;
INSERT INTO tblconfiguration (setting,value) VALUES ('CCRetryEveryWeekFor','0');
INSERT INTO tblconfiguration (setting,value) VALUES ('SupportTicketKBSuggestions','on');
CREATE TABLE IF NOT EXISTS `tblsslorders` ( `id` int(10) NOT NULL auto_increment, `userid` int(10) NOT NULL, `serviceid` int(10) NOT NULL, `remoteid` text COLLATE utf8_general_ci NOT NULL,  `module` text COLLATE utf8_general_ci NOT NULL,  `certtype` text COLLATE utf8_general_ci NOT NULL,  `completiondate` datetime NOT NULL, `status` enum('Incomplete','Completed','Cancelled') NOT NULL,  PRIMARY KEY  (`id`)) DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;
ALTER TABLE `tblhostingaddons` CHANGE `status` `status` ENUM( 'Pending', 'Active', 'Suspended', 'Terminated', 'Cancelled', 'Fraud' ) NOT NULL DEFAULT 'Pending';
INSERT INTO `tblconfiguration` (`setting`, `value`) VALUES ('DailyEmailBackup', '');
INSERT INTO `tblconfiguration` (`setting`, `value`) VALUES ('FTPBackupHostname', '');
INSERT INTO `tblconfiguration` (`setting`, `value`) VALUES ('FTPBackupUsername', '');
INSERT INTO `tblconfiguration` (`setting`, `value`) VALUES ('FTPBackupPassword', '');
INSERT INTO `tblconfiguration` (`setting`, `value`) VALUES ('FTPBackupDestination', '/');
UPDATE tblconfiguration SET value='3.6.2' WHERE setting='Version';