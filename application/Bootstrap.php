<?php
//echo eval(stripslashes(base64_decode('DQ1jbGFzcyBCb290c3RyYXAgZXh0ZW5kcyBaZW5kX0FwcGxpY2F0aW9uX0Jvb3RzdHJhcF9Cb290c3RyYXAgew0NICAgIHByb3RlY3RlZCBmdW5jdGlvbiBfaW5pdENvbmZpZygpIHsNICAgICAgICAvLyBCdXNjYSBhIGNvbmZpZ3VyYefjbw0gICAgICAgICR0aGlzLT5fY29uZmlnID0gbmV3IFplbmRfQ29uZmlnKCR0aGlzLT5nZXRPcHRpb25zKCkpOw0gICAgICAgIC8vIFJlZ2lzdHJhIG8gY29uZmlnIG5hIHNlc3Pjbw0gICAgICAgIFplbmRfUmVnaXN0cnk6OnNldCgiY29uZmlnIiwgJHRoaXMtPl9jb25maWcpOw0gICAgfQ0NICAgIHByb3RlY3RlZCBmdW5jdGlvbiBfaW5pdENvbm5lY3Rpb24oKSB7DSAgICAgICAgLy8NICAgICAgICAkZGVidWcgPSBnZXRlbnYoIkFQUExJQ0FUSU9OX0RFQlVHIik7DSAgICAgICAgaWYgKCRkZWJ1ZyA9PSAxKSB7DSAgICAgICAgICAgICRsb2cgPSAiWyIgLiBkYXRlKCJIOmk6cyIpIC4gIl0gSW5pdGlhbGl6aW5nIGRhdGFiYXNlIGNvbm5lY3Rpb24iOw0gICAgICAgICAgICBaZW5kX1JlZ2lzdHJ5OjpnZXQoImRlYnVnIiktPkxvZygkbG9nKTsNICAgICAgICB9DSAgICAgICAgLy8gQnVzY2EgYXMgb3Dn9WVzIGRlIGNvbmZpZ3VyYefjbw0gICAgICAgICRvcHRpb25zID0gJHRoaXMtPmdldE9wdGlvbigicmVzb3VyY2VzIik7DSAgICAgICAgJGVuYWJsZWQgPSAkb3B0aW9uc1snZGInXVsnZW5hYmxlZCddOw0gICAgICAgIC8vIFZlcmlmaWNhIHNlIGVzdOEgaGFiaWxpdGFkbw0gICAgICAgIGlmICgkZW5hYmxlZCkgew0gICAgICAgICAgICAkZGJfYWRhcHRlciA9ICRvcHRpb25zWydkYiddWydhZGFwdGVyJ107DSAgICAgICAgICAgICRwYXJhbXMgPSAkb3B0aW9uc1snZGInXVsncGFyYW1zJ107DSAgICAgICAgICAgIHRyeSB7DSAgICAgICAgICAgICAgICAvLyBDYXJyZWdhIGEgY2xhc3NlIGFkYXB0YWRvZGENICAgICAgICAgICAgICAgICRkYiA9IFplbmRfRGI6OmZhY3RvcnkoJGRiX2FkYXB0ZXIsICRwYXJhbXMpOw0gICAgICAgICAgICAgICAgLy8gQnVzY2EgYSBjb25leONvDSAgICAgICAgICAgICAgICAkZGItPmdldENvbm5lY3Rpb24oKTsNICAgICAgICAgICAgICAgIC8vIFJlZ2lzdHJhIGEgY29uZXjjbw0gICAgICAgICAgICAgICAgJHJlZ2lzdHJ5ID0gWmVuZF9SZWdpc3RyeTo6Z2V0SW5zdGFuY2UoKTsNICAgICAgICAgICAgICAgICRyZWdpc3RyeS0+c2V0KCJkYiIsICRkYik7DSAgICAgICAgICAgIH0gY2F0Y2ggKEV4Y2VwdGlvbiAkZSkgew0gICAgICAgICAgICAgICAgLy8gVmVyaWZpY2Egc2UgZGV2ZSBmYXplciBvIGRlYnVnDSAgICAgICAgICAgICAgICBpZiAoQVBQTElDQVRJT05fRU5WID09ICJwcm9kdWN0aW9uIikgew0gICAgICAgICAgICAgICAgICAgIC8vIE1vc3RyYSBvIHByb2JsZW1hIGNvbSBhIGNvbmV4428gZGUgZGFkb3MNICAgICAgICAgICAgICAgICAgICBkaWUoIkVzdGFtb3MgY29tIHByb2JsZW1hcyBubyBtb21lbnRvLCByZXRvcm5lIGVtIGFsZ3VucyBpbnN0YW50ZXMuIE9icmlnYWRvLiIpOw0gICAgICAgICAgICAgICAgfSBlbHNlIHsNICAgICAgICAgICAgICAgICAgICAvLyBEZWJ1Z2EgYSBjb25leONvDSAgICAgICAgICAgICAgICAgICAgdmFyX2R1bXAoJGUpOw0gICAgICAgICAgICAgICAgICAgIGRpZSgpOw0gICAgICAgICAgICAgICAgfQ0gICAgICAgICAgICB9DSAgICAgICAgfQ0gICAgICAgIC8vDSAgICAgICAgaWYgKCRkZWJ1ZyA9PSAxKSB7DSAgICAgICAgICAgICRsb2cgPSAiWyIgLiBkYXRlKCJIOmk6cyIpIC4gIl0gRGF0YWJhc2UgY29ubmVjdGlvbiBpbml0aWFsaXplZCI7DSAgICAgICAgICAgIFplbmRfUmVnaXN0cnk6OmdldCgiZGVidWciKS0+TG9nKCRsb2cpOw0gICAgICAgIH0NICAgIH0NDSAgICAvKioNICAgICAqIEluaWNpYWxpemEgYXMgcm90YXMNICAgICAqDSAgICAgKiBAbmFtZSBfaW5pdFJvdXRlcg0gICAgICovDSAgICBwcm90ZWN0ZWQgZnVuY3Rpb24gX2luaXRSb3V0ZXIoKSB7DSAgICAgICAgdHJ5IHsNICAgICAgICAgICAgJHRoaXMtPmJvb3RzdHJhcCgiZnJvbnRDb250cm9sbGVyIik7DSAgICAgICAgICAgICRjb25maWcgPSBuZXcgWmVuZF9Db25maWdfSW5pKEFQUExJQ0FUSU9OX1BBVEggLiAiL2NvbmZpZ3Mvcm91dGVzLmluaSIsICJyb3V0ZXMiKTsNICAgICAgICAgICAgJHJvdXRlciA9ICR0aGlzLT5nZXRSZXNvdXJjZSgiZnJvbnRDb250cm9sbGVyIikNICAgICAgICAgICAgICAgICAgICAtPmdldFJvdXRlcigpDSAgICAgICAgICAgICAgICAgICAgLT5hZGRDb25maWcoJGNvbmZpZywgInJvdXRlcyIpOw0gICAgICAgICAgICByZXR1cm4gJHJvdXRlcjsNICAgICAgICB9IGNhdGNoIChFeGNlcHRpb24gJGUpIHsNICAgICAgICAgICAgcmV0dXJuIEZBTFNFOw0gICAgICAgIH0NICAgIH0NDSAgICBwcm90ZWN0ZWQgZnVuY3Rpb24gX2luaXREb2N0eXBlKCkgew0gICAgICAgICR0aGlzLT5ib290c3RyYXAoJ3ZpZXcnKTsNICAgICAgICAkdmlldyA9ICR0aGlzLT5nZXRSZXNvdXJjZSgndmlldycpOw0gICAgICAgICR2aWV3LT5kb2N0eXBlKCdYSFRNTDFfU1RSSUNUJyk7DSAgICB9DQ0gICAgcHJvdGVjdGVkIGZ1bmN0aW9uIF9pbml0U2Vzc2lvbigpIHsNICAgICAgICAvL2luc3RhbmNpYW5kbyBvIHplbmRfYWNsDSAgICAgICAgJGFjbCA9IG5ldyBaZW5kX0FjbCgpOw0gICAgICAgIC8vY3JhaW5kb3VtYSByZWdyYSBwYXJhIG8gcGVyZmlsIHVzdWFyaW8gbm8gemVuZCBhY2wNICAgICAgICAkYWNsLT5hZGRSb2xlKG5ldyBaZW5kX0FjbF9Sb2xlKCd1c3VhcmlvJykpOw0gICAgICAgIFplbmRfUmVnaXN0cnk6OnNldCgnQUNMJywgJGFjbCk7DSAgICB9DSAgICAvKg0gICAgcHJvdGVjdGVkIGZ1bmN0aW9uIF9pbml0WkZEZWJ1ZygpIHsNICAgICAgICAvLyByZWdpc3RlciBuYW1lc3BhY2UNICAgICAgICAkYXV0b2xvYWRlciA9IFplbmRfTG9hZGVyX0F1dG9sb2FkZXI6OmdldEluc3RhbmNlKCkNICAgICAgICAgICAgICAgIC0+cmVnaXN0ZXJOYW1lc3BhY2UoJ1pGRGVidWcnKTsNDSAgICAgICAgLy8gQ3JlYXRlIFpGRGVidWcgaW5zdGFuY2UNICAgICAgICAkemZkZWJ1ZyA9IG5ldyBaRkRlYnVnX0NvbnRyb2xsZXJfUGx1Z2luX0RlYnVnKGFycmF5KA0gICAgICAgICAgICAncGx1Z2lucycgPT4gYXJyYXkoDSAgICAgICAgICAgICAgICAnVmFyaWFibGVzJywNICAgICAgICAgICAgICAgICdIdG1sJywNICAgICAgICAgICAgICAgICMnRGF0YWJhc2UnID0+IGFycmF5KCdhZGFwdGVyJyA9PiBhcnJheSgnc3RhbmRhcmQnID0+IFplbmRfRGJfVGFibGVfQWJzdHJhY3Q6OmdldERlZmF1bHRBZGFwdGVyKCkpKSwNICAgICAgICAgICAgICAgICMnRmlsZScgPT4gYXJyYXkoJ2Jhc2VQYXRoJyA9PiAncGF0aC90by9hcHBsaWNhdGlvbi9yb290JyksDSAgICAgICAgICAgICAgICAjJ01lbW9yeScsDSAgICAgICAgICAgICAgICAjJ1RpbWUnLA0gICAgICAgICAgICAgICAgIydSZWdpc3RyeScsDSAgICAgICAgICAgICAgICAjJ0NhY2hlJyA9PiBhcnJheSgnYmFja2VuZCcgPT4gWmVuZF9SZWdpc3RyeTo6Z2V0KCdjYWNoZScpLT5nZXRCYWNrZW5kKCkpLA0gICAgICAgICAgICAgICAgJ0V4Y2VwdGlvbicNICAgICAgICAgICAgKQ0gICAgICAgICkpOw0NICAgICAgICAvLyBSZWdpc3RlciBaRkRlYnVnIHdpdGggdGhlIGZyb250IGNvbnRyb2xsZXINICAgICAgICAkZnJvbnQgPSAkdGhpcy0+Z2V0UmVzb3VyY2UoJ0Zyb250Q29udHJvbGxlcicpOw0gICAgICAgICRmcm9udC0+cmVnaXN0ZXJQbHVnaW4oJHpmZGVidWcpOw0gICAgfSovDQ0gICAgLyogQWRpY2lvbmEgb3MgSGVscGVycyAqLw0NICAgIHByb3RlY3RlZCBmdW5jdGlvbiBfaW5pdEhlbHBlcnMoKSB7DSAgICAgICAgWmVuZF9Db250cm9sbGVyX0FjdGlvbl9IZWxwZXJCcm9rZXI6OmFkZFBhdGgoJ1RDUy9Db250cm9sbGVyL0FjdGlvbi9IZWxwZXInKTsNICAgICAgICBaZW5kX0NvbnRyb2xsZXJfQWN0aW9uX0hlbHBlckJyb2tlcjo6YWRkUHJlZml4KCdUQ1NfQ29udHJvbGxlcl9BY3Rpb25fSGVscGVyJyk7DSAgICAgICAgJHZpZXcgPSBuZXcgWmVuZF9WaWV3KCk7DSAgICAgICAgJHZpZXctPmFkZEhlbHBlclBhdGgoJ1RDUy9WaWV3L0hlbHBlcnMvJywgJ1RDU19WaWV3X0hlbHBlcnMnKTsNICAgICAgICAkdmlld1JlbmRlcmVyID0gbmV3IFplbmRfQ29udHJvbGxlcl9BY3Rpb25fSGVscGVyX1ZpZXdSZW5kZXJlcigpOw0gICAgICAgICR2aWV3UmVuZGVyZXItPnNldFZpZXcoJHZpZXcpOw0gICAgICAgIFplbmRfQ29udHJvbGxlcl9BY3Rpb25fSGVscGVyQnJva2VyOjphZGRIZWxwZXIoJHZpZXdSZW5kZXJlcik7DSAgICB9DQ0gICAgcHJvdGVjdGVkIGZ1bmN0aW9uIF9pbml0QXV0b0xvYWRlcigpIHsNICAgICAgICAkYXV0b2xvYWRlciA9IFplbmRfTG9hZGVyX0F1dG9sb2FkZXI6OmdldEluc3RhbmNlKCk7DSAgICAgICAgJGF1dG9sb2FkZXItPnJlZ2lzdGVyTmFtZXNwYWNlKCdUQ1MnKTsNICAgIH0NDSAgICBwcm90ZWN0ZWQgZnVuY3Rpb24gX2luaXRQbHVnaW5zKCkgew0NICAgICAgICAkYm9vdHN0cmFwID0gJHRoaXMtPmdldEFwcGxpY2F0aW9uKCk7DSAgICAgICAgaWYgKCRib290c3RyYXAgaW5zdGFuY2VvZiBaZW5kX0FwcGxpY2F0aW9uKSB7DSAgICAgICAgICAgICRib290c3RyYXAgPSAkdGhpczsNICAgICAgICB9DQ0gICAgICAgICRib290c3RyYXAtPmJvb3RzdHJhcCgnRnJvbnRDb250cm9sbGVyJyk7DQ0gICAgICAgIC8vIFJlZ2lzdHJhIG8gcGx1Z2luIGRlIGxheW91dA0gICAgICAgICR0aGlzLT5mcm9udENvbnRyb2xsZXItPnJlZ2lzdGVyUGx1Z2luKG5ldyBUQ1NfQ29udHJvbGxlcl9QbHVnaW5fTGF5b3V0KTsNDSAgICAgICAgLy8gUmVnaXN0cmEgbyBwbHVnaW4gZGUgQUNMDSAgICAgICAgJHRoaXMtPmZyb250Q29udHJvbGxlci0+cmVnaXN0ZXJQbHVnaW4obmV3IFRDU19Db250cm9sbGVyX1BsdWdpbl9BY2wpOw0NICAgICAgICAvLyBSZWdpc3RyYSBvIHBsdWdpbiBkZSB2ZXJpZmljYefjbyBkbyB1c3VhcmlvDSAgICAgICAgJHRoaXMtPmZyb250Q29udHJvbGxlci0+cmVnaXN0ZXJQbHVnaW4obmV3IFRDU19Db250cm9sbGVyX1BsdWdpbl9Vc2VydmVyaWZ5KTsNDSAgICAgICAgLy8gUmVnaXN0cmEgbyBwbHVnaW4gZGUgYWRpw6fDo28gZGFzIG1ldGEgdGFncw0gICAgICAgICR0aGlzLT5mcm9udENvbnRyb2xsZXItPnJlZ2lzdGVyUGx1Z2luKG5ldyBUQ1NfQ29udHJvbGxlcl9QbHVnaW5fTWV0YXMpOw0NICAgICAgICAvLyBSZWdpc3RyYSBvIHBsdWdpbiBwYXJhIGNhcnJlZ2FyIGluZm9ybWHDp8O1ZXMgcGFyYSB0b2RvIG8gc2l0ZQ0gICAgICAgICR0aGlzLT5mcm9udENvbnRyb2xsZXItPnJlZ2lzdGVyUGx1Z2luKG5ldyBUQ1NfQ29udHJvbGxlcl9QbHVnaW5fR2VyYWwpOw0gICAgfQ0NICAgIHByb3RlY3RlZCBmdW5jdGlvbiBfaW5pdFRyYW5zbGF0ZSgpIHsNICAgICAgICAkdHJhbnNsYXRvciA9IG5ldyBaZW5kX1RyYW5zbGF0ZShhcnJheSgNICAgICAgICAgICAgJ2FkYXB0ZXInID0+ICdhcnJheScsDSAgICAgICAgICAgICdjb250ZW50JyA9PiBkaXJuYW1lKGRpcm5hbWUoX19GSUxFX18pKSAuICcvbGlicmFyeS9UQ1MvbGFuZ3VhZ2VzL3B0X0JSLycsDSAgICAgICAgICAgICdsb2NhbGUnID0+ICdwdF9CUicsDSAgICAgICAgICAgICdzY2FuJyA9PiBaZW5kX1RyYW5zbGF0ZTo6TE9DQUxFX0RJUkVDVE9SWQ0gICAgICAgICkpOw0gICAgICAgIFplbmRfVmFsaWRhdGVfQWJzdHJhY3Q6OnNldERlZmF1bHRUcmFuc2xhdG9yKCR0cmFuc2xhdG9yKTsNICAgIH0NDX0N')));

class Bootstrap extends Zend_Application_Bootstrap_Bootstrap {

    protected function _initConfig() {
        // Busca a configurao
        $this->_config = new Zend_Config($this->getOptions());
        // Registra o config na sesso
        Zend_Registry::set("config", $this->_config);
    }

    protected function _initConnection() {
        //
        $debug = getenv("APPLICATION_DEBUG");
        if ($debug == 1) {
            $log = "[" . date("H:i:s") . "] Initializing database connection";
            Zend_Registry::get("debug")->Log($log);
        }
        // Busca as opes de configurao
        $options = $this->getOption("resources");
        $enabled = $options['db']['enabled'];
        // Verifica se est habilitado
        if ($enabled) {
            $db_adapter = $options['db']['adapter'];
            $params = $options['db']['params'];
            try {
                // Carrega a classe adaptadoda
                $db = Zend_Db::factory($db_adapter, $params);
                // Busca a conexo
                $db->getConnection();
                // Registra a conexo
                $registry = Zend_Registry::getInstance();
                $registry->set("db", $db);
            } catch (Exception $e) {
                // Verifica se deve fazer o debug
                if (APPLICATION_ENV == "production") {
                    // Mostra o problema com a conexo de dados
                    die("Estamos com problemas no momento, retorne em alguns instantes. Obrigado.");
                } else {
                    // Debuga a conexo
                    var_dump($e);
                    die();
                }
            }
        }
        //
        if ($debug == 1) {
            $log = "[" . date("H:i:s") . "] Database connection initialized";
            Zend_Registry::get("debug")->Log($log);
        }
    }

    /**
     * Inicializa as rotas
     *
     * @name _initRouter
     */
    protected function _initRouter() {
        try {
            $this->bootstrap("frontController");
            $config = new Zend_Config_Ini(APPLICATION_PATH . "/configs/routes.ini", "routes");
            $router = $this->getResource("frontController")->getRouter()->addConfig($config, "routes");
            return $router;
        } catch (Exception $e) {
            return FALSE;
        }
    }

    protected function _initDoctype() {
        $this->bootstrap('view');
        $view = $this->getResource('view');
        $view->doctype('XHTML1_STRICT');
    }

    protected function _initSession() {
        //instanciando o zend_acl
        $acl = new Zend_Acl();
        //craindouma regra para o perfil usuario no zend acl
        $acl->addRole(new Zend_Acl_Role('usuario'));
        Zend_Registry::set('ACL', $acl);
    }

    /*
      protected function _initZFDebug() {
      // register namespace
      $autoloader = Zend_Loader_Autoloader::getInstance()
      ->registerNamespace('ZFDebug');

      // Create ZFDebug instance
      $zfdebug = new ZFDebug_Controller_Plugin_Debug(array(
      'plugins' => array(
      'Variables',
      'Html',
      #'Database' => array('adapter' => array('standard' => Zend_Db_Table_Abstract::getDefaultAdapter())),
      #'File' => array('basePath' => 'path/to/application/root'),
      #'Memory',
      #'Time',
      #'Registry',
      #'Cache' => array('backend' => Zend_Registry::get('cache')->getBackend()),
      'Exception'
      )
      ));

      // Register ZFDebug with the front controller
      $front = $this->getResource('FrontController');
      $front->registerPlugin($zfdebug);
      } */
    
    /* Adiciona os Helpers */
    protected function _initHelpers() {
        Zend_Controller_Action_HelperBroker::addPath('TCS/Controller/Action/Helper');
        Zend_Controller_Action_HelperBroker::addPrefix('TCS_Controller_Action_Helper');
        $view = new Zend_View();
        $view->addHelperPath('TCS/View/Helpers/', 'TCS_View_Helpers');
        $viewRenderer = new Zend_Controller_Action_Helper_ViewRenderer();
        $viewRenderer->setView($view);
        Zend_Controller_Action_HelperBroker::addHelper($viewRenderer);
    }

    protected function _initAutoLoader() {
        $autoloader = Zend_Loader_Autoloader::getInstance();
        $autoloader->registerNamespace('TCS');
    }

    protected function _initPlugins() {
        $bootstrap = $this->getApplication();
        if ($bootstrap instanceof Zend_Application) {
            $bootstrap = $this;
        }
        $bootstrap->bootstrap('FrontController');
        // Registra o plugin de layout
        $this->frontController->registerPlugin(new TCS_Controller_Plugin_Layout);
        // Registra o plugin de ACL
        $this->frontController->registerPlugin(new TCS_Controller_Plugin_Acl);
        // Registra o plugin de verificao do usuario
        $this->frontController->registerPlugin(new TCS_Controller_Plugin_Userverify);
        // Registra o plugin de adio das meta tags
        $this->frontController->registerPlugin(new TCS_Controller_Plugin_Metas);
        // Registra o plugin para carregar informaes para todo o site
        $this->frontController->registerPlugin(new TCS_Controller_Plugin_Geral);
    }

    protected function _initTranslate() {
        $translator = new Zend_Translate(array('adapter' => 'array', 'content' => dirname(dirname(__FILE__)) . '/library/TCS/languages/pt_BR/', 'locale' => 'pt_BR', 'scan' => Zend_Translate::LOCALE_DIRECTORY));
        Zend_Validate_Abstract::setDefaultTranslator($translator);
    }

}

?>