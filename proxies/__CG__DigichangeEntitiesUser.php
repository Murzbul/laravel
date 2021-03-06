<?php

namespace DoctrineProxies\__CG__\Digichange\Entities;

/**
 * DO NOT EDIT THIS FILE - IT WAS CREATED BY DOCTRINE'S PROXY GENERATOR
 */
class User extends \Digichange\Entities\User implements \Doctrine\ORM\Proxy\Proxy
{
    /**
     * @var \Closure the callback responsible for loading properties in the proxy object. This callback is called with
     *      three parameters, being respectively the proxy object to be initialized, the method that triggered the
     *      initialization process and an array of ordered parameters that were passed to that method.
     *
     * @see \Doctrine\Common\Proxy\Proxy::__setInitializer
     */
    public $__initializer__;

    /**
     * @var \Closure the callback responsible of loading properties that need to be copied in the cloned object
     *
     * @see \Doctrine\Common\Proxy\Proxy::__setCloner
     */
    public $__cloner__;

    /**
     * @var boolean flag indicating if this object was already initialized
     *
     * @see \Doctrine\Common\Persistence\Proxy::__isInitialized
     */
    public $__isInitialized__ = false;

    /**
     * @var array<string, null> properties to be lazy loaded, indexed by property name
     */
    public static $lazyPropertiesNames = array (
);

    /**
     * @var array<string, mixed> default values of properties to be lazy loaded, with keys being the property names
     *
     * @see \Doctrine\Common\Proxy\Proxy::__getLazyProperties
     */
    public static $lazyPropertiesDefaults = array (
);



    public function __construct(?\Closure $initializer = null, ?\Closure $cloner = null)
    {

        $this->__initializer__ = $initializer;
        $this->__cloner__      = $cloner;
    }







    /**
     * 
     * @return array
     */
    public function __sleep()
    {
        if ($this->__isInitialized__) {
            return ['__isInitialized__', '' . "\0" . 'Digichange\\Entities\\User' . "\0" . 'id', '' . "\0" . 'Digichange\\Entities\\User' . "\0" . 'name', '' . "\0" . 'Digichange\\Entities\\User' . "\0" . 'email', '' . "\0" . 'Digichange\\Entities\\User' . "\0" . 'password', '' . "\0" . 'Digichange\\Entities\\User' . "\0" . 'rememberToken', '' . "\0" . 'Digichange\\Entities\\User' . "\0" . 'roles', 'createdAt', 'updatedAt'];
        }

        return ['__isInitialized__', '' . "\0" . 'Digichange\\Entities\\User' . "\0" . 'id', '' . "\0" . 'Digichange\\Entities\\User' . "\0" . 'name', '' . "\0" . 'Digichange\\Entities\\User' . "\0" . 'email', '' . "\0" . 'Digichange\\Entities\\User' . "\0" . 'password', '' . "\0" . 'Digichange\\Entities\\User' . "\0" . 'rememberToken', '' . "\0" . 'Digichange\\Entities\\User' . "\0" . 'roles', 'createdAt', 'updatedAt'];
    }

    /**
     * 
     */
    public function __wakeup()
    {
        if ( ! $this->__isInitialized__) {
            $this->__initializer__ = function (User $proxy) {
                $proxy->__setInitializer(null);
                $proxy->__setCloner(null);

                $existingProperties = get_object_vars($proxy);

                foreach ($proxy::$lazyPropertiesDefaults as $property => $defaultValue) {
                    if ( ! array_key_exists($property, $existingProperties)) {
                        $proxy->$property = $defaultValue;
                    }
                }
            };

        }
    }

    /**
     * 
     */
    public function __clone()
    {
        $this->__cloner__ && $this->__cloner__->__invoke($this, '__clone', []);
    }

    /**
     * Forces initialization of the proxy
     */
    public function __load()
    {
        $this->__initializer__ && $this->__initializer__->__invoke($this, '__load', []);
    }

    /**
     * {@inheritDoc}
     * @internal generated method: use only when explicitly handling proxy specific loading logic
     */
    public function __isInitialized()
    {
        return $this->__isInitialized__;
    }

    /**
     * {@inheritDoc}
     * @internal generated method: use only when explicitly handling proxy specific loading logic
     */
    public function __setInitialized($initialized)
    {
        $this->__isInitialized__ = $initialized;
    }

    /**
     * {@inheritDoc}
     * @internal generated method: use only when explicitly handling proxy specific loading logic
     */
    public function __setInitializer(\Closure $initializer = null)
    {
        $this->__initializer__ = $initializer;
    }

    /**
     * {@inheritDoc}
     * @internal generated method: use only when explicitly handling proxy specific loading logic
     */
    public function __getInitializer()
    {
        return $this->__initializer__;
    }

    /**
     * {@inheritDoc}
     * @internal generated method: use only when explicitly handling proxy specific loading logic
     */
    public function __setCloner(\Closure $cloner = null)
    {
        $this->__cloner__ = $cloner;
    }

    /**
     * {@inheritDoc}
     * @internal generated method: use only when explicitly handling proxy specific cloning logic
     */
    public function __getCloner()
    {
        return $this->__cloner__;
    }

    /**
     * {@inheritDoc}
     * @internal generated method: use only when explicitly handling proxy specific loading logic
     * @deprecated no longer in use - generated code now relies on internal components rather than generated public API
     * @static
     */
    public function __getLazyProperties()
    {
        return self::$lazyPropertiesDefaults;
    }

    
    /**
     * {@inheritDoc}
     */
    public function update(\Digichange\Payloads\Users\UserUpdatePayload $payload): \Digichange\Entities\User
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'update', [$payload]);

        return parent::update($payload);
    }

    /**
     * {@inheritDoc}
     */
    public function getId(): string
    {
        if ($this->__isInitialized__ === false) {
            return  parent::getId();
        }


        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getId', []);

        return parent::getId();
    }

    /**
     * {@inheritDoc}
     */
    public function getEmail(): string
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getEmail', []);

        return parent::getEmail();
    }

    /**
     * {@inheritDoc}
     */
    public function getName(): string
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getName', []);

        return parent::getName();
    }

    /**
     * {@inheritDoc}
     */
    public function getRoles()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getRoles', []);

        return parent::getRoles();
    }

    /**
     * {@inheritDoc}
     */
    public function setRole(\Digichange\Entities\Role $role): void
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setRole', [$role]);

        parent::setRole($role);
    }

    /**
     * {@inheritDoc}
     */
    public function getAuthIdentifierName()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getAuthIdentifierName', []);

        return parent::getAuthIdentifierName();
    }

    /**
     * {@inheritDoc}
     */
    public function getAuthIdentifier()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getAuthIdentifier', []);

        return parent::getAuthIdentifier();
    }

    /**
     * {@inheritDoc}
     */
    public function getAuthPassword()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getAuthPassword', []);

        return parent::getAuthPassword();
    }

    /**
     * {@inheritDoc}
     */
    public function getRememberToken()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getRememberToken', []);

        return parent::getRememberToken();
    }

    /**
     * {@inheritDoc}
     */
    public function setRememberToken($rememberToken)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setRememberToken', [$rememberToken]);

        return parent::setRememberToken($rememberToken);
    }

    /**
     * {@inheritDoc}
     */
    public function getRememberTokenName()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getRememberTokenName', []);

        return parent::getRememberTokenName();
    }

    /**
     * {@inheritDoc}
     */
    public function getJWTIdentifier()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getJWTIdentifier', []);

        return parent::getJWTIdentifier();
    }

    /**
     * {@inheritDoc}
     */
    public function getJWTCustomClaims(): array
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getJWTCustomClaims', []);

        return parent::getJWTCustomClaims();
    }

    /**
     * {@inheritDoc}
     */
    public function notifications()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'notifications', []);

        return parent::notifications();
    }

    /**
     * {@inheritDoc}
     */
    public function readNotifications()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'readNotifications', []);

        return parent::readNotifications();
    }

    /**
     * {@inheritDoc}
     */
    public function unreadNotifications()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'unreadNotifications', []);

        return parent::unreadNotifications();
    }

    /**
     * {@inheritDoc}
     */
    public function notify($instance)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'notify', [$instance]);

        return parent::notify($instance);
    }

    /**
     * {@inheritDoc}
     */
    public function notifyNow($instance, array $channels = NULL)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'notifyNow', [$instance, $channels]);

        return parent::notifyNow($instance, $channels);
    }

    /**
     * {@inheritDoc}
     */
    public function routeNotificationFor($driver, $notification = NULL)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'routeNotificationFor', [$driver, $notification]);

        return parent::routeNotificationFor($driver, $notification);
    }

    /**
     * {@inheritDoc}
     */
    public function getCreatedAt(): \Carbon\Carbon
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getCreatedAt', []);

        return parent::getCreatedAt();
    }

    /**
     * {@inheritDoc}
     */
    public function getUpdatedAt(): \Carbon\Carbon
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getUpdatedAt', []);

        return parent::getUpdatedAt();
    }

}
