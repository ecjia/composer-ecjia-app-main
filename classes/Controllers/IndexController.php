<?php
namespace Ecjia\App\Main\Controllers;

use Ecjia\System\BaseController\EcjiaFrontController;

class IndexController extends EcjiaFrontController
{

    public function __construct()
    {
        parent::__construct();
    }


    public function init()
    {

        $welcome = <<<EOL
<!DOCTYPE html>
<html lang="zh">
<head>
<meta charset="utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<title>Welcome to the API Center</title>
</head>
<body>
<pre>
__        __   _                            _          _   _
\ \      / /__| | ___ ___  _ __ ___   ___  | |_ ___   | |_| |__   ___
 \ \ /\ / / _ \ |/ __/ _ \| '_ ` _ \ / _ \ | __/ _ \  | __| '_ \ / _ \
  \ V  V /  __/ | (_| (_) | | | | | |  __/ | || (_) | | |_| | | |  __/
   \_/\_/ \___|_|\___\___/|_| |_| |_|\___|  \__\___/   \__|_| |_|\___|
   
    _    ____ ___    ____           _
   / \  |  _ \_ _|  / ___|___ _ __ | |_ ___ _ __
  / _ \ | |_) | |  | |   / _ \ '_ \| __/ _ \ '__|
 / ___ \|  __/| |  | |__|  __/ | | | ||  __/ |
/_/   \_\_|  |___|  \____\___|_| |_|\__\___|_|

 ____  _                       _               _         _
|  _ \| | ___  __ _ ___  ___  | | ___   __ _  (_)_ __   | |_ ___
| |_) | |/ _ \/ _` / __|/ _ \ | |/ _ \ / _` | | | '_ \  | __/ _ \
|  __/| |  __/ (_| \__ \  __/ | | (_) | (_| | | | | | | | || (_) |
|_|   |_|\___|\__,_|___/\___| |_|\___/ \__, | |_|_| |_|  \__\___/
                                       |___/

 _ __ ___   __ _ _ __   __ _  __ _  ___
| '_ ` _ \ / _` | '_ \ / _` |/ _` |/ _ \
| | | | | | (_| | | | | (_| | (_| |  __/
|_| |_| |_|\__,_|_| |_|\__,_|\__, |\___|
                             |___/
</pre>
</body>
</html>
EOL;

        return $this->displayContent($welcome);
    }

}