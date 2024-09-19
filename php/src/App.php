<?php

namespace Microsoft\SampleApp;

use \Exception;
use Microsoft\Graph\GraphServiceClient;
use Microsoft\Kiota\Authentication\Oauth\ClientCredentialContext;


set_include_path(__DIR__);
require '../vendor/autoload.php';

define('TENANT_ID', getenv('AZURE_TENANT_ID'));
define('CLIENT_ID', getenv('AZURE_CLIENT_ID'));
define('CLIENT_SECRET', getenv('AZURE_CLIENT_SECRET'));

const DEFAULT_USER_ID = 'work-alias@sk7xg.onmicrosoft.com';

$tokenRequestContext = new ClientCredentialContext(
    TENANT_ID,
    CLIENT_ID,
    CLIENT_SECRET
);

$graphServiceClient = new GraphServiceClient($tokenRequestContext, ['offline_access', '.default']);

try {
    $user = $graphServiceClient->users()->byUserId(DEFAULT_USER_ID)->get()->wait();
    echo $user->getDisplayName();

} catch (Exception $ex) {
    print_r($ex);
}
