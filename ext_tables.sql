#
# Table structure for table 'be_users'
#
CREATE TABLE be_users (
	tx_cfgoogleauthenticator_enable TINYINT(1) DEFAULT '0' NOT NULL,
	tx_cfgoogleauthenticator_secret TINYTEXT
);

#
# Table structure for table 'fe_users'
#
CREATE TABLE fe_users (
	tx_cfgoogleauthenticator_enable TINYINT(1) DEFAULT '0' NOT NULL,
	tx_cfgoogleauthenticator_secret TINYTEXT
);