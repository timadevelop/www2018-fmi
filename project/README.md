## Installation

Get VM with ssh access, install git, lampp, mysql, php, nodejs

### clone project

- `cd /opt/lampp/htdocs`

- `git clone https://timadevelop@bitbucket.org/timadevelop/web2018-fmi.git`

- `cd /opt/lampp`

### Change document root

- `vim /opt/lampp/etc/httpd.conf`

change `DocumentRoot` to `/opt/lampp/htdocs/web2018-fmi/project/pages` :

```bash
#
# DocumentRoot: The directory out of which you will serve your
# documents. By default, all requests are taken from this directory, but
# symbolic links and aliases may be used to point to other locations.
#
DocumentRoot "/opt/lampp/htdocs/web2018-fmi/project/pages"
<Directory "/opt/lampp/htdocs/web2018-fmi/project/pages">
    #
    # Possible values for the Options directive are "None", "All
```

### Setup mysql, setup phpmyadmin:

- `mysqladmin -u root password 'admin' -p` - change root password to admin

- `vim /opt/lampp/phpmyadmin/config.inc.php`

change `user`, `password`, etc:

```bash
$i++;
/* Authentication type */
$cfg['Servers'][$i]['auth_type'] = 'cookie';//'config';
$cfg['Servers'][$i]['user'] = 'root';
$cfg['Servers'][$i]['password'] = 'admin';
/* Server parameters */
$cfg['Servers'][$i]['host'] = '127.0.0.1';
$cfg['Servers'][$i]['compress'] = false;
$cfg['Servers'][$i]['AllowNoPassword'] = false;
$cfg['Servers'][$i]['AllowNoPasswordRoot'] = false;

/**
 * phpMyAdmin configuration storage settings.
 */

/* User used to manipulate with storage */
// $cfg['Servers'][$i]['controlhost'] = '';
// $cfg['Servers'][$i]['controlport'] = '';
$cfg['Servers'][$i]['controluser'] = 'root';
$cfg['Servers'][$i]['controlpass'] = 'admin';

```

Go to /phpMyAdmin, login as root and create a db called nomadplan

### Change project db configuration

- `cd /opt/lampp/htdocs/web2018-fmi/project/pages`

- `vim db.php` - change db name, username and password

- `cd /opt/lampp/htdocs/web2018-fmi/project/`

- `chmod +x ./build.sh`

- `npm i -g gulp`

- `./build.sh` ( = to `npm i`, `gulp buid`, `cp -r docs images dist/`)
