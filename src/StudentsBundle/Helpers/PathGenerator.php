<?php

namespace StudentsBundle\Helpers;

class PathGenerator
{
    const SPLIT_SYMBOL = '_';

    /**
     * @var array
     */
    private $currentPaths = [];

    /**
     * Generate path for student
     *
     * @param string $name
     * @return string
     */
    public function generatePath(string $name): string
    {
        $basePath = preg_replace('/\W/', self::SPLIT_SYMBOL, strtolower($name));
        $uniquePath = $this->getUniquePath($basePath);
        $this->currentPaths[$uniquePath] = true;
        return $uniquePath;
    }

    /**
     * Get unique path for student
     *
     * @param string $path
     * @param int $iterator
     * @return string
     */
    private function getUniquePath(string $path, int $iterator = 1): string
    {
        if (!$this->currentPaths) {
            return $path;
        }

        if (isset($path[$this->currentPaths])) {
            $path = ($iterator > 1) ?
                preg_replace('/(\d)+$/', $iterator, $path) :
                self::SPLIT_SYMBOL . $iterator;

            return $this->getUniquePath($path, ++$iterator);
        }

        return $path;
    }
}
