<?php
/**
 * @category   Horde
 * @package    Horde_View
 * @subpackage Helper
 */

/**
 * Abstract class for Horde_View_Helper objects.
 *
 * All helpers hold a link back to the instance of the view.  The undefined
 * property handlers (__get()/__call() methods) are used to mix helpers
 * together, effectively placing them on the same pane of glass (the view) and
 * allowing any helper to call any other.
 *
 * @category   Horde
 * @package    Horde_View
 * @subpackage Helper
 */
abstract class Horde_View_Helper_Base
{
    /**
     * The parent view invoking the helper
     *
     * @var Horde_View
     */
    protected $_view;

    /**
     * Create a helper for $view
     *
     * @param Horde_View $view The view to help.
     */
    public function __construct($view)
    {
        $this->_view = $view;
        $view->addHelper($this);
    }

    /**
     * Proxy on undefined property access (get)
     */
    public function __get($name)
    {
        return $this->_view->$name;
    }

    /**
     * Proxy on undefined property access (set)
     */
    public function __set($name, $value)
    {
        return $this->_view->$name = $value;
    }

    /**
     * Call chaining so other helpers can be called transparently.
     *
     * @param string $method The helper method.
     * @param array $args The parameters for the helper.
     *
     * @return string The result of the helper method.
     */
    public function __call($method, $args)
    {
        return $this->_view->__call($method, $args);
    }

}