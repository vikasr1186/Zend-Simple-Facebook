# Zend-Simple-Facebook

This library contains Facebook oAuth2 Authentication adapter and basic Facebook Graph API library.
The project was inspired by two projects on GitHub -> [Zend_Auth_Adapter_Facebook](https://github.com/fordnox/Zend_Auth_Adapter_Facebook) and [Facebook-PHP-SDK-for-Zend-Framework](https://github.com/erickthered/Facebook-PHP-SDK-for-Zend-Framework)

Both were lacking either beauty of code or were just incomplete. So after whole day of digging and hacking the code I decided to come up with my version.

## Usage

In your application.ini add this:

    ; ------------------------------------------
    ; Facebook library
    ; ------------------------------------------
    autoloaderNamespaces.Facebook = "Facebook_"

    facebook.appId = "<Facebook appId>"
    facebook.secret = "<Facebook appSecret>"
    facebook.permissions = "<List of permissions to request (comma separated)>"
    facebook.redirectUrl = "<Callback URL after sign in>"

To utilise adapter you could start with in
..application/controller/AuthController.php

    <?php

    class AuthController extends Zend_Controller_Action
    {

        public function loginAction()
        {
            $adapter = new Facebook_Auth_Adapter();
            $token   = $this->_getParam('code');

            if($token) {
                $auth = Zend_Auth::getInstance();
                $adapter->setToken($token);
                $result = $auth->authenticate($adapter);

                if($result->isValid()) {
                    // successful login, redirect to profile page
                    $this->_helper->redirector('index', 'profile');
                } else {
                    // there were some errors
                    $this->_helper->redirector('login');
                }
            } else {
                $adapter->redirect();
            }
        }
    }

To do any Facebook Graph API calls:
    <?php

    class ProfileController extends Zend_Controller_Action
    {
        public function indexAction()
            $facebook = new Facebook_Api();

            try{
                var_dump($facebook->getProfile());
            } catch(Exception $e) {
                echo $e->getMessage();
            }
        }
    }

### Adding more functionality

This library was created in mind to extend it. So you can create child classes and do lot's of cool stuff, like overriding Zend_Auth Identity object, extending API calls etc...

## Contribute

Please, DO CONTRIBUTE. If you find some inconsistencies, any possible features, fork it, add some COOL stuff and do a pull request. I will be more than happy to approve a good contribution :)!

## Author

Author of this software is Laurynas Karvelis <laurynas.karvelis@gmail.com> working @ Explosive Brains Ltd.
Released under "DO WHAT THE FUCK YOU WANT TO PUBLIC LICENSE" <http://sam.zoy.org/wtfpl/COPYING>