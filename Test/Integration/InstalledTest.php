<?php
/**
 * @author joshuacarter
 * @category Webtise
 * @package *PACKAGE NAME*
 */
namespace Webtise\BugSnag\Test\Integration;

use Magento\Framework\App\DeploymentConfig;
use Magento\Framework\App\DeploymentConfig\Reader as DeploymentConfigReader;
use Magento\Framework\App\Filesystem\DirectoryList;
use Magento\Framework\Component\ComponentRegistrar;
use Magento\Framework\Module\ModuleList;
use Magento\TestFramework\ObjectManager;

class InstalledTest extends \PHPUnit_Framework_TestCase
{

    private $moduleName = 'Webtise_BugSnag';
    
    /**
    * ObjectManager
    */
    protected $objectManager;
    
    /**
    * Setup objectManager variable for easy access
    */
    protected function setUp()
    {
        /** @var ObjectManager $objectManager */
        $this->objectManager = ObjectManager::getInstance();
        // Do anything else that needs doing before we run our tests
    }
    
    /**
    * Check our module is registered
    */
    public function testModuleIsRegistered()
    {
        $registrar = new ComponentRegistrar();
        $paths = $registrar->getPaths(ComponentRegistrar::MODULE);
        $this->assertArrayHasKey($this->moduleName, $paths);
    }
    
    /**
    * Test our module is enabled in the test environment
    */
    public function testTheModuleIsEnabledInTheTestEnv()
    {
        /** var ModuleList $moduleList */
        $moduleList = $this->objectManager->create(ModuleList::class);
        $message = sprintf('The module "%s" is not enabled in the test environment', $this->moduleName);
        $this->assertTrue($moduleList->has($this->moduleName), $message);
    }
    
    public function testTheModuleIsKnownAndEnabledInTheRealEnvironment()
    {
        $directoryList = $this->objectManager->create(DirectoryList::class, ['root' => BP]);
        $configReader = $this->objectManager->create(DeploymentConfigReader::class, ['dirList' => $directoryList]);
        $deploymentConfig = $this->objectManager->create(DeploymentConfig::class, ['reader' => $configReader]);
    
        /** @var ModuleList $moduleList */
        $moduleList = $this->objectManager->create(ModuleList::class, ['config' => $deploymentConfig]);
        $message = sprintf('The module "%s" is not enabled in the real environment', $this->moduleName);
        $this->assertTrue($moduleList->has($this->moduleName), $message);
    }
    
    /**
    * Empty tearAway function in case needed
    */
    protected function tearAway()
    {
        // Do something in the tearAway function if needed, executed at the end of our tests
    }

}