<?php
/**
 * This file is part of the Ray.Aop package
 *
 * @license http://opensource.org/licenses/bsd-license.php BSD
 */
namespace Ray\Aop\Match;

use Ray\Aop\Exception\InvalidArgument;
use Ray\Aop\AbstractMatcher;

class IsSubclassesOf
{
    /**
     * Return is subclass of
     *
     * @param string $class
     * @param bool   $target AbstractMatcher::TARGET_CLASS | AbstractMatcher::TARGET_METHOD
     * @param string $superClass
     *
     * @return bool
     * @throws InvalidArgument
     * @SuppressWarnings(PHPMD.UnusedPrivateMethod)
     */
    public function __invoke($class, $target, $superClass)
    {
        if ($class instanceof \ReflectionMethod) {
            throw new InvalidArgument($class->name);
        }
        if ($target === AbstractMatcher::TARGET_METHOD) {
            throw new InvalidArgument($class);
        }
        try {
            $isSubClass = (new \ReflectionClass($class))->isSubclassOf($superClass) ?: $isSubClass = ($class === $superClass);

            return $isSubClass;
        } catch (\Exception $e) {
            return false;
        }
    }
}
